<?php include '../database/db_connect.php'; ?>
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

    $sql = "UPDATE users SET first_name = ?, last_name = ?, email = ?, password = ?, role = ?, status = ? WHERE id = ?";
    
    $stmt = mysqli_prepare($conn, $sql);

    if($stmt) {

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $status = $_POST['status'];

        if(!empty($_POST['password'])) {//kapag ndi empty, ilalagay ung bago nang naka hash
            $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $sql = 'UPDATE users SET first_name = ?, last_name = ?, email = ?, password = ?, role = ?, status = ? WHERE id = ?';
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssssssi", $first_name, $last_name, $email, $new_password, $role, $status, $id);
        } else {
            $sql = 'UPDATE users SET first_name = ?, last_name = ?, email = ?, role = ?, status = ? WHERE id = ?';
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sssssi", $first_name, $last_name, $email, $role, $status, $id);
        }

        if(isset($_SESSION['email']) && $_SESSION['email'] == $email) {
            if (mysqli_stmt_execute($stmt)) {

                echo "<script>
                    Swal.fire({
                        title: 'Success!',
                        text: 'Your Account has been updated',
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
                        text: 'User has not been updated',
                        icon: 'error',
                        showConfirmButton: 'Ok',
                    }).then(function() {
                        window.location.href = 'edit.php?id=$id';
                    });
                </script>";
            }
        } else {
            if(mysqli_stmt_execute($stmt)) {
                echo "<script>
                Swal.fire({
                    title: 'Success!',
                    text: 'User has been updated',
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
                    text: 'User has not been updated',
                    icon: 'error',
                    showConfirmButton: 'Ok',
                }).then(function() {
                    window.location.href = 'edit.php?id=$id';
                });
            </script>";
            }
        }
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