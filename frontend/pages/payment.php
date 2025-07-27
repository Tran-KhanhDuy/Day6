<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <meta charset="UTF-8">
  <title>Payment</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <style>
    .card {
      margin: 30px auto;
      padding: 20px;
      max-width: 900px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .border {
      border: 1px solid #ccc;
      padding: 20px;
      margin-top: 20px;
    }
    .icons img {
      width: 40px;
      margin-right: 10px;
    }
    .btn {
      background-color: #007bff;
      color: white;
      width: 100%;
    }
    .btn:hover {
      background-color: #0056b3;
    }
    .header {
      font-weight: bold;
      font-size: 1.2rem;
    }
  </style>
</head>
<body>

<div class="card">
  <div class="card-top border-bottom text-center">
    <a href="/DAY6/frontend/index.php">← Back to shop</a>
    <span id="logo" class="ms-3">Payment-Demo</span>
  </div>

  <div class="card-body">
    <div class="row upper mb-3 text-center">
      <span><i class="fa fa-check-circle-o"></i> Shopping bag</span>
      <span><i class="fa fa-check-circle-o"></i> Order details</span>
      <span id="payment"><strong>3</strong> Payment</span>
    </div>

    <div class="row">
      <!-- Left side -->
      <div class="col-md-7">
        <div class="left border">
          <div class="row mb-3">
            <span class="header">Payment</span>
            <div class="icons">
              <img src="https://img.icons8.com/color/48/000000/visa.png"/>
              <img src="https://img.icons8.com/color/48/000000/mastercard-logo.png"/>
              <img src="https://img.icons8.com/color/48/000000/maestro.png"/>
            </div>
          </div>
          <form>
            <div class="mb-2">Cardholder's name:</div>
            <input class="form-control mb-2" placeholder="Linda Williams">
            <div class="mb-2">Card Number:</div>
            <input class="form-control mb-2" placeholder="0125 6780 4567 9909">
            <div class="row">
              <div class="col-6">
                <div>Expiry date:</div>
                <input class="form-control mb-2" placeholder="YY/MM">
              </div>
              <div class="col-6">
                <div>CVV:</div>
                <input class="form-control mb-2" id="cvv">
              </div>
            </div>
            <div class="form-check mt-2">
              <input type="checkbox" class="form-check-input" id="save_card">
              <label class="form-check-label" for="save_card">Save card details to wallet</label>
            </div>
          </form>
        </div>
      </div>

      <!-- Right side -->
      <div class="col-md-5">
        <div class="right border">
          <div class="header mb-2">Order Summary</div>
          <p><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?> items</p>

          <?php 
          $subtotal = 0;
          if (isset($_SESSION['cart'])):
            foreach ($_SESSION['cart'] as $item): 
              $subtotal += $item['subTotal'];
          ?>
          <div class="row item mb-2">
            <div class="col-4 align-self-center">
              <img class="img-fluid" src="<?php echo htmlspecialchars($item['image_url']); ?>">
            </div>
            <div class="col-8">
              <div class="row"><b>$<?php echo number_format($item['price'], 2); ?></b></div>
              <div class="row text-muted"><?php echo htmlspecialchars($item['name']); ?></div>
              <div class="row">Qty: <?php echo $item['quantity']; ?></div>
            </div>
          </div>
          <?php endforeach; endif; ?>

          <hr>
          <div class="row lower">
            <div class="col text-left">Subtotal</div>
            <div class="col text-right">$ <?php echo number_format($subtotal, 2); ?></div>
          </div>
          <div class="row lower">
            <div class="col text-left">Delivery</div>
            <div class="col text-right">Free</div>
          </div>
          <div class="row lower">
            <div class="col text-left"><b>Total to pay</b></div>
            <div class="col text-right"><b>$ <?php echo number_format($subtotal, 2); ?></b></div>
          </div>
          <div class="row lower mt-2 mb-2">
            <div class="col text-left"><a href="#"><u>Add promo code</u></a></div>
          </div>
          <form method="POST" action="confirm.php">
            <button class="btn" type="submit" name="place_order">Place order</button>
          </form>
          <p class="text-muted text-center mt-2">Complimentary Shipping & Returns</p>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
<style>
    body{
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgb(0, 0, 34);
    font-size: 0.8rem;
}
.card{
    max-width: 1000px;
    margin: 2vh;
}
.card-top{
    padding: 0.7rem 5rem;
}
.card-top a{
    float: left;
    margin-top: 0.7rem;
}
#logo{
    font-family: 'Dancing Script';
    font-weight: bold;
    font-size: 1.6rem;
}
.card-body{
    padding: 0 5rem 5rem 5rem;
    background-image: url("https://i.imgur.com/4bg1e6u.jpg");
    background-size: cover;
    background-repeat: no-repeat;
}
@media(max-width:768px){
    .card-body{
        padding: 0 1rem 1rem 1rem;
        background-image: url("https://i.imgur.com/4bg1e6u.jpg");
        background-size: cover;
        background-repeat: no-repeat;
    }  
    .card-top{
        padding: 0.7rem 1rem;
    }
}
.row{
    margin: 0;
}
.upper{
    padding: 1rem 0;
    justify-content: space-evenly;
}
#three{
    border-radius: 1rem;
        width: 22px;
    height: 22px;
    margin-right:3px;
    border: 1px solid blue;
    text-align: center;
    display: inline-block;
}
#payment{
    margin:0;
    color: blue;
}
.icons{
    margin-left: auto;
}
form span{
    color: rgb(179, 179, 179);
}
form{
    padding: 2vh 0;
}
input{
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 1vh;
    margin-bottom: 4vh;
    outline: none;
    width: 100%;
    background-color: rgb(247, 247, 247);
}
input:focus::-webkit-input-placeholder
{
      color:transparent;
}
.header{
    font-size: 1.5rem;
}
.left{
    background-color: #ffffff;
    padding: 2vh;   
}
.left img{
    width: 2rem;
}
.left .col-4{
    padding-left: 0;
}
.right .item{
    padding: 0.3rem 0;
}
.right{
    background-color: #ffffff;
    padding: 2vh;
}
.col-8{
    padding: 0 1vh;
}
.lower{
    line-height: 2;
}
.btn{
    background-color: rgb(23, 4, 189);
    border-color: rgb(23, 4, 189);
    color: white;
    width: 100%;
    font-size: 0.7rem;
    margin: 4vh 0 1.5vh 0;
    padding: 1.5vh;
    border-radius: 0;
}
.btn:focus{
    box-shadow: none;
    outline: none;
    box-shadow: none;
    color: white;
    -webkit-box-shadow: none;
    -webkit-user-select: none;
    transition: none; 
}
.btn:hover{
    color: white;
}
a{
    color: black;
}
a:hover{
    color: black;
    text-decoration: none;
}
input[type=checkbox]{
    width: unset;
    margin-bottom: unset;
}
#cvv{
    background-image: linear-gradient(to left, rgba(255, 255, 255, 0.575) , rgba(255, 255, 255, 0.541)), url("https://img.icons8.com/material-outlined/24/000000/help.png");
    background-repeat: no-repeat;
    background-position-x: 95%;
    background-position-y: center;
} 
#cvv:hover{

}
</style>