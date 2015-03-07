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
 * The backtrace reflector
 */
class ReflectionBacktrace
    implements \Reflector
{

    /**
     * This class inherits from \Reflectors\ReflectorTrait
     * This class inherits from \Reflectors\ReadOnlyPropertiesTrait
     */
    use ReflectorTrait, ReadOnlyPropertiesTrait;

    protected static $_read_only = array(
        'traces'     => 'getTraces',
        'length'     => 'getLength',
        'raw_traces' => 'getRawTraces',
    );

    /**
     * @var array   The original raw backtrace array. Read-only, throws [ReflectionException](http://php.net/ReflectionException) in attempt to write.
     */
    protected $raw_traces;

    /**
     * @var array   The backtrace array with each item defined as a `\Reflectors\ReflectionTrace` object. Read-only, throws [ReflectionException](http://php.net/ReflectionException) in attempt to write.
     */
    protected $traces;

    /**
     * @var int   The backtrace length. Read-only, throws [ReflectionException](http://php.net/ReflectionException) in attempt to write.
     */
    protected $length;

    protected $limit;

    /**
     * Construct a backtrace reflection
     *
     * If the first parameter is not set, this will use the result of the [`debug_backtrace()`](http://php.net/debug_backtrace)
     * function to get current backtrace.
     *
     * @param   array   $traces
     * @param   int     $options    the first argument of the internal `debug_backtrace()` function
     * @param   int     $limit      the second argument of the internal `debug_backtrace()` function
     */
    public function __construct(array $traces = null, $options = DEBUG_BACKTRACE_PROVIDE_OBJECT, $limit = 0)
    {
        $this->setReadOnlyProperties($this::$_read_only);
        if (is_null($traces)) {
            $traces = debug_backtrace($options, $limit);
        }
        $this->limit        = $limit;
        $this->raw_traces   = $traces;
        $this->length       = count($this->traces);
    }

    /**
     * Returns the original backtrace array
     *
     * @return array
     */
    public function getRawTraces()
    {
        return $this->raw_traces;
    }

    /**
     * Returns the backtrace array with each item as a `\Reflectors\ReflectionTrace` object
     *
     * @return array
     */
    public function getTraces()
    {
        if (empty($this->traces)) {
            $this->traces = array();
            $counter = 1;
            foreach ($this->getRawTraces() as $i=>$trace) {
                if ($this->limit>0 && $counter>$this->limit) {
                    break;
                }
                $this->traces[$i] = new ReflectionTrace($trace);
                $counter++;
            }
        }
        return $this->traces;
    }

    /**
     * Returns the length of the backtrace (affected by the `$limit` argument if so)
     *
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Returns a specific trace of the backtrace table as a `\Reflectors\ReflectionTrace` object
     *
     * @param   int $index
     * @return  null|\Reflectors\ReflectionTrace
     */
    public function getTrace($index)
    {
        if (empty($this->traces) || !array_key_exists($index, $this->traces)) {
            return array_key_exists($index, $this->raw_traces) ?
                new ReflectionTrace($this->raw_traces[$index]) : null;
        }
        return isset($this->traces[$index]) ? $this->traces[$index] : null;
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
            $str = '';
            foreach ($this->getTraces() as $i=>$trace) {
                $str .= '#'.$i.' '.$trace->__toString().PHP_EOL;
            }
            return $str;
        } catch (\Exception $e) {
            return $e->__toString();
        }
    }

}

// Endfile