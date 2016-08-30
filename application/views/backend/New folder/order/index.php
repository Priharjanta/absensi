<script type="text/javascript">

function show_this(hidden_div)
{
	$("#"+hidden_div).css({'visibility':'visible'});
}
function hide_this(hidden_div)
{
	$("#"+hidden_div).css({'visibility':'hidden'});
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
	<form action="<?php echo base_url()?>backend/order/search_result" method="post">
	<label for="order_code">Order Code</label>
	<input id="order_code" type="text" name="order_code" style="width:50%" class="text" value="<?php echo set_value('order_code'); ?>">
	<label for="nama">Nama</label>
	<input id="nama" type="text" name="nama" style="width:50%" class="text" value="<?php echo set_value('nama'); ?>">
	<br />
	<input type="submit" class="" value="Cari">
	</form>
	</div>
	<?php
		if (!isset($current)):
			echo anchor('backend/order',"All <span class='count'>($total_orders)</span>",array('class'=>'current')).' | ';
		else:
			echo anchor('backend/order',"All <span class='count'>($total_orders)</span>").' | ';
		endif;
	?>

	<?php
		if (isset($current) AND $current == 'neworder'):
			echo anchor('backend/order/status/neworder',"New <span class='count'>($total_new)</span>",array('class'=>'current')).' | ';
		else:
			echo anchor('backend/order/status/neworder',"New <span class='count'>($total_new)</span>").' | ';
		endif;
	?>

	<?php
		if (isset($current) AND $current == 'confirmed'):
			echo anchor('backend/order/status/confirmed',"Confirmed <span class='count'>($total_confirmed)</span>",array('class'=>'current')).' | ';
		else:
			echo anchor('backend/order/status/confirmed',"Confirmed <span class='count'>($total_confirmed)</span>").' | ';
		endif;
	?>
	
	<?php
		if (isset($current) AND $current == 'pending'):
			echo anchor('backend/order/status/pending',"Pending <span class='count'>($total_pending)</span>",array('class'=>'current')).' | ';
		else:
			echo anchor('backend/order/status/pending',"Pending <span class='count'>($total_pending)</span>").' | ';
		endif;
	?>
	
	<?php
		if (isset($current) AND $current == 'shipped'):
			echo anchor('backend/order/status/shipped',"Shipped <span class='count'>($total_shipped)</span>",array('class'=>'current')).' | ';
		else:
			echo anchor('backend/order/status/shipped',"Shipped <span class='count'>($total_shipped)</span>").' | ';
		endif;
	?>
	
	<?php
		if (isset($current) AND $current == 'closed'):
			echo anchor('backend/order/status/closed',"Closed <span class='count'>($total_closed)</span>",array('class'=>'current')).' | ';
		else:
			echo anchor('backend/order/status/closed',"Closed <span class='count'>($total_closed)</span>").' ';
		endif;
	?>
	

</div>
<table>
	<thead>
		<tr>
			
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
		
		<td><?php echo $no;?></td>
		
		<td onMouseOver="show_this('action-<?php echo $urai["order_id"]?>')"
		onMouseOut="hide_this('action-<?php echo $urai["order_id"]?>')">
		<b><?php echo anchor('backend/order/detail/'.$urai["order_id"].'/'.makeslug($urai["nama"]),$urai["nama"]);?></b>
		<div id="action-<?php echo $urai["order_id"]?>" class="action invisible">
			<?php echo anchor('backend/order/detail/'.$urai["order_id"].'/'.makeslug($urai["nama"]),'Detail')?> |
			<?php echo anchor('backend/order/delete/'.$urai["order_id"].'/'.$no,'Hapus Permanen',array('onclick' => "return confirm('Anda yakin menghapus permanen data order ini?')"))?>
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
