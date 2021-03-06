<?php
/**
 * This file is part of the Reflectors package.
 *
 * Copyright (c) 2015-2016 Pierre Cassat <me@e-piwi.fr> and contributors
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
 * The [NULL](http://php.net/null) value reflector
 *
 * @author  piwi <me@e-piwi.fr>
 */
class ReflectionNull
    extends AbstractReflectionValue
{

    /**
     * @param   null    $value
     * @param   int     $flag   A flag used by the `ValueType::getType()` method (not used here)
     * @throws  \ReflectionException if the parameter is not null
     */
    public function __construct($value, $flag = ValueType::MODE_STRICT)
    {
        if (!ValueType::isNull($value)) {
            throw new \ReflectionException(
                sprintf(__METHOD__.' expects parameter one to be NULL, %s given', gettype($value))
            );
        }
        $this->setReadOnlyProperties($this::$_read_only);
        $this->type     = ValueType::TYPE_NULL;
        $this->value    = $value;
    }

    /**
     * Representation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return 'Null value';
    }
}
