<?php

	$MODULE_NAME = "AOJUNKYARD_MODULE";

	//Show Members
	bot::command("", "$MODULE_NAME/wtb.php", "wtb", ALL, "Brings up a listing of items that have been posting to shopping channel");
	bot::event("extPriv", "$MODULE_NAME/wtb.php", "none", "");

?>