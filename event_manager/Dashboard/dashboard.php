<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <style>
      @font-face {
        font-family: myFirstFont;
        src: url("../font/Montserrat-VariableFont_wght.ttf");
        }
        .carousel {
            width: 70vw;
        }
        .carousel-item {
            height: 75vh;
        }    

            .carousel-item > img {
                object-fit: contain;    
            }
                
        body {
            font-family: Arial, sans-serif;
            height: 100vh;
            overflow: hidden;
            background-size: cover;
        }

        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1em;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 1em;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1em;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .card-img-top {
            width: 100%;
            height: 25vh;
            object-fit: cover;
        }

        .btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:visited, .bg-primary {
            border-color: #013365 !important;
            background-color: #013365 !important;
        }

        .card-img-overlay > h2 {
            color: white;
            font-weight: bold;
        }

        .card-img-overlay > p {
            color: white;
            font-weight: light;
            font-style: italic;
        }

        h1 {
            color: white;
        }
        body {
            font-family: myFirstFont;
            height: 100%;
            overflow-y: hidden;
            background-image: url("./img/bg1.png");
        }

        .wrapper {
            width: 90vw;
            margin: 0 auto;
        }

        footer {
            width: 100%;
            height: 20vh;
        }
        .rounded-circle{
            height: 10vw;
            width: 10vw;
            position: absolute;
            right:33px;
            bottom:33px;
            box-shadow: 8px 8px 15px rgba(0,0,0,0.3)
        }

        .beeg-text{
            font-size: 12vw;
            right: 50px;
            top: 0px;
        }

        .bi-plus {
            height:50px;
            width:50px;
        }

        table tr td:last-child {
            width: 120px;
        }

        .input-group-button {
            margin-right: 10vw;
        }
        .box{
            background: rgba(246, 246, 242, 1);
            border-radius: 5px;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            margin-top:20px;
        }
        .box1{
            background: rgba(246, 246, 242, 1);
            border-radius: 3px;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        }
        .card-box{
            overflow:hidden;
            height: 75vh;
            width: 80vw;
            border-radius: 0px 0px 5px 5px;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        }
        .container{
            width: 100%;
            height: 100%;
        }
        .search-box{
            padding: 10px;
            border-bottom-style:double;
            border-bottom-color: black;
            background-image: url("../Event_Creation/img/bg3.png");
            background-size:cover;
            border-radius: 5px 5px 0px 0px;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        }
        ::-webkit-scrollbar{
            display: none;
        }
        .title{
            font-family:myFirstFont;
            text-align: center;
        }
        .title h1{
            color: #013365;
            font-weight:bold;
        }
        .title p{
            color: #013365;
        }
        .center{
            border-radius:100px;
            width:100%;
            height:100%;
        }

        h2 {
            font-weight: bold;
        }
    </style>
</head>
<body>
  <div class="container-fluid ">
    <div class="container d-flex justify-content-center align-items-center">
      <div class="box no-gutters">
        <div class="col no-gutters search-box ">
          <a class=" btn-lg position-relative input-group-button" href="../Login/index.php"><img src="./img/back.png" style="position: absolute; top: 0px; left: 0px; width:50px;height: 50px;"></a>
          <h1 style="text-align: center; font-family: myFirstFont; font-weight: bold;">Welcome Admin!</h1>
        </div>
        <div class="col no-gutters card-box">
            <div id="carouselExampleIndicators" class="carousel slide w-100 h-100" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="carousel-item <?php echo((($_GET['from']) == 'event') ? 'active' : ''); ?>">
                    <img class="d-block w-100 position-relative" src="../Event_Creation/img/bg.png" alt="First slide"  style="border-radius:5px ;">
                    <a class="stretched-link" href="../Event_Creation/index.php"></a>
                    </img>
                    <div class="carousel-caption d-none d-md-block">
                        <h2>Event Creation</h2>
                        <p>Create events!</p>
                      </div>
                    </div>
                  <div class="carousel-item <?php echo((($_GET['from']) == 'student') ? 'active' : ''); ?>">
                    <img class="d-block w-100 position-relative" src="./img/bg2.png" alt="Second slide"  style="border-radius:5px ;">
                    <a class="stretched-link" href="../Student_Registration/index.php"></a>
                    </img>
                    <div class="carousel-caption d-none d-md-block">
                        <h2>Student Registration</h2>
                        <p>Register Students!</p>
                    </div>
                  </div>
                  <div class="carousel-item <?php echo((($_GET['from']) == 'attendee') ? 'active' : ''); ?>">
                    <img class="d-block w-100 position-relative" src="./img/bg.png" alt="Third slide"  style="border-radius:5px ;">
                    <a class="stretched-link" href="../Attendee_Registration/index.php"></a>
                    </img>
                    <div class="carousel-caption d-none d-md-block">
                        <h2>Attendee Registration</h2>
                        <p>Registrate Attendees!</p>
                    </div>
                  </div>
                  <div class="carousel-item <?php echo((($_GET['from']) == 'report') ? 'active' : ''); ?>">
                    <img class="d-block w-100 position-relative" src="./img/bg3.png" alt="Fourth slide"  style="border-radius:5px ;">
                    <a class="stretched-link" href="../Report_Generation/index.php"></a>
                    </img>
                    <div class="carousel-caption d-none d-md-block">
                        <h2>Report Generation</h2>
                        <p>Generate Reports!</p>
                    </div>
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
            </div>

        </div>
        </div>
        </div>

      </div>
    </div>
  </div>
              
    </div>
  </div>
</body>
</html>
