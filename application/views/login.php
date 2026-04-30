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
				<li class="item"><a href="<?= site_url("register") ?>">Register</a></li>
				<li class="item active"><a href="<?= site_url("login") ?>">Sign-in</a></li>
			</ul>
		</section>

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
	<div class="row">

		<div class="large-8 columns">
			<h3>Please enter your login information</h3>
		</div>
	</div>
	<div class="row">
		<div class="large-8 columns">
			<form action="<?= site_url('login/process') ?>" method="post" autocomplete="off">
				<table class="table" width="100%" border="0" style="border:0;">
					<tbody>
					<tr>
						<td style="width:25%" class="text-right">Username</td>
						<td style="width:75%"><input type="text" name="username" placeholder="Entrance RFID" required>
						</td>
					</tr>
					<tr>
						<td style="width:25%" class="text-right">Password</td>
						<td style="width:75%"><input type="password" name="password" placeholder="**********" required>
						</td>
					</tr>
					<tr style="background-color:#fff">
						<td></td>
						<td style="text-align:right;">
							<button type="submit" class="button small success"><span class="icon icon-signin"></span>
								Sign-in
							</button>
						</td>
					</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>


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

</body>
</html>
