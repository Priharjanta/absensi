<div class="left"></div>
<div class="right"></div>
<div class="heading">
	<h1 style="background-image: url('<?php echo base_url()?>assets/images/order.png');">Detail Kontak</h1>
</div>
<div class="yui-gc wrapper">
<?php 
	$message = unserialize($contact->pesan);
	$subject = $message['subject'];
	$message_text =  $message['message'];
?>
<h1>Detail Contact</h1>
<form>
    <fieldset>
		<legend>Detail</legend>
		<ul>
			<li>
				<label for="option_name">Name</label>
				<?php echo $contact->nama_kontak?>
			</li>
			<li>
				<label for="option_value">Email</label>
				<?php echo mailto($contact->email, $contact->email);?>
			</li>
			<li>
				<label for="option_name">Date</label>
				<?php echo $contact->date?>
			</li>
			<li>
				<label for="option_name">Subject</label>
				<?php echo $subject?>
			</li>
			<li>
				<label for="option_name">Message</label>
				<?php echo $message_text?>
			</li>
		</ul>
    </fieldset>
</form>
    <?php echo anchor('backend/contact','Back')?>
</div>