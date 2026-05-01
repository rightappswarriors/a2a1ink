<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!-- Always force latest IE rendering engine or request Chrome Frame -->
	<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<!-- Use title if it's in the page YAML frontmatter -->
	<title><?= $page_title ?></title>

	<meta name="description" content="..."/>
	<meta name="keywords" content="..."/>

	<link href="<?= base_url() ?>stylesheets/normalize.css" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url() ?>stylesheets/all.css" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url() ?>stylesheets/header.css" rel="stylesheet" type="text/css"/>
	<link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.1.0/css/font-awesome.min.css" rel="stylesheet"
	      type="text/css"/>

	<script src="<?= base_url() ?>javascripts/modernizr.js" type="text/javascript"></script>

	<link href="<?= base_url() ?>images/favicon.png" rel="icon" type="image/png"/>

	<!-- JS Libraries -->
	<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			var hamburger = $('#hamburger-btn');
			var sidebar = $('#sidebar');
			var overlay = $('#sidebar-overlay');
			var closeBtn = $('#sidebar-close');

			function openSidebar() {
				sidebar.addClass('active');
				overlay.addClass('active');
				$('body').css('overflow', 'hidden');
			}

			function closeSidebar() {
				sidebar.removeClass('active');
				overlay.removeClass('active');
				$('body').css('overflow', '');
			}

			hamburger.on('click', function(e) {
				e.preventDefault();
				hamburger.toggleClass('active');
				if (sidebar.hasClass('active')) {
					closeSidebar();
				} else {
					openSidebar();
				}
			});

			overlay.on('click', closeSidebar);
			closeBtn.on('click', closeSidebar);

			$(document).on('keydown', function(e) {
				if (e.keyCode === 27 && sidebar.hasClass('active')) {
					closeSidebar();
				}
			});

			$(window).on('resize', function() {
				if ($(window).width() > 768 && sidebar.hasClass('active')) {
					closeSidebar();
					hamburger.removeClass('active');
				}
			});
		});
	</script>

	<link href="//cdn.datatables.net/2.3.5/css/dataTables.dataTables.min.css" rel="stylesheet" type="text/css"/>
	<script src="//cdn.datatables.net/2.3.5/js/dataTables.min.js" type="text/javascript"></script>
	<script src="//cdn.datatables.net/buttons/3.2.5/js/dataTables.buttons.js" type="text/javascript"></script>
	<script src="//cdn.datatables.net/buttons/3.2.5/js/buttons.dataTables.js" type="text/javascript"></script>

	<script src="<?= base_url() ?>javascripts/all.js" type="text/javascript"></script>


</head>

<body>
<div id="fb-root"></div>
<script>(function (d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s);
		js.id = id;
		js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=277385395761685";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
<header class="header contain-to-grid">
	<?php
	$CI =& get_instance();
	$CI->load->model('dashboard_model');
	$accountid = $CI->session->userdata('arallink_accountid');
	$show_logo = false;
	$org_logo_url = '';
	if ($accountid) {
	    $org = $CI->dashboard_model->view_info($accountid)->row();
	    if (!empty($org->logo) && file_exists(FCPATH . $org->logo)) {
	        $org_logo_url = base_url() . $org->logo;
	        $show_logo = true;
	    }
	}
 	?>
 	<div class="mobile-menu-toggle">
 		<a href="#" class="hamburger" id="hamburger-btn">
 			<span class="hamburger-box">
 				<span class="hamburger-inner"></span>
 			</span>
 		</a>
 		<a href="<?= site_url() ?>" class="mobile-logo">
 			<?php if ($show_logo): ?>
 				<img src="<?= $org_logo_url ?>" alt="Org Logo" class="org-logo-img">
 			<?php endif; ?>
 			<b>AralLink</b>
 		</a>
 	</div>

 	<!-- Sliding Sidebar (Mobile Navigation) -->
 	<div class="sidebar-overlay" id="sidebar-overlay"></div>
 	<aside class="sidebar" id="sidebar">
 		<div class="sidebar-header">
 			<a href="<?= site_url() ?>" class="sidebar-logo">
 				<?php if ($show_logo): ?>
 					<img src="<?= $org_logo_url ?>" alt="Org Logo" class="org-logo-img">
 				<?php endif; ?>
 				<b>AralLink</b> RFID
 			</a>
 			<button class="sidebar-close" id="sidebar-close">&times;</button>
 		</div>
 		<nav class="sidebar-nav">
 			<div class="input" style="background-color: transparent; flex-direction: column; align-items: stretch;">
 				<button class="value <?= ($page_title == 'Registration' ? 'active' : '') ?>"
 				        onclick="window.location.href=`<?= site_url('register') ?>`"
 				>
 					Register
 				</button>
 				<button class="value <?= ($page_title == 'Sign-in' ? 'active' : '') ?>"
 				        onclick="window.location.href=`<?= site_url('login') ?>`"
 				>
 					Sign-in
 				</button>
 			</div>
 		</nav>
 	</aside>

 	<!-- Desktop Navigation -->
 	<nav class="top-bar desktop-nav" data-topbar>
		<ul class="title-area">
			<li class="name">
				<h1><a href="<?= site_url() ?>">
					<?php if ($show_logo): ?>
						<img src="<?= $org_logo_url ?>" alt="Org Logo" class="org-logo-img">
					<?php endif; ?>
					<b>AralLink</b> RFID System</a></h1>
			</li>
		</ul>

		<div class="nav-wrapper">
			<div class="input">
				<button class="value <?= ($page_title == 'Registration' ? 'active' : '') ?>"
						onclick="window.location.href=`<?= site_url('register') ?>`"
				>
					Register
				</button>
				<button class="value <?= ($page_title == 'Sign-in' ? 'active' : '') ?>"
				        onclick="window.location.href=`<?= site_url('login') ?>`"
				>
					Sign-in
				</button>
			</div>
		</div>
	</nav>
</header>

<div class="wrapper">
	<div class="hero">
		<div class="row">
			<div class="large-12 columns">
				<h1><img src="<?= base_url() ?>arallink.png"/><span><?= $page_title ?></span></h1>
			</div>
		</div>
	</div>

	<form action="<?= site_url('register/process') ?>" method="post" autocomplete="off">

		<div class="row">
			<div class="large-8 columns">
				<h3>Basic information</h3>
			</div>
		</div>
		<div class="row">
			<div class="large-8 columns">
				<div class="table-container">
					<table class="table" width="100%" border="0" style="border:0;">
						<tbody>
						<tr>
							<td style="width:25%" class="text-right">Organization</td>
							<td style="width:75%"><input type="text" name="organization"
							                             value="<?= set_value('organization') ?>"
							                             placeholder="University of Cebu" required></td>
						</tr>
						<tr>
							<td style="width:25%" class="text-right">Address</td>
							<td style="width:75%"><input type="text" name="address" value="<?= set_value('address') ?>"
							                             placeholder="Cebu City" required></td>
						</tr>
						<tr>
							<td style="width:25%" class="text-right">Contact No.</td>
							<td style="width:75%"><input type="text" name="contactno" value="<?= set_value('contactno') ?>"
							                             placeholder="092882717732" required></td>
						</tr>
						<tr>
							<td style="width:25%" class="text-right">E-mail Address</td>
							<td style="width:75%"><input type="text" name="email" value="<?= set_value('email') ?>"
							                             placeholder="email@gmail.com" required></td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="large-8 columns">
				<h3>Login information</h3>
			</div>
		</div>
		<div class="row">
			<div class="large-8 columns">
				<div class="table-container">
					<table class="table auth-form-table" width="100%" border="0" style="border:0;">
						<tbody>
						<tr>
							<td style="width:25%" class="text-right">Username</td>
							<td style="width:75%"><input type="text" name="username" placeholder="Entrance RFID"
							                             autocomplete="off" required></td>
						</tr>
						<tr>
							<td style="width:25%" class="text-right">Password</td>
							<td style="width:75%">
								<input type="password" id="password" name="password" autocomplete="off"
								       placeholder="***********" required>
								<p id="password-msg"></p>
							</td>
						</tr>
						<tr>
							<td style="width:25%" class="text-right">Repeat password</td>
							<td style="width:75%">
								<input type="password" id="rpassword" name="rpassword" autocomplete="off"
								       placeholder="***********" required>
								<p id="password-match-msg"></p>
							</td>
						</tr>
						<tr style="background-color:#fff">
							<td></td>
							<td style="text-align:right;">
								<button type="submit" class="button small success"><span class="icon icon-save"></span>
									Submit
								</button>
							</td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

	</form>

</div>


<footer class="footer row">
	<div class="columns">
		<div class="footer_lists-container row collapse">
			<div class="footer_social columns large-2">
				<ul class="social">
					<li class="twitter"><a href="#">Follow us on Twitter</a></li>
					<li class="facebook"><a href="#">Like us on Facebook</a></li>
				</ul>

				<p class="footer_copyright">Copyright &copy; 2025, JDENTech IT Solutions</p>
			</div>
			<ul class="footer_links columns large-9">
				<li><a href="arallink_info.html">AralLink Info</a></li>
				<li><a href="privacy_policy.html">Privacy Policy</a></li>

			</ul>
		</div>
	</div>
</footer>
<script>
	const password = document.getElementById('password');
	const rpassword = document.getElementById('rpassword');

	const msg = document.getElementById('password-msg');
	const matchMsg = document.getElementById('password-match-msg');

	password.addEventListener('input', validatePassword);
	rpassword.addEventListener('input', checkMatch);

	function validatePassword() {
		const value = password.value;

		const hasLower = /[a-z]/.test(value);
		const hasUpper = /[A-Z]/.test(value);
		const hasNumber = /[0-9]/.test(value);
		const maxLength = value.length <= 8;

		let errors = [];

		if (!hasLower) errors.push("lowercase letter");
		if (!hasUpper) errors.push("uppercase letter");
		if (!hasNumber) errors.push("number");
		if (!maxLength) errors.push("max 8 characters");

		if (errors.length > 0) {
			msg.style.color = "red";
			msg.textContent = "Must contain: " + errors.join(", ");
		} else {
			msg.style.color = "green";
			msg.textContent = "Password looks good ✔";
		}

		checkMatch();
	}

	function checkMatch() {
		if (rpassword.value === "") {
			matchMsg.textContent = "";
			return;
		}

		if (password.value === rpassword.value) {
			matchMsg.style.color = "green";
			matchMsg.textContent = "Passwords match ✔";
		} else {
			matchMsg.style.color = "red";
			matchMsg.textContent = "Passwords do not match";
		}
	}
</script>
</body>
</html>
