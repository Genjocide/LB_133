<?php
require_once('./inc/DbManagement.php');
$db = new DbManagement();


$result = $db->select_all_students();

header('Content-Type: application/json; charset=utf-8');
print json_encode($result)

?>
