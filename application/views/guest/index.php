<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<title><?php if(isset($title)) echo $title;?></title>

	<!-- Bootstrap Core CSS -->
	<link href="<?php echo base_url()?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- MetisMenu CSS -->
	<link href="<?php echo base_url()?>assets/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

	<!-- Timeline CSS -->
	<link href="<?php echo base_url()?>assets/dist/css/timeline.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="<?php echo base_url()?>assets/dist/css/sb-admin-2.css" rel="stylesheet">

	<!-- Morris Charts CSS -->
	<link href="<?php echo base_url()?>assets/bower_components/morrisjs/morris.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="<?php echo base_url()?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<!-- jQuery -->
    <script src="<?php echo base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript">
	
	$(document).ready(function () {
  //called when key is pressed in textbox
  $("#keb_count_l").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg_l").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
   
   $("#keb_count_p").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg_p").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
   
   <?php if ($this->agent->is_mobile()):?>
	   var w 		= $( window ).width();
	   var w_list 	= w - 62;
	   $( "#jmt_list" ).css( "width", w_list+'px' );
	<?php else :?>
	   var w 		= $( window ).width();
	  
	   if (w <= 800){
			var w_list 	= w - 62;
	   }else{
			var w_list 	= (w/3) + 50;
	   }
	   $( "#jmt_list" ).css( "width", w_list+'px' );
	<?php endif;?>
});
// autocomplet : this function will be executed every time we change the text
function autocompletJmt() {
	$('#bersih').val('Hapus [ X ]');
	var min_length = 3; // min caracters to display the autocomplete
	var keyword = $('#jmt_id').val();
	if (keyword.length >= min_length) {
		$.ajax({
			url: '<?php echo site_url().'guest/searchJemaat'?>',
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

function clearInput()
{
	$('#jmt_id').val("");
	$("#jmt_id" ).focus();
	$('#jmt_list').hide();
	$('#bersih').val('Isi Nama');
	$('#detail_nama').css("display", "none");
}

function Dashboard()
{
	url = "<?php echo site_url();?>";
	window.open(url, '_self');
}

// set_item : this function will be executed when we select an item
function set_item(item,id,almt) {
	//alert(almt);
	// change input value
	$('#jmt_id').val(item);
	$('#bersih').val('Hapus [ X ]');
	$('#nama_jemaat').val(item);
	$('#nama_jemaat_2').text(item);
	$('#alamat_jemaat').text(almt);
	$('#jmt_id_id').val(id);
	$('#detail_nama').css("display", "block");
	// hide proposition list
	$('#jmt_list').hide();
}

function AddJmtSubmit()
{
	var m_jmt_nama 		= $('#m_jmt_nama').val();
	var m_jmt_jenkel 	= $('#m_jmt_jenkel').val();
	var opt_absen 		= $('#opt_absen').val();
	
	if(m_jmt_nama != "" && m_jmt_jenkel != "")
	{
		if ($("#opt_absen_1").is(":checked") || $("#opt_absen_2").is(":checked"))
		{
			$( "#add_jmt" ).submit();
		}
		else
		{
			alert ('Mohon lengkapi data (sekaligus absen atau tambah saja)');
		}
		
	}
	else
	{
		alert ('Mohon lengkapi data (nama dan jenkel)');
	}

	
}







function AddJmtCounterSubmit()
{
	var keb_count_l 		= $('#keb_count_l').val();
	var keb_count_p 		= $('#keb_count_p').val();
	
	if(keb_count_l != "" && keb_count_p != "")
	{
		
		$( "#add_jmt_counter" ).submit();
	
	
	}
	else
	{
		alert ('Mohon lengkapi data');
	}

	
}
</script>
<script type="text/javascript">
		setTimeout(function() {
			$('#alert_box').fadeOut('fast');
		}, 1000); // <-- time in milliseconds
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
</head>
<body>
	
	<?php echo $this->session->flashdata('message_type_popup');?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div style="margin-top:30px;" class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Absensi <?php echo $title;?></h3>
                    </div>
                    <div class="panel-body">
						<?php echo $this->session->flashdata('message_type');?>
                        <form role="form" action="<?php echo site_url()?>guest/do_abs" method="post">
                            <fieldset>
                                <div class="form-group">	
									<div class="form-group input-group">
										<input type="text" style="font-size:16px; text-transform: uppercase" id="jmt_id" autocomplete="off" autocomplete="false" onkeyup="autocompletJmt()" class="form-control" placeholder="Ketik nama ..." autofocus>
										
										<input type="hidden" id="jmt_id_id" name="hdr_m_jmt_id" class="form-control"  value="">
										<span class="input-group-btn">
											<input id="bersih" onclick="clearInput()" type="button" value="Isi Nama" class="btn btn-default" >
										</span>
									</div>
									<div style="padding-left:10px;padding-right:10px; display:none;" id="detail_nama" class="form-group input-group">
										<div style="font-weight: bold;font-size:16px;" id="nama_jemaat_2"></div>
										<div style="font-style: italic;" id="alamat_jemaat"></div>
										<hr>
										<div>
										<input type="submit" value="Simpan" class="btn btn-lg btn-primary" >
										</div>
									</div>
									
									<ul style="position: relative; margin: 0px 0px 5px 0px;overflow:scroll; height:500px;" class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" id="jmt_list"></ul>
								</div>
								<input type="hidden" id="hdr_keb_keb_id" name="hdr_keb_keb_id" class="form-control"  value="<?php echo $keb_id;?>">
								
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
		<hr>
		<div class="row">
           <div style="margin-top:30px;" class="col-md-6 col-md-offset-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Tambah Data Jemaat Baru
                        </div>
                        <div class="panel-body">
							<?php echo $this->session->flashdata('message_type_2');?>
						<form id="add_jmt" action="<?php echo site_url()?>/guest/add_jmt" role="form" method="post" enctype="multipart/form-data">
							
                            <?php echo form_error('m_jmt_nama', '<div class="alert alert-danger">', '</div>'); ?>
							<div class="form-group input-group">
								<span class="input-group-addon">Nama *</span>
								<input type="text" style="text-transform: uppercase" autocomplete="off" autocomplete="false" id="m_jmt_nama" name="m_jmt_nama" class="form-control" value="<?php echo set_value('m_jmt_nama'); ?>">
							</div>
							<?php echo form_error('m_jmt_jenkel', '<div class="alert alert-danger">', '</div>'); ?>
							<div class="form-group input-group">
								<span class="input-group-addon">Jenis Kelamin *</span>
								<?php echo jenkelDropdown(set_value('m_jmt_jenkel'),'m_jmt_jenkel');?>
							</div>
							<?php echo form_error('m_jmt_tgl_lhr', '<div class="alert alert-danger">', '</div>'); ?>
							<div class="form-group input-group">
								<span class="input-group-addon">Tgl Lhr</span>
								<?php echo dateDropdown('m_jmt_tgl_lhr',set_value('m_jmt_tgl_lhr'),'1950','2020');?>
							</div>
							<?php echo form_error('m_jmt_telp_1', '<div class="alert alert-danger">', '</div>'); ?>
							<div class="form-group input-group">
								<span class="input-group-addon">No HP</span>
								<input type="text" name="m_jmt_telp_1" class="form-control" value="<?php echo set_value('m_jmt_telp_1');?>">
							</div>
							<div class="form-group">
                                            <label class="radio-inline">
                                                <input type="radio" name="opt_absen" id="opt_absen_1" value="1">Sekaligus Absen
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="opt_absen" id="opt_absen_2" value="2">Tambah Saja
                                            </label>
                                        </div>
							<p>
							<input type="hidden" id="hdr_keb_keb_id" name="hdr_keb_keb_id" class="form-control"  value="<?php echo $keb_id;?>">
							<button type="button" onClick="AddJmtSubmit()" class="btn btn-primary">Simpan</button>
							</p>
						</div>
						</form>
                    </div>
            </div>
        </div>
								<!-- Modal for detail  -->
						<div class="modal fade" id="myModalCounter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
									<div class="panel panel-default">
										<div class="panel-heading">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title" id="myModalLabel">Counter Absensi <?php echo $title;?></h4>
										</div>
										<div class="row">
											<div class="col-md-6">
												
												<div class="panel-body">
													<h4>Counter Data </h4>
													<form id="add_jmt_counter" action="<?php echo site_url()?>guest/add_jmt_counter" role="form" method="post" enctype="multipart/form-data">
													<div class="form-group input-group">
														<span class="input-group-addon">Jumlah Laki - laki</span>
														<input type="text" maxlength="4" style="width:100px; text-transform: uppercase" autocomplete="off" autocomplete="false" id="keb_count_l" name="keb_count_l" class="form-control" value="<?php echo $row_qr_keb_ib->keb_count_l;?>">
														&nbsp;<span id="errmsg_l"></span>
													</div>
													<div class="form-group input-group">
														<span class="input-group-addon">Jumlah Perempuan</span>
														<input type="text" maxlength="4" style="width:100px;text-transform: uppercase" autocomplete="off" autocomplete="false" id="keb_count_p" name="keb_count_p" class="form-control" value="<?php echo $row_qr_keb_ib->keb_count_p;?>">
														&nbsp;<span id="errmsg_p"></span>
													</div>
													<div class="form-group input-group">
														<span class="input-group-addon">Jumlah Total</span>
														<input type="text" maxlength="4" style="width:100px;text-transform: uppercase" autocomplete="off" autocomplete="false" id="" name="" class="form-control" value="<?php echo $row_qr_keb_ib->keb_count_l + $row_qr_keb_ib->keb_count_p;?>" disabled>
														&nbsp;<span id="errmsg_p"></span>
													</div>
													<input type="hidden" id="hdr_keb_keb_id" name="hdr_keb_keb_id" class="form-control"  value="<?php echo $keb_id;?>">
													<button type="button" onClick="AddJmtCounterSubmit()" class="btn btn-primary">Simpan</button>
													</form>
												</div>
											</div>
											<div class="col-md-6">
												<div class="panel-body">
													<h4>Real Data </h4>
													
													<div class="form-group input-group">
														<span class="input-group-addon">Jumlah Laki - laki</span>
														<input type="text" maxlength="4" style="width:100px; text-transform: uppercase" autocomplete="off" autocomplete="false" id="" name="" class="form-control" value="<?php echo $count_p;?>" disabled>
														&nbsp;<span id="errmsg_l"></span>
													</div>
													<div class="form-group input-group">
														<span class="input-group-addon">Jumlah Perempuan</span>
														<input type="text" maxlength="4" style="width:100px;text-transform: uppercase" autocomplete="off" autocomplete="false" id="" name="" class="form-control" value="<?php echo $count_w;?>" disabled>
														&nbsp;<span id="errmsg_p"></span>
													</div>
													<div class="form-group input-group">
														<span class="input-group-addon">Jumlah Total</span>
														<input type="text" maxlength="4" style="width:100px;text-transform: uppercase" autocomplete="off" autocomplete="false" id="" name="" class="form-control" value="<?php echo $count_w+$count_p;?>" disabled>
														&nbsp;<span id="errmsg_p"></span>
													</div>
													<input type="hidden" id="hdr_keb_keb_id" name="hdr_keb_keb_id" class="form-control"  value="<?php echo $keb_id;?>">

												</div>
											</div>
										</div>
										
									</div>
								<!-- /.modal-content -->
							</div>
							<!-- /.modal-dialog -->
						</div>
		<div class="row">
           <button type="button" onClick="Dashboard()" class="btn btn-primary">Dashboard</button>
		   <button type="button" data-toggle="modal" data-target="#myModalCounter" class="btn btn-primary">Counter Jemaat L (<?php echo $row_qr_keb_ib->keb_count_l;?>)  P (<?php echo $row_qr_keb_ib->keb_count_p;?>) </button>
        </div>
    </div>

    

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url()?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url()?>assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url()?>assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url()?>assets/dist/js/sb-admin-2.js"></script>

</body>

</html>

