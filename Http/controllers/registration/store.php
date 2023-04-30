<?php

use Core\App;
use Core\Database;
use Core\Validator;
use Core\Authenticator;

$email = $_POST['email'];
$password = $_POST['password'];

// validation the form inputs
$errors = [];
if(!Validator::email($email)) {
    $errors['email'] = 'Please provide an valid email address';
}
if(!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Password must grater than 7 character';
}

if (! empty($errors)) {
    return view('registration/create.view.php', [
      'errors' => $errors
    ]);
}
$db = App::resolve(Database::class);
// check if the account already exists

$user = $db->query('SELECT * from users WHERE email=:email', ['email' => $email])->find();

// if yes redirect to a login page
if($user) {
    header('location: /');
    exit();
} else {
    // if no, save one to database, and then login the user in, and redirect
    $db->query('INSERT INTO users(email, password) VALUES (:email, :password)', [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    // mark that the user has logged in
    $auth = new Authenticator();
    $auth->attempt($email, $password);
    header('location: /');
    exit();
}
