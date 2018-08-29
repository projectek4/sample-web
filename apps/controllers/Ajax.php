<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {
	function __construct()
	{
		error_reporting(0);
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		
		$this->load->database('stjm');
		$this->load->helper(array('html', 'app', 'url'));
		$this->load->model('app_model');
	}
	public function promo()
	{
		$data = $this->app_model->get_where('email', array('active'=>1), 1, 0)->result();
		foreach ($data as $print) {
$emailcontent =
'<body bgcolor="#F4F4F4">
	<table width="100%" cellpadding="0" cellspacing="0" style="min-width:100%;">
		<tr>
			<td width="100%" style="min-width:100%;padding:10px;">
				<center>
				<table class="container600" cellpadding="0" cellspacing="0" width="700" style="margin:0 auto;">
					<tr>
						<td width="100%" style="text-align:left;">
							<table width="100%" cellpadding="0" cellspacing="0" style="min-width:100%;">
								<tr>
									<td align="center" width="100%" style="min-width:100%;background-color:#FFFFFF;color:#000000;padding:30px;">
										<img alt="" src="http://mlayu.id/registrasi/assets/media/images/logo-event1.png" width="300" style="display: block;" />
									</td>
								</tr>
							</table>
							<table width="100%" cellpadding="0" cellspacing="0" style="min-width:100%;">
								<tr>
									<td width="100%" style="min-width:100%;background-color:#F8F7F0;color:#58585A;padding:0 30px 0 30px;">
										<h1 style="font-family:Arial;font-size:28px;line-height:35px;padding-top:10px;padding-bottom:10px;text-align: center;">Hadir kembali Lawu Trail Run 2018</h1>
									</td>
								</tr>
								<tr>
									<td align="center" width="100%" style="min-width:100%;background-color:#F8F7F0;color:#58585A;padding:0 50px 30px 50px;">
										<p style="font-family:Arial;font-size:12px;text-align: center;">Untuk anda yang pernah mengikuti Lawu Trail Run 2016, kami memberikan kode voucher spesial khusus untuk memperoleh potongan harga di event tahun ini.</p>
										<p style="font-family:Arial;font-size:12px;text-align: center;">Masukkan Kode Voucher "<b>KOMUNITAS</b>" saat kamu registrasi melalui <a href="http://lawutrailrun.com">www.lawutrailrun.com</a>. </p>
										<p style="font-family:Arial;font-size:12px;text-align: center;">Event akan dilaksanakan pada Minggu, 8 Juli 2018 dan pedaftaran akan ditutup pada 06 Mei 2018. Kami akan selalu menerima kritik dan saran yang membangun untuk terus melakukan perbaikan dalam event yang kami selenggarakan. Kami tunggu di garis start. Terimakasih</p>
									</td>
								</tr>
							</table>
							<table width="100%" cellpadding="0" cellspacing="0" style="min-width:100%;">
								<tr>
									<td width="100%" style="min-width:100%;padding:50px 0 0 30px;">
										<div style="position: relative; width: 100%;">
											<div style="float: right;"><img src="http://mlayu.id/registrasi/assets/media/images/email_footer.png" style="float:right; height: 70px; width: 70px"/></div>
											<div style="float: right; text-align: right; padding-right: 10px;">
												<p style="font-size: 14px; margin: 0;"><i style="font-size: 16px; font-weight: 700">MLYU</i> Running</p>
												<p style="margin: 0 0 5px 0; font-weight: 500">Camp Ayem</p>
												<p style="font-size: 11px; margin: 0">Jln. Guntur Gg. Guruh no. 08 RT 01/12, Ngasiman, Jebres, Surakarta</p>
												<p style="font-size: 11px; margin: 0">Hp. 0813 9342 6600 - Email:info@lawutrailrun.com - Instagram: lawutrailrun</p>
											</div>
										</div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				</center>
			</td>
		</tr>
	</table>
</body>';

		send_email($print->email, 'Informasi', $emailcontent, '', 'http://mlayu.id/registrasi/assets/media/images/email_sponsor_uber.jpeg', 'http://mlayu.id/registrasi/assets/media/images/promo_lawu_email.jpeg');
		$this->app_model->update_field('email', array('active'=>0), array('email'=>$print->email));
		redirect('ajax/promo','refresh');
		}
	}
	public function mail()
	{
		$email = array('defyakhusein@gmail.com', 'defy.husein@live.com', 'lawutrailrun@gmail.com', 'info@lawutrailrun.com', 'donieka8@gmail.com');
		
	
		for ($i=0; $i < count($email); ) { 
			send_email($email[$i++], 'Example broadcast', 'this email contant');
		}



	}
	public function get_bukti_trf()
	{
		$id = array('id'=>$this->input->post('id'));

		echo json_encode(array('file'=>base_url('assets/media/images/transfer/'.print_data('get_where', array(print_url(3), $id), 'bukti_transfer'))));
	}
	public function get_detail_reg()
	{
		$this->load->library('table');

		$template = array(
			'table_open'				=> '<table class="table table-bordered table-condensed table-responsive">',
			'thead_open'				=> '<thead>',
			'thead_close'				=> '</thead>',
			'heading_row_start'	=> '<tr>',
			'heading_row_end'		=> '</tr>',
			'heading_cell_start'=> '<th>',
			'heading_cell_end'	=> '</th>',
			'tbody_open'				=> '<tbody>',
			'tbody_close'				=> '</tbody>',
			'row_start'					=> '<tr>',
			'row_end'						=> '</tr>',
			'cell_start'				=> '<td>',
			'cell_end'					=> '</td>',
			'row_alt_start'			=> '<tr>',
			'row_alt_end'				=> '</tr>',
			'cell_alt_start'		=> '<td>',
			'cell_alt_end'			=> '</td>',
			'table_close'				=> '</table>'
		);
		$this->table->set_template($template);

		$this->table->set_heading('Kode Registrasi', 'Nama Peserta', 'Email', 'Date Registrasi', 'Date Bayar', 'Date ACC' ,'Status Pembayaran');
		foreach ($this->app_model->detail_registrasi('registrasi', array('registrasi.id'=>$this->input->post('id')))->result() as $print) {
			$this->table->add_row($print->$print->event.$print->tiket.$print->inv, $print->nama, $print->email, $print->date_booking, $print->date_bayar, $print->date_acc, $print->status);
		}

		echo json_encode(array('peserta'=>$this->table->generate()));
	}
	public function action_pembayaran()
	{
		//$id = array('id'=>$this->input->post('id'));

		/* email balasan konfirmasi atau ditolak */
		$id = $this->input->post('id');
		$event 		= print_data('get_where', array('registrasi', array('id'=>$id)), 'event');
		//kode tiket
		$tiket 		= print_data('get_where', array('registrasi', array('id'=>$id)), 'tiket');
		//nama peserta
		$nama 		= print_data('get_where', array('formulir_event2', array('id'=>$id)), 'nama');
		//bbid
		$kodereg 	= print_data('get_where', array('event', array('id'=>$event)), 'kode').print_data('get_where', array('tiket', array('id'=>$tiket)), 'kode').print_data('get_where', array('registrasi', array('id'=>print_url(3))), 'inv');

		/* email balasan */
		$emailcontent =
		'<body bgcolor="#F4F4F4">
			<table width="100%" cellpadding="0" cellspacing="0" style="min-width:100%;">
				<tr>
					<td width="100%" style="min-width:100%;padding:10px;">
						<center>
						<table class="container600" cellpadding="0" cellspacing="0" width="700" style="margin:0 auto;">
							<tr>
								<td width="100%" style="text-align:left;">
									<table width="100%" cellpadding="0" cellspacing="0" style="min-width:100%;">
										<tr>
											<td align="center" width="100%" style="min-width:100%;background-color:#FFFFFF;color:#000000;padding:30px;">
												<img alt="" src="http://mlayu.id/registrasi/assets/media/images/logo-event1.png" width="300" style="display: block;" />
											</td>
										</tr>
									</table>
									<table width="100%" cellpadding="0" cellspacing="0" style="min-width:100%;">
										<tr>
											<td width="100%" style="min-width:100%;background-color:#F8F7F0;color:#58585A;padding:0 30px 0 30px;">
												<h1 style="font-family:Arial;font-size:28px;line-height:30px;text-align:center;margin:0; margin-top:10px">Surat Pengambilan Paket Lomba</h1>
												<h1 style="font-family:Arial;font-size:28px;line-height:30px;text-align:center;margin:0; margin-bottom:10px">Lawu Trail Run 2018</h1>
												<p style="font-family:Arial;font-size:12px;margin:0;">Kode Registrasi</p>
												<p style="font-family:Arial;font-size:24px;margin:0;"><b>'.$kodereg.'</b></p>
												<p style="font-family:Arial;font-size:12px;margin:0;padding-bottom:0px">'.$nama.'</p>
												<p style="font-family:Arial;font-size:12px;">Terimakasih telah melakukan pendaftaran,</p>
											</td>
										</tr>
										<tr>
											<td align="center" width="100%" style="min-width:100%;background-color:#F8F7F0;color:#58585A;padding:0 50px 30px 50px;">
												<p style="font-family:Arial;font-size:12px;text-align: center;">Anda wajib MENCETAK ataupun MENUNJUKKAN email undangan pengambilan paket lomba ini kepada petugas di lokasi. Bawa identitas resmi Anda (KTP / KITAS / Paspor) pada saat pengambilan paket lomba. Sampai jumpa di Karanganayar!Tunjukkan kode registrasi untuk pengambilan racepack:</p>
											</td>
										</tr>
										<tr>
											<td align="center" width="100%" style="min-width:100%;background-color:#F8F7F0;color:#58585A;padding:0 50px 30px 50px;"><h1 style="font-family:Arial;font-size:35px;line-height:30px;text-align:center;margin-top:10px;margin-bottom:10px;">'.$kodereg.'</h1>
											</td>
										</tr>
										<tr>
											<td style="min-width:100%;background-color:#F8F7F0;color:#58585A;padding:0 50px 30px 50px;">
												<table width="100%" cellpadding="0" cellspacing="0" style="min-width:100%;">
													<tbody>
														<tr>
															<td style="border:1px solid #222; padding-right30px; padding-left:30px"><p style="font-family:Arial;font-size:12px;margin: 0">Kode Registrasi</p></td><td style="border:1px solid #222; padding-right30px; padding-left:30px"><p style="font-family:Arial;font-size:12px;margin: 0">: <b>'.$kodereg.'</b></p></td>
														</tr>
														<tr>
															<td style="border:1px solid #222; padding-right30px; padding-left:30px"><p style="font-family:Arial;font-size:12px;margin: 0">Nama Peserta</p></td><td style="border:1px solid #222; padding-right30px; padding-left:30px"><p style="font-family:Arial;font-size:12px;margin: 0">: '.print_data('get_where', array('formulir_event2', array('id'=>$id)), 'nama').'</td>
														</tr>
														<tr>
															<td style="border:1px solid #222; padding-right30px; padding-left:30px"><p style="font-family:Arial;font-size:12px;margin: 0">Nomor BIB</p></td><td style="border:1px solid #222; padding-right30px; padding-left:30px"><p style="font-family:Arial;font-size:12px;margin: 0">: '.print_data('get_where', array('registrasi', array('id'=>$id)), 'inv').'</td>
														</tr>
														<tr><td style="height:30px"></td></tr>
														<tr>
															<td style="border:1px solid #222; padding-right30px; padding-left:30px"><p style="font-family:Arial;font-size:12px;margin: 0">Racepack Venue</p></td><td style="border:1px solid #222; padding-right30px; padding-left:30px"><p style="font-family:Arial;font-size:12px;margin: 0">: Palur Plasa</td>
														</tr>
														<tr>
															<td style="border:1px solid #222; padding-right30px; padding-left:30px">Lokasi</td><td style="border:1px solid #222; padding-right30px; padding-left:30px">: Jalan Solo - Sragen No.1, Palur, Karanganyar, Surakarta</td>
														</tr>
														<tr>
															<td style="border:1px solid #222; padding-right30px; padding-left:30px">Tanggal</td>
															<td style="border:1px solid #222; padding-right30px; padding-left:30px">: Jumat, 06 Juli 2018 pukul 10.00- 20.00 WIB</td>
														</tr>
														<tr>
															<td></td>
															<td colspan="2" style="border:1px solid #222; padding-right30px; padding-left:30px">: Sabtu, 07 Juli 2018 pukul 10:00–18:00 WIB</td>
														</tr>
														<tr><td style="height:30px"></td></tr>
														<tr>
															<td style="border:1px solid #222; padding-right30px; padding-left:30px">Informasi:</td><td style="border:1px solid #222; padding-right30px; padding-left:30px"></td>
														</tr>
														<tr>
															<td colspan="2" style="border:1px solid #222; padding-right30px; padding-left:30px">
																<ol type="square" style="padding-left:0">
																	<li><p style="font-family:Arial;font-size:12px;text-align: left;"><i>Pastikan Anda mengambil paket lomba di waktu yang telah ditentukan. Kami tidak melayani pengambilan Racepack diluar waktu tersebut.</i></p></li>
																	<li><p style="font-family:Arial;font-size:12px;text-align: left;"><i>Para peserta yang masih dibawah umur 18 tahun pada saat perlombaan, diharuskan untuk membawa surat izin orang tua (parental consent letter).</i></p></li>
																	<li><p style="font-family:Arial;font-size:12px;text-align: left;"><i>Dengan mendaftar dan mengambil bagian dalam Lawu Trail Run 2018, Anda ("Peserta") menyatakan telah membaca, memahami, menerima, dan setuju untuk tunduk pada Syarat dan Ketentuan Lawu Trail Run 2018</i></p></li>
																</ol>
															</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
									</table>
									<table width="100%" cellpadding="0" cellspacing="0" style="min-width:100%;">
										<tr>
											<td width="100%" style="min-width:100%;padding:50px 0 0 30px;">
												<div style="position: relative; width: 100%;">
													<div style="float: right;"><img src="http://mlayu.id/registrasi/assets/media/images/email_footer.png" style="float:right; height: 70px; width: 70px"/></div>
													<div style="float: right; text-align: right; padding-right: 10px;">
														<p style="font-size: 14px; margin: 0;"><i style="font-size: 16px; font-weight: 700">MLYU</i> Running</p>
														<p style="margin: 0 0 5px 0; font-weight: 500">Camp Ayem</p>
														<p style="font-size: 11px; margin: 0">Jln. Guntur Gg. Guruh no. 08 RT 01/12, Ngasiman, Jebres, Surakarta</p>
														<p style="font-size: 11px; margin: 0">Hp. 0813 9342 6600 - Email:info@lawutrailrun.com - Instagram: lawutrailrun</p>
													</div>
												</div>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						</center>
					</td>
				</tr>
			</table>
		</body>';
		send_email(print_data('get_where', array('registrasi', array('id'=>$this->input->post('id'))), 'email'), 'Pembayaran', $emailcontent);
		//send_email('defyakhusein@gmail.com', 'Konfrimasi Pembayaran', 'Berhasil konfirmasi no Registrasi '.$kodereg.' atas nama: '.$nama);

		/* update status pembayaran menjadi 2 */
		$this->app_model->update_field('registrasi', array('status'=>$this->input->post('status'), 'date_acc'=>date('Y-m-d H:i:s')), array('id'=>$id));

		if($this->input->post('status') == 2)
			echo json_encode(array('status'=>'true', 'pesan'=>'Berhasil konfirmasi pembayaran'));
		else
			echo json_encode(array('status'=>'true', 'pesan'=>'Berhasil gagalkan pembayaran'));
		
	}
	public function action_login() {
		if(empty($this->input->post('username')) OR empty($this->input->post('password'))) {
			$return = array('status'=>'1', 'pesan'=>'Isi semua bidang form');
		} elseif($this->app_model->check_exist('user', array('username'=>$this->input->post('username'), 'active'=>1)) == FALSE) {
			$return = array('status'=>'1', 'pesan'=>'Username tidak ditemukan');
		} elseif($this->app_model->check_exist('user', array('username'=>$this->input->post('username'), 'active'=>1)) == TRUE and check_this($this->input->post('password'), print_data('get_where', array('user', array('username'=>$this->input->post('username'))), 'password')) == FALSE) {
			$return = array('status'=>'1', 'pesan'=>'Kata sandi salah');
		} else {
			add_session('id', print_data('get_where', array('user', array('username'=>$this->input->post('username'))), 'id'));
			add_session('nama', print_data('get_where', array('user', array('username'=>$this->input->post('username'))), 'nama'));
			$return = array('status'=>'3', 'pesan'=>'Berhasil Login');
		}
			echo json_encode($return);
	}
	public function action_logout()
	{
		remove_session('id');
		remove_session('nama');

		echo json_encode(array('status'=>1));
	}
}

/* End of file Ajax.php */
/* Location: ./application/controllers/Ajax.php */