<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

error_reporting(E_ALL && ~E_WARNING && ~E_NOTICE);
ini_set('display_errors','on');
set_time_limit(150);


if(!empty($_POST)){
$target_url = 'http://www.paramdhaam.com:8080/astro/admin/freestuff100.jsp?R1=Weekly';
$cookie = "";

$ch = curl_init($target_url);

curl_setopt($ch, CURLOPT_HEADER, 1);   //also get hader
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // dont echo the output

curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,60); 
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        
$resp = curl_exec($ch);
if($resp === false){
    echo 'Curl error No:'.curl_errno($ch).'<br/>Curl error: ' . curl_error($ch);
    exit;
}
list($headers, $response) = explode("\r\n\r\n", $resp, 2);
// $headers now has a string of the HTTP headers
// $response is the body of the HTTP response

$headers = explode("\n", $headers);

foreach($headers as $header) {
    if (stripos($header, 'Set-Cookie:') !== false) {
        $cookie = str_replace("Set-Cookie:","",$header);
        $cookie = str_replace(" Path=/astro","",$cookie);
       // echo $cookie;
        //die();
    }
}
curl_close($ch);
 
echo preg_replace('#<script(.*?)>(.*?)</script>#is', '', get_content('http://www.paramdhaam.com:8080/astro/admin/nasmain.jsp'));
//echo "<textarea rows='300' cols='300' >".get_content('http://www.paramdhaam.com:8080/astro/admin/nasmain.jsp')."</textarea>";
exit;
}
$today = date('d/m/Y', time());
list($curr_date,$curr_month,$curr_year) = explode("/", $today);

?>
<?php
// startup check wheather url is working or not
$target_url = 'http://www.paramdhaam.com:8080/astro/admin/freestuff100.jsp?R1=Weekly';
$cookie = "";

$ch = curl_init($target_url);

curl_setopt($ch, CURLOPT_HEADER, 1);   //also get hader
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // dont echo the output

curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,60); 
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        
$resp = curl_exec($ch);
if($resp === false){
    $curl_error =  'Curl error No:'.curl_errno($ch).'<br/>Curl error: ' . curl_error($ch);
    
}
?>
<html>
    <head>
        <title>
            Your Horoscope
        </title>
    </head>    
    <body> 
        <div style="font-weight:bold;text-align: center;height: 10%">
            <?php if($curl_error) {
                echo $curl_error;
            }?>
        </div>
<form method="POST" enctype="application/x-www-form-urlencoded">
    <table border="2" width="30%" align="center" cellspacing="3" cellpadding="3">
        <thead>
                <th colspan="2">Enter Your Details to get horoscope</th>
        </thead>
        <tr>
            <td>
                <label for="txtname">Name</label>
            </td>
            <td><input type="text" name="txtname" id="txtname" value="s" /></td>
        </tr>
        <tr>
            <td>
                <label for="email">Email</label>
            </td>
            <td><input type="text" name="email" id="email" value="s@s.com"/></td>
        </tr>
        <tr>
            <td>
                <label for="Hour">Birth time</label>
            </td>
            <td><input type="text" name="Hour" id="Hour"  size="3" value="9" />&nbsp;
                <input type="text" name="Min" id="Min"  size="3" value="42" />
                <input type="hidden" name="Sec" value="00"/>
            <input type="hidden" name="East" value="East"/>
            <input type="hidden" name="Zone" value="5.5"/>
            </td>
        </tr>
        <tr>
            <td>
                <label for="Day">Birth Date</label>
            </td>
            <td>                
                <select name="Day" id="Day">
                    <?php for($i=1;$i<32;$i++){
                        if($i == '16'){
                            $selected = "Selected = 'true' ";
                        }else{
                            $selected = '';
                        }
                    echo "<option $selected value='$i'>$i</option> ";
                     } ?>
                </select>&nbsp;
                <select name="Month" id="Month">
                    <?php for($i=1;$i<13;$i++){
                        if($i == '1'){
                            $selected = "Selected = 'true' ";
                        }else{
                            $selected = '';
                        }
                    echo "<option $selected value='$i'>$i</option> ";
                     } ?>
                </select>&nbsp;
                <select name="Year" id="Year">
                    <?php for($i=1914;$i< ($curr_year + 1) ;$i++){
                        if($i == '1982'){
                            $selected = "Selected = 'true' ";
                        }else{
                            $selected = '';
                        }
                    echo "<option value='$i' $selected >$i</option> ";
                     } ?>
                </select>&nbsp;          
            
            </td>
        </tr>
        <tr>
            <td>
                <label for="City">City</label>
            </td>
            <td><input type="text" name="City" id="City" value="Mancheral" /></td>
        </tr>
        <tr>
            <td>
                <label for="Long">Longitude</label>
            </td>
            <td><input type="text" name="LonDeg" id="LonDeg"  size="3" value="79" />&nbsp;
                <input type="text" name="LonMin" id="LonMin"  size="3" value="26" /></td>
        </tr>
        <tr>
            <td>
                <label for="Long">Latitude</label>
            </td>
            <td><input type="text" name="LatDeg" id="LonDeg"  size="3" value="18" />&nbsp;
                <input type="text" name="LatMin" id="LatMin"  size="3" value="52" /></td>
        </tr>
        <tr>
            <td>
                <label for="Choice">Type</label>
            </td>
            <td><select name="Choice" id="Choice">
                    <option value="Weekly">Weekly</option>
                    <option value="Daily">Daily</option>
                    <option value="Yearly">Yearly</option>
                    <option value="Life">Life</option>
                </select></td>
        </tr>
        <tr>
            <td>
                <label for="Gender">Gender</label>
            </td>
            <td><select name="Gender" id="Gender">
                    <option value="M_Pdhaam">Male</option>
                    <option value="F_Pdhaam">Female</option>
                </select></td>
        </tr>
        
        <tr>
            <td>
                <label for="Day1">Current Date</label>
            </td>
            <td>                
                <select name="Day1" id="Day1">
                    <?php for($i=1;$i<32;$i++){
                        if($i == $curr_date){
                            $selected = "Selected = 'true' ";
                        }else{
                            $selected = '';
                        }
                    echo "<option $selected value='$i'>$i</option> ";
                     } ?>
                </select>&nbsp;
                <select name="Month1" id="Month1">
                    <?php for($i=1;$i<13;$i++){
                         if($i == $curr_month){
                            $selected = "Selected = 'true' ";
                        }else{
                            $selected = '';
                        }
                    echo "<option $selected value='$i'>$i</option> ";
                     } ?>
                </select>&nbsp;
                <select name="Year1" id="Year1">
                    <?php for($i=1913;$i< ($curr_year +1);$i++){
                         if($i == $curr_year){
                            $selected = "Selected = 'true' ";
                        }else{
                            $selected = '';
                        }
                    echo "<option value='$i' $selected >$i</option> ";
                     } ?>
                </select>&nbsp;          
            
            </td>
        </tr>
        <tr>
            <td><input type="submit" name="submit"/></td>
            <td><input type="reset" value="cancel"/></td>
        </tr>
    </table>    
</form>
<?php
function get_content($url,$ref = ''){
    global $cookie;
       
       if(!$ref) $ref = 'http://www.paramdhaam.com:8080/astro/admin/freestuff2.jsp' ;
        
        $browser = $_SERVER['HTTP_USER_AGENT'];
        //Yearly,Daily,Life
        $fields = $_POST;/*array(
                'Choice' =>  'Weekly',
                 'Day'	=> '16',
                  'Day1' => '16',
                  'East' => 'East',
                   'Gender' =>	'M_Pdhaam',
                    'Hour' =>	'9',
                       'LatDeg' =>	'18',
                        'LatMin' =>	'52',
                        'LonDeg' =>	'79',
                        'LonMin' =>	'26',
                        'Min' =>	'42',
                        'Month' =>	'1',
                        'Month1' =>	'12',
                        'Sec' =>	'00',
                        'Year' =>	'1982',
                        'Year1' =>	'2013',
                        'Zone' =>	'5.5'); */
        
        $fields_string = '';
        foreach($fields as $key=>$value) {
            $fields_string .= $key.'='.$value.'&'; 
            
        }
        $fields_string = rtrim($fields_string,'&');
        $url = $url.'?'.$fields_string;
         
        //echo "<pre>";
        //print_r(array_diff($_POST,$fields));
        //echo "</pre>";
        
        //die();
        $ch = curl_init();
        
        $header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
        $header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
        $header[] = "Cache-Control: max-age=0";
        $header[] = "Connection: keep-alive";
        $header[] = "Keep-Alive: 300";
        $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
        $header[] = "Accept-Language: en-us,en;q=0.5";
        $header[] = "Host:www.paramdhaam.com:8080";
        $header[] = "Pragma: "; // browsers keep this blank.

        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $browser);
        curl_setopt($ch,CURLOPT_COOKIE, $cookie);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_REFERER, $ref);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,60); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        //curl_setopt($ch, CURLOPT_AUTOREFERER, false);
        
        //curl_setopt($ch, CURLOPT_POST, 1);  
        
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $html = curl_exec($ch);
        if($html === false){
            echo 'Curl error: ' . curl_error($ch);
         exit;
        }
        curl_close ($ch);
        return $html;
}
?>