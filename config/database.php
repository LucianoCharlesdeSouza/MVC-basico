<?php

return [
    /*
           | ------------------------------------------------- -------------------------
           | Status do aplicativo
           | ------------------------------------------------- -------------------------
           | development/production
           |
           | Aqui estão as configurações de conexões de banco de dados para seu aplicativo.
           | Assim sera recuperado os dados de acesso ao banco de dados
           | conforme o indice environment.
           |
           */
    'environment' => environment('environment'),
    /*
           | ------------------------------------------------- -------------------------
           | Conexões de banco de dados
           | ------------------------------------------------- -------------------------
           |
           | Aqui estão as configurações de conexões de banco de dados para seu aplicativo.
           |
           | Portanto, verifique se você tem o driver para o banco de dados
           | instalado em sua máquina antes de começar o desenvolvimento.
           |
           */
    'connections' => [
        'development' => [
            'host' => 'localhost',
            'port' => 3306,
            'database' => 'grupo++',
            'username' => 'root',
            'password' => '',
            'unix_socket' => null,
            'options' => [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ],
            'errmode' => PDO::ERRMODE_EXCEPTION,
            'fetch_mode' => PDO::FETCH_OBJ
        ],
        'production' => [
            'host' => 'localhost',
            'port' => 3306,
            'database' => 'grupo++',
            'username' => 'root',
            'password' => '',
            'unix_socket' => null,
            'options' => [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ],
            'errmode' => PDO::ERRMODE_EXCEPTION,
            'fetch_mode' => PDO::FETCH_OBJ
        ]
    ]
];

