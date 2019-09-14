<?php

class RegisterController {
    public function __construct($registerView, $databaseModel) {
        $this->registerView = $registerView;
        $this->databaseModel = $databaseModel;
        $this->registerModel = new RegisterModel($this->registerView, $this->databaseModel);
    }

    public function newRegistration() {
        $this->showRegistrationForm();
        $this->registerModel->getUserRegistrationInput();
        $this->registerModel->validateRegisterInputIfSubmitted();
        if ($this->registerModel->isValidationOk()) {
            $this->registerModel->hashPassword();
            $this->registerModel->saveUserToDatabase();
        }
    }

    private function showRegistrationForm() {
        echo $this->registerView->renderRegistrationForm();
    }
}