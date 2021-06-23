<?php
	function getNowDateText($format) {
		$date = date($format);
		$text = '';
		$hari = [
			'Sunday' => 'Minggu',
			'Monday' => 'Senin',
			'Tuesday' => 'Selasa',
			'Wednesday' => 'Rabu',
			'Thursday' => 'Kamis',
			'Friday' => 'Jum\'at',
			'Saturday' => 'Sabtu',
		];
		$bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
		$angka = ['Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan','Sepuluh','Sebelas'];
		if ($format=='l') {
			$text = $hari[$date];
		} else if($format=='n') {
			$text = $bulan[$date-1];
		} else {
			if ($date<12) {
				$text = $angka[$date-1];
			} else if($date<20) {
				$text = $angka[$date-11].' Belas';
			} else if($date%10==0){
				$text = $angka[floor($date/10)-1].' Puluh';
			} else if($date<100) {
				$text = $angka[floor($date/10)-1].' Puluh '.$angka[($date%10)-1];
			} else if($date>=100 && $date<1000){
				if($date==100) {
					$text = "Seratus";
				} else if ($date<112) {
					$text = "Seratus ".$angka[$date-1];
				} else if($date<120) {
					$text = "Seratus ".$angka[$date-11].' Belas';
				} else if($date%10==0 && $date%100!=0 && $date<200){
					$text = 'Seratus '.$angka[floor(($date%100)/10) -1].' Puluh';
				} else if($date<200) {
					$text = 'Seratus '.$angka[floor(($date%100)/10)-1].' Puluh '.$angka[($date%10)-1];
				} else if($date%100==0 && $date!=100) {
					$text = $angka[floor($date/100)-1].' Ratus';
				} else if ($date<212) {
					$text = $angka[floor($date/100)-1].' Ratus '.$angka[$date-1];
				} else if($date<220) {
					$text = $angka[floor($date/100)-1].' Ratus '.$angka[$date-11].' Belas';
				} else if($date%10==0 && $date%100!=0 && $date>=220){
					$text = $angka[floor($date/100)-1].' Ratus '.$angka[floor(($date%100)/10) -1].' Puluh';
				} else if($date<1000) {
					$text = $angka[floor($date/100)-1].' Ratus '.$angka[floor(($date%100)/10)-1].' Puluh '.$angka[($date%10)-1];
				}
			} else if($date>=1000){
				if($date==1000) {
					$text = "Seribu";
				} else if ($date<1012) {
					$text = "Seribu ".$angka[$date-1];
				} else if($date<1020) {
					$text = "Seribu ".$angka[$date-11].' Belas';
				} else if($date<1100) {
					$text = 'Seribu ';
					$date = $date%1000;
					if($date%10==0 && $date%100!=0 && $date<200){
						$text .= $angka[floor(($date%100)/10) -1].' Puluh';
					} else if($date<200) {
						$text .= $angka[floor(($date%100)/10)-1].' Puluh '.$angka[($date%10)-1];
					}
				} else if($date<1200) {
					$text = 'Seribu Seratus ';
					$date = $date%1100;
					if ($date<12) {
						$text .= $angka[$date-1];
					} else if($date<20) {
						$text .= $angka[$date-11].' Belas';
					} else if($date%10==0){
						$text .= $angka[floor(($date%100)/10) -1].' Puluh';
					} else if($date%10!=0) {
						$text .= $angka[floor(($date%100)/10)-1].' Puluh '.$angka[($date%10)-1];
					}
				} else if($date<2000) {
					$text = 'Seribu ';
					$ratusan = floor($date%1000)/100;
					$text .= $angka[$ratusan-1].' Ratus';
					$date = ($date%1000)%100;
					if ($date<12) {
						$text .= $angka[$date-1];
					} else if($date<20) {
						$text .= $angka[$date-11].' Belas';
					} else if($date%10==0){
						$text .= $angka[floor(($date%100)/10) -1].' Puluh';
					} else if($date%10!=0) {
						$text .= $angka[floor(($date%100)/10)-1].' Puluh '.$angka[($date%10)-1];
					}
				} else if($date>=2000 && $date%1000==0) {
					$text = $angka[floor($date/1000)-1]." Ribu";
				} else if ($date>=2000 && $date%1000<12) {
					$text = $angka[floor($date/1000)-1]." Ribu ".$angka[$date%1000-1];
				} else if($date>=2000 && $date%1000<20) {
					$text = $angka[floor($date/1000)-1]." Ribu ".$angka[$date%1000-1].' Belas';
				} else if($date>=2000 && $date%1000<100) {
					$text = $angka[floor($date/1000)-1]." Ribu ";
					$date = $date%1000;
					if($date%10==0 && $date%100!=0 && $date<100){
						$text .= $angka[floor($date/10)-1].' Puluh';
					} else if($date<200) {
						$text .= $angka[floor($date/10)-1].' Puluh '.$angka[($date%10)-1];
					}
				}  else if($date>=2000 && $date%1000<200) {
					$text = $angka[floor($date/1000)-1]." Ribu Seratus";
					$date = ($date%1000)%100;
					if ($date<12) {
						$text .= $angka[$date-1];
					} else if($date<20) {
						$text .= $angka[$date-11].' Belas';
					} else if($date%10==0){
						$text .= $angka[floor(($date%100)/10) -1].' Puluh';
					} else if($date%10!=0) {
						$text .= $angka[floor(($date%100)/10)-1].' Puluh '.$angka[($date%10)-1];
					}
				} else if($date>=2000 && $date%1000>200) {
					$text = $angka[floor($date/1000)-1]." Ribu";
					$ratusan = floor(($date%1000)/100);
					$text .= $angka[$ratusan-1].' Ratus';
					$date = ($date%1000)%100;
					if ($date<12) {
						$text .= $angka[$date-1];
					} else if($date<20) {
						$text .= $angka[$date-11].' Belas';
					} else if($date%10==0){
						$text .= $angka[floor(($date%100)/10) -1].' Puluh';
					} else if($date%10!=0) {
						$text .= $angka[floor(($date%100)/10)-1].' Puluh '.$angka[($date%10)-1];
					}
				}
			}
		}
		return $text;
	}
?>