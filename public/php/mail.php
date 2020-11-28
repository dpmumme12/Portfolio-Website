<?php
    require 'vendor/autoload.php';

    $to = 'dougmumme@gmail.com'; // Replace this Mail ID with yours
    $websiteURL = "https://douglasmumme.herokuapp.com/"; // Replace Your Website URL for Show Logo
	$websiteName = "douglasmumme"; // Replace Your Website Name for Show Logo alt Text.
	
	$name = $_POST["name"];
    $email = $_POST["email"];
    $text= $_POST["message"];

    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= "From: " . $email . "\r\n"; // Sender's E-mail
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $message ='<table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
  <tr>
    <td align="center" valign="top"><table width="600" bgcolor="#eee" valign="top" style="font-size:17px; padding:25px;">
        <tr>
          <td style="text-align:center;" width="100" valign="top"><img src="'.$websiteURL.'/images/logo.png" alt="'.$websiteName.'"/></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="center" valign="top">
	<table width="600" bgcolor="#f8f6fe" cellpadding="7" style="font-size:16px; padding:30px; line-height: 28px;">
        <tr>
            <td style="text-align:right; padding-right: 20px;" width="25%" valign="top"><strong>Name:</strong></td>
			<td>'.$name.'</td>
        </tr>
        <tr>
			<td style="text-align:right; padding-right: 20px;" valign="top"><strong>Email:</strong></td>
			<td>'.$email.'</td>
		</tr>
        <tr>
			<td style="text-align:right; padding-right: 20px;" valign="top"><strong>Message:</strong></td>
			<td>'.$text.'</td>
		</tr>
    </table>
	</tr>
	</td>
	</table>';
	
	$success = "Thank you for contacting us. We will be in touch with you very soon."; // Success Message Text
    $failed = "Sorry! This message sent is unsuccessful."; // Failed Message Text
    
    $from = new SendGrid\Email(null, $email);
    $subject = "Hello World from the SendGrid PHP Library!";
    $to = new SendGrid\Email(null, $to);
    $content = new SendGrid\Content("text/html", $message);
    $mail = new SendGrid\Mail($from, $subject, $to, $content);

    $apiKey = getenv('SENDGRID_API_KEY');
    $sg = new \SendGrid($apiKey);

    $response = $sg->client->mail()->send()->post($mail);
    echo $response->statusCode();
    echo $response->headers();
    echo $response->body();

    /*if (@mail($to, $email, $message, $headers))
    {
        echo ' <div class="alert alert-success alert-dismissible fade show text-3 text-left"><i class="fa fa-check-circle"></i> '.$success.' <button type="button" class="close font-weight-500 mt-1" data-dismiss="alert">&times;</button></div> ';
    }else{
        echo ' <div class="alert alert-danger alert-dismissible fade show text-3 text-left"><i class="fa fa-times-circle"></i> '.$failed.' <button type="button" class="close font-weight-500 mt-1" data-dismiss="alert">&times;</button></div> ';
    }*/
    
?>