<div class="left"></div>
<div class="right"></div>
<div class="heading">
	<h1 style="background-image: url('<?php echo base_url()?>assets/images/order.png');">Setting</h1>
</div>
<div class="yui-gc wrapper">
<h1>User</h1>
<form action="" method="post">
	<div class="yui-u first">
    <fieldset>
		<legend>User Baru</legend>
		<ul>
			<li>
				<label for="user_login">Username</label>
				<?php echo form_error('user_login', '<div class="error">', '</div>'); ?>
				<input type="text" name="user_login" class="text span-12" value="<?php echo set_value('user_login'); ?>">
			</li>
			<li>
				<label for="user_password">Password</label>
				<?php echo form_error('user_password', '<div class="error">', '</div>'); ?>
				<input type="password" name="user_password" class="text span-12" value="">
			</li>
			<li>
				<label for="retype_user_password">Re-type Password</label>
				<?php echo form_error('retype_user_password', '<div class="error">', '</div>'); ?>
				<input type="password" name="retype_user_password" class="text span-12" value="">
			</li>
			<li>
				<label for="user_display_name">Display Name</label>
				<?php echo form_error('user_display_name', '<div class="error">', '</div>'); ?>
				<input type="text" name="user_display_name" class="text  span-12" value="<?php echo set_value('user_display_name'); ?>">
			</li>
			<li>
				<label for="user_email">Email</label>
				<?php echo form_error('user_email', '<div class="error">', '</div>'); ?>
				<input type="text" name="user_email" class="text  span-12" value="<?php echo set_value('user_email'); ?>">
			</li>
			<li>
				<label for="user_rule">User Rule</label>
				<?php echo form_error('user_rule', '<div class="error">', '</div>'); ?>
				<?php echo ruleDropdown('user_rule');?>
				
			</li>
			<li>
				<input type="submit" value="Simpan"> atau
				<?php echo anchor('backend/user','Batalkan')?>
			</li>
		</ul>
    </fieldset>
	</div>
</form>
</div>