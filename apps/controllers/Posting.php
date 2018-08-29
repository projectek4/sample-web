<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posting extends CI_Controller {
	
	function __construct()
	{
		error_reporting(0);
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		
		$this->load->database();
		$this->load->helper(array('html', 'app', 'url'));
		$this->load->model('app_model');
		$this->_init();
	}
	private function _init()
	{
		if(!is_login())
			redirect('login/index','refresh');

		$this->output->set_template('posting');

		meta(array('http-equiv'=>'X-UA-Compatible', 'content'=>'IE-edge'));
		meta('viewport', 'width=device-width, initial-scale=1');
		meta('resource-type', 'document');
		meta('robots', 'all, index, follow');
		meta('googleboot', 'all, index, follow');

		$this->load->css('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css');
		$this->load->css('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
		$this->load->less('admin/bootstrap.less');
		$this->load->js('https://code.jquery.com/jquery-2.x-git.min.js');
		$this->load->js('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js');
		$this->load->js('bootstrap.min.js');
		$this->load->js('https://cdnjs.cloudflare.com/ajax/libs/less.js/2.7.2/less.min.js');

		
	}
	/* ckeditor config */
	function editor($width,$height) {
		$this->ckeditor->basePath 					= base_url('assets/ckeditor/');
		$this->ckeditor->config['toolbar']	= 'Basic';
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor->config['width'] 		= $width;
		$this->ckeditor->config['height'] 	= $height;

		/* edit config.php di assets/ckfinder/config.php line 64 */
		
		$this->ckfinder->SetupCKEditor($this->ckeditor, '../assets/ckfinder');
	}
	public function index()
	{
		if(empty(print_url(3)))
			$page = 0;
		else
			$page = print_url(3);

		if(empty($this->input->get('category')) OR $this->input->get('category') == 'all')
			$category = '';
		else
			$category = $this->input->get('category');

		if(empty($this->input->get('string')))
			$string = '';
		else
			$string = $this->input->get('string');

		if(empty($this->input->get('order')))
			$order = '';
		else
			$order = $this->input->get('order');

		$data['total'] = $this->app_model->count_rows('posting', 'where', array('active'=>1));
		$data['list'] = $this->app_model->article('', $category, 1, $string, $page, $order)->result();
		$this->load->view('posting-index', $data);
	}
	public function draft()
	{
		if(empty(print_url(3)))
			$page = 0;
		else
			$page = print_url(3);

		if(empty($this->input->get('category')) OR $this->input->get('category') == 'all')
			$category = '';
		else
			$category = $this->input->get('category');

		if(empty($this->input->get('string')))
			$string = '';
		else
			$string = $this->input->get('string');

		$data['total'] = $this->app_model->count_rows('posting', 'where', array('active'=>1));
		$data['list'] = $this->app_model->article('', $category, 2, $string, $page)->result();
		$this->load->view('posting-draft', $data);
	}
	public function detail()
	{
		$this->output->unset_template();

		$data['detail'] = $this->app_model->get_where('posting', array('id'=>print_url(3)))->result();
		$this->load->view('posting-detail', $data);
	}
	public function add()
	{
		$this->load->library(array('form_validation', 'ckeditor', 'ckfinder'));
		$this->load->helper(array('form', 'bootstrap', 'stemming'));

		$this->form_validation->set_rules('title', 'judul artikel', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('content', 'konten artikel', 'trim|required|min_length[5]');
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

		$width 	= '100%';
		$height = '500px';
		$this->editor($width,$height);
		
		if ($this->form_validation->run() == TRUE) {
			$id = $this->app_model->create_id('posting');
			$data = array();
			$data['id']							= $id;
			$data['date_posting'] 	= date('Y-m-d H:i:s');
			$data['date_modified'] 	= date('Y-m-d H:i:s');
			$data['author'] 				= 'PKBM';
			$data['type'] 					= 'Artikel';
			$data['content'] 				= $this->input->post('content');
			$data['url'] 						= str_replace(' ', '-', word_limit($this->input->post('title'), 5)).'.html';
			$data['title'] 					= $this->input->post('title');

			$pisah 	= strtolower(strip_tags($this->input->post('content')));
			$pisah 	= preg_replace("/[^a-zA-Z]+/", " ", $pisah);
			$array 	= explode(' ', $pisah);
			$array 	= array_unique($array);
			$jumlah = count($array);

			/* gambar */
			if (strpos($this->input->post('content'), 'src="') != FALSE) {
				$img 		= explode('src="', $this->input->post('content'));
				$img_2 	= explode('"', $img[1]);
				$data['media'] = $img_2[0];

				$this->app_model->add_field('media', array('media'=>$img_2[0], 'article'=>$id));
			} else {
				$data['media'] = base_url('assets/media/images/default.jpg');
			}

			
			/* array artikel */
			$data['kata'] = $jumlah;
			$artikel = array();
			foreach ($array as $key => $value) {
				$artikel[] = stemmingArifin($value);
			}

			/* mencari kategori */
			$utama = array();
			$pendidikan = array();
			foreach ($this->app_model->get_where('tag', array('category'=>1))->result() as $print) {
				$pendidikan[] = $print->value;
			}
			$utama[1] = count(array_intersect($artikel, $pendidikan));
			$data['pendidikan'] = count(array_intersect($artikel, $pendidikan));

			$olahraga = array();
			foreach ($this->app_model->get_where('tag', array('category'=>2))->result() as $print) {
				$olahraga[] = $print->value;
			}
			$utama[2] = count(array_intersect($artikel, $olahraga));
			$data['olahraga'] = count(array_intersect($artikel, $olahraga));
			

			$kebudayaan = array();
			foreach ($this->app_model->get_where('tag', array('category'=>3))->result() as $print) {
				$kebudayaan[] = $print->value;
			}
			$utama[3] = count(array_intersect($artikel, $kebudayaan));
			$data['kebudayaan'] = count(array_intersect($artikel, $kebudayaan));
			

			$iptek = array();
			foreach ($this->app_model->get_where('tag', array('category'=>4))->result() as $print) {
				$iptek[] = $print->value;
			}
			$utama[4] = count(array_intersect($artikel, $iptek));
			$data['iptek'] = count(array_intersect($artikel, $iptek));



			arsort($utama);
			$hasil = array_keys($utama);
			
			if($utama[1]==$utama[2] || $utama[1]==$utama[3] || $utama[1]==$utama[4] || $utama[2]==$utama[3] || $utama[3]==$utama[4]) {
				$arrr = array($utama[1], $utama[2], $utama[3], $utama[4]);
				rsort($arrr);
				//print_r($arrr);
				//echo $arrr[0];
				$jumlaharray= array_count_values($arrr);
				//echo $jumlaharray[$arrr[0]];
				//print_r(array_count_values($arrr));
				if($jumlaharray[$arrr[0]] > 1) {
					//$data['active'] = 2;
					$data['category'] =  0;
				}
			} else {
				$data['category'] =  $hasil[0];
			}


			if($this->input->post('draft') == 1)
				$data['active'] = 2;

			$this->app_model->add_field('posting', $data);
			redirect('posting/index','refresh');
		} else {
			//$data['ckeditor'] = $this->ckeditor->editor('content', html_entity_decode(set_value('content')));
			$this->load->view('posting-add');
		}
	}
	public function import()
	{
		$this->load->library(array('form_validation', 'ckeditor', 'ckfinder'));
		$this->load->helper(array('form', 'bootstrap', 'stemming'));

		$this->form_validation->set_rules('title', 'judul artikel', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('content', 'konten artikel', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('author', 'sumber artikel', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

		$width 	= '100%';
		$height = '500px';
		$this->editor($width,$height);
		
		if ($this->form_validation->run() == TRUE) {
			$id = $this->app_model->create_id('posting');
			$data = array();
			$data['id']							= $id;
			$data['date_posting'] 	= date('Y-m-d H:i:s');
			$data['date_modified'] 	= date('Y-m-d H:i:s');
			$data['author'] 				= $this->input->post('author');
			$data['type'] 					= 'Artikel luar';
			$data['content'] 				= $this->input->post('content');
			$data['url'] 						= str_replace(' ', '-', word_limit($this->input->post('title'), 5)).'.html';
			$data['title'] 					= $this->input->post('title');

			$pisah 	= strtolower(strip_tags($this->input->post('content')));
			$pisah 	= preg_replace("/[^a-zA-Z]+/", " ", $pisah);
			$array 	= explode(' ', $pisah);
			$array 	= array_unique($array);
			$jumlah = count($array);

			/* gambar */
			if (strpos($this->input->post('content'), 'src="') != FALSE) {
				$img 		= explode('src="', $this->input->post('content'));
				$img_2 	= explode('"', $img[1]);
				$data['media'] = $img_2[0];

				$this->app_model->add_field('media', array('media'=>$img_2[0], 'article'=>$id));
			} else {
				$data['media'] = base_url('assets/media/images/default.jpg');
			}

			/* array artikel */
			$data['kata'] = $jumlah;
			$artikel = array();
			foreach ($array as $key => $value) {
				$artikel[] = stemmingArifin($value);
			}

			/* mencari kategori */
			$utama = array();
			$pendidikan = array();
			foreach ($this->app_model->get_where('tag', array('category'=>1))->result() as $print) {
				$pendidikan[] = $print->value;
			}
			$utama[1] = count(array_intersect($artikel, $pendidikan));
			$data['pendidikan'] = count(array_intersect($artikel, $pendidikan));

			$olahraga = array();
			foreach ($this->app_model->get_where('tag', array('category'=>2))->result() as $print) {
				$olahraga[] = $print->value;
			}
			$utama[2] = count(array_intersect($artikel, $olahraga));
			$data['olahraga'] = count(array_intersect($artikel, $olahraga));
			

			$kebudayaan = array();
			foreach ($this->app_model->get_where('tag', array('category'=>3))->result() as $print) {
				$kebudayaan[] = $print->value;
			}
			$utama[3] = count(array_intersect($artikel, $kebudayaan));
			$data['kebudayaan'] = count(array_intersect($artikel, $kebudayaan));
			

			$iptek = array();
			foreach ($this->app_model->get_where('tag', array('category'=>4))->result() as $print) {
				$iptek[] = $print->value;
			}
			$utama[4] = count(array_intersect($artikel, $iptek));
			$data['iptek'] = count(array_intersect($artikel, $iptek));
			

			arsort($utama);
			$hasil = array_keys($utama);

			if($utama[1]==$utama[2] || $utama[1]==$utama[3] || $utama[1]==$utama[4] || $utama[2]==$utama[3] || $utama[3]==$utama[4]) {
				/*$arrr = array($utama[1], $utama[2], $utama[3], $utama[4]);
				rsort($arrr);
				print_r($arrr);
				echo $arrr[0];
				$jumlaharray= array_count_values($arrr);
				echo $jumlaharray[$arrr[0]];
				print_r(array_count_values($arrr));
				if($jumlaharray[$arrr[0]] > 1) {
					$data['active'] = 2;
					$data['category'] =  0;
				}*/
				$arrr = array($utama[1], $utama[2], $utama[3], $utama[4]);
				rsort($arrr);
				//echo $arrr[0];
				//echo '</br>';
				$jumlaharray= array_count_values($arrr);
				//echo $jumlaharray[$arrr[0]];
				//echo '</br>';
				if($hasil[0] > $hasil[1] || $hasil[0] > $hasil[2] || $hasil[0] > $hasil[3]) {
					if($jumlaharray[$arrr[0]] < 2)
						if($hasil[0] < 5) {
							$data['category'] = $hasil[0];
							//$data['active'] = 5;
						} else {
							$data['category'] = $hasil[0];
						}
					else {
						$data['category'] = 0;
						$data['active'] = 2;
					}
				}
			} else {
				$data['category'] =  $hasil[0];
			}


			if($this->input->post('draft') == 1)
				$data['active'] = 2;

			/*if (array_values($utama)[0] < 5) {
				$data['category'] = 0;
			} else {
				$data['category'] =  $hasil[0]; //hasil perhitungan
			}*/


			$this->app_model->add_field('posting', $data);
			redirect('posting/index','refresh');
		} else {
			//$data['ckeditor'] = $this->ckeditor->editor('content', html_entity_decode(set_value('content')));
			$this->load->view('posting-import');
		}
	}
	public function event()
	{
		$this->load->library(array('form_validation', 'ckeditor', 'ckfinder'));
		$this->load->helper(array('form', 'bootstrap', 'stemming'));

		$this->form_validation->set_rules('title', 'judul event', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('content', 'konten event', 'trim|required|min_length[5]');
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

		$width 	= '100%';
		$height = '500px';
		$this->editor($width,$height);
		
		if ($this->form_validation->run() == TRUE) {
			$data = array();
			$data['id']							= $this->app_model->create_id('posting');
			$data['date_posting'] 	= date('Y-m-d H:i:s');
			$data['date_modified'] 	= date('Y-m-d H:i:s');
			$data['author'] 				= 1;
			$data['type'] 					= 'Event PKBM';
			$data['content'] 				= $this->input->post('content');
			$data['url'] 						= str_replace(' ', '-', word_limit($this->input->post('title'), 5)).'.html';
			$data['title'] 					= $this->input->post('title');

			$pisah 	= strtolower(strip_tags($this->input->post('content')));
			$pisah 	= preg_replace("/[^a-zA-Z]+/", " ", $pisah);
			$array 	= explode(' ', $pisah);
			$array 	= array_unique($array);
			$jumlah = count($array);

			/* gambar */
			if (strpos($this->input->post('content'), 'src="') != FALSE) {
				$img 		= explode('src="', $this->input->post('content'));
				$img_2 	= explode('"', $img[1]);
				$data['media'] = $img_2[0];
			} else {
				$data['media'] = base_url('assets/media/images/default.jpg');
			}

				/* array artikel */
			$data['kata'] = $jumlah;
			$artikel = array();
			foreach ($array as $key => $value) {
				$artikel[] = stemmingArifin($value);
			}

			/* mencari kategori */
			$utama = array();
			$pendidikan = array();
			foreach ($this->app_model->get_where('tag', array('category'=>1))->result() as $print) {
				$pendidikan[] = $print->value;
			}
			$utama[1] = count(array_intersect($artikel, $pendidikan));
			$data['pendidikan'] = count(array_intersect($artikel, $pendidikan));

			$olahraga = array();
			foreach ($this->app_model->get_where('tag', array('category'=>2))->result() as $print) {
				$olahraga[] = $print->value;
			}
			$utama[2] = count(array_intersect($artikel, $olahraga));
			$data['olahraga'] = count(array_intersect($artikel, $olahraga));
			

			$kebudayaan = array();
			foreach ($this->app_model->get_where('tag', array('category'=>3))->result() as $print) {
				$kebudayaan[] = $print->value;
			}
			$utama[3] = count(array_intersect($artikel, $kebudayaan));
			$data['kebudayaan'] = count(array_intersect($artikel, $kebudayaan));
			

			$iptek = array();
			foreach ($this->app_model->get_where('tag', array('category'=>4))->result() as $print) {
				$iptek[] = $print->value;
			}
			$utama[4] = count(array_intersect($artikel, $iptek));
			$data['iptek'] = count(array_intersect($artikel, $iptek));



			arsort($utama);
			$hasil = array_keys($utama);
			
			if($utama[1]==$utama[2] || $utama[1]==$utama[3] || $utama[1]==$utama[4] || $utama[2]==$utama[3] || $utama[3]==$utama[4]) {
				$arrr = array($utama[1], $utama[2], $utama[3], $utama[4]);
				rsort($arrr);
				//print_r($arrr);
				//echo $arrr[0];
				$jumlaharray= array_count_values($arrr);
				//echo $jumlaharray[$arrr[0]];
				//print_r(array_count_values($arrr));
				if($jumlaharray[$arrr[0]] > 1) {
					//$data['active'] = 2;
					$data['category'] =  0;
				}
			} else {
				$data['category'] =  $hasil[0];
			}

			$this->app_model->add_field('posting', $data);
			redirect('posting/index','refresh');
		} else {
			//$data['ckeditor'] = $this->ckeditor->editor('content', html_entity_decode(set_value('content')));
			$this->load->view('posting-event');
		}
	}
	function edit()
	{
		$this->load->library(array('form_validation', 'ckeditor', 'ckfinder'));
		$this->load->helper(array('form', 'bootstrap', 'stemming'));

		$this->form_validation->set_rules('title', 'judul event', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('content', 'konten event', 'trim|required|min_length[5]');
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
		
		$width 	= '100%';
		$height = '500px';
		$this->editor($width,$height);
		if ($this->form_validation->run()) {
			$id = array('id'=>$this->input->post('id'));
			
			$data['title'] = $this->input->post('title');
			$data['content'] = $this->input->post('content');
			$data['date_modified'] = date('Y-m-d H:i:s');
			$data['active'] = 1;

			$pisah 	= strtolower(strip_tags($this->input->post('content')));
			$pisah 	= preg_replace("/[^a-zA-Z]+/", " ", $pisah);
			$array 	= explode(' ', $pisah);
			$array 	= array_unique($array);
			$jumlah = count($array);

			/* gambar */
			if($this->app_model->check_exist('media', array('article'=>$this->input->post('id'))) == FALSE) {
				if (strpos($this->input->post('content'), 'src="') != FALSE) {
					$img 		= explode('src="', $this->input->post('content'));
					$img_2 	= explode('"', $img[1]);
					$data['media'] = $img_2[0];

					$this->app_model->add_field('media', array('media'=>$img_2[0], 'article'=>$this->input->post('id')));
				} else {
					$data['media'] = base_url('assets/media/images/default.jpg');
				}
			} else {
				if (strpos($this->input->post('content'), 'src="') != FALSE) {
					$img 		= explode('src="', $this->input->post('content'));
					$img_2 	= explode('"', $img[1]);
					$data['media'] = $img_2[0];

					$this->app_model->update_field('media', array('media'=>$img_2[0]), array('article'=>$this->input->post('id')));
				} else {
					$data['media'] = base_url('assets/media/images/default.jpg');
				}
			}


			/* array artikel */
			$data['kata'] = $jumlah;
			$artikel = array();
			foreach ($array as $key => $value) {
				$artikel[] = stemmingArifin($value);
			}

			/* mencari kategori */
			$utama = array();
			$pendidikan = array();
			foreach ($this->app_model->get_where('tag', array('category'=>1))->result() as $print) {
				$pendidikan[] = $print->value;
			}
			$utama[1] = count(array_intersect($artikel, $pendidikan));
			$data['pendidikan'] = count(array_intersect($artikel, $pendidikan));

			$olahraga = array();
			foreach ($this->app_model->get_where('tag', array('category'=>2))->result() as $print) {
				$olahraga[] = $print->value;
			}
			$utama[2] = count(array_intersect($artikel, $olahraga));
			$data['olahraga'] = count(array_intersect($artikel, $olahraga));
			

			$kebudayaan = array();
			foreach ($this->app_model->get_where('tag', array('category'=>3))->result() as $print) {
				$kebudayaan[] = $print->value;
			}
			$utama[3] = count(array_intersect($artikel, $kebudayaan));
			$data['kebudayaan'] = count(array_intersect($artikel, $kebudayaan));
			

			$iptek = array();
			foreach ($this->app_model->get_where('tag', array('category'=>4))->result() as $print) {
				$iptek[] = $print->value;
			}
			$utama[4] = count(array_intersect($artikel, $iptek));
			$data['iptek'] = count(array_intersect($artikel, $iptek));
			

			arsort($utama);
			$hasil = array_keys($utama);

			if($utama[1]==$utama[2] || $utama[1]==$utama[3] || $utama[1]==$utama[4] || $utama[2]==$utama[3] || $utama[3]==$utama[4]) {
				/*$arrr = array($utama[1], $utama[2], $utama[3], $utama[4]);
				rsort($arrr);
				print_r($arrr);
				echo $arrr[0];
				$jumlaharray= array_count_values($arrr);
				echo $jumlaharray[$arrr[0]];
				print_r(array_count_values($arrr));
				if($jumlaharray[$arrr[0]] > 1) {
					$data['active'] = 2;
					$data['category'] =  0;
				}*/
				$arrr = array($utama[1], $utama[2], $utama[3], $utama[4]);
				rsort($arrr);
				//echo $arrr[0];
				//echo '</br>';
				$jumlaharray= array_count_values($arrr);
				//echo $jumlaharray[$arrr[0]];
				//echo '</br>';
				if($hasil[0] > $hasil[1] || $hasil[0] > $hasil[2] || $hasil[0] > $hasil[3]) {
					if($jumlaharray[$arrr[0]] < 2)
						if($hasil[0] < 5) {
							$data['category'] = $hasil[0];
							//$data['active'] = 5;
						} else {
							$data['category'] = $hasil[0];
						}
					else {
						$data['category'] = 0;
						$data['active'] = 2;
					}
				}
			} else {
				$data['category'] =  $hasil[0];
			}

			$this->app_model->update_field('posting', $data, $id);
			redirect('posting/index','refresh');
		} else {
			$data['title'] = ($this->input->post('title')?set_value('title'):print_data('get_where', array('posting', array('id'=>print_url(3))), 'title'));
			$data['content'] = ($this->input->post('content')?set_value('content'):print_data('get_where', array('posting', array('id'=>print_url(3))), 'content'));
			$this->load->view('posting-edit', $data);
		}
	}
	function delete()
	{
		$this->app_model->delete_field('posting', array('id'=>print_url(3)));
		$this->app_model->delete_field('media', array('article'=>print_url(3)));
		redirect('posting/index','refresh');
	}
	public function profil()
	{
		$this->load->library(array('form_validation'));
		$this->load->helper(array('form', 'bootstrap'));

		$this->form_validation->set_rules('nama', 'nama admin', 'trim|required');
		if ($this->form_validation->run()) {
			$data = array('nama'=>$this->input->post('nama'),
				'username'=>$this->input->post('username'),
				'password'=>encrypt_this($this->input->post('password')));
			$id = array('id'=>print_session('id'));
			$this->app_model->update_field('user', $data, $id);
			redirect('posting/profil','refresh');
		} else {
			$data['detail'] = $this->app_model->get_where('user', array('id'=>print_session('id')))->result();
			$this->load->view('posting-profil', $data);
		}
	}
}

/* End of file posting.php */
/* Location: ./application/controllers/admin.php */