<?php

class RegisterModel {
    private $username;
    private $password;
    private $passwordRepeat;
    private $databaseConnection;

    public function __construct($databaseConnection) {
        $this->databaseConnection = $databaseConnection;
    }
}