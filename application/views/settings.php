<?php $this->load->view('header') ?>

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

			<?php if ($this->session->userdata('update_status')): ?>
				<?php echo $this->session->userdata('update_status'); ?>
				<?php
				$this->session->unset_userdata('update_status');
			endif ?>

			<div class="large-12 columns">
				<h3>Organization Setup</h3>
			</div>
		</div>

		<form action="<?= site_url('settings/update') ?>" method="post" enctype="multipart/form-data">

			<div class="row">
				<div class="large-12 columns">
					<div class="table-container">
						<table class="table" width="100%" border="0" style="border:0;">
							<tbody>
							<tr>
								<td style="width:25%" class="text-right">Key ID</td>
								<td style="width:75%"><input type="text" name="keyid" value="<?= $row->keyid ?>" disabled>
								</td>
							</tr>
							<tr>
								<td style="width:25%" class="text-right">Organization</td>
								<td style="width:75%"><input type="text" name="organization"
								                             value="<?= $row->organization ?>"
								                             placeholder="University of Cebu" required></td>
							</tr>
							<tr>
								<td style="width:25%" class="text-right">Address</td>
								<td style="width:75%"><input type="text" name="address" value="<?= $row->address ?>"
								                             placeholder="Cebu City" required></td>
							</tr>
							<tr>
								<td style="width:25%" class="text-right">Contact No.</td>
								<td style="width:75%"><input type="text" name="contactno" value="<?= $row->contactno ?>"
								                             placeholder="092882717732" required></td>
							</tr>
							<tr>
								<td style="width:25%" class="text-right">E-mail Address</td>
								<td style="width:75%"><input type="text" name="email" value="<?= $row->email ?>"
								                             placeholder="email@gmail.com" required></td>
							</tr>
							<tr>
								<td style="width:25%" class="text-right">Organization Logo</td>
								<td style="width:75%">
									<?php if (!empty($row->logo) && file_exists(FCPATH . $row->logo)): ?>
										<div style="margin-bottom: 10px;">
											<img src="<?= base_url() . $row->logo ?>" alt="Current Logo" style="max-width: 200px; max-height: 100px; border: 1px solid #ddd; padding: 5px;">
											<br><small>Current logo</small>
										</div>
									<?php endif; ?>
									<input type="file" name="logo" accept="image/*" style="width: auto;">
									<?php if ($this->session->userdata('upload_error')): ?>
										<div style="color: red; margin-top: 5px;">
											<?= $this->session->userdata('upload_error') ?>
										</div>
										<?php $this->session->unset_userdata('upload_error'); ?>
									<?php endif; ?>
									<small>Supported: JPG, PNG, GIF, SVG, WebP. Max size: 2MB</small>
								</td>
							</tr>
							<tr style="background-color:#fff">
								<td></td>
								<td style="text-align:right;">
									<button type="submit" class="button small"><span class="icon icon-save"></span> Update
										settings
									</button>
								</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<!--<div class="row">
   <div class="large-12 columns">
     <h3>SMS Setup</h3>
   </div>
 </div>
<div class="row">
  <div class="large-12 columns">
    <table class="table" width="100%" border="0" style="border:0;">
      <tbody>
          <tr><td style="width:25%" class="text-right">SMS Message</td><td style="width:75%"><input type="text" name="smstext" value="<?= $row->smstext ?>" placeholder="[consumer] has [left/entered] [date/time] at [organization_name]" disabled></td></tr>
          <tr><td style="width:25%" class="text-right">Provider</td><td style="width:75%"><input type="radio" name="provider" value="senderid" <?= ($row->provider == 'senderid' ? 'checked' : '') ?>> Sender ID &nbsp;&nbsp;<input type="radio" name="provider" value="gsm" <?= ($row->provider == 'gsm' ? 'checked' : '') ?>> GSM (Local SIM) &nbsp;&nbsp;<input type="radio" name="provider" value="both" <?= ($row->provider == 'both' ? 'checked' : '') ?>> Both</td></tr>
          <tr><td style="width:25%" class="text-right">Sender ID</td><td style="width:75%"><input type="text" name="senderid" value="<?= $row->senderid ?>" placeholder="JDEN SMS"></td></tr>
        </tbody>
        <tr><td></td><td style="text-align:right;"><button type="submit" class="button small"><span class="icon icon-save"></span> Update settings</button></td></tr>
      </table>
  </div>
</div>-->

		</form>

	</div>

<?php $this->load->view('footer'); ?>
