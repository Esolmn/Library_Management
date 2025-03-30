<?php require '../database/db_connect.php'; ?>
<?php include '../layout/header.php'; ?>

<?php 
    if(isset($_SESSION['email'])) {
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'superadmin') {
            //display website
?>

<?php 

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
    } else{
        $_SESSION['error'] = 'No existing ID';
        header('Location: ../books/404error.php');
        exit();
    }
    
    $sql = "DELETE FROM users WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if($stmt) {

        mysqli_stmt_bind_param($stmt, "i", $id);

            if (mysqli_stmt_execute($stmt)) {
                    echo "<script>
                    Swal.fire({
                        title: 'Success!',
                        text: 'Account has been deleted',
                        icon: 'success',
                        showConfirmButton: 'Ok',
                    }).then(function() {
                        window.location.href = '../auth/logout.php';
                    });
                </script>";
            } else {
                echo "<script>
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to delete user',
                        icon: 'error',
                        showConfirmButton: 'Ok',
                    }).then(function() {
                        window.location.href = 'index.php';
                    });
                </script>";
            }
    } else {
        die("Error: " . mysqli_error($conn));
    }

?>
<?php include '../layout/footer.php'; ?>

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