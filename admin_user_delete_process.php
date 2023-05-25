<?php
$conn = mysqli_connect("localhost", "root", "11111111", "stores");
$ID = $_POST['ID'];
$sql = "DELETE FROM user WHERE ID= '$ID'";
$result = mysqli_query($conn, $sql);
header('Location: admin.php');
?>
