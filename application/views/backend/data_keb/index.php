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
										<th>Tanggal Ibadah</th>
										<th>Nama Ibadah</th>
										<th>Tema</th>
										<th>Pengkotbah</th>
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
									<b><?php echo anchor('backend/data_keb/edit/'.$row["keb_id"].'/'.$row["keb_tgl"],indDate($row["keb_tgl"]));?></b>
									<div>
										<?php echo anchor('backend/data_keb/edit/'.$row["keb_id"],'Edit',array('type'=>'button','class'=>'btn btn-primary btn-xs'))?> 
										<?php echo anchor('backend/data_keb/delete/'.$row["keb_id"].'/'.$no,'Hapus',array('type'=>'button','class'=>'btn btn-danger btn-xs','onclick' => "return confirm('Anda yakin menghapus data ini?')"))?>
									</div>
									</td>
									<td><?php echo getDataTableById('tb_m_ibadah','m_ib_name','m_ib_id',$row['keb_m_ib_id'])?></td>
									<td><?php echo $row['keb_tema']?></td>
									<td><?php echo $row['keb_pengkotbah']?></td>
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