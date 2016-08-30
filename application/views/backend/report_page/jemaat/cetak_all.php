<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<style>
ul 
{
	padding:-10px;
	list-style-type: none;
}

li
{
	padding:5px -10px 0px -5px;
}

.atas
{
	font-weight:bold;
}

.judul
{
	text-align:center;
}

.bawah
{
	text-align:center;
}

.nominal
{
	text-align:center;
}
.head
{
border: solid 0.5px black;
background: #E7E7E7;
padding:5px 0 5px 0;
}
.isi
{
border: solid 0.5px black;
padding:3.5px;
}

.isi_col
{
border: solid 0.5px black;
padding:0px;
}


</style>

</head>

<body>
<div class="judul">
<strong><p>
	DATA JEMAAT GKI BUNGUR
	<br>
	TAHUN : 
	<br>
</p>
</strong>
</div>
<br>

	<table width="800" border="0.5" cellpadding="0" cellspacing="0">
      <tr>
        <td width="40">No</td>
        <td width="70">No Induk</td>
        <td width="200">Nama</td>
        <td width="70">Pria/Wanita</td>
		<td width="80">Tgl. Lahir</td>
		<td style="200">Alamat</td>
		<td width="100">Telp/HP</td>
       </tr>
		
	  <?php $i = 1;
	  foreach ($arr_jmt as $row):?>
      <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $row['m_jmt_no_induk']?></td>
        <td><?php echo $row['m_jmt_nama']?></td>
        <td><?php echo $row['m_jmt_jenkel']?></td>
		<td><?php echo $row['m_jmt_tgl_lhr']?></td>
		<td><?php echo wordwrap($row['m_jmt_alamat_1'],40,"<br>\n");?></td>
		<td><?php echo wordwrap($row['m_jmt_telp_1'].'/'.$row['m_jmt_hp_1'],15,"<br>\n")?></td>
      </tr>
	  <?php 
	  $i++;
	  endforeach;?>
    </table>
</body>
</html>




