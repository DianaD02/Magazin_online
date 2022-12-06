<?php
require_once "DBController.php";
class ShoppingCart extends DBController
{

    function getAllProductCategory($category)
    {
        $query = "SELECT * FROM tbl_product WHERE categorie='" . $category . "'";
        $productResult = $this->getDBResult($query);
        return $productResult;
    }

    function getAllProduct()
    {
        $query = "SELECT * FROM tbl_product";
        $productResult = $this->getDBResult($query);
        return $productResult;
    }

    function getMemberCartItem($member_id)
    {
        $query = "SELECT tbl_product.*, cos.cos_id as cart_id, cos.cos_cantitate FROM tbl_product, cos WHERE  tbl_product.id = cos.produs_id AND cos.client_id = ?";
        $params = array(array("param_type" => "i", "param_value" => $member_id));

        $cartResult = $this->getDBResult($query, $params);
        return $cartResult;
    }
    function getProductByCode($product_code)
    {
        $query = "SELECT * FROM tbl_product WHERE code=?";

        $params = array(
            array(
                "param_type" => "s",
                "param_value" => $product_code
            )
        );

        $productResult = $this->getDBResult($query, $params);
        return $productResult;
    }

    function getCartItemByProduct($product_id, $member_id)
    {
        $query = "SELECT * FROM cos WHERE produs_id = ? AND client_id = ?";
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $product_id
            ),
            array(
                "param_type" => "i",
                "param_value" => $member_id
            )
        );
        $cartResult = $this->getDBResult($query, $params);
        return $cartResult;
    }


    function addToCart($product_id, $quantity, $member_id)
    {
        $query = "INSERT INTO cos (produs_id, cos_cantitate, client_id) VALUES (?, ?, ?)";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $product_id
            ),
            array(
                "param_type" => "i",
                "param_value" => $quantity
            ),
            array(
                "param_type" => "i",
                "param_value" => $member_id
            )
        );

        $this->updateDB($query, $params);
    }


    function updateCartQuantity($quantity, $cart_id)
    {
        $query = "UPDATE cos SET cos_cantitate = ? WHERE cos_id= ?";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $quantity
            ),
            array(
                "param_type" => "i",
                "param_value" => $cart_id
            )
        );

        $this->updateDB($query, $params);
    }


    function deleteCartItem($cart_id)
    {
        $query = "DELETE FROM cos WHERE cos_id = ?";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $cart_id
            )
        );

        $this->updateDB($query, $params);
    }


    function emptyCart($member_id)
    {
        $query = "DELETE FROM cos WHERE client_id = ?";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $member_id
            )
        );

        $this->updateDB($query, $params);
    }
}
