<script type="text/javascript">

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
							<button type="button" onClick="CetakAll()" class="btn btn-primary">Cetak All</button>
							<button type="button" onClick="CetakCard()" class="btn btn-primary">Cetak Card</button>
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
										<th>No Induk</th>
										<th>Nama Jemaat</th>
										<th>Jenis Kelamin</th>
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
										<td><?php echo $row['m_jmt_no_induk'];?></td>
										<td><b><?php echo $row["m_jmt_nama"]?></b></td>
										<td><?php echo $row['m_jmt_jenkel']?></td>
										<td>
											<a href="javascript:void(0)" class="btn btn-primary btn-xs" onclick="CetakJmtCard(<?php echo $row["m_jmt_id"];?>);">Cetak Card</a>
											<a href="javascript:void(0)" class="btn btn-primary btn-xs" onclick="CetakJmtRks(<?php echo $row["m_jmt_id"];?>);">Cetak Ringkas</a>
											<a href="javascript:void(0)" class="btn btn-primary btn-xs" onclick="CetakJmtLkp(<?php echo $row["m_jmt_id"];?>);">Cetak Lengkap</a>
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
