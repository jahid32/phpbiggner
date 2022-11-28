<?php

require 'function.php';

require 'Database.php';


class Age {
  private $age;

  public function __construct($age)
  {
    if($age < 0 || $age > 120){
      throw new InvalidArgumentException(' That maks no sence');
    }
    $this->age = $age;
  }
}

function register(string $name, Age $age)
{
  
}

register('Jone Doe', new Age(30));

require 'router.php';