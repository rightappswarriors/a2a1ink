<?php $this->load->view('components/header') ?>

	<div class="wrapper">
		<div class="hero">
			<div class="row">
				<div class="large-12 columns">
					<h1><img src="<?= base_url() ?>arallink.png"/><span><?= $page_title ?></span></h1>
				</div>
			</div>
		</div>

		<script>
			$(document).ready(function () {
				new DataTable('#dtable', {
					pageLength: 10,
					lengthChange: false, layout: {
						topStart: {
							buttons: [
								{
									text: '&larr; Consumers',
									className: 'button small secondary',
									action: function (e, dt, node, config) {
										window.location.href = "<?=site_url('consumers')?>";
									}
								}, {
									text: '<li class="icon icon-plus"></li> New category',
									className: 'button small',
									action: function (e, dt, node, config) {
										window.location.href = "<?=site_url('categories/addnew')?>";
									}
								}
							]
						}
					}
				});


				$(".delitem").on("click", function () {
					if (confirm("Are you sure you want to delete this item?")) {
						window.location.href = $(this).href();
					}
					return false;
				});


			});
		</script>

		<div class="row">

			<?php if ($this->session->userdata('update_status')): ?>
				<?php echo $this->session->userdata('update_status'); ?>
				<?php
				$this->session->unset_userdata('update_status');
			endif ?>

			<div class="table-container">
				<table class="table display" id="dtable">
					<thead>
					<tr>
						<th width="2%">#</th>
						<th width="17%">Name</th>
						<th width="15%">Added</th>
						<th width="14%">Action</th>
					</tr>
					</thead>
					<tbody>

					<?php
					if ($records->num_rows() > 0) {
						$ctr = 1;
						foreach ($records->result() as $row) {
							?>
							<tr>
								<td><?= ($ctr++) ?></td>
								<td><?= $row->category ?></td>
								<td><?= date("m/d/Y", strtotime($row->dateadded)) ?></td>
								<td class="text-center">
									<a class="button tiny round success action-btn"
									   href="<?= site_url("categories/update/") . $row->id ?>" title="Edit">
										<i class="icon icon-edit"></i>
									</a>
									<a class="button tiny round alert delitem action-btn"
									   href="<?= site_url("categories/remove/") . $row->id ?>" title="Delete">
										<i class="icon icon-trash"></i>
									</a>
								</td>
							</tr>
							<?php
						}
					}

					?>

					</tbody>
				</table>
			</div>

		</div>


	</div>

<?php $this->load->view('components/footer'); ?>
