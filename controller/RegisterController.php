<?php

class RegisterController {
    public function __construct($registerView) {
        $this->registerView = $registerView;
        $this->registerModel = new RegisterModel($this->registerView);
    }

    public function newRegistration() {
        $this->showRegistrationForm();
        $this->registerModel->getUserRegistrationInput();
    }

    private function showRegistrationForm() {
        echo $this->registerView->renderRegistrationForm();
    }
}