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
	var ids = $("input[name='vendor_id[]']").serialize();
	if (ids)
	{
		$.ajax({
			type: "POST",
			url: "<?php echo site_url().'backend/vendor/ajax_bulk_action/' ?>",
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
<div class="left"></div>
<div class="right"></div>
<div class="heading">
	<h1 style="background-image: url('<?php echo base_url()?>assets/images/order.png');">Order</h1>
</div>
<div class="wrapper">
<?php if ($this->session->flashdata('email_message')):
 echo $this->session->flashdata('email_message');
 endif; ?>
<h1><?php echo $title; ?></h1>
<div class="table_filter_wrapper">
	<a href="#cari" rel="facebox"><img style="width:25px;heigth:25px;margin-bottom:-5px;"src="<?php echo base_url()?>/assets/images/search.gif"><a/>
	<div id="cari" style="display:none;">
	<form action="" method="post">
	<label for="order_code">Order Code</label>
	<input id="order_code" type="text" name="order_code" style="width:50%" class="text" value="<?php echo set_value('order_code'); ?>">
	<label for="nama">Nama</label>
	<input id="nama" type="text" name="nama" style="width:50%" class="text" value="<?php echo set_value('nama'); ?>">
	<br />
	<input type="submit" class="" value="Cari">
	</form>
	</div>
	<input type="button" onclick="bulk()" value="Hapus">

</div>
<table>
	<thead>
		<tr>
			<th style="width:0%"><input class="check_all" type="checkbox" ></th>
			<th>No</th>
			<th>Nama</th>
			<th>Email</th>
			<th>Status</th>
			<th>Kode</th>
			<th>Total</th>
            <th>Created</th>
		</tr>
	</thead>
	<?php
		$no = 1 + $urut;
		foreach($res as $urai):
	?>
	<tr class="<?php if ($no %2 == 0) echo 'even';?>">
		<td><input type="checkbox" name="order_id[]" value="<?php echo $urai['order_id']?>"></td>
		<td><?php echo $no;?></td>
		
		<td onMouseOver="show_this('action-<?php echo $urai["order_id"]?>')"
		onMouseOut="hide_this('action-<?php echo $urai["order_id"]?>')">
		<b><?php echo anchor('backend/order/detail/'.$urai["order_id"].'/'.makeslug($urai["nama"]),$urai["nama"]);?></b>
		<div id="action-<?php echo $urai["order_id"]?>" class="action invisible">
			<?php echo anchor('backend/order/detail/'.$urai["order_id"].'/'.makeslug($urai["nama"]),'Detail')?> |
			<?php echo anchor('backend/order/delete/'.$urai["order_id"],'Hapus')?>
		</div>
		</td>
		<td><?php echo $urai["email"]?></td>
		<td><?php echo $urai["order_status"]?></td>
        <td><?php echo $urai["order_code"]?></td>
		<td><?php echo formatHarga($urai["total"],'lengkap')?></td>
        <td><?php echo formatDate($urai["order_date"],'short1')?></td>

	</tr>
	<?php
	 	$no++;
		endforeach;
	?>
</table>
<?php echo $this->pagination->create_links();?>
</div>
