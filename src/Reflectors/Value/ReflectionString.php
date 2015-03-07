<?php
/**
 * This file is part of the Reflectors package.
 *
 * Copyright (c) 2013-2015 Pierre Cassat <me@e-piwi.fr> and contributors
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * The source code of this package is available online at
 * <http://github.com/atelierspierrot/reflectors>.
 */

namespace Reflectors\Value;

use \Reflectors\ValueType;
use \Reflectors\AbstractReflectionValue;

/**
 * The [string](http://php.net/string) value reflector
 */
class ReflectionString
    extends AbstractReflectionValue
{

    protected static $_read_only = array(
        'value'     => 'getValue',
        'type'      => 'getValueType',
        'length'    => 'getLength',
    );

    /**
     * @var int   The length of the string. Read-only, throws [ReflectionException](http://php.net/ReflectionException) in attempt to write.
     */
    protected $length;

    /**
     * Use the `ValueType::NUMERIC_AS_STRING` flag to allow numeric values as strings
     *
     * @param   string  $value
     * @param   int     $flag   A flag used by the `ValueType::getType()` method
     * @throws  \ReflectionException if the parameter is not a string
     */
    public function __construct($value, $flag = ValueType::MODE_STRICT)
    {
        if (!ValueType::isString($value) && !is_numeric($value)) {
            throw new \ReflectionException(
                sprintf(__METHOD__.' expects parameter one to be string, %s given', gettype($value))
            );
        }
        $this->setReadOnlyProperties($this::$_read_only);
        $this->type     = ValueType::TYPE_STRING;
        $this->value    = (string) $value;
        $this->length   = strlen($value);
    }

    /**
     * Returns the current value of the string
     *
     * @return string
     */
    public function getString()
    {
        return $this->getValue();
    }

    /**
     * Returns the length of the string
     *
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Representation of the object
     *
     * If an exception is caught, its message is returned instead of the
     * original result (but it is not thrown ahead).
     *
     * @return string
     */
    public function __toString()
    {
        try {
            return 'String of length '.$this->getLength().' [ "'.$this->getValue().'" ]';
        } catch (\Exception $e) {
            return $e->__toString();
        }
    }

}

// Endfile