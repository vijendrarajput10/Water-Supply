<?php include("header.php"); ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<div class="content">
<div class="profile">
	<?php
		echo "Hello <b id='welcome'><i>" .$_SESSION['username'] . "</i> !</b>";
		echo "<br/>";
		echo "<br/>";
		echo "Welcome to Admin Page";
		echo "<br/>";
		echo "<br/>";
		
	?>
</div>
</div>
<?php include("sidemenu.php"); ?>
