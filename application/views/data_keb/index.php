<script type="text/javascript">
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
										<th>Tanggal</th>
										<th>Nama Ibadah</th>
										<th>Ontime</th>
										<th>Terlambat</th>
										<th>Jml Hadir</th>
									</tr>
								</thead>
								<tbody>
								<?php
									$no = 1 + $urut;
									foreach($res as $row):
								?>
								<!-- Modal for detail  -->
								<div class="modal fade" id="myModalInfoKeb-<?php echo $row["keb_id"];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog">
											<div class="panel panel-default">
												<div class="panel-heading">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title" id="myModalLabel"><?php echo getDataTableById('tb_m_ibadah','m_ib_name','m_ib_id',$row['keb_m_ib_id'])?> - <?php echo indDate($row["keb_tgl"]);?></h4>
												</div>
												<div class="panel-body">
													<ul class="list-unstyled">
														<li><strong>Tema : </strong></li><li><?php echo $row['keb_tema']?></li>
														<li><strong>Pengkotbah : </strong></li><li><?php echo $row['keb_pengkotbah']?></li>
														<li><strong>Ayat Kotbah : </strong></li><li><?php echo $row['keb_ayat']?></li>
														<li><strong>Ayat Persembahan : </strong></li><li><?php echo $row['keb_persembahan']?></li>
														<li><strong>Liturgos : </strong></li><li><?php echo $row['keb_liturgos']?></li>
														<li><strong>Majelis Bertugas : </strong></li><li><?php echo $row['keb_majelis']?></li>
														<li><strong>Pianis : </strong></li><li><?php echo $row['keb_pianis']?></li>
														<li><strong>Organis : </strong></li><li><?php echo $row['keb_organis']?></li>
														<li><strong>Tim Musik : </strong></li><li><?php echo $row['keb_tim_musik']?></li>
														<li><strong>Pemandu Nyanyian : </strong></li><li><?php echo $row['keb_pmdu_nyanyian']?></li>
														<li><strong>Nyanyian : </strong></li><li><?php echo $row['keb_nanyian']?></li>									
														<li><strong>Multimedia / LCD : </strong></li><li><?php echo $row['keb_mulmed_lcd']?></li>
														<li><strong>Penyambut : </strong></li><li><?php echo $row['keb_penyambut']?></li>
														<li><strong>Kolektan : </strong></li><li><?php echo $row['keb_kolektan']?></li>
														<li><strong>Keterangan : </strong></li><li><?php echo $row['keb_ket']?></li>	
														<li><strong>Waktu Kebaktian : </strong></li><li><?php echo $row['keb_tgl'].' '.$row['m_ib_start_time'];?></li>
														<li><strong>Jumlah Hadir : </strong></li><li><?php echo cekKehadiran(TRUE,'keb','all',$row["keb_id"],FALSE)?></li>
														<li><strong>On Time : </strong></li><li><?php echo cekKehadiran(TRUE,'keb','ontime',$row["keb_id"],$row['keb_tgl'].' '.$row['m_ib_start_time'])?></li>
														<li><strong>Terlambat : </strong></li><li><strong class="text-danger"><?php echo cekKehadiran(TRUE,'keb','late',$row["keb_id"],$row['keb_tgl'].' '.$row['m_ib_start_time'])?></strong></li>
													</ul>
												</div>
												<div class="panel-footer">
													<button type="button" class="btn btn-lg btn-primary btn-block"><strong>Absen Kehadiran</strong></button>
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
									<b><?php echo indDate($row["keb_tgl"]);?></b>
									<div>
										<button data-toggle="modal" data-target="#myModalInfoKeb-<?php echo $row["keb_id"];?>" type="button" class="btn btn-info btn-xs">View Details</button>
									</div>
									</td>
									<td><?php echo getDataTableById('tb_m_ibadah','m_ib_name','m_ib_id',$row['keb_m_ib_id'])?></td>
									<td><?php echo cekKehadiran(TRUE,'keb','ontime',$row["keb_id"],$row['keb_tgl'].' '.$row['m_ib_start_time'])?></td>
									<td><?php echo cekKehadiran(TRUE,'keb','late',$row["keb_id"],$row['keb_tgl'].' '.$row['m_ib_start_time'])?></td>
									<td><?php echo cekKehadiran(TRUE,'keb','all',$row["keb_id"],FALSE)?></td>
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