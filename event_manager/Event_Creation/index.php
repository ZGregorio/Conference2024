<?php
    require_once "../config.php";

    $search = "";
    $input_search = "";
    $search_err = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once '../config.php';

        $input_search = trim($_POST["search"]);
        $search = $input_search;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Event list</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        @font-face {
        font-family: myFirstFont;
        src: url("../font/Montserrat-VariableFont_wght.ttf");
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

        .card-img-overlay > h5 {
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

        .btn-primary {

        }

        body {
            font-family: myFirstFont;
            height: 100%;
            overflow-y: hidden;
            background-image: url("./img/bg.png");
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
            border-radius: 3px;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            margin-top:20px;
        }
        .box1{
            background: rgba(246, 246, 242, 1);
            border-radius: 3px;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        }
        .card-box{
            overflow:auto;
            height: 68vh;
            padding:20px;
        }
        .container{
            width: 100%;
            height: 100%;
        }
        .search-box{
            padding: 20px;
            border-bottom-style:double;
            border-bottom-color: white;
            background-image: url("./img/bg3.png");
            background-size:cover;
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
    </style>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>
    <div class="wrapper my-5">
        <div class="box">
            <div class="search-box">
                <div class = "row" >
                    <div class="col-md-12">
                        <form method="post">
                            <div class="input-group input-group-lg">
                                <a class=" btn-lg position-relative input-group-button" href="../Dashboard/dashboard.php?from=event"><img src="./img/back.png" style="position: absolute; top: 0px; left: 0px; width:50px;height: 50px;"></a>
                                
                                <input type="text" style= "border-radius:3px" name="search" class="form-control <?php echo (!empty($search_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $search?>"/>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="box1 pt-3">
                <div class="container">
                    <div class="container-fluid card-box">
                    <div class="title mt-3">
                        <div style="border-bottom-style: double;" class="pb-4">
                            <div class="title">
                                <h1 class="mt-2 font-weight-bold">Edit an Event or Create one!</h1>
                            </div>
                        </div>
                    </div>
                    <?php
                        if (!empty($search)) {
                            $sql = "SELECT * FROM event_info WHERE event_name LIKE ? OR 
                                                                event_type LIKE ? OR
                                                                venue LIKE ? OR
                                                                oic LIKE ?";

                            if ($stmt = $mysqli->prepare($sql)) {
                                $stmt->bind_param("ssss", $param_search, $param_search, $param_search, $param_search);
                                $param_search = "%" . $search  . "%";
                                if ($stmt->execute()) {
                                    $result = $stmt->get_result();
                                } else {
                                    echo "search failed";
                                }
                            }
                            $stmt->close();
                        } else {
                            $sql = "SELECT * FROM event_info";
                            if ($stmt = $mysqli->prepare($sql)) {
                                if ($stmt->execute()) {
                                    $result = $stmt->get_result();
                                } else {
                                    echo "search failed";
                                }
                            }
                            $stmt->close();
                        }

                        if (!empty($result)) {
                            if ($result->num_rows > 0) {
                                echo "<div class='row row-cols-1 row-cols-md-3 g-4 mt-5'>";
                                while ($rows = $result->fetch_array()) {
                                    echo "<div class='col mt-5 px-4'>";
                                    echo "<div class='card h-100 position-relative'>";
                                    echo '<img class="card-img-top" src="./img/'.$rows['event_type'].'.png" alt="'.$rows['event_type'].'">'; 
                                    echo '<div class="card-img-overlay">';
                                    echo "<h5 class='card-title'>".$rows['event_name']."</h5>";                
                                    echo '<p class="card-text">'.$rows['event_type'].'</p>';
                        
                                    echo '</div>';
                                    echo "<div class='card-body'>";         
                                    echo "<a class='stretched-link' href='view.php?event_id=".urlencode($rows['event_id'])."&flag=view'></a>";
                                    echo "<p class='card-text'>".$rows['event_description']."</p>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                            } else {
                                //error message here if $result doesnt have rows
                                echo 'No results for "'.$search.'"';
                            }
                        } else {
                            // error message here if we didnt get a $result
                            echo "no results found";
                        }
                        ?>
                    </div>
                    <footer class="footer mt-auto py-3 fixed-bottom">
                        <div class="rounded-circle bg-primary d-flex justify-content-center align-items-center">
                            <a class="stretched-link" href="create.php"> <img src="./img/create.png" class="center"></a>
                            </a>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
</body>
