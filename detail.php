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
            echo "<span style='margin-left: 10px'></span>";
            echo "<a href='purchase_check.php' class='btn'>주문확인</a>";  
        }
        else {
            echo "<a href='login.php' class='btn-login'>로그인</a>";
            echo "<span style='margin-left: 10px'></span>";
            echo "<a href='join.php' class='btn-join'>회원가입</a>";
        }
      ?>
    </div>
    <ol>
      <li><a href="product_pillow_cover_home.php">PILLOW COVER</a></li>
      <li><a href="product_seat_cushion_home.php">SEAT CUSHION</a></li>
      <li><a href="product_etc.php">ETC</a></li>

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
            

            $ssql = "SELECT * FROM fabric WHERE fabric_id = '$fabric_id'";
            $sresult = mysqli_query($conn, $ssql);
            $srow = mysqli_fetch_assoc($sresult);
            $material = $srow['material'];
            $producer = $srow['producer'];
            $count_of_yarn = $srow['count_of_yarn'];
            
            echo "<img class='product-image' src='data:image/jpeg;base64," . base64_encode($product_image) . "' alt='상품 이미지'>";

            echo "<table>";
            echo "<tr><td><div class='product-info'>제품 이름</div></td><td><div class='product-info'>$product_name</div></td></tr>";
            echo "<tr><td><div class='product-info'>종류</div></td><td><div class='product-info'>$form</div></td></tr>";
            echo "<tr><td><div class='product-info'>사이즈</div></td><td><div class='product-info'>$size</div></td></tr>";
            echo "<tr><td><div class='product-info'>재질</div></td><td><div class='product-info'>$material</div></td></tr>";
            echo "<tr><td><div class='product-info'>섬유 수</div></td><td><div class='product-info'>$count_of_yarn 수</div></td></tr>";
            echo "<tr><td><div class='product-info'>제작자</div></td><td><div class='product-info'>$producer</div></td></tr>";
            echo "<tr><td><div class='product-info'>가격</div></td><td><div class='product-info'>$price 원</div></td></tr>";

            echo "</table>";


            echo "<form method='post' action='cart_insert_process.php'><input type='hidden' name='product_id' value='$product_id'><button class='btn' type='submit'>장바구니</button></form><br>";
        }

        if(isset($_SESSION['user_id'])) {

          $user_id = $_SESSION['user_id'];
          $sql = "SELECT * FROM order_sheet WHERE ID = '$user_id' AND product_id = '$product_id'";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
          $process = $row['process'];
          if ($process == '배송완료'){
            echo "<h3>한줄 리뷰 작성</h3>";
            echo "<form method='post' onsubmit='submitReview(event)'>";
            echo "<textarea id='review' name='review' rows='4' cols='50' placeholder='리뷰를 작성해주세요'></textarea><br>";
            echo "<input type='number' id='score' name='score' min='1' max='5' style='width: 67px;' placeholder='평점(1-5)'><br>";
            echo "<input type='hidden' id='product_id' name='product_id' value='$product_id'>";
            echo "<input type='hidden' id='user_id' name='user_id' value='$user_id'>";
            echo "<br><button type='submit' name='submit_review' class = 'btn'>리뷰 제출</button>";
            echo "</form>";
          }
          else {
            echo "주문 후 리뷰 작성이 가능합니다.";
          }
        }


        $sql = "SELECT * FROM product_review WHERE product_id = '$product_id'";
        $result = mysqli_query($conn, $sql);

        echo "<h1>리뷰 목록</h1>";

        echo "<table>";
        echo "<tr>";
        echo "<th>이름</th>";
        echo "<th>평점</th>";
        echo "<th>리뷰</th>";
        echo "<th>삭제</th>";
        echo "</tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            $user_id = $row['user_id'];
            $review = $row['review'];
            $score = $row['score'];

            $user_sql = "SELECT name FROM user WHERE ID = '$user_id'";
            $user_result = mysqli_query($conn, $user_sql);
            $user_row = mysqli_fetch_assoc($user_result);
            $user_name = $user_row['name'];
    
            echo "<tr>";
            echo "<td>$user_name</td>";
            echo "<td>$score</td>";
            echo "<td>$review</td>";
            echo "<td><button onclick=\"deleteReview('$user_id', '$product_id')\">삭제</button></td>";
            echo "</tr>";

        }
        echo "</table>";

        ?>
    </div>

  </body>
  <script>
    function submitReview(event) {
      event.preventDefault();

      var review = document.getElementById('review').value;
      var score = document.getElementById('score').value;
      var product_id = document.getElementById('product_id').value;
      var user_id = document.getElementById('user_id').value;

      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'review_process.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            alert('리뷰가 제출되었습니다.');
            location.reload();
          } else {
            alert('작성된 리뷰가 있습니다.');
          }
        }
      };

      // 데이터 전송
      var data = 'review=' + encodeURIComponent(review) + '&score=' + encodeURIComponent(score) + '&product_id=' + encodeURIComponent(product_id) + '&user_id=' + encodeURIComponent(user_id);
      xhr.send(data);
    }



    function deleteReview(userId, productId) {
    <?php
    if (isset($_SESSION['user_id'])) {
        $currentUserId = $_SESSION['user_id'];
        echo "if ('$currentUserId' !== userId) {";
        echo "  alert('다른 사용자의 리뷰는 삭제할 수 없습니다.');";
        echo "  return;";
        echo "}";
    } else {
        echo "alert('로그인이 필요합니다.');";
        echo "return;";
    }
    ?>

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'delete_review.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                alert('리뷰가 삭제되었습니다.');
                location.reload(); // 페이지 새로고침
            } else {
                alert('리뷰 삭제에 실패했습니다.');
            }
        }
    };

    // 데이터 전송
    var data = 'user_id=' + encodeURIComponent(userId) + '&product_id=' + encodeURIComponent(productId);
    xhr.send(data);
  }
  </script>
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
  table {
        border-collapse: collapse;
        width: 70%;
    }

  th, td {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: left;
  }
</style>