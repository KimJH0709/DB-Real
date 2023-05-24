<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>STORE</title>
  </head>
  <link rel = "stylesheet" href = "style.css">
  <body>
    <div style="background-color: #f2f2f2; padding: 20px;">
        <div align="center">
            <h1 style="font-family: 'Arial Black', sans-serif; font-size: 72px; color: #555555;">
                <a href="main.php" style="text-decoration: none; color: #555555;">COTTON GALLERY</a>
            </h1>
            <p style="font-family: Arial, sans-serif; font-size: 24px; color: #888888;">The Best Cotton Products</p>
        </div>
    </div>
    <div align = 'right'>
      <?php
        session_start();
        if(isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $conn = mysqli_connect("localhost", "root", "11111111", "stores");

            $sql = "SELECT name FROM user where ID = $user_id";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            echo "<span style='font-size: 24px; color: #333; margin-right: 10px;'>{$row['name']}님 환영합니다</span></br>";

            echo "<a href='logout.php' class='btn-login'>로그아웃</a>";
            echo "<span style='margin-left: 10px'></span>";
            echo "<a href='cart.php' class='btn'>장바구니</a>";        
        }
        else {
            echo "<a href='login.php' class='btn-login'>로그인</a>";
            echo "<span style='margin-left: 10px'></span>";
            echo "<a href='join.php' class='btn-join'>회원가입</a>";
        }
      ?>
    </div>
    <ol>
      <li><a href="product_bedding_home.php">이불</a></li>
      <li><a href="product_pillow_home.php">베개</a></li>
    </ol>

    <div align = 'center'>
        <?php
        $conn = mysqli_connect("localhost", "root", "11111111", "stores");
        $product_id = $_POST['product_id'];
        $sql = "SELECT * FROM products WHERE product_id = '$product_id'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row['product_id'];
            $fabric_id = $row['fabric_id'];
            $product_name = $row['product_name'];
            $form = $row['form'];
            $size = $row['size'];
            $price = $row['price'];
            $product_image = $row['product_image'];
            

            echo "<img class='product-image' src='data:image/jpeg;base64," . base64_encode($product_image) . "' alt='상품 이미지'><br>";
            echo "<div class='product-info'>제품 ID: $product_id</div>";
            echo "<div class='product-info'>재질: $fabric_id</div>";
            echo "<div class='product-info'>제품 이름: $product_name</div>";
            echo "<div class='product-info'>종류: $form</div>";
            echo "<div class='product-info'>사이즈: $size</div>";
            echo "<div class='product-info'>가격: $price 원</div>";
            echo "<form method='post' action='cart_insert_process.php'><input type='hidden' name='product_id' value='$product_id'><button class='btn' type='submit'>장바구니</button></form><br>";
        }

        ?>
    </div>

  </body>
  <p style='font-size: 11px; text-align: center;'> 배승옥 코튼 갤러리</p>
  <p style='font-size: 11px; text-align: center;'> 주소 : 전북 전주시 완산구 유연로 348-4 <span style='margin-left: 40px'></span> 전화번호 : 063-283-1191</p>
</html>

<style>
  .product-image {
  width: 600px;
  height: 600px;
  margin-bottom: 20px;
  }
  .product-info {
    
    font-size: 25px;
    margin-bottom: 10px;
  }
</style>