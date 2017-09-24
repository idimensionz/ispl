<?php
/*
 * iDimensionz/{ispl}
 * Enum.php
 *  
 * The MIT License (MIT)
 * 
 * Copyright (c) 2017 Dimensionz
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
*/

/**
 * This class is like SplEnum class but in addition it allows an instance to not only store a value, but
 * set and new value and retrieve the value. It also adds functionality to determine if a value
 * is valid.
 */
namespace iDimensionz;

abstract class EnumAbstract
{
    const __default = null;

    /**
     * @var array
     */
    private $validValues;
    /**
     * @var mixed
     */
    private $value;

    public function __construct($value = self::__default)
    {
        // Valid values are the constants
        $reflectionClass = new \ReflectionClass($this);
        $validValues = $reflectionClass->getConstants();
        $this->setValidValues($validValues);

        $this->setValue($value);
    }

    /**
     * @return array
     */
    public function getValidValues(): array
    {
        return $this->validValues;
    }

    /**
     * @param array $values
     */
    private function setValidValues(array $values)
    {
        $this->validValues = $values;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function isValidValue($value): bool
    {
        return in_array($value, $this->getValidValues());
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @throws \UnexpectedValueException
     */
    public function setValue($value)
    {
        if (!$this->isValidValue($value)) {
            throw new \UnexpectedValueException(
                __METHOD__ . '/value parameter must be null or one of ' . implode(', ', $this->getValidValues())
            );
        }
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->getValue();
    }
}
