<script type="text/javascript">
	function f_tcalUpdate (n_date, b_keepOpen) 
	{
		var e_input = f_tcalGetInputs(true);
		if (!e_input) return;
		
		d_date = new Date(n_date);
		var s_pfx = A_TCALCONF.cssprefix;

		if (b_keepOpen) {
			var e_cal = document.getElementById(s_pfx);
			if (!e_cal || e_cal.style.visibility != 'visible') return;
			e_cal.innerHTML = f_tcalGetHTML(d_date, e_input);
		}
		else {
			e_input.value = f_tcalGenerateDate(d_date, A_TCALCONF.format);
			f_tcalCancel();
		}
	}
	function showKab_1(val)
	{
		$('#txtHintKab_1').load('<?php echo site_url().'backend/m_jemaat/ajaxShowKab/m_jmt_kab_id_1/'?>'+val+'/showKotKec_1');
		$('#txtHintKotkec_1').load('<?php echo site_url().'backend/m_jemaat/ajaxShowKotKec/m_jmt_kec_id_1'?>');
	}
	
	function showKotKec_1(val)
	{
		prov_id = $('#m_jmt_prov_id_1').val();
		$('#txtHintKotkec_1').load('<?php echo site_url().'backend/m_jemaat/ajaxShowKotKec/m_jmt_kec_id_1/'?>'+val+'/'+prov_id);
	}
	
	function showKab_2(val)
	{
		$('#txtHintKab_2').load('<?php echo site_url().'backend/m_jemaat/ajaxShowKab/m_jmt_kab_id_2/'?>'+val+'/showKotKec_2');
		$('#txtHintKotkec_2').load('<?php echo site_url().'backend/m_jemaat/ajaxShowKotKec/m_jmt_kec_id_2'?>');
	}
	
	function showKotKec_2(val)
	{
		prov_id = $('#m_jmt_prov_id_2').val();
		$('#txtHintKotkec_2').load('<?php echo site_url().'backend/m_jemaat/ajaxShowKotKec/m_jmt_kec_id_2/'?>'+val+'/'+prov_id);
	}

</script>
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
						<?php echo form_error('m_jmt_no_induk', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">No Induk</span>
							<input type="text" name="m_jmt_no_induk" class="form-control" value=<?php echo set_value('m_jmt_no_induk');?>>
						</div>
						<?php echo form_error('m_jmt_nama', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Nama Jemaat *</span>
							<input type="text" name="m_jmt_nama" class="form-control" value="<?php echo set_value('m_jmt_nama'); ?>">
						</div>
						<?php echo form_error('m_jmt_jenkel', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Jenis Kelamin *</span>
							<?php echo jenkelDropdown(set_value('m_jmt_jenkel'));?>
						</div>
						<?php echo form_error('m_jmt_tgl_lhr', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Tanggal Lahir *</span>
							<?php echo dateDropdown('m_jmt_tgl_lhr',set_value('m_jmt_tgl_lhr'),'1950','2020');?>
						</div>
						<?php echo form_error('m_jmt_tmpt_lhr', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Tempat Lahir *</span>			
							<input type="text" name="m_jmt_tmpt_lhr" class="form-control" value="<?php echo set_value('m_jmt_tmpt_lhr');?>">
						</div>
						<?php echo form_error('m_jmt_status_kawin', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Status Perkawinan</span>
							<?php echo kawinDropdown(set_value('m_jmt_status_kawin'));?>
						</div>
						<?php echo form_error('m_jmt_tgl_menikah', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Tanggal Menikah</span>
							<?php echo dateDropdown('m_jmt_tgl_menikah',FALSE,'1950','2020');?>
						</div>
						<?php echo form_error('m_jmt_alamat_1', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Alamat 1</span>
							<input type="text" name="m_jmt_alamat_1" class="form-control" value="<?php echo set_value('m_jmt_alamat_1'); ?>">
						</div>
						<?php echo form_error('m_jmt_prov_id_1', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Province</span>
							<?php echo provDropdown(set_value('m_jmt_prov_id_1'),'m_jmt_prov_id_1','showKab_1')?>
						</div>
						<?php echo form_error('m_jmt_kab_id_1', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Kabupaten</span>
							<div id="txtHintKab_1">
								<?php echo kabDropdown(set_value('m_jmt_prov_id_1'),set_value('m_jmt_kab_id_1'),'m_jmt_kab_id_1','showKotkec_1')?>
							</div>
						</div>
						<?php echo form_error('m_jmt_kec_id_1', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Kecamatan</span>
							<div id="txtHintKotkec_1">
								<?php echo kotkecDropDown(set_value('m_jmt_prov_id_1'),set_value('m_jmt_kab_id_1'),set_value('m_jmt_kec_id_1'),'m_jmt_kec_id_1'); ?>
							</div>
						</div>
						<?php echo form_error('m_jmt_telp_1', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Telp / HP *</span>
							<input type="text" name="m_jmt_telp_1" class="form-control" value="<?php echo set_value('m_jmt_telp_1');?>">
						</div>
						<?php echo form_error('m_jmt_alamat_2', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Alamat 2</span>
							<input type="text" name="m_jmt_alamat_2" class="form-control" value="<?php echo set_value('m_jmt_alamat_2'); ?>">
						</div>
						<?php echo form_error('m_jmt_prov_id_2', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Province</span>
							<?php echo provDropdown(set_value('m_jmt_prov_id_2'),'m_jmt_prov_id_2','showKab_2')?>
						</div>
						<?php echo form_error('m_jmt_kab_id_2', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Kabupaten</span>
							<div id="txtHintKab_2">
								<?php echo kabDropdown(set_value('m_jmt_prov_id_2'),set_value('m_jmt_kab_id_2'),'m_jmt_kab_id_2','showKotkec_2')?>
							</div>
						</div>
						<?php echo form_error('m_jmt_kec_id_2', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Kecamatan</span>
							<div id="txtHintKotkec_2">
								<?php echo kotkecDropDown(set_value('m_jmt_prov_id_2'),set_value('m_jmt_kab_id_2'),set_value('m_jmt_kec_id_2'),'m_jmt_kec_id_2'); ?>
							</div>
						</div>
						<?php echo form_error('m_jmt_telp_2', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Telp / HP</span>
							<input type="text" name="m_jmt_telp_2" class="form-control" value="<?php echo set_value('m_jmt_telp_2'); ?>">
						</div>
					</div>
					<div class="col-lg-6">
						<?php echo form_error('m_jmt_anggota', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Anggota Jemaat</span>	
							<?php echo yesnoDropdown(FALSE,'m_jmt_anggota',set_value('m_jmt_anggota'));?>
						</div>
						<?php echo form_error('m_jmt_baptis', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Status Baptis</span>	
							<?php echo yesnoDropdown('notyet','m_jmt_baptis',set_value('m_jmt_baptis'));?>
						</div>
						<?php echo form_error('m_jmt_grj_baptis', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Gereja Tempat Baptis</span>
							<input type="text" name="m_jmt_grj_baptis" class="form-control" value="<?php echo set_value('m_jmt_grj_baptis'); ?>">
						</div>
						<?php echo form_error('m_jmt_tgl_baptis', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Tanggal Baptis</span>
							<?php echo dateDropdown('m_jmt_tgl_baptis',FALSE,'1950','2020');?>
						</div>
						<?php echo form_error('m_jmt_sidi', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Status Sidi / Pengakuan Percaya</span>
							<?php echo yesnoDropdown('notyet','m_jmt_sidi',set_value('m_jmt_baptis'));?>
						</div>
						<?php echo form_error('m_jmt_grj_sidi', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Gereja Tempat Sidi</span>
							<input type="text" name="m_jmt_grj_sidi" class="form-control" value="<?php echo set_value('m_jmt_grj_sidi'); ?>">
						</div>
						<?php echo form_error('m_jmt_tgl_sidi', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Tanggal Sidi</span>
							<?php echo dateDropdown('m_jmt_tgl_sidi',FALSE,'1950','2020');?>
						</div>
						<?php echo form_error('m_jmt_grj_asal', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Gereja Asal</span>
							<input type="text" name="m_jmt_grj_asal" class="form-control" value="<?php echo set_value('m_jmt_grj_asal'); ?>">
						</div>
						<?php echo form_error('m_jmt_tgl_masuk', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Tanggal Atestasi Masuk</span>
							<?php echo dateDropdown('m_jmt_tgl_masuk',FALSE,'1950','2020');?>
						</div>
						<?php echo form_error('m_jmt_aktif', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Aktif</span>
							<?php echo yesnoDropdown(FALSE,'m_jmt_aktif',set_value('m_jmt_aktif'));?>
						</div>
						<?php echo form_error('m_jmt_ket', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Keterangan</span>
							<input type="text" name="m_jmt_ket" class="form-control" value="<?php echo set_value('m_jmt_ket'); ?>">
						</div>
						<?php echo form_error('m_jmt_parent_child_id', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Keluarga</span>
							<input type="text" name="m_jmt_parent_child_id" class="form-control" value="<?php echo set_value('m_jmt_parent_child_id'); ?>">
						</div>
						<?php echo form_error('m_jmt_parent_child_hub', '<div class="alert alert-danger">', '</div>'); ?>
							<div class="form-group input-group">
							<span class="input-group-addon">Hubungan Keluarga</span>
							<input type="text" name="m_jmt_parent_child_hub" class="form-control" value="<?php echo set_value('m_jmt_parent_child_hub'); ?>">
						</div>
						<p>
							* Harus diisi
						</p>
						<p>
							<input type="submit" class="btn btn-primary" value="Simpan">
							<button type="button" class="btn btn-warning">Batal</button>
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