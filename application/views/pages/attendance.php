<?php $view->extends('layouts/authenticated') ?>

<?php $view->section('container') ?>
	<div class="wrapper">
		<div class="hero">
			<div class="row">
				<div class="large-12 columns">
					<h1>
						<img src="<?= base_url() ?>arallink.png"/>
						<span>Attendance</span>
					</h1>
				</div>
			</div>

			<div class="row">
				<table class="table" width="100%">
					<thead>
					<th>#</th>
					<th>Name</th>
					<th>Grade</th>
					<th>Mobile</th>
					<th></th>
					</thead>
					<tbody>
					<tr>
						<td>1</td>
						<td>JOSHUA LENDIO</td>
						<td>Grade 7</td>
						<td>09277324510</td>
						<td>
							<button class="btn btn-sm">Edit</button>
						</td>
					</tr>
					<tr>
						<td>2</td>
						<td>MARIA DE LA ROSA</td>
						<td>Grade 12</td>
						<td>09277324510</td>
						<td>
							<button class="btn btn-sm">Edit</button>
						</td>
					</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	</div>
<?php $view->endsection() ?>
