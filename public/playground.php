<?php

use Illuminate\Support\Collection;

require __DIR__ . '/../vendor/autoload.php';

$number = new Collection([1, 2, 3, 4, 5,  6, 7, 8, 9, 10]);

die(var_dump($number));
