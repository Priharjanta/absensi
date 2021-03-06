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
						<?php echo form_error('keg_date_y', '<div class="alert alert-danger">', '</div>'); ?>
						<?php echo form_error('keg_date_m', '<div class="alert alert-danger">', '</div>'); ?>
						<?php echo form_error('keg_date_d', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Tanggal Kegiatan *</span>
							<?php echo dateDropdown('keg_date',$row->keg_date,'1950','2020');?>
						</div>
						<?php echo form_error('keg_m_keg_id', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Nama Kegiatan *</span>	
							<?php echo kegiatanDropdown($row->keg_m_keg_id,'keg_m_keg_id',FALSE)?>
						</div>
						<?php echo form_error('keg_tema', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Tema *</span>
							<input type="text" name="keg_tema" class="form-control"  value="<?php echo $row->keg_tema; ?>">
						</div>
						<?php echo form_error('keg_pembicara', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Pembicara</span>	
							<input type="text" name="keg_pembicara" class="form-control" value="<?php echo $row->keg_pembicara; ?>">
						</div>
						
						<?php echo form_error('keg_ayat', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Ayat</span>
							<input type="text" name="keg_ayat" class="form-control"  value="<?php echo $row->keg_ayat; ?>">
						</div>
						
						<?php echo form_error('keg_ket', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Keterangan</span>
							<input type="text" name="keg_ket" class="form-control"  value="<?php echo $row->keg_ket; ?>">
						</div>

						<?php echo form_error('keg_opt_start_date_time_y', '<div class="alert alert-danger">', '</div>'); ?>
						<?php echo form_error('keg_opt_start_date_time_m', '<div class="alert alert-danger">', '</div>'); ?>
						<?php echo form_error('keg_opt_start_date_time_d', '<div class="alert alert-danger">', '</div>'); ?>
						
						<div class="form-group input-group">
							<span class="input-group-addon">Tanggal Mulai **</span>	
							<?php echo dateDropdown('keg_opt_start_date_time',formatDate($row->keg_opt_start_date_time,'sitemap_date'),'1950','2020');?>
						</div>
						
						<?php echo form_error('keg_opt_start_date_time_h', '<div class="alert alert-danger">', '</div>'); ?>
						<?php echo form_error('keg_opt_start_date_time_min', '<div class="alert alert-danger">', '</div>'); ?>
						<?php echo form_error('keg_opt_start_date_time_s', '<div class="alert alert-danger">', '</div>'); ?>
						
						<div class="form-group input-group">
							<span class="input-group-addon">Waktu Mulai **</span>
							<?php $time_s = explode(':',formatDate($row->keg_opt_start_date_time,'time_only')); ?>
							<?php echo timeDropDown('h','keg_opt_start_date_time_h', $time_s[0]);?>
							<?php echo timeDropDown('m','keg_opt_start_date_time_min', $time_s[1]);?>
							<?php echo timeDropDown('s','keg_opt_start_date_time_s', $time_s[2]);?>
						</div>
						
						<?php echo form_error('keg_opt_end_date_time_y', '<div class="alert alert-danger">', '</div>'); ?>
						<?php echo form_error('keg_opt_end_date_time_m', '<div class="alert alert-danger">', '</div>'); ?>
						<?php echo form_error('keg_opt_end_date_time_d', '<div class="alert alert-danger">', '</div>'); ?>
						
						<div class="form-group input-group">
							<span class="input-group-addon">Tanggal Selesai **</span>	
							<?php echo dateDropdown('keg_opt_end_date_time',formatDate($row->keg_opt_end_date_time,'sitemap_date'),'1950','2020');?>
						</div>
						
						<?php echo form_error('keg_opt_end_date_time_h', '<div class="alert alert-danger">', '</div>'); ?>
						<?php echo form_error('keg_opt_end_date_time_min', '<div class="alert alert-danger">', '</div>'); ?>
						<?php echo form_error('keg_opt_end_date_time_s', '<div class="alert alert-danger">', '</div>'); ?>
						
						<div class="form-group input-group">
							<span class="input-group-addon">Waktu Selesai **</span>
							<?php $time_s = explode(':',formatDate($row->keg_opt_end_date_time,'time_only')); ?>
							<?php echo timeDropDown('h','keg_opt_end_date_time_h', $time_s[0]);?>
							<?php echo timeDropDown('m','keg_opt_end_date_time_min', $time_s[1]);?>
							<?php echo timeDropDown('s','keg_opt_end_date_time_s', $time_s[2]);?>
						</div>
						
						
						<?php echo form_error('keg_aktif', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Atif</span>	
							<?php echo yesnoDropdown(FALSE,'keg_aktif',$row->keg_aktif);?>
						</div>
						<p>
							<em>
							* Harus diisi<br>
							** Opsional 
							</em>
						</p>
						<p>
							<input type="submit" class="btn btn-primary" value="Simpan">
							<button type="button" class="btn btn-warning">Batal</button>
							<?php echo anchor('backend/data_keg/delete/'.$row->keg_id,'Hapus',array('onclick' => "return confirm('Anda yakin menghapus data ini?')","type"=>"button","class"=>"btn btn-danger btn-xs"))?>
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