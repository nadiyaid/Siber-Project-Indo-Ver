<?php
include 'koneksi.php';
session_start();
include 'validation.php';
require('tcpdf/tcpdf.php');
		
	$bulan = '8';
	$tahun = '2021'; 

	$tgl = 1;
	$jumtgl = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun); // dapat jumlah tanggal
	
	// create new PDF document
	$pdf = new TCPDF('L', PDF_UNIT, 'A3', true, 'UTF-8', false);
    
    //Image( file name , x position , y position , width [optional] , height [optional] )
    $pdf->Image('logo-siber.png',60,30,100);

	// set document information
	$pdf->SetTitle('Laporan Presensi Bulanan');
	$pdf->SetSubject('Laporan Presensi Bulanan');
			
	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			
	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    // add a page
	$pdf->AddPage();

    //set font to arial, bold, 14pt
	$pdf->SetFont('helvetica', 'B', 16);
	$pdf->Write(0, 'Laporan Presensi Bulanan', '', 0, 'C', true, 0, false, false, 0);
	$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
			
	$pdf->SetFont('helvetica', '', 10);
	$pdf->Write(0, 'Periode Kehadiran  : '.$bulan. ' - '.$tahun.'', '', 0, 'L', true, 0, false, false, 0);
	$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
	$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
			
	$pdf->SetFont('helvetica', '', 8);
			
	$sql = "SELECT A.nip, A.nama,
				group_concat(A.1) as '1', group_concat(A.2) as '2',
				group_concat(A.3) as '3', group_concat(A.4) as '4',
				group_concat(A.5) as '5', group_concat(A.6) as '6',
				group_concat(A.7) as '7', group_concat(A.8) as '8',
				group_concat(A.9) as '9', group_concat(A.10) as '10',
				group_concat(A.11) as '11', group_concat(A.12) as '12',
				group_concat(A.13) as '13', group_concat(A.14) as '14',
				group_concat(A.15) as '15', group_concat(A.16) as '16',
				group_concat(A.17) as '17', group_concat(A.18) as '18',
				group_concat(A.19) as '19', group_concat(A.20) as '20',
				group_concat(A.21) as '21', group_concat(A.22) as '22',
				group_concat(A.23) as '23', group_concat(A.24) as '24',
				group_concat(A.25) as '25', group_concat(A.26) as '26',
				group_concat(A.27) as '27', group_concat(A.28) as '28',
				group_concat(A.29) as '29', group_concat(A.30) as '30',
				group_concat(A.31) as '31'
				from v_monthly_report as A
				WHERE MONTH(tanggal) = '".$bulan."' AND YEAR(tanggal) = '".$tahun."' group by A.nip";
	$run = mysqli_query($config, $sql);

			$tbl = <<<EOD
				<table border="0.5">
				<tr style="text-align:center">
					<th><b>No </b></th>
					<th><b>NIP </b></th>
					<th valign='top' style='white-space:nowrap'><b>Nama Karyawan </b></th>
EOD;
			//dinamis, sesuai tanggal pada bulan tsb
			while($tgl <= $jumtgl) {
			$tbl .= "<th style='text-align:center'><b>".$tgl."</b></th>";
				$tgl++;
			}
			
			//end header kolom
			$tbl .= "</tr>";

			//isinya
			$no = 1;
			while ($isi = mysqli_fetch_array($run)) {
				$tbl.="	 	 	
					<tr style='text-align:center'>
						<td>".$no."</td>
						<td>".$isi['nip']."</td>
						<td valign='top' style='white-space:nowrap'>".$isi['nama']."</td>
						<td>".$isi['1']."</td>
						<td>".$isi['2']."</td>
						<td>".$isi['3']."</td>
						<td>".$isi['4']."</td>
						<td>".$isi['5']."</td>
						<td>".$isi['6']."</td>
						<td>".$isi['7']."</td>
						<td>".$isi['8']."</td>
						<td>".$isi['9']."</td>
						<td>".$isi['10']."</td>
						<td>".$isi['11']."</td>
						<td>".$isi['12']."</td>
						<td>".$isi['13']."</td>
						<td>".$isi['14']."</td>
						<td>".$isi['15']."</td>
						<td>".$isi['16']."</td>
						<td>".$isi['17']."</td>
						<td>".$isi['18']."</td>
						<td>".$isi['19']."</td>
						<td>".$isi['20']."</td>
						<td>".$isi['21']."</td>
						<td>".$isi['22']."</td>
						<td>".$isi['23']."</td>
						<td>".$isi['24']."</td>
						<td>".$isi['25']."</td>
						<td>".$isi['26']."</td>
						<td>".$isi['27']."</td>";
					switch ($jumtgl) {
						case 28:
							$tbl .= "<td>".$isi['28']."</td>";
							break;
						case 29:
							$tbl .= "<td>".$isi['28']."</td>
								     <td>".$isi['29']."</td>";
							break;
						case 30:
							$tbl .= "<td>".$isi['28']."</td>
									 <td>".$isi['29']."</td>
									 <td>".$isi['30']."</td>";
							break;
						case 31:
							$tbl .= "<td>".$isi['28']."</td>
									 <td>".$isi['29']."</td>
									 <td>".$isi['30']."</td>
									 <td>".$isi['31']."</td>";
							break;
						default:
							//nothing
							break;
				}
					$tbl .="</tr>";
					$no++;
				}
			$tbl.="</table>";
			$pdf->writeHTML($tbl, true, false, false, false, '');

            $pdf->Cell(130 ,4,'Keterangan',0,0);
					
			$namaPDF = 'Laporan Presensi Bulanan_'.$bulan.'_'.$tahun.'.pdf';
			$pdf->Output($namaPDF,'I');
?>