<?php
require_once 'base'.DIRECTORY_SEPARATOR.'header.php';

$products = $args['products'];
?>
<h1> Products </h1> (<a title="View Cart" href="cart/view">View Cart</a>) 
    <form method="post" action="cart/add" onsubmit="return verifyForm();">
           
        <table width="80%" border="1" cellspacing="3" cellpadding="3" >
            <?php
              for($i=0;$i<count($products);){
                  echo "<tr>";
                  for($j=0;$j<3;$j++){
                      if( ($i+$j)>= count($products)) break;
                      displayProduct($products[$i+$j]);
                  }
                  $i = $i+$j;
                  echo "</tr>";
              }
            ?>
            <tr><td colspan="2" align="right"><input  type="submit" value="Add to Cart"/></td><td><input type="reset" value="cancel"/></td></tr>
        </table>

<?php
function displayProduct($product){
    echo "<td align='center'><b>Product:</b>{$product['product_name']} </br>";
    
    echo "<b>Price:</b>{$product['product_price']} </br>
            <input type='checkbox' name='products[]' value='{$product['product_id']}'/>&nbsp;Qty            
            <input size='3' type='text' class='align_right' name='product_quantity[{$product['product_id']}]' value='1' /></td>";
}


