<?php
  $conn = mysqli_connect("localhost", "root", "11111111", "stores");

  $product_id = $_POST['product_id'];
  $fabric_id = $_POST['fabric_id'];
  $product_name = $_POST['product_name'];
  $form = $_POST['form'];
  $size = $_POST['size'];
  $price = $_POST['price'];
  $product_image = addslashes(file_get_contents($_FILES['product_image']['tmp_name']));

  $sql = "INSERT INTO products (product_id, fabric_id, product_name, form, size, price, product_image) VALUES ('$product_id', '$fabric_id', '$product_name', '$form', '$size', $price, '$product_image')";
  mysqli_query($conn, $sql);

  header('Location: admin.php');
?>