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
function SubmitFilter()
{
	$( "#filter_date" ).submit();
}
function BackCustom()
{
	url = "<?php echo site_url().'backend/rep_jemaat/custom'?>";
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
                <div class="tab-content">
					<div class="tab-pane fade in active" id="perbulan">
						<h4><?php echo $title;?></h4>
						<div class="row">
							<div class="col-lg-6">
								<div class="panel-body">
									<p><strong>Nama : </strong><?php echo $row_jmt->m_jmt_nama;?></p>
									<p><strong>No Induk : </strong><?php echo $row_jmt->m_jmt_no_induk;?></p>
									<p><strong>Jenis Kelamin : </strong><?php echo $row_jmt->m_jmt_jenkel;?></p>
									<p><strong>No Telp / HP : </strong><?php echo $row_jmt->m_jmt_telp_1;?></p>
									<p><strong>Jumlah Kehadiran dari <?php  echo formatDate($date_time_begin.' 00:00:00','year_month_only_long');?> sampai <?php  echo formatDate($date_time_end.' 00:00:00','year_month_only_long');?> : <?php echo $total_hadir;?></strong></p>
								</div>
							</div>
						</div>
						<form id="filter_date" action="" method="post">
						<div class="row">
							<div class="col-lg-3">
								<div class="form-group input-group">
								<span class="input-group-addon">Dari</span>
									<?php echo bulanDropdown('filter_dt_begin',$date_time_begin,$this->config->item('y_begin'),$this->config->item('y_end'))?>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group input-group">
								<span class="input-group-addon">Sampai</span>
									<?php echo bulanDropdown('filter_dt_end',$date_time_end,$this->config->item('y_begin'),$this->config->item('y_end'))?>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group input-group">
									<button type="button" onClick="SubmitFilter()" class="btn btn-primary">Apply Filter</button>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group input-group">
									<button type="button" onClick="Back()" class="btn btn-primary">Kembali</button>
								</div>
							</div>
						</div>
						</form>
						
						<div class="row">
							<div class="col-lg-12">
								<div class="table-responsive table-bordered">
									<table class="table table-hover">
										<thead>
											<tr>
												<th>#</th>
												<th>Tanggal Kebaktian</th>
												<th>Tema</th>
												<th>Jam Masuk</th>
											</tr>
										</thead>
										<tbody>
										<?php
											$no = 1 + $urut;
											foreach($res_keb as $row):
										?>
											<tr>
												<td><?php echo $no;?></td>
												<td><?php echo formatDate($row["keb_tgl"].' 00:00:00','admin_date')?></td>
												<td><?php echo $row['keb_tema'];?></td>
												<td><?php echo formatDate($row['hdr_keb_datetime'],'short1');?></td>
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
