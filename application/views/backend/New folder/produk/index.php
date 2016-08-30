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
	var ids = $("input[name='produk_id[]']").serialize();
	if(confirm("Anda ingin menghapus?"))
	{
		if (ids)
		{
			$.ajax({
				type: "POST",
				url: "<?php echo site_url().'backend/produk/ajax_bulk_action/' ?>",
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
<h1>Produk</h1>
<div class="table_filter_wrapper">
	<a href="#cari" rel="facebox"><img style="width:25px;heigth:25px;margin-bottom:-5px;"src="<?php echo base_url()?>/assets/images/search.gif"><a/>
	<div id="cari" style="display:none;">
	<form action="<?php echo base_url()?>backend/produk/search_result" method="post">
	<label for="nama_produk">Nama Produk</label>
	<input id="nama_produk" type="text" name="nama_produk" style="width:50%" class="text" value="<?php echo set_value('nama_produk'); ?>">
	<label for="nama_produk">Kategori</label>
	<?php echo produkKatDropdown()?>
	<input type="submit" class="" value="Cari">
	</form>
	</div>
	<a href="<?php echo site_url('backend/produk/add')?>"><input type="submit" name="add" value="Tambah"></a>
	<input type="button" onclick="bulk()" value="Hapus">
	
</div>
<table>
	<thead>
		<tr>
			<th style="width:0%"><input class="check_all" type="checkbox" ></th>
			<th style="width:0%">No</th>
			<th style="width:10%">Image</th>
			<th style="width:10%">Kode Produk</th>
			<th style="width:20%">Nama Produk</th>
			<th style="width:25%">Deskripsi</th>
			<th style="width:10%">Stok</th>
			<th style="width:10%">Diskon(%)</th>
			<th style="width:25%">Harga</th>
		</tr>
	</thead>
	<?php
		$no = 1 + $urut;
		foreach($res as $row):
	?>
	<tr class="<?php if ($no %2 == 0) echo 'even';?>">
		<td><input type="checkbox" name="produk_id[]" value="<?php echo $row['produk_id']?>"></td>
		<td><?php echo $no;?></td>
		<td><img src="<?php echo base_url().'public/photo/'.$row['image_thumb'];?>" width=90%></td>
		<td><?php echo $row['kode_produk'];?></td>
		<td onMouseOver="show_this('action-<?php echo $row['produk_id']?>')"
		onMouseOut="hide_this('action-<?php echo $row['produk_id']?>')">
		<b><?php echo anchor('backend/produk/edit/'.$row["produk_id"].'/'.makeslug($row["nama_produk"]),$row["nama_produk"]);?></b>
		<div id="action-<?php echo $row['produk_id']?>" class="action invisible">
			<?php echo anchor('backend/produk/edit/'.$row["produk_id"].'/'.makeslug($row["nama_produk"]),'Edit')?> |
			<?php echo anchor('backend/produk/delete/'.$row["produk_id"].'/'.$no,'Hapus', array('onclick' => "return confirm('Anda yakin menghapus produk ini?')"))?> |
			<?php echo anchor('produk/view/'.$row["prod_kat_id"].'/'.$row["produk_id"].'/kat-'.makeslug($row['nama_produk']),'Lihat')?>
		</div>
		</td>
		<td><?php echo word_limiter($row["deskripsi"],15)?></td>
		<td><?php echo $row["jml_stok"]?></td>
		<?php if($row['diskon'] != 0):?>
			<td><?php echo $row["diskon"]?></td>
			<td><?php echo formatHarga($row["harga_baru"],'lengkap')?></td>
		<?php else:?>
			<td><?php echo $row["diskon"]?></td>
			<td><?php echo formatHarga($row["harga"],'lengkap')?></td>
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
