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
            echo "<th>사진</th>";
            echo "<th>상품명</th>";
            echo "<th>가격</th>";
            echo "<th>개수</th>";
            echo "<th>삭제</th>";
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
                echo "<td><img src='data:image/jpeg;base64," . base64_encode($prow['product_image']) . "' alt='상품 이미지' width='200'></td>";
                echo "<td>".$product_name."</td>";
                echo "<td>".$price."원</td>";
                echo "<td>";
                echo "<form method='POST' action='".$_SERVER['PHP_SELF']."' class='product-count-form'>";
                echo "<input type='hidden' name='product_id' value='".$product_id."'>";
                echo "<input type='number' name='count' value='".$count."' min='1' max='100' onchange='this.form.submit()' class='product-count-input'>";
                echo "</form>";
                echo "</td>";
                echo "<td><form method='POST' action='cart_delete_process.php'><input type='hidden' name='product_id' value='".$product_id."'><button class='cart-btn' type='submit'>삭제</button></form></td>";
                echo "</tr>";

                $total_price += $tprice;
            }

            echo "</table>";

            echo "<p style='font-size: 24px; text-align: right;'> 총 합계 금액: ".$total_price."원</p>";

            echo "<form method='post' action='purchase.php'>";
            echo "<input type='hidden' name='ID' value='$ID'>";
            echo "<button class = 'purchase-btn' button type='submit'>주문하기</button>";
            echo "</form>";
            } else {
                echo "<p class='empty-cart'>장바구니가 비어있습니다.</p>";
            }
        } else {
            echo "<script>alert('로그인 후 이용해주세요.')</script>";
            echo "<script>location.replace('login.php');</script>";
            exit;
        }
    ?>

