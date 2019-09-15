<?php

class RegisterController {
    public function __construct($layoutView, $registerView, $databaseModel) {
        $this->registerView = $registerView;
        $this->databaseModel = $databaseModel;
        $this->layoutView = $layoutView;
        $this->registerModel = new RegisterModel($this->registerView, $this->databaseModel);
    }

    public function newRegistration() {
        $this->layoutView->render(false, $this->registerView);
        $this->registerModel->getUserRegistrationInput();
        $this->registerModel->validateRegisterInputIfSubmitted();
        if ($this->registerModel->isValidationOk()) {
            $this->registerModel->hashPassword();
            $this->registerModel->saveUserToDatabase();
        }
    }
}