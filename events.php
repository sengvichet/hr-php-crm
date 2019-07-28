<!DOCTYPE html>
<html lang="en">
<head>
<?php
include("_headerdata1.php");
print "\n";
?>
<title>Human Resource Consulting | Events | Sacramento, California</title>
<?php
include("_headerdata2.php");
print "\n";
?>
<meta name="description" content="HR Done Right - On-site, outsourced HR - We handle HR-related tasks for organizations without an in-house HR option.">
<meta name="keywords" content="Human Resources, HR, Consultants, Outsourced HR, Capacity Building, Assessments, Special projects, Legal counsel, Management, Strategy, HR Services, Compliance, Programs, Training, Regulation, Outsourcing, Employee Handbooks, Diversity, HR compliance maintenance, Employee Relations, Recruiting, Hiring, Retention, Benefits administration">
</head>
<body>
<?php
include("_pageheader.php");
print "\n";
?>
<a id='eventPage' class='pageAnchor'></a>
<div class="container">
  <div class="pageContain">
    <div class="pageContent">
      <div class="row">
        <div class="col-md-12">
          <h1>Events</h1>
          <div class="pageImageRight" style="margin-left:35px;"><img src="images/eventsPhoto01.jpg" style="max-width:500px;"></div>
<?php
$event1selected = "";
$event2selected = "";
	if(isset($_POST['eventselectform']))
	{
	$eventSelect = $_POST['eventSelect'];
		switch($eventSelect)
		{
	    case "harassmentPreventionTraining":
        $event1selected = "selected";
        break;
    	case "anotherTraining":
        $event2selected = "selected";
        break;
		}
	}
?>
          <?php
		  $paymentSelect = $_POST['paymentSelect'];
          if($paymentSelect != "payNow")
		  {
		  ?>
		  <em>Please select the event you are interested in below:</em>
          <form action="events.php" method="post">
            <select id="eventSelect" name="eventSelect">
              <option value="">Please Select</option>
              <option value="harassmentPreventionTraining" <?php print "$event1selected"; ?> >Harassment Prevention Training</option>
              <!--<option value="anotherTraining" <?php //print "$event2selected"; ?> >Another Training</option>-->
            </select>
            <input type="submit" value="Submit" name="eventselectform" class="hideMe" id="eventSelectSubmit">
          </form>
          <hr>
          <?php
		  }
		  ?>
<?php
	if(isset($_POST['eventselectform']))
	{
	$eventSelect = $_POST['eventSelect'];
		switch($eventSelect)
		{
	    case "harassmentPreventionTraining":
        include("_harassmentPreventionTraining.php");
		break;
		}
	}

	if(isset($_POST['contactformsubmit']))
	{
	// EDIT THE 2 LINES BELOW AS REQUIRED
	//$email_to = "scott@scottseviour.com";
	//$email_to = "mars32183@gmail.com";
	$email_to = "info@hrdoneright.com";
	$email_subject = "Registration Request from HR Done Right Events Page";

	$event_selected = $_POST['event_selected']; // hidden automatically filled

	$first_name = $_POST['first_name']; // required
	$last_name = $_POST['last_name']; // required
	$position = $_POST['position']; // not required
	$organization = $_POST['organization']; // not required
	$email_from = $_POST['email']; // required
	$telephone = $_POST['telephone']; // not required
	$offercode = $_POST['offercode']; // not required
	$num_guests = $_POST['numOfGuests']; // required

	$paymentSelect = $_POST['paymentSelect']; // required

	$error_message = "";
	$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
		if(!preg_match($email_exp,$email_from)) {
			$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
		}
		$string_exp = "/^[A-Za-z .'-]+$/";
		if(!preg_match($string_exp,$first_name)) {
			$error_message .= 'The First Name you entered does not appear to be valid.<br />';
		}
		if(!preg_match($string_exp,$last_name)) {
			$error_message .= 'The Last Name you entered does not appear to be valid.<br />';
		}
		if($num_guests == "") {
			$error_message .= 'You must select the number of guests you would like to register.<br />';
		}
		if($paymentSelect == "") {
			$error_message .= 'You must select a payment method.<br />';
		}

		$eventCost = "69.00";
		$offerCodeApplied = "";
		$offercode1_exp = "/^HRDRT20$/";
		$offercode2_exp = "/^HRDRT16$/";
		if(!preg_match($offercode1_exp,$offercode) && !preg_match($offercode2_exp,$offercode) && $offercode != "") {
			$error_message .= 'The Offer Code you entered does not appear to be valid.<br />';
		}
		if($offercode != "") {
			if( preg_match($offercode1_exp,$offercode) || preg_match($offercode2_exp,$offercode) )
			{
			$eventCost = $eventCost - 30;
			$offerCodeApplied = "(offer code applied - $30 discount)";
			}
		}

		$event_emailContent = $_POST['event_emailContent']; // hidden hardcoded
		switch($event_emailContent)
		{
	    case 1:
        $eventDetails = "<p><strong style='font-weight:bold; color:#003d72;'>Program Details</strong><br>
        Thursday September 15, 2016<br>
        8:00AM Registration<br>
        8:30 - 10:30AM Training</p>
      <p><strong style='font-weight:bold; color:#003d72;'>Location</strong><br>
        601 University Ave, Suite 250<br>
        Sacramento, CA 95825</p>
      <p><strong style='font-weight:bold; color:#003d72;'>Cost</strong><br>
        $$eventCost per person $offerCodeApplied</p>
      <p><strong style='font-weight:bold; color:#003d72;'>Questions?</strong><br>
        Call us at <a href='tel:8888055421'>888-805-5421</a><br>
        or email <a href='mailto:info@hrdoneright.com'>info@hrdoneright.com</a></p>";
		break;
		}


		if(strlen($error_message) > 0) {
			$errors_found = $error_message;
		}

		if(isset($errors_found))
		{
		$error = $errors_found;
		echo "We are very sorry, but there were error(s) found with the form you submitted. ";
		echo "These errors appear below.<br /><br />";
		echo $error."<br /><br />";
		echo "Please go back and fix these errors. <a href='events.php'>Click here to return to the events page.</a><br /><br />";
		}
		else
		{
		$email_message = "<html><body>";
		$email_message .= "<strong style='font-weight:bold; color:#003d72;'>Registration request details below:</strong><br>\n\n";

		  function clean_string($string) {
			$bad = array("content-type","bcc:","to:","cc:","href");
			return str_replace($bad,"",$string);
		  }

		$email_message .= "Event Selected: ".clean_string($event_selected)."<br>\n";
			if($paymentSelect == "payNow")
			{
			$email_message .= "Payment Type Selected: Pay Now via PayPal<br>\n";
			}
			elseif($paymentSelect == "payLater")
			{
			$email_message .= "Payment Type Selected: Pay Later<br>\n";
			}
		$email_message .= "First Name: ".clean_string($first_name)."<br>\n";
		$email_message .= "Last Name: ".clean_string($last_name)."<br>\n";
		$email_message .= "Position: ".clean_string($position)."<br>\n";
		$email_message .= "Organization: ".clean_string($organization)."<br>\n";
		$email_message .= "Email: ".clean_string($email_from)."<br>\n";
		$email_message .= "Phone Number: ".clean_string($telephone)."<br>\n";
		$email_message .= "Number of Guests: ".clean_string($num_guests)."<br>\n";
		$email_message .= "<hr>\n $eventDetails <br>\n";

		$email_message .= "</body></html>";
		// create email headers
		$headers = 'From: '.$email_from."\r\n".
		'Reply-To: '.$email_from."\r\n" .
		'X-Mailer: PHP/' . phpversion() ."\r\n" .
		'Content-type: text/html; charset=iso-8859-1';
		@mail($email_to, $email_subject, $email_message, $headers);

		// client copy
		$email_subject = "Registration Details for HR Done Right Event";
		$headers = 'From: '."info@hrdoneright.com"."\r\n".
		'Reply-To: '."info@hrdoneright.com"."\r\n" .
		'X-Mailer: PHP/' . phpversion() ."\r\n" .
		'Content-type: text/html; charset=iso-8859-1';
		@mail($email_from, $email_subject, $email_message, $headers);

		//success
		print "<p>Thank You!</p>
		<p><strong>Your form was submitted. Thank you for your interest.</strong></p>";

			if($paymentSelect == "payNow")
			{
			print "<em><strong class='subhead'>Important</strong></em><br>
			<p>Please click the button below to complete your payment:</p>";
			print "<form action='https://www.paypal.com/cgi-bin/webscr' method='post' id='checkOutForm'><input type='hidden' name='cmd' value='_cart'><input type='hidden' name='upload' value='1'><input type='hidden' name='business' value='info@hrdoneright.com'>";
				for($i=1; $i < $num_guests + 1; $i++)
				{
				print "<input type='hidden' name='item_name_$i' value='$event_selected for ";
					if($i > 1)
					{
					print "guest of ";
					}
				print $first_name . " " . $last_name . "'><input type='hidden' name='amount_$i' value='$eventCost'>";
				}
			print "<input type='submit' value='Pay Now via PayPal'></form>";
			}
			else
			{
			print "<p>You selected to pay for this event later. Please submit payment 7 days prior to event (make check/money order payable to: HR Done Right). Please reference the training you are interested in attending.</p>
			<p><strong class='subhead'>Mail to:</strong><br>
			HR Done Right Inc.<br>
			601 University Avenue, Suite 250<br>
			Sacramento, CA 95825<br><br>
			Thank you for attending!</p>";
			}

		}
	}
?>
        </div>
        <div class="clearBoth"></div>
      </div>
    </div>
  </div>
</div>
<?php
include("_pagefooter.php");
print "\n";
?>
</body>
</html>
