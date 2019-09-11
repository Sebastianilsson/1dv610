<?php

class RegisterView {
    public function renderRegistrationForm() {
        return '
        <form method="post">
            <fieldset>
                <legend>Register - choose a username and password</legend>
                <label>Username</label>
                <input type="text" name="username" placeholder="Enter a username..." /> <br/>
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter a password..." /> <br/>
                <label>Repeat password</label>
                <input type="password" name="repeatedPassword" placeholder="Repeat your password..." /> </br>
                <input type="submit" name="submitRegistration" />
            </fieldset>
        </form>
        ';
    }
}