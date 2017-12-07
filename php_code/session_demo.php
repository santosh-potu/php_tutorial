<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ('library/config.php');


$current_script = basename($_SERVER['SCRIPT_NAME']);
$action = $_REQUEST['action'];
$current_script = str_ireplace('action2=ViewCart','',$current_script);

switch($action){
        case 'add_cart':            
            $page_title = "Shopping Cart";
            addCart($_POST);
            break;
        case 'Update':             
            $page_title = "Shopping Cart";
            updateCart($_POST);
            break;
        case 'Check Out':
            orderProducts();
            $page_title = "Order Completed!";
            break;
        default:
            if($_REQUEST['action2'] == 'ViewCart'){
                $page_title = "Shopping Cart";
            }else{
            $page_title = "Product list";
            }
      }




$products_query = " SELECT * FROM cart_products ";
$products_rs = $mysqli->query($products_query);
$products = array();


while($row = $products_rs->fetch_array()){
    $products[] = $row;
}


?>
<html>
    
    <head>
    <title>
     Session Demo - <?php echo $page_title ?>    
    </title>    
        <style>
            .align_right{
                text-align: right;
            }
            input[type='button'], input[type="submit"], input[type="reset"]{
                font-weight:bold;
            }
        </style>
    <script type="text/javascript" src="scripts/jquery-1.8.2.min.js"></script>
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
    <body>
      <?php 
      switch($action){
        case 'add_cart':
        case 'Update':  
            displayCart();
            break;
        case 'Check Out':
            checkOut();
            break;
        default:
            if($_REQUEST['action2'] == 'ViewCart'){
                displayCart();
            }else{
            displayProducts($products);
            }
      }
      
      ?>
        
    </body>
</html>

<?php
function displayProducts($products){
    global $current_script;
?>
    <h1> Products </h1> (<a title="View Cart" href="?action2=ViewCart">View Cart</a>) 
    <form method="post" action="<?php echo $current_script?>" onsubmit="return verifyForm();">
            <input type="hidden" name="action" value="add_cart"/>
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
}
function orderProducts(){
    unset($_SESSION['shopping_cart']);
}
function checkOut(){
    global $current_script;
    echo '<h4>Your Order completed successfully! To start again -<a href="'.$current_script.'">Go back to Products</a></h4>';
}
function updateCart($post){
    $shopping_cart = $_SESSION['shopping_cart'];
    
    foreach($post['qty'] as $product_id => $product_qty){
        if(@in_array($product_id, $post['delete'])){
            unset($shopping_cart['products'][$product_id]);
        }else{
            if($product_qty > 0 )
                $shopping_cart['products'][$product_id] = $product_qty;
        }
    }
    
    $_SESSION['shopping_cart'] = $shopping_cart;
    
}

function addCart($post){
    $shopping_cart = $_SESSION['shopping_cart'] ;
    
    foreach($post['products'] as $product){
        if($post['product_quantity_'.$product] > 0)
        $shopping_cart['products'][$product] = $shopping_cart['products'][$product] +$post['product_quantity_'.$product];
    }
    ksort($shopping_cart['products']);
    $_SESSION['shopping_cart']= $shopping_cart;
    
    
}
function displayProduct($product){
    echo "<td align='center'><b>Product:</b>{$product['product_name']} </br>";
    //.$_POST['product_quantity_'.$product['product_id']].
    echo "<b>Price:</b>{$product['product_price']} </br>
            <input type='checkbox' name='products[]' value='{$product['product_id']}'/>&nbsp;Qty            
            <input size='3' type='text' class='align_right' name='product_quantity_{$product['product_id']}' value='1' /></td>";
}

function displayCart(){
    global $current_script,$mysqli;
    
    $shopping_cart = $_SESSION['shopping_cart'];
    
    //$products_string = implode(',',  array_keys($shopping_cart['products']));
    
    $place_holders = implode(',', array_fill(0, count(array_keys($shopping_cart['products'])), '?'));
   
    $query = "SELECT * FROM cart_products WHERE product_id in ($place_holders)";
    
    $stmt = $mysqli->stmt_init();
    $stmt->prepare($query);
    
    $dynamic_params = array(implode( array_fill(0,count($shopping_cart['products']),'i') ) );
    //$dynamic_params = array_merge($dynamic_params,$shopping_cart['products']);
    
    $dynamic_params = array_merge($dynamic_params,array_keys($shopping_cart['products'])) ;
    
    call_user_func_array(array($stmt, "bind_param"), refValues($dynamic_params ));
    
    $stmt->execute();
    if(method_exists($stmt,'get_result')){ //           $rs = $stmt->get_result();

           $rs = $stmt->get_result(); 
            while($record = $rs->fetch_array()){
                $records[] = $record; 
            }
    }else{
        
        $stmt->bind_result($product_id, $product_name,$product_price);
        while ($stmt->fetch()) {
            $record['product_id'] = $product_id;
            $record['product_name'] = $product_name;
            $record['product_price'] = $product_price;
            
            $records[] = $record;
        }
    }
    
            
    foreach($records as $record){
        if($shopping_cart['products'][$record['product_id']]){
          $record['qty'] = $shopping_cart['products'][$record['product_id']];
      }
      
      $shopping_products[] = $record;
      $item_prices = $record['product_price'] * $record['qty'];
      $total = $total + $item_prices;
      $tr_string .= "<tr>
                      <td class='align_right'><input type='checkbox' name='delete[]' value='{$record['product_id']}'/></td>
                      <td>{$record['product_name']}</td>
                      <td class='align_right' ><input class='align_right' type='text' value='{$record['qty']}' name='qty[{$record['product_id']}]'/></td>
                      <td class='align_right'>{$record['product_price']}</td>
                      <td class='align_right'>$item_prices</td>
                      </tr>";
    }
    if(count($shopping_products) == 0){
        $tr_string .= "<tr><td colspan='5' style='text-align:center;font-weight:bold;'>
            Your Cart is empty To add Product <a href='{$current_script}'>Go back to Products</a></td></tr>";
    }
    echo <<<EOT
    <form method="post" action="$current_script" >
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
if(count($shopping_products)){    
    echo <<<EOT
        <tr>
    <td colspan="4" class='align_right'><strong>Total</strong></td>
    <td class='align_right'><strong>$total</strong></td>
    </tr>
    <tr>
    <td colspan="2" style="text-align:right"><input type='submit' name='action' value='Update'/></td>
        <td colspan="2" style="text-align:right"><input type='button'  value='Back to products'
        onClick="window.location.href='{$current_script}'" /></td>
    <td><strong><input type='submit' name='action' value='Check Out'/></td>
    </tr>
EOT;
}    
echo "</table></form>";

}

function refValues($arr){
    if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
    {
        $refs = array();
        foreach($arr as $key => $value)
            $refs[$key] = &$arr[$key];
        return $refs;
    }
    return $arr;
}
?>