<?php $this->load->view('components/header') ?>

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
				<h3>Add New Consumer</h3>
			</div>
			<div class="large-4 columns text-right">
				<a href="<?= site_url("consumers") ?>" class="button small"> &larr; Consumers</a>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<form action="<?= site_url('consumers/addnew_submit') ?>" method="post" enctype="multipart/form-data">
					<div class="table-container">
						<table class="table" width="100%" border="0" style="border:0;">
							<tbody>
							<tr>
								<td style="width:25%" class="text-right">Name</td>
								<td style="width:75%">
									<input
										type="text"
										name="consumer"
										placeholder="JUAN DELA CRUZ"
										required />
								</td>
							</tr>
							<tr>
								<td style="width:25%" class="text-right">Card No.</td>
								<td style="width:75%">
									<input
										type="text"
										name="cardno"
										placeholder="80271635"
										required>
								</td>
							</tr>
							<tr>
								<td style="width:25%" class="text-right">Category</td>
								<td style="width:75%">
									<?php
									$options = "<option value='0' selected>N/A</option>";
									if ($categories->num_rows() > 0) {
										$ctr = 1;
										foreach ($categories->result() as $row) {
											$options .= "<option value='" . $row->id . "'>" . $row->category . "</option>";
										}
									}
									?>
									<select name="category"><?= $options ?></select>
								</td>
							</tr>
							<tr>
								<td style="width:25%" class="text-right">Mobile No.</td>
								<td style="width:75%">
									<input
										type="text"
										name="mobileno"
										placeholder="09273651038"
										required>
								</td>
							</tr>
							<tr>
								<td style="width:25%" class="text-right">Photo</td>
								<td style="width:75%">
									<div id="photo-preview-container" style="margin-bottom: 10px; display: none;">
										<img id="photo-preview" src="" alt="Preview" style="max-width: 200px; max-height: 200px; border: 1px solid #ddd; padding: 5px;">
										<br><small>Image preview</small>
									</div>
									<input type="file" name="photo" accept="image/*" style="width: auto;" id="photo-input">
									<?php if ($this->session->userdata('upload_error')): ?>
										<div style="color: red; margin-top: 5px;">
											<?= $this->session->userdata('upload_error') ?>
										</div>
										<?php $this->session->unset_userdata('upload_error'); ?>
									<?php endif; ?>
									<small>Supported: JPG, PNG, GIF, WebP. Max size: 2MB</small>
								</td>
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
	
	<script>
	document.addEventListener('DOMContentLoaded', function() {
	    const photoInput = document.getElementById('photo-input');
	    const previewContainer = document.getElementById('photo-preview-container');
	    const previewImg = document.getElementById('photo-preview');
	    
	    if (photoInput) {
	        photoInput.addEventListener('change', function(e) {
	            const file = e.target.files[0];
	            
	            if (file) {
	                // Check file type
	                if (!file.type.match('image.*')) {
	                    alert('Please select an image file.');
	                    return;
	                }
	                
	                // Check file size (2MB = 2 * 1024 * 1024 bytes)
	                if (file.size > 2 * 1024 * 1024) {
	                    alert('File size exceeds 2MB limit.');
	                    return;
	                }
	                
	                const reader = new FileReader();
	                reader.onload = function(e) {
	                    previewImg.src = e.target.result;
	                    previewContainer.style.display = 'block';
	                };
	                reader.readAsDataURL(file);
	            } else {
	                previewContainer.style.display = 'none';
	                previewImg.src = '';
	            }
	        });
	    }
	});
	</script>

<?php $this->load->view('components/footer'); ?>
