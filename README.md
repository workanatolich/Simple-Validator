# Simple-Validator

## Installation

### Connect the file "Router.php"

```php
require 'Validator/Validator.php';
```

## Usage

### Data checking

```php
Validator::validate(array $data);
```
You can check email, password, id, max_file_size, file_type.

### Check data separately
```php
Validator::is_email_valid($email);
Validator::is_password_valid($password);
Validator::is_id_valid($id);
Validator::is_file_size_valid($file_size);
Validator::is_file_type_valid($file_type);
```

### Display all rules 
```php
Validator::display_rules();
```

### Edit the rules 
If you want to change the rules, follow the example.

```php
Validator::edit_rules([
    'email' => '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',
    'file_size' => 100000,
    'file_types' => ['png', 'jpg']
]);
```