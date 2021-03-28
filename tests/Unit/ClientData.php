<?php

namespace Tests\Unit;

class ClientData {

    public function __construct(){}

    public function getData(): Array
    {
        return [
            'grant_type' => 'password',
            'client_id' => 3, // client id frontend application
            'client_secret' => '3OStvYtflAnsZQd2ZKBePEilXHoNvbUfRsnO0Sjm', // secret frontend application
            'username' => 'fabio@gmail.com', // seedered user
            'password' => 'admin',
            'scope' => ''
        ];
    }
}
