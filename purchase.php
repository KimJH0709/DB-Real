<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>STORE</title>
    </head>
    <link rel = "stylesheet" href = "style.css">
    <div style="background-color: #f2f2f2; padding: 20px;">
        <div align="center">
            <h1 style="font-family: 'Arial Black', sans-serif; font-size: 72px; color: #555555;">
                <a href="main.php" style="text-decoration: none; color: #555555;">COTTON GALLERY</a>
            </h1>
            <p style="font-family: Arial, sans-serif; font-size: 24px; color: #888888;">The Best Cotton Products</p>
        </div>
    </div>

    <div align = 'center'>
      <h1 style='font-family: "Arial Black", sans-serif; font-size: 52px;'>
        주문하기
      </h1>
    </div>

    <div align = 'right'>
        <?php
        session_start();
        if(isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            echo "<a href='logout.php' class='btn-login'>로그아웃</a>";
            echo "<span style='margin-left: 10px'></span>";
            echo "<a href='cart.php' class='btn-login'>장바구니</a>";
            echo "<span style='margin-left: 10px'></span>";
            echo "<a href='purchase_check.php' class='btn-login'>주문확인</a>";
            echo "<p></p>";
        }
        else {
            echo "<a href='login.php'>로그인</a>";
            echo "<span style='margin-left: 10px'></span>";
            echo "<a href='join.php'>회원가입</a>";
        }
        ?>
    </div>

    <?php
        session_start();

        if(isset($_SESSION['user_id'])) {
            $conn = mysqli_connect("localhost", "root", "11111111", "stores");

        $ID = $_SESSION['user_id'];

        if(isset($_POST['product_id']) && isset($_POST['count'])) {
            $product_id = $_POST['product_id'];
            $count = $_POST['count'];
            $q = "UPDATE carts SET count='$count' WHERE ID='$ID' AND product_id='$product_id'";
            mysqli_query($conn, $q);
        }

        $q = "SELECT * FROM carts WHERE ID='$ID'";
        $result = mysqli_query($conn, $q);

        if(mysqli_num_rows($result) > 0) {
            $total_price = 0;

            echo "<table>";
            echo "<tr>";
            echo "<th>상품명</th>";
            echo "<th>가격</th>";
            echo "<th>개수</th>";
            echo "</tr>";

            while($row = mysqli_fetch_assoc($result)) {
                $product_id = $row['product_id'];
                $count = $row['count'];

                $p = "SELECT * FROM products WHERE product_id = '$product_id'";
                $presult = mysqli_query($conn, $p);
                $prow = mysqli_fetch_assoc($presult);

                $tprice = $prow['price'] * $count;
                $product_name = $prow['product_name'];
                $price = $prow['price'];


                echo "<tr>";
                echo "<td>".$product_name."</td>";
                echo "<td>".$price."원</td>";
                echo "<td>".$count."</td>";
                
                $total_price += $tprice;
            }

            echo "</table>";

            echo "<p style='font-size: 24px; text-align: right;'> 총 합계 금액: ".$total_price."원</p>";
            echo "<p style='font-size: 24px; text-align: center;'> 계정 이름과 동일한 입금자명을 사용해주세요.</p>";
            echo "<p style='font-size: 24px; text-align: center;'> 입금계좌 : 00 은행   계좌번호 : 0000-00-000000</p>";

            echo "<form method='post' action='purchase_process.php'>";
            echo "<input type='hidden' name='ID' value='$ID'>";
            echo "<input type='hidden' name='total_price' value='$total_price'>";
            echo "<button class = 'purchase-btn' button type='submit'>입금확인 요청</button>";
            echo "</form>";
            }
        } else {
            echo "<script>alert('로그인 후 이용해주세요.')</script>";
            echo "<script>location.replace('login.php');</script>";
            exit;
        }
    ?>
