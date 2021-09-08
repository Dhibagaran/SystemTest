<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
class User

{
    public $db_connection;

    function __construct($db)
    {
        $this->db_connection = $db;
    }

    function register($data)
    {
        $decode_data = json_decode($data, true);
        $name = $decode_data['name'];
        $email = $decode_data['email'];
        $pass = $decode_data['pass'];
        $re_pass = $decode_data['re_pass'];
        $address = $decode_data['address'];
        $city = $decode_data['city'];
        $state = $decode_data['state'];
        $country = $decode_data['country'];
        $sql = ("INSERT INTO users (name, email, password,confirm_password,address,city,state,country)VALUES ('$name', '$email','$pass', '$re_pass', '$address','$city','$state','$country')");
        $data = $this->db_connection->exec($sql);
        return $data;
    }
    function email_validation($email)
    {
        $decode_data = json_decode($email, true);
        $email_id = $decode_data['email'];
        $stmt = $this->db_connection->prepare("SELECT id FROM users WHERE email='$email_id'");
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
    function login($data)
    {
        $decode_data = json_decode($data, true);
        $password = $decode_data['password'];
        $email = $decode_data['email'];
        $stmt = $this->db_connection->prepare("SELECT id,name,email,address,city,state,country FROM users WHERE email='$email' AND password='$password' ");
        $stmt->execute();
        $login = $stmt->fetch(PDO::FETCH_ASSOC);
        return $login;
    }
    function list_product($id)
    {
        $decode_data = json_decode($id, true);
        $customer_id = $decode_data['customer_id'];
        $stmt = $this->db_connection->prepare("SELECT p.name,p.short_description,p.description,p.images,p.status,(SELECT c.name FROM categories c WHERE c.id=p.category_id) categories_name FROM product_mapping pm JOIN products p ON p.id=pm.product_id WHERE pm.customer_id='$customer_id' AND p.status !=0");
        $stmt->execute();
        $product = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $product;
        die();
    }
}
