<?php

class LoginModel {
    private $username;
    private $password;
    private $loginView;
    private $databaseModel;

    public function __construct($loginView, $databaseModel) {
        $this->loginView = $loginView;
        $this->databaseModel = $databaseModel;
    }

    public function getUserLoginInput() {
        $this->username = $this->loginView->getUsername();
        $this->password = $this->loginView->getPassword();
    }

    public function validateLoginInputIfSubmitted() {
        if ($this->loginView->isLoginFormSubmitted()) {
            if ($this->username != "") {
                if ($this->password != "") {
                    return true;
                } else {
    
                }
            } else {
                $this->loginView->addMessage('Username is missing');
            }
        }
    }
}