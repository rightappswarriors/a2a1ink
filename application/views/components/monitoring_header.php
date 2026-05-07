
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

		.status-badge.entrance {
			background: #e8f5e9;
			color: #2e7d32;
		}

		.status-badge.exit {
			background: #ffebee;
			color: #c62828;
		}

		.status-badge.both {
			background: #dbeeff;
			color: #0084ff;
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
			$org_logo_url = base_url($org->logo);
			$show_logo = true;
		}
	}
	?>
	<div class="mobile-menu-toggle">
<!--		<a href="#" class="hamburger" id="hamburger-btn">-->
<!--			<span class="hamburger-box">-->
<!--				<span class="hamburger-inner"></span>-->
<!--			</span>-->
<!--		</a>-->
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
			<p style="margin-bottom: 9px; color: white;">Timekeeping Monitoring</p>
		</div>
	</nav>
</header>
