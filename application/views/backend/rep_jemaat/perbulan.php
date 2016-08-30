<script type="text/javascript">
function CetakAll()
{
	url = "<?php echo site_url().'backend/rep_jemaat/cetak_all/'?>";
	window.open(url, '_blank ');
}
function ClearNama()
{
	 $("#key_nama" ).val("");
}
function CariPerbulan()
{
	var key_nama 	= document.getElementById("key_nama").value;
	var form 		= document.getElementById("cari_perbulan");
	
	form.submit();
	
	/*
	if(key_nama)
	{
		form.submit();
	}
	else
	{
		alert("Nama harus diisi");
	}
	*/
	
}
function BackPerbulan()
{
	url = "<?php echo site_url().'backend/rep_jemaat/perbulan'?>";
	window.open(url, '_self');
}
</script>
<div class="row">
	<div class="col-lg-12">
	<?php echo $this->session->flashdata('message_type');?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php echo $title;?>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<!-- Nav tabs -->
                <?php $this->load->view('backend/rep_jemaat/tab_top');?>
				<!-- Tab panes -->
                <div class="tab-content">
					<div class="tab-pane fade in active" id="perbulan">
						<h4><?php echo $title;?></h4>
						<div class="row">
						<form id="<?php echo $form_id;?>" action="" method="POST">
							<div class="col-lg-3">
								<div class="form-group input-group">
									<span class="input-group-addon">Nama</span>
									<?php 
									if($key_nama):?>
										<input name="key_nama" id="key_nama" type="text" class="form-control" placeholder="Nama..." value="<?php echo $key_nama;?>">
									<?php else :?>
										<input name="key_nama" id="key_nama" type="text" class="form-control" placeholder="Nama...">
									<?php endif;?>
								</div>
							</div>
							<div class="col-lg-1">
											<div class="form-group input-group">
												<button type="button" onClick="ClearNama()" class="btn btn-primary">Clear</button>
											</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group input-group">
								<span class="input-group-addon">Bulan</span>
									<?php echo bulanDropdown('filter_bln',$date_time,$this->config->item('y_begin'),$this->config->item('y_end'))?>
								</div>
							</div>
							<div style="margin-right:20px"class="col-lg-1">
								<div class="form-group input-group">
									<button type="button" onClick="<?php echo $onclick_cari;?>()" class="btn btn-primary">Apply Filter</button>
								</div>
							</div>
						</form>
							<?php 
									if($filter):?>
										<div class="col-lg-2">
											<div class="form-group input-group">
												<button type="button" onClick="<?php echo $onclick_back;?>()" class="btn btn-primary">Kembali</button>
											</div>
										</div>
									<?php endif;?>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="table-responsive table-bordered">
									<table class="table table-hover">
										<thead>
											<tr>
												<th>#</th>
												<th>Nama Jemaat</th>
												<th>Jumlah Hadir</th>
												<th>Detail</th>
											</tr>
										</thead>
										<tbody>
										<?php
											$no = 1 + $urut;
											foreach($res as $row):
										?>
											<tr>
												<td><?php echo $no;?></td>
												<td><b><?php echo $row["m_jmt_nama"]?></b>
												<br>
												<?php echo $row['m_jmt_no_induk'];?>
												</td>
												<td><?php echo $row['count_jmt'];?></td>
												<td><button onClick="DetailHdr(<?php echo $row["m_jmt_id"]?>)" type="button" class="btn btn-primary btn-xs">Detail</button></td>
											</tr>
										<?php 
											$no++;
											endforeach;
										?>
										</tbody>
									</table>
								</div>
							</div>
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
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
