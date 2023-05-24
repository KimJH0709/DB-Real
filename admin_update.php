<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>STORE</title>
  </head>
  <link rel = "stylesheet" href = "style.css">
  <body>
    <h1>관리자모드 - 상품 수정</h1>

    <?php
      session_start();
      if(isset($_SESSION['user_id'])) {
          $user_id = $_SESSION['user_id'];
      }
    ?>

    <?php
      $conn = mysqli_connect("localhost", "root", "11111111", "stores");

      $product_id = $_POST['product_id'];

      $sql = "SELECT * FROM products WHERE product_id='$product_id'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $product_name = $row['product_name'];
      $price = $row['price'];
      $product_image = $row['product_image'];
    ?>

    <form method="post" action="admin_update_process.php" enctype="multipart/form-data" class="product-form">
      <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
      <div class="form-group">
        <label for="product_name">상품명</label>
        <input type="text" id="product_name" name="product_name" value="<?php echo $product_name; ?>" required>
      </div>
      <div class="form-group">
        <label for="price">가격</label>
        <input type="number" id="price" name="price" value="<?php echo $price; ?>" required>
      </div>
      <div class="form-group">
        <label for="product_image">이미지</label>
        <input type="file" id="product_image" name="product_image">
        <img src="data:product_image/jpeg;base64,<?php echo base64_encode($product_image); ?>" alt="상품 이미지" width="200">
      </div>
      <button type="submit" class="submit-btn">수정하기</button>
    </form>
  </body>
  <p style='font-size: 11px; text-align: center;'> 배승옥 코튼 갤러리</p>
  <p style='font-size: 11px; text-align: center;'> 주소 : 전북 전주시 완산구 유연로 348-4 <span style='margin-left: 40px'></span> 전화번호 : 063-283-1191</p>
</html>
<style>
  .product-form {
    max-width: 400px;
    margin: 0 auto;
  }

  .form-group {
    margin-bottom: 20px;
  }

  label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
  }

  input[type="text"],
  input[type="number"],
  input[type="file"] {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid #ccc;
  }

  img {
    display: block;
    margin-top: 10px;
  }

  .submit-btn {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
  }
</style>