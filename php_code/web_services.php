<?php
require_once ("library".DIRECTORY_SEPARATOR."config.php");
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PWD,DB_NAME);


if($_REQUEST['action'] == 'Get Convertion Rate'){
    try{
         $local_wsdl_path = 'wsdls'.DIRECTORY_SEPARATOR.'CurrencyConvertor.WSDL'; 
          if(is_file($local_wsdl_path)){
             $wsdl_path = $local_wsdl_path ;
          }else{
            if(!is_dir('wsdls')){
                mkdir('wsdls');
            }  
            $wsdl_path = 'http://www.webservicex.net/CurrencyConvertor.asmx?WSDL';
            file_put_contents($local_wsdl_path,file_get_contents($wsdl_path));
          }
        

        $ws_client = new SoapClient($wsdl_path); 
        extract($_REQUEST);
        $ConversionRate = array('FromCurrency'=>$FromCurrency,
            'ToCurrency'=>$ToCurrency);
       
        $ws_result = $ws_client->ConversionRate($ConversionRate);
        
    }catch(Exception $ex){
        $error = $ex->getMessage();
        
    }
}

$select_query = "SELECT * FROM currencies";

if($result = $mysqli->query($select_query)){
    while($currency = $result->fetch_assoc()){
       
     $currencies[$currency['code']]=$currency['description'];
    }
$result->free();


}
function display_dropdown($currencies,$select_name,$selected_value=""){
  
   //array_unshift($currencies, '-Select a Currency-');
    $currencies[''] = '-Select a Currency-';
   ksort($currencies);
   foreach($currencies as $key => $value){
       
       if($selected_value == $key) {
           $selected_text = " selected ='true'";
       }else{
           $selected_text = '';
       }
       $dropdown_html .= "<option value='$key' $selected_text>$key-$value</option>"; 
   }
   
   $dropdown_html = "<select id='$select_name' name='$select_name'>$dropdown_html</select>";
   
   return $dropdown_html;
}
?>
<html>
    <script type="text/javascript">
    function verify(){
        var errors = "";
        if(document.getElementById('FromCurrency').value == ''){
            errors += " From Currency \n";
        }
        if(document.getElementById('ToCurrency').value == ''){
            errors += " To Currency \n";
        }
        if(errors.length > 1){
            errors = "Please select the following value(s)\n\n " + errors;
            alert(errors);
            return false;
        }
     return true;
    }
    </script>
<body>
<form method='GET' onsubmit="return verify();">
<table>
    <tr><td colspan="2">
                <?php if($ws_result){
                    
                    echo " <strong>Conversion Rate for {$FromCurrency} To {$ToCurrency}<br/> 
                        i.e 1 {$currencies[$FromCurrency]} = {$ws_result->ConversionRateResult} {$currencies[$ToCurrency]}</strong> ";
                }
                if($error){
                    echo "<strong><font color='#ff0000'>Following response from Server from error :</strong><br/>$error</font>";
                }
                ?>
            </strong></td></tr>
<tr>
<td>
<label for='FromCurrency'>From Currency</label>
</td>
<td><?php echo display_dropdown($currencies,'FromCurrency',$_REQUEST['FromCurrency']); ?> </td>
</tr>
<tr>
<td>
<label for='ToCurrency'>To Currency</label>
</td>
<td><?php echo display_dropdown($currencies,'ToCurrency',$_REQUEST['ToCurrency']); ?> </td>
</tr>
<tr>
    <td><input type="submit" value="Get Convertion Rate" name="action"/></td>
    <td><input type="reset" value="Cancel" name="reset"/></td>
</tr>
</table>
</form>
<body>
</html>
<?php
if(count($currencies) == 0){
    $test = "AFA-Afghanistan Afghani
    ALL-Albanian Lek
    DZD-Algerian Dinar
    ARS-Argentine Peso
    AWG-Aruba Florin
    AUD-Australian Dollar
    BSD-Bahamian Dollar
    BHD-Bahraini Dinar
    BDT-Bangladesh Taka
    BBD-Barbados Dollar
    BZD-Belize Dollar
    BMD-Bermuda Dollar
    BTN-Bhutan Ngultrum
    BOB-Bolivian Boliviano
    BWP-Botswana Pula
    BRL-Brazilian Real
    GBP-British Pound
    BND-Brunei Dollar
    BIF-Burundi Franc
    XOF-CFA Franc (BCEAO)
    XAF-CFA Franc (BEAC)
    KHR-Cambodia Riel
    CAD-Canadian Dollar
    CVE-Cape Verde Escudo
    KYD-Cayman Islands Dollar
    CLP-Chilean Peso
    CNY-Chinese Yuan
    COP-Colombian Peso
    KMF-Comoros Franc
    CRC-Costa Rica Colon
    HRK-Croatian Kuna
    CUP-Cuban Peso
    CYP-Cyprus Pound
    CZK-Czech Koruna
    DKK-Danish Krone
    DJF-Dijibouti Franc
    DOP-Dominican Peso
    XCD-East Caribbean Dollar
    EGP-Egyptian Pound
    SVC-El Salvador Colon
    EEK-Estonian Kroon
    ETB-Ethiopian Birr
    EUR-Euro
    FKP-Falkland Islands Pound
    GMD-Gambian Dalasi
    GHC-Ghanian Cedi
    GIP-Gibraltar Pound
    XAU-Gold Ounces
    GTQ-Guatemala Quetzal
    GNF-Guinea Franc
    GYD-Guyana Dollar
    HTG-Haiti Gourde
    HNL-Honduras Lempira
    HKD-Hong Kong Dollar
    HUF-Hungarian Forint
    ISK-Iceland Krona
    INR-Indian Rupee
    IDR-Indonesian Rupiah
    IQD-Iraqi Dinar
    ILS-Israeli Shekel
    JMD-Jamaican Dollar
    JPY-Japanese Yen
    JOD-Jordanian Dinar
    KZT-Kazakhstan Tenge
    KES-Kenyan Shilling
    KRW-Korean Won
    KWD-Kuwaiti Dinar
    LAK-Lao Kip
    LVL-Latvian Lat
    LBP-Lebanese Pound
    LSL-Lesotho Loti
    LRD-Liberian Dollar
    LYD-Libyan Dinar
    LTL-Lithuanian Lita
    MOP-Macau Pataca
    MKD-Macedonian Denar
    MGF-Malagasy Franc
    MWK-Malawi Kwacha
    MYR-Malaysian Ringgit
    MVR-Maldives Rufiyaa
    MTL-Maltese Lira
    MRO-Mauritania Ougulya
    MUR-Mauritius Rupee
    MXN-Mexican Peso
    MDL-Moldovan Leu
    MNT-Mongolian Tugrik
    MAD-Moroccan Dirham
    MZM-Mozambique Metical
    MMK-Myanmar Kyat
    NAD-Namibian Dollar
    NPR-Nepalese Rupee
    ANG-Neth Antilles Guilder
    NZD-New Zealand Dollar
    NIO-Nicaragua Cordoba
    NGN-Nigerian Naira
    KPW-North Korean Won
    NOK-Norwegian Krone
    OMR-Omani Rial
    XPF-Pacific Franc
    PKR-Pakistani Rupee
    XPD-Palladium Ounces
    PAB-Panama Balboa
    PGK-Papua New Guinea Kina
    PYG-Paraguayan Guarani
    PEN-Peruvian Nuevo Sol
    PHP-Philippine Peso
    XPT-Platinum Ounces
    PLN-Polish Zloty
    QAR-Qatar Rial
    ROL-Romanian Leu
    RUB-Russian Rouble
    WST-Samoa Tala
    STD-Sao Tome Dobra
    SAR-Saudi Arabian Riyal
    SCR-Seychelles Rupee
    SLL-Sierra Leone Leone
    XAG-Silver Ounces
    SGD-Singapore Dollar
    SKK-Slovak Koruna
    SIT-Slovenian Tolar
    SBD-Solomon Islands Dollar
    SOS-Somali Shilling
    ZAR-South African Rand
    LKR-Sri Lanka Rupee
    SHP-St Helena Pound
    SDD-Sudanese Dinar
    SRG-Surinam Guilder
    SZL-Swaziland Lilageni
    SEK-Swedish Krona
    TRY-Turkey Lira
    CHF-Swiss Franc
    SYP-Syrian Pound
    TWD-Taiwan Dollar
    TZS-Tanzanian Shilling
    THB-Thai Baht
    TOP-Tonga Pa'anga
    TTD-Trinidad&amp;Tobago Dollar
    TND-Tunisian Dinar
    TRL-Turkish Lira
    USD-U.S. Dollar
    AED-UAE Dirham
    UGX-Ugandan Shilling
    UAH-Ukraine Hryvnia
    UYU-Uruguayan New Peso
    VUV-Vanuatu Vatu
    VEB-Venezuelan Bolivar
    VND-Vietnam Dong
    YER-Yemen Riyal
    YUM-Yugoslav Dinar
    ZMK-Zambian Kwacha
    ZWD-Zimbabwe Dollar";


    $test = explode("\n",$test);
    $currencies = array();

    $mysqli->autocommit(FALSE);
    try{
    $query = " create table if not exists currencies (id int not null auto_increment,primary key (id),code varchar(10) not null,unique(code),description varchar(100) not null,unique(description))";
    if(!$mysqli->query( $query)){
        throw new Exception($mysqli->error);
    }else{
        echo "Successfully created Table";
    }


    $insert_query = " INSERT INTO currencies (code,description) VALUES ";
    foreach($test as $currency){
    $currencies[] = trim(substr_replace($currency,'',strpos($currency,'-'),strlen($currency)));
    $descriptions[] = trim(substr_replace($currency,'',0,strpos($currency,'-')+1));
    $insert_query .= "('".end($currencies)."','".$mysqli->real_escape_string(end($descriptions))."') ,";
    }

    $insert_query = rtrim($insert_query,',');
   

    if(!$mysqli->query( $insert_query)){
        throw new Exception($mysqli->error);
    }

    echo "<br/> Successfully inserted {$mysqli->affected_rows} Records";
    $mysqli->commit();
    }catch(Exception $ex){
        echo $mysqli->error;
        $mysqli->rollback();
    }
}

?>