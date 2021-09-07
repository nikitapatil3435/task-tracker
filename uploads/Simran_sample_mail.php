<?php
require_once 'lib/swift_required.php';
session_start();
require_once 'dal/load_data.php';
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
				$task_details= get_data("*", "tbl_complete_task where task_complted_id='" . $_POST['response'] . "'");
				if (isset($task_details)) {
					while ($row = mysqli_fetch_array($task_details)) {
					  $date = $row['date'];
                        $task= $row['task'];
						$state = $row['remark'];
						
					}
				}
				$email_details = get_data("*", "tbl_emails where email_id=1");
				if (isset($email_details)) {
					while ($row = mysqli_fetch_array($email_details)) {
						$from_id = $row['from_id'];
						$password = $row['password'];
						$to_id = $row['to_id'];
						$subject = $row['subject'];
						$messgetext = $row['message'];
						$cc = $row['cc'];
					}
				}
			$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl');
			$transport->setUsername("visitrack.integrate@gmail.com");
			$transport->setPassword("visitrack123!");
			$message = Swift_Message::newInstance();
			eval("\$messgetext = \"$messgetext\";");
			$message->setSubject($subject);
			$message->setBody($messgetext, 'text/html');
			$message->setfrom($from_id);
			$message->setTo($to_id);
			$message->setCc($cc);
			//$message->attach(Swift_Attachment::fromPath("Dispatch.pdf")); 
			$mailer = Swift_Mailer::newInstance($transport);
			if ($mailer->send($message)){
               echo	 "mail send successfully";			
		   }
?>

