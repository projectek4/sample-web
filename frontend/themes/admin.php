<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Gentelella Alela! | </title>
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

	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				<!-- left menu -->
				<div class="col-md-3 left_col">
					<div class="left_col scroll-view">
						<div class="navbar nav_title" style="border: 0;">
							<a href="index.html" class="site_title"><!--<?= html_media('3aae5c075cb2878336faf4f8592bde3c_logo_grobogan_kab.png', 'sidebar-logo')?> --><span>DISKOMINFO</span></a>
						</div>
						<div class="clearfix"></div>
						<!-- menu profile quick info -->
						<div class="profile clearfix">
							<div class="profile_pic">
								<?= html_media('team-4.jpg', 'img-circle profile_img') ?>
							</div>
							<div class="profile_info">
								<span>Selamat Datang,,</span>
								<h2><?= print_session('nama') ?></h2>
							</div>
						</div>
						<!-- /menu profile quick info -->
						<br />
						<!-- sidebar menu -->
						<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
							<?php if (print_session('level') == 1): ?>
							<div class="menu_section">
								<h3>Administrator</h3>
								<ul class="nav side-menu">
									<?= nav_menu('admin/', fontawesome('home').' Dashboard') ?>
									<li><a><i class="fa fa-pencil"></i> Posting <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<?= nav_menu('admin/artikel/kategori', 'Kategori Berita') ?>
										<?= nav_menu('admin/artikel/berita', 'Berita') ?>
										<?= nav_menu('admin/artikel/halaman', 'Halaman Informasi') ?>
										<?= nav_menu('admin/artikel/agenda', 'Agenda') ?>
										</ul>
									</li>
									<li><a><i class="fa fa-file"></i> Media <span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu">
											<?= nav_menu('admin/media/foto', 'Foto Kegiatan') ?>
											<?= nav_menu('admin/media/video', 'Video Multimedia') ?>
											<?= nav_menu('admin/media/berkas', 'Berkas Info Publik') ?>
										</ul>
									</li>
									<li><a><i class="fa fa-child"></i> Aspirasi Masyarakat <span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu">
											<?= nav_menu('admin/kotak/kuesioner', 'Kuesioner') ?>
											<?= nav_menu('admin/kotak/saran', 'Kotak Saran') ?>
										</ul>
									</li>
								</ul>
							</div>
							<div class="menu_section">
								<h3>Lain-lain</h3>
								<ul class="nav side-menu">
									<?= nav_menu('admin/pengguna/daftar', fontawesome('user').' Manajemen Pengguna') ?>
									<?= nav_menu('admin/website', fontawesome('cog').' Manajemen Website') ?>
								</ul>
							</div>
							<?php else: ?>
							<div class="menu_section">
								<h3>Administrator</h3>
								<ul class="nav side-menu">
									<?= nav_menu('admin/', fontawesome('home').' Dashboard') ?>
									<li><a><i class="fa fa-pencil"></i> Posting <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<?= nav_menu('admin/artikel/berita', 'Berita') ?>
										</ul>
									</li>
								</ul>
							</div>
							<?php endif ?>
						</div>
						<!-- /sidebar menu -->
						<!-- /menu footer buttons -->
						<div class="sidebar-footer hidden-small">
						<a data-toggle="tooltip" data-placement="top" title="Settings">
							<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
						</a>
						<a data-toggle="tooltip" data-placement="top" title="FullScreen">
							<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
						</a>
						<a data-toggle="tooltip" data-placement="top" title="Lock">
							<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
						</a>
						<a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
							<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
						</a>
						</div>
						<!-- /menu footer buttons -->
					</div>
				</div>


				<!-- top navigation -->
				<div class="top_nav">
					<div class="nav_menu">
						<nav>
							<div class="nav toggle"><a id="menu_toggle"><i class="fa fa-bars"></i></a></div>
							<ul class="nav navbar-nav navbar-right">
								<li class="">
									<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										<img src="images/img.jpg" alt=""><?= print_session('nama') ?>
										<span class=" fa fa-angle-down"></span>
									</a>
									<ul class="dropdown-menu dropdown-usermenu pull-right">
										<?= nav_menu('admin/profil','Ubah Profil') ?>
										<?= nav_menu('logout.php', fontawesome('sign-out pull-right').' Logout') ?>
									</ul>
								</li>
								<!--<li role="presentation" class="dropdown">
									<a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
										<i class="fa fa-envelope-o"></i>
										<span class="badge bg-green">6</span>
									</a>
									<ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
										<li>
											<a>
												<span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
												<span>
													<span>John Smith</span>
													<span class="time">3 mins ago</span>
												</span>
												<span class="message">
													Film festivals used to be do-or-die moments for movie makers. They were where...
												</span>
											</a>
										</li>
										<li>
											<a>
												<span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
												<span>
													<span>John Smith</span>
													<span class="time">3 mins ago</span>
												</span>
												<span class="message">
													Film festivals used to be do-or-die moments for movie makers. They were where...
												</span>
											</a>
										</li>
										<li>
											<a>
												<span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
												<span>
													<span>John Smith</span>
													<span class="time">3 mins ago</span>
												</span>
												<span class="message">
													Film festivals used to be do-or-die moments for movie makers. They were where...
												</span>
											</a>
										</li>
										<li>
											<a>
												<span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
												<span>
													<span>John Smith</span>
													<span class="time">3 mins ago</span>
												</span>
												<span class="message">
													Film festivals used to be do-or-die moments for movie makers. They were where...
												</span>
											</a>
										</li>
										<li>
											<div class="text-center">
												<a>
													<strong>See All Alerts</strong>
													<i class="fa fa-angle-right"></i>
												</a>
											</div>
										</li>
									</ul>
								</li>-->
							</ul>
						</nav>
					</div>
				</div>
				<!-- /top navigation -->

				<!-- page content -->
				<div class="right_col" role="main">
					<div class="page-title">
						<div class="title_left"><h3><?= $heading ?></h3></div>
					</div>
					<div class="clearfix"></div>
				<?= $output ?>
				</div>
				<!-- /page content -->
		
				<!-- footer content -->
				<footer>
				<div class="pull-right">
					Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
				</div>
				<div class="clearfix"></div>
				</footer>
				<!-- /footer content -->
			</div>
		</div>

		<!-- end of Js Section -->
		<?php
			foreach ($js as $file) {
				echo '<script src="'.$file.'"></script>';
			}
		?>
	
	</body>
</html>
