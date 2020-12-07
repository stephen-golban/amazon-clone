<?php

class Validate
{
    private $_passed = false,
        $_errors = array(),
        $_db = null;

    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    public function check($source, $items = array())
    {
        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {
                $value = trim($source[$item]);
                $item = escape($item);
                if ($rule === 'required' && empty($value)) {
                    $this->addError("{$item} is required!");
                } else if (!empty($value)) {
                    switch ($rule) {
                        case 'min':
                            if (strlen($value) < $rule_value) {
                                $this->addError("{$item} must be a minimum of {$rule_value} characters!");
                            }
                            break;
                        case 'max':
                            if (strlen($value) > $rule_value) {
                                $this->addError("{$item} must be a maximum of {$rule_value} characters!");
                            }
                            break;
                        case 'numbers':
                            if (!ctype_alpha($value)) {
                                $this->addError("{$item} must contain only letters!");
                            }
                            break;
                        case 'unique':
                            $check = $this->_db->get($rule_value, array($item, '=', $value));
                            if ($check->count()) {
                                $this->addError("{$item} is already registered!");
                            }
                            break;
                        case 'mustBeEmail':
                            if (!strpos($value, '@')) {
                                $this->addError("Invalid {$item} format!");
                            }
                            break;
                        case 'matches':
                            if ($value != $source[$rule_value]) {
                                $this->addError("Your passwords do not match!");
                            }
                            break;
                        case 'capital':
                            if (!ctype_upper($value[0])) {
                                $this->addError("First letter of your {$item} must be capital!");
                            }
                            break;
                        case 'same':
                            if ($value == $source[$rule_value]) {
                                $this->addError("Your new password must be different than your current password!");
                            }
                            break;
                        case 'same-name':
                            if ($value == $source[$rule_value]) {
                                $this->addError("Your new name must be different than your current one!");
                            }
                            break;
                        case 'noLetters':
                            if (!filter_var(
                                $value,
                                FILTER_SANITIZE_NUMBER_FLOAT,
                                FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND
                            )) {
                                $this->addError("The {$item} field must contain only numbers and special characters[ , . ]!");
                            }
                            break;
                    }
                }
            }
        }
        if (empty($this->_errors)) {
            $this->_passed = true;
        }
        return $this;
    }

    private function addError($error)
    {
        $this->_errors[] = $error;
    }
    public function errors()
    {
        return $this->_errors;
    }
    public function passed()
    {
        return $this->_passed;
    }
}
