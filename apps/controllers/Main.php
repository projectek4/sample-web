<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		
		$this->load->database();
		$this->load->helper(array('app', 'html', 'bootstrap', 'url', 'form'));
		$this->load->model('app_model');
		$this->_init();
	}
	private function _init()
	{
		$this->output->set_template('new');

		meta(array('http-equiv'=>'X-UA-Compatible', 'content'=>'IE-edge'));
		meta('viewport', 'width=device-width, initial-scale=1');
		meta('resource-type', 'document');
		meta('robots', 'all, index, follow');
		meta('googleboot', 'all, index, follow');

		$this->load->css('https://fonts.googleapis.com/css?family=Roboto+Mono:300,400,700|Roboto:300,300i,400,400i,700,700i');
		$this->load->css('lib/bootstrap/css/bootstrap.min.css');
		$this->load->css('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
		//$this->load->css('lib/font-awesome/css/font-awesome.min.css');
		$this->load->css('lib/animate/animate.min.css');
		//$this->load->css('lib/jQuery-News-Ticker-master/ticker-style.css');
		$this->load->css('css/style.css');
		
		//$this->load->less('lib/bootstrap/less/bootstrap.less');
		//$this->load->less('style.less');

		$this->load->js('lib/jquery/jquery.min.js');
		$this->load->js('lib/less.min.js');
		$this->load->js('lib/jquery/jquery-migrate.min.js');
		$this->load->js('lib/bootstrap/js/bootstrap.min.js');
		$this->load->js('lib/typed.min.js');
		$this->load->js('lib/easing/easing.min.js');
		$this->load->js('lib/wow/wow.min.js');
		//$this->load->js('https://maps.googleapis.com/maps/api/js?key=AIzaSyD8HeI8o-c1NppZA-92oYlXakhDPYR7XMY');
		$this->load->js('lib/waypoints/waypoints.min.js');
		$this->load->js('lib/counterup/counterup.min.js');
		$this->load->js('lib/superfish/hoverIntent.js');
		$this->load->js('lib/superfish/superfish.min.js');
		$this->load->js('contactform/contactform.js');
		$this->load->js('https://platform.twitter.com/widgets.js');
		$this->load->js('js/main.js');
	}
	public function index()
	{
		$this->load->helper(array('text', 'date_format'));

		$data['list'] = $this->app_model->get_where('posting', array('type!='=>'Event PKBM', 'active'=>1), 4,1, 'id', 'DESC')->result(); // old data
		$data['feed'] = $this->app_model->get_all('posting')->result();
		$data['latest'] = $this->app_model->get_all('posting', 5, 0, 'id', 'DESC')->result(); 
		$data['slide'] = $this->app_model->get_where('posting', array('type!='=>'Event PKBM', 'active'=>1), 0, 0 , 'id', 'DESC')->result();

		$this->load->view('main-index', $data);
	}
	public function berita()
	{
		$this->load->helper(array('html', 'text', 'date_format'));

		/* list berita where all, UPT, arsip */
		if(!empty($this->input->get('string'))) {
			$data['list'] 					= $this->app_model->get_berita('posting', array('type'=>'article', 'active'=>1), $this->input->get('string'), 5, print_url(3), 'id', 'DESC')->result();
			$data['pagination']		= pagination('posting', 'like', $this->input->get('string'), array('type'=>'article', 'active'=>1), 3, 'berita/all', 5);
		} else {
			$data['list'] 					= $this->app_model->get_berita('posting', array('type'=>'article', 'active'=>1), $this->input->get('string'), 5, print_url(3), 'id', 'DESC')->result();
			$data['pagination']		= pagination('posting', 'where', '', array('type'=>'article', 'active'=>1), 3, 'berita/all', 5);
		}

		$data['head'] 				= 'Berita';
		$data['viewed'] 			= $this->app_model->get_where('posting', array('type'=>'article', 'active'=>1), 8, 0, 'view', 'DESC')->result();
		$data['arsip']				= $this->app_model->arsip()->result();
		
		$this->load->view('main-berita', $data);
	}
	public function agenda()
	{
		$this->load->helper(array('html', 'text', 'date_format'));

		/* list berita where all, UPT, arsip */

		$data['head'] 				= 'Agenda';
		$data['list'] 					= $this->app_model->get_where('posting', array('type'=>'agenda', 'active'=>1), 5, print_url(3), 'id', 'DESC')->result();
		$data['viewed'] 			= $this->app_model->get_where('posting', array('type'=>'article', 'active'=>1), 8, 0, 'view', 'DESC')->result();
		$data['arsip']				= $this->app_model->arsip()->result();
		$data['pagination']		= pagination('posting', 'where', array('type'=>'agenda', 'active'=>1), 3, 'agenda', 5);
		$this->load->view('main-berita', $data);
	}
	public function detail()
	{
		$this->load->helper('date_format');
		update_view(print_url(1));
		
		$kategori = print_data('get_where', array('posting', array('url'=>print_url(1))), 'category');
		$nama_ketegori = print_data('get_where', array('posting_category', array('id'=>$kategori)), 'name');

		$data['head'] 				= print_data('get_where', array('posting', array('url'=>print_url(1))), 'title');
		$data['viewed'] 			= $this->app_model->get_where('posting', array('type'=>'article', 'active'=>1), 8, 0, 'view', 'DESC')->result();
		$data['arsip']				= $this->app_model->arsip()->result();
		$data['detail'] = $this->app_model->get_where('posting', array('url'=>print_url(1)))->result();
		$this->load->view('main-detail', $data);
	}


	/* ppid/download */
	public function download()
	{
		$this->load->js('vendors/datatables.net/js/jquery.dataTables.min.js');
		$this->load->js('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js');
		$this->load->css('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css');
		$this->load->js('build/js/custom.min.js');
		$this->load->helper('url');

		$data['head'] 				= 'download';
		$data['list'] = $this->app_model->get_where('upload', array('type'=>'file', 'active'=>1))->result();
		$this->load->view('main-download', $data);
	}
	/* galeri/(:any) */
	public function galeri()
	{
		$this->load->css('lib/littlelightbox/src/jquery.littlelightbox.css');
		$this->load->js('lib/littlelightbox/src/jquery.littlelightbox.js');

		switch (print_url(2)) {
			case 'dinas':
				$data['head'] = 'Galeri Kegiatan Dinas';
				$data['list'] = $this->app_model->get_where('upload', array('type'=>'images'))->result();
				break;
			case 'video':
				$data['head'] = 'Galeri Video';
				$data['list'] = $this->app_model->get_where('upload', array('type'=>print_url(2)))->result();
				break;
			default:
				# code...
				break;
		}
		
		$this->load->view('main-galeri', $data);
	}




	public function kategori()
	{
		$this->load->helper(array('text', 'date_format'));
		$id = print_data('get_where', array('posting_category', array('name'=>print_url(1))), 'id');
		$data['feed'] = $this->app_model->get_all('posting')->result();
		$data['list'] = $this->app_model->get_where('posting', array('category='=>$id), 5, print_url(2), 'id', 'DESC')->result();
		$this->load->view('main-category', $data);
	}
	public function page()
	{
		$this->load->helper('date_format');

		$data['active'] = print_url(1);
		$data['feed'] = $this->app_model->get_all('posting')->result();
		$data['detail'] = $this->app_model->get_where('posting', array('url'=>print_url(1)))->result();
		$this->load->view('main-page', $data);
	}
	public function polling()
	{
		$data = array('ip'=>print_ip(),
			'date'=>date('Y-m-d H:i:s'),
			'poliing'=>1,
			'pilihan'=>$this->input->post('pilihan'));
		$this->app_model->add_field('polling_hasil', $data);
		redirect('','refresh');
	}
	public function saran()
	{
		$data = array('id'=>$this->app_model->create_id('saran'),
			'email'=>$this->input->post('email'),
			'nama'=>$this->input->post('nama'),
			'date'=>date('Y-m-d H:i:s'),
			'content'=>$this->input->post('content'));

		$this->app_model->add_field('saran', $data);
		redirect('','refresh');
	}

}

/* End of file Main.php */
/* Location: ./application/controllers/Main.php */