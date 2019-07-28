	<footer>
		<section class="blockSection">
			<div class="container-fluid p-0">
				
				<div class="row  no-gutters">
					<div class="col-xs-12 offset-sm-6 col-sm-6 offset-md-6 col-md-6  col-lg-6 offset-lg-6  col-xl-6 offset-xl-6">
						<div class="sectionTagline">	
							<a href="contact.php">
								<h2 class="text-white">Schedule a consultation<br/> today</h2>
								<p class="readmore">
									Send us a message
								</p>
							</a>
						</div>
						<div class="socialIcons">
							<a href="https://www.linkedin.com/company/hr-done-right"><i class="fab fa-linkedin-in"></i></a>
							<a href="https://www.facebook.com/hrdoneright"><i class="fab fa-facebook-f"></i></a>
							<a href="contact.php"><i class="far fa-envelope"></i></a>
						</div>
					</div>
				</div>
			</div>
		</section>
				
		<div class="container" id="footerNewsletter">
			<div class="row">
				<div class="col-xs-12 col-sm-7 col-md-5 col-lg-4">
				  <?php
					if(isset($_POST['newslettersignupsubmit'])) {

							// EDIT THE 2 LINES BELOW AS REQUIRED
							//$email_to = "scott@scottseviour.com";
							// $email_to = "ana@transcend-la.com";
							$email_to = "info@hrdoneright.com";
							$email_subject = "Newsletter signup request from HR Done Right website";

							function died($error) {
								// your error code can go here
								echo "We are very sorry, but there were error(s) found with the form you submitted. ";
								echo "These errors appear below.<br /><br />";
								echo $error."<br /><br />";
								echo "Please go back and fix these errors. <a href='index.php'>Click here to return to the home page.</a><br /><br />";
								//die(); //don't die, just don't send email.
							}

							$signupname = $_POST['signupname']; // required
							$email_from = $_POST['signupemail']; // required

							$error_message = "";
							$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
						  if(!preg_match($email_exp,$email_from)) {
							$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
						  }
							$string_exp = "/^[A-Za-z .'-]+$/";
						  if(!preg_match($string_exp,$signupname)) {
							$error_message .= 'The Name you entered does not appear to be valid.<br />';
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

							$email_message .= "Name: ".clean_string($signupname)."\n";
							$email_message .= "Email: ".clean_string($email_from)."\n";

							// create email headers
							$headers = 'From: '.$email_from."\r\n".
							'Reply-To: '.$email_from."\r\n" .
							'X-Mailer: PHP/' . phpversion();
							@mail($email_to, $email_subject, $email_message, $headers);

							//success
							print "<p><strong>Thank you. You have been successfully subscribed to our newsletter.</strong></p>";
						  }
						} else { ?>
							<h2>Join our newsletter</h2>
							<form action="index.php#footerNewsletter" method="post" name="newslettersignup">
								<div class=" pb-2">
									<input class="form-control" maxlength="50" name="signupname" size="30" type="text" placeholder="Your name" required>
								</div>
								<div class=" pb-2">
									<input class="form-control" maxlength="80" name="signupemail" size="30" type="email" placeholder="Email address" required>
								</div>
								<div class="">
									<input type="submit" value="Submit" class="btn btn-secondary" name="newslettersignupsubmit">
								</div>
							</form>
					  <?php } ?>
				</div>
			</div>
		</div>
	</footer>
	<div class="bg-white footerInfo">
		<div class="container p-0">
			<div class="col-12">
				<a href="privacy.php" class="pr-2">Privacy</a> <a href="terms.php" class="pr-2">Terms</a> © 2018, HR Done Right Inc., All Rights Reserved.<br/>
				601 University Avenue, Suite 250, Sacramento, CA 95825
			</div>
		</div>
	</div>



		<script src="assets/js/jquery-3.3.1.min.js"></script>
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/application.js"></script>


		<script src="js/jquery.bootstrap-dropdown-hover.min.js"></script>
		<script src="main.js"></script>
		<script src="events.js"></script>
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-73564274-1', 'auto');
			ga('send', 'pageview');
		</script>
	<body>
</html>