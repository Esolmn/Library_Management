<?php require 'database/db_connect.php'; ?>
<?php include '../layout/header.php'; ?>

<?php 
    if(isset($_SESSION['email'])) {
?>

<?php 

    $sql = "UPDATE books SET sku=?, title = ?, author = ?, genre = ?, price = ?, year_published = ?, currency = ?, stock = ? WHERE id = ?";
    
    $stmt = mysqli_prepare($conn, $sql);

    if($stmt) {

        $id = $_GET['id'];

        $sku = $_POST['sku'];  
        $title = $_POST['title'];
        $author = $_POST['author'];
        $genre = $_POST['genre'];
        $price = number_format($_POST['price'], 2, '.', '');
        $year_published = $_POST['year_published'];
        $currency = $_POST['currency'];
        $stock = $_POST['stock'];

        mysqli_stmt_bind_param($stmt, "ssssdssii", $sku, $title, $author, $genre, $price, $year_published, $currency, $stock, $id);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                Swal.fire({
                    title: 'Success!',
                    text: 'Book has been updated',
                    icon: 'success',
                    showConfirmButton: 'Ok',
                }).then(function() {
                    window.location.href = 'index.php';
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to update book, try again.',
                    icon: 'error',
                    showConfirmButton: 'Ok',
                }).then(function() {
                    window.location.href = 'update.php?id=$id';
                });
            </script>";
        }
    }

?>
<?php include 'footer.php'; ?>

<?php
    }
    else {
        header('Location: ../auth/login.php');
        exit();
    }
?>