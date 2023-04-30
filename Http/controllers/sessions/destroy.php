<?php

use Core\App;
use Core\Authenticator;

// log user out
App::resolve(Authenticator::class)->logout();

header('location: /');
exit();
