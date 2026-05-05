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
								text: '<li class="icon icon-plus"></li> New device',
								className: 'button small',
								action: function (e, dt, node, config) {
									window.location.href = "<?=site_url('devices/addnew')?>";
								}
							}
						]
					}
				}
			});


			$(".delitem").on("click", function (e) {
				e.preventDefault();
				let link = $(this).attr('href')

				Swal.fire({
					title: "Delete device?",
					text: "Are you sure you want to delete?",
					icon: "warning",
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					cancelButtonColor: "#d33",
					confirmButtonText: "Delete"
				}).then((result) => {
					if(result.isConfirmed) {
						window.location.href = link;
					}
				});
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
					<th width="5%">#</th>
					<th width="20%">Name</th>
					<th width="15%">Model</th>
					<th width="15%">Serial</th>
					<th width="10%">Direction</th>
					<th width="15%">GSM No.</th>
					<th width="15%">Registered</th>
					<th width="10%">Action</th>
				</tr>
				</thead>
				<tbody>

				<?php
				if ($records->num_rows() > 0) {
					$ctr = 1;
					foreach ($records->result() as $row) {
						?>
						<tr>
							<td><?= $ctr++ ?></td>
							<td><?= $row->device ?></td>
							<td><?= $row->modelno ?></td>
							<td><?= $row->serialno ?></td>
							<td><?= ucfirst($row->direction) ?></td>
							<td><?= $row->gsmno ?></td>
							<td><?= date("m/d/Y", strtotime($row->dateadded)) ?></td>
							<td class="text-center">
								<a class="button tiny round success action-btn"
								   href="<?= site_url("devices/update/") . $row->id ?>"
								   title="Edit">
									<i class="icon icon-edit"></i>
								</a>
								<a class="button tiny round alert delitem action-btn"
								   href="<?= site_url("devices/remove/") . $row->id ?>"
								   title="Delete">
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
