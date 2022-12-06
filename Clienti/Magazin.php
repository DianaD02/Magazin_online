<?php
require_once "ShoppingCart.php"; ?>
<HTML>

<HEAD>
    <TITLE>Cos cumparaturi </TITLE>
    <link href="style.css" type="text/css" rel="stylesheet" />
</HEAD>

<BODY>

<div class="container mt-5">
        <form action="Categorie.php" method="post" class="mb-3">
            <?php
                Include("Conectare.php"); ?>
</br>
</br>
            <p><b>Alege produsele preferate dupa categorie: </b></p>
            <?php $result = $mysqli->query("SELECT DISTINCT categorie FROM tbl_product");
                echo "<select name='select_category'>";
                echo "<option>SELECT CATEGORY</option>";
                while ($row = $result->fetch_array())
                {
                    echo "<option>$row[categorie]</option> ";
                }
                echo "</select>";
            ?> 
            <br> </br>
            <input type="submit" name="submit_cat" vlaue="Choose options">
        </form>
    </div>


    <div id="product-grid">
        <div class="txt-heading">
            <div class="txt-headinglabel"><b><h1>Produse disponibile: </h1></b></div>
        </div>
        <?php
        $shoppingCart = new ShoppingCart();
        $query = "SELECT * FROM tbl_product";
        $product_array = $shoppingCart->getAllProduct($query);
        if (!empty($product_array)) {
            foreach ($product_array as $key => $value) {
        ?>
        <table>
                <div class="product-item">
               <tr>     <form method="post" action="Cos.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>"> </tr>
               <tr>       <div class="product-image"><img width="140px" src="<?php echo $product_array[$key]["image"]; ?>">
                        </div>
                        <div>
                            <strong><?php echo $product_array[$key]["name"];?></strong>
                        </div>
                        <div class="product-price"><?php echo $product_array[$key]["price"] . "RON"; ?></div>
                        <div>
                            <input type="text" name="quantity" value="1" size="2" />
                            <input type="submit" value="Add to cart" class="btnAddAction" /> </tr>
                        </div>
            </br></br>
                    </form>
                </div>
        </table>

        <?php
            }
        }
        ?>
    </div>
</BODY>

</HTML>