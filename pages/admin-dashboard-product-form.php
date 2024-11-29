<?php
        include("../includes/connectdb.php");
        include("../includes/admin-product-functions.php");

        $message=''; //Created an empty message variable for success and error fields
        $message_type=''; //Specifying the type so I can show either a success field or an error

        $branchOptionsQuery = "SELECT branch_id, name FROM branches";
        $branchOptionsResutlt = mysqli_query($connection,$branchOptionsQuery);

        if (isset($_GET['product-id'])) {
            $product_id = $_GET['product-id'];

            // Fetching product details
            $query = "SELECT p.*, i.quantity, i.branch_id 
                      FROM products p
                      LEFT JOIN inventory_items i ON p.product_id = i.product_id 
                      WHERE p.product_id = $product_id";
            $result = mysqli_query($connection,$query);
            $product = mysqli_fetch_assoc($result);

            if (!$product){
                die("product not found.");
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = mysqli_real_escape_string($connection, $_POST['name']);
            $unit_price = floatval($_POST ['unit_price']); // Ensures unit price is an flaot
            $category = mysqli_real_escape_string($connection, $_POST['category']);
            $manufacturer = mysqli_real_escape_string($connection, $_POST['manufacturer']);
            $image = $_FILES['image'];
            $branch_id = isset($_POST['branch_id']) ? intval($_POST['branch_id']) : null;
            $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : null;

            // Handle image upload
            if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) { //Checks if an image was uploaded
                //Process the upload of a new image
                $imageData = addslashes(file_get_contents($_FILES['image']['tmp_name']));
            } else {
                if (isset($product['product_image'])) { //use existing or default image
                    $imageData = $product['product_image'];
                } else {
                //Otherwise, use existing image or default image
                $imageData = "../images/image-product-template.png";
                }
            }
                if (empty($name) || empty($unit_price) || empty($category) || empty($manufacturer) || empty($branch_id) || empty($quantity)) {
                    $message = "All fields must be entered.";
                    $message_type ="error";
                } else {
                    if (isset($product_id)) { // Checks whether it is an update or creation of a product
                        //  Initialize the update query
                        $updateQuery="UPDATE products SET ";

                        $updateFields = [];
    
                        //Check each field to see if it needs updating
                        if ($name !== $product['name']) {
                            $updateFields[] = "name = '$name'";
                        }
    
                        if ($unit_price !== $product['unit_price']) {
                            $updateFields[] = "unit_price = $unit_price";
                        }
    
                        if ($category !== $product['category']) {
                            $updateFields[] = "category = '$category'";
                        }
    
                        if ($manufacturer !== $product['manufacturer']) {
                            $updateFields[] = "manufacturer = '$manufacturer'";
                        }
    
                        if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
                            $updateFields[] = "product_image = '$imageData'";
                        }
    
                        if (!empty($updateFields)){
                            $updateQuery = "UPDATE products SET " . implode(", ", $updateFields) . " WHERE product_id = $product_id";
                                if (mysqli_query($connection,$updateQuery)) {
                                    if ($branch_id && !is_null($quantity)) {
                                        //Update inventory_items table
                                        $inventoryUpdateQuery = "UPDATE inventory_items
                                                                 SET quantity = $quantity, branch_id = $branch_id
                                                                 WHERE product_id = $product_id";
                                        if (mysqli_query($connection,$inventoryUpdateQuery)) {             
                                            $message = "Product updated successfully.";
                                            $message_type ="success";
                                        } else {
                                            $message="Error updating product: ". mysqli_error($connection);
                                            $message_type ="error";
                                        }
                                    } else {
                                        $message="Branch or quantity is missing.";
                                            $message_type ="error";
                                    }
                                } else {
                                    $message="Error updating product: ". mysqli_error($connection);
                                    $message_type ="error";
                                }
                        } else {
                            $message = "No changes were made to the product.";
                            $message_type ="info";
                        }
                    } else{ 
                        $insertQuery = "INSERT INTO products (name,unit_price,category,manufacturer,product_image) 
                                        VALUES ('$name',$unit_price,'$category','$manufacturer','$imageData')";
                        if (mysqli_query($connection,$insertQuery)) {
                            $product_id = mysqli_insert_id($connection);

                            //insert into inventory_items table (quantity and branch_id)
                                $branch_id = intval($_POST['branch_id']);
                                $quantity = intval($_POST['quantity']);

                                $inventoryInsertQuery = "INSERT INTO inventory_items(product_id,branch_id,quantity)
                                                        VALUES ($product_id, $branch_id, $quantity)";
                                mysqli_query($connection, $inventoryInsertQuery);
                            
                            $message = "Product created successfully.";
                            $message_type ="success";
                        } else {
                            $message="Error updating product: ". mysqli_error($connection);
                            $message_type ="error";
                        }
                    }
            }
        }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Creation</title>
    <link rel="stylesheet" href="../styles/desktop.css">
    <!------popping font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
</head>
<body class="admin-db-form">
<div class="admin-db-container">
    <form class="product-form" method="post" enctype="multipart/form-data"> <!--Added enctype for file upload -->
    <img src="../images/logo.png" alt="Senteur Elegant Logo">
    <h2 class="title"><?= isset($product) ? 'Edit Product' : 'Create Product' ?></h2>
        <?php if ($message): ?> <div class="alert <?= $message_type; ?>"><?= $message; ?></div> <?php endif; ?>
        <label for = "name"><strong>Name:</strong></label>
        <input type="text" id="name" name="name" value="<?= isset($product) ? htmlspecialchars($product['name']) : '';?>">

        <label for = "unit_price"><strong>Unit Price:</strong></label>
        <input type="text" id="unit_price" name="unit_price" value="<?= isset($product) ? $product['unit_price'] : '';?>">

        <label for = "category"><strong>Category:</strong></label>
        <input type="text" id="category" name="category" value="<?= isset($product) ? htmlspecialchars($product['category']) : '';?>">

        <label for = "branch_id"><strong>Branch:</strong></label>
        <select id="branch_id" name="branch_id">
        <!-- Ensures for product creation, the user is prompted to select a branch -->
            <option value="" disabled <?= !isset($product) ? 'selected' : ''; ?>>-- Choose a branch --</option>
            <?php while ($branch = mysqli_fetch_assoc($branchOptionsResutlt)): ?>
                <option value="<?= $branch['branch_id']; ?>"
                    <?php
                        // Pre-selects the branch if the $product is set. if not the defalt selection is used
                        if (isset($product) && $branch['branch_id'] == $product['branch_id']) {
                            echo 'selected';
                        }
                    ?>>
                    <?= $branch['name']; ?>
                </option>
            <?php endwhile ?>
        </select>
        
        <label for = "quantity"><strong>Quantity:</strong></label>
        <input type="number" id="quantity" name="quantity" value="<?= isset($product) ? $product['quantity'] : '';?>">

        <label for = "manufacturer"><strong>Manufacturer:</strong></label>
        <input type="text" id="manufacturer" name="manufacturer" value="<?= isset($product) ? htmlspecialchars($product['manufacturer']) : '';?>" required>

        <label for = "image"><strong>Product Image:</strong></label>
        <input type="file" id="image" name="image">


        <input class="edit-product-button" type="submit" value="<?= isset($product_id) ? 'Save Changes' : 'Create'?>">
        <a href="admin-dashboard.php" class="back-btn">Back</a>
    </form>
<div>
</body>
</html>