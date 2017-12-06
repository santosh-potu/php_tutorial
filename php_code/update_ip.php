<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//set_time_limit(-1);

require_once ('library/config.php');

error_reporting(E_ALL && ~E_NOTICE);
ini_set('display_errors', 'true');

?>
<?php
$minus_query = "SELECT DISTINCT t.ip_address
FROM ip_hits t LEFT JOIN ip_details i ON t.ip_address = i.ip_address
WHERE i.ip_address IS NULL";
    
$result = $mysqli->query($minus_query) or die($minus_query." -".$mysqli->error);

$insert_query = "INSERT INTO ip_details (ip_address, country_name, country_code,
    region_code,region_name,city,
    longitude,latitude,area_code,zip_code,metro_code ) VALUES ";
while ($row = $result->fetch_array()) {
        $ip =  $row[0];
        $ip_url = "http://freegeoip.net/json/$ip" ;
        $location_detail = json_decode(file_get_contents($ip_url));
        
        
        $city = $location_detail->city;
        $area_code = $location_detail->areacode;
        $region_code = $location_detail->region_code;
        $region_name = $location_detail->region_name;
        $metro_code = $location_detail->metro_code;
        $zip_code = $location_detail->zipcode;
        $country_name = $location_detail->country_name;
        $country_code = $location_detail->country_code;
        $longitude = $location_detail->longitude;
        $latitude = $location_detail->latitude;
        
        $insert_query .= "  ('$ip', '$country_name' , '$country_code' ,
            '$region_code', '$region_name' , '$city',
            '$longitude', '$latitude', '$area_code',
            '$zip_code', '$metro_code' ) ,";
        
}

$insert_query = rtrim($insert_query,',');

//echo $insert_query;
if($mysqli->affected_rows){
    $mysqli->query($insert_query) or die($insert_query." - ".$mysqli->error);
    $messages[] = "<div> <strong> Execution done. Affected rows: ".  $mysqli->affected_rows ."</strong></div> ";
}else{
   $messages[] = " <div> <strong> no records updated now</strong></div>"; 
    
}

$records_per_page = 30;
$current_page = ((int)$_REQUEST['page']?(int)$_REQUEST['page']:1);



$lower_limit = ($current_page - 1)*$records_per_page;

$upper_limit = $lower_limit + $records_per_page;

$location_query  = " SELECT SQL_CALC_FOUND_ROWS i.* , t.hit_count  FROM (SELECT SUM(hits) as hit_count,ip_address FROM ip_hits GROUP BY ip_address) t 
        INNER JOIN  ip_details i ON t.ip_address = i.ip_address 
         ORDER BY t.hit_count DESC,i.country_name DESC,i.city DESC LIMIT $lower_limit , $upper_limit ";
$result = $mysqli->query($location_query);
$result_count = $mysqli->affected_rows;
$ip_count = $mysqli->query("SELECT FOUND_ROWS() AS total_count")->fetch_object();
$ip_count = $ip_count->total_count;
$total_pages = ceil($ip_count/$records_per_page);

 $table_string = "";
 $row_count = 0;
 $total_hits = 0;

 if($result_count){
 
    
    $messages[] =  " <div> <strong> Address Count :".$ip_count."</strong></div>";
    $table_string .= "<table cellpadding='3' cellspacing='3' border='3' >";
    $table_string .= "<thead><th>&nbsp;</th><th>IP Address</th>
                             <th>Hits</th>
                             <th>City</th>
                             <th>Country</th>
                             <th>Country Code</th>                             
                             <th>Region</th>
                             <th>Region Code</th>
                             <th>Zip code</th>
                             <th>Area code</th>
                             <th>Metro code</th>
                             <th>Longitude</th>
                             <th>Latitude</th>
                             </thead><tbody>";
    
        while($my_row = $result->fetch_object()){
          
            // for clean display of html
            foreach($my_row as $key => $value) {
                   if(!$value) $my_row->$key = '&nbsp;';
            }
            $total_hits = $total_hits + $my_row->hit_count ;            
            if($row_count++ % 2 == 0 ){
                $class_string = 'even';
            }else{
                $class_string = 'odd';
            }
            $table_string .= "<tr class='$class_string'>
                        <td>".($row_count+$lower_limit)."</td>
                        <td>$my_row->ip_address</td>
                        <td>$my_row->hit_count</td>
                        <td>$my_row->city</td>  
                        <td>$my_row->country_name</td>
                        <td>$my_row->country_code</td>
                        <td>$my_row->region_name</td>
                        <td>$my_row->region_code</td>
                        <td>$my_row->zip_code</td>
                        <td>$my_row->area_code</td>
                        <td>$my_row->metro_code</td>
                        <td>$my_row->longitude</td>
                        <td>$my_row->latitude</td>
                </tr>";
            
        }
        if($total_pages > 1){
            $pages_td_mid = "<span style='text-align;center' width='60%' > 
                <input size='3' type='text' style='text-align:right;' name='page' value='$current_page'/>
                    <input type='submit' style='visibility:hidden;'/></span> "; 
            $pages_td_first = "<span>&nbsp;";
            if($current_page > 1){
                $pages_td_first.= "<a title='First Page' href='update_ip.php?page=1'>&lt&lt</a>";
                $pages_td_first.= "&nbsp;&nbsp;<a title='Previous Page' href='update_ip.php?page=".($current_page-1)."'>&lt</a>";
            }
            $pages_td_first .= "</span>";
            
            $pages_td_last = "<span>&nbsp;";
            if($current_page != $total_pages){
                $pages_td_last.= "<a title='Next Page' href='update_ip.php?page=".($current_page+1)."'>&gt</a>";
                $pages_td_last.= "&nbsp;&nbsp;<a title='Last Page' href='update_ip.php?page=".$total_pages."'> &gt&gt </a>";
            }
            $pages_td_last .= "</span>";
            $pages_row = $pages_td_first.$pages_td_mid.$pages_td_last;
        }else{
            $pages_row = '';
        }        
        if($pages_row){
            $table_string .= "<tr><td style='text-align:center' align='center' colspan='13'><form method='GET'>$pages_row</form></td></tr>";
        }
         $table_string .= "</tbody></table>";
         $messages[] = "<div><strong> Total hits : ".$total_hits."</strong></div>";
}else{
    $table_string = " <div><strong>No Records Found to display</strong></div> ";
}

?>

<html> 
    <head>
        <title> IP address & Location Details</title>
        <style>
            .odd{background-color:buttonface;}
            .even{background-color:burlywood;}
            body {
            font-family: helvetica,arial,verdana;
            font-size: 1em;
            } 
            table{
                font-family: helvetica,arial,verdana;
                font-size: 0.8em;
            }
        </style>
    </head>
    <body>   
    <?php foreach($messages as $message){
        echo "$message";
    }     
    echo  $table_string;
    ?>    
    </body>
</html>