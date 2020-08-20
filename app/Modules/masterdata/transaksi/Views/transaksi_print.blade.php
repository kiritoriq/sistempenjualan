<?php

// use rizalafani\fpdflaravel\Fpdf as FPDFS;
class PDF_MC_Table extends App\Libraries\PDF_MC_Table{

    function header(){
    }

    function garis(){
        $x = $this->GetX();
        $y = $this->GetY();
        $this->SetLineWidth(0);
        $this->Line($x, $y, 210, $y);
    }

    function garispendek(){
        $x = 160;
        $y = $this->GetY();
        $this->SetLineWidth(0);
        $this->Line($x, $y, 210, $y);
    }

    function garistbl(){
        $x = $this->GetX();
        $y = $this->GetY();
        $this->SetLineWidth(0.3);
        $this->Line($x, $y, 210, $y);
    }

    function footer(){
        // $this->SetY(270);
        // $this->SetFont('courier', '', 7);
        // $this->SetFont('courier', '', 7);
        // $this->Cell(50, 10, 'Hal. : ' . $this->PageNo(), 0, 0, 'L');
        // $this->SetFont('courier', '', 7);
        // $this->SetY(5);
        // $this->Cell(190, 10, 'cu-' . date('d/m/YH:i:s') . '', 0, 1, 'R');
    }
}

// lebar kertas
$p_width  = 225;
// tinggi kertas
$p_height = 100;
// orientasi kertas P=portrait L=Landscape
$p_orientation = 'L';
// skala mm=milimeter
$p_scale  = 'mm';

// title
$title = 'Cetak Bukti Transaksi';

// margin tergantung $p_scale
$m_left   = 10;
$m_right  = 10;
$m_top    = 10;
$m_bottom = 10;

// container
$c_width  = ($p_width - $m_left - $m_right);
$c_height = ($p_height - $m_top - $m_bottom);

$pdf = new PDF_MC_Table($p_orientation, $p_scale, array($p_width, $p_height));

// margin bottom
$pdf->SetAutoPageBreak(true, $m_bottom);
// margin left, top, right
$pdf->SetMargins($m_left, $m_top, $m_right);
$pdf->AddPage();

// setting font
$pdf->SetFont('Helvetica', 'B', 7);
// Title
$pdf->SetTitle($title);
// width (cointainer), line spacing, teks, border, enter (1 newline, 0 lanjut),align.
$pdf->Cell($c_width/2,4,'Toko Agathis',0,1,'L');
$pdf->Cell($c_width/2,4,'Tanggal:'.$transaksi->tgl,0,1,'L');
// $pdf->Cell($c_width/2,4,'Toko Agathis',0,1,'L');
// $pdf->Cell($c_width/2,4,'TIRTA MOEDAL KOTA SEMARANG',0,1,'L');
// $pdf->Cell($c_width,4,'CABANG '.getCabangById(Input::get('id_cabang'))->nama_cab,0,1,'L');
// $pdf->ln(3);

// $pdf->Cell($c_width,4,'Laporan Daftar Usulan '.@getUsulanById(Input::get('id_usulan'))->jenis_usulan,0,1,'C');
// $pdf->Cell($c_width,4,'Bulan : '.bulan(Input::get('bulan')).' '.Input::get('tahun'),0,1,'C');

$nl = 1;
$pelanggan = \DB::table('tb_pelanggan')
            ->select('nama_plg')
            ->where('no_plg',$transaksi->no_plg)
            ->first();
// foreach($transaksis as $transaksi){
//     $pdf->RowNoLines(array($transaksi->kd_transk));
// }
$pdf->Ln(1);
$pdf->SetFont('Helvetica','','8');
$pdf->SetAligns(array('L','L','L'));
$pdf->SetWidths(array('30','135','40'));

$pdf->RowNoLines(array('No. Transaksi: '.$transaksi->kd_transk,'','Nama Kasir: '.$transaksi->nama_kasir));

// $pdf->RowNoLines(array($x));
$pdf->SetY(24);
$pdf->RowNoLines(array('Pelanggan: '.$pelanggan->nama_plg,'',''));

$dtls = \DB::table('tb_dtl_transaksi')
        ->select('*')
        ->where('kd_transk',$transaksi->kd_transk)
        ->get();

$pdf->Ln(1);
$pdf->SetFont('Helvetica','','7');
$pdf->SetWidths(array('10','30','50','40','20','28','25'));
$pdf->SetAligns(array('C','L','L','C','C','C','C'));
$pdf->garistbl();
$pdf->RowNoLines(array('No.','Kode Barang','Nama Barang','Harga Satuan','Jumlah','Diskon (%)','Total'));
$pdf->garistbl();
foreach($dtls as $dtl){
    $pdf->RowNoLines(array(
        $nl++,
        $dtl->kd_brg,
        $dtl->nama_brg,
        $dtl->hrg_satuan,
        $dtl->qty,
        $dtl->diskon,
        $dtl->harga
    ));
    $pdf->garis();
}
$yawal = $pdf->GetY();
$pdf->Ln(1);
$pdf->garistbl();
$pdf->SetFont('Helvetica','B','8');
$pdf->RowNoLines(array('','','','','','Total',$transaksi->totalharga));
$yakhir = $pdf->GetY();
$t = $yakhir - $yawal;
// $pdf->RowNoLines(array($t));
// $pdf->Rect(160,$yawal,28,$t);
// $pdf->Rect(188,$yawal,25,$t);
$pdf->garispendek();
$pdf->RowNoLines(array('','','','','','Total Bayar',$transaksi->totalbayar));
$pdf->garispendek();
$pdf->RowNoLines(array('','','','','','Kembali',$transaksi->kembali));
$pdf->garistbl();

// $pdf->Ln(1);
// $pdf->SetWidths(array('40','60'));
// $pdf->RowNoLinesHeader(array('Total Bayar'));

// foreach($transaksis as $transaksi){
// $pdf->RowNoLines(array($transaksi->kd_transk));
// }
// $pdf->Ln(1);
// $pdf->SetFont('Arial', 'B', 9);
// // table (th)
// //HEADER
// $cell_height = 5;
// $pdf->Cell(188, 8, 'SURAT PERINTAH KERJA','TRL', 1, 'C');
// $pdf->SetFont('Arial', '', 8);
// $pdf->SetY(26);
// $pdf->Cell(188, 5, 'TANGGAL: '.$data->tgl_spk.' Nomor: '.$data->no_spk, 'BRL', 0, 'C');

// //IDENTITAS PELANGGAN
// $pdf->Ln(5);
// $pdf->SetFont('Arial', '', 9);
// $x = $pdf->GetX();
// $y = $pdf->GetY();
// // $pdf->RowNoLines(array($y));
// $awalid = $pdf->GetY();
// // $h = $akhir - $awal;

// $pdf->SetWidtHs(array(37,67,24,60));
// $pdf->SetAligns(array('L','L','L','L'));
// $pdf->RowNoLines(array('NAMA PELAPOR',':   '.$data->nm_lapor.'','ALAMAT',':   '.$data->alamat_lapor.''));
// $pdf->RowNoLines(array('NOMOR PELANGGAN',':   '.$data->nolangg_lapor.'','',''));
// $akhirid = $pdf->GetY();
// $h1 = $akhirid - $awalid;
// $pdf->Rect(10,31,188,$h1);

// $pdf->Ln(1);
// $x1 = $pdf->GetX();
// $awalp = $pdf->GetY();
// $pdf->SetFont('Arial', '', 9);
// $pdf->SetWidths(array(188));
// $p = explode('|',$data->pekerjaan);
// $pekerjaan_yang_harus_dikerjakan = "Pekerjaan yang harus dikerjakan:";

// $data_pekerjaan = $data->details;
//     if($data_pekerjaan){
//         foreach($data_pekerjaan as $i => $item) {
//             $pekerjaan_yang_harus_dikerjakan .= "\n     ".($i+1).". ".$item->pekerjaan->keterangan;
//         }
//     }
// // if(count($p) > 0){
    
// // }
// $pdf->RowNoLines(array($pekerjaan_yang_harus_dikerjakan));
// $pdf->SetWidths(array(20,168));
// $pdf->SetAligns(array('R','L'));
// // $pdf->RowNoLines(array('1','    Pelayanan Gangguan Aliran'));
// // $akhirp = $pdf->GetY();
// // $h = $akhirp - $awalp;
// // // $pdf->RowNoLines(array($akhir));
// // $pdf->Rect(10,$awalp-1,188,$h);
// // foreach($riwayatkepegawaians as $riwayatkepegawaian){
// // $pdf->RowNoLines(array(
// //     $nl++,
// //     '   '.$riwayatkepegawaian->jabatan.''
// // ));
// // }
// $akhirp = $pdf->GetY();
// $h = $akhirp - $awalp;
// // $pdf->RowNoLines(array($akhir));
// $pdf->Rect($x1,$awalp-1,188,$h);

// $pdf->Ln(2);
// $pdf->SetFont('Arial', 'B', 9);
// $pdf->Cell(188, 7, 'LAPORAN PELAKSANAAN PEKERJAAN','BTRL', 1, 'C');
// $pdf->SetFont('Arial', '', 9);
// $x2 = $pdf->GetX();
// $awalpel = $pdf->GetY();
// // $pdf->row(array($awalpel));
// $pdf->SetWidtHs(array(37,67,24,60));
// $pdf->SetAligns(array('L','L','L','L'));
// $pdf->RowNoLines(array('TGL. PELAKSANAAN',':   '.$data->pelaksanaan->tgl_pelaksanaan.'','ASAL',':   '.$data->asal_lapor));
// $jammulai= date_create($data->pelaksanaan->waktu_pelaksanaan1);
// $pdf->RowNoLines(array('MULAI JAM',':   '.date_format($jammulai, 'H:i:s'),'JENIS PIPA',':   '.$data->pelaksanaan->jenis_pipa));
// $jamselesai = date_create($data->pelaksanaan->waktu_pelaksanaan2);
// $pdf->RowNoLines(array('SELESAI JAM',':   '.date_format($jamselesai, 'H:i:s'),'TEKANAN',':   '.$data->pelaksanaan->tekanan));
// $akhirpel = $pdf->GetY();
// $hpel = $akhirpel - $awalpel;
// $pdf->Rect($x2,$awalpel,188,$hpel);
// // $pdf->row(array($akhirpel));

// $pdf->Ln(1);
// // $pdf->SetY(96);
// $awalpek = $pdf->GetY();
// // $pdf->row(array($awalpek));
// $pdf->SetWidtHs(array(37,188));
// $pdf->SetAligns(array('L','L'));
// $pdf->RowNoLines(array('Jenis Pekerjaan',':   '.$data->pelaksanaan->jenispekerjaan->nm_jns));
// $pdf->RowNoLines(array('',''));
// $bahan_yang_digunakan = ":   ";
// foreach($data->pelaksanaan->details as $i => $item) {
//     $bahan_yang_digunakan .= ($i==0 ? "" : "\n    ")." ".($i+1).". ".$item->barang->nama_brg;
// }
// $pdf->RowNoLines(array('Bahan yang digunakan',$bahan_yang_digunakan));
// $pdf->RowNoLines(array('',''));
// $pdf->RowNoLines(array('',''));
// // $pdf->RowNoLines(array('',''));
// $pdf->RowNoLines(array('Tenaga Kerja',':   '.$data->pelaksanaan->tenaga->ket));
// $akhirpek = $pdf->GetY();
// // $pdf->row(array($akhirpek));
// $hpek = $akhirpek - $awalpek;
// $pdf->Rect(10,$awalpek-1,188,$hpek);

// $pdf->Ln(1);
// // $pdf->SetY(96);
// $awalde = $pdf->GetY();
// // $pdf->row(array($awalde));
// $pdf->SetWidtHs(array(188));
// $pdf->SetAligns(array('L'));
// $pdf->RowNoLines(array('Gambar Denah Lokasi'));
// $pdf->RowNoLines(array(''));
// $pdf->RowNoLines(array(''));
// $pdf->RowNoLines(array(''));
// $pdf->RowNoLines(array(''));
// $pdf->RowNoLines(array(''));
// $pdf->RowNoLines(array(''));
// $pdf->RowNoLines(array(''));
// $pdf->RowNoLines(array(''));
// $pdf->RowNoLines(array(''));
// $akhirde = $pdf->GetY();
// // $pdf->row(array($akhirde));
// $hde = $akhirde - $awalde;
// $pdf->Rect(10,$awalde-2,188,$hde);

// $pdf->Ln(2);
// $pdf->SetWidtHs(array(10,70,30,70));
// $pdf->SetAligns(array('C','C','C','C'));
// $pdf->RowNoLinesHeader(array('','','','Pelaksana Pekerjaan'));
// $pdf->RowNoLines(array('','Kepala Sub Bagian','','Pengawas'));
// $pdf->RowNoLines(array(''));
// $pdf->RowNoLines(array(''));
// $pdf->SetFont('Arial', 'UB', 9);
// $pdf->RowNoLinesHeader(array('','M. Arwah Hardono, Amd','','Sutrisna'));
// $pdf->SetFont('Arial', '',9);
// $pdf->RowNoLines(array('','NPP : 690828754','','NPP : 6908292299'));

$pdf->Output($title.'.pdf', 'I');
?>
