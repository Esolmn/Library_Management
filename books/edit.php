<?php require 'database/db_connect.php'; ?>
<?php include '../layout/header.php'; ?>

<?php 
    if(isset($_SESSION['email'])) {
?>

<?php 
    $id = $_GET['id']; 

    $sql = "SELECT * FROM books WHERE id = $id";

    $result = mysqli_query($conn, $sql);

    $book = mysqli_fetch_assoc($result);
?>

<div class="container-xxl p-4 shadow rounded mt-5" style="background-color: white;">
    <h1 class="text-center fw-bolder mb-4 text-warning">EDIT BOOK DETAIL</h1>
    <form action="update.php?id=<?php echo $book['id'] ?>" method="POST">
        <div class="row gx-3 m-4">
            <div class="col-md-4">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title" value="<?php echo $book['title'] ?>" required">
            </div>

            <div class="col-md-4">
                <label for="author" class="form-label">Author</label>
                <input type="text" id="author" name="author" class="form-control" placeholder="Enter Author" value="<?php echo $book['author'] ?>" required">
            </div>

            <div class="col-md-4">
                <label for="genre" class="form-label">Genre</label>
                <input type="text" id="genre" name="genre" class="form-control" placeholder="Enter Genre" value="<?php echo $book['genre'] ?>" required>
            </div>
        </div>

        <div class="row gx-3 m-4">
            <div class="col-md-4">
                <label for="sku" class="form-label">SKU</label>
                <input type="text" id="sku" name="sku" class="form-control" placeholder="Enter SKU" value="<?php echo $book['sku'] ?>" required>
            </div>

            <div class="col-md-2">
                <label for="price" class="form-label">Price</label>
                <input type="number" id="price" name="price" step="0.01" min="0" class="form-control" placeholder="Enter Price" value="<?php echo $book['price'] ?>" required">
            </div>

            <div class="col-md-2">
                <label for="year_published" class="form-label ms-4">Year Published</label>
                <select class="form-select btn btn-dropend w-75 border ms-4" id="year_published" name="year_published" value="<?php echo $book['year_published'] ?>" required>
                    <option value="<?php echo $book['year_published'] ?>"><?php echo $book['year_published'] ?></option>
                    <?php
                    $currentYear = date('Y');
                    for ($i = $currentYear; $i >= ($currentYear - 100); $i--) {
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-2">
                <label for="currency" class="form-label">Currency</label>
                <select class="form-select btn btn-dropend w-75 border" id="currency" name="currency" value="<?php echo $book['currency'] ?>" required>
                    <option value="PHP">PHP</option>
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                </select>
            </div>

            <div class="col-md-2">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" id="stock" name="stock" class="form-control" placeholder="Enter Stock" value="<?php echo $book['stock'] ?>" required>
            </div>
        </div>
        
        <div class="text-end mt-5 me-4">
            <a class="btn btn-danger me-2" href="index.php">Cancel</a>
            <button class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<?php include 'footer.php'; ?>

<?php }
    else {
        header('Location: ../auth/login.php');
        exit();
    }
?>