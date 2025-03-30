<style>
        .container {
                background: linear-gradient(to bottom, #552586, #6A359C, #804FB3, #9969C7, #B589D6); 
        }
        .Title {
            font-family: 'Varela', sans-serif;
            font-weight: 500;
            font-size: 60px;
            color:rgb(73, 13, 134);
        }
</style>

<?php require 'database/db_connect.php'; ?>
<?php include 'layout/header.php'; ?>

<?php   
        if(!isset($_SESSION['email'])){
                header('Location: auth/login.php');
        }

        //total number of books
        $sql = "SELECT id FROM books";
        $result = mysqli_query($conn, $sql);
        $total_books = mysqli_num_rows($result);

        //total numbers of users
        $sql = "SELECT id FROM users";
        $result = mysqli_query($conn, $sql);
        $total_users = mysqli_num_rows($result);

        //books added for the last 24hrs,
        $books_24Hrs = date('Y-m-d H:i:s' , strtotime('-1 day'));
        $sql = "SELECT id FROM books WHERE created_at >= '$books_24Hrs'";
        $result = mysqli_query($conn, $sql);
        $total_new_books = mysqli_num_rows($result);

        //users added for the last 24hrs
        $users_24Hrs = date('Y-m-d H:i:s' , strtotime('-1 day'));
        $sql = "SELECT id FROM users WHERE created_at >= '$users_24Hrs'";
        $result = mysqli_query($conn, $sql);
        $total_new_users = mysqli_num_rows($result);

        //total active users
        $sql = "SELECT id FROM users WHERE status = 'active'";
        $result = mysqli_query($conn, $sql);
        $total_active = mysqli_num_rows($result);

        //total inactive users
        $sql = 'SELECT id FROM users WHERE status = "inactive"';
        $result = mysqli_query($conn, $sql);
        $total_inactive = mysqli_num_rows($result);
?>

<div class="d-flex justify-content-center align-item-center mt-5">
        <p class="Title">Analytics Dashboard</p>
</div>

<div class="container container-lg rounded-5 shadow mt-3 p-5">
    <div class="row gx-3 d-flex justify-content-center">
        <div class="col-md-4">
                <div class="card shadow rounded-4 p-4 mt-3" style="width: 350px; height: 250px;">
                        <div class="card-title text-center">
                                <svg class="mt-4" xmlns="http://www.w3.org/2000/svg" width="80" height="50" fill="purple" class="bi bi-book-fill" viewBox="0 0 16 16">
                                        <path d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
                                </svg>
                                <p class="text-center fw-bold mt-3">Total Books</p>
                                <p class="text-center fw-bold mt-3"><?php echo $total_books; ?></p>
                        </div>
                </div>
        </div>
        <div class="col-md-4">
                <div class="card shadow rounded-4 p-4 mt-3" style="width: 350px; height: 250px;">
                        <div class="card-title text-center">
                                <svg class="mt-4" xmlns="http://www.w3.org/2000/svg" width="80" height="50" fill="blue" class="bi bi-people-fill" viewBox="0 0 16 16">
                                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                                </svg>
                                <p class="text-center fw-bold mt-3">Total Users</p>
                                <p class="text-center fw-bold mt-3"><?php echo $total_users; ?></p>
                        </div>
                </div>
        </div>
        <div class="col-md-4">
                <div class="card shadow rounded-4 p-4 mt-3" style="width: 350px; height: 250px;">
                        <div class="card-title text-center">
                        <svg  class="mt-4" xmlns="http://www.w3.org/2000/svg" width="80" height="50" fill="purple" class="bi bi-book-half" viewBox="0 0 16 16">
                                <path d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
                        </svg>
                                <p class="text-center fw-bold mt-3">Total New Books</p>
                                <p class="text-center fw-bold mt-3"><?php echo $total_new_books; ?></p>
                        </div>
                </div>
        </div>
     </div>
     
     <div class="row gx-3 justify-content-center mt-4">
        <div class="col-md-4">
                <div class="card shadow rounded-4 p-4 mt-3" style="width: 350px; height: 250px;">
                        <div class="card-title text-center">
                                <svg class="mt-4" xmlns="http://www.w3.org/2000/svg" width="80" height="50" fill="blue" class="bi bi-people-fill" viewBox="0 0 16 16">
                                                <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                                </svg>
                                <p class="text-center fw-bold mt-3">Total New Users</p>
                                <p class="text-center fw-bold mt-3"><?php echo $total_new_users; ?></p>
                        </div>
                </div>
        </div>
        <div class="col-md-4">
                <div class="card shadow rounded-4 p-4 mt-3" style="width: 350px; height: 250px;">
                        <div class="card-title text-center">
                        <svg class="mt-4" xmlns="http://www.w3.org/2000/svg" width="80" height="50" fill="blue" class="bi bi-person-fill-check" viewBox="0 0 16 16">
                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
                        </svg>
                                <p class="text-center fw-bold mt-3">Total Active Users</p>
                                <p class="text-center fw-bold mt-3"><?php echo $total_active; ?></p>
                        </div>
                </div>
        </div>
        <div class="col-md-4">
                <div class="card shadow rounded-4 p-4 mt-3" style="width: 350px; height: 250px;">
                        <div class="card-title text-center">
                        <svg class="mt-4" xmlns="http://www.w3.org/2000/svg" width="80" height="50" fill="blue" class="bi bi-person-fill-dash" viewBox="0 0 16 16">
                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M11 12h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1m0-7a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
                        </svg>
                                <p class="text-center fw-bold mt-3">Total Inactive Users</p>
                                <p class="text-center fw-bold mt-3"><?php echo $total_inactive; ?></p>
                        </div>
                </div>
        </div>
     </div>
</div>

<?php include 'layout/footer.php'; ?>