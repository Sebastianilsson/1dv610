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
            if ($this->usernameInputExists()) {
                if ($this->passwordInputExists()) {
                    if ($this->isUsernameCorrectFormat()) {
                        return true;
                    } else {
                        $this->loginView->setUsernameValue(strip_tags($this->username));
                        $this->loginView->addMessage('Username contains invalid characters.');
                    }
                }
            }
        }
    }

    public function checkIfCredentialsMatchInDatabase() {
        //ONE FUNC WITH IS USERNAME FREE??
        if ($this->databaseModel->usernameExistsInDatabase($this->username)) {
            if ($this->databaseModel->userPasswordMatch($this->username, $this->password)) {
                $this->loginView->setIsLoggedIn(true);
                return true;
            } else {
                $this->loginView-addMessage('Wrong name or password');
            }
        }
        
    }

    private function usernameInputExists() {
        if ($this->username != "") {
            return true;
        } else {
            $this->loginView->addMessage('Username is missing');
        }
    }

    private function passwordInputExists() {
        if ($this->password != "") {
            return true;
        } else {
            $this->loginView->addMessage('Password is missing');
        }
    }

    private function isUsernameCorrectFormat() {
        if (preg_match_all("/[^a-zA-Z0-9]/", $this->username) > 0) {
            return false;
        } else {
            return true;
        }
    }
}