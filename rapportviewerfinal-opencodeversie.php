<?php 
/*
Project:   RapportViewer (Final version for opensource)
Copyright: Ruben Godeau
=============================================================================
Project voor het verbeteren van de layout van de tussentijds-rapport-viewer van onze school
Als je gebruik maakt van deze code wees dan zo vriendelijk dit te vermelden door deze comment te laten staan
*/

//if there's incoming POST data
function file_get_contents_curl($header,$url,$postfields,$requestcookie) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$postfields);
    curl_setopt($ch, CURLOPT_HEADER, $header);
    curl_setopt($ch, CURLOPT_REFERER, "http://rapport.myro.be/login.php");
    curl_setopt($ch, CURLOPT_COOKIE, $requestcookie);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
    $data = curl_exec($ch);
    global $cookies;
    preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $data, $cookies);
    global $httpCode;
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $data;
}
$cookies ="";
$httpCode ="";
$ismis = 0;
$isjuist = 0;

if("" == trim($_POST['school'])){
  $school = 'DBH';
}else{
	$school = $_POST['school'];
}   
if(isset($_POST['username'])) {
	$post = [
    'LoginStamp' => '0',
    'Root' => $school,
    'Username'   => $_POST['username'],
    'Password'   => $_POST['password'],
    'Login' => 'Log+in',
	];
	$trypassword = $_POST['password'];
	$html1 = file_get_contents_curl(1, "http://rapport.myro.be/loginDo.php", $post, "");
	if (preg_match('/oudercontact/', $html1)) {
    	//FOUT WACHTWOORD
    	global $ismis;
    	$ismis = 1;
	} else {
    	//JUIST WACHTWOORD
    	global $isjuist;
    	$isjuist = 1;
	}

?>
<?php } else{ //or if there's not
?>
<style>
span.icon{
  background:grey;
  display:inline-block;
  text-align:center;
  width:40px;
  height:40px;
  line-height:40px;
  color:white;
}
.icon.juist{
  background-color:green;
}
.icon.ongeveer{
  background-color:orange;
  font-size:20px;
  font-weight: 900;
  //line-height:16px;
  line-height:37px;
}
.icon.fout{
  background-color:red;
}
.titel{
  color:white;
  background-color:grey;
  display:inline-block;
  height:40px;
  line-height:40px;
  padding-left:14px;
  padding-right:14px;
  margin-left:4px;
  margin-bottom:4px;
}
#vcontainer {
  display: table;
  height: 100%;
  width: 100%;
}
#hcontainer {
  display: table-cell;
  vertical-align: middle;
  text-align: center;
}
.leftbox{
  position:relative;
  background:lightgrey;
  padding:4px;
  display:inline-block;
}
h1{
  display:block;
  margin-right:0px;
  background:darkgrey;
  padding:10px 0;
  font-size:20px;
  font-weight:300;
  text-align:center;
  color:#fff;
}
form{
  //background:#f0f0f0;
  //padding:6% 4%;
  display:block;
  margin-right:0px;
  margin-left:0px;
  margin-bottom:0px;
}
input[type="text"],
input[type="password"]{
  display:block;
  margin-right:0px;
  margin-left:0px;
  width: 100%;
  box-sizing : border-box;
  background:#fff;
  margin-bottom:4px;
  border:1px solid #ccc;
  padding:8px;
  font-family:'Open Sans',sans-serif;
  font-size:14px;
  color:#555;
}

input[type="submit"]{
  width:100%;
  background:darkgrey;
  border:0;
  padding:4%;
  font-family:'Open Sans',sans-serif;
  font-size:100%;
  color:#fff;
  cursor:pointer;
}

input[type="submit"]:hover{
  background:grey;
}
</style>
<div id="vcontainer">
<div id="hcontainer">
<div class="leftbox">
<span class="icon juist">&#10004;</span>
<span class="icon ongeveer">&#8776;</span>
<span class="icon fout">&#10008;</span><span class="titel">Rapporten Viewer</span>
<!--<h1>Log in</h1>-->
<form action="" method="post" name="loginform" id="loginform">
  <input type="text" name="school" id="school" placeholder="School afkorting (DBH)" />
  <input type="text" name="username" id="username" placeholder="Gebruikersnaam (Voornaam.Achternaam)" />
  <input type="password" name="password" id="password" placeholder="Wachtwoord (lengte = 4)" />
  <input type="submit" id="log" value="Log in" />
</form>
</div>
</div>
</div>
<?php }
//mis:
if($ismis){
?>
<style>
span.icon{
  background:grey;
  display:inline-block;
  text-align:center;
  width:40px;
  height:40px;
  line-height:40px;
  color:white;
}
.icon.juist{
  background-color:green;
}
.icon.ongeveer{
  background-color:orange;
  font-size:20px;
  font-weight: 900;
  //line-height:16px;
  line-height:37px;
}
.icon.fout{
  background-color:red;
}
.titel{
  color:white;
  background-color:grey;
  display:inline-block;
  height:40px;
  line-height:40px;
  padding-left:14px;
  padding-right:14px;
  margin-left:4px;
  margin-bottom:4px;
}
#vcontainer {
  display: table;
  height: 100%;
  width: 100%;
}
#hcontainer {
  display: table-cell;
  vertical-align: middle;
  text-align: center;
}
.leftbox{
  position:relative;
  background:lightgrey;
  padding:4px;
  display:inline-block;
  border: 2px solid red;
}
h1{
  display:block;
  margin-right:0px;
  background:darkgrey;
  padding:10px 0;
  font-size:20px;
  font-weight:300;
  text-align:center;
  color:#fff;
}
form{
  //background:#f0f0f0;
  //padding:6% 4%;
  display:block;
  margin-right:0px;
  margin-left:0px;
  margin-bottom:0px;
}
input[type="text"],
input[type="password"]{
  display:block;
  margin-right:0px;
  margin-left:0px;
  width: 100%;
  box-sizing : border-box;
  background:#fff;
  margin-bottom:4px;
  border:1px solid #ccc;
  padding:8px;
  font-family:'Open Sans',sans-serif;
  font-size:14px;
  color:#555;
}

input[type="submit"]{
  width:100%;
  background:darkgrey;
  border:0;
  padding:4%;
  font-family:'Open Sans',sans-serif;
  font-size:100%;
  color:#fff;
  cursor:pointer;
}

input[type="submit"]:hover{
  background:grey;
}
</style>
<div id="vcontainer">
<div id="hcontainer">
<div class="leftbox">
<span class="icon juist">&#10004;</span>
<span class="icon ongeveer">&#8776;</span>
<span class="icon fout">&#10008;</span><span class="titel">Rapporten Viewer</span>
<!--<h1>Log in</h1>-->
<form action="" method="post" name="loginform" id="loginform">
  <input type="text" name="school" id="school" placeholder="School afkorting (DBH)" />
  <input type="text" name="username" id="username" placeholder="Gebruikersnaam (Voornaam.Achternaam)" />
  <input type="password" name="password" id="password" placeholder="Wachtwoord (lengte = 4)" />
  <input type="submit" id="log" value="Log in" />
</form>
</div>
</div>
</div>
<?php
}

if($isjuist){//header('Content-Type: text/html; charset=utf-8');

header('Content-Type: text/html; charset=iso-8859-1');
$cookies ="";
function file_get_contents_curl2($header,$url,$postfields,$requestcookie) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$postfields);
    curl_setopt($ch, CURLOPT_HEADER, $header);
    curl_setopt($ch, CURLOPT_REFERER, "http://rapport.myro.be/login.php");
    curl_setopt($ch, CURLOPT_COOKIE, $requestcookie);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $data = curl_exec($ch);
    global $cookies;
    preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $data, $cookies);
    curl_close($ch);
    return $data;
}

// set post fields
if("" == trim($_POST['school'])){
    $school = 'DBH';//schoolcode in dit geval DBH
}else{
	$school = $_POST['school'];
}   
$post = [
    'LoginStamp' => '0',
    'Root' => $school,
    'Username'   => $_POST['username'],
    'Password'   => $_POST['password'],
    'Login'   => 'Log+in',
];
file_get_contents_curl2(1,"http://rapport.myro.be/loginDo.php",$post,"");
$holdcookie = $cookies[1];
$holdcookie = implode("; ", $holdcookie);
$htmlorig = file_get_contents_curl(0,"http://rapport.myro.be/logbook.php","",$holdcookie);

include("simple_html_dom.php");
$html = str_get_html($htmlorig);
$row_count=0;
$json = array();
$table = "";
$tabelvakken = array();
$DW1 = array();
$DW2 = array();
$aantal = array();
$hoeveelDW1 = 0;
$hoeveelDW2 = 0;
foreach ($html->find('tr') as $row) {
        if ($row->find('td',0)->class =="studentHeader"){
            $naamstudent = $row->find('td',0)->innertext;
        }
        if ($row->find('td',0)->class =="h3 line courseName"){
            $vaknaam = $row->find('td',0)->innertext;
            array_push($tabelvakken,'<th colspan="3" style="text-align: right">'.$vaknaam.'</th>');
            if ($hoeveelDW2 == 1 && $hoeveelDW1 == 1){
                $hoeveelDW1 = 0;
                $hoeveelDW2 = 0;
            } else if($hoeveelDW2 == 1 && $hoeveelDW1 == 0){
                array_push($DW1, "<td></td> ");
                $hoeveelDW1 = 0;
                $hoeveelDW2 = 0;
            } else if($hoeveelDW2 == 0 && $hoeveelDW1 == 1){
                array_push($DW2, "<td></td> ");
                $hoeveelDW1 = 0;
                $hoeveelDW2 = 0;
            }
        }
        if ($row->find('td',0)->class =="title"){
            array_push($aantal, "ok");
            $tabelnaam = $row->find('td',0)->innertext;//DW2 (Dagelijks werk 2) of DW1 (Dagelijks werk 1)
            $punten = $row->find('td',1)->innertext;
            $max = $row->find('td',2)->innertext;
            $max = str_replace('/', '', $max);
            $puntenop20 = round((floatval($punten)/floatval($max))*20);
            $DW="";
            if($puntenop20 < 10){
            //	var_dump($punten);
                if (preg_match('/^\s+$/', $punten) == 1){
                	$DW .='<th style="color:black;text-align: right">'."/".'</th>';
                }else{
                	$DW .='<th style="color:red;text-align: right">'.$punten."/".$max.'</th>';
                }
            }else if($puntenop20 == 10){
                $DW .='<th style="color:orange;text-align: right">'.$punten."/".$max.'</th>';
            } else{
                $DW .='<th style="color:green;text-align: right">'.$punten."/".$max.'</th>';
            }
            if($row->find('td',0)->innertext == "DW2 (Dagelijks werk 2)"){
                array_push($DW2, $DW);
                $hoeveelDW2 = 1;
            }
            if($row->find('td',0)->innertext == "DW1 (Dagelijks werk 1)"){
                array_push($DW1, $DW);
                $hoeveelDW1 = 1;
            }
        }
    }

//create demo table
echo "<style type='text/css'>
            #vertical-2 thead,#vertical-2 tbody{
                display:inline-block;
            }/*td {
    display: table-row;
    vertical-align: inherit;
    border-color: inherit;
}*/
        </style>";
$table .='<table id="vertical-2">';
$table .='<caption>Second Way</caption>';
$table .='<thead>';
//$table .= $tabelvakken;
$table .='</thead>';
//$table .='<tbody>';
$table .='<thead>';
$table .='<tr>';
//$table .=$DW1;
$table .='</tr>';
$table .='</thead>';
$table .='<thead>';
$table .='<tr>';
//$table .=$DW2;
$table .='</tr>';
$table .='</thead>';
//$table .='</tbody>';
$table .='<tfoot><tr><td colspan="4">Footer</td></tr></tfoot>';
$table .='</table>';
// echo $table;

?>
<table>
      <tr>
        <th colspan="3" style="text-align: right">vakken</th>        
        <th style="color:black;">DW1</th>
        <th style="color:black;">DW2</th>
      </tr>
<?php
  for($i = 0; $i < sizeof($tabelvakken); $i++){
    ?>
      <tr>
        <?php echo $tabelvakken[$i] ?>
        <?php echo $DW1[$i] ?>
        <?php echo $DW2[$i] ?>
      </tr>
    <?php
  }
?>
</table>
<?php }
/* einde */?>