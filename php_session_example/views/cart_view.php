<?php
require_once 'base'.DIRECTORY_SEPARATOR.'header.php';
$cart_products = $args['detailed_products'];

if(count($cart_products) == 0){
        $tr_string .= "<tr><td colspan='5' style='text-align:center;font-weight:bold;'>
            Your Cart is empty To add Product <a href='index/'>Go back to Products</a></td></tr>";
}else{
    foreach($cart_products as $product){       
      
        $shopping_products[] = $product;
        $item_price = $product['product_price'] * $product['qty'];
        $total = $total + $item_price;
        $tr_string .= "<tr>
                      <td class='align_right'><input type='checkbox' name='delete[]' value='{$product['product_id']}'/></td>
                      <td>{$product['product_name']}</td>
                      <td class='align_right' ><input class='align_right' type='text' value='{$product['qty']}' name='qty[{$product['product_id']}]'/></td>
                      <td class='align_right'>{$product['product_price']}</td>
                      <td class='align_right'>$item_price</td>
                      </tr>";
    }
}
    
    echo <<<EOT
    <form method="post" action="/php_tutorial/php_session_example/public_html/cart/update" >
<div style='padding:20px 20px 20px 20px;padding-left:0px;' ><h2>Shopping Cart</h2></div>    
<table border="3" width = "70%" cellspacing="3" cellpadding="3" >
 <thead>
   <th class='align_right' >Delete</th>
   <th>Product</th>
   <th class='align_right' >Quantity</th>
   <th class='align_right' >Item price</th>
   <th class='align_right' >Sub total</th>
 </thead>
 $tr_string
EOT;
if(count($cart_products)){    
    echo <<<EOT
        <tr>
    <td colspan="4" class='align_right'><strong>Total</strong></td>
    <td class='align_right'><strong>$total</strong></td>
    </tr>
    <tr>
    <td colspan="2" style="text-align:right"><input type='button'  value='Back to products'
        onClick="window.location.href='/index'" /></td>        
    <td colspan="2" style="text-align:right"><input type='submit' name='action' value='Update'/></td>
        
    <td><strong>
        <input type='button' name='checkout' value='Check Out' 
            onclick='window.location="/cart/checkout"' /></td>
    </tr>
EOT;
}    
echo "</table></form>";
