<?php
    $username = "";
    $password = "";
    $error = "";

    if($_SERVER["REQUEST_METHOD"]=="POST") {

        $username = $_POST["username"];
        $password = $_POST["password"];

        if (($username == "admin") && ($password == "admin")) {
            header("location: ../Dashboard/dashboard.php?from=event");
        } else {
            $username = "";
            $password = "";
            $error = "error";
        }

    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper {
            width: 900px;
            margin: 0 auto;
        }

        table tr td:last-child {
            width: 120px;
        }
    </style>
    <script>
        function error(){
            alert("Wrong Username or Password :(");
        }

        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<style>
    @font-face {
        font-family: myFirstFont;
        src: url(Montserrat-VariableFont_wght.ttf);
    }

    .left, .right{
        height: 100vh;
        width: 100%;
    }

    @media screen and (min-width:768px){
        .left, .right{

        }
    }
    .left{
        background: #013365;
        font-family: myFirstFont;
        background-size:cover ;
        background-color: #013365;
        opacity: 1;
        background-image: radial-gradient(circle at center center, #ffffff, #013365), repeating-radial-gradient(circle at center center, #ffffff, #ffffff, 10px, transparent 20px, transparent 10px);
        background-blend-mode: multiply;
    }
    .right{
        background-image: linear-gradient(to right,rgba(0, 24, 61, 1),rgba(246, 246, 242, 1),rgba(246, 246, 242, 1),rgba(246, 246, 242, 1),rgba(246, 246, 242, 1),rgba(246, 246, 242, 1),rgba(246, 246, 242, 1))
    }
    input[type='checkbox'] {
        width:8px;
        height:8px;
    }
    .error{
        font-size: small; 
        text-align:center; 
        color:#f6f6f2;
    }
</style>

<body>
<div class="row no-gutters">
        <div class="col-md-7 no-gutters">
            <div class="left d-flex justify-content-center align-items-center">
                <section style="text-align: center;">
                    <h1 style="color: #f6f6f2; font-family: myFirstFont; font-weight: bold;">Plan, Create, Celebrate:<br> Events Made Easy</h1>
                    <p style="color: #f6f6f2;">Create events, register students and generate reports.</p>
                </section>
            </div>
        </div>
        <div class="col-md-5 no-gutters">
            <div class="right d-flex justify-content-center align-items-center">
                <div style="margin-left: 40px;">
                    <form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" style="line-height: 25px;">
                        <section>
                            <h1 style="margin-top: 30px; text-align: center; color: #013365; font-weight: bold;">Welcome</h1>
                            <p class="text-muted" style="font-size: small; text-align:center;">Sign in with your Username and Password</p>
                        </section>
                        <br>
                        <div class="input-container-uname" style="width: 100%; line-height: 1.8; display: block;">
                            <label style="font-weight: bold;">Username</label><br>
                            <input style="width: 100%; padding:5px; padding-left:5px; border-radius: 5px; border: 1px solid black" type="text" name="username" value="<?php echo $username; ?>"/></div>
                        <br>
                        <div class="input-container-pword" style="width: 100%; line-height: 1.8; display: block;">
                            <label style="font-weight: bold;">Password</label><br>
                            <input style="width: 100%; padding:5px; padding-left:5px; border-radius: 5px; border: 1px solid black" type="password" name="password" value="<?php echo $password; ?>"/>
                        </div>
                        <div class="row" style="font-size: x-small;">
                            <div class="col s5 offset-s1 right-align">
                                <input type="checkbox" value="lsRememberMe" id="rememberMe"> <label for="rememberMe">Remember me</label>
                            </div>
                            <div class="col s5 offset-s1 left-align" style="text-align: right;">
                                <p class="text-muted" style="text-decoration: underline blue;"><a href="#">Forgot password?</a></p>
                            </div>
                        </div>
                        
                        
                        <button style="width: 100%; align-items: center; border-radius: 20px; background-color: #013365; color: white; border: none;">Log In</button>
                        <p style="font-size: x-small;">Not a member? <a href="#" style="text-decoration: underline blue;">Register</a> now!</p>
                        <br>
                        <p class="error" id="error" onclick="error()">Sign in with your Username and Password</p>
                    </form>
                </div>
            </div>
        </div>
</body>

