<?php
$conn = mysqli_connect("localhost", "root", "11111111", "stores");
$product_id = $_POST['product_id'];
$sql = "DELETE FROM products WHERE product_id = '$product_id'";
$result = mysqli_query($conn, $sql);
header('Location: admin.php');
?>
