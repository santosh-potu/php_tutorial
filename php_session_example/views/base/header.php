    <head>
    <title>
     Session Demo    
    </title>    
        <style>
            .align_right{
                text-align: right;
            }
            input[type='button'], input[type="submit"], input[type="reset"]{
                font-weight:bold;
            }
        </style>
    <script type="text/javascript" src="scripts/jquery-3.2.1.min.js"></script>
    <script type="text/javascript">
    function verifyForm(){
        
        if ($("input[name='products[]']:checked").length > 0){
            return true;
        }else{
            alert('Please check at least one product to add cart!')
                return false;
        }
    }
    </script>
    </head>

<div>
    <?php if(\Kus\AuthenticationHelper::isLogged()) { 
                echo "<span><a href='login/out'>Logout</a></span>";
            }
    ?>
</div>

