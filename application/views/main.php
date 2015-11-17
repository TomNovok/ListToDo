<?php require_once("header.php"); ?>
<?php
	if (isset($id_m) && isset($url_name))
		$onbeforeunload = "ajaxSaveInfo('$id_m', '/information/infoeditor/$url_name');";
	else
		$onbeforeunload = "";
?>
<body onbeforeunload="<?php echo $onbeforeunload; ?>">
<div class="main__header"><?php require_once(APPPATH."views/head.php"); ?></div>
<?php
	$addition3="";
	$addition4="";
	if ($status_menu=="menu_hide")
	{
		$addition3="hide";
		$addition4="main__middle-with-hide";
	}
?>
<div class='main__middle <?php echo $addition4; ?>'>
	<div class='main__wrapper'>
		
        <div id='dates_json' style='display: none'><?php echo $dates_json; ?></div>
		<div class="main__left-area">
			<div class='main__menu'><?php require_once(APPPATH."views/menu.php"); ?></div>
			<div class='main__calendar <?php echo $addition3; ?>'><?php require_once(APPPATH."views/calendar.php"); ?></div>
		</div>
		<div class="main__working-area" id='working_area'>
			<?php require_once(APPPATH."views/".$what.".php"); ?>
		</div>
	</div>
</div>
<div class="main__footer"><?php require_once(APPPATH."views/foot.php"); ?></div>
<?php require_once("footer.php"); ?>