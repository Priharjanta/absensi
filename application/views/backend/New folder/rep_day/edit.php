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
<div class="yui-gc wrapper">
<h1>Rekening Bank <?php echo $row->nama_rek;?></h1>
<?php echo $this->session->flashdata('message_type');?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="yui-u first">
        <fieldset>
		<legend>Edit Rekening Bank</legend>
		<ul>
			<li>
				<label for="nama_rek">Rekening Atas Nama</label>
				<?php echo form_error('nama_rek', '<div class="error">', '</div>'); ?>
				<input type="text" name="nama_rek" class="title" value="<?php echo $row->nama_rek;?>">
			</li>
			<li>
				<label for="nama_bank">Nama Bank</label>
				<?php echo form_error('nama_bank', '<div class="error">', '</div>'); ?>
				<input type="text" name="nama_bank" class="title" value="<?php echo $row->nama_bank;?>">
			</li>
			<li>
				<label for="no_rek">No Rekening</label>
				<?php echo form_error('no_rek', '<div class="error">', '</div>'); ?>
				<input type="text" name="no_rek" class="title" value="<?php echo $row->no_rek;?>">
			</li>
			<li>
				<label for="alamat_bank">Alamat Bank</label>
				<textarea id="alamat_bank" name="alamat_bank" class="text h80"><?php echo $row->alamat_bank;?></textarea>
			</li>
			</li>
				<input type="submit" value="Simpan" > atau
				<?php echo anchor('backend/bank','Batalkan')?>
			</li>

		</ul>
	</fieldset>
</div>
</form>
</div>