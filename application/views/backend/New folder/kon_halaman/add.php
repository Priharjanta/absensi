<script type="text/javascript">
function ajax_save_new_content()
{
	var form_data = $("form").serialize();
	if (document.getElementById("judul").value != "" &&
		!document.getElementById("konten_id") )
	{
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('backend/content/ajax_save_new_content') ?>",
			data: form_data,
			success: function(return_data){
				$("form#add_content_form").append('<input id="konten_id" name="konten_id" type="hidden" value=' + return_data +'>');
			}
		});
	}
}

function check_form()
{
	var form_data = $("form").serialize();
	alert(form_data);
}


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
	<h1 style="background-image: url('<?php echo base_url()?>assets/images/review.png');">Content Manager</h1>
</div>
<div class="yui-gc wrapper">
<h1>Add Content</h1>
<form id="add_content_form" action="" method="post">
<div class="yui-u first">
    <fieldset>
		<legend><?php echo $title;?></legend>
		<ul>
			<li>
				<label for="judul">Title</label>
				<?php echo form_error('judul', '<div class="error">', '</div>'); ?>
				<input id="judul" type="text" name="judul" class="title" value="<?php echo set_value('judul'); ?>">
			</li>
			<li>
				<label for="content_category_id">Halaman</label>
				<?php echo form_error('page', '<div class="error">', '</div>'); ?>
				<?php echo kontenDropdown('page');?>
				
			</li>
			<li>
				<?php echo form_error('isi_konten', '<div class="error">', '</div>'); ?>
				<?php loadTinyMCE('simple')?>
				<textarea id="isi_konten" class="text tinymce mceEditor" name="isi_konten"><?php echo set_value('isi_konten'); ?></textarea>
			</li>
			<li>
				<input type="submit" class="" value="Simpan"> or <?php echo anchor('backend/kon_halaman','Batal')?>
			</li>
		</ul>
	</fieldset>
</div>
</form>

</div>
