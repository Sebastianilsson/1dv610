<?php

class RegisterView {

    private static $username = 'RegisterView::userName';
    private static $password = 'RegisterView::password';
    private static $passwordRepeat = 'RegisterView::passwordRepeat';
    private static $submitRegistration = 'RegisterView::submitRegistration';
    private $message = "";

    public function response() {
        return $this->generateRegistrationFormHTML();
    }

    public function generateRegistrationFormHTML() {
        return '
        <a href="?">Back to login</a>
        <form method="post" action="?register">
            <fieldset>
                <legend>Register - choose a username and password</legend>
                <p>'. $this->message .'</p>
                <label>Username</label>
                <input type="text" name="'. self::$username .'" placeholder="Enter a username..." /> <br>
                <label>Password</label>
                <input type="password" name="'. self::$password .'" placeholder="Enter a password..." /> <br>
                <label>Repeat password</label>
                <input type="password" name="'. self::$passwordRepeat .'" placeholder="Repeat your password..." /> <br>
                <input type="submit" name="'. self::$submitRegistration .'" />
            </fieldset>
        </form>
        ';
    }

    public function isRegisterSet() {
        return isset($_GET['register']);
    }

    public function isUsernameSet() {
        return isset($_POST[self::$username]);
    }

    public function isPasswordSet() {
        return isset($_POST[self::$password]);
    }

    public function isRepeatedPasswordSet() {
        return isset($_POST[self::$passwordRepeat]);
    }

    public function getUsername() {
        return isset($_POST[self::$username]) ? $_POST[self::$username] : "";
    }

    public function getPassword() {
        return isset($_POST[self::$password]) ? $_POST[self::$password] : "";
    }

    public function getRepeatedPassword() {
        return isset($_POST[self::$passwordRepeat]) ? $_POST[self::$passwordRepeat] : "";
    }

    public function isRegisterFormSubmitted() {
        return isset($_POST[self::$submitRegistration]) ? true : false;
    }

    public function setRegisterMessage($message) {
        $this->message = $message;
    }
}