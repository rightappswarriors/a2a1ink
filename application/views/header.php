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
	<nav class="top-bar" data-topbar>
		<ul class="title-area">
			<li class="name">
				<h1><a href="<?= site_url() ?>"><b>AralLink</b> RFID System</a></h1>
			</li>
			<li class="toggle-topbar menu-icon">
				<a href="#">
					<span>Menu</span>
				</a>
			</li>
		</ul>

		<section class="top-bar-section">
			<!-- Left Nav Section -->
			<ul class="left">
				<li class="item <?= ($active_menu == 'dashboard' ? 'active' : '') ?>">
					<a href="<?= site_url() ?>">
						<span class="icon icon-dashboard"></span>
						Dashboard
					</a>
				</li>
				<li class="item <?= ($active_menu == 'devices' ? 'active' : '') ?>">
					<a href="<?= site_url("devices") ?>">
						<span class="icon icon-hdd"></span>
						Devices
					</a>
				</li>
				<li class="item <?= ($active_menu == 'consumers' ? 'active' : '') ?>">
					<a href="<?= site_url("consumers") ?>">
						<span class="icon icon-user"></span>
						Consumers
					</a>
				</li>
				<li class="item <?= ($active_menu == 'logs' ? 'active' : '') ?>">
					<a href="<?= site_url("logs") ?>">
						<span class="icon icon-calendar"></span>
						Logs
					</a>
				</li>
				<li class="item <?= ($active_menu == 'settings' ? 'active' : '') ?>" style="">
					<a href="<?= site_url("settings") ?>">
						<span class="icon icon-cog"></span>
						Settings
					</a>
				</li>
				<li class="item">
					<a href="<?= site_url("login/logout") ?>">
						<span class="icon icon-signout"></span>
						Sign-out (<?= $this->session->userdata('arallink_displayname') ?>)
					</a>
				</li>
			</ul>
		</section>
	</nav>
</header>
