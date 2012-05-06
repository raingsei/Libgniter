<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?=$this->uri->segment(1)?></title>
	<link rel="stylesheet" href="<?=base_url()?>css/style.css" type="text/css" media="screen" />
	<link type="text/css" href="<?=base_url()?>css/jquery-ui-1.8.11.custom.css" rel="stylesheet" />
	<script type="text/javascript" src="<?=base_url()?>js/jquery-1.5.1.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/jquery-ui-1.8.11.custom.min.js"></script>
	<script>
		$(function(){
			$('#logo').css('cursor','pointer').click(function(){
				location.href="<?=base_url()?>";
			});
			$('#logout').click(function(){
				location.href="<?=base_url()?>index.php?action=logout";
			});
			$.fn.slideFadeToggle = function(speed, easing, callback) {
				return this.animate({opacity: 'toggle', height: 'toggle'}, speed, easing, callback);
			};
			$.ajaxSetup({cache:false});
		});
	</script>
</head>
<body>
	<h1 id="logo">IRC Book Selection System</h1>
	<div id="userbox">
		Welcome <?=$this->session->userdata('email_address')?>!<br />
		<?=anchor('loginController/logout', 'Logout')?>
	</div>
	<br style="clear:both" />