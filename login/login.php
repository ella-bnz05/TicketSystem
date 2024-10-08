<?php
session_start();

// Redirect to dashboard if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: ../../TS/dashboard.php');
    exit();
}

include 'C:\xampp\htdocs\TS\db\config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="../img/CITRMU_Logo.png" />
    <title>Ticketing System - CITRMU</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="../css/main.min.css" />
</head>

<body class="login-bg">
    <div class="container">
        <div class="login-screen row align-items-center">
            <div class="screen">
                <div class="screen__content">
                    <form action="/TS/login/login-script.php" method="POST" class="login__title">
                        <?php
                        if (isset($_GET['alert'])) {
                            // Get the value of the `alert` parameter.
                            $alertType = $_GET['alert'];

                            // Display an alert message based on the value of the `alert` parameter.
                            switch ($alertType) {
                                case 'user_not_found':
                                    echo '<div class="bg-secondary text-white border-0 alert alert-success alert-dismissible fade show" role="alert">';
                                    echo 'USER NOT FOUND.';
                                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                                    echo '</div>';
                                    break;
                                case 'incorrect_password':
                                    echo '<div class="bg-secondary text-white alert alert-danger alert-dismissible fade show" role="alert">';
                                    echo 'INCORRECT PASSWORD.';
                                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                                    echo '</div>';
                                    break;
                                default:
                                    echo '<div class="bg-secondary text-white alert alert-danger alert-dismissible fade show" role="alert">';
                                    echo 'Unknown Alert Type.';
                                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                                    echo '</div>';
                                    break;
                            }
                        } ?>
                        <div class="login__field">
                            <div class="d-flex gap-1 align-items-center pb-1 w-10">
                                <h1 class="fs-7"><code class="text-success">CITRMU</code><br />TICKETING SYSTEM</h1>
                                <img src="../img/CITRMU_Logo.png" alt="CITRMU Brand" class="custom-logo">
                            </div>
                        </div>
                        <div class="login__field">
                            <i class="login__icon fas fa-user"></i>
                            <input type="text" class="login__input" placeholder="Username" aria-label="username"
                                id="username" name="username" required>
                        </div>
                        <div class="login__field">
                            <i class="login__icon fas fa-lock"></i>
                            <input type="password" class="login__input" placeholder="Password" aria-label="Password"
                                id="password" name="password" required>
                        </div>
                        <button class="button login__submit" type="submit" name="btn_SignIn">
                            <span class="button__text">Log In Now</span>
                            <i class="button__icon fas fa-chevron-right"></i>
                        </button>
                    </form>
                </div>
                <div class="screen__background">
                    <!--<span class="screen__background__shape screen__background__shape4"></span>-->
                    <span class="screen__background__shape screen__background__shape3"></span>
                    <span class="screen__background__shape screen__background__shape2"></span>
                    <span class="screen__background__shape screen__background__shape1"></span>
                </div>
            </div>
        </div>
    </div>
</body>

<style>
    @import url('https://fonts.googleapis.com/css?family=Raleway:400,700');

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .container {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 50vh;
    }

    h1 {
        position: relative;
        top: -8px;
    }

    .screen {
        background: linear-gradient(90deg, #2cb593, #5bb59e);
        position: relative;
        height: 600px;
        width: 460px;
        box-shadow: 0px 0px 24px #179978;
    }

    .screen__content {
        z-index: 1;
        position: relative;
        height: 0%;
    }

    .screen__background {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 0;
        -webkit-clip-path: inset(0 0 0 0);
        clip-path: inset(0 0 0 0);
    }

    .screen__background__shape {
        transform: rotate(45deg);
        position: absolute;
    }

    .screen__background__shape1 {
        height: 520px;
        width: 520px;
        background: #FFF;
        top: -50px;
        right: 120px;
        border-radius: 0 72px 0 0;
    }

    .screen__background__shape2 {
        height: 220px;
        width: 220px;
        background: #179978;
        top: -172px;
        right: 0;
        border-radius: 32px;
    }

    .screen__background__shape3 {
        height: 540px;
        width: 190px;
        background: linear-gradient(270deg, #179978, #5bb59e);
        top: -24px;
        right: 0;
        border-radius: 32px;
    }

    .screen__background__shape4 {
        height: 400px;
        width: 200px;
        background: #179978;
        top: 420px;
        right: 50px;
        border-radius: 60px;
    }

    .login {
        width: 20px;
        padding: 30px;
        padding-top: 156px;
    }

    .login__field {
        padding: 20px 10px 20px 20px;
        position: relative;
    }

    .login__title {
        padding: 20px 10px;
        position: relative;
    }

    .login__icon {
        position: absolute;
        top: 35px;
        color: #179978;
    }

    .login__input {
        border: none;
        border-bottom: 2px solid #D1D1D4;
        background: none;
        padding: 10px;
        padding-left: 24px;
        font-weight: 700;
        width: 75%;
        transition: .2s;
    }

    .custom-logo {
        width: 7rem;
        height: auto;
        top: -30px;
        position: relative;
    }

    .login__input:active,
    .login__input:focus,
    .login__input:hover {
        outline: none;
        border-bottom-color: #44cba9;
    }

    .login__submit {
        background: #fff;
        font-size: 14px;
        margin-top: 30px;
        padding: 16px 20px;
        border-radius: 26px;
        border: 1px solid #D4D3E8;
        text-transform: uppercase;
        font-weight: 700;
        display: flex;
        align-items: center;
        width: 50%;
        color: #179978;
        box-shadow: 0px 2px 2px;
        cursor: pointer;
        transition: .2s;
    }

    .login__submit:active,
    .login__submit:focus,
    .login__submit:hover {
        border-color: #6A679E;
        outline: none;
    }

    .button__icon {
        font-size: 24px;
        margin-left: auto;
        color: #7875B5;
    }

    /* Responsive design adjustments */
    @media (max-width: 768px) {
        .screen {
            height: auto;
            width: 100%;
        }

        .login__title h1 {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 576px) {

        .screen__background__shape1,
        .screen__background__shape2,
        .screen__background__shape3 {
            display: none;
        }

        .screen {
            background: rgba(1, 64, 49, 0.8);
            border-radius: 0 72px 0 0;
        }

        .login-screen {
            padding: 5rem 1rem 0 1rem;
        }

        .custom-logo {
            width: 7rem;
            height: auto;
            top: -8px;
            padding: -10px 0 0 10px;
            position: relative;
        }

        .login__submit {
            margin: 30px 0px;
        }

        .login__title h1 {
            font-size: 1.5rem;
            color: white;
        }

        input::placeholder {
            color: #94dbc2;
            font-style: italic;
        }

        .text-success {
            color: #94dbc2 !important;
        }
    }
</style>

</html>