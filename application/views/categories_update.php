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
				<h3>Update Category</h3>
			</div>
			<div class="large-4 columns text-right">
				<a href="<?= site_url("categories") ?>" class="button small"> &larr; Categories</a>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<form action="<?= site_url('categories/update_submit/') . $this->uri->segment(3) ?>" method="post">
					<div class="table-container">
						<table class="table" width="100%" border="0" style="border:0;">
							<tbody>
							<tr>
								<td style="width:25%" class="text-right">Name</td>
								<td style="width:75%"><input type="text" name="category" placeholder="Grade 8"
								                             value="<?= set_value('category', $row->category) ?>" required>
								</td>
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
