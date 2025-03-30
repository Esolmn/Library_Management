<?php
    require "../database/db_connect.php";
    include '../layout/header.php';

    if(isset($_SESSION['email'])){
        header('Location: ../index.php');  
        exit();  
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){ //chinecheck kung POST ang ginamit sa create.php kung saan ka gumawa ng user account
        $sql = "SELECT * FROM users WHERE email = '" . $_POST['email'] . "'";

        $result = mysqli_query($conn, $sql);    

        $user = mysqli_fetch_assoc($result);

        if($user){
            if(password_verify($_POST['password'], $user['password'])){ 

                if($user['status'] !== 'active') { //pag check kung active or hindi
                    $_SESSION['error'] = 'User Account Inactive';
                    header('Location: login.php'); //balik login kapag inactive
                    exit(); // stop ng execution sa ibang code
                }

                header('Location: ../index.php'); // pag active diretso na rito
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
            }
            else{
                $_SESSION['error'] = 'Invalid email or password';
            }
        }
        else{
            $_SESSION['error'] = 'Invalid email or password';   
        }
    }
?>
<div class="container-xxl d-flex justify-content-center align-items-center"
    style="height: 100vh;">
    <div class="card shadow rounded-5 p-5" style="width: 500px; height: 500px;">
        <div class="card-title text-center">
            <h1>
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="blue" class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                </svg>
            </h1>
            <h2 class="text-center fw-bold mt-3 mb-4 text-primary">LOGIN</h2>
        </div>
        <form action="login.php" method="POST">
            <div class="row">
                <div class="col-12 mb-4">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email"
                           class="form-control <?=(isset($_SESSION['error']) ? 'is-invalid' : null )?>" required>
                    <?php if(isset($_SESSION['error'])) :  ?>
                    <div class="invalid-feedback">
                        <?= $_SESSION['error'] ?>
                    </div>
                    <?php 
                        endif;
                        unset($_SESSION['error']);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-4">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password"
                           class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-3">
                    <button type="submit" class="btn btn-primary w-100 rounded-3 btn-lg">Login</button>    
                </div>
            </div>
        </form>
    </div>
</div>

<?php include '../layout/footer.php'; ?>