<div class="content-wrapper">
	<div id="upload">
		<?php 
			echo form_open_multipart('admin/upload_image');
			echo form_upload('userfile');
			echo form_submit('btnUpload','Upload');
			echo form_close();
		 ?>
	</div>
</div>