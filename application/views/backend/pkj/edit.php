	<script type="text/javascript">
// autocomplet : this function will be executed every time we change the text
function autocompletJmt() {
	var min_length = 3; // min caracters to display the autocomplete
	var keyword = $('#jmt_id').val();
	if (keyword.length >= min_length) {
		$.ajax({
			url: '<?php echo site_url().'backend/pkj/searchJemaat'?>',
			type: 'POST',
			data: {keyword:keyword},
			success:function(data){
				$('#jmt_list').show();
				$('#jmt_list').html(data);
			}
		});
	} else {
		$('#jmt_list').hide();
	}
}

function set_item(item,id) {
	// change input value
	$('#jmt_id').val(item);
	$('#nama_jemaat').val(item);
	$('#jmt_id_id').val(id);
	// hide proposition list
	$('#jmt_list').hide();
}
</script>

<style type="text/css">
    ul.list{
        padding: 0;
        list-style: none;
        background: #f2f2f2;
    }
    ul.list li{
        display: inline-block;
        line-height: 21px;
        text-align: left;
    }
    ul.list li a{
		padding: 8px 50px;
        display: block;
        color: #333;
        text-decoration: none;
    }
    ul.list li a:hover{
        color: #fff;
        background: #939393;
    }
	#jmt_list {display: none;}
</style>
<div class="row">
	<div class="col-lg-12">
        <?php echo $this->session->flashdata('message_type');?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php echo $title;?>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<form action="" role="form" method="post" enctype="multipart/form-data">
					<div class="col-lg-6">
						<?php echo form_error('pkj_m_jmt_id', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon" for="jmt_id_id">Nama Jemaat</span>
							<input type="text" style="text-transform: uppercase" id="jmt_id" autocomplete="off" autocomplete="false" onkeyup="autocompletJmt()" value="<?php echo getDataTableById('tb_m_jemaat','m_jmt_nama','m_jmt_id',$row->pkj_m_jmt_id);?>" class="form-control" placeholder="Ketik nama ...">
							<input type="hidden" id="jmt_id_id" name="pkj_m_jmt_id" class="form-control"  value="<?php echo $row->pkj_m_jmt_id;?>">
							<ul style="position: relative; margin: 0px 0px 5px 0px;" class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" id="jmt_list"></ul>
						</div>
						<?php echo form_error('pkj_tgl_y', '<div class="alert alert-danger">', '</div>'); ?>
						<?php echo form_error('pkj_tgl_m', '<div class="alert alert-danger">', '</div>'); ?>
						<?php echo form_error('pkj_tgl_d', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<?php 
								if(set_value('pkj_tgl_y')||set_value('pkj_tgl_m')||set_value('pkj_tgl_d')):
									$date = set_value('pkj_tgl_y').'-'.set_value('pkj_tgl_m').'-'.set_value('pkj_tgl_d');
								else:
									$date = '0000-00-00';
								endif;
							?>
							<span class="input-group-addon">Tanggal</span>
							<?php echo dateDropdown('pkj_tgl',$row->pkj_est_date,$this->config->item('y_begin'),$this->config->item('y_end'));?>
						</div>
						<?php echo form_error('pkj_pic', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon" for="pkj_pic">PIC</span>
							<input type="text" name="pkj_pic" class="form-control" value="<?php echo $row->pkj_pic;?>">
						</div>
						<?php echo form_error('pkj_tim', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon" for="pkj_tim">Tim</span>
							<input type="text" name="pkj_tim" class="form-control" value="<?php echo $row->pkj_tim;?>">
						</div>
						<?php echo form_error('pkj_status', '<div class="alert alert-danger">', '</div>'); ?>
						<div class="form-group input-group">
							<span class="input-group-addon" for="user_rule">Status</span>
							<?php echo pkjStatusDropdown($row->pkj_status,'pkj_status');?>
						</div>
						<div class="form-group input-group">
							<input type="submit" class="btn btn-primary" value="Simpan">
							<?php echo anchor('backend/pkj','Batalkan',array('class'=>'btn btn-warning'))?>
						</div>
					</div>	
				</form>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->