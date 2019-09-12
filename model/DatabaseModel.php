<?php

class DatabaseModel {
    private $databaseServerName = "localhost";
    private $databaseUserName = "root";
    private $databasePassword = "";
    private $databaseName = "1dv610-l2";

    public function connectToDatabase() {
        $connection = mysqli_connect($this->databaseServerName, $this->databaseUserName, $this->databasePassword, $this->databaseName);
        print_r($connection);
    }
}