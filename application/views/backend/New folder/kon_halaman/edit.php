<script type="text/javascript">
      $(document).ready(function() {
        setTimeout(function(){
          $("#kotak").fadeOut("slow", function () {
            $("#kotak").remove();
          });    
        }, 3000);
      });
</script>

<script type="text/javascript">
function add_to_textarea(textareaID,val)
{
	if (tinyMCE.get(textareaID)){
		tinyMCE.execCommand('mceInsertRawHTML',false,val);
		//alert("yay");
	}
	else
	{
		var textareaID = document.getElementById(textareaID);
		//IE support
		if (document.selection) {
			textareaID.focus();
			sel = document.selection.createRange();
			sel.text = val;
		}
		//MOZILLA/NETSCAPE support
		else if (textareaID.selectionStart || textareaID.selectionStart == '0') {
			var startPos = textareaID.selectionStart;
			var endPos = textareaID.selectionEnd;
			textareaID.value = textareaID.value.substring(0, startPos)
			+ val
			+ textareaID.value.substring(endPos, textareaID.value.length);
		} else {
			textareaID.value += val;
		}
	}
}

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
	<h1 style="background-image: url('<?php echo base_url()?>assets/images/review.png');">Konten Manajer</h1>
</div>
<div class="yui-gc wrapper">
<h1>Edit Konten</h1>
<?php echo $this->session->flashdata('message_type');?>
	<form action="" method="post">
		<div class="yui-u first">
			<fieldset>
				<legend><?php echo $title;?></legend>
				<ul>
					<li>
						<label for="judul">Title</label>
						<?php echo form_error('judul', '<div class="error">', '</div>'); ?>
						<input id="judul" type="text" name="judul" class="title" value="<?php echo $row->judul; ?>">
					</li>
					<li>
						<label for="content_category_id">Halaman</label>
						<?php echo form_error('page', '<div class="error">', '</div>'); ?>
						<?php echo kontenDropdown($row->page);?>
						
					</li>
					<li>
						<?php echo form_error('isi_konten', '<div class="error">', '</div>'); ?>
						<?php loadTinyMCE('simple')?>
						<textarea id="isi_konten" class="text tinymce mceEditor" name="isi_konten"><?php echo $row->isi_konten;?></textarea>
					</li>
					<li>
						<input type="submit" class="" value="Simpan"> or <?php echo anchor('backend/kon_halaman','Batal')?>
					</li>
				</ul>
			</fieldset>  
		</div>
	</form>
</div>

