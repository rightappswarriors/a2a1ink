<?php $view->extends('layouts/guest'); ?>

<?php $view->section('container'); ?>
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
<?php $view->endsection(); ?>
