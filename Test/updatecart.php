<?php
session_start(); //start session
include_once("config.php"); //include config file

//add product to session or create new one
if(isset($_POST["type"]) && $_POST["type"]=='add' && $_POST["product_qty"]>0)
{
    foreach($_POST as $key => $value){ //add all post vars to new_product array
        $new_product[$key] = filter_var($value, FILTER_SANITIZE_STRING);
    }
    //remove unecessary vars
    unset($new_product['type']);
    unset($new_product['return_url']);
   
    //we need to get product name and price from database.
    $statement = $mysqli->prepare("SELECT product_name, price FROM products WHERE product_code=? LIMIT 1");
    $statement->bind_param('s', $new_product['product_code']);
    $statement->execute();
    $statement->bind_result($product_name, $price);
   
    while($statement->fetch()){
       
        //fetch product name, price from db and add to new_product array
        $new_product["product_name"] = $product_name;
        $new_product["product_price"] = $price;
       
        if(isset($_SESSION["cart_products"])){  //if session var already exist
            if(isset($_SESSION["cart_products"][$new_product['product_code']])) //check item exist in products array
            {
                unset($_SESSION["cart_products"][$new_product['product_code']]); //unset old array item
            }          
        }
        $_SESSION["cart_products"][$new_product['product_code']] = $new_product; //update or create product session with new item  
    }
}


//update or remove items
if(isset($_POST["product_qty"]) || isset($_POST["remove_code"]))
{
    //update item quantity in product session
    if(isset($_POST["product_qty"]) && is_array($_POST["product_qty"])){
        foreach($_POST["product_qty"] as $key => $value){
            if(is_numeric($value)){
                $_SESSION["cart_products"][$key]["product_qty"] = $value;
            }
        }
    }
    //remove an item from product session
    if(isset($_POST["remove_code"]) && is_array($_POST["remove_code"])){
        foreach($_POST["remove_code"] as $key){
            unset($_SESSION["cart_products"][$key]);
        }  
    }
}

//back to return url
$return_url = (isset($_POST["return_url"]))?urldecode($_POST["return_url"]):''; //return url
header('Location:'.$return_url);

?>





<li class="product">
    <form method="post" action="cart_update.php">
    <div class="product-content"><h3>{$obj->product_name}</h3>
    <div class="product-thumb"><img src="images/{$obj->product_img_name}"></div>
    <div class="product-desc">{$obj->product_desc}</div>
    <div class="product-info">
    Price {$currency}{$obj->price}
   
    <fieldset>
   
    <label>
        <span>Color</span>
        <select name="product_color">
        <option value="Black">Black</option>
        <option value="Silver">Silver</option>
        </select>
    </label>
   
    <label>
        <span>Quantity</span>
        <input type="text" size="2" maxlength="2" name="product_qty" value="1" />
    </label>
   
    </fieldset>
    <input type="hidden" name="product_code" value="{$obj->product_code}" />
    <input type="hidden" name="type" value="add" />
    <input type="hidden" name="return_url" value="{$current_url}" />
    <div align="center"><button type="submit" class="add_to_cart">Add</button></div>
    </div></div>
    </form>
    </li