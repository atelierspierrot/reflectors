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
 * Class ReflectionSource
 * @link    http://php.net/manual/class.reflector.php
 */
class ReflectionSource
    implements \Reflector
{

    /**
     * This class inherits from \Reflectors\ReflectorTrait
     */
    use ReflectorTrait;

    public static $default_context = array(
        'unified' => 3
    );

    protected $value;
    protected $lineno;
    protected $context;
    protected $source;
    protected $file_source;

    /**
     * @param   string  $value      The file path, which MUST exist
     * @param   null    $lineno     An optional line of the file to work around
     * @param   array   $context    A table with optional context info:
     *                                  - 'unified' is the number of lines taken around concerned one (default is 3)
     *                                  - 'function' can be concerned function name, to increase unified if necessary
     *
     * @throws \ReflectionException if the `$value` parameter is not a string
     * @throws \ReflectionException if the file does not exist
     */
    public function __construct($value, $lineno = null, array $context = null)
    {
        if (!is_string($value)) {
            throw new \ReflectionException(
                sprintf(__METHOD__.' expects parameter one to be string, %s given', gettype($value))
            );
        }
        if (!file_exists($value)) {
            throw new \ReflectionException(
                sprintf(__METHOD__.' expects parameter one to be a valid file path, %s given: No such file or directory', $value)
            );
        }
        $this->value        = $value;
        $this->lineno       = $lineno;
        $this->context      = self::$default_context;
        if (!empty($context)) {
            $this->context  = array_merge($this->context, $context);
        }
    }

    /**
     * Returns the path of concerned file (alias of `self::getValue()`)
     *
     * @return string
     */
    public function getPath()
    {
        return $this->getValue();
    }

    /**
     * Returns the path of concerned file
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Returns the concerned line number (if defined)
     *
     * @return int|null
     */
    public function getLineNo()
    {
        return $this->lineno;
    }

    /**
     * Returns the context or one of its items
     *
     * @param   null    $item
     * @return  array|mixed
     */
    public function getContext($item = null)
    {
        if (is_null($item)) {
            return $this->context;
        } else {
            return array_key_exists($item, $this->context) ? $this->context[$item] : null;
        }
    }

    /**
     * Get the source code of the file in a line-by-line array
     *
     * The keys of the items are the line numbers, and a special `on` key
     * is used if a `line` exists in the trace.
     *
     * @return mixed
     */
    public function getSource()
    {
        if (empty($this->source)) {
            $lines      = $this->_getFileSource();
            $lineno     = $this->getLineNo();
            $unified    = $this->getContext('unified');
            $fct        = $this->getContext('function');

            if (!empty($lineno)) {
                $start  = $lineno < $unified ? 0 : $lineno - $unified;
                $end    = $lineno + $unified;
            } else {
                $start  = 0;
                $end    = count($lines);
            }

            foreach ($lines as $k=>$_line) {
                if ($k>$end ) { break; }
                if (
                    $k<$start && !empty($fct) &&
                    preg_match('/function( )*'.preg_quote($fct).'[ |\(]/', $_line)
                ) {
                    $start = $k;
                }
            }

            for ($i=$start; $i<=$end; $i++) {
                $this->source[$i] = $lines[$i - 1];
            }
            if (!empty($lineno) && isset($this->source[$lineno])) {
                $this->source['on'] = $this->source[$lineno];
            }

        }
        return $this->source;
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
            $str    = '';
            $lines  = $this->getSource();
            foreach ($lines as $i=>$line) {
                if (!is_string($i)) {
                    if (array_key_exists('on', $lines) && $lines['on']==$line) {
                        $str .= '* '.$line.PHP_EOL;
                    } else {
                        $str .= '  '.$line.PHP_EOL;
                    }
                }
            }
            if (array_key_exists('on', $lines)) {
                unset($lines['on']);
            }

            $intro = 'Source from file [ '.$this->getPath().' ] ';
            $line = $this->getLineNo();
            if (!empty($line)) {
                $intro .= 'at line [ '.$line.' ] ';
            }

            $lines_info = '@@ '.$this->getPath().' '.min(array_keys($lines)).' - '.max(array_keys($lines));
            return $intro.PHP_EOL.$lines_info.PHP_EOL.$str;
        } catch (\Exception $e) {
            return $e->__toString();
        }
    }

    protected function _getFileSource()
    {
        if (empty($this->file_source)) {
            $this->file_source = file($this->getPath(), FILE_USE_INCLUDE_PATH | FILE_IGNORE_NEW_LINES);
        }
        return $this->file_source;
    }

}

// Endfile