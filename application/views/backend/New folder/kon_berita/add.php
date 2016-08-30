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
		//alert("aaw");
		//$("#"+textareaID).val($("#"+textareaID).val() +val) ;
	}
}
</script>
<div class="left"></div>
<div class="right"></div>
<div class="heading">
	<h1 style="background-image: url('<?php echo base_url()?>assets/images/review.png');">Konten Manajer</h1>
</div>
<div class="yui-gc wrapper">
<h1>Tambah Konten Berita</h1>
<form id="add_content_form" action="" method="post">
<div class="yui-u first">
    <fieldset>
		<legend><?php echo $title;?></legend>
		<ul>
			<li>
				<label for="judul">Judul</label>
				<?php echo form_error('judul', '<div class="error">', '</div>'); ?>
				<input id="judul" type="text" name="judul" class="title" value="<?php echo set_value('judul'); ?>">
			</li>
			<li>
				<?php echo form_error('isi_konten', '<div class="error">', '</div>'); ?>
				<?php loadTinyMCE('simple')?>
				<textarea id="isi_konten" class="text tinymce mceEditor" name="isi_konten"><?php echo set_value('isi_konten'); ?></textarea>
			</li>
			<li>
				<label for="published">Publikasi</label>
				<?php echo form_error('published', '<div class="error">', '</div>'); ?>
				<?php echo booleanValuePublish('Ya','published')?>
			</li>
			<li>
				<input type="submit" class="" value="Simpan"> or <?php echo anchor('backend/kon_berita','Batal')?>
			</li>
		</ul>
	</fieldset>
</div>
</form>

</div>
