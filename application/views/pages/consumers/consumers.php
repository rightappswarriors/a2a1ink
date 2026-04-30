<?php $view->extends('layouts/authenticated'); ?>

<?php $view->section('container'); ?>
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
									text: '<li class="icon icon-plus"></li> New consumer',
									className: 'button small',
									action: function (e, dt, node, config) {
										window.location.href = "<?=site_url('consumers/addnew')?>";
									}
								},
								{
									text: '<li class="icon icon-list"></li> Categories',
									className: 'button small secondary',
									action: function (e, dt, node, config) {
										window.location.href = "<?=site_url('categories')?>";
									}
								}, {
									extend: 'excelHtml5',
									text: '<li class="icon icon-file"></li> Export to Excel',
									className: 'button small secondary',
									title: 'AralLink Consumers',
									exportOptions: {
										columns: ':visible:not(:last-child)' // exclude action column
									}
								}
							]
						}
					}
				});


				$(".delitem").on("click", function () {
					if (confirm("Are you sure you want to delete?")) {
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

			<table class="table display" id="dtable">
				<thead>
				<tr>
					<th width="4%">#</th>
					<th width="30%">Name</th>
					<th width="15%">Category</th>
					<th width="15%">Card Number</th>
					<th width="20%">Mobile</th>
					<th width="16%" class="text-center">Action</th>
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
							<td><?= $row->consumer ?></td>
							<td><?= $row->catname ?></td>
							<td><?= $row->cardno ?></td>
							<td><?= $row->mobileno ?></td>
							<td class="text-center"><a class="button tiny round success"
							                           href="<?= consumers . phpsite_url("consumers/update/") . $row->id ?>"><i
										class="icon icon-edit"></i></a>&nbsp;<a class="button tiny round alert delitem"
							                                                    href="<?= consumers . phpsite_url("consumers/remove/") . $row->id ?>"><i
										class="icon icon-trash"></i></a></td>
						</tr>
						<?php
					}
				}

				?>
				</tbody>
			</table>
		</div>
	</div>
<?php $view->endsection(); ?>
