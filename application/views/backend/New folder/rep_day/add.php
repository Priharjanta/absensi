<div class="left"></div>
<div class="right"></div>
<div class="heading">
	<h1 style="background-image: url('<?php echo base_url()?>assets/images/order.png');">Setting</h1>
</div>
<div class="yui-gc wrapper">
<h1>Rekening Bank</h1>
<form action="" method="post" enctype="multipart/form-data">
    <div class="yui-u first">
        <fieldset>
		<legend>Rekening Bank Baru</legend>
		<ul>
			<li>
				<label for="nama_rek">Rekening Atas Nama</label>
				<?php echo form_error('nama_rek', '<div class="error">', '</div>'); ?>
				<input type="text" name="nama_rek" class="title" value="<?php echo set_value('nama_rek'); ?>">
			</li>
			<li>
				<label for="bank">Nama Bank</label>
				<?php echo form_error('nama_bank', '<div class="error">', '</div>'); ?>
				<input type="text" name="nama_bank" class="title" value="<?php echo set_value('nama_bank'); ?>">
			</li>
			<li>
				<label for="no_rek">No Rekening</label>
				<?php echo form_error('no_rek', '<div class="error">', '</div>'); ?>
				<input type="text" name="no_rek" class="title" value="<?php echo set_value('no_rek'); ?>">
			</li>
			<li>
				<label for="alamat_bank">Alamat Bank</label>
				<textarea id="alamat_bank" name="alamat_bank" class="text h80"><?php echo set_value('alamat_bank'); ?></textarea>
			</li>
			<li>
				<input type="hidden" name="bank_id" value="<?php echo set_value('bank_id'); ?>">
				<input type="submit" value="Simpan"> atau <?php echo anchor('backend/bank','Batalkan')?>
			</li>
		</ul>
    </fieldset>
    </div>

</form>
</div>