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
						<?php echo form_error('m_ib_name', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Nama Ibadah</span>
							<input type="text" name="m_ib_name" class="form-control" value="<?php echo $row->m_ib_name; ?>">
						</div>
						<?php echo form_error('m_ib_start_time_h', '<div class="alert alert-danger">', '</div>'); ?>
						<?php echo form_error('m_ib_start_time_m', '<div class="alert alert-danger">', '</div>'); ?>
						<?php echo form_error('m_ib_start_time_s', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Waktu Mulai</span>
							<?php $time_s = explode(':',$row->m_ib_start_time);?>
							<?php echo timeDropDown('h','m_ib_start_time_h', $time_s[0]);?>
							<?php echo timeDropDown('m','m_ib_start_time_m', $time_s[1]);?>
							<?php echo timeDropDown('s','m_ib_start_time_s', $time_s[2]);?>
						</div>
						<?php echo form_error('m_ib_end_time_h', '<div class="alert alert-danger">', '</div>'); ?>
						<?php echo form_error('m_ib_end_time_m', '<div class="alert alert-danger">', '</div>'); ?>
						<?php echo form_error('m_ib_end_time_s', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Waktu Selesai</span>
							<?php $time_e = explode(':',$row->m_ib_end_time);?>
							<?php echo timeDropDown('h','m_ib_end_time_h', $time_e[0]);?>
							<?php echo timeDropDown('m','m_ib_end_time_m', $time_e[1]);?>
							<?php echo timeDropDown('s','m_ib_end_time_s', $time_e[2]);?>
						</div>
						<?php echo form_error('m_ib_lokasi', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Lokasi / Tempat</span>
							<input type="text" name="m_ib_lokasi" class="form-control" value="<?php echo $row->m_ib_lokasi; ?>">
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon">Keterangan</span>
							<textarea id="m_ib_ket" name="m_ib_ket" class="form-control" ><?php echo $row->m_ib_ket; ?></textarea>
						</div>
						<?php echo form_error('m_ib_aktif', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<div class="form-group input-group">
							<span class="input-group-addon">Aktif</span>	
							<?php echo yesnoDropdown(FALSE,'m_ib_aktif',$row->m_ib_aktif);?>
						</div>
						</div>
						<p>
							<input type="submit" class="btn btn-primary" value="Simpan">
							<button type="button" class="btn btn-warning">Batal</button>
							<button type="button" class="btn btn-danger">Hapus</button>
						</p>
					</div>	
				</form>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->