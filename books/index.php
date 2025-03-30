<?php require "database/db_connect.php"; ?>
<?php include '../layout/header.php'; ?>

<style>
    .Title {
            font-family: 'Varela', sans-serif;
            font-weight: 500;
            font-size: 60px;
            color:rgb(73, 13, 134);
        }
</style>

<?php 
    if(isset($_SESSION['email'])) {
?>

<?php
    $sql = "SELECT * FROM books";

    $result = mysqli_query($conn, $sql);//run query

    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
    <div class="container-xxl p-4 shadow rounded mt-4" style="background-color: white;">
        <h1 class="Title text-center">LIBRARY</h1>
        <div class="text-start mt-4 mb-4">
            <a class="btn btn-primary" href="create.php">Create</a>
        </div>
        <table id="booksTable" class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th style="color:crimson">#</th>
                    <th>SKU</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Year Published</th>
                    <th>Action</th>
                </tr>
            <tbody>
                <?php 
                $i = 1;
                foreach($books as $book): ?>
                    <tr>
                        <td style="color:crimson"><?= $i++; ?></td>
                        <td><?= $book['sku']; ?></td>
                        <td><?= $book['title']; ?></td>
                        <td><?= $book['author']; ?></td>
                        <td><?= $book['genre']; ?></td>
                        <td><?= $book['year_published']; ?></td>
                        <td>
                            <a class="btn btn-primary me-2" href="show.php?id=<?=$book['id']?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                </svg>
                            </a>
                            <a class="btn btn-warning me-2" href="edit.php?id=<?=$book['id']?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                </svg>
                            </a>
                            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin' || $_SESSION['role'] == 'superadmin') { ?>
                            <a class="btn btn-danger me-2" onclick="
                                const swalWithBootstrapButtons = Swal.mixin({
                                    customClass: {
                                        confirmButton: 'btn btn-success',
                                        cancelButton: 'btn btn-danger'
                                    },
                                    buttonsStyling: false
                                });
                                swalWithBootstrapButtons.fire({
                                    title: 'Are you sure?',
                                    text: 'You won\'t be able to revert this!',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Yes, delete it!',
                                    cancelButtonText: 'No, cancel!',
                                    reverseButtons: true
                                }).then((result) => {
                                    if (result.isConfirmed){
                                        window.location.href = 'destroy.php?id=<?=$book['id']?>';
                                    }       
                                });
                            ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                </svg>
                            </a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php include 'footer.php'; ?>

<?php }
    else {
        header('Location: ../auth/login.php');
        exit();
    }
?>