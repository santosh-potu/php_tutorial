<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html>
    
    <head>
    <title>
     JQuery Form validation Demo
    </title>   
	        <style>
         * { font-family: Verdana; font-size: 96%; }
        label { width: 10em; float: left; }
    label.error { float: none; color: red; padding-left: .5em; vertical-align: top; }
    p { clear: both; }
    .submit { margin-left: 12em; }
    em { font-weight: bold; padding-right: 1em; vertical-align: top; }
        </style>
        <link rel="stylesheet" href="css/jquery-ui.css">
        <link rel="stylesheet" href="css/datepicker_style.css">
        <script src="scripts/jquery-1.12.4.js"></script>
        <script src="scripts/jquery-ui.js"></script>
        <script type="text/javascript" src="scripts/jquery.validate.min.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function(){
            
        
        $("#register-form").validate({
                rules: {
                    first_name: "required",
                    last_name: "required",
                    email_id: {
                        required: true,
                        email: true
                    },
                    pwd: {
                        required: true,
                        minlength: 5
                    },
                    confirm_pwd: {
                        required: true,
                        minlength: 5,
                        equalTo: '#pwd'
                    }
                    
                },
                messages: {
                    first_name: "Please enter your firstname",
                    last_name: "Please enter your lastname",
                    pwd: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    confirm_pwd: {
                        required: "Please provide confirm password",
                        minlength: "Your confirm password must be at least 5 characters long",
                        equalTo: "Password and confirm pass word should match"
                    },
                    email_id: "Please enter a valid email address"
                    
                },
                submitHandler: function(form) {
                    alert('Sorry this is only for validation demo not for submission');
                    //form.submit();
                }
            });
  
      $('#doj').datepicker({
          dateFormat: "dd-mm-yy"
      });  
      $('#dob').datepicker({
          dateFormat: "dd-mm-yy"
      });
  });
      
    </script>
    </head>
    <body>
        <form id="register-form" method="POST">
        <table border="0" cellspacing="3" cellpadding="3">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><label for="first_name">First name</label></td>
                    <td><input type="text" id="first_name" name="first_name" value="" /></td>
                </tr>
                <tr>
                   <td><label for="last_name">Last Name</label></td>
                    <td><input type="text" id="last_name" name="last_name" value="" /></td>
                </tr>
                <tr>
                    <td><label for="pwd">Password</label></td>
                    <td><input type="password" autocomplete="off" id="pwd" name="pwd" value="" /></td>
                </tr>
                <tr>
                    <td><label for="confirm_pwd">Confirm Password</label></td>
                    <td><input type="password" autocomplete="off" id="confirm_pwd" name="confirm_pwd" value="" /></td>
                </tr>
                <tr>
                    <td><label for="email_id">Email</label></td>
                    <td><input type="text" autocomplete="off" id="email_d" name="email_id" value="" />
                </tr>
                <tr>
                    <td><label for="mobile_number">Mobile</label></td>
                    <td><input type="text" id="mobile_number" name="mobile_number" value="" />
                </tr>
                <tr>
                    <td><label for="phone_number">Phone</label></td>
                    <td><input type="text" id="phone_number" name="phone_number" value="" />
                </tr>
                <tr>
                    <td><label for="dob">Date of birth</label></td>
                    <td><input type="text" id="dob" name="dob" value="" /></td>
                </tr>
                <tr>
                    <td><label for="doj">Date of joining</label></td>
                    <td><input type="text" id="doj" name="doj" value="" /></td>
                </tr>
                
                <tr>
                    <td><input type="submit" name="submit" value="Submit" /></td>
                    <td><input type="reset" name="resetbt" value="Cancel" /></td>
                </tr>
            </tbody>
        </table>
        </form>
    </body>
</html>
