<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?= $title; ?></title>
		<!-- Le fav and touch icons -->
		<?= html_favicon() ?>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta content="" name="keywords">
		<meta content="" name="description">
		<?php
		/** -- Copy from here -- */
		if(!empty($meta))
		foreach($meta as $name=>$content){
			echo "\n\t\t";
			?><meta name="<?= $name; ?>" content="<?= $content; ?>" /><?php
		}
		echo "\n\t";

		foreach($less as $file){
			echo "\n\t\t";
			?><link rel="stylesheet" href="<?= $file; ?>" type="text/less" /><?php
		} echo "\n\t";  

		foreach($css as $file){
			echo "\n\t\t";
			?><link rel="stylesheet" href="<?= $file; ?>" type="text/css" /><?php
		} echo "\n\t";

		/** -- to here -- */

		
		echo "\n\t\t"; ?>

	</head>

	<body>
		<!--<header id="top_header">

		</header>-->
		<header id="header">
			<div class="container">
				<div id="logo" class="pull-left">
					<a href="#hero"><?= html_media('logo.png') ?></a>
					<!-- Uncomment below if you prefer to use a text logo -->
					<!--<h1><a href="#hero">Regna</a></h1>-->
				</div>
				<nav id="nav-menu-container">
					<ul class="nav-menu">
						<?= nav_menu('', 'beranda') ?>
						<li class="menu-has-children"><?= anchor('#', 'profil') ?>
							<ul>
								<?= nav_menu('visi&misi.html', 'visi & misi') ?>
								<?= nav_menu('struktur-organisasi.html', 'struktur organisasi') ?>
								<?= nav_menu('tugas-pokok&fungsi.html', 'tugas pokok & fungsi') ?>
								<?= nav_menu('daftar-pejabat.html', 'daftar pejabat') ?>
								<?= nav_menu('maklumat-pelayanan.html', 'maklumat pelayanan') ?>
							</ul>
						</li>
						<li class="menu-has-children"><?= anchor('#', 'berita') ?>
							<ul>
								<?= nav_menu('berita/all', 'semua berita') ?>
								<?= nav_menu('berita/upta', 'UPT A') ?>
								<?= nav_menu('berita/uptb', 'UPT B') ?>
							</ul>
						</li>
						<li class="menu-has-children"><?= anchor('#', 'program kegiatan') ?>
							<ul>
								<?= nav_menu('agenda', 'agenda kerja') ?>
								<?= nav_menu('daftar-program-kegiatan.html', 'daftar program kegiatan') ?>
								<?= nav_menu('jadual-program-kegiatan.html', 'jadual program kegiatan') ?>
								<?= nav_menu('laporan-kerja.html', 'laporan kerja') ?>
								<?= nav_menu('rencana-kerja-2018.html', 'rencana kerja tahun 2018') ?>
							</ul>
						</li>
						<li class="menu-has-children"><?= anchor('', 'galeri') ?>
							<ul>
								<?= nav_menu('galeri/dinas', 'kegiatan dinas') ?>
								<?= nav_menu('galeri/rapat', 'rapat koordinasi') ?>
								<?= nav_menu('galeri/kunjungan', 'kunjungan kerja') ?>
								<?= nav_menu('galeri/kegiatan', 'kegiatan perayaan') ?>
								<?= nav_menu('galeri/video', 'video') ?>
								<?= nav_menu('galeri/lain', 'foto lain-lain') ?>
							</ul>
						</li>
						<li class="menu-has-children"><?= anchor('#', 'ppid') ?>
							<ul>
								<?= nav_menu('informasi-publik.html', 'informasi publik') ?>
								<?= nav_menu('sop-pelayanan-publik.html', 'SOP pelayanan publik') ?>
								<?= nav_menu('ppid/download', 'download') ?>
							</ul>
						</li>
						<!--<?= nav_menu('', 'kontak') ?>-->
						<!--<?= nav_menu('#', 'cari '.fontawesome('search')) ?>-->
					</ul>
				</nav>
			</div>
		</header>




		
		<?php if (is_home()): ?>
		<section id="hero" style="height: 100vh;">
		<?php else: ?>
		<section id="hero" style="height: 250px; margin-bottom: 40px">
		<?php endif ?>
			<div class="hero-container">
				<?php if (is_home()): ?>
					<?= html_media('3aae5c075cb2878336faf4f8592bde3c_logo_grobogan_kab.png', 'banner-logo') ?>
				<h1>Selamat Datang di Website Resmi</h1>
				<h2>Dinas Komunikasi & Informatika Kabupaten Grobogan</h2>
				<div class="row">
					<div class="col-md-12">
						<div class="input-group">
							<form method="GET" action="<?=  base_url('berita/cari') ?>">
							<input name="string" type="text" class="form-control input-lg" placeholder="Ketik untuk mencari">
							<span class="input-group-btn" style="display: inherit;">
								<button class="btn btn-secondary" type="submit"><?= fontawesome('search') ?></button>
							</span>
							</form>
						</div>
					</div>
				</div>
				<div class='row'>
					<div class='col-md-12 running-text'>
						<h3>Update Diskominfo:</h3>
					<div class="newsticker"></div>
					</div>
				</div>
				<?php else: ?>
					<div class="col-md-8"><h1><?= $head ?></h1></div>
				
				<?php endif ?>
			</div>
		</section>


				<main id="main">
					<?= $output ?>

<section id="contact">
	<div class="container wow fadeInUp">
		<div class="row justify-content-center">
			<div class="col-md-3">
				<h3>Alamat Kontak</h3>
				<div class="info">
					<div><?= website('alamat_satu') ?></div>
					<div><?= website('alamat_dua') ?></div>
					<div><?= website('alamat_tiga') ?></div>
				</div>
				<div class="social-links" style="margin-top: 30px">
					<?= website('jejaring') ?>
				</div>
			</div>
			<div class="col-md-3">
				<h3>Jejaring Sosial</h3>
				<a class="twitter-timeline" data-lang="id" data-height="300" href="https://twitter.com/In_Donnie_sia?ref_src=twsrc%5Etfw">Tweets by In_Donnie_sia</a>
			</div>
			<div class="col-md-3">
				<h3>Kuesioner</h3>
				<?= polling() ?>
				<a href="https://info.flagcounter.com/Rm83"><img src="https://s11.flagcounter.com/count2/Rm83/bg_FFFFFF/txt_000000/border_CCCCCC/columns_2/maxflags_10/viewers_0/labels_0/pageviews_1/flags_0/percent_0/" alt="Flag Counter" border="0"></a>
			</div>
			<div class="col-md-3">
				<h3>Kotak Saran</h3>
				<div class="form">
					<div id="sendmessage">Your message has been sent. Thank you!</div>
					<div id="errormessage"></div>
					<form action="<?= base_url('main/saran') ?>" method="post" role="form" class="">
						<div class="form-group">
							<input type="text" name="nama" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars"  required/>
							<div class="validation"></div>
						</div>
						<div class="form-group">
							<input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email"  required/>
							<div class="validation"></div>
						</div>
						<div class="form-group">
							<textarea class="form-control" name="content" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message" required></textarea>
							<div class="validation"></div>
						</div>
						<div class="text-center"><button class="btn btn-block" type="submit">Send Message</button></div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
											</main>
										
<footer id="footer">
	<div class="footer-top">
		<div class="container">
		</div>
	</div>
	<div class="container">
		<div class="copyright">
			<?= website('footer') ?>
		</div>
		<div class="credits">
			<!--
			All the links in the footer should remain intact.
			You can delete the links only if you purchased the pro version.
			Licensing information: https://bootstrapmade.com/license/
			Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Regna
			-->
			Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
		</div>
	</div>
</footer>
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

		<!-- end of Js Section -->
		<?php
			foreach ($js as $file) {
				echo '<script src="'.$file.'"></script>';
			}
		?>
		<script type="text/javascript">
		var typed = new Typed('.newsticker', {
			strings: [<?= news_ticker() ?>],
			typeSpeed: 30,
			typeSpeed: 30,
			loop: true,
			cursorChar: ' _',
			backDelay: 500,
			startDelay: 1000,
		});
		</script>
<script>
$( document ).ready(function() {
	$( ".lightbox" ).click(function(event) {
		event.preventDefault()
	});
});
$('.lightbox').littleLightBox();
</script>


<!--Start of Tawk.to Script-->
<!--<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5b558142e21878736ba23598/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>-->
<!--End of Tawk.to Script-->
	</body>
</html>
