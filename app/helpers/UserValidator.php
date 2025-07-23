<?php

class UserValidator
{
    private $data;
    private $errors = [];

    public function __construct($post_data)
    {
        $this->data = $post_data;
    }

    public function validateForm()
    {
        if (isset($this->data['name'])) {
            $this->validateUserName();
        }

        if (isset($this->data['email'])) {
            $this->validateEmail();
        }

        if (isset($this->data['password'])) {
            $this->validatePassword();
        }

        return $this->errors;
    }

    private function validateUserName()
    {
        $val = trim($this->data['name'] ?? '');
        if (empty($val)) {
            $this->addError('name-err', 'User name can not be empty!');
        } else {
            $uppercase = preg_match('@[A-Z]@', $val);
            $lowercase = preg_match('@[a-z]@', $val);
            if (!$uppercase || !$lowercase || strlen($val) < 6 || strlen($val) > 25) {
                $this->addError('name-err', 'User name must be 6 to 25 characters and alphabetic!');
            }
        }
    }

    private function validateEmail()
    {
        $val = trim($this->data['email'] ?? '');
        if (empty($val)) {
            $this->addError('email-err', 'Email can not be empty!');
        } else if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
            $this->addError('email-err', 'Email must be a valid email!');
        }
    }

    private function validatePassword()
    {
        $password = trim($this->data['password'] ?? '');
        if (empty($password)) {
            $this->addError('password-err', 'Password can not be empty.');
        } else {
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number = preg_match('@[0-9]@', $password);
            $specialChars = preg_match('@[^\w]@', $password);
            if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
                $this->addError('password-err', 'Password should be at least 8 characters, include one upper case letter, one lower case letter, one number, and one special character.');
            }
        }
    }

    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }
}