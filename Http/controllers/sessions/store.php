<?php

use Core\Session;
use Core\Authenticator;
use Http\Forms\LoginForm;
use Core\ValidationException;

$email = $_POST['email'];
$password = $_POST['password'];


$form = LoginForm::validate(['email' => $email, 'password' => $password]);

$signedIn = (new Authenticator())->attempt($email, $password);


if(!$signedIn) {
    $form->error('email', 'No matching account for that email address and password')->throw();
}

redirect('/');
