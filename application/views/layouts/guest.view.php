<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="..."/>
	<meta name="keywords" content="..."/>
	<title><?= $page_title; ?></title>
	<?php $view->include('includes/assets-guest') ?>
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
	}(document, 'script', 'facebook-jssdk'));
</script>

<?php $view->include('components/guest/header') ?>

<?php $view->yield('container') ?>

<?php $view->include('components/guest/footer') ?>

<?php $view->yield('scripts'); ?>
</body>
</html>
