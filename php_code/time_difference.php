<?php


if($_SERVER['REQUEST_METHOD'] == 'POST'){
 
    extract($_POST);
  
   if (version_compare(PHP_VERSION, '5.3.0') >= 0) { 
       
       /*
        * 
        * $date1=date_create("2013-03-15"); // >= php 5.2
            $date2=date_create("2013-12-12"); 
            $diff=date_diff($date1,$date2); // > =5.3
        */
        $first_date = new DateTime($date_picker1);
        $second_date = new DateTime($date_picker2);

        $time_interval = $first_date->diff($second_date);

        
        $response_text = "The Time Difference between the dates $date_picker2 & $date_picker1 is : " ;
        
        if($time_interval->y){
            
            $response_text.= " {$time_interval->y} Year(s)";
        }
        
        
            
            $response_text.= " {$time_interval->m} Month(s)";
        
        
        $response_text.= " {$time_interval->d} Day(s)";
        
        $response_text .= " <br/> Total Difference in Days: {$time_interval->days} <br/><br/>";
   
        
       }else{
       
       $first_date = strtotime($date_picker1);
       $second_date = strtotime($date_picker2);

       /* $diff = abs($second_date - $first_date);
       
       $years = date("Y",$diff) - 1970;
       $months = date("m",$diff) - 1;
       $days = date("d",$diff);
       */
       
       $diff = _date_diff($first_date,$second_date);
       
       $years = $diff['y'];
       $months = $diff['m'];
       $days =  $diff['d'];
       
       $diff_total_days = $diff['days'];
       
        $response_text = "The Time Difference between the dates $date_picker2 & $date_picker1 is : " ;
        
        if($years){
            
            $response_text.= " {$years} Year(s)";
        }
        
        
            
            $response_text.= " {$months} Month(s)";
        
        
        $response_text.= " {$days} Day(s)";
        
        $response_text .= " <br/> Total Difference in Days: {$diff_total_days} <br/><br/>";
   
       }     
}
?>

<html>
    <head>
        <title>Time Difference Example</title>
        <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
        <script src="scripts/jquery-1.8.2.min.js"></script>
        <script src="scripts/jquery-ui.js"></script>
        <script type="text/javascript">
            $(function() {
                 $( "#date_picker1" ).datepicker({
  altFormat: "dd-mm-yy"
});
                 $( "#date_picker2" ).datepicker();
                 $( "#date_picker2" ).datepicker( "option", "altFormat", "dd-mm-yy" ).datepicker( "option", "autoSize", true );
            });
        </script>
    </head>
    <body>
        
        <div id = "responseArea">
            
            <?php echo $response_text; ?>
            
        </div>
        <div>
        <form method="post">
            <table style="vertical-align:central;">
                <tr>
                    <td>
                        <label for="date_picker1">First Date</label></td><td>
                        <input id="date_picker1" name="date_picker1" type="text"/>                        
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="date_picker2">Second Date</label>
                    </td><td>    
                        <input id="date_picker2" name="date_picker2" type="text"/>                        
                    </td>
                </tr>
                <tr>
                    <td >
                        <input type="submit" value="Submit" />
                    </td>
                    <td>
                        <input type="reset" value="Cancel" />    
                    </td>
                    
                </tr>
                    

            </table>
        </form>
        </div>
    </body>
</html>

<?php

function _date_range_limit($start, $end, $adj, $a, $b, $result)
{
    if ($result[$a] < $start) {
        $result[$b] -= intval(($start - $result[$a] - 1) / $adj) + 1;
        $result[$a] += $adj * intval(($start - $result[$a] - 1) / $adj + 1);
    }

    if ($result[$a] >= $end) {
        $result[$b] += intval($result[$a] / $adj);
        $result[$a] -= $adj * intval($result[$a] / $adj);
    }

    return $result;
}

function _date_range_limit_days($base, $result)
{
    $days_in_month_leap = array(31, 31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    $days_in_month = array(31, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

    _date_range_limit(1, 13, 12, "m", "y", $base);

    $year = $base["y"];
    $month = $base["m"];

    if (!$result["invert"]) {
        while ($result["d"] < 0) {
            $month--;
            if ($month < 1) {
                $month += 12;
                $year--;
            }

            $leapyear = $year % 400 == 0 || ($year % 100 != 0 && $year % 4 == 0);
            $days = $leapyear ? $days_in_month_leap[$month] : $days_in_month[$month];

            $result["d"] += $days;
            $result["m"]--;
        }
    } else {
        while ($result["d"] < 0) {
            $leapyear = $year % 400 == 0 || ($year % 100 != 0 && $year % 4 == 0);
            $days = $leapyear ? $days_in_month_leap[$month] : $days_in_month[$month];

            $result["d"] += $days;
            $result["m"]--;

            $month++;
            if ($month > 12) {
                $month -= 12;
                $year++;
            }
        }
    }

    return $result;
}

function _date_normalize($base, $result)
{
    $result = _date_range_limit(0, 60, 60, "s", "i", $result);
    $result = _date_range_limit(0, 60, 60, "i", "h", $result);
    $result = _date_range_limit(0, 24, 24, "h", "d", $result);
    $result = _date_range_limit(0, 12, 12, "m", "y", $result);

    $result = _date_range_limit_days($base, $result);

    $result = _date_range_limit(0, 12, 12, "m", "y", $result);

    return $result;
}

/**
 * Accepts two unix timestamps.
 */
function _date_diff($one, $two)
{
    $invert = false;
    if ($one > $two) {
        list($one, $two) = array($two, $one);
        $invert = true;
    }

    $key = array("y", "m", "d", "h", "i", "s");
    $a = array_combine($key, array_map("intval", explode(" ", date("Y m d H i s", $one))));
    $b = array_combine($key, array_map("intval", explode(" ", date("Y m d H i s", $two))));

    $result = array();
    $result["y"] = $b["y"] - $a["y"];
    $result["m"] = $b["m"] - $a["m"];
    $result["d"] = $b["d"] - $a["d"];
    $result["h"] = $b["h"] - $a["h"];
    $result["i"] = $b["i"] - $a["i"];
    $result["s"] = $b["s"] - $a["s"];
    $result["invert"] = $invert ? 1 : 0;
    $result["days"] = intval(abs(($one - $two)/86400));

    if ($invert) {
        _date_normalize($a, $result);
    } else {
        _date_normalize($b, $result);
    }

    return $result;
}

?>