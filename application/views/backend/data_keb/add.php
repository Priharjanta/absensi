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
						<?php echo form_error('keb_tgl_y', '<div class="alert alert-danger">', '</div>'); ?>
						<?php echo form_error('keb_tgl_m', '<div class="alert alert-danger">', '</div>'); ?>
						<?php echo form_error('keb_tgl_d', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<?php 
								if(set_value('keb_tgl_y')||set_value('keb_tgl_m')||set_value('keb_tgl_d')):
									$date = set_value('keb_tgl_y').'-'.set_value('keb_tgl_m').'-'.set_value('keb_tgl_d');
								else:
									$date = '0000-00-00';
								endif;
							?>
							<span class="input-group-addon">Tanggal Kebaktian</span>
							<?php echo dateDropdown('keb_tgl',$date,'1950','2020');?>
						</div>
						<?php echo form_error('keb_m_ib_id', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Nama Ibadah</span>	
							<?php echo ibadahDropdown(set_value('keb_m_ib_id'),'keb_m_ib_id',FALSE)?>
						</div>
						<?php echo form_error('keb_tema', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Tema</span>
							<input type="text" name="keb_tema" class="form-control"  value="<?php echo set_value('keb_tema'); ?>">
						</div>
						<?php echo form_error('keb_pengkotbah', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Pengkotbah</span>	
							<input type="text" name="keb_pengkotbah" class="form-control" value="<?php echo set_value('keb_pengkotbah'); ?>">
						</div>
						<?php echo form_error('keb_liturgos', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Liturgos</span>	
							<input type="text" name="keb_liturgos" class="form-control" value="<?php echo set_value('keb_liturgos'); ?>">
						</div>
						<?php echo form_error('keb_majelis', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Majelis</span>	
							<input type="text" name="keb_majelis" class="form-control" value="<?php echo set_value('keb_majelis'); ?>">
						</div>
						<?php echo form_error('keb_pianis', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Pianis</span>	
							<input type="text" name="keb_pianis" class="form-control" value="<?php echo set_value('keb_pianis'); ?>">
						</div>
						<?php echo form_error('keb_organis', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Organis</span>	
							<input type="text" name="keb_organis" class="form-control" value="<?php echo set_value('keb_organis'); ?>">
						</div>
						<?php echo form_error('keb_tim_musik', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Tim Musik</span>	
							<input type="text" name="keb_tim_musik" class="form-control" value="<?php echo set_value('keb_tim_musik'); ?>">
						</div>
						<?php echo form_error('keb_pmdu_nyanyian', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Pemandu Nyanian</span>	
							<input type="text" name="keb_pmdu_nyanyian" class="form-control" value="<?php echo set_value('keb_pmdu_nyanyian'); ?>">
						</div>
					</div>
					<div class="col-lg-6">
						<?php echo form_error('keb_nanyian', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Nyanian</span>	
							<input type="text" name="keb_nanyian" class="form-control" value="<?php echo set_value('keb_nanyian'); ?>">
						</div>
						<?php echo form_error('keb_ayat', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Ayat Kotbah</span>	
							<input type="text" name="keb_ayat" class="form-control" value="<?php echo set_value('keb_ayat'); ?>">
						</div>
						<?php echo form_error('keb_persembahan', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Ayat Persembahan</span>	
							<input type="text" name="keb_persembahan" class="form-control" value="<?php echo set_value('keb_persembahan'); ?>">
						</div>
						<?php echo form_error('keb_mulmed_lcd', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Multimedia / LCD</span>	
							<input type="text" name="keb_mulmed_lcd" class="form-control" value="<?php echo set_value('keb_mulmed_lcd'); ?>">
						</div>
						<?php echo form_error('keb_penyambut', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Penyambut</span>	
							<input type="text" name="keb_penyambut" class="form-control" value="<?php echo set_value('keb_penyambut'); ?>">
						</div>
						<?php echo form_error('keb_kolektan', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Kolektan</span>	
							<input type="text" name="keb_kolektan" class="form-control" value="<?php echo set_value('keb_kolektan'); ?>">
						</div>
						<?php echo form_error('keb_ket', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Keterangan</span>	
							<input type="text" name="keb_ket" class="form-control" value="<?php echo set_value('keb_ket'); ?>">
						</div>
						<?php echo form_error('keb_aktif', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Atif</span>	
							<?php echo yesnoDropdown(FALSE,'keb_aktif',set_value('keb_aktif'));?>
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