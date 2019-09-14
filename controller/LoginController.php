<?php

class LoginController {
    public function __construct($loginView, $databaseModel) {
        $this->loginView = $loginView;
        $this->databaseModel = $databaseModel;
        $this->loginModel = new LoginModel($this->loginView, $this->databaseModel);
    }

    public function newLogin() {
        $this->loginModel->getUserLoginInput();
        if ($this->loginModel->validateLoginInputIfSubmitted()) {

        }
        
    }
}