<?php $this->load->view('header') ?>

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
				<h3>Add New Device</h3>
			</div>
			<div class="large-4 columns text-right">
				<a href="<?= site_url("devices") ?>" class="button small"> &larr; Devices</a>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<form action="<?= site_url('devices/addnew_submit') ?>" method="post">
					<div class="table-container">
						<table class="table" width="100%" border="0" style="border:0;">
							<tbody>
							<tr>
								<td style="width:25%" class="text-right">Name</td>
								<td style="width:75%"><input type="text" name="device" placeholder="Entrance RFID" required>
								</td>
							</tr>
							<tr>
								<td style="width:25%" class="text-right">Model</td>
								<td>
									<select name="modelno" required>
										<option value="" selected disabled>Select</option>
										<option value="JDEN0901">JDEN0901</option>
										<option value="JDEN0902">JDEN0902</option>
									</select>
								</td>
							</tr>
							<tr>
								<td style="width:25%" class="text-right">Serial No.</td>
								<td style="width:75%"><input type="text" name="serialno" placeholder="ZEYW11028271"
								                             required></td>
							</tr>
							<tr>
								<td style="width:25%" class="text-right">Direction</td>
								<td style="width:75%"><input type="radio" name="direction" value="Entrance"
								                             class="text-right"> Entrance &nbsp;&nbsp;<input type="radio"
								                                                                             name="direction"
								                                                                             value="Exit">
									Exit &nbsp;&nbsp;<input type="radio" name="direction" value="Both" checked> Both
								</td>
							</tr>
							<tr>
								<td style="width:25%" class="text-right">GSM No.</td>
								<td style="width:75%"><input type="text" name="gsmno" placeholder="09277325103"></td>
							</tr>
							<tr style="background-color:#fff">
								<td></td>
								<td style="text-align:right;">
									<button type="submit" class="button small success"><span class="icon icon-save"></span>
										Save
									</button>
								</td>
							</tr>
							</tbody>
						</table>
					</div>
				</form>
			</div>
		</div>


	</div>

<?php $this->load->view('footer'); ?>
