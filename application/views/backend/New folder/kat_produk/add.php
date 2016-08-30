<div class="left"></div>
<div class="right"></div>
<div class="heading">
	<h1 style="background-image: url('<?php echo base_url()?>assets/images/product.png');">Katalog</h1>
</div>
<div class="yui-gc wrapper">
<h1>Kategori Produk</h1>
<form action="" method="post" enctype="multipart/form-data">
    <div class="yui-u first">
        <fieldset>
		<legend>Kategori Produk Baru</legend>
		<ul>
			<li>
				<label for="name">Nama</label>
				<?php echo form_error('nama_kategori', '<div class="error">', '</div>'); ?>
				<input type="text" name="nama_kategori" class="title" value="<?php echo set_value('nama_kategori'); ?>">
			</li>
			<li>
				<label for="deskripsi">Deskripsi</label>
				<?php echo form_error('deskripsi', '<div class="error">', '</div>'); ?>
				<textarea id="deskripsi" name="deskripsi" class="text h80"><?php echo set_value('deskripsi'); ?></textarea>
			</li>
			<li>
				<input type="submit" value="Simpan" class=""> atau <?php echo anchor('backend/kat_produk','Batal')?>
			</li>
		</ul>
    </fieldset>
    </div>

</form>
</div>