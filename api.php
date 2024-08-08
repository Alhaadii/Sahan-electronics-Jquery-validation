<?php
header("Content-Type: application/json");
include("./conn.php");


$action = $_POST['action'];

function getAll($connection)
{
    $data = array();
    $message = array();

    $sql = "SELECT * FROM items";
    $result = $connection->query($sql);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $message = array("status" => "true", "msg" => $data);
    } else {
        $message = array("status" => "false", "msg" => "Error fetching data");
    }
    echo json_encode($message);
}
function getItem($connection)
{
    $data = array();
    $message = array();
    $id = $_POST['id'];

    $sql = "SELECT * FROM items WHERE itemid=$id";
    $result = $connection->query($sql);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $message = array("status" => "true", "msg" => $data);
    } else {
        $message = array("status" => "false", "msg" => $connection->error);
    }
    echo json_encode($message);
}



// Register Items
function register($connection)
{
    $id = $_POST["id"];
    $name = $_POST['name'];
    $quantity = intval($_POST['qyt']);
    $price = floatval($_POST['price']);
    $totalPrice = $price * $quantity;

    $message = array();

    $sqlQuery = "INSERT INTO items VALUES ($id,'$name',$quantity,$price,$totalPrice)";
    $result = $connection->query($sqlQuery);

    if ($result) {
        $message = array("status" => "true", "msg" => "Item added successfully");
    } else {
        $message = array("status" => "false", "msg" => "Error adding item");
    }
    echo json_encode($message);
}



// update item
function updateItem($connection)
{
    $id = $_POST["id"];
    $name = $_POST['name'];
    $quantity = intval($_POST['qyt']);
    $price = floatval($_POST['price']);
    $totalPrice = $price * $quantity;

    $message = array();

    $sqlQuery = "UPDATE items SET itemname = '$name',qyt = '$quantity',price = '$price',totalprice=$totalPrice WHERE itemid =$id";
    $result = $connection->query($sqlQuery);

    if ($result) {
        $message = array("status" => "true", "msg" => "Item Updated successfully");
    } else {
        $message = array("status" => "false", "msg" => "Error Updating item");
    }
    echo json_encode($message);
}

// read Row ID
function readid($connection)
{

    // read all itemid

    $sql = "SELECT itemid FROM items";
    $result = $connection->query($sql);
    $data = array();
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        echo json_encode(array("status" => "false", "msg" => "Error fetching item IDs"));
    }
}


// delete single item
function deletItem($connection)
{
    $id = $_POST["id"];


    $message = array();

    $sqlQuery = "DELETE FROM items WHERE itemid=$id";
    $result = $connection->query($sqlQuery);

    if ($result) {
        $message = array("status" => "true", "msg" => "Item Deleted successfully");
    } else {
        $message = array("status" => "false", "msg" => "Error Deleted item");
    }
    echo json_encode($message);
}



// generate and finalize the Aciton

if (isset($action)) {
    $action($connection);
} else {
    echo "Error, Action is required, maadan soo baasin";
    echo "<br> halkaa waa dhacdada :" . $action;
}
