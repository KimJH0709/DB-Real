<?php
$conn = mysqli_connect("localhost", "root", "11111111", "stores");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $delete_sql = "DELETE FROM product_review WHERE user_id = '$user_id' AND product_id = '$product_id'";
    $delete_result = mysqli_query($conn, $delete_sql);

    if ($delete_result) {
        http_response_code(200);
    } else {
        http_response_code(500);
    }
} else {
    http_response_code(400);
}
?>