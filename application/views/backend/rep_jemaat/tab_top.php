<script type="text/javascript">
function OpenTab(tab)
{
	var uri = "<?php echo $this->uri->segment(3)?>";
	
	if (uri != tab)
	{
		var url = "<?php echo site_url().'backend/rep_jemaat/'?>"+tab;
		window.open(url, '_self');
	}
}

function DetailHdr(jmt_id)
{
	var jmt_id = jmt_id;
	var url = "<?php echo site_url().'backend/rep_jemaat/detail/'?>"+jmt_id;
	window.open(url, '_self');

}

</script>

<ul class="nav nav-tabs">
                    <li class="<?php if($this->uri->segment(3) == 'perbulan' || !$this->uri->segment(3)){echo 'active';}?>"><a onclick="OpenTab('perbulan')" href="#" data-toggle="tab">Per Bulan</a>
                    </li>
                    <li class="<?php if($this->uri->segment(3) == 'pertahun'){echo 'active';}?>"><a onclick="OpenTab('pertahun')" href="#" data-toggle="tab">Per Tahun</a>
                    </li>
                    <li class="<?php if($this->uri->segment(3) == 'custom'){echo 'active';}?>"><a onclick="OpenTab('custom')" href="#" data-toggle="tab">Custom</a>
                    </li>
</ul>