<?php
require "db-connection.php";
require "class.php";
ini_set("display_errors", "1");
error_reporting(E_ALL);
$db = new dataBase();
$class = new User($db->selectDb());

function sendRes($responseAr)
{
    header("Content-Type: application/json");
    echo json_encode($responseAr);
}

if (isset($_REQUEST['type'])  && ($_REQUEST["type"] == 'add_customer')) {
    $send_data = array("name" => $_REQUEST["name"], "email" => $_REQUEST["email"], "pass" => $_REQUEST["pass"], "re_pass" => $_REQUEST["re_pass"], "address" => $_REQUEST["address"], "city" => $_REQUEST["city"], "state" => $_REQUEST["state"], "country" => $_REQUEST["country"]);
    $parameter = json_encode($send_data, true);
    $reg = $class->register($parameter);
    if ($reg != '') {
        sendRes(array('status' => '1', 'data' => $reg));
        die();
    } else {
        sendRes(array('status' => '0', 'data' => 'Data not added'));
        die();
    }
}
if (isset($_REQUEST['type'])  && ($_REQUEST["type"] == 'email_validation')) {
    $send_data = array("email" => $_REQUEST["email"]);
    $parameter = json_encode($send_data, true);
    $email_condition = $class->email_validation($parameter);
    if ($email_condition != '') {
        sendRes(array('status' => '0'));
        die();
    } else {
        sendRes(array('status' => '1'));
        die();
    }
}
if (isset($_REQUEST['type'])  && ($_REQUEST["type"] == 'login_customer')) {
    $send_data = array("email" => $_REQUEST["email"], "password" => $_REQUEST["password"]);
    $parameter = json_encode($send_data, true);
    $log = $class->login($parameter);
    if ($log != '') {
        $_SESSION['customer_id'] = $log['id'];
        $_SESSION['customer_name'] = $log['name'];
        $_SESSION['customer_email'] = $log['email'];
        $_SESSION['customer_address'] = $log['address'];
        $_SESSION['customer_city'] = $log['city'];
        $_SESSION['customer_state'] = $log['state'];
        $_SESSION['customer_country'] = $log['country'];
        sendRes(array('status' => '1', 'data' => $log));
        die();
    } else {
        sendRes(array('status' => '0', 'data' => 'No data found'));
        die();
    }
}
if (isset($_REQUEST['type'])  && ($_REQUEST["type"] == 'list_product')) {
    $send_data = array("customer_id" => $_SESSION["customer_id"]);
    $parameter = json_encode($send_data, true);
    $product = $class->list_product($parameter);
    foreach ($product as $key => $value) {
        if ($value['status'] == 1) {
            $value['status'] = 'Active';
        } else {
            $value['status'] = 'Inactive';
        }
        $prod_arr[]=$value;
    }
    if (!empty($prod_arr)) {
        sendRes(array('status' => '1', 'data' => $prod_arr));
        exit;
    } else {
        sendRes(array('status' => '0', 'data' => 'No data found'));
        die();
    }
}
