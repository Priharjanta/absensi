<script type="text/javascript">
function show_this(hidden_div)
{
	$("#"+hidden_div).css({'visibility':'visible'});
}
function hide_this(hidden_div)
{
	$("#"+hidden_div).css({'visibility':'hidden'});
}
function bulk()
{
	var ids = $("input[name='bank_id[]']").serialize();
	if(confirm("Anda ingin menghapus?"))
	{
		if (ids)
		{
			$.ajax({
				type: "GET",
				url: "<?php echo site_url().'backend/bank/ajax_bulk_action/' ?>",
				cache: false,
				success: window.location.reload(),
			});
		}
	}
}
function add()
{
	url = "<?php echo site_url().'backend/m_ibadah/add'?>";
	window.open(url, '_self');
}
</script>
<script type="text/javascript">
      $(document).ready(function() {
        setTimeout(function(){
          $("#alert_box").fadeOut("slow", function () {
            $("#alert_box").remove();
          });    
        }, 3000);
      });
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
										<th>Nama Ibadah</th>
										<th>Waktu Mulai</th>
										<th>Waktu Selesai</th>
										<th>Lokasi</th>
										<th>Keterangan</th>
										<th>Aktif</th>
									</tr>
								</thead>
								<tbody>
								<?php
									$no = 1 + $urut;
									foreach($res as $row):
								?>
								<tr class="<?php if ($no %2 == 0) echo 'even';?>">
									<td><?php echo $no;?></td>
									<td>
									<b><?php echo anchor('backend/m_ibadah/edit/'.$row["m_ib_id"].'/'.$row["m_ib_name"],$row["m_ib_name"]);?></b>
									<div> 
										<?php echo anchor('backend/m_ibadah/edit/'.$row["m_ib_id"],'Edit',array('type'=>'button','class'=>'btn btn-primary btn-xs'))?>
										<?php echo anchor('backend/m_ibadah/delete/'.$row["m_ib_id"].'/'.$no,'Hapus',array('type'=>'button','class'=>'btn btn-danger btn-xs','onclick' => "return confirm('Anda yakin menghapus data ini?')"))?>
									</div>
									</td>
									<td><?php echo $row['m_ib_start_time']?></td>
									<td><?php echo $row['m_ib_end_time']?></td>
									<td><?php echo $row['m_ib_lokasi']?></td>
									<td><?php echo $row['m_ib_ket']?></td>
									<td><?php echo $row['m_ib_aktif']?></td>
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
