<script type="text/javascript">
function add()
{
	url = "<?php echo site_url().'backend/pkj/add'?>";
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
					<div class="col-lg-3">
								<div class="form-group input-group">
								<span class="input-group-addon">Dari</span>
									<?php echo bulanDropdown('filter_dt_begin',FALSE,$this->config->item('y_begin'),$this->config->item('y_end'))?>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group input-group">
								<span class="input-group-addon">Sampai</span>
									<?php echo bulanDropdown('filter_dt_end',FALSE,$this->config->item('y_begin'),$this->config->item('y_end'))?>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group input-group">
									<button type="button" onClick="SubmitFilter()" class="btn btn-primary">Apply Filter</button>
								</div>
							</div>
					<div class="col-lg-2">
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
										<th>No</th>
										<th>Tanggal</th>
										<th>PIC</th>
										<th>Nama Jemaat</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<?php
									$no = 1;
									foreach($res as $row):
								?>
								<tr class="<?php if ($no %2 == 0) echo 'even';?>">
									<td><?php echo $no;?></td>
									<td><b><?php echo anchor('backend/pkj/edit/'.$row["pkj_id"].'/'.$row["pkj_est_date"],$row["pkj_est_date"]);?></b></td>
									<td><?php echo $row['pkj_pic']?></td>
									
									<td><?php echo getDataTableById('tb_m_jemaat','m_jmt_nama','m_jmt_id',$row['pkj_m_jmt_id']);?></td>
									<td><?php echo $row['pkj_status']?></td>
									<td>
										<?php echo anchor('backend/pkj/edit/'.$row["pkj_id"],'Edit',array('class' => 'btn btn-primary btn-xs'))?>
										<?php echo anchor('backend/pkj/delete/'.$row["pkj_id"],'Hapus',array('onclick' => "return confirm('Anda yakin menghapus data ini?')",'class' => 'btn btn-danger btn-xs'))?>
									</td>
								</tr>
								<?php
									$no++;
									endforeach;
								?>
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
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
