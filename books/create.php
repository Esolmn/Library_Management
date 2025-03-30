<?php include '../layout/header.php'; ?>

<?php 
    if(isset($_SESSION['email'])) {
?>

    <div class="container-xxl p-4 shadow rounded mt-5" style="background-color: white;">
        <div class="border border-primary p-2 bg-primary rounded w-25 mx-auto">
            <h1 class="text-center fw-bolder text-white">ADD BOOK</h1>
        </div>
        <form action="store.php" method="POST">
            <div class="row gx-3 m-4">
                <div class="col-md-4">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title" required>
                </div>

                <div class="col-md-4">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" id="author" name="author" class="form-control" placeholder="Enter Author" required>
                </div>

                <div class="col-md-4">
                    <label for="genre" class="form-label">Genre</label>
                    <input type="text" id="genre" name="genre" class="form-control" placeholder="Enter Genre" required>
                </div>
            </div>

            <div class="row gx-3 m-4">
                <div class="col-md-4">
                    <label for="sku" class="form-label">SKU</label>
                    <input type="text" id="sku" name="sku" class="form-control" placeholder="Enter SKU" required>
                </div>

                <div class="col-md-2">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" id="price" name="price" step="0.01" min="0" class="form-control" placeholder="Enter Price" required>
                </div>

                <div class="col-md-2">
                    <label for="year_published" class="form-label ms-4">Year Published</label>
                    <select class="form-select btn btn-dropend w-75 border ms-4" id="year_published" name="year_published" required>
                        <option value="<?= date('Y') ?>"><?= date('Y') ?></option>
                        <?php
                        $currentYear = date('Y');
                        for ($i = $currentYear-1; $i >= ($currentYear - 100); $i--) {
                            echo "<option value='$i'>$i</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="currency" class="form-label">Currency</label>
                    <select class="form-select btn btn-dropend w-75 border" id="currency" name="currency" required>    
                    <option value="PHP">PHP</option>
                        <option value="USD">USD</option>
                        <option value="EUR">EUR</option>
                    </select>
                </div>

                <div class="col-md-2">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" id="stock" name="stock" class="form-control" placeholder="Enter Stock" required>
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