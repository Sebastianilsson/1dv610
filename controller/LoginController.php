<?php

class LoginController {

    public function __construct($layoutView, $loginView, $databaseModel) {
        $this->layoutView = $layoutView;
        $this->loginView = $loginView;
        $this->databaseModel = $databaseModel;
        $this->loginModel = new LoginModel($this->layoutView, $this->loginView, $this->databaseModel);
    }
    // Method called if login was requested.
    public function newLogin() {
        $this->loginModel->getUserLoginInput();
        if ($this->loginModel->validateLoginInput()) {
            if ($this->loginModel->checkIfCredentialsMatchInDatabase()) {
                session_regenerate_id(true);
                $_SESSION['isLoggedIn'] = true;
                $_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
                $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                $this->loginView->setIsLoggedIn(true);
                if ($this->loginView->isKeepLoggedInRequested()) {
                    $this->setCookiesAndLoginMessages();
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
    }

    private function setCookiesAndLoginMessages() {
        $this->loginView->setCookie();
        $this->databaseModel->removeOldSessionIfExisting($this->loginView->getUsername());
        $this->loginModel->saveCookieToDatabase($this->loginView->getUsername(), $this->loginView->getCookiePassword());
        $this->loginView->setLoginMessage("Welcome and you will be remembered");
    }

    // Method called if the user already has a cookie from the site
    public function loginWithCookies() {
        if ($this->loginModel->checkIfCookieIsValid()) {
            $this->loginView->setIsLoggedIn(true);
            session_regenerate_id(true);
            if (!isset($_SESSION['isLoggedIn'])) {
                $_SESSION['isLoggedIn'] = true;
                $_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
                $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                $this->loginView->setLoginMessage("Welcome back with cookie");
            }
            $this->layoutView->render(true, $this->loginView);
        } else {
            $this->destroyCookie();
            $this->loginView->setLoginMessage("Wrong information in cookies");
            $this->layoutView->render(false, $this->loginView);
        }
    }

    // Method called if the user already has an active session from the site
    public function loginWithSession() {
        if (!$this->checkIfSessionHijacked()) {
            session_regenerate_id(true);
            $this->loginView->setIsLoggedIn(true);
            $this->layoutView->render(true, $this->loginView);
        } else {
            $this->layoutView->render(false, $this->loginView);
        }
    }

    private function checkIfSessionHijacked() {
        if ($_SESSION['userAgent'] == $_SERVER['HTTP_USER_AGENT'] && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR']) {
            return false;
        } else { return true;}
    }

    private function destroyCookie() {
        setcookie ("LoginView::CookieName", "", time() - 3600);
        setcookie ("LoginView::CookiePassword", "", time() - 3600);
    }

    // Method called if logout is requested
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