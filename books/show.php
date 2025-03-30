<?php require 'database/db_connect.php'; ?>
<?php include '../layout/header.php'; ?>

<?php 
    if(isset($_SESSION['email'])) {
?>

<?php 

    $id = $_GET['id'];

    $sql = "SELECT * FROM books WHERE id = ?"; 

    $stmt = mysqli_prepare($conn, $sql);

    if($stmt) {

        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $book = mysqli_fetch_assoc($result);

    }

    if(!$book) {
        echo "<script>
                window.location.href = '404error.php';
        </script>";
    }
?>
<div class="container mt-5">
    <h1 class="book-detail text-center mb-5 fw-bolder mb-4 text-primary">BOOK DETAILS</h1>
</div>

<div class="container-xxl p-4 shadow rounded mt-5" style="background-color: white;">
    <form action="update.php?id=<?php echo $book['id'] ?>" method="POST">
        <div class="row gx-3 m-4">
            <div class="col-md-4">
                <label for="title" class="form-label">Title</label>
                <p class="form-control border rounded"><?php echo $book['title'] ?></p>
            </div>

            <div class="col-md-4">
                <label for="author" class="form-label">Author</label>
                <p class="form-control border rounded"><?php echo $book['author'] ?></p>
            </div>

            <div class="col-md-4">
                <label for="genre" class="form-label">Genre</label>
                <p class="form-control border rounded"><?php echo $book['genre'] ?></p>
            </div>
        </div>

        <div class="row gx-3 m-4">
            <div class="col-md-4">
                <label for="sku" class="form-label">SKU</label>
                <p class="form-control border rounded"><?php echo $book['sku'] ?></p>
            </div>

            <div class="col-md-2">
                <label for="currency" class="form-label">Currency</label>
                <p class="form-control border rounded"><?php echo $book['currency'] ?></p>
            </div>

            <div class="col-md-2">
                <label for="price" class="form-label">Price</label>
                <p class="form-control border rounded"><?php echo $book['price'] ?></p>
           </div>

            <div class="col-md-2">
                <label for="year_published" class="form-label ms-4">Year Published</label>
                <p class="form-control border rounded"><?php echo $book['year_published'] ?></p>
            </div>

            <div class="col-md-2">
                <label for="stock" class="form-label">Stock</label>
                <p class="form-control border rounded"><?php echo $book['stock'] ?></p>    
           </div>
        </div>
        
        <div class="text-end mt-5 me-4">
            <a class="btn btn-danger me-2" href="index.php">Return</a>
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