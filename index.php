<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/RegisterView.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE VIEWS
$loginView = new LoginView();
$dateTimeView = new DateTimeView();
$layoutView = new LayoutView();
$registerView = new RegisterView();


$layoutView->render(false, $loginView, $dateTimeView);

if ($registerView->isRegisterSet()) {
    echo $registerView->renderRegistrationForm();
}

