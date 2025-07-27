<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>
<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h4 class="mb-4 text-center">New Product</h4>

        <form action="processCreate.php" method="post"> 
          <div class="mb-3"> 
            <label for="name" class="form-label">Tên sản phẩm</label> 
            <input name="name" id="name" type="text" class="form-control" required /> 
          </div> 

          <div class="mb-3"> 
            <label for="price" class="form-label">Giá</label> 
            <input name="price" id="price" type="number" step="0.01" class="form-control" required /> 
          </div> 

          <div class="mb-3"> 
            <label for="category" class="form-label">Danh mục</label> 
            <input name="category" id="category" type="text" class="form-control" required /> 
          </div> 

          <div class="mb-3"> 
            <label for="image_url" class="form-label">Đường dẫn ảnh</label>       
            <input name="image_url" id="image_url" type="text" class="form-control" /> 
          </div> 

          <div class="mb-3"> 
            <label for="description" class="form-label">Mô tả</label>       
            <textarea name="description" id="description" class="form-control" rows="3"></textarea> 
          </div> 

          <div class="mb-3"> 
            <label for="stock_quantity" class="form-label">Số lượng trong kho</label>       
            <input name="stock_quantity" id="stock_quantity" type="number" min="0" class="form-control" required /> 
          </div> 

          <div class="text-center"> 
            <input type="submit" value="Thêm mới" class="btn btn-primary" />       
          </div> 
        </form> 
        
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>