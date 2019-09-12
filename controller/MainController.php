<?php

class MainController {

    public function __construct() {
        $this->loginView = new LoginView();
        $this->dateTimeView = new DateTimeView();
        $this->layoutView = new LayoutView();
        $this->registerView = new RegisterView();
    }

    public function router() {
        if ($this->registerView->isRegisterSet()) {
            echo $this->registerView->renderRegistrationForm();
        } else {
            $this->layoutView->render(false, $this->loginView, $this->dateTimeView);
        }
    }

}