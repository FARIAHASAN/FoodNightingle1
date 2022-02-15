<?php
 include('config/constants.php');
//session_start();
 $userid = $_SESSION['username'];

$foodid = $_POST['postid'];
$rating = $_POST['rating'];

// Check entry within table
$query = "SELECT COUNT(*) AS cntpost FROM food_rating WHERE foodid=".$foodid." and customer=".$userid;

$result = mysqli_query($conn, $query);
$fetchdata = mysqli_fetch_array($result);
$count = $fetchdata['cntpost'];

if ($count == 0) {
    $insertquery = "INSERT INTO food_rating(customer,foodid,rating) values(" . $userid . "," . $foodid . "," . $rating . ")";
    mysqli_query($conn, $insertquery);
} else {
    $updatequery = "UPDATE food_rating SET rating=" . $rating . " where customer=" . $userid . " and foodid=" . $foodid;
    mysqli_query($conn, $updatequery);
}

// get average
$query = "SELECT ROUND(AVG(rating),1) as averageRating FROM food_rating WHERE foodid=".$foodid;
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
$fetchAverage = mysqli_fetch_array($result);
$averageRating = $fetchAverage['averageRating'];

$return_arr = array("averageRating" => $averageRating);

echo json_encode($return_arr);
?>