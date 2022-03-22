<?php
header('Content-Type: text/html; charset=UTF-8');
echo "
<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <link href=\"./css/bootstrap.min.css\" rel=\"stylesheet\">
    <link href=\"./style.css\" rel=\"stylesheet\">
    <title>$title</title>
</head>
<body>";

echo '<img src="img/header.jpeg" class="img-fluid" id="headimg">';
include('navigation.php');

echo '
    <script src="js/jquerry.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
  ';