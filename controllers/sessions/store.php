<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

// validation the form inputs
$errors = [];
if(!Validator::email($email)) {
    $errors['email'] = 'Please provide an valid email address';
}

if(!Validator::string($password)) {
    $errors['password'] = 'Please provide a valid password';
}

if (! empty($errors)) {
    return view('sessions/create.view.php', [
      'errors' => $errors
    ]);
}

// check if the account already exists

$user = $db->query('SELECT * from users WHERE email=:email', ['email' => $email])->find();



// if yes redirect to a login page
if(!$user) {
    return view('sessions/create.view.php', [
      'errors' => [
          'email' => 'No matching account found with this email'
          ]
      ]);
}

if(password_verify($password, $user['password'])) {

    login([
        'email' => $email,
        'id' => $user['id']
    ]);
    header('location: /');
    exit();
}

return view('sessions/create.view.php', [
  'errors' => [
      'password' => 'Password Not Match'
      ]
  ]);
