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
	var ids = $("input[name='review_id[]']").serialize();
	if(confirm("Anda ingin menghapus?"))
	{
		if (ids)
		{
			$.ajax({
				type: "POST",
				url: "<?php echo site_url().'backend/review/ajax_bulk_action/' ?>",
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
	<h1 style="background-image: url('<?php echo base_url()?>assets/images/product.png');">Katalog</h1>
</div>
<div class="wrapper">
<h1>Review Produk</h1>
<div class="table_filter_wrapper">
	<input type="button" onclick="bulk()" value="Hapus">
</div>
<?php echo $this->session->flashdata('message_type');?>
<table>
	<thead>
		<tr>
			<th style="width:5%"><input class="check_all" type="checkbox" ></th>
			<th style="width:5%">No</th>
			<th style="width:20%">Nama</th>
			<th style="width:20%">Isi</th>
			<th style="width:20%">Produk</th>
			<th style="width:20%">Date</th>
			<th style="width:10%">Status</th>
		</tr>
	</thead>
	<?php
		$no = 1 + $urut;
		foreach($res as $row):
	?>
	<tr class="<?php if ($no %2 == 0) echo 'even';?>">
		<td><input type="checkbox" name="review_id[]" value="<?php echo $row['review_id']?>"></td>
		<td><?php echo $no;?></td>
		<td onMouseOver="show_this('action-<?php echo $row['review_id']?>')"
		onMouseOut="hide_this('action-<?php echo $row['review_id']?>')">
		<b><?php echo anchor('backend/review/detail/'.$row["review_id"].'/'.$row["nama"],$row["nama"]);?></b>
		<div id="action-<?php echo $row['review_id']?>" class="action invisible">
			<?php echo anchor('backend/review/detail/'.$row["review_id"],'Detail')?> |
			<?php echo anchor('backend/review/delete/'.$row["review_id"].'/'.$no,'Hapus',array('onclick' => "return confirm('Anda yakin menghapus data ini?')"))?>
		</div>
		</td>
		<td><?php echo word_limiter($row['isi_review'],10);?></td>
		<td><?php echo $row['nama_produk']?></td>
		<td><?php echo formatDate($row['date'],'short1');?></td>
		<?php if ($row['status'] == 'unapprove'):?>
		<td><strong><?php echo anchor('backend/review/approve/'.$row["review_id"].'/'.$no,$row['status'])?></strong></td>
		<?php else:?>
		<td><?php echo anchor('backend/review/unapprove/'.$row["review_id"].'/'.$no,$row['status'])?></td>
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
