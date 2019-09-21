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
        if ($this->loginView->isLoginFormSubmitted()) {
            $this->loginController->newLogin();
        } elseif ($this->loginView->isLoggedOutRequested()) {
            $this->loginController->logout();
        } elseif (isset($_SESSION['isLoggedIn'])) {
            $this->loginView->setIsLoggedIn(true);
            $this->layoutView->render(true, $this->loginView);
        } elseif(isset($_COOKIE['LoginView::CookieName'])) {
            $this->loginController->loginWithCookies();
        } elseif ($this->registerView->isRegisterFormRequested()) {
            $this->registerController->newRegistration();
        } else {
            $this->layoutView->render(false, $this->loginView);
        }
    }

}