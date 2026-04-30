<?php $view->extends('layouts/authenticated'); ?>

<?php $view->section('container') ?>
	<?php $row = $records->row(); ?>
	<div class="wrapper">
		<div class="hero">
			<div class="row">
				<div class="large-12 columns">
					<h1><img src="<?= base_url() ?>arallink.png"/><span>Dashboardhello</span></h1>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<h2>Welcome to AralLink RFID System.</h2>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<p><b>AralLink RFID System</b> is a smart, cloud-based attendance and access solution designed for schools
					and organizations. It offers easy plug-and-play setup, real-time monitoring, and automatic SMS
					notifications, ensuring accurate records and improved security. With its compact, wall-mounted design
					and LCD display, AralLink delivers reliable performance in a modern, user-friendly system.</p>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<div class="medium-4 columns text-center">
					<aside><h3><?= number_format($row->devices_total) ?></h3>
						<ol class="sections">
							<li><a href="<?= site_url("devices") ?>">Devices</a></li>
						</ol>
					</aside>
				</div>
				<div class="medium-4 columns text-center">
					<aside><h3><?= number_format($row->consumers_total) ?></h3>
						<ol class="sections">
							<li><a href="<?= site_url("consumers") ?>">Consumers</a></li>
						</ol>
					</aside>
				</div>
				<div class="medium-4 columns text-center">
					<aside><h3><?= number_format($row->logs_total) ?></h3>
						<ol class="sections">
							<li><a href="<?= site_url("logs") ?>">Logs</a></li>
						</ol>
					</aside>
				</div>
			</div>
		</div>
	</div>
<?php $view->endsection(); ?>
