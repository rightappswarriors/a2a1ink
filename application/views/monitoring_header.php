
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<title>AralLink Timekeeping Display</title>

	<link href="<?= base_url() ?>stylesheets/normalize.css" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url() ?>stylesheets/all.css" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url() ?>stylesheets/header.css" rel="stylesheet" type="text/css"/>
	<link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

	<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>

	<style>
		body {
			background: #f5f7fa;
			min-height: 100vh;
			display: flex;
			flex-direction: column;
		}

		.wrapper {
			flex: 1;
			padding: 30px;
		}

		.container {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
			gap: 24px;
			max-width: 1600px;
			margin: 0 auto;
		}

		.card {
			background: #fff;
			border-radius: 16px;
			overflow: hidden;
			box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
			transition: transform 0.2s ease, box-shadow 0.2s ease;
		}

		.card:hover {
			transform: translateY(-4px);
			box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
		}

		.photo-wrapper {
			position: relative;
			padding-top: 75%;
			overflow: hidden;
		}

		.photo {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			object-fit: cover;
			border: 4px solid #fff;
			box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
		}

		.info {
			padding: 20px 22px 22px;
		}

		.info-row {
			display: flex;
			justify-content: space-between;
			padding: 10px 0;
			border-bottom: 1px solid #f0f0f0;
			font-size: 0.95rem;
		}

		.info-row:last-child {
			border-bottom: none;
		}

		.info-label {
			color: #666;
			font-weight: 500;
		}

		.info-value {
			color: #222;
			font-weight: 600;
		}

		.status-badge {
			display: inline-flex;
			align-items: center;
			gap: 6px;
			padding: 4px 12px;
			border-radius: 20px;
			font-size: 0.85rem;
			font-weight: 600;
		}

		.status-badge.in {
			background: #e8f5e9;
			color: #2e7d32;
		}

		.status-badge.out {
			background: #ffebee;
			color: #c62828;
		}

		.status-dot {
			width: 8px;
			height: 8px;
			border-radius: 50%;
			background: currentColor;
			animation: pulse 2s infinite;
		}

		@keyframes pulse {
			0%, 100% { opacity: 1; }
			50% { opacity: 0.5; }
		}

		@media (max-width: 768px) {
			.wrapper {
				padding: 20px 16px;
			}
		}

		@media (max-width: 480px) {
			.container {
				grid-template-columns: 1fr;
			}
		}
	</style>

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
				<?php if (!$this->session->userdata('arallink_accountid')): ?>
					<button class="value <?= ($active_menu == 'login' ? 'active' : '') ?>"
					        onclick="window.location.href='<?= site_url('login') ?>'"
					>
						Sign-in
					</button>
					<button class="value <?= ($active_menu == 'register' ? 'active' : '') ?>"
					        onclick="window.location.href='<?= site_url('register') ?>'"
					>
						Register
					</button>
					<button class="value <?= ($active_menu == 'monitoring' ? 'active' : '') ?>"
					        onclick="window.location.href='<?= site_url('monitoring') ?>'"
					>
						Monitoring
					</button>
				<?php else: ?>
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
					<button class="value <?= ($active_menu == 'monitoring' ? 'active' : '') ?>"
					        onclick="window.location.href=`<?= site_url('monitoring') ?>`"
					>
						Monitoring
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
				<?php endif; ?>
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
				<?php if (!$this->session->userdata('arallink_accountid')): ?>
					<button class="value <?= ($active_menu == 'login' ? 'active' : '') ?>"
					        onclick="window.location.href='<?= site_url('login') ?>'"
					>
						Sign-in
					</button>
					<button class="value <?= ($active_menu == 'register' ? 'active' : '') ?>"
					        onclick="window.location.href='<?= site_url('register') ?>'"
					>
						Register
					</button>
					<button class="value <?= ($active_menu == 'monitoring' ? 'active' : '') ?>"
					        onclick="window.location.href='<?= site_url('monitoring') ?>'"
					>
						Monitoring
					</button>
				<?php else: ?>
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
					<button class="value <?= ($active_menu == 'monitoring' ? 'active' : '') ?>"
					        onclick="window.location.href=`<?= site_url('monitoring') ?>`"
					>
						Monitoring
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
				<?php endif; ?>
			</div>
		</div>
	</nav>
</header>
