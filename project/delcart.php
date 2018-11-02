<?php 
include 'server.php';
$items = $_SESSION['items'];
$manditems = explode(",", $items);
if(isset($_GET['remove']) & !empty($_GET['remove'])){
	$delitem = $_GET['remove'];
	unset($manditems[$delitem]);
	$itemids = implode(",", $manditems);
	$_SESSION['items'] = $itemids;
}
header('location:mandje.php');