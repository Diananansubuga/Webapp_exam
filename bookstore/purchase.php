<?php
	session_start();
	$_SESSION['err'] = 1;
	foreach($_POST as $key => $value){
		if(trim($value) == ''){
			$_SESSION['err'] = 0;
		}
		break;
	}

	if($_SESSION['err'] == 0){
		header("Location: checkout.php");
		exit(); // Exit to prevent further execution
	} else {
		unset($_SESSION['err']);
	}

	$_SESSION['ship'] = array();
	foreach($_POST as $key => $value){
		if($key != "submit"){
			$_SESSION['ship'][$key] = $value;
		}
	}

	// Empty the cart
	unset($_SESSION['cart']);

	// Redirect to index page with success message
	header("Location: index.php?purchase=success");
	exit(); // Exit to prevent further execution
?>

<?php
	$title = "Purchase";
	require_once "header.php";
?>

<h4 class="fw-bolder text-center">Payment</h4>
<center>
	<hr class="bg-warning" style="width:5em;height:3px;opacity:1">
</center>

<?php
	if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){
?>

<div class="card rounded-0 shadow mb-3">
	<div class="card-body">
		<div class="container-fluid">
			
		</div>
	</div>
</div>

<div class="row justify-content-center">
	<div class="col-lg-5 col-md-8 col-sm-10 col-xs-12">
		<div class="card rounded-0 shadow">
			<div class="card-header">
				<div class="card-title h6 fw-bold">Please Fill the following form</div>
			</div>
			<div class="card-body">
				<div class="container-fluid">
					<form method="post" action="process.php" class="form-horizontal">
						
					</form>
					<p class="fw-light fst-italic"><small class="text-muted">Please press Purchase to confirm your purchase, or Continue Shopping to add or remove items.</small></p>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
	} else {
		echo "<p class=\"text-warning\">Your cart is empty! Please make sure you add some books in it!</p>";
	}
	require_once "footer.php";
?>
