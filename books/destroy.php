<?php require 'database/db_connect.php'; ?>
<?php include '../layout/header.php'; ?>

<?php 
    if(isset($_SESSION['email'])) {
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'superadmin' || $_SESSION['role'] == 'admin') {
?>

<?php 

    $sql = "DELETE FROM books WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if($stmt) {

        $id = $_GET['id'];

        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                Swal.fire({
                    title: 'Success!',
                    text: 'Book Details has been deleted',
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
                    text: 'Failed to delete book details',
                    icon: 'error',
                    showConfirmButton: 'Ok',
                }).then(function() {
                    window.location.href = 'index.php';
                });
            </script>";
        }
    }

?>
<?php include 'footer.php'; ?>
<?php
        } else{
            header('Location: ../index.php');
            exit();
        }
    }
    else {
        header('Location: ../auth/login.php');
        exit();
    }
?>