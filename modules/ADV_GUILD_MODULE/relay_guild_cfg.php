<?php
   /*
   ** Author: Derroylo (RK2)
   ** Description: Guestrelay config(on/off)
   ** Version: 1.0
   **
   ** Developed for: Budabot(http://sourceforge.net/projects/budabot)
   **
   ** Date(created): 23.11.2005
   ** Date(last modified): 08.03.2006
   ** 
   ** Copyright (C) 2005, 2006 Carsten Lohmann
   **
   ** Licence Infos: 
   ** This file is part of Budabot.
   **
   ** Budabot is free software; you can redistribute it and/or modify
   ** it under the terms of the GNU General Public License as published by
   ** the Free Software Foundation; either version 2 of the License, or
   ** (at your option) any later version.
   **
   ** Budabot is distributed in the hope that it will be useful,
   ** but WITHOUT ANY WARRANTY; without even the implied warranty of
   ** MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   ** GNU General Public License for more details.
   **
   ** You should have received a copy of the GNU General Public License
   ** along with Budabot; if not, write to the Free Software
   ** Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
   */

if (preg_match("/^guildrelay off$/i", $message)) {
    if($this->settings["relaybot"] != "0") {
		bot::savesetting("relaybot", "0");
		$msg = "<highlight>Guildrelay<end> has been turned <red>off<end>";      
    } else
        $msg = "Guild Relay wasn't enabled.";
            
    // Send info back
    if($type == "msg")
        bot::send($msg, $sender);
    elseif($type == "priv")
   	    bot::send($msg);
    elseif($type == "guild")
      	bot::send($msg, "guild");

} else if(preg_match("/^guildrelay (.+)$/i", $message, $arr)){
    $uid = AoChat::get_uid($arr[1]);
    $bot = ucfirst(strtolower($arr[1]));
	
    if(!$uid)
        $msg = "Bot <highlight>$bot<end> does not exist.";
    elseif($this->vars["relaybot"] == $bot)
        $msg = "Relaying already chat with <highlight>$bot<end>";
    else{
      	bot::savesetting("relaybot", $bot);
        $msg = "Relaying guildchat with <highlight>$bot<end>.";
    } 

    // Send info back
    if($type == "msg")
        bot::send($msg, $sender);
    elseif($type == "priv")
      	bot::send($msg);
    elseif($type == "guild")
      	bot::send($msg, "guild");
}
?>
