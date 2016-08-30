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
	var ids = $("input[name='konten_id[]']").serialize();
	if(confirm("Anda ingin menghapus?"))
	{
		if (ids)
		{
			$.ajax({
				type: "POST",
				url: "<?php echo site_url().'backend/kon_berita/ajax_bulk_action/' ?>",
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
<h1>Konten Berita</h1>
<div class="table_filter_wrapper">
	<a href="<?php echo site_url('backend/kon_berita/add')?>"><input type="submit" class="" name="add" value="Tambah"></a>
	<input class="" type="button" onclick="bulk()" value="Hapus">
</div>
<?php echo $this->session->flashdata('message_type');?>
<table>
	<thead>
		<tr>
			<th style="width:5%"><input class="check_all" type="checkbox" ></th>
			<th style="width:5%">No</th>
			<th style="width:40%">Judul</th>
			<th style="width:20%">Publikasi</th>
			<th style="width:30%">Date</th>
		</tr>
	</thead>
	<?php
		$no = 1 + $urut;
		foreach($res as $row):
	?>
	<tr class="<?php if ($no %2 == 0) echo 'even';?>">
		<td><input type="checkbox" name="konten_id[]" value="<?php echo $row['konten_id']?>"></td>
		<td><?php echo $no;?></td>
		<td onMouseOver="show_this('action-<?php echo $row['konten_id']?>')"
		onMouseOut="hide_this('action-<?php echo $row['konten_id']?>')">
			<b><?php echo anchor('backend/kon_berita/edit/'.$row["konten_id"],$row['judul']);?></b>
		<div id="action-<?php echo $row['konten_id']?>" class="action invisible">
			<?php echo anchor('backend/kon_berita/edit/'.$row["konten_id"],'Edit')?> |
			<?php echo anchor('backend/kon_berita/delete/'.$row["konten_id"].'/'.$no,'Hapus',array('onclick' => "return confirm('Anda yakin menghapus data konten ini?')"))?> 
		</div>
		</td>
		<?php if ($row['published']=='Ya'):?>
		<td><b><?php echo anchor('backend/kon_berita/publish/n/'.$row["konten_id"].'/'.$no,$row['published']);?><b></td>
		<?php else:?>
		<td><b><?php echo anchor('backend/kon_berita/publish/y/'.$row["konten_id"].'/'.$no,$row['published']);?><b></td>
		<?php endif;?>
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


