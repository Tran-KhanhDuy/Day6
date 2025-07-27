<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
</head>
<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h4 class="mb-4 text-center">Create</h4>

        <form action="processCreate.php" method="post"> 
          <div class="mb-3"> 
            <label for="username" class="form-label">Tên đăng nhập</label> 
            <input name="username" id="username" type="text" class="form-control" required /> 
          </div> 

          <div class="mb-3"> 
            <label for="email" class="form-label">Email</label> 
            <input name="email" id="email" type="email" class="form-control" required /> 
          </div> 

          <div class="mb-3"> 
            <label for="password" class="form-label">Mật khẩu</label>       
            <input name="password" id="password" type="password" class="form-control" required /> 
          </div> 

          <div class="mb-3"> 
            <label for="address" class="form-label">Địa chỉ</label>       
            <textarea name="address" id="address" class="form-control" rows="3" required></textarea> 
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