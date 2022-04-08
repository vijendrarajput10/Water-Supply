<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- css -->
   <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/css/style.css"> 
  </head>
<body>

	<header id="site-header" style="float: right;">
		
						<?php if (isset($_SESSION['username']) && $_SESSION['logged_in'] === true) : ?>
							<li><a href='<?php echo base_url()."home/Logout"; ?>'>Logout</a></li>
						<?php else : 
							redirect('login', 'refresh');
						?>
					
	</header><!-- #site-header -->
	
