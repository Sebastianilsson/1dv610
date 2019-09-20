<?php

class LoginController {
    public function __construct($layoutView, $loginView, $databaseModel) {
        $this->layoutView = $layoutView;
        $this->loginView = $loginView;
        $this->databaseModel = $databaseModel;
        $this->loginModel = new LoginModel($this->layoutView, $this->loginView, $this->databaseModel);
    }

    public function newLogin() {
        $this->loginModel->getUserLoginInput();
        $this->loginView->setUsernameValue($this->loginView->getUsername());
        if ($this->loginModel->validateLoginInputIfSubmitted()) {
            if ($this->loginModel->checkIfCredentialsMatchInDatabase()) {
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
}