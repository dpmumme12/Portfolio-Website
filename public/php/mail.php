<?php
    require ('/app/public/vendor/autoload.php');


    $to = 'test-1ljrozxnn@srv1.mail-tester.com'; // Replace this Mail ID with yours
	
	$name = $_POST["name"];
    $email = $_POST["email"];
    $text = $_POST["message"];
    
    $from = new SendGrid\Email(null, 'doug@douglasmumme.com ');
    $subject = "Message from Portfolio-Site from $email.";
    $to = new SendGrid\Email(null, $to);
    $content = new SendGrid\Content("text/plain", $text);
    $mail = new SendGrid\Mail($from, $subject, $to, $content);

    $apiKey = getenv('SENDGRID_API_KEY');
    $sg = new \SendGrid($apiKey);
	
	$success = "Thank you for contacting me. I will be in touch with you very soon."; // Success Message Text
    $failed = "Sorry! This message sent is unsuccessful."; // Failed Message Text
    
    

    if ($sg->client->mail()->send()->post($mail))
    {
        echo ' <div class="alert alert-success alert-dismissible fade show text-3 text-left"><i class="fa fa-check-circle"></i> '.$success.' <button type="button" class="close font-weight-500 mt-1" data-dismiss="alert">&times;</button></div> ';
    }else{
        echo ' <div class="alert alert-danger alert-dismissible fade show text-3 text-left"><i class="fa fa-times-circle"></i> '.$failed.' <button type="button" class="close font-weight-500 mt-1" data-dismiss="alert">&times;</button></div> ';
    }
    
?>