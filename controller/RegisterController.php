<?php

class RegisterController {
    public function __construct($layoutView, $registerView, $loginView, $databaseModel) {
        $this->registerView = $registerView;
        $this->databaseModel = $databaseModel;
        $this->loginView = $loginView;
        $this->layoutView = $layoutView;
        $this->registerModel = new RegisterModel($this->registerView, $this->databaseModel);
    }

    public function newRegistration() {
        // $this->layoutView->render(false, $this->registerView);
        $this->registerModel->getUserRegistrationInput();
        $this->registerView->setUsernameValue($this->registerView->getUsername());
        $this->registerModel->validateRegisterInputIfSubmitted();
        if ($this->registerModel->isValidationOk()) {
            $this->registerModel->hashPassword();
            $this->registerModel->saveUserToDatabase();
            //MOVEs
            $this->loginView->setUsernameValue($this->registerView->getUsername());
            $this->loginView->addMessage("Registered new user.");
            $this->layoutView->render(false, $this->loginView);
        } else {
            $this->layoutView->render(false, $this->registerView);
        }
        
    }
}