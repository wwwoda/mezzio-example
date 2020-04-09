<?php

require __DIR__ . '/../vendor/autoload.php';

// Password to be used for the user
$username = 'admin';
$password = '123456';

// Encrypt password
$encrypted_password = password_hash($password, PASSWORD_BCRYPT);

// Print line to be added to .htpasswd file
echo $username . ':' . $encrypted_password . "\n";
