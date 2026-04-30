<?php $view->extends('layouts/authenticated'); ?>

<?php $row = $record->row(); ?>

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
				<h3>Update Consumer</h3>
			</div>
			<div class="large-4 columns text-right">
				<a href="<?= site_url("consumers") ?>" class="button small"> &larr; Consumers</a>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<form action="<?= consumers_update . phpsite_url('consumers/update_submit/') . $this->uri->segment(3) ?>" method="post">
					<table class="table" width="100%" border="0" style="border:0;">
						<tbody>
						<tr>
							<td style="width:25%" class="text-right">Name</td>
							<td style="width:75%"><input type="text" name="consumer"
							                             value="<?= set_value('consumer', $row->consumer) ?>"
							                             placeholder="JUAN DELA CRUZ" required></td>
						</tr>
						<tr>
							<td style="width:25%" class="text-right">Card No.</td>
							<td style="width:75%"><input type="text" name="cardno"
							                             value="<?= set_value('cardno', $row->cardno) ?>"
							                             placeholder="80271635" required></td>
						</tr>
						<tr>
							<td style="width:25%" class="text-right">Category</td>
							<td style="width:75%">

								<?php
								$options = "<option value='0' selected>N/A</option>";
								if ($categories->num_rows() > 0) {
									$ctr = 1;
									foreach ($categories->result() as $rowcat) {
										$options .= "<option value='" . $rowcat->id . "' " . ($rowcat->id == $row->category ? 'selected' : '') . ">" . $rowcat->category . "</option>";
									}
								}
								?>
								<select name="category"><?= $options ?></select>
							</td>
						</tr>
						<tr>
							<td style="width:25%" class="text-right">Mobile No.</td>
							<td style="width:75%"><input type="text"
							                             value="<?= set_value('mobileno', $row->mobileno) ?>"
							                             name="mobileno" placeholder="09273651038" required></td>
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
				</form>
			</div>
		</div>
	</div>
<?php $view->endsection(); ?>
