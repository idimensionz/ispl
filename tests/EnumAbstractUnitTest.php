<?php
/*
 * iDimensionz/{ispl}
 * EnumUnitTest.php
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

namespace iDimensionz\Tests;

use iDimensionz\EnumAbstract;
use PHPUnit\Framework\TestCase;

class EnumAbstractUnitTest extends TestCase
{
    /**
     * @var EnumAbstractTestStub
     */
    private $enum;

    public function setUp()
    {
        parent::setUp();
        $this->hasEnum();
    }

    public function tearDown()
    {
        unset($this->enum);
        parent::tearDown();
    }

    public function testGetValidValuesReturnsConstantValues()
    {
        $reflectionClass = new \ReflectionClass('\iDimensionz\Tests\EnumAbstractTestStub');
        $expectedValues = $reflectionClass->getConstants();
        $actualValues = $this->enum->getValidValues();
        $this->assertEquals($expectedValues, $actualValues);
    }

    public function testIsValidValueReturnsTrueWhenValueIsOneOfTheConstantValues()
    {
        $actualValue = $this->enum->isValidValue(EnumAbstractTestStub::DAY_SUNDAY);
        $this->assertTrue($actualValue);
    }

    public function testIsValidValueReturnsFalseWhenValueIsNotOneOfTheConstanctValues()
    {
        $actualValue = $this->enum->isValidValue('Not a valid value');
        $this->assertFalse($actualValue);
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testSetValueThrowsExceptionWhenValueIsInvalid()
    {
        $this->enum->setValue('Not a valid value');
    }

    public function testValueGetterAndSetter()
    {
        $expectedValue = EnumAbstractTestStub::DAY_TUESDAY;
        $this->enum->setValue($expectedValue);
        $actualValue = $this->enum->getValue();
        $this->assertEquals($expectedValue, $actualValue);
    }

    public function testToStringReturnsStringValue()
    {
        $expectedValue = EnumAbstractTestStub::DAY_SUNDAY;
        $this->enum->setValue(EnumAbstractTestStub::DAY_SUNDAY);
        $actualValue = (string)$this->enum;
        $this->assertTrue(is_string($actualValue));
        $this->assertEquals($expectedValue, $actualValue);
    }

    public function hasEnum()
    {
        $this->enum = new EnumAbstractTestStub(EnumAbstractTestStub::DAY_SUNDAY);
    }
}
