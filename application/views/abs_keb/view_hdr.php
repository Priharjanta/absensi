<script type="text/javascript">
// autocomplet : this function will be executed every time we change the text
function autocomplet() {
	var min_length = 2; // min caracters to display the autocomplete
	var keyword = $('#jmt_id').val();
	if (keyword.length >= min_length) {
		$.ajax({
			url: '<?php echo site_url().'abs_keb/searchJemaat'?>',
			type: 'POST',
			data: {keyword:keyword},
			success:function(data){
				$('#jmt_list').show();
				$('#jmt_list').html(data);
			}
		});
	} else {
		$('#jmt_list').hide();
	}
}

// set_item : this function will be executed when we select an item
function set_item(item,id) {
	// change input value
	$('#jmt_id').val(item);
	$('#nama_jemaat').val(item);
	$('#jmt_id_id').val(id);
	// hide proposition list
	$('#jmt_list').hide();
}

function add()
{
	name = $('#jmt_id').val();
	alert(name);
}
</script>


<style type="text/css">
    ul.list{
        padding: 0;
        list-style: none;
        background: #f2f2f2;
    }
    ul.list li{
        display: inline-block;
        line-height: 21px;
        text-align: left;
    }
    ul.list li a{
		padding: 8px 50px;
        display: block;
        color: #333;
        text-decoration: none;
    }
    ul.list li a:hover{
        color: #fff;
        background: #939393;
    }
	#jmt_list {display: none;}
</style>
<div class="row">
	<div class="col-lg-12">
	<?php echo $this->session->flashdata('message_type');?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php echo $title;?>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-4">
					
						<div class="form-group">
							<input type="text" id="jmt_id" onkeyup="autocomplet()" class="form-control" placeholder="Ketik nama ...">
							<ul style="margin: 0px 0px 0px 15px;" class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" id="jmt_list"></ul>
						</div>
					</div>
					<div class="col-lg-8">
						<div class="form-group input-group">
							<button type="button" data-toggle="modal" data-target="#myModalAbsen" class="btn btn-primary">Tambah Absen</button> Atau
							<button type="button" data-toggle="modal" data-target="#myModalAddJemaat" class="btn btn-primary">Tambah Jemaat</button>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="table-responsive table-bordered">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Nama</th>
										<th>Jenis Kelamin</th>
										<th>Jam Masuk</th>
									</tr>
								</thead>
								<tbody>
								<?php
									$no = 1 + $urut;
									foreach($res as $row):
								?>
								<tr>
									<td><?php echo $no;?></td>
									<td>
									<b><?php echo $row["m_jmt_nama"];?></b>
									<div>
										<button data-toggle="modal" data-target="#myModalInfo-<?php echo $row["hdr_keb_id"];?>" type="button" class="btn btn-info btn-xs">Lihat Detil</button>
									</div>
									</td>
									<td><?php echo $row['m_jmt_jenkel'];?></td>
									<td><?php echo formatDate($row['hdr_keb_datetime'],'time_only');?></td>
								</tr>
								<!-- Modal for detail  -->
								<div class="modal fade" id="myModalInfo-<?php echo $row["hdr_keb_id"];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog">
											<div class="panel panel-default">
												<div class="panel-heading">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title" id="myModalLabel"><?php echo $title;?></h4>
												</div>
												<div class="panel-body">
														<p><strong>Nama : </strong><?php echo $row["m_jmt_nama"];?></p>
														<p><strong>Jenis Kelamin : </strong><?php echo $row["m_jmt_jenkel"];?></p>
														<p><strong>No Telp / HP : </strong><?php echo $row["m_jmt_telp_1"];?></p>
														<p><strong>Jam Ibadah : </strong><?php echo $row_ibkeb->m_ib_start_time;?>
														<p><strong>Jam Masuk : </strong><?php echo formatDate($row['hdr_keb_datetime'],'time_only');?></p>
														
														<?php
															$late = dateTimeSubct($row['hdr_keb_datetime'],$row_ibkeb->keb_tgl.' '.$row_ibkeb->m_ib_start_time);
															if ($late){
																echo '<p><strong>Terlambat : </strong>';
																if($late['days'] > 0) echo $late['days'].' hari ';
																if($late['hours'] > 0) echo $late['hours'].' jam ';
																if($late['minutes'] > 0) echo $late['minutes'].' menit ';
																if($late['seconds'] > 0) echo $late['seconds'].' detik';
															}
														?>
														</p>
												</div>
											</div>
										<!-- /.modal-content -->
									</div>
									<!-- /.modal-dialog -->
								</div>
								<!-- /.modal -->
								<?php
									$no++;
									endforeach;
								?>
								</tbody>
							</table>
						</div>
					</div>
					<!-- /.table-responsive -->
				</div>
				<div class="row">
					<?php if($this->pagination->create_links()==TRUE):?>
						<div class="col-sm-6">	
							<div id="dataTables-example_paginate" class="dataTables_paginate paging_simple_numbers">
							<?php echo $this->pagination->create_links(); ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->


<!-- Modal for absen  -->
<div class="modal fade" id="myModalAbsen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $title;?></h4>
            </div>
			<form action="<?php echo site_url().'abs_keb/add_abs';?>" role="form" method="post" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group input-group">
						<span class="input-group-addon">Nama</span>
						<input type="text" disabled="disabled" id="nama_jemaat" name="nama_jemaat" class="form-control"  value="">
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon">Keterangan</span>
						<input type="text" id="hdr_keb_ket" name="hdr_keb_ket" class="form-control"  value="">
					</div>
				</div>
				<input type="hidden" id="jmt_id_id" name="hdr_m_jmt_id" class="form-control"  value="">
				<input type="hidden" id="hdr_keb_keb_id" name="hdr_keb_keb_id" class="form-control"  value="<?php echo $keb_id;?>">
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit" class="btn btn-primary" value="Simpan">
				</div>
			</form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Modal for add jemaat  -->
<div class="modal fade" id="myModalAddJemaat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $title;?></h4>
            </div>
			<form action="<?php echo site_url().'abs_keb/add_jmt_abs';?>" role="form" method="post" enctype="multipart/form-data">
				<div class="modal-body">
					<?php echo form_error('m_jmt_nama', '<div class="alert alert-danger">', '</div>'); ?>
					<div class="form-group input-group">
						<span class="input-group-addon">Nama *</span>
						<input type="text" id="m_jmt_nama" name="m_jmt_nama" class="form-control"  value="">
					</div>
					<?php echo form_error('m_jmt_jenkel', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon">Jenis Kelamin *</span>
							<?php echo jenkelDropdown(set_value('m_jmt_jenkel'));?>
						</div>
					<?php echo form_error('m_jmt_telp_1', '<div class="alert alert-danger">', '</div>'); ?>
					<div class="form-group input-group">
						<span class="input-group-addon">No Telp</span>
						<input type="text" id="m_jmt_telp_1" name="m_jmt_telp_1" class="form-control"  value="">
					</div>
					<?php echo form_error('m_jmt_hp_1', '<div class="alert alert-danger">', '</div>'); ?>
					<div class="form-group input-group">
						<span class="input-group-addon">No HP</span>
						<input type="text" id="m_jmt_hp_1" name="m_jmt_hp_1" class="form-control"  value="">
					</div>
					<?php echo form_error('m_jmt_ket', '<div class="alert alert-danger">', '</div>'); ?>
					<div class="form-group input-group">
						<span class="input-group-addon">Keterangan</span>
						<input type="text" id="m_jmt_ket" name="m_jmt_ket" class="form-control"  value="">
					</div>
					<p>
					* Harus diisi
					</p>
				</div>
				<input type="hidden" id="hdr_keb_keb_id" name="hdr_keb_keb_id" class="form-control"  value="<?php echo $keb_id;?>">

				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" name="submitForm" value="save_only">Simpan</button>
					<button type="submit" class="btn btn-primary" name="submitForm" value="save_absen"> Simpan dan Absen</button>
				</div>
			</form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->