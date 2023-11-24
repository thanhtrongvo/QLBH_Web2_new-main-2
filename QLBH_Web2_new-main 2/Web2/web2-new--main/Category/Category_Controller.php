<?php
if (!isset($_GET["action"]))
    echo "404";
else {
    $action = $_GET["action"];
    include_once("../dbconnect.php");
    $dbcon = new dbconnect();
    $conn = $dbcon->connect();
    if ($action == "insert" || $action == "update") {
        if (isset($_GET["ID"]))
            $ID = $_GET["ID"];
        $Name = $_GET['Name'];
        if ($action == "insert") {
            $sql = "INSERT INTO category (`Name`) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $Name);
        } else { //update
            $sql = "Update category set Name=? Where ID =?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $Name, $ID);
        }
        $dbcon->insert($stmt, $conn);
    } else { //delete

        $sql = "DELETE FROM category WHERE ID='" . $_GET["ID"] . "'";
        $dbcon->delete($sql, $conn);


        
    }
}
