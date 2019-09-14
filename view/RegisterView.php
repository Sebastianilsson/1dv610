<?php

class RegisterView {

    private static $message = 'RegisterView::Message';
    private static $username = 'RegisterView::UserName';
    private static $password = 'RegisterView::Password';
    private static $passwordRepeat = 'RegisterView::PasswordRepeat';
    private static $submitRegistration = 'RegisterView::submitRegistration';
    private $registerMessage = "";

    public function response() {
        return $this->generateRegistrationFormHTML();
    }

    public function generateRegistrationFormHTML() {
        return '
        <a href="?">Back to login</a>
        <h2>Register new user</h2>
        <form method="post" action="?register">
            <fieldset>
                <legend>Register - choose a username and password</legend>
                <p id='. self::$message .'>'. $this->registerMessage .'</p>
                <label>Username</label>
                <input id='. self::$username .' type="text" name="'. self::$username .'" placeholder="Enter a username..." /> <br>
                <label>Password</label>
                <input id='. self::$password .' type="password" name="'. self::$password .'" placeholder="Enter a password..." /> <br>
                <label>Repeat password</label>
                <input id='. self::$passwordRepeat .' type="password" name="'. self::$passwordRepeat .'" placeholder="Repeat your password..." /> <br>
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