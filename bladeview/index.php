<?php
$fullUrlPath = parse_url($_SERVER['SCRIPT_NAME'], PHP_URL_PATH);
$basePath = str_replace('/index.php', '', $fullUrlPath);
$basePath = '/' . trim($basePath, '/');
define('BASE_PATH', $basePath);

require "routes/web.php";
