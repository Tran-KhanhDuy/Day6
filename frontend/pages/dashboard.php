<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard</title>
</head>
<body class="d-flex flex-column h-100"> 
        <?php include_once(__DIR__ . '/../../backend/layouts/style.php'); ?> 
         <!-- navbar --> 
            <?php include_once(__DIR__ . '/../../backend/layouts/partials/header.php'); ?>
        <!-- end header --> 
    <div class="container-fluid"> 
        <div class="row"> 
            <!-- sidebar --> 
            <?php include_once(__DIR__ . '/../../backend/layouts/partials/sidebar.php'); ?> 
            <!-- end sidebar --> 
        <main role="main" class="col-md-10 ml-sm-auto px-4 mb-2">   
    <div class="my-3 d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Product List</h4>
        <div class="d-flex align-items-center">
            <form method="get" action="" class="d-flex">
                <input type="text" name="search" class="form-control form-control-sm me-2" placeholder="Search product..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                <button type="submit" class="btn btn-sm btn-primary">Search</button>
            </form>
            <a href="create.php" class="btn btn-success btn-sm ms-3">Create New</a>
        </div>
    </div>
            <hr class="my-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        include_once(__DIR__ . '/dbConnect.php');
                        $conn = connectDb();
                        $sql = "SELECT id, name, price, category, image_url FROM
                        product";
                        $search = $_GET['search'] ?? '';
                        $sql = "SELECT id, name, price, category, image_url FROM product";
                        if (!empty($search)) {
                            $searchEscaped = $conn->real_escape_string($search);
                            $sql .= " WHERE name LIKE '%$searchEscaped%'";
                        }
                        $result = $conn->query($sql);
                        $data = [];
                        if($result->num_rows >0){
                            while($row = $result->fetch_array(MYSQLI_NUM)){
                                $data[] = $row;
                            }
                            $result->free_result();
                        }
                        $conn->close();
                        foreach ($data as $item):
                        ?>
                        <tr>
                            <td><?=$item[0] ?></td>
                            <td><?=$item[1] ?></td>
                            <td><?=$item[2] ?></td>
                            <td><?=$item[3] ?></td>
                            <td>
                                <img src="/DAY4/assets/<?=$item[4]?>" alt="" style="width:200px;height:auto;">
                            </td>
                            <td>
                            <a href="update.php?id=<?=$item[0]?>" class="btn btn-sm btn-warning">Update</a>
                            <a href="delete.php?id=<?=$item[0]?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </main>
        </div>
         <hr class="my-4">                       

    </div>  
        <?php include_once(__DIR__ . '/../../backend/layouts/scripts.php'); ?> 
</body>
</html>