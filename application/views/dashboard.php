<script type="text/javascript">
function absKeb(id)
{
	url = "<?php echo site_url().'abs_keb/view/hdr/'?>"+id;
	window.open(url, '_self');
}

function GuestPage(id)
{
	url = "<?php echo site_url().'guest/keb/'?>"+id;
	window.open(url, '_blank');
}
</script>
<div class="row">
	<div class="col-lg-12">
	<?php echo $this->session->flashdata('message_type');?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php echo 'Kebaktian hari ini';?>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="row">
					<?php foreach($arr_keb as $row_keb):?>
						<!-- Modal for detail  -->
						<div class="modal fade" id="myModalInfoKeb-<?php echo $row_keb["keb_id"];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
									<div class="panel panel-default">
										<div class="panel-heading">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title" id="myModalLabel"><?php echo $row_keb['m_ib_name']?></h4>
										</div>
										<div class="panel-body">
											<ul class="list-unstyled">
												<li><strong>Tema : </strong></li><li><?php echo $row_keb['keb_tema']?></li>
												<li><strong>Pengkotbah : </strong></li><li><?php echo $row_keb['keb_pengkotbah']?></li>
												<li><strong>Ayat : </strong></li><li><?php echo $row_keb['keb_ayat']?></li>
												<li><strong>Waktu Kebaktian : </strong></li><li><?php echo $row_keb['keb_tgl'].' '.$row_keb['m_ib_start_time'];?></li>
												<li><strong>Jumlah Hadir : </strong></li><li><?php echo cekKehadiran(TRUE,'keb','all',$row_keb["keb_id"],FALSE)?></li>
												<li><strong>On Time : </strong></li><li><?php echo cekKehadiran(TRUE,'keb','ontime',$row_keb["keb_id"],$row_keb['keb_tgl'].' '.$row_keb['m_ib_start_time'])?></li>
												<li><strong>Terlambat : </strong></li><li><strong class="text-danger"><?php echo cekKehadiran(TRUE,'keb','late',$row_keb["keb_id"],$row_keb['keb_tgl'].' '.$row_keb['m_ib_start_time'])?></strong></li>
											</ul>
										</div>
										<div class="panel-footer">
											<!-- <button onClick="absKeb(<?php //echo $row_keb["keb_id"];?>)" type="button" class="btn btn-lg btn-primary"><strong>Absen Kehadiran</strong></button> -->
											<button onClick="GuestPage(<?php echo $row_keb["keb_id"];?>)" type="button" class="btn btn-lg btn-primary"><strong>Absen Kehadiran</strong></button>
										</div>
									</div>
								<!-- /.modal-content -->
							</div>
							<!-- /.modal-dialog -->
						</div>
						<!-- /.modal -->
						<div class="col-lg-3 col-md-6">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-12 text-right">
											<div class="huge"><?php echo $row_keb['count_jemaat']?></div>
											<div>
												<ul class="list-unstyled">
													<li><?php echo $row_keb['m_ib_name']?></li>
													<li><strong><?php echo $row_keb['keb_tema']?></strong></li>
													<li><?php echo $row_keb['keb_pengkotbah']?></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<a href="#" data-toggle="modal" data-target="#myModalInfoKeb-<?php echo $row_keb["keb_id"];?>">
									<div class="panel-footer">
										<span class="pull-left">View Details</span>
										<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
										<div class="clearfix"></div>
									</div>
								</a>
							</div>
						</div>
					<?php endforeach;?>
				</div>
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php echo 'Kegiatan hari ini';?>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="row">
					<?php foreach($arr_keg as $row_keg):?>
						<!-- Modal for detail  -->
						<div class="modal fade" id="myModalInfoKeg-<?php echo $row_keg["keg_id"];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
									<div class="panel panel-default">
										<div class="panel-heading">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title" id="myModalLabel"><?php echo $row_keg['m_keg_name']?></h4>
										</div>
										<div class="panel-body">
											<ul class="list-unstyled">
												<li><strong>Tema : </strong></li><li><?php echo $row_keg['keg_tema']?></li>
												<li><strong>Pembicara : </strong></li><li><?php echo $row_keg['keg_pembicara']?></li>
												<li><strong>Ayat : </strong></li><li><?php echo $row_keg['keg_ayat']?></li>
												<li><strong>Waktu Kegiatan : </strong></li><li><?php echo $row_keg['keg_date'].' '.$row_keg['m_keg_start_time'];?></li>
												<li><strong>Jumlah Hadir : </strong></li><li><?php echo cekKehadiran(TRUE,'keg','all',$row_keg["keg_id"],FALSE)?></li>
												<li><strong>On Time : </strong></li><li><?php echo cekKehadiran(TRUE,'keg','late',$row_keg["keg_id"],$row_keg['keg_date'].' '.$row_keg['m_keg_start_time'])?></li>
												<li><strong>Terlambat : </strong></li><li><strong class="text-danger"><?php echo cekKehadiran(TRUE,'keg','ontime',$row_keg["keg_id"],$row_keg['keg_date'].' '.$row_keg['m_keg_start_time'])?></strong></li>
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
						<div class="col-lg-3 col-md-6">
							<div class="panel panel-green">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-12 text-right">
											<div class="huge"><?php echo $row_keg['count_jemaat']?></div>
											<div>
												<ul class="list-unstyled">
													<li><?php echo $row_keg['m_keg_name']?></li>
													<li><strong><?php echo $row_keg['keg_tema']?></strong></li>
													<li><?php echo $row_keg['keg_pembicara']?></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<a href="#" data-toggle="modal" data-target="#myModalInfoKeg-<?php echo $row_keg["keg_id"];?>">
									<div class="panel-footer">
										<span class="pull-left">View Details</span>
										<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
										<div class="clearfix"></div>
									</div>
								</a>
							</div>
						</div>
					<?php endforeach;?>
				</div>
			</div>
			<!-- /.panel-body -->
		</div>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->