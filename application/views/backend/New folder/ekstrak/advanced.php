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
	var ids = $("input[name='log_id[]']").serialize();
	if (ids)
	{
		$.ajax({
			type: "POST",
			url: "<?php echo site_url().'backend/ekstrak/ajax_bulk_action/' ?>",
			data: ids,
			success: window.location.reload()
		});
	}
}
//jQuery
$(function(){
$(".check_all").click(function()
	{
		var checked_status = this.checked;
		$(":checkbox").each(function()
		{
		this.checked = checked_status;
		});
	});
});
</script>
<script type="text/javascript">
      $(document).ready(function() {
        setTimeout(function(){
          $("#kotak").fadeOut("slow", function () {
            $("#kotak").remove();
          });    
        }, 3000);
      });
</script>

<style type="text/css">
      #kotak {
        width: 250px;
        height: 20px;
      }
</style>


<div class="left"></div>
<div class="right"></div>
<div class="heading">
	<h1 style="background-image: url('<?php echo base_url()?>assets/images/order.png');">OLAP Analisis</h1>
</div>
<div class="wrapper">
<h1>Manage Datawarehouse</h1>
<div class="table_filter_wrapper">
	<?php echo anchor('backend/ekstrak',"Easy View").' | '; ?>
	<?php echo anchor('backend/ekstrak/advanced',"<strong>Advanced View</strong>"); ?>
	<br /><br />
	<a class="btn" href="<?php echo site_url('backend/ekstrak/clean/log')?>">Clear Log</a>
</div>
<table style="width:80%">
	<thead>
		<tr>
			<th style="width:5%"><input class="check_all" type="checkbox" ></th>
			<th style="width:5%">No</th>
			<th style="width:15%">Log User</th>
			<th style="width:45%">Description</th>
			<th style="width:35">Date</th>
		</tr>
	</thead>
	<?php
		$no = 1 + $urut;
		foreach($res as $row):
	?>
	<tr class="<?php if ($no %2 == 0) echo 'even';?>">
		<td><input type="checkbox" name="log_id[]" value="<?php echo $row['log_id']?>"></td>
		<td><?php echo $no;?></td>
		<td><?php echo $row['log_user']?></td>
		<td><?php echo $row['log_desc']?></td>
		<td><?php echo $row['log_date']?></td>
	</tr>
	<?php
	 	$no++;
		endforeach;
	?>
</table>

<?php if($this->pagination->create_links()==TRUE):?>
<p id="pagination">Halaman : <?php echo $this->pagination->create_links(); ?></p>
<?php endif; ?>

<br />
<h1>Load Datawarehose Table</h1>
<?php echo $this->session->flashdata('message_type');?>
<table style="width:50%">
	<thead>
		<tr>
			<th style="width:40%">Table</th>
			<th style="width:20%">Action</th>
		</tr>
	</thead>
	
	<tr>
		<td><strong>Produk Dimension</strong></td>
		<td>
		<a class="btn" href="<?php echo site_url('backend/ekstrak/load/produk')?>">Load</a> | 
		<a class="btn" href="<?php echo site_url('backend/ekstrak/clean/produk')?>">Clean</a>
		</td>
	</tr>
	<tr>
		<td><strong>Member Dimension</strong></td>
		<td>
		<a class="btn" href="<?php echo site_url('backend/ekstrak/load/member')?>">Load</a> | 
		<a class="btn" href="<?php echo site_url('backend/ekstrak/clean/member')?>">Clean</a>
		</td>
	</tr>
	<tr>
		<td><strong>Bank Dimension</strong></td>
		<td>
		<a class="btn" href="<?php echo site_url('backend/ekstrak/load/bank')?>">Load</a> | 
		<a class="btn" href="<?php echo site_url('backend/ekstrak/clean/bank')?>">Clean</a>
		</td>
	</tr>
	<tr>
		<td><strong>Lokasi Dimension</strong></td>
		<td>
		<a class="btn" href="<?php echo site_url('backend/ekstrak/load/lokasi')?>">Load</a> | 
		<a class="btn" href="<?php echo site_url('backend/ekstrak/clean/lokasi')?>">Clean</a>
		</td>
	</tr>
	<tr>
		<td>
		<form action="<?php echo site_url('backend/ekstrak/load/time')?>" method="post">
		<strong>Time Dimension </strong> Year : <?php echo tahunDropdown2()?>
		</td>
		<td>
		<input type="submit" name="load" value="Load">
		</form> | 
		<a class="btn" href="<?php echo site_url('backend/ekstrak/clean/time')?>">Clean</a>
		</td>
	</tr>
	<tr>
		<td>
		<form action="<?php echo site_url('backend/ekstrak/load/sales')?>" method="post">
		<strong>Fact Sales </strong> Year : <?php echo tahunDropdown2()?>
		<td>
		<input type="submit" name="load" value="Load">
		</form> | 
		<a class="btn" href="<?php echo site_url('backend/ekstrak/clean/sales')?>">Clean</a>
		</td>
	</tr>
</table>

<br />
<h1>Datawarehouse Setting</h1>
<strong>Backup DB Datawarehouse :</strong>
<form action="<?php echo site_url('backend/ekstrak/backup')?>" method="post" enctype="multipart/form-data">
Year : <?php echo tahunDropdown()?> 
<input type="submit" name="uploadbutton" value="Backup"> 
</form>
<br />
<strong>Load DB Datawarehouse : </strong>
<form id="loadform" action="<?php echo site_url('backend/ekstrak/import')?>" method="post" enctype="multipart/form-data" >
		<ul>
			<li>
				<label for="sql_file">(sql File)</label>
				<?php echo form_error('sql_file', '<div class="error">', '</div>'); ?>
				<input type="file" name="sql_file" class="subtitle">
            </li>
			<li>
				<input type="submit" name="uploadbutton" value="Go"> or <?php echo anchor('backend/produk','Batal')?>
			</li>
		</ul>
</form>

</div>
