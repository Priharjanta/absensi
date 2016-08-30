<script type="text/javascript">
function show_this(hidden_div)
{
	$("#"+hidden_div).css({'visibility':'visible'});
}
function hide_this(hidden_div)
{
	$("#"+hidden_div).css({'visibility':'hidden'});
}

function repAbsen(keb_id)
{
	url = "<?php echo site_url().'backend/rep_keb/cetak_absen/'?>"+keb_id;
	window.open(url, '_blank ');
}
function repAbsenAll(keb_id)
{
	url = "<?php echo site_url().'backend/rep_keb/cetak_all/'?>"+keb_id;
	window.open(url, '_blank ');
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
										<th>Tema/Pengkotbah</th>
										<th>Kehadiran</th>
										<th>Cetak</th>
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
									<b><?php echo indDate($row["keb_tgl"]);?></b>
									</td>
									<td><?php echo getDataTableById('tb_m_ibadah','m_ib_name','m_ib_id',$row['keb_m_ib_id'])?></td>
									<td><?php echo $row['keb_tema']?><br><i><?php echo $row['keb_pengkotbah']?></i></td>
									<td>
										<small>Absensi : <?php echo count($this->Abskeb_model->getAbskeb('byKebId',FALSE,FALSE,FALSE,$row["keb_id"])).' (L : '.count($this->Abskeb_model->getAbskeb('byKebIdPria',FALSE,FALSE,FALSE,$row["keb_id"])) .' / P : '.count($this->Abskeb_model->getAbskeb('byKebIdWanita',FALSE,FALSE,FALSE,$row["keb_id"])).')'?></small><br>
										<small>Counter : <?php echo $row['keb_count_l']+$row['keb_count_p'].' (L : '.$row['keb_count_l'] .' / P : '.$row['keb_count_l'].')'?></small>
									</td>
									<td>
										<a href="javascript:void(0)" class="btn btn-primary btn-xs" onclick="repAbsen(<?php echo $row["keb_id"];?>);">Cetak Absen</a>
										<a href="javascript:void(0)" class="btn btn-primary btn-xs" onclick="repAbsenAll(<?php echo $row["keb_id"];?>);">Cetak Ibadah -  Absen</a>
									</td>
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