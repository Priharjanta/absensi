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
	url = "<?php echo site_url().'backend/m_wilayah/add'?>";
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
										<th>Nama Wilayah</th>
										<th>Koordinator / KA</th>
										<th>Telepon / HP</th>
										<th>Area / Wilayah</th>
									</tr>
								</thead>
								<tbody>
								<?php
									$no = 1 + $urut;
									foreach($res as $row):
								?>
								<tr class="<?php if ($no %2 == 0) echo 'even';?>">
									<td><?php echo $no;?></td>
									<td onMouseOver="show_this('action-<?php echo $row['m_wil_id']?>')"
									onMouseOut="hide_this('action-<?php echo $row['m_wil_id']?>')">
									<b><?php echo anchor('backend/m_wilayah/edit/'.$row["m_wil_id"].'/'.$row["m_wil_name"],$row["m_wil_name"]);?></b>
									<div id="action-<?php echo $row['m_wil_id']?>" class="action invisible">
										<?php echo anchor('backend/m_wilayah/edit/'.$row["m_wil_id"],'Edit')?> |
										<?php echo anchor('backend/m_wilayah/delete/'.$row["m_wil_id"].'/'.$no,'Hapus',array('onclick' => "return confirm('Anda yakin menghapus data ini?')"))?>
									</div>
									</td>
									<td><?php echo $row['m_wil_koord_name']?></td>
									<td><?php echo $row['m_wil_phone']?></td>
									<td><?php echo $row['m_wil_area']?></td>
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