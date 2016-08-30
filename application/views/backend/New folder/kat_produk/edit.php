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
<div class="yui-gc wrapper">
    <h1>Kategori Produk <?php echo $row->nama_kategori;?></h1>
	<?php echo $this->session->flashdata('message_type');?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="yui-u first">
        <fieldset>
		<legend>Edit Kategori Produk</legend>
		<ul>
			<li>
				<label for="name">Nama</label>
				<?php echo form_error('nama_kategori', '<div class="error">', '</div>'); ?>
				<input type="text" name="nama_kategori" class="title" value="<?php echo $row->nama_kategori;?>">
			</li>
			<li>
				<label for="description">Deskripsi</label>
				<?php echo form_error('deskripsi', '<div class="error">', '</div>'); ?>
				<textarea id="description" name="deskripsi" class="text h80"><?php echo $row->deskripsi;?></textarea>
			<li>
				<input type="submit" value="Simpan" class=""> atau <?php echo anchor('backend/kat_produk','Batal')?>
			</li>
			</ul>
		</fieldset>

</div>
</form>
</div>