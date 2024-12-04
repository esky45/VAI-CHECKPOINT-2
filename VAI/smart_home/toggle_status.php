<?php
include 'database.php';

$id = $_GET['id'];
$newStatus = $_GET['status'];

$sql = "UPDATE devices SET status='$newStatus' WHERE id=$id";
if ($conn->query($sql)) {
    header("Location: index.php");
} else {
    echo "Error: " . $conn->error;
}
?>
