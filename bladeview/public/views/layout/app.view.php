<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $view->yield('title'); ?></title>
    <?php include __DIR__ . "/../includes/app-vendor-assets.view.php"; ?>
    <link rel="stylesheet" href="/bladeview/public/assets/css/app.css"/>
    <?php $view->yield('styles'); ?>
</head>
<body class="min-h-screen">
    <?php $view->yield('main-content'); ?>
    <?php $view->yield('scripts'); ?>
    <?php include __DIR__ . "/../includes/resume-form-modules.view.php"; ?>
</body>
</html>
