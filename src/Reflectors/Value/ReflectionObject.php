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
use \Reflectors\AbstractReflectionValueProxy;

/**
 * The [object](http://php.net/object) value reflector
 *
 * @author  piwi <me@e-piwi.fr>
 */
class ReflectionObject
    extends AbstractReflectionValueProxy
{

    /**
     * @var string The proxy will be an instance of `\ReflectionObject`
     */
    protected static $proxy_class = 'ReflectionObject';

    /**
     * @param   object  $value
     * @param   int     $flag   A flag used by the `ValueType::getType()` method (not used here)
     */
    public function __construct($value, $flag = ValueType::MODE_STRICT)
    {
        parent::__construct($value, $flag);
        $this->setReadOnlyProperties($this::$_read_only);
        $this->type     = ValueType::TYPE_OBJECT;
        $this->value    = $value;
    }

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
            return $this->getProxy()->__toString();
        } catch (\Exception $e) {
            return $e->__toString();
        }
    }

}

// Endfile