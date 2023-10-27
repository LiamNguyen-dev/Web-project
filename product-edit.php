<?php
    require_once("connection/connectdb.php");
?>

<?php
    try {
		$sql = "select * from category";
		$stmt_cat = $conn->query($sql);
		$rows_cat = $stmt_cat->fetchAll();		
	} catch(PDOException $ex) {
		echo "Error: " . $ex->getMessage();
	}	
    try {
        $sql = "select * from product where productID = ?";
        $stmt_edit = $conn->prepare($sql);
        $stmt_edit->bindParam(1, $_GET['id']);
        $stmt_edit->execute();
        $row_edit = $stmt_edit->fetch();
    }catch(PDOException $ex) {
        echo 'Error: ' . $ex->getMessage();
    }
    if (isset($_POST['update'])) {
        try {
            $sql = "update product  
                    set productName = ?, productPrice = ?, productImage = ?, 
                        productDetails = ?, categoryID = ?     
                    where productID = ?";
    
            $image = $_POST['productImage'] == '' ? $_POST['old_image'] : $_POST['productImage'];
    
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $_POST['productName']); //cái nằm trong ngoặc vuông là name của cái label nằm bên dưới
            $stmt->bindParam(2, $_POST['productPrice']); // tức là sẽ lấy dữ liệu theo name của label bên dưới
            $stmt->bindParam(3, $image);
            $stmt->bindParam(4, $_POST['productDetails']);
            $stmt->bindParam(5, $_POST['categoryID']);
            $stmt->bindParam(6, $_POST['productID']);
            $stmt->execute();
            header('Location: admin/pages/tables/product.php'); // khi thực hiện xong sẽ quay lại trang produc-list.php
        } catch (PDOException $ex) {
            echo "Error: " . $ex->getMessage();
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">
    <title>Edit product</title>
</head>

<body>
    <div class="container mt-4">
        <h2>Update product</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="mb-3 mt-3">
                <label for="id">ID:</label>
                <input type="text" class="form-control" id="productID" readonly value="<?= $row_edit['productID'] ?>" name="productID">
            </div>
            <div class="mb-3">
                <label>Product name:</label>
                <input type="text" class="form-control" id="productName" value="<?= $row_edit['productName'] ?>" name="productName">
            </div>
            <div class="mb-3">
                <label>Product price:</label>
                <input type="number" class="form-control" id="productPrice"  value="<?= $row_edit['productPrice'] ?>" name="productPrice">
            </div>
            <div class="mb-3">
                <label>Product image:</label>
                <img src="image\product\<?= $row_edit['productImage'] ?>" 
                     heigh="90px" width="90px" alt="no image">
                <input type="hidden" value="<?= $row_edit['productImage'] ?>" name="old_image">
                <input type="file" class="form-control" id="productImage" name="productImage">
            </div>
            <div class="mb-3">
                <label>Product details:</label>
                <textarea class="form-control" rows="10" name="productDetails" id="productDetails"><?= $row_edit['productDetails'] ?></textarea>
            </div>
            <div class="mb-3">
            <label>Category:</label>
                <select name="categoryID" id="categoryID" class="form-control">
                    <?php foreach($rows_cat as $row)  { ?> 
                    <option value="<?= $row['categoryID'] ?>" 
                            <?php echo $row['categoryID'] == $row_edit['categoryID'] ? 'selected' : '' ?> >
                        <?php echo $row['categoryName'] ?>
                    </option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="update">Save</button>
            <a href="admin/pages/tables/product.php" class="btn btn-success">Back</a>
        </form>
    </div>
</body>

</html>



