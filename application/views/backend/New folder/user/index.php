<script type="text/javascript">
function show_this(hidden_div)
{
	$("#"+hidden_div).css({'visibility':'visible'});
}
function hide_this(hidden_div)
{
	$("#"+hidden_div).css({'visibility':'hidden'});
}
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
        width: 200px;
        height: 20px;
      }
</style>
<div class="left"></div>
<div class="right"></div>
<div class="heading">
	<h1 style="background-image: url('<?php echo base_url()?>assets/images/order.png');">Setting</h1>
</div>
<div class="wrapper">
<h1>User Manager</h1>
<div class="table_filter_wrapper">
	<a href="<?php echo site_url('backend/user/add')?>"><input type="submit" name="add" value="Tambah"></a>
</div>
<?php echo $this->session->flashdata('message_type');?>
<table style="width:50%">
	<thead>
		<tr>
			<th style="width:0%">No</th>
			<th style="width:50%">User Name</th>
			<th style="width:25%">User Display Name</th>
			<th style="width:25%">Rule</th>
		</tr>
	</thead>
	<?php
		$no = 1;
		foreach($res as $row):
	?>
	<tr class="<?php if ($no %2 == 0) echo 'even';?>">
		<td><?php echo $no;?></td>
		<td onMouseOver="show_this('action-<?php echo $row['user_id']?>')"
		onMouseOut="hide_this('action-<?php echo $row['user_id']?>')">
		<b><?php echo anchor('backend/user/edit/'.$row["user_id"].'/'.$row["user_login"],$row["user_login"]);?></b>
		<div id="action-<?php echo $row['user_id']?>" class="action invisible">
			<?php echo anchor('backend/user/edit/'.$row["user_id"],'Edit')?> |
			<?php echo anchor('backend/user/delete/'.$row["user_id"],'Hapus',array('onclick' => "return confirm('Anda yakin menghapus data user ini?')"))?>
		</div>
		</td>
		<td><?php echo $row['user_display_name']?></td>
		<td><?php echo $row['user_rule']?></td>
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
