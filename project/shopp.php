<?php
include 'server.php';
	if(isset($_SESSION['items']) && !empty($_SESSION['items'])){
		$items= $_SESSION['items'];
		$cartitems= explode(",", $items);
		$items .="," . $_GET['id'];
		$_SESSION['items']= $items;
		header('location: voorbeeld.php?status=success');
	}else{
		$items = $_GET['id'];
		$_SESSION['items'] = $items;
		header('location: voorbeeld.php?status=failed');
	}
?><?php /*
<html>
	<body>
	<?php
	if(empty($items)){
		echo "Nog geen items in het winkelmandje";
	}else{
		var_dump($items);
	?>
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<input type="submit" value="legen">
		</form>
	<?php
	}if($_SERVER["REQUEST_METHOD"]=="POST"){
		unset($_SESSION['items']);
	}
	?>*/
	?>