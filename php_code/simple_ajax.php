<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(count($_REQUEST) > 1){
    echo $_SERVER['HTTP_X_REQUESTED_WITH']; /// will work only if you uses jquery/mootools/prototype
    
    echo "<pre>";
    echo "<strong> Your Requested Parameters are <br/> </strong>";
    print_r($_REQUEST);
    echo "<strong> Your Request detail/ php $"."_SERVER global varibale is <br/> </strong>";
    print_r($_SERVER);
    echo "</pre>";

    exit;
}
?>
<html>
    <head>
        <title>
            Simple Ajax Example
        </title>
        <script type="text/javascript">
        function getXmlHttpRequest(){
            
            if(typeof httpRequest != 'undefined'){
                return httpRequest;
            }
            if(window.XMLHttpRequest){
                try{
                    httpRequest = new XMLHttpRequest();//IE7 and above mozilla
                }catch(e){
                    httpRequest = false;
                }
            }else if(window.ActiveXObject){
                try{
                    httpRequest = new ActiveXObject("Msxml2.XMLHTTP");//IE 6
                }catch(e){
                    try{
                        httpRequest = new ActiveXObject("Microsoft.XMLHTTP/");//IE5
                    }catch(e){
                        httpRequest = false;
                     }
                }
            }
            if(httpRequest != false){
                httpRequest.onreadystatechange = function() {//Call a function when the state changes.
                        if(httpRequest.readyState == 4 && httpRequest.status == 200) {
                            document.getElementById('ajax_output_div').innerHTML = httpRequest.responseText;
                        }
                    }
            }    
            return httpRequest;
        }
        function simpleAjaxGetMethod(){
            httpRequest = getXmlHttpRequest();
            if(httpRequest == false){
                alert('your browser does not support ajax');
                return false;
            }
            target_url = '<?php echo $_SERVER['PHP_SELF']?>';
            var first_name = document.getElementById('first_name').value;
            var last_name = document.getElementById('last_name').value;
            target_url += '?first_name='+first_name+'&last_name='+last_name;
            httpRequest.open('GET',target_url);            
            document.getElementById('ajax_output_div').innerHTML = 'Loading ...';
            httpRequest.send();
        }
        function handle_response(){
            
            if(httpRequest != false){
                alert('httpRequest.readyState = '+httpRequest.readyState);
               if(httpRequest.readyState == 4 && httpRequest.status == 200) {
                            //alert('hi');
                            document.getElementById('ajax_output_div').innerHTML = httpRequest.responseText;
                        }
               
            }
        }
         function simpleAjaxPostMethod(){
              httpRequest = getXmlHttpRequest();
            if(httpRequest == false){
                alert('your browser does not support ajax');
                return false;
            }
            target_url = '<?php echo $_SERVER['PHP_SELF']?>';
            var first_name = document.getElementById('first_name').value;
            var last_name = document.getElementById('last_name').value;
            post_params = 'first_name='+first_name+'&last_name='+last_name;
            
            httpRequest.open('POST',target_url);
            
            //Send the proper header information along with the request
            //optional ? as it worked without this also
                httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                httpRequest.setRequestHeader("Content-length", post_params.length);
                httpRequest.setRequestHeader("Connection", "close");
            // optional as alreay we defined but should be before send
            httpRequest.onreadystatechange = handle_response; 
                
            document.getElementById('ajax_output_div').innerHTML = 'Loading ...';    
            httpRequest.send(post_params);
         }
            
        
         </script>
    </head>
    <body>
        <form onsubmit="alert('you can not submit this form in normal method(by pressing ENTER/submit button \n so please use link to submit \n\n it will submit using ajax');return false;">  
        <table width="70%">
            
            <tr>
                <td>
                    First Name
                </td>
                <td>
                    <input type="text" readonly="true" value="Santosh" name="first_name" id="first_name" />
                </td>
            </tr>
            <tr>
                <td>
                    Last Name
                </td>
                <td>
                    <input type="text" readonly="true" value="Potu" name="last_name" id="last_name" />
                </td>
            </tr>
            <tr>
                
                <td >
                    <input type="submit" value="submit"/>
                </td>
                <td>
                    <input type="reset" value ="cancel"/>
                </td>
            </tr>    
            <tr>
                <td colspan="2">
                    <a onclick="return simpleAjaxGetMethod();" href="javascript:void(0);" >Click here to submit using ajax by GET method</a>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <a href="javascript:void(0);" onclick="return simpleAjaxPostMethod();">Click here to submit using ajax by POST method</a>
                </td>
            </tr>
        </table>
            <span><br/><strong>Ajax Output will be displayed below:</strong></span>
            <div id="ajax_output_div" style="font-size:0.9em">
                      
                    </div>
            
        </form>
    </body>
</html>
