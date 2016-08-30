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
<h1>Review <?php echo $row->nama_produk;?></h1>
<?php echo $this->session->flashdata('message_type');?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="yui-u first">
        <fieldset>
		<legend>Detail Review</legend>
		<ul>
			<li class="list">
				<strong>Nama : </strong><?php echo $row->nama;?>
			</li>
			<li class="list">
				<strong>Date : </strong><?php echo formatDate($row->date,'short1');?>
			</li>
			<li class="list">
				<strong>Isi Review : </strong><br /><?php echo $row->isi_review;?>
			</li>
			<li class="list">
				<strong>Rating</strong>
				<br /><?php echo ratingDropdown($row->rating);?>
			</li>
			<li class="list">
				<strong>Status</strong>
				<br /><?php echo ratingStatDropdown($row->status);?>
			</li>
				<input type="submit" value="Simpan" > atau
				<?php echo anchor('backend/review','Batalkan')?>
			</li>

		</ul>
	</fieldset>
</div>
</form>
</div>