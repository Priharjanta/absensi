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
function expand_this(hidden_div)
{
	$("#"+hidden_div).slideToggle(300);
	return false;
}


function toggleEditor(id) {
	if (!tinyMCE.get(id)){
	tinyMCE.execCommand('mceAddControl', false, id);
	$('input#editor_toggler').attr('value','Hide Editor');
	}
	else{
	tinyMCE.execCommand('mceRemoveControl', false, id);
	$('input#editor_toggler').attr('value','Show Editor') ;
	}
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

<style type="text/css">
      #kotak {
        width: 250px;
        height: 20px;
      }
</style>
<div class="left"></div>
<div class="right"></div>
<div class="heading">
	<h1 style="background-image: url('<?php echo base_url()?>assets/images/product.png');">Katalog</h1>
</div>
<div class="yui-gc wrapper">
<h1>Edit Produk <?php echo $row->nama_produk;?></h1>
<?php echo $this->session->flashdata('message_type');?>
<form id="edit_product_form"action="" method="post" enctype="multipart/form-data">
    <div class="yui-u first">
        <fieldset>
		<legend>Product</legend>
		<ul>
			<li>
				<label for="nama_produk">Kode Produk</label>
				<?php echo form_error('kode_produk', '<div class="error">', '</div>'); ?>
				<input id="nama_produk" type="text" name="kode_produk" class="title" value="<?php echo $row->kode_produk;?>">
			</li>
			<li>
				<label for="nama_produk">Nama</label>
				<?php echo form_error('nama_produk', '<div class="error">', '</div>'); ?>
				<input id="nama_produk" type="text" name="nama_produk" class="title" value="<?php echo $row->nama_produk;?>">
			</li>
			<li>
				<label for="deskripsi">Deskripsi</label>
				<li>
					<?php echo form_error('deskripsi', '<div class="error">', '</div>'); ?>
					<?php loadTinyMCE('simple')?>
					<textarea id="deskripsi" class="text tinymce mceEditor" name="deskripsi"><?php echo $row->deskripsi;?></textarea>
				</li>
			</li>
		</ul>
		</fieldset>
    </div>
	
<div class="yui-u">
	<fieldset>
		<legend>Detail Produk</legend>
		<ul>
						<li>
				<label for="prod_kat_id">Kategori Produk</label>
				<?php echo form_error('prod_kat_id', '<div class="error">', '</div>'); ?>
				<?php echo produkKatDropdown($row->prod_kat_id);?>
			</li>
			<li>
				<label for="size">Ukuran (Selain Pakaian bisa dikosongkan)</label>
				<?php echo form_error('size', '<div class="error">', '</div>'); ?>
				<?php echo sizeDropdown($row->size)?>
			</li>
			<li>
				<label for="harga">Harga Pokok</label>
				<?php echo form_error('harga_pokok', '<div class="error">', '</div>'); ?>
				<input type="text" name="harga_pokok" class="text" value="<?php echo $row->harga_pokok; ?>">
			</li>
			<li>
				<label for="harga">Harga</label>
				<?php echo form_error('harga', '<div class="error">', '</div>'); ?>
				<input type="text" name="harga" class="text" value="<?php echo $row->harga; ?>">
			</li>
			<li>
				<label for="diskon">Diskon (%)</label>
				<?php echo form_error('diskon', '<div class="error">', '</div>'); ?>
				<input type="text" name="diskon" class="text" value="<?php echo $row->diskon; ?>">
			</li>
			<li>
				<label for="qty">Stok</label>
				<?php echo form_error('jml_stok', '<div class="error">', '</div>'); ?>
				<input type="text" name="jml_stok" class="text" value="<?php echo $row->jml_stok;?>">
			</li>
			<li>
				<label for="tersedia">Ketersediaan</label>
				<?php echo form_error('tersedia', '<div class="error">', '</div>'); ?>
				<?php echo booleanValueAva($row->tersedia,'tersedia')?>
			</li>
			<li>
				<label for="promo">Promo</label>
				<?php echo form_error('promo', '<div class="error">', '</div>'); ?>
				<?php echo booleanValuePromo($row->promo,'promo')?>
			</li>
			<li>
				<label for="image">Gambar</label>
				<img  border="4"src="<?php echo base_url().'public/photo/'.$row->image_thumb;?>" width=50%>
            </li>
			<li>
				<a id="image_change_link" href="JavaScript:void(0);" onclick="$('#image_change , #image_change_link').toggle()">Ganti Gambar</a>
				<div id="image_change" class="hidden">
					<label for="gambarproduk">Edit Image (.JPG / 300px X 400px)</label>
	                <?php echo form_error('gambarproduk', '<div class="error">', '</div>'); ?>
	                <input type="file" name="gambarproduk" class="subtitle">
	                <a href="JavaScript:void(0);" onclick="$('#image_change , #image_change_link').toggle()">Cancel</a>
                </div>
            </li>
			<li>
				<?php if (isset($product_id)):?>
				<input id="product_id" type="hidden" name="product_id" value="<?php echo $product_id;?>">
				<?php endif?>
				<input type="submit" value="Simpan"> atau <?php echo anchor('backend/produk','Batalkan')?>
			</li>
		</ul>
	</fieldset>
</div>
</form>
</div>