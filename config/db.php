<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=localhost;dbname=pos', 
    'username' => 'postgres',
    'password' => '123123',
    'charset' => 'utf8',
    'schemaMap' => [
      'pgsql'=> [
        'class'=>'yii\db\pgsql\Schema',
        'defaultSchema' => 'public' //specify your schema here
      ]
    ],
];
