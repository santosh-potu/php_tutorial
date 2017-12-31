<div>
    <?php if(\Kus\AuthenticationHelper::isLogged()) { 
                echo "<span><a href='login/out'>Logout</a></span>";
            }
    ?>
</div>

