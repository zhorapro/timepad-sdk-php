<?php
/**
 *  Copyright 2015 Reverb Technologies, Inc.
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 */

namespace TimepadApi;

class APIClient {

    public static $PATCH = "PATCH";
    public static $POST = "POST";
    public static $GET = "GET";
    public static $PUT = "PUT";
    public static $DELETE = "DELETE";

    /**
     * @param string $host the address of the API server
     * @param string $headerName a header to pass on requests
     */
    function __construct($host, $headerName = null, $headerValue = null) {
        $this->host = $host;
        $this->headerName = $headerName;
        $this->headerValue = $headerValue;
    }

    /**
     * Set the user agent of the API client
     *
     * @param string $user_agent The user agent of the API client
     *
     * @throws Exception
     */
    public function setUserAgent ($user_agent) {
        if (!is_string($user_agent)) {
            throw new Exception('User-agent must be a string.');
        }
        $this->user_agent= $user_agent;
    }

    /**
     * @param integer $seconds Number of seconds before timing out [set to 0 for no timeout]
     *
     * @throws Exception
     */
    public function setTimeout ($seconds) {
        if (!is_numeric($seconds)) {
          throw new Exception('Timeout variable must be numeric.');
        }
        $this->curl_timout = $seconds;
    }

    /**
     * Set token. This token will be passed through GET request.
     * It is more safely to pass token through HTTP headers.
     * You can create APIClient object with $headerName == 'Authorization' and $headerValue == 'Bearer <token>'
     *
     * @param string $token
     *
     * @throws Exception
     */
    public function setToken ($token) {
        if (!is_string($token)) {
            throw new Exception('Token must be a string.');
        }
        $this->token = $token;
    }

    /**
     * @param string $resourcePath path to method endpoint
     * @param string $method method to call
     * @param array $queryParams parameters to be place in query URL
     * @param array $postData parameters to be placed in POST body
     * @param array $headerParams parameters to be place in request header
     *
     * @throws APIClientException | Exception
     *
     * @return mixed
     */
    public function callAPI($resourcePath, $method, $queryParams, $postData, $headerParams) {

        $headers = array();

        # Allow API key from $headerParams to override default
        $added_api_key = false;
        if ($headerParams != null) {
            foreach ($headerParams as $key => $val) {
                $headers[] = "$key: $val";
                if ($key == $this->headerName) {
                    $added_api_key = true;
                }
            }
        }

        if (!$added_api_key && $this->headerName != null) {
            $headers[] = $this->headerName . ": " . $this->headerValue;
        }

        if (is_object($postData) or is_array($postData)) {
            $postData = json_encode($this->sanitizeForSerialization($postData));
        }

        $url = $this->host . $resourcePath;

        $curl = curl_init();
        if (isset($this->curl_timout)) {
            curl_setopt($curl, CURLOPT_TIMEOUT, $this->curl_timout);
        }

        // return the result on success, rather than just TRUE
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        if (!isset($queryParams['token']) && isset($this->token)) {
            $queryParams['token'] = $this->token;
        }

        if (! empty($queryParams)) {
            $url = ($url . '?' . http_build_query($queryParams));
        }

        if ($method == self::$POST) {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        } else if ($method == self::$PATCH) {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH");
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        } else if ($method == self::$PUT) {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        } else if ($method == self::$DELETE) {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        } else if ($method != self::$GET) {
            throw new Exception('Method ' . $method . ' is not recognized.');
        }
        curl_setopt($curl, CURLOPT_URL, $url);

        // Set user agent
        if (isset($this->user_agent)) {
            curl_setopt($curl, CURLOPT_USERAGENT, $this->user_agent);
        } else { // use PHP-Swagger as the default user agent
            curl_setopt($curl, CURLOPT_USERAGENT, 'PHP-Swagger');
        }

        // Make the request
        $response = curl_exec($curl);
        $response_info = curl_getinfo($curl);

        // Handle the response
        if ($response_info['http_code'] == 0) {
            throw new APIClientException("Undefined error occurred. The requested URL " . $url .
            " responded with HTTP code 0.", 0, $response_info, $response);
        } else if ($response_info['http_code'] >= 200 && $response_info['http_code'] <= 299 ) {
            $data = json_decode($response);
            if (json_last_error() > 0) { // if response is a string
                $data = $response;
            }
        } else if ($response_info['http_code'] == 401) {
            throw new APIClientException("Unauthorized API request to " . $url .
                ": " . serialize($response), 0, $response_info, $response);
        } else if ($response_info['http_code'] == 404) {
            $data = null;
        } else {
            throw new APIClientException("Can't connect to the api: " . $url . " response code: " .
                $response_info['http_code'] . ", response: ". serialize($response), 0, $response_info, $response);
        }

        return $data;
    }

    /**
     * Build a JSON POST object
     *
     * @param $data
     * @return array|bool|float|int|string
     */
    protected function sanitizeForSerialization($data)
    {
        if (is_scalar($data) || null === $data) {
            $sanitized = $data;
        } else if ($data instanceof \DateTime) {
            $sanitized = $data->format(\DateTime::ISO8601);
        } else if (is_array($data)) {
            foreach ($data as $property => $value) {
                $data[$property] = $this->sanitizeForSerialization($value);
            }
            $sanitized = $data;
        } else if (is_object($data)) {
            $values = array();
            foreach (array_keys($data::$swaggerTypes) as $property) {
                $values[$data::$attributeMap[$property]] = $this->sanitizeForSerialization($data->$property);
            }
            $sanitized = $values;
        } else {
            $sanitized = (string)$data;
        }

        return $sanitized;
    }

    /**
     * Take value and turn it into a string suitable for inclusion in
     * the path, by url-encoding.
     * @param string $value a string which will be part of the path
     * @return string the serialized object
     */
    public static function toPathValue($value) {
        return rawurlencode(self::toString($value));
    }

    /**
     * Take value and turn it into a string suitable for inclusion in
     * the query, by imploding comma-separated if it's an object.
     * If it's a string, pass through unchanged. It will be url-encoded
     * later.
     * @param object $object an object to be serialized to a string
     * @return string the serialized object
     */
    public static function toQueryValue($object) {
        if (is_array($object)) {
            return implode(',', $object);
        } else {
            return self::toString($object);
        }
    }

    /**
     * Take value and turn it into a string suitable for inclusion in
     * the header. If it's a string, pass through unchanged
     * If it's a datetime object, format it in ISO8601
     * @param string $value a string which will be part of the header
     * @return string the header string
     */
    public static function toHeaderValue($value) {
        return self::toString($value);
    }

    /**
     * Take value and turn it into a string suitable for inclusion in
     * the http body (form parameter). If it's a string, pass through unchanged
     * If it's a datetime object, format it in ISO8601
     * @param string $value the value of the form parameter
     * @return string the form string
     */
    public static function toFormValue($value) {
        return self::toString($value);
    }

    /**
     * Take value and turn it into a string suitable for inclusion in
     * the parameter. If it's a string, pass through unchanged
     * If it's a datetime object, format it in ISO8601
     * @param string $value the value of the parameter
     * @return string the header string
     */
    public static function toString($value) {
        if ($value instanceof \DateTime) { // datetime in ISO8601 format
            return $value->format(\DateTime::ISO8601);
        }
        else {
            return $value;
        }
    }

    /**
     * Deserialize a JSON string into an object
     *
     * @param object $object object or primitive to be deserialized
     * @param string $class class name is passed as a string
     * @return object an instance of $class
     */
    public static function deserialize($data, $class) {
        if (null === $data) {
            $deserialized = null;
        } elseif (substr($class, 0, 4) == 'map[') {
            $inner = substr($class, 4, -1);
            $values = array();
            if(strrpos($inner, ",") !== false) {
                $subClass_array = explode(',', $inner, 2);
                $subClass = $subClass_array[1];
                foreach ($data as $key => $value) {
                    $values[$key] = self::deserialize($value, $subClass);
                }
            }

            $deserialized = $values;

        } elseif (strcasecmp(substr($class, -2),'[]') == 0) {
        $subClass = substr($class, 0, -2);
            $values = array();
            foreach ($data as $key => $value) {
                $values[] = self::deserialize($value, $subClass);
            }
            $deserialized = $values;
        } elseif ($class == 'DateTime' || $class == 'date') {
            $deserialized = new \DateTime($data);
        } elseif ($class == 'boolean') {
            settype($data, 'bool');
            $deserialized = $data;
        } elseif ($class == 'number') {
            settype($data, 'float');
            $deserialized = $data;
        } elseif ($class == 'object') {
            $deserialized = $data;
        } elseif (in_array($class, array('string', 'int', 'float', 'bool'))) {
            try{
                settype($data, $class);
            } catch{\Exception $e){}
            $deserialized = $data;
        } else {
            $class = "TimepadApi\\models\\".$class;
            $instance = new $class();
            foreach ($instance::$swaggerTypes as $property => $type) {
                if (isset($data->$property)) {
                    $original_property_name = $instance::$attributeMap[$property];
                    $instance->$property = self::deserialize($data->$original_property_name, $type);
                }
            }
            $deserialized = $instance;
        }

        return $deserialized;
    }
}
