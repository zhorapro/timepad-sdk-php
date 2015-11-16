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

/**
 * 
 *
 * NOTE: This class is auto generated by the swagger code generator program. Do not edit the class manually.
 *
 */

namespace TimepadApi\models;

use \ArrayAccess;

class OrganizationResponse implements ArrayAccess {
    static $swaggerTypes = array(
        'id' => 'int',
        'name' => 'string',
        'description_html' => 'string',
        'url' => 'string',
        'logo_image' => 'ImageResponse',
        'subdomain' => 'string',
        'permissions' => 'string[]'
    );

    static $attributeMap = array(
        'id' => 'id',
        'name' => 'name',
        'description_html' => 'description_html',
        'url' => 'url',
        'logo_image' => 'logo_image',
        'subdomain' => 'subdomain',
        'permissions' => 'permissions'
    );

    
    /**
    * Уникальный номер организации
    *
    * @var int
    */
    public $id;
    /**
    * Название организации
    *
    * @var string
    */
    public $name;
    /**
    * Описание организации
    *
    * @var string
    */
    public $description_html;
    /**
    * URL организации на сайте
    *
    * @var string
    */
    public $url;
    /**
    * Логотип
    *
    * @var ImageResponse
    */
    public $logo_image;
    /**
    * Уникальное название организации - часть URL
    *
    * @var string
    */
    public $subdomain;
    /**
    * Настройки доступов для организаций
    *
    * @var string[]
    */
    public $permissions;

    public function __construct(array $data = null) {
    
        if(isset($data["id"])) {
            $this->id = $data["id"];
        }
    
    
        if(isset($data["name"])) {
            $this->name = $data["name"];
        }
    
    
        if(isset($data["description_html"])) {
            $this->description_html = $data["description_html"];
        }
    
    
        if(isset($data["url"])) {
            $this->url = $data["url"];
        }
    
    
        if(isset($data["logo_image"])) {
            $this->logo_image = $data["logo_image"];
        }
    
    
        if(isset($data["subdomain"])) {
            $this->subdomain = $data["subdomain"];
        }
    
    
        if(isset($data["permissions"])) {
            $this->permissions = $data["permissions"];
        }
    
    }

    public function offsetExists($offset) {
        return isset($this->$offset);
    }

    public function offsetGet($offset) {
        return $this->$offset;
    }

    public function offsetSet($offset, $value) {
        $this->$offset = $value;
    }

    public function offsetUnset($offset) {
        unset($this->$offset);
    }
}
