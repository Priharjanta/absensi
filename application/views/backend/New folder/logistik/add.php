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
	<h1 style="background-image: url('<?php echo base_url()?>assets/images/order.png');">Setting</h1>
</div>
<div class="yui-gc wrapper">
<h1>Logistik</h1>
<form action="" method="post" enctype="multipart/form-data">
    <div class="yui-u first">
        <fieldset>
		<legend>Tambah Logistik</legend>
		<ul>
			<li>
				<label for="log_nama">Nama</label>
				<?php echo form_error('log_nama', '<div class="error">', '</div>'); ?>
				<input type="text" name="log_nama" style="width:350px" class="text span-12" value="<?php echo set_value('log_nama'); ?>">
			</li>
			<li>
				<label for="nama">Propinsi</label>
				<?php echo form_error('province_id', '<div class="error">', '</div>'); ?>
				<?php echo provDropdown(set_value('province_id'))?>
			</li>
			<li>
				<label for="nama">Kabupaten</label>
				<?php echo form_error('kab_id', '<div class="error">', '</div>'); ?>
				<div id="txtHint">
							<?php echo kabDropdown(set_value('province_id'),set_value('kab_id'));?>
				</div>
			</li>
			<li>
				<label for="log_biaya">Biaya</label>
				<?php echo form_error('log_biaya', '<div class="error">', '</div>'); ?>
				<input type="text" name="log_biaya" style="width:350px" class="text span-12" value="<?php echo set_value('log_biaya'); ?>">
			</li>
			<li>
				<input type="hidden" name="logistik_id" value="<?php echo set_value('logistik_id'); ?>">
				<input type="submit" value="Simpan"> atau <?php echo anchor('backend/logistik','Batalkan')?>
			</li>
		</ul>
    </fieldset>
    </div>

</form>
</div>