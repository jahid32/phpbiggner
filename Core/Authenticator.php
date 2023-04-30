<?php

namespace Core;

class Authenticator
{
    public function attempt($email, $password)
    {
        $user = App::resolve(Database::class)->query('SELECT * from users WHERE email=:email', ['email' => $email])->find();
        if($user) {
            if(password_verify($password, $user['password'])) {
                $this->login([
                  'email' => $email,
                  'id' => $user['id']
                ]);
                return true;
            }
        }
        return false;
    }
    public function login($user)
    {
        $_SESSION['logged_in'] = true;
        $_SESSION['user'] = ['email' => $user['email'], 'id' => $user['id']];
        session_regenerate_id(true);
    }

    public function logout()
    {
        Session::destroy();
    }
}
