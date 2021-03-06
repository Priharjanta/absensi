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
	var ids = $("input[name='kategori_id[]']").serialize();
	if(confirm("Anda ingin menghapus?"))
	{
		if (ids)
		{
			$.ajax({
				type: "POST",
				url: "<?php echo site_url().'backend/kat_produk/ajax_bulk_action/' ?>",
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
<h1>Kategori Produk</h1>
<div class="table_filter_wrapper">
	<a href="<?php echo site_url('backend/kat_produk/add')?>"><input type="submit" name="add" value="Tambah"></a>
	<input type="button" onclick="bulk()" value="Hapus">
</div>
<?php echo $this->session->flashdata('message_type');?>
<table>
	<thead>
		<tr>
			<th style="width:0%" ><input class="check_all" type="checkbox" ></th>
			<th style="width:0%" >No</th>
			<th style="width:30%">Nama Kategori</th>
			<th style="width:70%">Deskripsi</th>
		</tr>
	</thead>
	<?php
		$no = 1 + $urut;
		foreach($res as $row):
	?>
	<tr class="<?php if ($no %2 == 0) echo 'even';?>">
		<td><input type="checkbox" name="kategori_id[]" value="<?php echo $row['kategori_id']?>"></td>
		<td><?php echo $no;?></td>
		<td onMouseOver="show_this('action-<?php echo $row['kategori_id']?>')"
		onMouseOut="hide_this('action-<?php echo $row['kategori_id']?>')">
		<b><?php echo anchor('backend/kat_produk/edit/'.$row["kategori_id"].'/'.$row["nama_kategori"],$row["nama_kategori"]);?></b>
		<div id="action-<?php echo $row['kategori_id']?>" class="action invisible">
			<?php echo anchor('backend/kat_produk/edit/'.$row["kategori_id"],'Edit')?> |
			<?php echo anchor('backend/kat_produk/delete/'.$row["kategori_id"],'Delete',array('onclick' => "return confirm('Anda yakin menghapus kategori ini?')"))?>
		</div>
		</td>
		<td><?php echo word_limiter($row["deskripsi"],20)?></td>
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
