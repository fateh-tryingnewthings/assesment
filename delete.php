<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['delete'];

    $sql = $conn->prepare("DELETE FROM results WHERE id = $id");
    if($sql->execute()){
        header("Location: index.php");
        exit;
    }
}
?>
