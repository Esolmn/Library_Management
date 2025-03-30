<?php require '../database/db_connect.php'; ?>
<?php include '../layout/header.php'; ?>

<?php 
if(isset($_SESSION['email'])) {
    if(isset($_SESSION['role']) && $_SESSION['role'] == 'superadmin') {
        //display website
?>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $sql = "SELECT * FROM users WHERE email = '" . $_POST['email'] ."' ";

        $result = mysqli_query($conn, $sql);

        $user = mysqli_fetch_assoc($result);

        if($user){
            $_SESSION['error'] = 'Email already exists';
        }
        else {
            $sql = "INSERT INTO users (first_name, last_name, email, password, role, status) VALUES (?,?,?,?,?,?)";

            $stmt = mysqli_prepare($conn, $sql);

            if($stmt){
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $email = $_POST['email'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $role = $_POST['role'];
                $status = $_POST['status'];

                mysqli_stmt_bind_param($stmt, 'ssssss', $first_name, $last_name, $email, $password, $role, $status);

                if (mysqli_stmt_execute($stmt)) {

                    echo "<script>
                        Swal.fire({
                            title: 'Success!',
                            text: 'User has been created',
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
                            text: 'User was not created',
                            icon: 'error',
                            showConfirmButton: 'Ok',
                        }).then(function() {
                            window.location.href = 'create.php';
                        });
                    </script>";
                }
            } else {
                die("Error: " . mysqli_error($conn));
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