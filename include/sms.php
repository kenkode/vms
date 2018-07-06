<?php
// Be sure to include the file you've just downloaded
require_once('AfricasTalkingGateway.php');
// Specify your authentication credentials
$username   = "kenkode";
$apikey     = "a9e3baf44b48ac640b8a7c508aed90c6525153fde41f48ef7ac62e6bfc21d055";
// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
$recipients = $phone;
// And of course we want our recipients to know what we really do
$message    = "Hello, Please use this verification code to access the VMS system ".$code;
// Create a new instance of our awesome gateway class
$gateway    = new AfricasTalkingGateway($username, $apikey);
/*************************************************************************************
  NOTE: If connecting to the sandbox:
  1. Use "sandbox" as the username
  2. Use the apiKey generated from your sandbox application
     https://account.africastalking.com/apps/sandbox/settings/key
  3. Add the "sandbox" flag to the constructor
  $gateway  = new AfricasTalkingGateway($username, $apiKey, "sandbox");
**************************************************************************************/
// Any gateway error will be captured by our custom Exception class below, 
// so wrap the call in a try-catch block
try 
{ 
  // Thats it, hit send and we'll take care of the rest. 
  $results = $gateway->sendMessage($recipients, $message);

    mysql_query("INSERT INTO session_codes(phone,code,created_at,updated_at) VALUES('$phone','$code',NOW(),NOW()) ",$con);
    if(mysql_error()==""){
        $phone = str_replace('+','',$phone);
        header("Location:user-details.php?phone=".$phone);
    }
    else{
        echo '<p style="color: #D8000C;font-weight: bold;">Something Went Wrong, Try Again.</p>';
    }
            
  foreach($results as $result) {
    // status is either "Success" or "error message"
    echo " Number: " .$result->number;
    echo " Status: " .$result->status;
    echo " StatusCode: " .$result->statusCode;
    echo " MessageId: " .$result->messageId;
    echo " Cost: "   .$result->cost."\n";
  }
}
catch ( AfricasTalkingGatewayException $e )
{
//   echo "Encountered an error while sending: ".$e->getMessage();
echo '<p style="color: #D8000C;font-weight: bold;">Something Went Wrong, Try Again.</p>';
}
// DONE!!! 