<?php

function getSidebar()
{

	$out = '<div id="menu_left_title">Cari Produk</div>';
	$out .= '<form action="'.base_url().'produk/pencarian" method="post">';
	$out .= '<div class="search_form">';
	$out .= '<input type="text" class="text_search" name="cari_prod" value="">';
	$out .= '<input type="submit" class="search_button" value="Cari" />';
	$out .= '<br />';
	$out .= '</div> ';
	$out .= '</form>  ';
	
	$out .= '<hr>';
	
	$ci=& get_instance();
	$ci->load->model('produk_model');
	$arr_kat = $ci->Produk_model->getKatProduk('all',FALSE,FALSE,FALSE);

	$out .= '<div id="menu_left_title">Kategori</div>';
	$out .= '<ul id="menu_left_item">';
	foreach ($arr_kat as $row_kat):
	$out .= '<li id="menu_left_item"><a href="'.base_url().'produk/kategori/'.$row_kat['kategori_id'].'/'.alias($row_kat['nama_kategori']).'">'.$row_kat['nama_kategori'].'</a></li>';
	endforeach;
	$out .= '</ul>';
	$out .= '<hr>';
	
	$out .= '<div id="menu_left_title">Customer Support</div>';
	
	$out .= '<table cellpadding="0" cellspacing="0">';
	$out .= '<tr>';
	$out .= '<td class="custname"><strong>Support 1</strong></td>';
	$out .= '</tr>';
	$out .= '<tr>';
	$out .= '<td><a href="ymsgr:sendim?markoez_pr"><img src="http://opi.yahoo.com/yahooonline/u=markoez_pr/m=g/t=2/l=us/opi.jpg" alt="Status YM" border="0"></a></td>';
	$out .= '</tr>';
	$out .= '<tr>';
	$out .= '<td class="custname"><strong>Support 2</strong></td>';
	$out .= '</tr>';
	$out .= '<tr>';
	$out .= '<td><a href="ymsgr:sendim?markoez_pr"><img src="http://opi.yahoo.com/yahooonline/u=markoez_pr/m=g/t=2/l=us/opi.jpg" alt="Status YM" border="0"></a></td>';
	$out .= '</tr>';
	$out .= '</tbody>';
	$out .= '</table>';
	return $out;
	
	


}
function getFoot()
{

	$ci=& get_instance();
	$ci->load->model('produk_model');
	$arr_kat = $ci->Produk_model->getKatProduk('all',FALSE,FALSE,FALSE);

	$out = '<ul>';
	foreach ($arr_kat as $row_kat):
	$out .= '<li><a href="'.base_url().'produk/kategori/'.$row_kat['kategori_id'].'/'.alias($row_kat['nama_kategori']).'">'.$row_kat['nama_kategori'].'</a></li>';
	endforeach;

	return $out;

}



?>