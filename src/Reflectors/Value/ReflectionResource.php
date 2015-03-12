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
 * The [resource](http://php.net/resource) value reflector
 *
 * @author  piwi <me@e-piwi.fr>
 */
class ReflectionResource
    extends AbstractReflectionValue
{

    protected static $_read_only = array(
        'value'         => 'getValue',
        'type'          => 'getValueType',
        'resource_type' => 'getResourceType',
    );

    /**
     * @var int   The resource type. Read-only, throws [ReflectionException](http://php.net/ReflectionException) in attempt to write.
     */
    protected $resource_type;

    /**
     * @param   resource $value
     * @param   int      $flag   A flag used by the `ValueType::getType()` method (not used here)
     * @throws  \ReflectionException if the parameter is not a resource
     */
    public function __construct($value, $flag = ValueType::MODE_STRICT)
    {
        if (!ValueType::isResource($value)) {
            throw new \ReflectionException(
                sprintf(__METHOD__.' expects parameter one to be resource, %s given', gettype($value))
            );
        }
        $this->setReadOnlyProperties($this::$_read_only);
        $this->type             = ValueType::TYPE_RESOURCE;
        $this->value            = $value;
        $this->resource_type    = get_resource_type($value);
    }

    /**
     * Returns the type of the resource (<http://php.net/get_resource_type>)
     *
     * @return  string
     */
    public function getResourceType()
    {
        return $this->resource_type;
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
            return 'Resource of type <'.$this->getResourceType().'> [ '.@var_export($this->getValue(),1).' ]';
        } catch (\Exception $e) {
            return $e->__toString();
        }
    }

}

// Endfile