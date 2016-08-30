<?php

class Rep_keb extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->load->helper('bantuan_helper');
		$this->load->model('Abskeb_model');
		$this->load->model('Datakeb_model');
		$this->load->library('fpdf');
		if(!$this->session->userdata('user_id') && !$this->session->userdata('user_display_name') ):
			redirect('backend');
		elseif($this->session->userdata('user_rule')=='Frontend'):
			redirect('backend/no_access');
		endif;

	}

	function index()
	{
		$this->load->library('pagination');
		$offset = $this->uri->segment(4);
		$config['base_url'] = site_url().'/backend/data_keb/index';
		$config['total_rows'] = count($this->Datakeb_model->getDatakeb('all',FALSE,FALSE,FALSE));
		$config['per_page'] = $this->config->item('per_page');
		$config['uri_segment'] = '4';
		
		// pagination config
		$config['per_page'] 		= $this->config->item('per_page');
		$config['full_tag_open'] 	= $this->config->item('full_tag_open');
		$config['full_tag_close'] 	= $this->config->item('full_tag_close');
		$config['num_tag_open'] 	= $this->config->item('num_tag_open');
		$config['num_tag_close'] 	= $this->config->item('num_tag_close');
		$config['cur_tag_open'] 	= $this->config->item('cur_tag_open');
		$config['cur_tag_close'] 	= $this->config->item('cur_tag_close');
		$config['next_tag_open'] 	= $this->config->item('next_tag_open');
		$config['next_tagl_close'] 	= $this->config->item('next_tagl_close');
		$config['prev_tag_open'] 	= $this->config->item('prev_tag_open');
		$config['prev_tagl_close'] 	= $this->config->item('prev_tagl_close');
		$config['first_tag_open'] 	= $this->config->item('first_tag_open');
		$config['first_tagl_close'] = $this->config->item('first_tagl_close');
		$config['last_tag_open'] 	= $this->config->item('last_tag_open');
		$config['last_tagl_close'] 	= $this->config->item('last_tagl_close');
		
		$data['urut'] = $this->uri->segment(4);
		$data['heading'] = 'Report Data Kebaktian';
		$data['title'] = $data['heading'].' - Kebaktian';
		$data['template'] = 'rep_keb/index';
		$data['res'] = $this->Datakeb_model->getDatakeb('all',FALSE,$config['per_page'],$offset);
		$this->pagination->initialize($config);
		$this->load->view('backend/index',$data);
	}

	function cetak_absen()
	{
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));

		$keb_id = $this->uri->segment(4);
		$result = $this->Abskeb_model->getAbskeb('byKebId',FALSE,FALSE,FALSE,$keb_id);

		$qr_keb = $this->db->query("
						SELECT 
							tb_kebaktian.*,
							tb_m_ibadah.*
						FROM 
							tb_kebaktian 
						JOIN 
							tb_m_ibadah ON tb_m_ibadah.m_ib_id = tb_kebaktian.keb_m_ib_id
						WHERE 
							tb_kebaktian.keb_id = $keb_id")->row();
		
		
		//date_default_timezone_set('Asia/Jakarta');
		$this->fpdf->FPDF("P","cm","A4");

		// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
		$this->fpdf->SetMargins(1,1,1);
		//$this->fpdf->SetAutoPageBreak('auto',1);
		/* AliasNbPages() merupakan fungsi untuk menampilkan total halaman
		di footer, nanti kita akan membuat page number dengan format : number page / total page
		*/
		$this->fpdf->AliasNbPages();
		$this->fpdf->SetAutoPageBreak(true,2);

		// AddPage merupakan fungsi untuk membuat halaman baru
		$this->fpdf->AddPage();

		// Setting Font : String Family, String Style, Font size
		$this->fpdf->SetFont('helvetica','B',12);

		/* Kita akan membuat header dari halaman pdf yang kita buat
		————– Header Halaman dimulai dari baris ini —————————–
		*/
		$this->fpdf->Cell(19,0.7,'Daftar Absensi Ibadah',0,0,'C');
		$this->fpdf->Ln();
		$this->fpdf->Cell(19,0.7,$qr_keb->m_ib_name,0,0,'C');

		// fungsi Ln untuk membuat baris baru
		$this->fpdf->Ln();

		$this->fpdf->Ln();

		
		$this->fpdf->SetFont('helvetica','B',8);
		$this->fpdf->Cell(2, 0.4, 'Tanggal',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.4, ': ',0,'LR','L');
		$this->fpdf->Cell(5, 0.4, indDate($qr_keb->keb_tgl),0,'LR','L');
		$this->fpdf->Ln();
		$this->fpdf->Cell(2, 0.4, 'Tema',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.4, ': ',0,'LR','L');
		$this->fpdf->Cell(5, 0.4,$qr_keb->keb_tema,0,'LR','L');
		$this->fpdf->Ln();
		$this->fpdf->Cell(2, 0.4, 'Pengkotbah',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.4, ': ',0,'LR','L');
		$this->fpdf->Cell(5, 0.4, $qr_keb->keb_pengkotbah,0,'LR','L');

		/* setting cell untuk page number */

		/* ————– Header Halaman selesai ————————————————*/

		$this->fpdf->Ln(1);
		$this->fpdf->SetFont('helvetica','B',8);
		$this->fpdf->Cell(1 , 0.7, 'No' , 1, 'LR', 'L');
		$this->fpdf->Cell(8 , 0.7, 'Nama Jemaat' , 1, 'LR', 'L');
		$this->fpdf->Cell(2 , 0.7, 'Pria/Wanita' , 1, 'LR', 'L');
		$this->fpdf->Cell(6 , 0.7, 'No Telp / HP' , 1, 'LR', 'L');
		$this->fpdf->Cell(2 , 0.7, 'Jam Masuk' , 1, 'LR', 'L');
		$i = 1;

		/* generate hasil query disini */
		foreach($result as $row)
		{
			$this->fpdf->Ln();
			$this->fpdf->SetFont('helvetica','',8);
			$this->fpdf->Cell(1 , 0.5, $i, 1, 'LR', 'L');
			$this->fpdf->Cell(8 , 0.5, $row['m_jmt_nama'], 1, 'LR', 'L');
			$this->fpdf->Cell(2 , 0.5, $row['m_jmt_jenkel'] , 1, 'LR', 'L');
			$this->fpdf->Cell(6 , 0.5, $row['m_jmt_telp_1'].'/'.$row['m_jmt_hp_1'] , 1, 'LR', 'L');
			$this->fpdf->Cell(2 , 0.5, formatDate($row['hdr_keb_datetime'],'time_only') , 1, 'LR', 'L');
			$i++;
		}
		/* setting posisi footer 3 cm dari bawah */

		$this->fpdf->SetY(-3);

		/* setting font untuk footer */
		$this->fpdf->SetFont('helvetica','',6);

		/* setting cell untuk waktu pencetakan */
		$this->fpdf->Cell(9.5, 0.5, 'Printed on : '.mysqlDateNow().' | Created by : GKI Bungur',0,'LR','L');

		/* setting cell untuk page number */
		//$this->fpdf->Cell(9.5, 0.5, 'Page '.$this->fpdf->PageNo().'/{nb}',0,0,'R');

		/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
		$this->fpdf->Output("REPORT_ABSEN_".$qr_keb->keb_tgl.".pdf","I");

		
	}



	function cetak_all()
	{

		define('FPDF_FONTPATH',$this->config->item('fonts_path'));

		$keb_id = $this->uri->segment(4);
		$result = $this->Abskeb_model->getAbskeb('byKebId',FALSE,FALSE,FALSE,$keb_id);
		

		$qr_keb = $this->db->query("
						SELECT 
							tb_kebaktian.*,
							tb_m_ibadah.*
						FROM 
							tb_kebaktian 
						JOIN 
							tb_m_ibadah ON tb_m_ibadah.m_ib_id = tb_kebaktian.keb_m_ib_id
						WHERE 
							tb_kebaktian.keb_id = $keb_id")->row();
		
		
		//date_default_timezone_set('Asia/Jakarta');
		$this->fpdf->FPDF("P","cm","A4");

		// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
		$this->fpdf->SetMargins(1,1,1);
		//$this->fpdf->SetAutoPageBreak('auto',1);
		/* AliasNbPages() merupakan fungsi untuk menampilkan total halaman
		di footer, nanti kita akan membuat page number dengan format : number page / total page
		*/
		$this->fpdf->AliasNbPages();
		$this->fpdf->SetAutoPageBreak(true,2);

		// AddPage merupakan fungsi untuk membuat halaman baru
		$this->fpdf->AddPage();

		$this->fpdf->SetFont('helvetica','B',12);

		/* Kita akan membuat header dari halaman pdf yang kita buat

		*/
		$this->fpdf->Cell(19,0.7,'Data Ibadah',0,0,'C');
		$this->fpdf->Ln();
		$this->fpdf->Cell(19,0.7,$qr_keb->m_ib_name,0,0,'C');

		$this->fpdf->Ln(2);
		
		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1.5, 0.7, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.7, 'Tanggal',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.7, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.7, indDate($qr_keb->keb_tgl),0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1.5, 0.7, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.7, 'Pengkhotbah',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.7, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.7, $qr_keb->keb_pengkotbah,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1.5, 0.7, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.7, 'Ayat',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.7, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.7, $qr_keb->keb_ayat,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1.5, 0.7, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.7, 'Ayat Persembahan',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.7, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.7, $qr_keb->keb_persembahan,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1.5, 0.7, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.7, 'Liturgos',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.7, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.7, $qr_keb->keb_liturgos,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1.5, 0.7, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.7, 'Majelis Bertugas',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.7, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.7, $qr_keb->keb_majelis,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1.5, 0.7, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.7, 'Pianis',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.7, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.7, $qr_keb->keb_pianis,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1.5, 0.7, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.7, 'Organis',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.7, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.7, $qr_keb->keb_organis,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1.5, 0.7, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.7, 'Tim Musik',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.7, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.7, $qr_keb->keb_tim_musik ,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1.5, 0.7, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.7, 'Pemandu Nyanyian',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.7, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.7, $qr_keb->keb_pmdu_nyanyian,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1.5, 0.7, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.7, 'Nyanyian',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.7, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.7, $qr_keb->keb_nanyian,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1.5, 0.7, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.7, 'Multimedia / LCD',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.7, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.7, $qr_keb->keb_mulmed_lcd,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1.5, 0.7, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.7, 'Penyambut',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.7, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.7, $qr_keb->keb_penyambut,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1.5, 0.7, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.7, 'Kolektan',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.7, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.7, $qr_keb->keb_kolektan,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1.5, 0.7, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.7, 'Keterangan',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.7, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.7, $qr_keb->keb_ket,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1.5, 0.7, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.7, 'Waktu Kebaktian',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.7, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.7, $qr_keb->keb_tgl.' '.$qr_keb->m_ib_start_time,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1.5, 0.7, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.7, 'Jumlah Hadir Absensi',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.7, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.7,cekKehadiran(TRUE,'keb','all',$keb_id,FALSE) .' (Pria : '.count($this->Abskeb_model->getAbskeb('byKebIdPria',FALSE,FALSE,FALSE,$keb_id)).' / Wanita : '.count($this->Abskeb_model->getAbskeb('byKebIdWanita',FALSE,FALSE,FALSE,$keb_id)).')',0,'LR','L');
		$this->fpdf->Ln();
		
		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1.5, 0.7, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.7, 'Jumlah Hadir Counter',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.7, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.7,$qr_keb->keb_count_l+$qr_keb->keb_count_p .' (Pria : '.$qr_keb->keb_count_l.' / Wanita : '.$qr_keb->keb_count_p.')',0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1.5, 0.7, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.7, 'On-time',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.7, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.7, cekKehadiran(TRUE,'keb','late',$keb_id,$qr_keb->keb_tgl.' '.$qr_keb->m_ib_start_time,0,'LR','L'));
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1.5, 0.7, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.7, 'Terlambat',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.7, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.7, cekKehadiran(TRUE,'keb','ontime',$keb_id,$qr_keb->keb_tgl.' '.$qr_keb->m_ib_start_time,0,'LR','L'));
		$this->fpdf->Ln();


		// fungsi Ln untuk membuat baris baru
		$this->fpdf->Ln();




		////////// PAGE 2 //////////////////////////////////



		// AddPage merupakan fungsi untuk membuat halaman baru
		$this->fpdf->AddPage();

		// Setting Font : String Family, String Style, Font size
		$this->fpdf->SetFont('helvetica','B',12);

		/* Kita akan membuat header dari halaman pdf yang kita buat
		————– Header Halaman dimulai dari baris ini —————————–
		*/
		$this->fpdf->Cell(19,0.7,'Daftar Absensi Ibadah',0,0,'C');

		// fungsi Ln untuk membuat baris baru
		$this->fpdf->Ln();

		/* setting cell untuk page number */

		/* ————– Header Halaman selesai ————————————————*/

		$this->fpdf->Ln(1);
		$this->fpdf->SetFont('helvetica','B',8);
		$this->fpdf->Cell(1 , 0.7, 'No' , 1, 'LR', 'L');
		$this->fpdf->Cell(8 , 0.7, 'Nama Jemaat' , 1, 'LR', 'L');
		$this->fpdf->Cell(2 , 0.7, 'Pria/Wanita' , 1, 'LR', 'L');
		$this->fpdf->Cell(6 , 0.7, 'No Telp / HP' , 1, 'LR', 'L');
		$this->fpdf->Cell(2 , 0.7, 'Jam Masuk' , 1, 'LR', 'L');
		$i = 1;

		/* generate hasil query disini */
		foreach($result as $row)
		{
			$this->fpdf->Ln();
			$this->fpdf->SetFont('helvetica','',8);
			$this->fpdf->Cell(1 , 0.5, $i, 1, 'LR', 'L');
			$this->fpdf->Cell(8 , 0.5, $row['m_jmt_nama'], 1, 'LR', 'L');
			$this->fpdf->Cell(2 , 0.5, $row['m_jmt_jenkel'] , 1, 'LR', 'L');
			$this->fpdf->Cell(6 , 0.5, $row['m_jmt_telp_1'].'/'.$row['m_jmt_hp_1'] , 1, 'LR', 'L');
			$this->fpdf->Cell(2 , 0.5, formatDate($row['hdr_keb_datetime'],'time_only') , 1, 'LR', 'L');
			$i++;
		}
		/* setting posisi footer 3 cm dari bawah */

		$this->fpdf->SetY(-3);

		/* setting font untuk footer */
		$this->fpdf->SetFont('helvetica','',6);

		/* setting cell untuk waktu pencetakan */
		$this->fpdf->Cell(9.5, 0.5, 'Printed on : '.mysqlDateNow().' | Created by : GKI Bungur',0,'LR','L');

		/* setting cell untuk page number */
		//$this->fpdf->Cell(9.5, 0.5, 'Page '.$this->fpdf->PageNo().'/{nb}',0,0,'R');

		/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
		$this->fpdf->Output("REPORT_ABSEN_".$qr_keb->keb_tgl.".pdf","I");

	}

	
	
}