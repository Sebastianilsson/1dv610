<?php

class RegisterModel {
    private $username;
    private $password;
    private $passwordRepeat;
    private $registerView;
    private $databaseConnection;
    private $validationOk = false;

    public function __construct($registerView) {
        $this->registerView = $registerView;
        // $this->databaseConnection = $databaseConnection;
    }

    public function getUserRegistrationInput() {
        $this->username = $this->registerView->getUsername();
        $this->password = $this->registerView->getPassword();
        $this->passwordRepeat = $this->registerView->getRepeatedPassword();
    }

    public function validateRegisterInputIfSubmitted() {
        if ($this->registerView->isRegisterFormSubmitted()) {
            if ($this->checkForInputInAllFields()) {
                if ($this->checkIfUsernameIsUnique()) {
                    if ($this->checkIfPasswordsMatch()) {
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

    private function checkIfUsernameIsUnique() {
        return true;
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
}