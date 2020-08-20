<?php
function timediff($firstTime,$lastTime) {
    //selisih waktu/jam dalam detik
    $firstTime=strtotime($firstTime);
    $lastTime=strtotime($lastTime);
    $timeDiff=$lastTime-$firstTime;
    return $timeDiff;
}

function clearWhitespaces($string) {
    return trim(preg_replace('/\s+/s', " ", $string));
}

function htmlValue($string) {
    return
        str_replace('"', "&quot;",
        str_replace("'", '&#39;',
        str_replace('<', '&lt;',
        str_replace('&', "&amp;",
    $string))));
}

function jsValue($string) {
    return
        preg_replace('/\r?\n/', "\\n",
        str_replace('"', "\\\"",
        str_replace("'", "\\'",
        str_replace("\\", "\\\\",
    $string))));
}

function xmlData($string, $cdata=false) {
    $string = str_replace("]]>", "]]]]><![CDATA[>", $string);
    if (!$cdata)
        $string = "<![CDATA[$string]]>";
    return $string;
}


/*function compressCSS($code) {
    $code = self::clearWhitespaces($code);
    $code = preg_replace('/ ?\{ ?/', "{", $code);
    $code = preg_replace('/ ?\} ?/', "}", $code);
    $code = preg_replace('/ ?\; ?/', ";", $code);
    $code = preg_replace('/ ?\> ?/', ">", $code);
    $code = preg_replace('/ ?\, ?/', ",", $code);
    $code = preg_replace('/ ?\: ?/', ":", $code);
    $code = str_replace(";}", "}", $code);
    return $code;
}*/

function uang($nominal = ''){
    if ($nominal == ''){
        return '';
    }
    else{
        return '&nbsp;'.@number_format($nominal,0,',','.');        
    }
}

function get_duplicate_array( $array ) {
    return array_unique( array_diff_assoc( $array, array_unique( $array ) ) );
}

function remove_letter($str =''){
    return preg_replace("/[^0-9,.]/", "", $str);    
}

function debug($s='',$die=true){
    echo '<pre>';
    print_r($s);
    echo '</pre>';
    if($die == true){
        die();
    }
}


function jam_tabrakan($s1='',$e1='',$s2='',$e2=''){
    if(
            ($s1 == $s2 || $e1 == $e2) ||
            ($s1 <= $s2 && $e1 <= $e2 && $e1 >= $s2) ||
//            ($s1 >= $s2 && $e1 >= $e2 && $s1 <= $e2) ||
            ($s1 >= $s2 && $e1 >= $e2 && $s1 < $e2) ||
            ($s1>=$s2 && $e1<=$e2) ||
            ($s1<=$s2 && $e1>=$e2)
            ){
//        if(($s1 == $s2 || $e1 == $e2)){
//            echo 'Kondisi 1<br>';
//        }
//        if($s1 <= $s2 && $e1 <= $e2 && $e1 >= $s2){
//            echo 'Kondisi 2<br>';
//        }
//        if($s1 >= $s2 && $e1 >= $e2 && $s1 < $e2){
//            echo 'Mulai 1 = '.$s1.'<br>';
//            echo 'Selesai 1 = '.$e1.'<br>';
//            echo 'Mulai 2 = '.$s2.'<br>';
//            echo 'Selesai 2 = '.$e2.'<br>';
//            echo 'Kondisi 3<br>';
//        }
//        if($s1>=$s2 && $e1<=$e2){
//            echo 'Kondisi 4<br>';
//        }
//        if($s1<=$s2 && $e1>=$e2){
//            echo 'Kondisi 5<br>';
//        }
        return true;
            }else{
        return false;
            }
//    if(
//            ($s1 == $s2 || $e1 == $e2) ||
//            ($s1 <= $s2 && $e1 <= $e2 && $e1 >= $s2) ||
//            ($s1 >= $s2 && $e1 >= $e2 && $s1 <= $e2) ||
//            ($s1>=$s2 && $e1<=$e2) ||
//            ($s1<=$s2 && $e1>=$e2)
//            ){
//        return true;
//            }else{
//        return false;
//            }
}



function rangesNotOverlapClosed($start_time1,$end_time1,$start_time2,$end_time2){
  $utc = new DateTimeZone('UTC');

  $start1 = new DateTime($start_time1,$utc);
  $end1 = new DateTime($end_time1,$utc);
  if($end1 < $start1)
    throw new Exception('Range is negative.');

  $start2 = new DateTime($start_time2,$utc);
  $end2 = new DateTime($end_time2,$utc);
  if($end2 < $start2)
    throw new Exception('Range is negative.');
  return ($end1 < $start2) || ($end2 < $start1);
}

function rangesNotOverlapOpen($start_time1,$end_time1,$start_time2,$end_time2)
{
  $utc = new DateTimeZone('UTC');

  $start1 = new DateTime($start_time1,$utc);
  $end1 = new DateTime($end_time1,$utc);
  if($end1 < $start1)
    throw new Exception('Range is negative.');

  $start2 = new DateTime($start_time2,$utc);
  $end2 = new DateTime($end_time2,$utc);
  if($end2 < $start2)
    throw new Exception('Range is negative.');

  return ($end1 <= $start2) || ($end2 <= $start1);
}



function spasi($rekursive = 1){
    for($a=1 ; $a <= $rekursive ; $a++){
        echo '&nbsp;';
    }
}

function get_client_ip() {
	$ipaddress = '';
        if($_SERVER['REMOTE_ADDR']){
		$ipaddress = $_SERVER['REMOTE_ADDR'];
        }else{
		$ipaddress = 'UNKNOWN';
        }

	return $ipaddress;
}

    function formatTanggalPanjang($tanggal) {
        $aBulan = array(1=> "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        list($thn,$bln,$tgl)=explode("-",$tanggal);
        $bln = (($bln >0 ) && ($bln < 10))? substr($bln,1,1): $bln ;
        return $tgl." ".$aBulan[$bln]." ".$thn;
    }

    function formatBulanTahun($tanggal) {
        $aBulan = array(1=> "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        list($thn,$bln,$tgl)=explode("-",$tanggal);
        $bln = (($bln >0 ) && ($bln < 10))? substr($bln,1,1): $bln ;
        return $aBulan[$bln]." ".$thn;
    }

function tanggal($date = 1){
    date_default_timezone_set('Asia/Jakarta'); // your reference timezone here
    $date = date('Y-m-d', strtotime($date)); // ubah sesuai format penanggalan standart
    $bulan = array ('01'=>'Januari', // array bulan konversi
            '02'=>'Februari',
            '03'=>'Maret',
            '04'=>'April',
            '05'=>'Mei',
            '06'=>'Juni',
            '07'=>'Juli',
            '08'=>'Agustus',
            '09'=>'September',
            '10'=>'Oktober',
            '11'=>'November',
            '12'=>'Desember'
    );
    $date = explode ('-',$date); // ubah string menjadi array dengan paramere '-'

    return @$date[2] . ' ' . @$bulan[$date[1]] . ' ' . @$date[0]; // hasil yang di kembalikan}
}

function romawi($n = '1'){
    $hasil = '';
    $iromawi = array('','I','II','III','IV','V','VI','VII','VIII','IX','X',
        20=>'XX',30=>'XXX',40=>'XL',50=>'L',60=>'LX',70=>'LXX',80=>'LXXX',
        90=>'XC',100=>'C',200=>'CC',300=>'CCC',400=>'CD',500=>'D',
        600=>'DC',700=>'DCC',800=>'DCCC',900=>'CM',1000=>'M',
        2000=>'MM',3000=>'MMM');
    
    if(array_key_exists($n,$iromawi)){
        $hasil = $iromawi[$n];
    }elseif($n >= 11 && $n <= 99){
        $i = $n % 10;
        $hasil = $iromawi[$n-$i] . Romawi($n % 10);
    }elseif($n >= 101 && $n <= 999){
        $i = $n % 100;
        $hasil = $iromawi[$n-$i] . Romawi($n % 100);
    }else{
        $i = $n % 1000;
        $hasil = $iromawi[$n-$i] . Romawi($n % 1000);
    }
    return $hasil;
}

function combo_jnskelamin($id ='',$selected=""){
    $h = "<select id='$id' name='$id' style='width:100%'>";    
    $h .= '<option value="">Pilih Jenis Kelamin</option>';
    $h .= '<option '.(($selected == '1')?'selected':'').' value="1">Laki-laki</option>';
    $h .= '<option '.(($selected == '2')?'selected':'').' value="2">Perempuan</option>';
    $h .= '</select>';
    return $h;
}


function select_hari($id = 0,$selected=''){
    $hari = array("-", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu","Minggu","All Day");
    return Form::select($id,$hari,$selected,array('style' => 'width:100%'));
}

function select_bulan($id = 0,$selected=''){
    $h = "<select id='$id' name='$id' style='width:100%' class='form-control'>";    
    $h .= '<option value="">Pilih Bulan</option>';
    $h .= '<option '.(($selected == '01')?'selected':'').' value="01">Januari</option>';
    $h .= '<option '.(($selected == '02')?'selected':'').' value="02">Februari</option>';
    $h .= '<option '.(($selected == '03')?'selected':'').' value="03">Maret</option>';
    $h .= '<option '.(($selected == '04')?'selected':'').' value="04">April</option>';
    $h .= '<option '.(($selected == '05')?'selected':'').' value="05">Mei</option>';
    $h .= '<option '.(($selected == '06')?'selected':'').' value="06">Juni</option>';
    $h .= '<option '.(($selected == '07')?'selected':'').' value="07">Juli</option>';
    $h .= '<option '.(($selected == '08')?'selected':'').' value="08">Agustus</option>';
    $h .= '<option '.(($selected == '09')?'selected':'').' value="09">September</option>';
    $h .= '<option '.(($selected == '10')?'selected':'').' value="10">Oktober</option>';
    $h .= '<option '.(($selected == '11')?'selected':'').' value="11">November</option>';
    $h .= '<option '.(($selected == '12')?'selected':'').' value="12">Desember</option>';
    $h .= '</select>';
    return $h;
}

function array_hari($id = 0,$selected=''){
    $hari = array("-", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu","Minggu","All Day");
    return $hari;
}

function date_picker($id = 'asa',$value=""){
    return '<script>'
    .'$(document).ready(function(){'
    .'$(".tgl").datetimepicker({format: "YYYY-MM-DD"});'
    .'})</script>'
    .'<input type="text" class="form-control tgl" value="'.$value.'" id="'.$id.'" name="'.$id.'"  placeholder="Masukkan Tanggal">';
}

function tanggal_indonesia(){
    $bulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"); 
    $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"); 
//    $cetak_date = $hari[(int)date("w")] .', '. date("j ") . $bulan[(int)date('m')] . date(" Y"); 
    $cetak_date = date("j ") . $bulan[(int)date('m')] . date(" Y"); 
    return $cetak_date ;
}

function sekarang(){
    return date("Y-m-d H:i:s");
}


function modal($sempit = false,$name = 'modal2',$body = 'Modal2',$minus=false){
    $class = ($sempit == false)?'modal-dialog-wide':'modal-dialog';
    $js = '<script>var duplicateChk = {};'
            .'$("div#modal2[class]").each (function (a) {'
            .'if (duplicateChk.hasOwnProperty(this.class)) {'
            .'alert("kembar");$(this).remove();'
            .'} else { duplicateChk[this.class] = "true";}});</script>';
    
    $min = ($minus == true)?'':'';
    $html =  '<div class="modal fade" id="'.$name.'" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="'.$class.'">
        <div class="modal-content" id="wadah_modal">
        <div class="modal-header bg-primary">
        <button onclick="claravel_modal_close('."'$name'".')" type="button" aria-hidden="true" class="btn btn-danger pull-right"><i class="glyphicon glyphicon-remove" ></i></button>
            '.$min.'
        <h4 class="modal-title"><b id="judulmodal"></b></h4>
      </div>
      <div class="modal-body">
        <div id="konten'.$body.'"></div>
      </div>
      <div class="modal-footer">
        <div id="footermodal"></div>
      </div>
    </div>
  </div>
</div>';
	return $html;
}

function catat_log($aksi = '',$modul=''){
    $simpan = array(
        'aksi' => $aksi,
        'module' => $modul,
        'user' => \Session::get('user_id'),
        'url' => \Request::url(),
        'waktu' => date("Y-m-d H:i:s")
    );
    $save = \DB::table('application_log')->insert($simpan);
}

function header_dokumen(){
    return '<link rel="stylesheet" href="'.getBaseURL(true).'/packages/tugumuda/claravel/assets/css/bootstrap.css" />'.
            '<link rel="stylesheet" href="'.getBaseURL(true).'/packages/tugumuda/claravel/assets/css/bootstrap-theme.css" />'.
            '<link rel="stylesheet" href="'.getBaseURL(true).'/packages/tugumuda/claravel/assets/css/bootstrap-icons.css" />';
}

function combojenis($id="",$sel="",$required="",$classtambahan=""){
        $ret="<select id=\"$id\"name=\"$id\"$required style='width:100%;' class=\"form-control $id $classtambahan\">";
        $ret.="<option value=\"\">.: Pilihan:.</option>";

        $rs = \DB::table('tb_jns_brg')
                ->orderBy('id','asc')
                ->get();

        foreach($rs as $idj){
            $isSel=(($idj->id==$sel)?"selected":"");
            $ret.="<option value=\"".$idj->id."\" $isSel >".$idj->id." - ".$idj->jenis."</option>";
            }
            $ret.="</select>";
            return $ret;
        }

function combobarang($id="",$sel="",$required="",$classtambahan=""){
        $ret="<select id=\"$id\"name=\"$id\"$required style='width:100%;' class=\"form-control $id $classtambahan\">";
        $ret.="<option value=\"\">.: Pilihan:.</option>";

        $rs = \DB::table('mast_barang')
                ->join('tb_stok','mast_barang.kd_barang','=','tb_stok.kd_brg')
                ->select(\DB::raw('mast_barang.kd_barang,tb_stok.jml_stok,tb_stok.hrg_jual_satuan,mast_barang.nm_barang, CONCAT(mast_barang.kd_barang," - ",mast_barang.nm_barang) as text'))
                ->orderBy('mast_barang.id','asc')
                ->get();

        foreach($rs as $idj){
            if($idj->jml_stok == 0){
                $isSel=(($idj->kd_barang==$sel)?"selected":"");
            $ret.="<option title=\"".$idj->text."\" dtvalue=\"".$idj->hrg_jual_satuan."\" value=\"".$idj->kd_barang."\" $isSel disabled>".$idj->text."</option>";
            }else{
                $isSel=(($idj->kd_barang==$sel)?"selected":"");
                $ret.="<option title=\"".$idj->text."\" dtvalue=\"".$idj->hrg_jual_satuan."\" value=\"".$idj->kd_barang."\" $isSel >".$idj->text."</option>";
                }
            }
            $ret.="</select>";
            return $ret;
        }

function combosatuan($id="",$sel="",$required="",$classtambahan=""){
        $ret="<select id=\"$id\"name=\"$id\"$required style='width:100%;' class=\"form-control $id $classtambahan\">";
        $ret.="<option value=\"\">.: Pilihan:.</option>";

        $rs = \DB::table('tb_satuan')
                ->orderBy('id','asc')
                ->get();

        foreach($rs as $idj){
            $isSel=(($idj->id==$sel)?"selected":"");
            $ret.="<option value=\"".$idj->id."\" $isSel >".$idj->id." - ".$idj->satuan."</option>";
            }
            $ret.="</select>";
            return $ret;
        }
        

function hari($hari){
    switch ($hari){
        case '0' :
            return '';
            break;
        case '1' :
            return 'Senin';
            break;
        case '2' :
            return 'Selasa';
            break;
        case '3' :
            return 'Rabu';
            break;
        case '4' :
            return 'Kamis';
            break;
        case '5' :
            return "Jum'at";
            break;
        case '6' :
            return 'Sabtu';
            break;
        case '7' :
            return 'Minggu';
            break;
    }
}

function konversi_hari($hari){
    $hari = date("l", strtotime($hari));
        switch ($hari){
        case 'Monday' :
            return 'Senin';
            break;
        case 'Thuesday' :
            return 'Selasa';
            break;
        case 'Wednesday' :
            return 'Rabu';
            break;
        case 'Thursday' :
            return 'Kamis';
            break;
        case 'Friday' :
            return "Jum'at";
            break;
        case 'Saturday' :
            return 'Sabtu';
            break;
        case 'Sunday' :
            return 'Minggu';
            break;
    }
};	

function cekLogin(){
    $user = \Session::get('user_id');
    $role = \Session::get('role_id');
    return (!$user || !$role)?false:TRUE;
    //if (!$user || !$role){die('Invalid Access :: You must sign in first !!<br><br><i>With Love :: Developer</i>');}
}

function cekAjax(){
    if (!\Request::ajax()){die('Invalid URL Request<br><br><i>With Love :: Developer</i>');}
}

function get_role(){
    return \Session::get('role_id');
}

function user_id(){
    return \Session::get('user_id');
}

//START CREATED BY WIGUNA ON 16 MARET

function inputWarna($id='',$selected=""){
    $a1 = ($selected == 'bg-color-blue')?' selected ':' ';
    $a2 = ($selected == 'bg-color-blueDark')?' selected ':' ';
    $a3 = ($selected == 'bg-color-darken')?' selected ':' ';
    $a4 = ($selected == 'bg-color-green')?' selected ':' ';
    $a5 = ($selected == 'bg-color-greenDark')?' selected ':' ';
    $a6 = ($selected == 'bg-color-orange')?' selected ':' ';
    $a7 = ($selected == 'bg-color-pink')?' selected ':' ';
    $a8 = ($selected == 'bg-color-purple')?' selected ':' ';
    $a9 = ($selected == 'bg-color-yellow')?' selected ':' ';
    $a10 = ($selected == 'bg-color-red')?' selected ':' ';
    $html = '<select id="'.$id.'" name="'.$id.'">
            <option '.$a1.'value="bg-color-blue">Biru</option>
            <option '.$a2.'value="bg-color-blueDark">Biru Gelap</option>
            <option '.$a3.'value="bg-color-darken">Gelap</option>
            <option '.$a4.'value="bg-color-green">Hijau</option>
            <option '.$a5.'value="bg-color-greenDark">Hijau Gelap</option>
            <option '.$a6.'value="bg-color-orange">Jingga</option>
            <option '.$a7.'value="bg-color-pink">Merah Muda</option>
            <option '.$a8.'value="bg-color-purple">Ungu</option>
            <option '.$a9.'value="bg-color-red">Merah</option>
            <option '.$a10.'value="bg-color-yellow">Kuning</option>
            </select>';
    return $html;
}


function isSecure() {
  return
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || $_SERVER['SERVER_PORT'] == 443;
}

function getBaseURL($with_http = false){
    /*
    $url = \Request::url();
    //    $url = str_replace('http://')
    $arrurl = explode('/',$url);
    if ($with_http == false){
        return $arrurl[2];
    }
    else{
        return (isSecure())?'https://'.$arrurl[2].'/':'http://'.$arrurl[2].'/';
        //return 'https://'.$arrurl[2].'/';
    }
    */
    return url();
}

function ambil_angka($a){
    return preg_replace('/[^\p{L}\p{N}\s]/u', '', $a);    
}

function getBrowser() { 
    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }

    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    } 
    elseif(preg_match('/Firefox/i',$u_agent)) 
    { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) 
    { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) 
    { 
        $bname = 'Apple Safari'; 
        $ub = "Safari"; 
    } 
    elseif(preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    } 

    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }

    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }

    // check if we have a number
    if ($version==null || $version=="") {$version="?";}

    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'shortname'      => $ub,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
} 


function uang_akhir($nominal = ''){
    if ($nominal == ''){
        return 0;
    }
    else{
        if($nominal < 0){
            return '('.@number_format( ($nominal) * (-1) ,0,',','.').')';
        }else{
            return @number_format($nominal,0,',','.');                    
        }
    }
}

function is_url_exist($url){
    $ch = curl_init($url);    
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if($code == 200){
       $status = true;
    }else{
      $status = false;
    }
    curl_close($ch);
   return $status;
}

function number_format_persen($nominal,$desimal = 0){
    $desimal = (is_integer($nominal))?0:2;
    if(false === $nominal){
        return 100;
    }
    if ($nominal == ''){
        return 0;
    }
    else{
        if($nominal < 0){
            return '('.  @number_format($nominal * (-1),$desimal, "," , ".").')';
//            return '('.  number_format($nominal * (-1),2, "," , ".").')';
        }else{
//            return number_format($nominal,2, "," , ".");
            return @number_format($nominal,$desimal, "," , ".");
        }
    }
}


function td($array=array(),$tr = false){
    $t = ($tr)?'<tr>':'';
    foreach($array as $a){
        $t .= '<td>'.$a.'</td>';
    }
    $t .= ($tr)?'</tr>':'';
    return $t;
}

function th($array=array(),$tr = false){
    $t = ($tr)?'<tr>':'';
    foreach($array as $a){
        $t .= '<th>'.$a.'</th>';
    }
    $t .= ($tr)?'</tr>':'';
    return $t;
}

function array_msort($array, $cols)
{
    $colarr = array();
    foreach ($cols as $col => $order) {
        $colarr[$col] = array();
        foreach ($array as $k => $row) { $colarr[$col]['_'.$k] = strtolower($row[$col]); }
    }
    $eval = 'array_multisort(';
    foreach ($cols as $col => $order) {
        $eval .= '$colarr[\''.$col.'\'],'.$order.',';
    }
    $eval = substr($eval,0,-1).');';
    eval($eval);
    $ret = array();
    foreach ($colarr as $col => $arr) {
        foreach ($arr as $k => $v) {
            $k = substr($k,1);
            if (!isset($ret[$k])) $ret[$k] = $array[$k];
            $ret[$k][$col] = $array[$k][$col];
        }
    }
    return $ret;

}
