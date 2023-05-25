<?php
    $conn = mysqli_connect("localhost", "root", "11111111", "stores");

    $product_id = $_POST['product_id'];
    $user_id = $_POST['user_id'];
    $review = $_POST['review'];
    $score = $_POST['score'];

    $sql = "INSERT INTO product_review (product_id, user_id, review, score) VALUES ('$product_id', '$user_id', '$review', '$score')";
    mysqli_query($conn, $sql);
?>