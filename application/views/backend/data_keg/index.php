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
	url = "<?php echo site_url().'backend/data_keg/add'?>";
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
										<th>Nama</th>
										<th>Waktu Mulai</th>
										<th>Waktu Selesai</th>
										<th>Tema</th>
										<th>Pembicara</th>
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
									<b><?php echo anchor('backend/data_keg/edit/'.$row["keg_id"].'/'.$row["keg_date"],indDate($row["keg_date"]));?></b>
									<div>
										<?php echo anchor('backend/data_keg/edit/'.$row["keg_id"],'Edit',array('type'=>'button','class'=>'btn btn-primary btn-xs'))?>
										<?php echo anchor('backend/data_keg/delete/'.$row["keg_id"].'/'.$no,'Hapus',array('onclick' => "return confirm('Anda yakin menghapus data ini?')","type"=>"button","class"=>"btn btn-danger btn-xs"))?>
									</div>
									</td>
									<td><?php echo getDataTableById('tb_m_kegiatan','m_keg_name','m_keg_id',$row['keg_m_keg_id'])?></td>
									<td><?php echo $row['keg_opt_start_date_time']?></td>
									<td><?php echo $row['keg_opt_end_date_time']?></td>
									<td><?php echo $row['keg_tema']?></td>
									<td><?php echo $row['keg_pembicara']?></td>
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