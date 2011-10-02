<?php

$limit = 25;

if (preg_match("/^usage$/i", $message) || preg_match("/^usage ([a-z0-9]+)$/i", $message, $arr)) {
	if (isset($arr)) {
		$time = Util::parseTime($arr[1]);
		if ($time == 0) {
			$msg = "Please enter a valid time.";
			$chatBot->send($msg, $sendto);
			return;
		}
		$time = $time;
	} else {
		$time = 604800;
	}
	
	$timeString = Util::unixtime_to_readable($time);
	$time = time() - $time;
	
	$blob = "<header> :::::: Usage Statistics ({$timeString}) :::::: <end>\n\n";
	
	// most used commands
	$sql = "SELECT command, COUNT(command) AS count FROM usage_<myname> WHERE dt > $time GROUP BY command ORDER BY count DESC LIMIT $limit";
	$db->query($sql);
	$data = $db->fObject('all');
	
	$blob .= "<header> ::: Most Used Commands ::: <end>\n";
	forEach ($data as $row) {
		$blob .= "<highlight>{$row->command}<end> ({$row->count})\n";
	}
	
	// users who have used the most commands
	$sql = "SELECT sender, COUNT(sender) AS count FROM usage_<myname> WHERE dt > $time GROUP BY sender ORDER BY count DESC LIMIT $limit";
	$db->query($sql);
	$data = $db->fObject('all');
	
	$blob .= "\n<header> ::: Most Active Users ::: <end>\n";
	forEach ($data as $row) {
		$blob .= "<highlight>{$row->sender}<end> ({$row->count})\n";
	}
	
	$msg = Text::make_blob("Usage Statistics ({$timeString})", $blob);
	$chatBot->send($msg, $sendto);
} else {
	$syntax_error = true;
}

?>
