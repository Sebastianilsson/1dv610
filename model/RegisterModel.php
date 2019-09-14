<?php

class RegisterModel {
    private $username;
    private $password;
    private $passwordRepeat;
    private $registerView;
    private $databaseConnection;

    public function __construct($registerView) {
        $this->registerView = $registerView;
        // $this->databaseConnection = $databaseConnection;
    }

    public function getUserRegistrationInput() {
        $this->username = $this->registerView->getUsername();
        $this->password = $this->registerView->getPassword();
        $this->passwordRepeat = $this->registerView->getPasswordRepeat();
    }

    public function validateRegisterInput() {

    }
}