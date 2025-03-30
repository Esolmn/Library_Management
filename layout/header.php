<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.2.2/af-2.7.0/b-3.2.2/b-colvis-3.2.2/b-html5-3.2.2/b-print-3.2.2/cr-2.0.4/date-1.5.5/fc-5.0.4/fh-4.0.1/kt-2.12.1/r-3.0.4/rg-1.5.1/rr-1.5.0/sc-2.4.3/sb-1.8.2/sp-2.3.3/sl-3.0.0/sr-1.4.1/datatables.min.css" rel="stylesheet" integrity="sha384-6gM1RUmcWWtU9mNI98EhVNlLX1LDErxSDu2o/YRIeXq34o77tQYTXLzJ/JLBNkNV" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&family=Varela&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body style="background-color:offwhite;">

<style>

    .container {
        padding: 20px; /* Reduce overall padding */
        max-width: 1200px; /* Prevent excessive width */
    }

    .card {
    padding: 15px; /* Reduce inner space */
    margin: 10px; /* Reduce gaps between cards */
    }


    .navbar {
        font-family: 'Varela', sans-serif;
        font-weight: 500;
        font-size: 18px;
        border-radius: 20px;
        margin-left: 20px;
        margin-right: 20px;
        height: 75px;
        background-color:rgb(255, 255, 255);
    }

    .cancel {
        font-family: 'Varela', sans-serif;
        font-weight: 500;
        font-size: 40px;
        color: red;
        margin-left: 40px;
        margin-top: 40px;
        background-color: white;
    }
</style>

<?php 

    session_start([
        'cookie_lifetime' => 86400 // 1 day
    ]);

    $current_page = basename($_SERVER['PHP_SELF']); //kinukuha ung current filename ng page kung nasaan ka tapos ang kukunin ng basename ay yung filename mismo at hindi full directory

    $email = isset ($_SESSION['email']) ? $_SESSION['email'] : null;

    if($current_page != 'login.php') {
?>
    <nav class="navbar shadow mt-4 d-flex align-items-center">
        <div class="container-fluid d-flex align-items-center">
            <div class="d-flex">
                <a class="ms-4 navbar-brand text-black" href="/Lab_PHP_User_Authentication_Erik_Act4/index.php">Dashboard</a>
                <a  class="ms-5 navbar-brand text-black" href="/Lab_PHP_User_Authentication_Erik_Act4/books/index.php">Manage Books</a> 
                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'superadmin'){ //
                        echo '<a href="/Lab_PHP_User_Authentication_Erik_Act4/users/index.php" class="ms-5 navbar-brand text-black">Manage Users</a>';
                    } ?>
            </div>
            <div class="d-flex align-items-center">
                <p class="navbar-brand text-black mb-0"><?php echo isset($_SESSION['email']) ? '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor   " class="bi bi-person-circle me-2 mb-1" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                    </svg> 
                    '.$email : '' ?></p>
                <p class="mb-0 ms-4 me-4"> | </p>
                <a class="navbar-brand me-4" style="color: red;" href="/Lab_PHP_User_Authentication_Erik_Act4/auth/logout.php">Log out</a>
            </div>
        </div>
    </nav>
<?php } ?>