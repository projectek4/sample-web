<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if (! function_exists('full_date'))
{
	function full_date($date)
	{
		$data 	= gmdate($date, time()+60*60*8);
		$format	= explode(" ",$data);

		$a 		= $format[0];
		$b 		= $format[1];
		$jam 	= explode(':', $b);

		if ($jam[0] < 12) {
			$ampm = 'AM';
			$jamm = $jam[0];
		}
		else {
			$ampm = 'PM';
			$jamm = $jam[0] - 12;
		}

		$a_ 		= explode('-', $a);
		$hari 	= hari($format[0]);
		$tgl 		= $a_[2];
		$bulan 	= bulan($a_[1]);
		$tahun 	= $a_[0];

		if(system_language() == 'en')
			return $hari.', '.$bulan.' '.$tgl.' '.$tahun.', '.$jamm.':'.$jam[1].' '.$ampm;
		else
			return $hari.', '.$tgl.' '.$bulan.' '.$tahun.' - '.$jam[0].':'.$jam[1];
	}
}

if (! function_exists('tanggal'))
{
	function tanggal($date)
	{
		$data 	= gmdate($date, time()+60*60*8);
		$format	= explode(" ",$data);

		$a 			= $format[0]; /* Tanggal */
		$b 			= $format[1];	/* Jam:menit:detik */

		$a_ 		= explode('-', $a); /* pecah tanggal */
		$hari 	= hari($format[0]); /* nama hari */
		$tgl 		= $a_[2];
		if( system_language() == 'en' ) { $bulan = bulan($a_[1]); } else { $bulan = bulan($a_[1]); };
		$tahun 		= $a_[0]; /* mendapatkan nilai tahun */

		return $tgl.' '.$bulan.' '.$tahun;
	}
}
if (! function_exists('short_tanggal'))
{
	function short_tanggal($date)
	{
		$data 	= gmdate($date, time()+60*60*8);
		$format	= explode(" ",$data);

		$a 			= $format[0]; /* Tanggal */
		$b 			= $format[1];	/* Jam:menit:detik */

		$a_ 		= explode('-', $a); /* pecah tanggal */
		$hari 	= hari($format[0]); /* nama hari */
		$tgl 		= $a_[2];
		if( system_language() == 'en' ) { $bulan = $a_[1]; } else { $bulan = $a_[1]; };
		$tahun 		= $a_[0]; /* mendapatkan nilai tahun */

		return $tgl.'/'.$bulan.'/'.$tahun;
	}
}

if (! function_exists('archive_month'))
{
	function archive_month($data)
	{
		$format	= explode("-",$data);




		return bulan($format[1]).' '.$format[0];
	}
}

if ( ! function_exists('bulan'))
{
	function bulan($bln)
	{
		if(system_language() == 'en') {
			switch ($bln) {
				case 1: 	return "January"; 	break;
				case 2: 	return "February"; 	break;
				case 3: 	return "March"; 		break;
				case 4: 	return "April"; 		break;
				case 5: 	return "May"; 			break;
				case 6: 	return "June"; 			break;
				case 7: 	return "July"; 			break;
				case 8: 	return "August"; 		break;
				case 9: 	return "September"; break;
				case 10: 	return "October"; 	break;
				case 11: 	return "November"; 	break;
				case 12: 	return "December"; 	break;
			}
		} else {
			switch ($bln) {
				case 1: 	return "Januari"; 	break;
				case 2: 	return "Februari"; 	break;
				case 3: 	return "Maret"; 		break;
				case 4: 	return "April"; 		break;
				case 5: 	return "Mei"; 			break;
				case 6: 	return "Juni"; 			break;
				case 7: 	return "Juli"; 			break;
				case 8: 	return "Agustus"; 	break;
				case 9: 	return "September"; break;
				case 10: 	return "Oktober"; 	break;
				case 11: 	return "November"; 	break;
				case 12: 	return "Desember"; 	break;
			}
		}
	}
}

if ( ! function_exists('hari'))
{
	function hari($tanggal)
	{
		$ubah 		= gmdate($tanggal, time()+60*60*8);
		$pecah 		= explode("-",$ubah);
		$tgl 			= $pecah[2];
		$bln 			= $pecah[1];
		$thn 			= $pecah[0];

		$nama 		= date("l", mktime(0,0,0,$bln,$tgl,$thn));
		$day_name = "";
		if( $nama == "Sunday" ) { $day_name="Minggu"; }
		else if( $nama == "Monday" ) { $day_name="Senin"; }
		else if( $nama == "Tuesday" ) { $day_name="Selasa"; }
		else if( $nama == "Wednesday" ) { $day_name="Rabu"; }
		else if( $nama == "Thursday" ) { $day_name="Kamis"; }
		else if( $nama == "Friday" ) { $day_name="Jumat"; }
		else if( $nama == "Saturday" ) { $day_name="Sabtu"; }

		if(system_language() == 'en')
			return $nama;
		else
			return $day_name;
	}
}
