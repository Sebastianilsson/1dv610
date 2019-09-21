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
        if ($this->loginModel->validateLoginInput()) {
            if ($this->loginModel->checkIfCredentialsMatchInDatabase()) {
                $_SESSION['isLoggedIn'] = true;
                $this->loginView->setIsLoggedIn(true);
                if ($this->loginView->isKeepLoggedInRequested()) {
                    $this->loginView->setCookie();
                    $this->databaseModel->removeOldSessionIfExisting($this->loginView->getUsername());
                    $this->loginModel->saveCookieToDatabase($this->loginView->getUsername(), $this->loginView->getCookiePassword());
                    $this->loginView->setLoginMessage("Welcome and you will be remembered");
                } else {
                    $this->loginView->setLoginMessage("Welcome");
                }
                $this->layoutView->render(true, $this->loginView);
                return;
            } else {
                $this->loginView->setLoginMessage("Wrong name or password");
            }
        } 
        $this->loginView->setUsernameValue($this->loginView->getUsername());
        $this->layoutView->render(false, $this->loginView);
        // $this->loginModel->getUserLoginInput();
        // $this->loginView->setUsernameValue($this->loginView->getUsername());
        // if ($this->loginModel->validateLoginInputIfSubmitted()) {
        //     if ($this->loginModel->checkIfCredentialsMatchInDatabase()) {
        //         $this->loginView->setIsLoggedIn(true);
        //         $_SESSION['loggedIn'] = true;
        //         if ($this->loginView->isKeepLoggedInSet()) {
        //             $this->loginView->setCookie();
        //             $this->loginView->addMessage('Welcome and you will be remembered');
        //         } else {
        //             $this->loginView->addMessage('Welcome');
        //         }
        //         $this->layoutView->render(true, $this->loginView);
        //     } else {
        //         $this->loginView->addMessage('Wrong name or password');
        //         $this->layoutView->render(false, $this->loginView);
        //     }
        // } else {
        //     $this->layoutView->render(false, $this->loginView);
        // }
    }

    public function loginWithCookies() {
        if ($this->loginModel->checkIfCookieIsValid()) {
            $this->loginView->setIsLoggedIn(true);
            $_SESSION['isLoggedIn'] = true;
            $this->loginView->setLoginMessage("Welcome back with cookie");
            $this->layoutView->render(true, $this->loginView);
        } else {
            $this->destroyCookie();
            $this->loginView->setLoginMessage("Wrong information in cookies");
            $this->layoutView->render(false, $this->loginView);
        }
        // $this->loginView->setUserCredentialsFromCookie();
        // $this->loginView->setIsLoggedIn(true);
        // $this->loginView->setLoginMessage("Welcome back with cookie");
        // $this->layoutView->render(true, $this->loginView);
    }

    private function destroyCookie() {
        setcookie ("LoginView::CookieName", "", time() - 3600);
        setcookie ("LoginView::CookiePassword", "", time() - 3600);
    }

    public function logout() {
        if (isset($_SESSION['isLoggedIn'])) {
            session_unset();
            session_destroy();
            $this->destroyCookie();
            $this->loginView->setLoginMessage("Bye bye!");
            $this->layoutView->render(false, $this->loginView);
        } else {
            $this->layoutView->render(false, $this->loginView);
        }
    }
}