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
	var ids = $("input[name='bank_id[]']").serialize();
	if(confirm("Anda ingin menghapus?"))
	{
		if (ids)
		{
			$.ajax({
				type: "POST",
				url: "<?php echo site_url().'backend/bank/ajax_bulk_action/' ?>",
				cache: false,
				data: ids,
				success: window.location.reload(),
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
	<h1 style="background-image: url('<?php echo base_url()?>assets/images/order.png');">Rekap Penerimaan Kas Masuk Bulanan</h1>
</div>
<div class="wrapper">
<h1>Rekap Penerimaan Kas Masuk Bulanan</h1>
<div class="table_filter_wrapper">
	<form  method="post" id="contoh" action="<?php echo base_url().'backend/rekap_kas/tampil'?>">
				<p>
					<label>Bulan Tanggal : </label>
					<?php if($date != ''):?>
					<?php echo bulanDropdown('bln',$date,'2006',getTh('plus','1'))?>
					<?php else:?>
					<?php echo bulanDropdown('bln',date('Y-m-d'),'2006',getTh('plus','1'))?>
					<?php endif;?>
				</p> 
				
				<div class="tombol_bawah">
				<input name="submit" class="submit" value="Tampilkan" type="submit">
				
				</div>
		</form>
</div>
<?php echo $this->session->flashdata('message_type');?>
<?php if ($arr_rekap!=''):?>
<p><strong>Rekap Penerimaan Kas Masuk Bulanan <br>Per <?php echo indDate($date)?></strong></p>

<table>
	<thead>
		<tr>
			<th>No</th>
			<th>Tanggal</th>
			<th>Bank</th>
			<th>Pengirim</th>
			<th>No.Rekening</th>
			<th>No.Order</th>
            <th>Penjualan</th>
            <th>Biaya Kirim</th>
		</tr>
	</thead>
	<?php
		$no = 1;
		foreach($arr_rekap as $urai):
	?>
	<tr class="<?php if ($no %2 == 0) echo 'even';?>">
		
		<td><?php echo $no;?></td>
		<td><?php echo formatDate($urai["order_date"],'short')?></td>
		<td><?php echo $urai["nama_bank"]?></td>
		<td><?php echo $urai["nama"]?></td>
		<td><?php echo $urai["no_rek"]?></td>
        <td><?php echo $urai["order_code"]?></td>
		<td><?php echo formatHarga($urai["penjualan"],'short1')?></td>
        <td><?php echo formatHarga($urai["biaya_logistik"],'short1')?></td>

	</tr>
	<?php
	 	$no++;
		endforeach;
	?>
	<td></td>
	<td></td>
	<td></td>
	<td>TOTAL</td>
	<td></td>
    <td></td>
	<td><?php echo formatHarga($total->total_jual,'short1')?></td>
    <td><?php echo formatHarga($total->total_kirim,'short1')?></td>
</table>



<p>
  <?php else:?>
</p>
<p>&nbsp;</p>
<?php endif;?>
</div>
