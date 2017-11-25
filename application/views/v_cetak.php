<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 0px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	@page { margin: 0px; }

	.header img {
		margin-top: 10px;
	  	margin-left: 620px;
	}

	.isi{
		margin-left: 100px;
		margin-right: 100px;
	}

	table, th, td {
    	border: 1px solid black;
    	border-collapse: collapse;
	}
	</style>
</head>
<body>
	<div class="header">
		<img src="assets/img/logo-telkom-1.png">
	</div>
	<div class="isi">	
		Nomor : C.Tel. <?php echo $datasurat[0]->no_surat_keluar; ?>
		<br>
		<br>
		Malang, <?php 
		$waktu_keluar = explode("-", $datasurat[0]->tgl_surat_keluar);
	    echo $waktu_keluar[2]." - ".$waktu_keluar[1]." - ".$waktu_keluar[0];
		?>
		<br>
		<br>
		Kepada : 
		<br>
		Yth. <?php echo strtoupper($datasurat[0]->kepada); ?>
		<br>
		<?php 
			$query = $this->db->query("SELECT `nama` FROM `jurusan` WHERE `id_jurusan` = '".$datapeserta[0]->id_jurusan."'");
			foreach ($query->result() as $row){
				echo $row->nama." ";
			}
		 ?> - 
		<?php 
			$query = $this->db->query("SELECT `nama` FROM `pendidikan` WHERE `id_lembaga` = '".$datapeserta[0]->id_lembaga."'");
			foreach ($query->result() as $row){
				echo $row->nama." ";
			}
		 ?>
		<br>
		<?php 
			$query = $this->db->query("SELECT `alamat`, `id_kota` FROM `pendidikan` WHERE `id_lembaga` = '".$datapeserta[0]->id_lembaga."'");
			foreach ($query->result() as $row){
				echo $row->alamat." ";
				$query2 = $this->db->query("SELECT `nama` FROM `wilayah_kabupaten` WHERE `id` = '".$row->id_kota."'");
				foreach ($query2->result() as $row){
					$kota = $row->nama." ";
				}
			}
		 ?>
		<br>
		<?php echo $kota; ?>
		<br>
		<br>
		Perihal : Kegiatan PKL
		<br>
		<br>
		Menunjuk surat saudara nomor : <?php echo $datasurat[0]->no_surat_masuk; ?> tanggal <?php 
		$waktu_keluar = explode("-", $datasurat[0]->tgl_surat_masuk);
	    echo $waktu_keluar[2]." - ".$waktu_keluar[1]." - ".$waktu_keluar[0];
		?> perihal Kegiatan PKL, dapat kami sampaikan bahwa permohonan yang dimaksud dapat kami penuhi.		
		<br>
			<ol>
				<li>
					Berkaitan dengan hal tersebut diatas, untuk waktu pelaksanaan kegiatan serta penempatannya sebagai berikut
					<table>
						<tr align="center">
							<th width="30px">
							No.
							</th>
							<th width="200px">
								Peserta
							</th>
							<th width="140px">
								Waktu
							</th>
							<th width="200px">
								Pembimbing
							</th>
						</tr>
						<?php 
	                        	$i=1;
	                          	if ($datapeserta) {                    
	                              foreach ($datapeserta as $peserta) {
	                              	echo "<tr>";
	                              	echo "<td align='center'>".$i."</td>";

	                     			echo "<td>".$peserta->nama_peserta."</td>";

	                     			$waktu_mulai = explode("-", $peserta->waktu_mulai);
	                     			echo "<td align='center'>".$waktu_mulai[2]."/".$waktu_mulai[1]." SD ";

	                     			$waktu_selesai = explode("-", $peserta->waktu_selesai);
	                     			echo $waktu_selesai[2]."/".$waktu_selesai[1]."/".$waktu_selesai[0]."</td>";
	                     			
	                     			$query = $this->db->query("SELECT `nama` FROM `divisi` WHERE `id_divisi` = '".$peserta->id_divisi."'");
						            foreach ($query->result() as $row){
						                echo "<td>".$row->nama." / ";
						        	}

						        	$query = $this->db->query("SELECT `nama` FROM `pembimbing` WHERE `id_pembimbing` = '".$peserta->id_pembimbing."'");
						            foreach ($query->result() as $row){
						                echo $row->nama."</td>";
						        	}

	                     			echo "</tr>"; 
	                        		$i++;
	                        		}
	                      		}
	                     ?>
					</table>
				</li>
				<li>
					Untuk kepentingan Administrasi kepada peserta harus melengkapi persyaratan sebagai berikut :
					<ol type="a">
						<li>
							Membawa pas photo ukuran 3 X 4 terbaru sebanyak 2 lembar.
						</li>
						<li>
							Menyediakan materai Rp. 6000,- sebanyak 1 (satu) lembar untuk penandatanganan Surat Pernyataan sanggup memenuhi segala ketentuan yang berlaku di PT. TELKOM.
						</li>
						<li>
							Menyerahkan laporan hasil pelaksanaan Praktek Kerja Lapangan dan atau penelitian maksimal <strong>1 bulan</strong> setelah ditandatangani Pembimbing lapangan di PT. TELKOM, lebih dari waktu tersebut sertifikat tidak dapat diterbitkan.
						</li>
						<li>
							Selama pelaksanaan PKL dan atau penelitian berpakaian rapi, sopan atau seragam dari sekolah.
						</li>
						<li>
							Membawa peralatan kerja sendiri(LAPTOP).
						</li>
						<li>
							Persyaratan point a dan b, harus sudah terselesaikan selambat-lambatnya pada tanggal 
							<?php 
						        $waktu_mulai = explode("-", $datapeserta[0]->waktu_mulai);
						        $waktu_mulai[2]=$waktu_mulai[2]+10;
						        echo $waktu_mulai[2]."/".$waktu_mulai[1]."/".$waktu_mulai[0];
						     ?>
						     , dan diserahkan ke HR Malang.
						</li>
					</ol>
				</li>
				<li>Demikian untuk diketahui, atas perhatian Saudara kami ucapkan terimakasih.</li>
			</ol>	
	</div>	
		<img src="assets/img/footer.png">	
</body>
</html>