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
	<h1 style="background-image: url('<?php echo base_url()?>assets/images/order.png');">Order</h1>
</div>
<div class="yui-gc wrapper">
    <h1>Order <?php echo $row->nama.' - '.$row->order_code?></h1>
    <div class="yui-u first">
        <fieldset>
		<legend>Detail Order</legend>
		<ul>
			<label>
			<li class="list">
				<strong>Nama : </strong><?php echo $row->nama;?>
			</li>
			<li class="list">
				<strong>Email : </strong><?php echo $row->email;?>
			</li>
			<li class="list">
				<strong>Telepon : </strong><?php echo $row->telp;?>
			</li>
			<li class="list">
				<strong>HP : </strong><?php echo $row->hp;?>
			</li>
			<li class="list">
				<strong>Alamat Kirim : </strong><?php echo $row->alamat_kirim.','.$row->kab_name.','.$row->province_name;?><br />
				<strong>Kode Pos : </strong><?php echo $row->kodepos_kirim;?>
			</li>
			<li class="list">
				<strong>Logistik : </strong><?php echo $row->log_nama;?>
			</li>
			<li class="list">
				<strong>Waktu Order : </strong><?php echo formatDate($row->order_date,'short1');?>
			</li>
			</label>

		</ul>
    </fieldset>
    </div>
	<div class="yui-u">
	<fieldset>
		<legend>Status dan Pembayaran</legend>
		
		<form action="<?php echo site_url()?>backend/order/detail/<?php echo $row->order_id;?>" method="post" enctype="multipart/form-data">
		<?php echo $pesan;?>
          <ul>
            <li>
				<label>Status</label>
				<?php echo form_error('status', '<div class="error">', '</div>'); ?>
				<?php echo dropDownOrderStatus($row->order_status)?>
			</li>
			<li>
				<label>Rekening Bank</label>
				<?php echo form_error('bank_id', '<div class="error">', '</div>'); ?>
				<?php echo dropDownBank($row->order_bank_id)?>
			</li>
			<li>
				<input type="hidden" name="product_id" value="<?php echo $row->order_id?>">
				<input type="submit" value="Simpan"> atau
				<a href="<?php echo site_url('backend/order')?>">Batal</a>
			</li>
         </ul> 
		</form>
	</fieldset>
	</div>
	<div class="yui-u first">
	<fieldset>
		<legend>Item Order</legend>
		<?php echo $this->session->flashdata('message_type');?>
		<br />
                <ul>
                <table>
                        <thead>
                                <tr>
										<th>No</th>
                                        <th>Produk</th>
                                        <th>Qty</th>
                                        <th>Harga</th>
                                        <th>Sub Total</th>
										<th>Aksi</th>
                                </tr>
                        </thead>
						<?php $i = 1; ?> 
						<?php foreach($res_det as $row_det):?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $row_det['nama_produk']; ?></td>
								<td><?php echo $row_det['det_jml']; ?></td>
								<td><?php echo formatHarga($row_det['harga'], 'lengkap');?></td>
								<td><?php echo formatHarga($row_det['det_subtotal'], 'lengkap');?></td>
								<td><a href="#update<?php echo $i?>" rel="facebox">Edit<a/></td>
							</tr>

						<?php $i++; ?> 
						<?php endforeach; ?>             
						<tr>
							<td colspan="4"><span>Biaya Logistik - <?php echo $row->log_nama;?>: </span></td>
							<td><?php echo formatHarga($row_log->log_biaya,'lengkap')?></td>
							<td colspan="1"></td>
						</tr>
						<tr>
							<td colspan="4"><span>GRAND TOTAL: </span></td>
							<td><?php echo formatHarga($row->total,'lengkap')?></td>
							<td colspan="1"></td>
						</tr>
                </table>
                </ul>
	</fieldset>
	</div>
	<!-- edit produk via jquery facebox -->
	<?php $i = 1; ?> 
	<?php foreach($res_det as $row_det):?>
			<div id="update<?php echo $i?>" style="display:none;">
			<strong>Produk yang akan di edit adalah : <?php echo $row_det['nama_produk'];?></strong><br />
			<form method="post" action="<?php echo site_url()?>backend/order/edit_detail/<?php echo $row_det['order_detail_id'];?>/<?php echo $row_det['order_id'];?>/<?php echo $row_det['produk_id'];?>">
			Jumlah :
			
			<input class="title" type="text" name="jml" style="width:50px" value="<?php echo $row_det['det_jml'];?>">
			<br />
			<input type="submit" value="Simpan">
			</form>
			</div>
	<?php $i++; ?> 
	<?php endforeach; ?>  
	<!-- end of edit produk via jquery facebox -->

</div>