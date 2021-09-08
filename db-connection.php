<?php
session_start();
class dataBase
{
    private  $servername = "localhost";
    private  $username   = "root";
    private  $password = "";
    public function selectDb()
    {
        $this->conn = null;
        try {
            $conn = new PDO("mysql:host=" . $this->servername . ";dbname=customer_information", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
