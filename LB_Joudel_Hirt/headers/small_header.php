<?php
header('Content-Type: text/html; charset=UTF-8');
echo "
<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <link href=\"./css/bootstrap.min.css\" rel=\"stylesheet\">
    <link href=\"./style.css\" rel=\"stylesheet\">
    <link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.13.0/css/ol.css\" type=\"text/css\">
    <script src=\"https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.13.0/build/ol.js\"></script>
    
    <title>$title</title>
</head>
<body>";

echo '<img src="img/small_header.jpeg" class="img-fluid" id="headimg" object-fit="cover" width="100%">';
include('navigation.php');