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
	<h1 style="background-image: url('<?php echo base_url()?>assets/images/review.png');">Konten Manajemen</h1>
</div>
<div class="wrapper">
<h1>Konten Halaman</h1>
<div class="table_filter_wrapper">
</div>
<?php echo $this->session->flashdata('message_type');?>
<table>
	<thead>
		<tr>
			<th style="width:15%">No</th>
			<th style="width:50%">Judul</th>
			<th style="width:20%">Halaman</th>
			<th style="width:15%">Date</th>
		</tr>
	</thead>
	<?php
		$no = 1 + $urut;
		foreach($res as $row):
	?>
	<tr class="<?php if ($no %2 == 0) echo 'even';?>">
		<td><?php echo $no;?></td>
		<td onMouseOver="show_this('action-<?php echo $row['konten_id']?>')"
		onMouseOut="hide_this('action-<?php echo $row['konten_id']?>')">
			<b><?php echo anchor('backend/kon_halaman/edit/'.$row["konten_id"],$row['judul']);?></b>
		<div id="action-<?php echo $row['konten_id']?>" class="action invisible">
			<?php echo anchor('backend/kon_halaman/edit/'.$row["konten_id"],'Edit')?>
		</div>
		</td>
		<td><?php echo$row['page']?></td>
		<td><?php echo formatDate($row['date'],'admin_date')?></td>
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


