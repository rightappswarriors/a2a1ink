<?php $this->load->view('header') ?>

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
									extend: 'excelHtml5',
									text: '<li class="icon icon-file"></li> Export to Excel',
									className: 'button small secondary',
									title: 'AralLink Logs',
									exportOptions: {
										columns: ':visible:not(:last-child)' // exclude action column
									}
								}
							]
						}
					}
				});

				$(".delitem").on("click", function () {
					if (confirm("Are you sure you want to delete this log?")) {
						window.location.href = $(this).href();
					}
					return false;
				});


			});

		</script>

		<div class="row">
			<div class="large-12 columns" style="background-color:#fff;padding:0;">
				<form action="<?= site_url('logs') ?>" method="post">
					<table class="table" width="100%" border="0" style="border:0;background-color:#ccc;">
						<tbody>
						<tr>
							<td style="width:10%" class="text-right">From date</td>
							<td style="width:30%"><input type="date"
							                             value="<?= set_value('datefrom', date("Y-m-d", strtotime("first day of this month"))) ?>"
							                             name="datefrom" required></td>
							<td style="width:10%" class="text-right">To date</td>
							<td style="width:30%"><input type="date" value="<?= set_value('dateto', date("Y-m-d")) ?>"
							                             name="dateto" required></td>
							<td style="width:20%">
								<button type="submit" class="button small success"><span
										class="icon icon-search"></span> Search
								</button>
							</td>
						</tr>
						</tbody>
					</table>
				</form>
			</div>
		</div>

		<div class="row">
			<table class="table display" id="dtable">
				<thead>
				<tr>
					<th width="3%">#</th>
					<th width="30%">Name</th>
					<th width="12%">Card</th>
					<th width="20%">Device</th>
					<th width="20%">Time/Date</th>
					<th width="15%">Action</th>
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
							<td><?= $row->consumer ?></td>
							<td><?= $row->cardno ?></td>
							<td><?= ucfirst($row->direction) ?></td>
							<td><?= date("h:ia m/d/Y", strtotime($row->logdatetime)) ?></td>
							<td class="text-center"><a class="button tiny round success disable"
							                           href="<?= site_url("logs/update/") . $row->id ?>"><i
										class="icon icon-edit"></i></a>&nbsp;<a class="button tiny round alert delitem"
							                                                    href="<?= site_url("logs/remove/") . $row->id ?>"><i
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

<?php $this->load->view('footer'); ?>
