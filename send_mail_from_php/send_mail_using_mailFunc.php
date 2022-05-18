<?php
$receiver = "411435ashu@gmail.com";
$subject = "Testing.";
$body = "This is testing for sending mail from xampp";
$header = "From : ashish32623@gmail.com";

if(mail($receiver, $subject, $body, $header)){
    echo "Email Sent to $receiver";
}else{
    echo "Email Not Sent";
}

?>