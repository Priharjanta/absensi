<script type="text/javascript">
function absKeg(id)
{
	url = "<?php echo site_url().'backend/abs_keg/view/hdr/'?>"+id;
	window.open(url, '_self');
}


function show_this(hidden_div)
{
	$("#"+hidden_div).css({'visibility':'visible'});
}
function hide_this(hidden_div)
{
	$("#"+hidden_div).css({'visibility':'hidden'});
}

function add()
{
	url = "<?php echo site_url().'backend/data_keb/add'?>";
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
				<div class="row">
					<div class="col-lg-4">
						<div class="form-group input-group">
							<input type="text" class="form-control" placeholder="Nama...">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button"><i class="fa fa-search"></i>
								</button>
							</span>
						</div>
					</div>
					<div class="col-lg-8">
						<div class="form-group input-group">
							<button type="button" onClick="add()" class="btn btn-primary">Tambah</button>
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
										<th>Tanggal Kegiatan</th>
										<th>Nama Kegiatan</th>
										<th>Jumlah Hadir</th>
									</tr>
								</thead>
								<tbody>
								<?php
									$no = 1 + $urut;
									foreach($res as $row):
								?>
								<!-- Modal for detail  -->
								<div class="modal fade" id="myModalInfoKeg-<?php echo $row["keg_id"];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog">
											<div class="panel panel-default">
												<div class="panel-heading">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title" id="myModalLabel"><?php echo getDataTableById('tb_m_kegiatan','m_keg_name','m_keg_id',$row['keg_m_keg_id'])?> - <?php echo indDate($row["keg_date"]);?></h4>
												</div>
												<div class="panel-body">
													<ul class="list-unstyled">
														<li><strong>Tema : </strong></li><li><?php echo $row['keg_tema']?></li>
														<li><strong>Pempicara : </strong></li><li><?php echo $row['keg_pembicara']?></li>
														<li><strong>Ayat : </strong></li><li><?php echo $row['keg_ayat']?></li>
														<li><strong>Waktu Kebaktian : </strong></li><li><?php echo $row['keg_date'].' '.$row['m_keg_start_time'];?></li>
														<li><strong>Jumlah Hadir : </strong></li><li><?php echo cekKehadiran(TRUE,'keg','all',$row["keg_id"],FALSE)?></li>
														<li><strong>On Time : </strong></li><li><?php echo cekKehadiran(TRUE,'keg','late',$row["keg_id"],$row['keg_date'].' '.$row['m_keg_start_time'])?></li>
														<li><strong>Terlambat : </strong></li><li><strong class="text-danger"><?php echo cekKehadiran(TRUE,'keg','ontime',$row["keg_id"],$row['keg_date'].' '.$row['m_keg_start_time'])?></strong></li>
													</ul>
												</div>
												<div class="panel-footer">
													<button onClick="absKeg(<?php echo $row["keg_id"];?>)" type="button" class="btn btn-lg btn-primary btn-block"><strong>Absen Kehadiran</strong></button>
												</div>
											</div>
										<!-- /.modal-content -->
									</div>
									<!-- /.modal-dialog -->
								</div>
								<!-- /.modal -->
								<tr>
									<td><?php echo $no;?></td>
									<td>
									<b><?php echo anchor('backend/data_keg/edit/'.$row["keg_id"].'/'.$row["keg_date"],indDate($row["keg_date"]));?></b>
									<div>
										<button onClick="absKeg(<?php echo $row["keg_id"];?>)" type="button" class="btn btn-primary btn-xs">Absen Kehadiran</button>
										<button data-toggle="modal" data-target="#myModalInfoKeg-<?php echo $row["keg_id"];?>" type="button" class="btn btn-info btn-xs">Lihat Detil</button>
									
									</div>
									</td>
									<td><?php echo getDataTableById('tb_m_kegiatan','m_keg_name','m_keg_id',$row['keg_m_keg_id'])?></td>
									<td><?php echo cekKehadiran(TRUE,'keg','all',$row["keg_id"],FALSE)?></td>
								</tr>
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