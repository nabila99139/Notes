<?php
include "db.php";
$id = $_GET["id"];
$deleteQuery = "DELETE FROM `notes` WHERE `id` = $id";
$result = mysqli_query($conn, $deleteQuery);
header("location: index.php");
?>