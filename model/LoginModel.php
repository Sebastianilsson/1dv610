<?php

class LoginModel {
    private $username;
    private $password;
    private $loginView;
    private $databaseModel;

    public function __construct($layoutView, $loginView, $databaseModel) {
        $this->layoutView = $layoutView;
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
                    $this->loginView->addMessage('Password is missing');
                }
            } else {
                $this->loginView->addMessage('Username is missing');
            }
        }
    }
}