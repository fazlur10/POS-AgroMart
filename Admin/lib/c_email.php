<?php
class c_email 
{
	var $smtp_server = 'localhost';
	var $smtp_port = '25';

	function send($to,$subject,$from,$message){
		mail($to, $subject, $message);
	}
}