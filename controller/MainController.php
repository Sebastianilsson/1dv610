<?php

class MainController {

    public function __construct() {
        $this->loginView = new LoginView();
        $this->dateTimeView = new DateTimeView();
        $this->layoutView = new LayoutView();
        $this->registerView = new RegisterView();
        $this->registerController = new RegisterController($this->registerView);
    }

    public function router() {
        if ($this->registerView->isRegisterSet()) {
            $this->registerController->newRegistration();
        } else {
            $this->layoutView->render(false, $this->loginView, $this->dateTimeView);
        }
    }

}