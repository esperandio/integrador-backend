<?php

require './vendor/autoload.php';

use App\Entities\{User, Group, AdminRole};

$group = Group::create('teste', 1000, new AdminRole());
$user = User::create('teste@teste.com', '123ABCabc', $group);

echo "<pre>";
var_dump($user);
var_dump($group);