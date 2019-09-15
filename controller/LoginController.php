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
        if ($this->loginModel->validateLoginInputIfSubmitted()) {
            
        } else {
            $this->layoutView->render(false, $this->loginView);
        }
        
    }
}