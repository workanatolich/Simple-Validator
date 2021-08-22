<?php

class Validator {
    
    private static $rules = [
        'email' => '/[0-9a-z]+@[a-z]/',
        'id' => '/[0-9]/',
        'password' => '/(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{6,}/',
        'file_size' => 1000000,
        'file_types' => ['jpg', 'jpeg', 'png']
    ];
 
    public static function validate(array $data) {
        $keys = array_keys($data);
        $errors = 0;
        $error_keys = '';
        foreach($keys as $key) {
            if(!call_user_func("Validator". "::is_{$key}_valid", $data[$key])) {
                $errors += 1;
                $error_keys .= "$key,";
            };
        }

        $error_keys = rtrim($error_keys, ',');

        if($errors == 0) {
            return true;
        } else {
            self::display_errors($error_keys);
        }

    }

    public static function edit_rules(array $rules) {
        if(empty(array_diff_key($rules, self::$rules))) {
            $keys = array_keys($rules);
            foreach($keys as $key) {
                self::$rules[$key] = $rules[$key];
            }
        }
        if(isset($rules['file_types'])) {
            if(is_array($rules['file_types'])) {
                self::$rules['file_types'] = $rules['file_types'];
            }
        }

    }

    public static function display_rules() {
        echo '<pre>';
        var_dump(self::$rules);
        echo '</pre>';
    }

    public static function is_email_valid($email) {
        if(preg_match(self::$rules['email'], $email)) {
            return true;
        } else {
            return false;
        }
    }      

    public static function is_password_valid($password) {
        if(preg_match(self::$rules['password'], $password)) {
            return true;
        } else {
            return false;
        }
    }

    public static function is_id_valid($id) {
        if(preg_match(self::$rules['id'], $id)) {
            return true;
        } else {
            return false;
        }
    }
    
    public static function is_file_size_valid($size) {
        if($size < self::$rules['file_size'] && $size > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function is_file_type_valid($type) {
        if(in_array($type, self::$rules['file_types'])) {
            return true;
        } else {
            return false;
        }
    }

    private static function display_errors($error_keys) {
        echo 'The following fields are not valid: ' .$error_keys;
    }

}