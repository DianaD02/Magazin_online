<?php
    require_once "ShoppingCart.php";
    if(isset($_POST['submit_cat'])){
        if(!empty($_POST['select_category'])) {
          $selected = $_POST['select_category'];
?>
<HTML>
<HEAD>
    <TITLE>Creare cos cumparaturi </TITLE>
    <link href="style.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</HEAD>
<BODY>
        <p style="text-align: left"><a href="Magazin.php" >
          <span class=""></span> Inapoi la magazin
        </a> </p>
          <div id="product-grid">
        </br>
   
    <p style="text-align: left"><a href="Index.html"><i class="fas fa-usercircle"></i>Log out</a> 
        </a> </p>
        <div class="txt-heading"><div class="txt-heading-label"><b>Produsele din categoria: </b></div></div>
            <?php
                $shoppingCart = new ShoppingCart();
                echo $selected;
                $query = "SELECT * FROM tbl_product WHERE categorie='.$selected.'";
                $product_array = $shoppingCart->getAllProductCategory($selected);
                if (! empty($product_array)) {
                foreach ($product_array as $key => $value) {
            ?>
          
           
            <div class="all">
            <div class="product-item">
           
                <form method="post" action="Cos.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
                <div class="product-image">
                    <img src="<?php echo $product_array[$key]["image"]; ?>" width="150" style="allign: center">
                </div>
                <div id='produs_name'>
                    <strong><?php echo $product_array[$key]["name"]; ?></strong>
                </div>
                <div class="product-price">
                    <?php echo $product_array[$key]["price"] . " RON"; ?>
                </div>
            
                <input type="text" name="quantity" value="1" size="2" />
                <input type="submit" value="Add to cart" class="btnAddAction" />
            </div>
            </div>
        
       
        </div>
            </form>
            
   
    <div>
        <?php
        }
        }
        ?>
    </div>
        <?php
        } else {
          echo 'Please select the value.';
        }
      } ?>
      </BODY>
     </HTML>