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

	<link href="//cdn.datatables.net/2.3.5/css/dataTables.dataTables.min.css" rel="stylesheet" type="text/css"/>
	<script src="//cdn.datatables.net/2.3.5/js/dataTables.min.js" type="text/javascript"></script>
	<script src="//cdn.datatables.net/buttons/3.2.5/js/dataTables.buttons.js" type="text/javascript"></script>
	<script src="//cdn.datatables.net/buttons/3.2.5/js/buttons.dataTables.js" type="text/javascript"></script>

	<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js" type="text/javascript"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js" type="text/javascript"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js" type="text/javascript"></script>

	<script src="//cdn.datatables.net/buttons/3.2.6/js/buttons.html5.min.js" type="text/javascript"></script>
	<script src="//cdn.datatables.net/buttons/3.2.6/js/buttons.print.min.js" type="text/javascript"></script>

	<script src="<?= base_url() ?>javascripts/all.js" type="text/javascript"></script>

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

</head>

<body>
<div id="fb-root"></div>
<script>(
		function (d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s);
			js.id = id;
			js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=277385395761685";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk')
	);
</script>
<header class="header contain-to-grid">
	<?php
	// Load org info for logo - only for sessioned users
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
				<button class="value <?= ($active_menu == 'dashboard' ? 'active' : '') ?>"
				        onclick="window.location.href=`<?= site_url() ?>`"
				>
					Dashboard
				</button>
				<button class="value <?= ($active_menu == 'devices' ? 'active' : '') ?>"
				        onclick="window.location.href=`<?= site_url('devices') ?>`"
				>
					Devices
				</button>
				<button class="value <?= ($active_menu == 'consumers' ? 'active' : '') ?>"
				        onclick="window.location.href=`<?= site_url('consumers') ?>`"
				>
					Consumers
				</button>
				<button class="value <?= ($active_menu == 'logs' ? 'active' : '') ?>"
				        onclick="window.location.href=`<?= site_url('logs') ?>`"
				>
					Logs
				</button>
				<button class="value <?= ($active_menu == 'settings' ? 'active' : '') ?>"
				        onclick="window.location.href=`<?= site_url('settings') ?>`"
				>
					Settings
				</button>
				<nav class="user-window">
					<p>Profile</p>
					<ul>
						<li>
							<button>
								<svg viewBox="0 0 24 24" fill="white" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
									<path d="M12 2c2.757 0 5 2.243 5 5.001 0 2.756-2.243 5-5 5s-5-2.244-5-5c0-2.758 2.243-5.001 5-5.001zm0-2c-3.866 0-7 3.134-7 7.001 0 3.865 3.134 7 7 7s7-3.135 7-7c0-3.867-3.134-7.001-7-7.001zm6.369 13.353c-.497.498-1.057.931-1.658 1.302 2.872 1.874 4.378 5.083 4.972 7.346h-19.387c.572-2.29 2.058-5.503 4.973-7.358-.603-.374-1.162-.811-1.658-1.312-4.258 3.072-5.611 8.506-5.611 10.669h24c0-2.142-1.44-7.557-5.631-10.647z"></path>
								</svg>
								<span><?= $this->session->userdata('arallink_displayname') ?></span>
							</button>
						</li>
						<li>
							<button onclick="window.location.href=`<?= site_url('login/logout') ?>`">
								<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" xmlns="http://www.w3.org/2000/svg">
									<path d="M2.598 9h-1.055c1.482-4.638 5.83-8 10.957-8 6.347 0 11.5 5.153 11.5 11.5s-5.153 11.5-11.5 11.5c-5.127 0-9.475-3.362-10.957-8h1.055c1.443 4.076 5.334 7 9.902 7 5.795 0 10.5-4.705 10.5-10.5s-4.705-10.5-10.5-10.5c-4.568 0-8.459 2.923-9.902 7zm12.228 3l-4.604-3.747.666-.753 6.112 5-6.101 5-.679-.737 4.608-3.763h-14.828v-1h14.826z"></path>
								</svg>
								<span>Log out</span>
							</button>
						</li>
					</ul>
				</nav>
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
				<button class="value <?= ($active_menu == 'dashboard' ? 'active' : '') ?>"
						onclick="window.location.href=`<?= site_url() ?>`"
				>
					Dashboard
				</button>
				<button class="value <?= ($active_menu == 'devices' ? 'active' : '') ?>"
				        onclick="window.location.href=`<?= site_url('devices') ?>`"
				>
					Devices
				</button>
				<button class="value <?= ($active_menu == 'consumers' ? 'active' : '') ?>"
				        onclick="window.location.href=`<?= site_url('consumers') ?>`"
				>
					Consumers
				</button>
				<button class="value <?= ($active_menu == 'logs' ? 'active' : '') ?>"
				        onclick="window.location.href=`<?= site_url('logs') ?>`"
				>
					Logs
				</button>
				<button class="value <?= ($active_menu == 'settings' ? 'active' : '') ?>"
				        onclick="window.location.href=`<?= site_url('settings') ?>`"
				>
					Settings
				</button>
				<!-- User dropdown for desktop -->
				<label class="popup">
					<input type="checkbox" />
					<div tabindex="0" class="burger">
						<svg viewBox="0 0 24 24" fill="white" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
							<path d="M12 2c2.757 0 5 2.243 5 5.001 0 2.756-2.243 5-5 5s-5-2.244-5-5c0-2.758 2.243-5.001 5-5.001zm0-2c-3.866 0-7 3.134-7 7.001 0 3.865 3.134 7 7 7s7-3.135 7-7c0-3.867-3.134-7.001-7-7.001zm6.369 13.353c-.497.498-1.057.931-1.658 1.302 2.872 1.874 4.378 5.083 4.972 7.346h-19.387c.572-2.29 2.058-5.503 4.973-7.358-.603-.374-1.162-.811-1.658-1.312-4.258 3.072-5.611 8.506-5.611 10.669h24c0-2.142-1.44-7.557-5.631-10.647z"></path>
						</svg>
					</div>
					<nav class="popup-window">
						<p>Logged In</p>
						<ul>
							<li>
								<button>
									<svg viewBox="0 0 24 24" fill="white" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
										<path d="M12 2c2.757 0 5 2.243 5 5.001 0 2.756-2.243 5-5 5s-5-2.244-5-5c0-2.758 2.243-5.001 5-5.001zm0-2c-3.866 0-7 3.134-7 7.001 0 3.865 3.134 7 7 7s7-3.135 7-7c0-3.867-3.134-7.001-7-7.001zm6.369 13.353c-.497.498-1.057.931-1.658 1.302 2.872 1.874 4.378 5.083 4.972 7.346h-19.387c.572-2.29 2.058-5.503 4.973-7.358-.603-.374-1.162-.811-1.658-1.312-4.258 3.072-5.611 8.506-5.611 10.669h24c0-2.142-1.44-7.557-5.631-10.647z"></path>
									</svg>
									<span><?= $this->session->userdata('arallink_displayname') ?></span>
								</button>
							</li>
							<li>
								<button onclick="window.location.href=`<?= site_url('login/logout') ?>`">
									<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" xmlns="http://www.w3.org/2000/svg">
										<path d="M2.598 9h-1.055c1.482-4.638 5.83-8 10.957-8 6.347 0 11.5 5.153 11.5 11.5s-5.153 11.5-11.5 11.5c-5.127 0-9.475-3.362-10.957-8h1.055c1.443 4.076 5.334 7 9.902 7 5.795 0 10.5-4.705 10.5-10.5s-4.705-10.5-10.5-10.5c-4.568 0-8.459 2.923-9.902 7zm12.228 3l-4.604-3.747.666-.753 6.112 5-6.101 5-.679-.737 4.608-3.763h-14.828v-1h14.826z"></path>
									</svg>
									<span>Log out</span>
								</button>
							</li>
						</ul>
					</nav>
				</label>
			</div>
		</div>
	</nav>
</header>
