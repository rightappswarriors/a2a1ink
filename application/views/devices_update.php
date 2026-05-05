<?php $this->load->view('components/header') ?>

<?php
$row = $record->row();
?>

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
				<h3>Update Device</h3>
			</div>
			<div class="large-4 columns text-right">
				<a href="<?= site_url("devices") ?>" class="button small"> &larr; Devices</a>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<form action="<?= site_url('devices/update_submit/') . $this->uri->segment(3) ?>" method="post">
					<div class="table-container">
						<table class="table" width="100%" border="0" style="border:0;">
							<tbody>
							<tr>
								<td style="width:25%" class="text-right">Name</td>
								<td style="width:75%"><input type="text" name="device" placeholder="Entrance RFID"
								                             value="<?= set_value('device', $row->device) ?>" required></td>
							</tr>
							<tr>
								<td style="width:25%" class="text-right">Model</td>
								<td>
									<select name="modelno" required>
										<option value="JDEN0901" <?= ($row->modelno == 'JDEN0901' ? 'selected' : '') ?>>
											JDEN0901
										</option>
										<option value="JDEN0902" <?= ($row->modelno == 'JDEN0902' ? 'selected' : '') ?>>
											JDEN0902
										</option>
									</select>
								</td>
							</tr>
							<tr>
								<td style="width:25%" class="text-right">Serial No.</td>
								<td style="width:75%"><input type="text" name="serialno" placeholder="ZEYW11028271"
								                             value="<?= set_value('serialno', $row->serialno) ?>" required>
								</td>
							</tr>
							<tr>
								<td style="width:25%" class="text-right">Direction</td>
								<td style="width:75%"><input type="radio" name="direction" value="Entrance"
								                             class="text-right" <?= ($row->direction == 'Entrance' ? 'checked' : '') ?>>
									Entrance &nbsp;&nbsp;<input type="radio" name="direction"
									                            value="Exit" <?= ($row->direction == 'Exit' ? 'checked' : '') ?>>
									Exit &nbsp;&nbsp;<input type="radio" name="direction"
									                        value="Both" <?= ($row->direction == 'Both' ? 'checked' : '') ?>>
									Both
								</td>
							</tr>
							<tr>
								<td style="width:25%" class="text-right">GSM No.</td>
								<td style="width:75%"><input type="text" name="gsmno" placeholder="09277325103"
								                             value="<?= set_value('gsmno', $row->gsmno) ?>"></td>
							</tr>
							<tr style="background-color:#fff">
								<td></td>
								<td style="text-align:right;">
									<button type="submit" class="button small success"><span class="icon icon-save"></span>
										Update
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

<?php $this->load->view('components/footer'); ?>
