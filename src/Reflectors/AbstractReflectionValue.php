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

namespace Reflectors;

/**
 * Basic implementation of the `\Reflectors\ReflectionValueInterface` with read-only properties.
 *
 * This defines a global value reflection base class
 * with implementation of the `getValue()` and `getValueType()`
 * methods of the `\Reflectors\ReflectionVariableInterface`.
 * The `$value` and `$type` properties are read-only.
 */
abstract class AbstractReflectionValue
    implements ReflectionValueInterface
{

    use ReflectorTrait, ReadOnlyPropertiesTrait;

    protected static $_read_only = array(
        'value' => 'getValue',
        'type'  => 'getValueType'
    );

    /**
     * @var mixed   The reflected value. Read-only, throws [ReflectionException](http://php.net/ReflectionException) in attempt to write.
     */
    protected $value;

    /**
     * @var string  The type of reflected value. Read-only, throws [ReflectionException](http://php.net/ReflectionException) in attempt to write.
     */
    protected $type;

    /**
     * Extending classes may define their own constructor and call this one first
     *
     * @param   mixed   $value
     * @param   int     $flag   A flag used by the `ValueType::getType()` method
     */
    public function __construct($value, $flag = ValueType::MODE_STRICT)
    {
        $this->setReadOnlyProperties($this::$_read_only);
        $this->value    = $value;
        $this->type     = ValueType::getType($value);
    }

    /**
     * Extending classes must define their own representation
     *
     * @return string
     */
    abstract public function __toString();

    /**
     * Returns the current value
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Returns the type of the value
     *
     * @return string
     */
    public function getValueType()
    {
        return $this->type;
    }

}

// Endfile