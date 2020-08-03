<?php
namespace lib;

class Validate
{
    private $passed = false;
    private $errors = [];
    private $db = null;

    public function __construct()
    {
        $this->db = Db::getInstance();
    }
   
    public function check($input, $fields = [])
    {
        foreach ($fields as $field =>$rules) {
            foreach ($rules as $rule => $ruleValue) {
                $value = trim($input[$field]);

                // if empty other checks is useless
                if ($this->isRequired($rule, $value)) {
                    $this->addError("{$field} is required");
                } else {
                    $this->checkValue($rule, $value, $ruleValue, $field);
                }
            }
        }

        if (empty($this->getErrors())) {
            $this->passed = true;
        }

        return $this;
    }

    protected function checkValue($rule, $value, $ruleValue, $field)
    {
        switch ($rule) {
            case 'min':
                if ($this->isMin($value, $ruleValue)) {
                    $this->addError("{$field} must be a minimum of {$ruleValue} characters.");
                }
                break;
            case 'max':
                if (!$this->isMin($value, $ruleValue)) {
                    $this->addError("{$field} must be a maximum of {$ruleValue} characters.");
                }
                break;
            case 'unique':
                if (!$this->isUnique($value)) {
                    $this->addError("{$field} already exists");
                }
                break;
            case 'is_email':
                if (!$this->isMail($value)) {
                    $this->addError("{$field} must be a valid email address");
                }
        }
    }

    private function isRequired($rule, $value)
    {
        return ($rule === 'required' && empty($value)) ? true : false;
    }

    private function addError($error)
    {
        $this->errors[] = $error;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function isPassed()
    {
        return $this->passed;
    }

    protected function isMin($value, $ruleValue)
    {
        return (strLen($value) < $ruleValue) ? true : false;
    }

    protected function isUnique($value)
    {
        $check = $this->db->fetchAll("SELECT login FROM `users` WHERE login = :login", ['login'=>$value]);
        return ($this->db->rowCount()) ? false : true;
    }

    protected function isMail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) ? true : false;
    }
}
