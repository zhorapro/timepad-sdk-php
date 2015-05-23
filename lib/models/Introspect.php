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

class Introspect implements ArrayAccess {
  static $swaggerTypes = array(
      'active' => 'boolean',
      'client_id' => 'string',
      'user_id' => 'string',
      'user_email' => 'string',
      'organizations' => 'array[Organization]'
  );

  static $attributeMap = array(
      'active' => 'active',
      'client_id' => 'client_id',
      'user_id' => 'user_id',
      'user_email' => 'user_email',
      'organizations' => 'organizations'
  );

  
  /**
  * Действует ли этот токен
  */
  public $active; /* boolean */
  /**
  * Идентификатор клиента API, которым получен токен
  */
  public $client_id; /* string */
  /**
  * Идентификатор пользователя, которым получен токен
  */
  public $user_id; /* string */
  /**
  * Электронная почта пользователя, которым получен токен
  */
  public $user_email; /* string */
  /**
  * Организации, к которым есть доступ пользователя
  */
  public $organizations; /* array[Organization] */

  public function __construct(array $data = null) {
    $this->active = $data["active"];
    $this->client_id = $data["client_id"];
    $this->user_id = $data["user_id"];
    $this->user_email = $data["user_email"];
    $this->organizations = $data["organizations"];
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
