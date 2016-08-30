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
	var ids = $("input[name='kontak_id[]']").serialize();
	if(confirm("Anda ingin menghapus?"))
	{
		if (ids)
		{
			$.ajax({
				type: "POST",
				url: "<?php echo site_url().'backend/contact/ajax_bulk_action/' ?>",
				data: ids,
				success: window.location.reload()
			});
		}
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
<div class="left"></div>
<div class="right"></div>
<div class="heading">
	<h1 style="background-image: url('<?php echo base_url()?>assets/images/order.png');">Setting</h1>
</div>
<div class="wrapper">

<h1>Kontak Kami</h1>
<div class="table_filter_wrapper">
	<input type="button" onclick="bulk()" value="Hapus">
</div>
	<table  style="width:50%">
		<thead>
			<tr>
				<th style="width:5%"><input class="check_all" type="checkbox" ></th>
				<th style="width:5%">No</th>
				<th style="width:20%">Dari</th>
				<th style="width:20%">Subject</th>
				<th style="width:20%">Date</th>
			</tr>
		</thead>
		<?php 
			$no = 1 + $urut;
			foreach($res_con as $row):
			$message = unserialize($row['pesan']);
			$subject = $message['subject'];
		?>
		<tr class="<?php if ($no %2 == 0) echo 'even';?> 
				   <?php if ($row['status']=='unread') echo 'unread';?>">
			<td><input type="checkbox" name="kontak_id[]" value="<?php echo $row['kontak_id']?>"></td>
			<td><?php echo $no;?></td>
					<td onMouseOver="show_this('action-<?php echo $row['kontak_id'];?>')"
		onMouseOut="hide_this('action-<?php echo $row['kontak_id'];?>')">
		<b><?php echo anchor('backend/contact/detail/'.$row['kontak_id'],$row['nama_kontak']);?></b>
		<div id="action-<?php echo $row['kontak_id'];?>" class="action invisible">
			<?php echo anchor('backend/contact/detail/'.$row['kontak_id'],'Lihat')?> |
			<?php echo anchor('backend/contact/delete/'.$row['kontak_id'].'/'.$no,'Hapus')?>
		</div>
		</td>
			<td><?php echo $subject;?></td>
			<td><?php echo formatDate($row['date'],'short');?></td>
		</tr>
		<?php 
		 	$no++;  
			endforeach;
		?>
	</table>
	<?php if($this->pagination->create_links()==TRUE):?>
<p id="pagination">Halaman : <?php echo $this->pagination->create_links(); ?></p>
<?php endif; ?>
	</div>
	
	
</div>
