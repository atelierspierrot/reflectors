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
 * The "unknown" typed value reflector
 */
class ReflectionUnknown
    extends AbstractReflectionValue
{

    /**
     * @param   ?       $value
     * @param   int     $flag   A flag used by the `ValueType::getType()` method (not used here)
     */
    public function __construct($value, $flag = ValueType::MODE_STRICT)
    {
        $this->setReadOnlyProperties($this::$_read_only);
        $this->type     = ValueType::TYPE_UNKNOWN;
        $this->value    = $value;
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
            return 'Unknown type variable [ ' . @var_export($this->value, 1) . ' ]';
        } catch (\Exception $e) {
            return $e->__toString();
        }
    }

}

// Endfile