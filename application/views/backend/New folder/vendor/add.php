<div class="left"></div>
<div class="right"></div>
<div class="heading">
	<h1 style="background-image: url('<?php echo base_url()?>assets/images/product.png');">Catalog</h1>
</div>
<div class="yui-gc wrapper">
<h1>Tambah Vendor / Manufacture</h1>
<form action="" method="post" enctype="multipart/form-data">
    <div class="yui-u first">
        <fieldset>
		<legend>Vendor / Manufacture</legend>
		<ul>
			<li>
				<label for="nama_vendor">Nama</label>
				<?php echo form_error('nama_vendor', '<div class="error">', '</div>'); ?>
				<input type="text" name="nama_vendor" class="title" value="<?php echo set_value('nama_vendor'); ?>">
			</li>
			<li>
				<label for="website">Website</label>
				<input type="text" name="website" class="title" value="<?php echo set_value('website'); ?>">
			</li>
			<li>
				<label for="telepon">Telp</label>
				<input type="text" name="telepon" class="title" value="<?php echo set_value('telepon'); ?>">
			</li>
			<li>
				<label for="service_center">Service Center</label>
				<textarea id="service_center" name="service_center" class="text h80"><?php echo set_value('service_center'); ?></textarea>
			</li>
			<li>
				<input type="hidden" name="vendor_id" value="<?php echo set_value('vendor_id'); ?>">
				<input type="submit" value="Simpan" class=""> or <?php echo anchor('backend/vendor','Batal')?>
			</li>
		</ul>
    </fieldset>
    </div>

</form>
</div>