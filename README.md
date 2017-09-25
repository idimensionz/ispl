# iSPL
iDimensionz's Standard PHP Library

Library containing custom classes.

[![Code Climate](https://codeclimate.com/github/idimensionz/ispl/badges/gpa.svg)](https://codeclimate.com/github/idimensionz/ispl)
[![Test Coverage](https://codeclimate.com/github/idimensionz/ispl/badges/coverage.svg)](https://codeclimate.com/github/idimensionz/ispl/coverage)

**Enum** (_EnumAbstract_)

Class to emulate enumerated fields (i.e. fields that may only specific values).
The specific values are declared as constants in the child class.
The parent class provides functions for interacting with the enum:
* _getValidValues()_: returns an array of valid values.
* _isValidValue($value)__: returns true or false to indicate if the value is one of the valid values for this enum.
* _setValue($value)_, _getValue_: Getter and setter for the field value.
* The parent class provides the ability to type-cast the child class as a string to get the value as a string. 
