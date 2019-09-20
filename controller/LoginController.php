<?php

class LoginController {
    public function __construct($layoutView, $loginView, $databaseModel) {
        $this->layoutView = $layoutView;
        $this->loginView = $loginView;
        $this->databaseModel = $databaseModel;
        $this->loginModel = new LoginModel($this->layoutView, $this->loginView, $this->databaseModel);
        session_start();
    }

    public function newLogin() {
        $this->loginModel->getUserLoginInput();
        $this->loginView->setUsernameValue($this->loginView->getUsername());
        if ($this->loginModel->validateLoginInputIfSubmitted()) {
            if ($this->loginModel->checkIfCredentialsMatchInDatabase()) {
                $this->loginView->setIsLoggedIn(true);
                $_SESSION['loggedIn'] = true;
                $this->loginView->addMessage('Welcome');
                $this->layoutView->render(true, $this->loginView);
            } else {
                $this->loginView->addMessage('Wrong name or password');
                $this->layoutView->render(false, $this->loginView);
            }
        } else {
            $this->layoutView->render(false, $this->loginView);
        }
    }

    public function logout() {
        if($_SESSION['loggedIn']) {
            session_destroy();
            session_unset($_SESSION);
            $this->loginView->addMessage('Bye bye!');
            $this->loginView->setIsLoggedIn(false);
            $_SESSION['loggedIn'] = false;
            $this->layoutView->render(false, $this->loginView);
        } else {
            $this->layoutView->render(false, $this->loginView);
        }
    }
}