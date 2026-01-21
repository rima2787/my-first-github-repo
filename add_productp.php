<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="text-center mb-4">Add New Product</h2>
            <form action="add_product_dbp.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" id="description" name="description" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="area">Area</label>
                    <input type="text" id="area" name="area" class="form-control" required>
                </div>
                <div class="form-group">
    <label for="avail">Availability</label>
    <select id="avail" name="avail" class="form-control" required>
        <option value="1">Available</option>
        <option value="0">Not Available</option>
    </select>
</div>

<div class="form-group">
    <label for="avail">Category</label>
    <select id="avail" name="category" class="form-control" required>
        <option value="Fruits">Fruits</option>
        <option value="Harvests">Harvests</option>
        <option value="Flowers">Flowers</option>
        <option value="Grassess">Grassess</option>
        <option value="Timbered">Timbered</option>
        <option value="Seasonal">Seasonal</option>
        <option value="Gifts for friends">Gifts for friends</option>
        <option value="Others">Others</option>
        
        
        
    </select>
</div>
                <div class="form-group">
                    <label for="photo">Upload Photo</label>
                    <input type="file" id="photo" name="photo" class="form-control" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Add Product</button>
            </form>
        </div>
    </div>
    
</body>
</html>
