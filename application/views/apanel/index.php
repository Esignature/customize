<?php
	include('inc/head.php');
	include('inc/header.php');
	include('inc/menu.php');

    if(isset($view))
	{
		include($view.'.php');
	} else {
		include('dashboard.php');
	}

    include('inc/footer.php');