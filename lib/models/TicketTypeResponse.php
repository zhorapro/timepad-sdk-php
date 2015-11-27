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

class TicketTypeResponse implements ArrayAccess {
    static $swaggerTypes = array(
        'id' => 'int',
        'name' => 'string',
        'description' => 'string',
        'buy_amount_min' => 'float',
        'buy_amount_max' => 'float',
        'price' => 'float',
        'is_promocode_locked' => 'bool',
        'remaining' => 'int',
        'sale_ends_at' => 'DateTime',
        'sale_starts_at' => 'DateTime',
        'public_key' => 'string',
        'is_active' => 'bool',
        'ad_partner_profit' => 'float',
        'sold' => 'float',
        'attended' => 'float',
        'limit' => 'float',
        'status' => 'string'
    );

    static $attributeMap = array(
        'id' => 'id',
        'name' => 'name',
        'description' => 'description',
        'buy_amount_min' => 'buy_amount_min',
        'buy_amount_max' => 'buy_amount_max',
        'price' => 'price',
        'is_promocode_locked' => 'is_promocode_locked',
        'remaining' => 'remaining',
        'sale_ends_at' => 'sale_ends_at',
        'sale_starts_at' => 'sale_starts_at',
        'public_key' => 'public_key',
        'is_active' => 'is_active',
        'ad_partner_profit' => 'ad_partner_profit',
        'sold' => 'sold',
        'attended' => 'attended',
        'limit' => 'limit',
        'status' => 'status'
    );

    
    /**
    * Уникальный номер типа билета
    *
    * @var int
    */
    public $id;
    /**
    * Название типа билета
    *
    * @var string
    */
    public $name;
    /**
    * Описание типа билета
    *
    * @var string
    */
    public $description;
    /**
    * Минимальное количество билетов в одной покупке
    *
    * @var float
    */
    public $buy_amount_min;
    /**
    * Максимальное количество билетов в одной покупке
    *
    * @var float
    */
    public $buy_amount_max;
    /**
    * Цена билета
    *
    * @var float
    */
    public $price;
    /**
    * Закрыт ли этот тип билета введённым промокодом
    *
    * @var bool
    */
    public $is_promocode_locked;
    /**
    * Сколько билетов осталось
    *
    * @var int
    */
    public $remaining;
    /**
    * Дата окончания продажи типа билета
    *
    * @var DateTime
    */
    public $sale_ends_at;
    /**
    * Дата начала продажи типа билета
    *
    * @var DateTime
    */
    public $sale_starts_at;
    /**
    * Публичный ключ для расшифровки QR-кода билета этого типа
    *
    * @var string
    */
    public $public_key;
    /**
    * Активность типа билета
    *
    * @var bool
    */
    public $is_active;
    /**
    * Партнёрская прибыль
    *
    * @var float
    */
    public $ad_partner_profit;
    /**
    * Количество проданных билетов
    *
    * @var float
    */
    public $sold;
    /**
    * Количество посетивших людей
    *
    * @var float
    */
    public $attended;
    /**
    * Ограничение на количество билетов в этом типе билета
    *
    * @var float
    */
    public $limit;
    /**
    * Статус типа билета
    *
    * @var string
    */
    public $status;

    public function __construct(array $data = null) {
    
        if(isset($data["id"])) {
            $this->id = $data["id"];
        }
    
    
        if(isset($data["name"])) {
            $this->name = $data["name"];
        }
    
    
        if(isset($data["description"])) {
            $this->description = $data["description"];
        }
    
    
        if(isset($data["buy_amount_min"])) {
            $this->buy_amount_min = $data["buy_amount_min"];
        }
    
    
        if(isset($data["buy_amount_max"])) {
            $this->buy_amount_max = $data["buy_amount_max"];
        }
    
    
        if(isset($data["price"])) {
            $this->price = $data["price"];
        }
    
    
        if(isset($data["is_promocode_locked"])) {
            $this->is_promocode_locked = $data["is_promocode_locked"];
        }
    
    
        if(isset($data["remaining"])) {
            $this->remaining = $data["remaining"];
        }
    
    
        if(isset($data["sale_ends_at"])) {
            $this->sale_ends_at = $data["sale_ends_at"];
        }
    
    
        if(isset($data["sale_starts_at"])) {
            $this->sale_starts_at = $data["sale_starts_at"];
        }
    
    
        if(isset($data["public_key"])) {
            $this->public_key = $data["public_key"];
        }
    
    
        if(isset($data["is_active"])) {
            $this->is_active = $data["is_active"];
        }
    
    
        if(isset($data["ad_partner_profit"])) {
            $this->ad_partner_profit = $data["ad_partner_profit"];
        }
    
    
        if(isset($data["sold"])) {
            $this->sold = $data["sold"];
        }
    
    
        if(isset($data["attended"])) {
            $this->attended = $data["attended"];
        }
    
    
        if(isset($data["limit"])) {
            $this->limit = $data["limit"];
        }
    
    
        if(isset($data["status"])) {
            $this->status = $data["status"];
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
