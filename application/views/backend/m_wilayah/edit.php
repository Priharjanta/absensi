<div class="row">
	<div class="col-lg-12">
        <?php echo $this->session->flashdata('message_type');?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php echo $title;?> - Edit
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<form action="" role="form" method="post" enctype="multipart/form-data">
					<div class="col-lg-6">
						<?php echo form_error('m_wil_name', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Nama Wilayah</span>
							<input type="text" name="m_wil_name" class="form-control" value="<?php echo $row->m_wil_name; ?>">
						</div>
						<?php echo form_error('m_wil_koord_name', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Nama Koordinator / KA</span>	
							<input type="text" name="m_wil_koord_name" class="form-control" value="<?php echo $row->m_wil_koord_name; ?>">
						</div>
						<?php echo form_error('m_wil_phone', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Telepon / HP</span>
							<input id="m_wil_phone" name="m_wil_phone" class="form-control"  value="<?php echo $row->m_wil_phone; ?>">
						</div>
						<?php echo form_error('m_wil_koord_jmt_id', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">ID Jemaat</span>	
							<input type="text" name="m_wil_koord_jmt_id" class="form-control" value="<?php echo $row->m_wil_koord_jmt_id; ?>">
						</div>
						<?php echo form_error('m_wil_area', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Area / Wilayah</span>
							<textarea id="m_wil_area" name="m_wil_area" class="form-control" ><?php echo $row->m_wil_area; ?></textarea>
						</div>
						<p>
							<input type="submit" class="btn btn-primary" value="Simpan">
							<button type="button" class="btn btn-warning">Batal</button>
							<button type="button" class="btn btn-danger">Hapus</button>
						</p>
						
				</form>
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->