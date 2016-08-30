<div class="row">
	<div class="col-lg-12">
        <?php echo $this->session->flashdata('message_type');?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php echo $title;?> - Tambah
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<form action="" role="form" method="post" enctype="multipart/form-data">
					<div class="col-lg-6">
						<?php echo form_error('m_keg_name', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Nama Kegiatan</span>
							<input type="text" name="m_keg_name" class="form-control" value="<?php echo set_value('m_keg_name'); ?>">
						</div>
						<?php echo form_error('m_keg_start_time_h', '<div class="alert alert-danger">', '</div>'); ?>
						<?php echo form_error('m_keg_start_time_m', '<div class="alert alert-danger">', '</div>'); ?>
						<?php echo form_error('m_keg_start_time_s', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Waktu Mulai</span>
							<?php 
								if(set_value('m_keg_start_time_h')||set_value('m_keg_start_time_m')||set_value('m_keg_start_time_s')):
									$time_s = explode(':',set_value('m_keg_start_time_h').':'.set_value('m_keg_start_time_m').':'.set_value('m_keg_start_time_s'));
								else:
									$time_s = explode(':','hh:mm:yy');
								endif;
							?>
							<?php echo timeDropDown('h','m_keg_start_time_h', $time_s[0]);?>
							<?php echo timeDropDown('m','m_keg_start_time_m', $time_s[1]);?>
							<?php echo timeDropDown('s','m_keg_start_time_s', $time_s[2]);?>
						</div>
						<?php echo form_error('m_keg_end_time_h', '<div class="alert alert-danger">', '</div>'); ?>
						<?php echo form_error('m_keg_end_time_m', '<div class="alert alert-danger">', '</div>'); ?>
						<?php echo form_error('m_keg_end_time_s', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Waktu Selesai</span>
							<?php 
								if(set_value('m_keg_end_time_h')||set_value('m_keg_end_time_m')||set_value('m_keg_end_time_s')):
									$time_e = explode(':',set_value('m_keg_end_time_h').':'.set_value('m_keg_end_time_m').':'.set_value('m_keg_end_time_s'));
								else:
									$time_e = explode(':','hh:mm:yy');
								endif;
							?>
							<?php echo timeDropDown('h','m_keg_end_time_h', $time_e[0]);?>
							<?php echo timeDropDown('m','m_keg_end_time_m', $time_e[1]);?>
							<?php echo timeDropDown('s','m_keg_end_time_s', $time_e[2]);?>
						</div>
						<?php echo form_error('m_keg_lokasi', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Lokasi / Tempat</span>	
							<input type="text" name="m_keg_lokasi" class="form-control" value="<?php echo set_value('m_keg_lokasi'); ?>">
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon">Keterangan</span>
							<textarea id="m_keg_ket" name="m_keg_ket" class="form-control" ><?php echo set_value('m_keg_ket'); ?></textarea>
						</div>
						<?php echo form_error('m_keg_aktif', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<div class="form-group input-group">
							<span class="input-group-addon">Aktif</span>	
							<?php echo yesnoDropdown(FALSE,'m_keg_aktif',set_value('m_keg_aktif'));?>
						</div>
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