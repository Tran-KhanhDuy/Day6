
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Cart</title>
  <?php include_once(__DIR__ . '/../../frontend/layouts/partials/header.php'); ?>
  <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>
</head>
<body>
<main style="margin-top:100px">
  <h2 class="text-center">View Cart</h2>
  <p class="text-center text-muted">Kiểm tra giỏ hàng của bạn trước khi tiến hành thanh toán.</p>
  <?php
  include_once(__DIR__ . '/../../dbConnect.php');
  $cart = $_SESSION['cart'] ?? [];
  ?>

  <div class="container">
    <div id="alert-container" class="alert alert-warning
    alert-dismissible fade d-none" role="alert">
    <div id="messege">&nbsp;</div>
    <button type="button" class="Close"data-dismiss="alert"
    aria-label="Close">
        <span aria-hidden="true">$times;</span>
    </button>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered">
          <thead class="table-dark">
            <tr>
              <th>No.</th>
              <th>Image</th>
              <th>Name</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Sub Total</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($cart)): ?>
              <?php $no = 1; ?>
              <?php foreach ($cart as $item): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td>
                  <img src="/DAY6/assets/<?= htmlspecialchars($item['image_url']) ?>"
                    alt="Product Image" style="width:100px;">

                  </td>
                  <td><?= $item['name'] ?></td>
                  <td>
                    <input type="number" class="form-control"
                        id="quantity_<?=$item['id']?>" 
                        name="quantity"
                        value="<?=$item['quantity']?>" />
                    <button class="btn-sm btn-update-quantity" data-id="<?=$item['id']?>">
                      <i class="fa fa-pencil"aria-hidden="true"></i>   
                    Update</button>
                  </td>
                  <td><?= number_format($item['price']) ?>₫</td>
                  <td><?= number_format($item['price'] * $item['quantity']) ?>₫</td>
                  <td>
                    <a id="delete_<?= $no ?>" data-id="<?= $item['id']?>" 
                    class="btn btn-danger btn-sm btn-delete-item">
                    <i class="fa fa-trash"aria-hidden="true"></i>   
                    Delete</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td class="text-center" colspan="7">Cart Empty</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
           <a href="/DAY6/frontend/index.php" class="btn btn-warning btn-md">
           <i class="fa fa-arrow-left"aria-hidden="true"></i> 
           Continue Shopping</a>     
             <a href="/DAY6/frontend/pages/checkout.php" class="btn btn-primary">
               <i class="fa fa-shopping-cart"aria-hidden="true"></i>
             Check Out</a>             
      </div>
    </div>
  </div>
</main>

<?php include_once(__DIR__ . '/../../frontend/layouts/partials/footer.php'); ?>
  <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
  <script>
 $(document).ready(function(){
    $('.btn-update-quantity').click(function(){
      const id = $(this).data('id');
      const quantity = $('#quantity_' + id).val();
      if (!quantity || isNaN(quantity) || quantity <= 0) {
        const htmlString = "<h1><strong>Số lượng không hợp lệ</strong></h1>";
        $('#message').html(htmlString);
        $('.alert').removeClass('d-none').addClass('show');
        return;
      }

      const data = { id, quantity };

      $.ajax({
        url: '/DAY6/frontend/api/update_cart_item.php',
        method: 'post',
        dataType: 'json',
        data: data,
        success: function(data){
          location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown){
          console.log(textStatus);
          const htmlString = "<h1><strong>Can't Update</strong></h1>";
          $('#message').html(htmlString);
          $('.alert').removeClass('d-none').addClass('show');
        }
      });
    });

    $('.btn-delete-item').click(function(){
      const id = $(this).data('id');
      const data = { id };

      $.ajax({
        url: '/DAY6/frontend/api/remove_cart_item.php',
        method: 'post',
        dataType: 'json',
        data: data,
        success: function(data){
          location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown){
          console.log(textStatus);
          const htmlString = "<h1><strong>Can't Delete</strong></h1>";
          $('#message').html(htmlString);
          $('.alert').removeClass('d-none').addClass('show');
        }
      });
    });
  });
</script>


</body>
</html>
