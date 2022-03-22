<?php
session_start();

$title = "Map";
include('headers/small_header.php');

require_once ('inc/DbManagement.php');
$db = new DbManagement();

$result = $db->select_all_students();


echo '<div class="container" id="main-container">';

include ('map.html');

echo '</div>';

include ('footer.html');
echo '</body></html>';

echo <<<js
    <script src="js/jquerry.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/nav_scroll.js"></script>
js;