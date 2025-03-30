<?php include '../layout/header.php'; ?>

<?php 
    if(isset($_SESSION['email'])) {
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'superadmin') {
            //display website
?>

<div>
    <a class="cancel btn me-2 shadow align-items-center" href="index.php"> < </a>
</div>

<div class="container-xxl d-flex justify-content-center align-items-center mt-5">
    <div class="card shadow rounded-4 p-4 mt-5" style="width: 700px;">
        <div class="card-title text-center">
            <h1><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="blue" class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                </svg>
            </h1>
            <h2 class="text-center fw-bold mt-3 text-primary">CREATE ACCOUNT</h2>
        </div>
        <form action="store.php" method="POST">
            <div class="row gx-3 mb-4">
                <div class="col-md-5 mb-6">
                    <label for="first_name" class="mb-2">First Name</label>
                    <input type="text" id="first_name" name="first_name" class="form-control" required>
                </div>

                <div class="col-md-7 mb-6">
                    <label for="last_name" class="mb-2">Last Name</label>
                    <input type="text" id="last_name" name="last_name" class="form-control" required>
            </div>
            </div>
            <div class="row">
                <div class="col-12 mb-3">
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
                <div class="col-12 mb-3">
                    <label for="password" class="mb-2">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
            </div>
            <div class="row gx-3 mb-4">
                <div class="col-md-5">
                    <label for="role" class="mb-2">Role</label>
                    <select name="role" id="role" class="form-select">
                        <option value="superadmin">Super Admin</option>
                        <option value="admin">Admin</option>
                        <option value="librarian">Librarian</option>
                    </select>
                </div>
                <div class="col-md-7">
                    <label for="status" class="mb-2">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary w-100 rounded-3 mt-3">Create Account</button>
                </div>
            </div>
        </form>
    </div>
</div>

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


