<!DOCTYPE html>
<html lang="en">
	
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->	


	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/theme/style.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/theme/NeoSans.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/theme/NeoTech.css">
	
</head>

	<body>
	<div class='container'>
		<div class="row"><!-- header -->
			 <div class="col-md-12 header">
				<div class='row'>
					<div class="col-md-9 col-md-offset-2 header">
						<div class='row'>
							<div class='logo col-md-2'></div>
							<div class='col-md-4 page_title'>API Connector</div>
							<div class='col-md-3 col-md-offset-2 user'><a href=''><span class='user_name'><?=$username?></span></a>|<?php echo anchor('/auth/logout/', 'Logout'); ?></div>
						</div>
					</div>
				</div>
			 </div>
		</div><!-- end header -->
		<ul class="nav nav-pills">
			<li><a href="/mapping/">Home</a></li>
			<li class='dropdown'>
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" >My Connections <span class="caret"></a>
				
				<ul class="dropdown-menu">
					<li><a href='/mapping/step01'>Create new Connection</a></li>
					<li role="presentation" class="divider"></li>
					<?php 
						foreach ($jobs as $job)
						{
							
							?>
								<li><a href='/mapping/step01/<?=$job->id?>'><?=$job->connection_name?></a></li>
							<?php
						}
					?>
					
					
				</ul>
			</li>
			<?php if(isset($connection->id) && $connection->id>0) {?>
			<li class='dropdown active' class='active'>
				<a  class="dropdown-toggle" data-toggle="dropdown" href="#" ><?=$connection->connection_name?> <span class="caret"></a>
				<ul class='dropdown-menu'>
					<li><a href='/mapping/step01/<?=$connection->id?>'>Step01</a></li>
					<li><a href='/mapping/step02/<?=$connection->id?>'>Step02</a></li>
					<li><a href='/mapping/step03/<?=$connection->id?>'>Step03</a></li>
					<li><a href='/mapping/step04/<?=$connection->id?>'>Step04</a></li>
					<li><a href='/mapping/step05/<?=$connection->id?>'>Step05</a></li>
					<li><a href='/mapping/step06/<?=$connection->id?>'>Step06</a></li>
					<li><a href='/mapping/step07/<?=$connection->id?>'>Step07</a></li>
				</ul>
			
			</li>
			<?php } ?>
			
						
			
		</ul>