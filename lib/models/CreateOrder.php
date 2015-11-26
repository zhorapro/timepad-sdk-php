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

class CreateOrder implements ArrayAccess {
    static $swaggerTypes = array(
        'tickets' => 'TicketInclude[]',
        'answers' => 'map[string,string]',
        'promocodes' => 'string[]'
    );

    static $attributeMap = array(
        'tickets' => 'tickets',
        'answers' => 'answers',
        'promocodes' => 'promocodes'
    );

    
    /**
    * Список видов билетов
    *
    * @var TicketInclude[]
    */
    public $tickets;
    /**
    * Список видов билетов
    *
    * @var map[string,string]
    */
    public $answers;
    /**
    * Промокоды
    *
    * @var string[]
    */
    public $promocodes;

    public function __construct(array $data = null) {
    
        if(isset($data["tickets"])) {
            $this->tickets = $data["tickets"];
        }
    
    
        if(isset($data["answers"])) {
            $this->answers = $data["answers"];
        }
    
    
        if(isset($data["promocodes"])) {
            $this->promocodes = $data["promocodes"];
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
