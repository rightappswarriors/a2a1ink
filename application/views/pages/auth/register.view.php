<?php $view->extends('layout/guest'); ?>

<?php $view->section('container'); ?>
	<div class="wrapper">
		<div class="hero">
			<div class="row">
				<div class="large-12 columns">
					<h1><img src="<?= base_url() ?>arallink.png"/><span><?= $page_title ?></span></h1>
				</div>
			</div>
		</div>

		<form action="<?= site_url('register/process') ?>" method="post" autocomplete="off">
			<div class="row">
				<div class="large-8 columns">
					<h3>Basic information</h3>
				</div>
			</div>
			<div class="row">
				<div class="large-8 columns">

					<table class="table" width="100%" border="0" style="border:0;">
						<tbody>
						<tr>
							<td style="width:25%" class="text-right">Organization</td>
							<td style="width:75%"><input type="text" name="organization"
														 value="<?= set_value('organization') ?>"
														 placeholder="University of Cebu" required></td>
						</tr>
						<tr>
							<td style="width:25%" class="text-right">Address</td>
							<td style="width:75%"><input type="text" name="address" value="<?= set_value('address') ?>"
														 placeholder="Cebu City" required></td>
						</tr>
						<tr>
							<td style="width:25%" class="text-right">Contact No.</td>
							<td style="width:75%"><input type="text" name="contactno" value="<?= set_value('contactno') ?>"
														 placeholder="092882717732" required></td>
						</tr>
						<tr>
							<td style="width:25%" class="text-right">E-mail Address</td>
							<td style="width:75%"><input type="text" name="email" value="<?= set_value('email') ?>"
														 placeholder="email@gmail.com" required></td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="large-8 columns">
					<h3>Login information</h3>
				</div>
			</div>
			<div class="row">
				<div class="large-8 columns">
					<table class="table" width="100%" border="0" style="border:0;">
						<tbody>
						<tr>
							<td style="width:25%" class="text-right">Username</td>
							<td style="width:75%"><input type="text" name="username" placeholder="Entrance RFID"
														 autocomplete="off" required></td>
						</tr>
						<tr>
							<td style="width:25%" class="text-right">Password</td>
							<td style="width:75%">
								<input type="password" id="password" name="password" autocomplete="off"
														 placeholder="***********" required>
								<small id="password-msg"></small>
							</td>
						</tr>
						<tr>
							<td style="width:25%" class="text-right">Repeat password</td>
							<td style="width:75%">
								<input type="password" id="rpassword" name="rpassword" autocomplete="off"
														 placeholder="***********" required>
								<small id="password-match-msg"></small>
							</td>
						</tr>
						<tr style="background-color:#fff">
							<td></td>
							<td style="text-align:right;">
								<button type="submit" class="button small success"><span class="icon icon-save"></span>
									Submit
								</button>
							</td>
						</tr>
						</tbody>
					</table>

				</div>
			</div>
		</form>
	</div>
<?php $view->endsection(); ?>

<?php $view->section('scripts'); ?>
<script>
	const password = document.getElementById('password');
	const rpassword = document.getElementById('rpassword');

	const msg = document.getElementById('password-msg');
	const matchMsg = document.getElementById('password-match-msg');

	password.addEventListener('input', validatePassword);
	rpassword.addEventListener('input', checkMatch);

	function validatePassword() {
		const value = password.value;

		const hasLower = /[a-z]/.test(value);
		const hasUpper = /[A-Z]/.test(value);
		const hasNumber = /[0-9]/.test(value);
		const maxLength = value.length <= 8;

		let errors = [];

		if (!hasLower) errors.push("lowercase letter");
		if (!hasUpper) errors.push("uppercase letter");
		if (!hasNumber) errors.push("number");
		if (!maxLength) errors.push("max 8 characters");

		if (errors.length > 0) {
			msg.style.color = "red";
			msg.textContent = "Must contain: " + errors.join(", ");
		} else {
			msg.style.color = "green";
			msg.textContent = "Password looks good ✔";
		}

		checkMatch();
	}

	function checkMatch() {
		if (rpassword.value === "") {
			matchMsg.textContent = "";
			return;
		}

		if (password.value === rpassword.value) {
			matchMsg.style.color = "green";
			matchMsg.textContent = "Passwords match ✔";
		} else {
			matchMsg.style.color = "red";
			matchMsg.textContent = "Passwords do not match";
		}
	}
</script>
<?php $view->endsection(); ?>
