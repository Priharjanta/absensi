<script language="javascript">
var xmlHttp

function showKab(str)
{
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null)
	  {
	  alert ("Your browser does not support AJAX!");
	  return;
	  }
	var url="<?php echo site_url().'account/ajax_showKab'?>";
	
	url=url+"/"+str;
	//url=url+"&sid="+Math.random();
	

	xmlHttp.onreadystatechange=stateChanged;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}

function stateChanged()
{
if (xmlHttp.readyState==4)
{
document.getElementById("txtHint").innerHTML=xmlHttp.responseText;
//alert(document.getElementById("txtHint").innerHTML);
}
}

function GetXmlHttpObject()
{
var xmlHttp=null;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
return xmlHttp;
}
</script> 

<div class="left"></div>
<div class="right"></div>
<div class="heading">
	<h1 style="background-image: url('<?php echo base_url()?>assets/images/product.png');">Katalog</h1>
</div>
<div class="yui-gc wrapper">
    <h1>Member <?php echo $row->nama;?></h1>
	<form action="" method="post">
		<div class="yui-u first">
			<fieldset>
				<legend>Edit Member</legend>
				<ul>
					<li>
						<label for="nama">Nama</label>
						<?php echo form_error('nama', '<div class="error">', '</div>'); ?>
						<input type="text" name="nama" style="width:350px" class="text span-12" value="<?php echo $row->nama?>">
					</li>
					<li>
						<label for="nama">Jenis Kelamin</label>
						<?php echo form_error('jenkel', '<div class="error">', '</div>'); ?>
						<?php echo jenkelDropdown($row->jenkel);?>
					</li>
					<li>
						<label for="nama">Email</label>
						<?php echo form_error('email', '<div class="error">', '</div>'); ?>
						<input type="text" name="email" style="width:350px" class="text span-12" value="<?php echo $row->email;?>">
					</li>
					<li>
						<label for="nama">Telepon</label>
						<?php echo form_error('telp', '<div class="error">', '</div>'); ?>
						<input type="text" name="telp" style="width:350px" class="text span-12" value="<?php echo $row->telp;?>">
					</li>
					<li>
						<label for="nama">Mobile Phone / HP</label>
						<?php echo form_error('hp', '<div class="error">', '</div>'); ?>
						<input type="text" name="hp" style="width:350px" class="text span-12" value="<?php echo $row->hp;?>">
					</li>
					<li>
						<label for="nama">Alamat</label>
						<?php echo form_error('alamat', '<div class="error">', '</div>'); ?>
						<input type="text" name="alamat" class="text span-12" value="<?php echo $row->alamat;?>">
					</li>
					<li>
						<label for="nama">Propinsi</label>
						<?php echo form_error('province_id', '<div class="error">', '</div>'); ?>
						<?php echo provDropdown($row->mem_prov_id)?>
					</li>
					<li>
						<label for="nama">Kabupaten</label>
						<?php echo form_error('kab_id', '<div class="error">', '</div>'); ?>
						<div id="txtHint">
							<?php echo kabDropdown($row->mem_prov_id,$row->mem_kab_id)?>
						</div>
					</li>
					
					<li>
						<label for="nama">Kota</label>
						<?php echo form_error('kota', '<div class="error">', '</div>'); ?>
						<input type="text" name="kota" style="width:350px" class="text span-12" value="<?php echo $row->kota;?>">
					</li>
					<li>
						<label for="nama">Kode Pos</label>
						<?php echo form_error('kodepos', '<div class="error">', '</div>'); ?>
						<input type="text" name="kodepos" style="width:350px" class="text span-12" value="<?php echo $row->kodepos;?>">
					</li>
					
				</ul>
			</fieldset>	
		</div>
		<div class="yui-u">
			<fieldset>
			<legend>Edit Password</legend>
			<li>
				<label for="password">Password</label>
				<?php echo form_error('password', '<div class="error">', '</div>'); ?>
				<input type="password" name="password" class="text span-12" value="">
			</li>
			<li>
				<label for="retype_password">Re-type Password</label>
				<?php echo form_error('retype_password', '<div class="error">', '</div>'); ?>
				<input type="password" name="retype_password" class="text span-12" value="">
			</li>
			</fieldset>
			<fieldset>
			<legend>Status</legend>
			<li>
				<label for="status">Status</label>
				<?php echo form_error('stat_mem', '<div class="error">', '</div>'); ?>
				<?php echo statusMemberDropdown($row->status);?>
			</li>
			<br />
			<input type="submit" value="Simpan"> atau
			<a href="<?php echo site_url('backend/member')?>">Batal</a>
			</li>
			</fieldset>
		</div>
	</form>
</div>