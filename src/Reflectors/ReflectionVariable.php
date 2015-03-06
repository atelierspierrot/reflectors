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
 * Class ReflectionVariable
 */
class ReflectionVariable
    implements ReflectionVariableInterface
{

    /**
     * This class inherits from \Reflectors\ReflectorTrait
     */
    use ReflectorTrait;

    protected $object;

    /**
     * @param   mixed   $value
     */
    public function __construct($value)
    {
        switch (gettype($value)) {
            case 'NULL':
                $this->object = new ReflectionValueNull($value);
                break;
            case 'boolean':
                $this->object = new ReflectionBoolean($value);
                break;
            case 'integer':
                $this->object = new ReflectionInteger($value);
                break;
            case 'double':
            case 'float':
                $this->object = new ReflectionFloat($value);
                break;
            case 'string':
                $this->object = new ReflectionString($value);
                break;
            case 'array':
                $this->object = new ReflectionArray($value);
                break;
            case 'object':
                $this->object = new \ReflectionObject($value);
                break;
            case 'resource':
                $this->object = new ReflectionResource($value);
                break;
            default:
                $this->object = new ReflectionValueUnknown($value);
                break;
        }
    }

    /**
     * Returns the variable reflector
     *
     * @return  mixed
     */
    public function getVariable()
    {
        return $this->object;
    }

    /**
     * Returns the variable's value from the reflector
     *
     * @return  mixed
     */
    public function getValue()
    {
        return $this->getVariable()->getValue();
    }

    /**
     * Returns the variable's type from the reflector
     *
     * @return  string
     */
    public function getValueType()
    {
        return $this->getVariable()->getValueType();
    }

    /**
     * Representation of the object
     *
     * If an exception is caught, its message is returned instead of the
     * original result (but its not thrown ahead).
     *
     * @return string
     */
    public function __toString()
    {
        try {
            $str = $this->getVariable()->__toString();
            return $str;
        } catch (\Exception $e) {
            return $e->__toString();
        }
    }

}

// Endfile