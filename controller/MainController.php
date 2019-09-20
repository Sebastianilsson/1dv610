<?php

class MainController {

    public function __construct() {
        $this->databaseModel = new DatabaseModel();
        $this->loginView = new LoginView();
        $this->dateTimeView = new DateTimeView();
        $this->layoutView = new LayoutView($this->dateTimeView);
        $this->registerView = new RegisterView();
        $this->registerController = new RegisterController($this->layoutView, $this->registerView, $this->loginView, $this->databaseModel);
        $this->loginController = new LoginController($this->layoutView, $this->loginView, $this->databaseModel);
    }

    public function router() {
        if ($this->registerView->isRegisterSet()) {
            $this->registerController->newRegistration();
        } elseif ($this->loginView->isLoginRequested()) {
            $this->loginController->newLogin();
        } elseif ($this->loginView->isLoggedOutRequested()) {
            $this->loginController->logout();
        } else {
            header("LOCATION: /index.php");
            $this->layoutView->render($this->loginView->getIsLoggedIn(), $this->loginView);
        }
    }

}