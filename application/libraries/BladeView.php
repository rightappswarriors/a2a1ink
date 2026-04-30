<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BladeView
{
	protected $sections = array();
	protected $layout = null;
	protected $currentSection = null;

	public function extends($layout)
	{
		$this->layout = $layout;
	}

	public function section($name)
	{
		$this->currentSection = $name;
		ob_start();
	}

	public function endsection()
	{
		if (!$this->currentSection)
		{
			die('No section started');
		}

		$this->sections[$this->currentSection] = ob_get_clean();
		$this->currentSection = null;
	}

	public function yield($name, $default = '')
	{
		echo isset($this->sections[$name]) ? $this->sections[$name] : $default;
	}

	public function render($viewPage, $data = array())
	{
		extract($data);

		$view = $this;

		require __DIR__."/../views/{$viewPage}.view.php";

		if ($this->layout)
		{
			require __DIR__."/../views/{$this->layout}.view.php";
		}
	}

	public function include($path, $data = array())
	{
		extract($data);
		require __DIR__."/../views/{$path}.view.php";
	}

	public static function make()
	{
		return new self;
	}
}
