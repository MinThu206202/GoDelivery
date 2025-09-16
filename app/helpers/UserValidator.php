<?php

class UserValidator
{
    private $data;
    private $errors = [];
    private static $fields = ['name', 'email', 'password', 'phonenumber'];

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
        if (isset($this->data['phonenumber'])) {
            $this->validatePhoneNumber();
        }

        return $this->errors;
    }

    private function validateUserName()
    {
        $val = trim($this->data['name'] ?? '');

        if (empty($val)) {
            $this->addError('name-err', 'User name can not be empty !');
        } elseif (!(preg_match('@[A-Z]@', $val) && preg_match('@[a-z]@', $val))) {
            $this->addError('name-err', 'User name must be 6 to 25 chars & alphabetic !');
        }
    }

    private function validateEmail()
    {
        $val = trim($this->data['email'] ?? '');
        if (empty($val)) {
            $this->addError('email-err', 'Email can not be empty!');
        } elseif (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
            $this->addError('email-err', 'Email must be a valid email!');
        }
    }

    private function validatePassword()
    {
        $password = trim($this->data['password'] ?? '');

        if (empty($password)) {
            $this->addError('password-err', 'Password can not be empty.');
        } elseif (
            !preg_match('@[A-Z]@', $password) ||
            !preg_match('@[a-z]@', $password) ||
            !preg_match('@[0-9]@', $password) ||
            !preg_match('@[^\w]@', $password) ||
            strlen($password) < 8
        ) {
            $this->addError('password-err', 'Password should be at least 8 characters, one upper, one lower, one number, and one special character.');
        }
    }

    private function validatePhoneNumber()
    {
        $phone = trim($this->data['phonenumber'] ?? '');
        $validPrefixes = ['097', '098', '096', '092'];

        if (empty($phone)) {
            $this->addError('phone-err', 'Phone number can not be empty!');
        } elseif (!preg_match('/^(097|098|096|092|094)\d{6,13}$/', $phone)) {
            $this->addError('phone-err', 'Phone number must start with 097, 098, 096, or 092 and be 8-9 digits long.');
        }
    }

    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }
}