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

</head>
<body>
    <div id="wrapper">
	        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">DATA JEMAAT</a>
            </div>
            <!-- /.navbar-header -->


            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
					<!--
                        <li>
                            <a href="#"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Statistik<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Ibadah</a>
                                </li>
                                <li>
                                    <a href="#">Kegiatan</a>
                                </li>
                            </ul>
                        </li> -->
                        <li>
                            <a href="#"><i class="fa  fa-fw"></i>Master Data<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url().'backend/m_jemaat'?>">Jemaat</a>
                                </li>
								<!--
								<li>
                                    <a href="<?php // echo site_url().'backend/m_jmt_access'?>">Jemaat MS Access</a>
                                </li>
								-->
								<!--
								<li>
                                    <a href="<?php echo site_url().'backend/m_wilayah'?>">Wilayah</a>
                                </li>
								-->
                                <li>
                                    <a href="<?php echo site_url().'backend/m_ibadah'?>">Ibadah</a>
                                </li>
								<!--
                                <li>
                                    <a href="<?php echo site_url().'backend/m_kegiatan'?>">Kegiatan</a>
                                </li>
								-->
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<li>
                            <a href="#"><i class="fa  fa-fw"></i>Kebaktian<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url().'backend/data_keb'?>">Data Kebaktian</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url().'backend/abs_keb/view'?>">Absensi Kehadiran</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<!--
						<li>
                            <a href="#"><i class="fa  fa-fw"></i>Kegiatan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url().'backend/data_keg'?>">Data Kegiatan</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url().'backend/abs_keg/view'?>">Absensi Kehadiran</a>
                                </li>
                            </ul>
                        </li>
						 -->
						<li>
                            <a href="#"><i class="fa  fa-fw"></i>Pelayanan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url().'backend/pkj'?>">Perkunjungan</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<li>
                            <a href="#"><i class="fa  fa-fw"></i>Report<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url().'backend/rep_jemaat'?>">Jemaat</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url().'backend/rep_keb'?>">Absensi Kebaktian</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<li>
                            <a href="#"><i class="fa  fa-fw"></i>Setting<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url().'backend/user'?>">User</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url().'#'?>">Option</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<!--
						 <li>
                            <a href="#"><i class="fa  fa-fw"></i>MS Access Data<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
								<li>
                                    <a href="<?php //echo site_url().'backend/mdb_userinfo'?>">tb_userinfo AS JEMAAT</a>
                                </li>
								<li>
                                    <a href="<?php //echo site_url().'backend/mdb_companycode'?>">tb_companycode AS KEBAKTIAN</a>
                                </li>
                                <li>
                                    <a href="<?php //echo site_url().'backend/mdb_departmentcode'?>">tb_departmentcode AS PELAYANAN</a>
                                </li>
                                <li>
                                    <a href="<?php //echo site_url().'backend/mdb_reportlist'?>">tb_reportlist AS ABSEN KEHADIRAN</a>
                                </li>
                            </ul>
                        </li>
						-->
						<li>
                            <a href="<?php echo site_url().'backend/dashboard/doLogout'?>"><i class="fa  fa-fw"></i>(<?php echo $this->session->userdata('user_display_name');?>)Logout<span class="fa arrow"></span></a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
		<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
					<div style="margin-top:25px;">
					</div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<!-- /.row view template -->
				<?php $this->view('backend/'.$template);?>


        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url()?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url()?>assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url()?>assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url()?>assets/dist/js/sb-admin-2.js"></script>

   
	 <!-- For autohide alerts -->
	<script type="text/javascript">
		setTimeout(function() {
			$('#alert_box').fadeOut('fast');
		}, 3000); // <-- time in milliseconds
	</script>


</body>

</html>
