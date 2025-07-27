<?php session_start(); ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <?php include_once(__DIR__ . '/../../dbConnect.php');
 ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>
      <?php include_once(__DIR__ . '/../frontend/layouts/partials/scripts.php'); ?>


    <main class="container mt-4">
        <div id="alert-container" class="alert alert-warning alert-dismissible fade d-none" role="alert">
            <div id="message">&nbsp;</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <?php
        $conn = connectDb();
        $id = intval($_GET['id'] ?? 0);
        $sql = "SELECT id, name, price, description, stock_quantity, image_url, category FROM product WHERE id=$id";
        $result = $conn->query($sql);
        $prod = $result->fetch_array(MYSQLI_NUM);
        $result->free_result();
        $conn->close();

       
        $imageFile = trim($prod[5]);
        $imagePath = '/DAY6/assets/uploads/' . basename($imageFile);
        if (empty($imageFile)) {
            $imagePath = '/DAY6/assets/uploads/default-image_600.png';
        }
        ?>

        <div class="card p-4">
            <div class="row">
                <div class="col-md-6 text-center">
                    <div class="preview-pic mb-3">
                        <img src="<?= $imagePath ?>" class="img-fluid" style="max-height: 300px;" alt="<?= htmlspecialchars($prod[1]) ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <h3 class="product-title"><?= htmlspecialchars($prod[1]) ?></h3>
                    <div class="rating mb-2">
                        <span class="fa fa-star text-warning"></span>
                        <span class="fa fa-star text-warning"></span>
                        <span class="fa fa-star text-warning"></span>
                        <span class="fa fa-star text-secondary"></span>
                        <span class="fa fa-star text-secondary"></span>
                        <span class="ms-2">999 ratings</span>
                    </div>

                    <p><?= nl2br(htmlspecialchars($prod[3])) ?></p>
                    <h4 class="text-danger">Price: $<?= $prod[2] ?></h4>

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity:</label>
                        <input type="number" class="form-control w-25" id="quantity" name="quantity" min="1" value="1">
                    </div>

                    <input type="hidden" id="id" value="<?= $prod[0] ?>">
                    <input type="hidden" id="name" value="<?= htmlspecialchars($prod[1]) ?>">
                    <input type="hidden" id="price" value="<?= $prod[2] ?>">
                    <input type="hidden" id="image" value="<?= $prod[5] ?>">
                    <input type="hidden" id="category" value="<?= $prod[6] ?>">

                    <div class="d-flex gap-2">
                        <button class="btn btn-warning" id="btnAddCart">Add to Cart</button>
                        <a class="btn btn-outline-secondary" href="#"><i class="fa fa-heart"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4 p-4">
            <h4>Product Description</h4>
            <p><?= nl2br(htmlspecialchars($prod[3])) ?></p>
        </div>
    </main>

    <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>

    <script>
        function handleAddCart() {
            var data = {
                id: $('#id').val(),
                name: $('#name').val(),
                price: $('#price').val(),
                image: $('#image').val(),
                category: $('#category').val(),
                quantity: $('#quantity').val()
            };

            $.ajax({
                url: '/DAY6/frontend/api/addCart.php',
                method: 'POST',
                dataType: 'json',
                data: data,
                success: function(response) {
                    $('#message').html(`Product added to cart. <a href="/demoshop/frontend/pages/viewCart.php">View Cart</a>.`);
                    $('#alert-container').removeClass('d-none').addClass('show');
                },
                error: function() {
                    $('#message').html(`<strong>Error:</strong> Cannot add to cart.`);
                    $('#alert-container').removeClass('d-none').addClass('show');
                }
            });
        }

        $('#btnAddCart').on('click', function(e) {
            e.preventDefault();
            handleAddCart();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>