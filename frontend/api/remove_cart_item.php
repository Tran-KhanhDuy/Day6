<?php
session_start(); 
$id = $_POST['id'];

   
    if (isset($_SESSION['cart'][$id])) {
        $cart = $_SESSION['cart'];
        if(isset($cart[$id])){
            unset($cart[$id]);
            $_SESSION['cart'] = $cart;
        }
    }
echo json_encode($_SESSION['cart']);