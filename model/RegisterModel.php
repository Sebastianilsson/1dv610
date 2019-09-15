<?php

class RegisterModel {
    private $username;
    private $password;
    private $passwordRepeat;
    private $registerView;
    private $databaseModel;
    private $validationOk = false;

    public function __construct($registerView, $databaseModel) {
        $this->registerView = $registerView;
        $this->databaseModel = $databaseModel;
    }

    public function getUserRegistrationInput() {
        $this->username = $this->registerView->getUsername();
        $this->password = $this->registerView->getPassword();
        $this->passwordRepeat = $this->registerView->getRepeatedPassword();
    }

    public function validateRegisterInputIfSubmitted() {
        if ($this->registerView->isRegisterFormSubmitted()) {
            if ($this->checkForInputInAllFields()) {
                if ($this->validateUsername()) {
                    if ($this->validatePassword()) {
                        $this->validationOk = true;
                    }
                }
            }
        }
    }

    private function checkForInputInAllFields() {
        if ($this->username != "" && $this->password != "" && $this->passwordRepeat != "") {
            return true;
        } else {
            echo "nope....";
        }
    }

    private function validateUsername() {
        if ($this->isUsernameCorrectFormat()) {
            if ($this->isUsernameUnique()) {
                return true;
            } else {
                $this->registerView->setRegisterMessage('User exists, pick another username.');
            }
        } else {
            $this->registerView->setRegisterMessage('Username has too few characters, at least 3 characters.');
        }
    }

    private function isUsernameUnique() {
        return $this->databaseModel->checkIfUsernameIsFree($this->username);
    }

    private function isUsernameCorrectFormat() {
        return preg_match("/([a-zA-Z0-9]){3,}/", $this->username);
    }

    private function validatePassword() {
        if (strlen($this->password) >= 6) {
            if ($this->checkIfPasswordsMatch()) {
                return true;
            } else {
                $this->registerView->setRegisterMessage('Passwords do not match.');
            }
        } else {
            $this->registerView->setRegisterMessage('Password has too few characters, at least 6 characters.');
        }
    }

    private function checkIfPasswordsMatch() {
        if ($this->password == $this->passwordRepeat) {
            return true;
        } else {
            return false;
        }
    }

    public function isValidationOk() {
        return $this->validationOk;
    }

    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    public function saveUserToDatabase() {
        $this->databaseModel->saveUserToDatabase($this->username, $this->password);
    }
}