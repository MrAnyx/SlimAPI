<?php

use Illuminate\Database\ConnectionResolver;
use Illuminate\Database\Connectors\ConnectionFactory;
use Illuminate\Database\Eloquent\Model;

$settings = array(
   'driver' => 'mysql',
   'host' => '127.0.0.1',
   'database' => 'slimAPI',
   'username' => 'user',
   'password' => 'password',
   'collation' => 'utf8_general_ci',
   'prefix' => ''
);

// Bootstrap Eloquent ORM
$connFactory = new ConnectionFactory();
$conn = $connFactory->make($settings);
$resolver = new ConnectionResolver();
$resolver->addConnection('default', $conn);
$resolver->setDefaultConnection('default');
Model::setConnectionResolver($resolver);