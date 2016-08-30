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
	var ids = $("input[name='member_id[]']").serialize();
	if(confirm("Anda ingin menghapus?"))
	{
		if (ids)
		{
			$.ajax({
				type: "POST",
				url: "<?php echo site_url().'backend/member/ajax_bulk_action/' ?>",
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
	<h1 style="background-image: url('<?php echo base_url()?>assets/images/product.png');">Katalog</h1>
</div>
<div class="wrapper">
<h1>Member</h1>
<div class="table_filter_wrapper">
	<a href="#cari" rel="facebox"><img style="width:25px;heigth:25px;margin-bottom:-5px;"src="<?php echo base_url()?>/assets/images/search.gif"><a/>
	<div id="cari" style="display:none;">
	<form action="<?php echo base_url()?>/backend/member/search_result" method="post">
	<label for="nama">Nama Member</label>
	<input id="nama_produk" type="text" name="nama" style="width:50%" class="text" value="<?php echo set_value('nama'); ?>">
	<input type="submit" class="" value="Cari">
	</form>
	</div>
	<input type="button" onclick="bulk()" value="Hapus">
</div>
<table>
	<thead>
		<tr>
			<th style="width:0%"><input class="check_all" type="checkbox" ></th>
			<th style="width:0%">No</th>
			<th style="width:50%">Nama</th>
			<th style="width:25%">Email</th>
			<th style="width:25%">Status</th>
		</tr>
	</thead>
	<?php
		$no = 1+$urut;
		foreach($res as $row):
	?>
	<tr class="<?php if ($no %2 == 0) echo 'even';?>">
		<td><input type="checkbox" name="member_id[]" value="<?php echo $row['member_id']?>"></td>
		<td><?php echo $no;?></td>
		<td onMouseOver="show_this('action-<?php echo $row['member_id']?>')"
		onMouseOut="hide_this('action-<?php echo $row['member_id']?>')">
		<b><?php echo anchor('backend/member/edit/'.$row["member_id"].'/'.$no,$row["nama"]);?></b>
		<div id="action-<?php echo $row['member_id']?>" class="action invisible">
			<?php echo anchor('backend/member/edit/'.$row["member_id"].'/'.$no,'Edit')?> |
			<?php echo anchor('backend/member/delete/'.$row["member_id"].'/'.$no,'Delete',array('onclick' => "return confirm('Anda yakin menghapus permanen member ini?')"))?>
		</div>
		</td>
		<td><?php echo $row['email']?></td>
		<?php if ($row['status']!=1):?>
		<td><strong><?php echo anchor('backend/member/edit_aktif/'.$row["member_id"].'/'.$no,'Blok')?></strong></div></td>
		<?php else:?>
		<td><?php echo anchor('backend/member/edit_block/'.$row["member_id"].'/'.$no,'Aktif')?></td>
		<?php endif;?>
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
