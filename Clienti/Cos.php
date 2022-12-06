<?php
require_once "ShoppingCart.php";
session_start();
// Dacă utilizatorul nu este conectat redirecționează la pagina de autentificare
if (!isset($_SESSION['loggedin'])) {
    header('Location: Index.html');
    exit;
}
// pt membrii inregistrati
$member_id = $_SESSION['id'];
$shoppingCart = new ShoppingCart();
if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            if (!empty($_POST["quantity"])) {
                $productResult = $shoppingCart->getProductByCode($_GET["code"]);

                $cartResult = $shoppingCart->getCartItemByProduct($productResult[0]["id"], $member_id);

                if (!empty($cartResult)) {
                    // Modificare cantitate in cos
                    $newQuantity = $cartResult[0]["cos_cantitate"] + $_POST["quantity"];
                    $shoppingCart->updateCartQuantity(
                        $newQuantity,
                        $cartResult[0]["cos_id"]
                    );
                } else {
                    // Adaugare in tabelul cos
                    $shoppingCart->addToCart(
                        $productResult[0]["id"],
                        $_POST["quantity"],
                        $member_id
                    );
                }
            }
            break;
        case "remove":
            // Sterg o sg inregistrare
            $shoppingCart->deleteCartItem($_GET["id"]);
            break;
        case "empty":
            // Sterg cosul
            $shoppingCart->emptyCart($member_id);
            break;
    }
}
?>


<HTML>
<HEAD>
    <TITLE>Cos</TITLE>
    <link href="style.css" type="text/css" rel="stylesheet" />
</HEAD>

<BODY>
    <div id="shopping-cart">
        <div class="txt-heading">
            <div class="txt-heading-label">Cos Cumparaturi</div>
            <a id="btnEmpty" href="Cos.php?action=empty">
            <img src="Img/empty.png" alt="empty-cart" title="Empty Cart" width="40px" /></a>
        </div>
        <?php
        $cartItem = $shoppingCart->getMemberCartItem($member_id);
        if (!empty($cartItem)) {
            $item_total = 0;
        ?>
            <table cellpadding="10" cellspacing="1">
                <tbody>
                    <tr>
                        <th style="text-align: left;"><strong>Name</strong></th>
                        <th style="text-align: left;"><strong>Code</strong></th>
                        <th style="text-align: right;"><strong>Cantitate</strong></th>
                        <th style="text-align: right;"><strong>Pret</strong></th>
                        <th style="text-align: center;"><strong>Action</strong></th>
                    </tr>
                    <?php
                    foreach ($cartItem as $item) {
                    ?>
                        <tr>
                            <td style="text-align: left; border-bottom: #F0F0F0 1px solid;"><strong><?php echo $item["name"]; ?></strong></td>
                            <td style="text-align: left; border-bottom: #F0F0F0 1px solid;"><?php echo $item["code"]; ?></td>
                            <td style="text-align: right; border-bottom: #F0F0F0 1px solid;"><?php echo $item["cos_cantitate"]; ?></td>
                            <td style="text-align: right; border-bottom: #F0F0F0 1px solid;"><?php echo $item["price"]." RON"; ?></td>
                            <td style="text-align: center; border-bottom: #F0F0F0 1px solid;"><a href="Cos.php?action=remove&id=<?php echo
                            $item["cart_id"]; ?>"class="btnRemoveAction"><img src="Img/delete.png" width="30" alt="icon-delete" title="Remove Item" /></a></td>
                        </tr>
                    <?php
                        $item_total += ($item["price"] * $item["cos_cantitate"]);
                    }
                    ?>
                    <tr>
                        <td colspan="3" text-align="right"><strong>Total:</strong></td>
                        <td text-align="right"><?php echo $item_total." RON"; ?></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        <?php
        }
        ?>
    </div>
    <div><a href="Magazin.php">Alegeti alt produs</a></div>
    <div><a href="Logout.php">Abandonati sesiunea de shopping</a></div>

</BODY>

</HTML>