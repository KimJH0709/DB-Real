<?php
  $conn = mysqli_connect("localhost", "root", "11111111", "stores");

  $product_id = $_POST['product_id'];
  $product_name = $_POST['product_name'];
  $price = $_POST['price'];

  if(!empty($_FILES['product_image']['tmp_name'])) {
    $product_image = addslashes(file_get_contents($_FILES['product_image']['tmp_name']));
    $sql = "UPDATE products SET product_name='$product_name', price=$price, product_image='$product_image' WHERE product_id='$product_id'";
  } else {
    $sql = "UPDATE products SET product_name='$product_name', price=$price WHERE product_id='$product_id'";
  }

  $result = mysqli_query($conn, $sql);

  if($result === false) {
    echo '수정하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요.';
    error_log(mysqli_error($conn));
  } else {
    header('Location: admin.php');
  }
?>