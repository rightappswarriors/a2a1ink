<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('view')) {
	function view($page, $data = array())
	{
		require_once APPPATH . 'libraries/BladeView.php';

		$blade = BladeView::make();
		$blade->render($page, $data);
	}
}
