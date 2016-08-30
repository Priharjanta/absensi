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
	<h1 style="background-image: url('<?php echo base_url()?>assets/images/order.png');">Laporan Penjualan Per Bulan</h1>
</div>
<div class="wrapper">
<h1>Laporan Penjualan Per Bulan</h1>
<div class="table_filter_wrapper">
	<form  method="post" id="contoh" action="<?php echo base_url().'backend/rep_month/tampil'?>">
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
<?php if ($order!=''):?>
<p><strong>Laporan Rugi Laba Bulanan <br>Per <?php echo indDate($date)?></strong></p>
<table style="width:50%" border="0" cellpadding="0">
  <tr>
    <td style="width:40%" >Penjualan Bulanan</td>
    <td style="width:10%">&nbsp;</td>
    <td style="width:25%">&nbsp;</td>
    <td style="width:25%;text-align:right;"><?php echo formatHarga($order->penjualan_harian,'lengkap');?></td>
  </tr>
  <tr>
    <td>Potongan (Diskon)</td>
    <td>&nbsp;</td>
    <td style="text-align:right;"><?php echo formatHarga($order->potongan,'lengkap');?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
    <td style="text-align:right;"><?php echo formatHarga($order->potongan,'lengkap');?></td>
  </tr>
  <tr>
    <td colspan="3">Penjualan Bersih</td>
    <td style="text-align:right;"><span style="width:25%;text-align:right;"><?php echo formatHarga($order->penjualan_bersih,'lengkap');?></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Biaya Pokok Produk</td>
    <td></td>
     <td style="text-align:right;"><?php echo formatHarga($order->pokok_produk,'lengkap');?></td>
     <td style="text-align:right;">&nbsp;</td>
  </tr>
  <tr>
    <td>Biaya Penjualan</td>
    <td></td>
     <td style="text-align:right;"><?php echo formatHarga($biaya,'lengkap');?></td>
     <td style="text-align:right;">&nbsp;</td>
  </tr>
   <tr>
    <td>Biaya Gaji Karyawan</td>
    <td></td>
     <td style="text-align:right;"><?php echo formatHarga($gaji,'lengkap');?></td>
     <td style="text-align:right;">&nbsp;</td>
  </tr>
   <tr>
    <td>Total Biaya</td>
    <td></td>
     <td style="text-align:right;">&nbsp;</td>
     <td style="text-align:right;"><?php echo formatHarga($tot_biaya,'lengkap');?></td>
  </tr>
  <tr>
    <td colspan="3">Laba Bersih</td>
    <td style="text-align:right;"><span style="width:25%;text-align:right;"><?php echo formatHarga($laba_bersih,'lengkap');?></span></td>
  </tr>
</table>
</table>

<p>
  <?php else:?>
</p>
<p>&nbsp;</p>
<?php endif;?>
</div>
