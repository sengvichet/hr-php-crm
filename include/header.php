<?php 
//Page configuration
if(!isset($title)) { $title = "Human Resource Consulting | HR Done Right Inc. |  HR Services and Management | Sacramento, California"; }
if(!isset($description)) { $description = "HR Done Right - Human Resource Consultants - We can help with Recruiting, Hiring, Retention, Employee relations, Benefits administration and Compliance."; }
if(!isset($keywords)) { $keywords = "Human Resources, HR, Consultants, Outsourced HR, Capacity Building, Assessments, Special projects, Legal counsel, Management, Strategy, HR Services, Compliance, Programs, Training, Regulation, Outsourcing, Employee Handbooks, Diversity, HR compliance maintenance, Employee Relations, Recruiting, Hiring, Retention, Benefits administration, HRO"; }

//dafault main meun link active
if(!isset($mainMenuActive)) { $mainMenuActive = "home"; }

//dafault submenu active
if(!isset($subMenuActive)) { $subMenuActive = ""; }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
	<!-- META DATA -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	

	<meta http-equiv="Content-Language" content="en-us">
	<meta http-equiv="reply-to" content="info@hrdoneright.com">
	<meta http-equiv="bulletin-text" content="HR Done Right - Human Resource Consultants -  We can help with Recruiting, Hiring, Retention, Employee relations, Benefits administration and Compliance.">
	<meta name="author" content="info@hrdoneright.com">
	<meta name="publisher" content="info@hrdoneright.com">
	<meta name="copyright" content="info@hrdoneright.com">
	<Meta name="category" content="Human Resources">
	<meta name="resource-type" content="document">
	<meta name="revisit-after" content="7 days">
	<meta name="classification" content="Commercial">
	<meta name="robots" content="index">
	<META NAME="GOOGLEBOT" CONTENT="noarchive">
	<meta name="distribution" content="global">
	<meta name="rating" content="SAFE FOR KIDS">
	<meta name="doc-class" content="Published">
	<meta name="doc-rights" content="hrdoneright.com">
		
		
		
	<title><?php echo $title; ?></title>
	<meta name="description" content="<?php echo $description; ?>">
	<meta name="keywords" content="<?php echo $keywords; ?>">
	<link rel="shortcut icon" href="assets/images/favicon.png">

	<!-- STYLESHEETS -->
	<link rel="stylesheet" href="assets/css/style.css" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
</head>
<body>
	<nav class="responsiveMenu  text-white text-right">
		<div class="closeResponsiveMenu text-secondary"><i class="fas fa-times"></i></div>
		<ul class="navbar-nav m-auto flex">
			<li class="nav-item hasSub">
				<a href="about_us.php" class="<?php echo ($mainMenuActive == "aboutUs" || $subMenuActive == "aboutUsMenu") ? "active" : ""; ?>">About</a>
				<ul class="list-unstyled">
					<li>
						<a href="about_us.php" class="<?php echo ($mainMenuActive == "aboutUs") ? "active" : ""; ?>">About Us</a>
					</li>
					<li>
						<a href="company_news.php" class="<?php echo ($mainMenuActive == "company_news") ? "active" : ""; ?>">Company News</a>
					</li>
					<li>
						<a href="our_team.php" class="<?php echo ($mainMenuActive == "our_team") ? "active" : ""; ?>">Our Team</a>
					</li>
					<li>
						<a href="memberships.php" class="<?php echo ($mainMenuActive == "memberships") ? "active" : ""; ?>">Memberships</a>
					</li>
					<li>
						<a href="careers.php" class="<?php echo ($mainMenuActive == "careers") ? "active" : ""; ?>">Careers</a>
					</li>
				</ul>
			</li>
			<li class="nav-item hasSub">
				<a href="servicesOutsourcedHR.php"  class="<?php echo ($mainMenuActive == "aervices" || $subMenuActive == "servicesMenu") ? "active" : ""; ?>">Services</a>
				<ul class="list-unstyled">
					<li>
						<a href="servicesOutsourcedHR.php" class="<?php echo ($mainMenuActive == "services.php?page=OutsourcedHR") ? "active" : ""; ?>">Outsourced HR</a>
					</li>
					<li>
						<a href="servicesCapacityBuilding.php" class="<?php echo ($mainMenuActive == "services.php?page=CapacityBuilding") ? "active" : ""; ?>">Capacity Building</a>
					</li>
					<li>
						<a href="servicesCustomHRSolutions.php" class="<?php echo ($mainMenuActive == "services.php?page=SpecialProjects") ? "active" : ""; ?>">Custom HR Solutions</a>
					</li>
					<li>
						<a href="servicesLegalCounsel.php" class="<?php echo ($mainMenuActive == "services.php?page=LegalCounsel") ? "active" : ""; ?>">Legal Counsel</a>
					</li>
				</ul>
			</li>
			<li class="nav-item hasSub">
				<a href="newsletter.php" class="<?php echo ($mainMenuActive == "resources" || $subMenuActive == "resourcesMenu") ? "active" : ""; ?>">Resources</a>
				<ul class="list-unstyled">
					<li>
						<a href="newsletter.php" class="<?php echo ($mainMenuActive == "newsletter") ? "active" : ""; ?>">Newsletter</a>
					</li>
					<li>
						<a href="blog.php" class="<?php echo ($mainMenuActive == "blog") ? "active" : ""; ?>">Blog</a>
					</li>
				</ul>
			</li>
			<li class="nav-item">
				<a href="partners.php" class="<?php echo ($mainMenuActive == "partners") ? "active" : ""; ?>">Partners</a>
			</li>
			<li class="nav-item">
				<a href="contact.php" class="<?php echo ($mainMenuActive == "contact") ? "active" : ""; ?>">Contact</a>
			</li>
		</ul>
	</nav>
	<header>
		<div class="container">
			<nav class="navbar navbar-expand-lg p-0  pt-3 mb-3">
				<a class="navbar-brand p-0 m-0" href="/">
					<img src="assets/images/logo.png" alt="HRDoneRight" class="img-fluid" title="HRDoneRight" />
				</a>
				<div class="ml-auto text-right">
					
					<nav class="navbar-dark bg-primary">
						<button class="navbar-toggler" type="button">
							<span class="navbar-toggler-icon"></span>
						</button>
					</nav>
					<div class="contact-info  d-none d-lg-block">
						Call: <a href="tel:8888055421">888-805-5421</a>
					</div>
					
					
					
					<div class="d-none d-lg-block mainMenu">
						<ul class="navbar-nav m-auto flex">
							<li class="nav-item">
								<a href="about_us.php" class="dropdownOwner <?php echo ($mainMenuActive == "aboutUs" || $subMenuActive == "aboutUsMenu") ? "active" : ""; ?>" id="aboutUsMenu">About</a>
							</li>
							<li class="nav-item">
								<a href="servicesOutsourcedHR.php" class="dropdownOwner <?php echo ($mainMenuActive == "aervices" || $subMenuActive == "servicesMenu") ? "active" : ""; ?>" id="servicesMenu">Services</a>
							</li>
							<li class="nav-item">
								<a href="newsletter.php" class="dropdownOwner <?php echo ($mainMenuActive == "resources" || $subMenuActive == "resourcesMenu") ? "active" : ""; ?>" id="resourcesMenu">Resources</a>
							</li>
							<li class="nav-item">
								<a href="partners.php" class="<?php echo ($mainMenuActive == "partners") ? "active" : ""; ?>">Partners</a>
							</li>
							<li class="nav-item">
								<a href="contact.php" class="<?php echo ($mainMenuActive == "contact") ? "active" : ""; ?>">Contact</a>
							</li>
						</ul>
					</div>
					
					
				</div>
			</nav>
		</div>
			
		<div class="sub-menu d-none d-lg-block">
				<div class="d-none bg-light <?php echo ($subMenuActive == "aboutUsMenu") ? "d-block baseSubmenu" : ""; ?>" data-wrapper="aboutUsMenu">
					<div class="container">
						<div class="d-flex flex-column flex-md-row justify-content-end">
							<a href="company_news.php" class="<?php echo ($mainMenuActive == "company_news") ? "active" : ""; ?>">Company News</a>
							<a href="our_team.php" class="<?php echo ($mainMenuActive == "our_team") ? "active" : ""; ?>">Our Team</a>
							<a href="memberships.php" class="<?php echo ($mainMenuActive == "memberships") ? "active" : ""; ?>">Memberships</a>
							<a href="careers.php" class="<?php echo ($mainMenuActive == "careers") ? "active" : ""; ?>">Careers</a>
						</div>
					</div>
				</div>
				<div class="d-none bg-light <?php echo ($subMenuActive == "servicesMenu") ? "d-block baseSubmenu" : ""; ?>" data-wrapper="servicesMenu">
					<div class="container">
						<div class="d-flex flex-column flex-md-row justify-content-end">
							<a href="servicesOutsourcedHR.php" class="<?php echo ($mainMenuActive == "services.php?page=OutsourcedHR") ? "active" : ""; ?>">Outsourced HR<div class="clearfix"></div><span class="small">We&rsquo;ll be your HR team</span></a>
							<a href="servicesCapacityBuilding.php" class="<?php echo ($mainMenuActive == "services.php?page=CapacityBuilding") ? "active" : ""; ?>">Capacity Building<div class="clearfix"></div><span class="small">We&rsquo;ll support your existing HR Team</span></a>
							<a href="servicesCustomHRSolutions.php" class="<?php echo ($mainMenuActive == "services.php?page=SpecialProjects") ? "active" : ""; ?>">Custom HR Solutions<div class="clearfix"></div><span class="small">We&rsquo;ll customize solutions</span></a>
							<a href="servicesLegalCounsel.php" class="<?php echo ($mainMenuActive == "services.php?page=LegalCounsel") ? "active" : ""; ?>">Legal Counsel<div class="clearfix"></div><span class="small">We&rsquo;ll help you reduce employment law risk</span></a>
						</div>
					</div>
				</div>
				<div class="d-none bg-light <?php echo ($subMenuActive == "resourcesMenu") ? "d-block baseSubmenu" : ""; ?>" data-wrapper="resourcesMenu">
					<div class="container">
						<div class="d-flex flex-column flex-md-row justify-content-end">
							<a href="newsletter.php" class="<?php echo ($mainMenuActive == "newsletter") ? "active" : ""; ?>">Newsletter</a>
							<a href="blog.php" class="<?php echo ($mainMenuActive == "blog") ? "active" : ""; ?>">Blog</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	