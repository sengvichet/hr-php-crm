<?php
//Page configuration
$title = "Human Resource Consulting | Contact us with your questions about Human Resources | Sacramento, California";
$description = "HR Done Right - On-site, outsourced HR - We handle HR-related tasks for organizations without an in-house HR option.";
$keywords = "Human Resources, HR, Consultants, Outsourced HR, Capacity Building, Assessments, Special projects, Legal counsel, Management, Strategy, HR Services, Compliance, Programs, Training, Regulation, Outsourcing, Employee Handbooks, Diversity, HR compliance maintenance, Employee Relations, Recruiting, Hiring, Retention, Benefits administration";

//main meun link active
$mainMenuActive = "contact";

include("include/header.php"); ?>

<article>
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-6">
				<h1>Contact</h1>
				<p><em>Questions about Human Resources?</em><br>
				Phone number: <a href="tel:9167793901">916-779-3901</a><br>
				Toll-free phone number: <a href="tel:8888055421">888-805-5421</a><br>
				Fax: 916-779-3902<br>
				Email: <a href="mailto:info@hrdoneright.com">info@hrdoneright.com</a><br>
				Address: 601 University Avenue, Suite 250, Sacramento, CA 95825 </p>
				<hr>

			  <?php
				if(isset($_POST['contactformsubmit'])) {

				  // EDIT THE 2 LINES BELOW AS REQUIRED
				  //$email_to = "scott@scottseviour.com";
					// $email_to = "ana@transcend-la.com";
					$email_to = "info@hrdoneright.com";
					$email_subject = "Message from HR Done Right website";

					function died($error) {
						// your error code can go here
						echo "We are very sorry, but there were error(s) found with the form you submitted. ";
						echo "These errors appear below.<br /><br />";
						echo $error."<br /><br />";
						echo "Please go back and fix these errors. <a href='contact.php'>Click here to return to the contact page.</a><br /><br />";
						//die(); //don't die, just don't send email.
					}

					$first_name = $_POST['first_name']; // required
					$last_name = $_POST['last_name']; // required
					$position = $_POST['position']; // not required
					$organization = $_POST['organization']; // not required
					$email_from = $_POST['email']; // required
					$telephone = $_POST['telephone']; // not required
					$subject = $_POST['subject']; // not required
					$message = $_POST['message']; // not required

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
				  if(strlen($error_message) > 0) {
					died($error_message);
				  }
				  else
				  {
					$email_message = "Form details below.\n\n";

					function clean_string($string) {
					  $bad = array("content-type","bcc:","to:","cc:","href");
					  return str_replace($bad,"",$string);
					}

					$email_message .= "First Name: ".clean_string($first_name)."\n";
					$email_message .= "Last Name: ".clean_string($last_name)."\n";
					$email_message .= "Position: ".clean_string($position)."\n";
					$email_message .= "Organization: ".clean_string($organization)."\n";
					$email_message .= "Email: ".clean_string($email_from)."\n";
					$email_message .= "Phone Number: ".clean_string($telephone)."\n";
					$email_message .= "Subject: ".clean_string($subject)."\n";
					$email_message .= "Message: ".clean_string($message)."\n";


					// create email headers
					$headers = 'From: '.$email_from."\r\n".
					'Reply-To: '.$email_from."\r\n" .
					'X-Mailer: PHP/' . phpversion();
					@mail($email_to, $email_subject, $email_message, $headers);

					//success
					print "<p>Thank You!</p>
						<p><strong>Thank you for contacting us. We will be in touch with you very soon.</strong></p>";
				  }
				}
				else
				{
				?>
				<p>You can use the form below to send us a message:</p>
				<div class="formContain">
					<form action="contact.php" method="post" name="contactform">
						<div class="form-group">
							<label for="first_name">First Name (required)</label>
							<input class="form-control" maxlength="50" name="first_name" size="30" type="text" required>
						</div>
						<div class="form-group">
							<label for="last_name">Last Name (required)</label>
							<input class="form-control" maxlength="50" name="last_name" size="30" type="text" required>
						</div>
						<div class="form-group">
							<label for="position">Position</label>
							<input class="form-control" maxlength="50" name="position" size="30" type="text">
						</div>
						<div class="form-group">
							<label for="organization">Organization</label>
							<input class="form-control" maxlength="50" name="organization" size="30" type="text">
						</div>
						<div class="form-group">
							<label for="email">Email (required)</label>
							<input class="form-control" maxlength="80" name="email" size="30" type="email" required>
						</div>
						<div class="form-group">
							<label for="telephone">Phone Number (with area code)</label>
							<input class="form-control" maxlength="30" name="telephone" size="30" type="tel">
						</div>
						<div class="form-group">
							<label for="subject">Subject</label>
							<input class="form-control" maxlength="50" name="subject" size="30" type="text">
						</div>
						<div class="form-group">
							<label for="message">Message</label>
							<br>
							<textarea class="form-control" cols="25" maxlength="1000" name="message" rows="6"></textarea>
						</div>
						<div class="form-group" >
							<input type="submit" value="Submit" class="btn btn-lg btn-secondary" name="contactformsubmit">
						</div>
					</form>
				</div>
				  <?php } ?>
			</div>
			
			<div class="col-12 col-sm-6">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3119.506233577193!2d-121.42206068465923!3d38.5681886796227!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x809adaf59e042d2b%3A0x4cee90eb3b8f96c6!2s601+University+Ave+%23250%2C+Sacramento%2C+CA+95825!5e0!3m2!1sen!2sus!4v1452905349843" width="600" height="450" frameborder="0" style="border:0; width:100%;" allowfullscreen></iframe>
			</div>
		</div>
	</div>
</article>



<?php include("include/footer.php"); ?>