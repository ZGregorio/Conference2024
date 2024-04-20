<?php
    $event_id = "";

    if (!empty($_GET["event_id"])) {
        $event_id = trim($_GET["event_id"]);
    }
?>

<head>
    <meta charset="UTF-8">
    <title>Event number: <?php echo $event_id?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
</head>
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
            height: 75vh;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        }
        .box2{
            background: rgba(246, 246, 242, 1);
            border-radius: 3px;
            height: 75vh;
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
</style>
<body>
    <div class="wrapper my-5">
        <div class="box">
            <div class="search-box">
                <div class = "row" >
                    <div class="col-md-12">
                        <form method="post">
                            <div class="input-group input-group-lg">
                                <a class=" btn-lg position-relative input-group-button" href="index.php?event_id=<?php echo $event_id ?>&search="><img src="./img/back.png" style="position: absolute; top: 0px; left: 0px; width:50px;height: 50px;"></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3" style="box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3); ">
                <script>
                    $(document).ready(function() {
                        $('#report').DataTable( {
                            dom: 'Blfrti',
                            buttons: [
                                'copy', 'csv', 'excel', 'pdf', 'print'
                            ]
                        } );
                    } );
                </script>
                <?php
                    require_once "../config.php";
                    
                    $event_sql = "SELECT * FROM event_info WHERE event_id = ? ";
                    $attendee_sql = "SELECT * FROM attendees WHERE event_id = ? ";
                    $attendee_count_sql = "SELECT COUNT(DISTINCT (student_number)) FROM attendees WHERE event_id = ?";

                    if ($stmt = $mysqli->prepare($event_sql)) {
                        $stmt->bind_param("i", $event_id);  
                        if ($stmt->execute()) {
                            $event_result = $stmt->get_result();
                        }
                    }

                    if ($stmt = $mysqli->prepare($attendee_sql)) {
                        $stmt->bind_param("i", $event_id);  
                        if ($stmt->execute()) {
                            $attendee_result = $stmt->get_result();
                        }
                    }

                    if ($stmt = $mysqli->prepare($attendee_count_sql)) {
                        $stmt->bind_param("i", $event_id);  
                        if ($stmt->execute()) {
                            $attendee_count = $stmt->get_result()->fetch_array()[0];
                        }
                    }

                    $student_sql = "SELECT * FROM student_info";
                    $student_result = $mysqli->query($student_sql);

                    $student_number_array = "";
                    
                    while ($attendee_rows = $attendee_result->fetch_array()) {
                        $student_number_array = $student_number_array . " " . $attendee_rows["student_number"];
                        $payment = $attendee_rows["payment"];
                    }
                    $payment_total = $payment*$attendee_count;
                    $student_number_array = explode(" ", $student_number_array);

                    if ($stmt = $mysqli->prepare($attendee_sql)) {
                        $stmt->bind_param("i", $event_id);  
                        if ($stmt->execute()) {
                            $attendee_result = $stmt->get_result();
                        }
                    }

                    if (($event_result) && ($attendee_result)) {
                        $event_rows = $event_result->fetch_array();
                        if (empty($event_rows['event_id'])) {$event_name = "N/A";} else {$event_name = $event_rows['event_name'];}
                        echo '<div class="row mx-4" style="text-align:center; color:#013365; padding:10px; border-bottom-color: black;">';
                        echo '<div class="container-fluid p-5">';
                        echo "<h5 style='font-weight:bold'>Event Name</h5>";
                        echo "<p>".$event_name."</p>";
                        echo "<div class='row'>";
                        echo "<div class='col'>";
                        echo "<h5 style='font-weight:bold'>Attendant Count</h5>";
                        echo "<p>".$attendee_count."</p>";
                        echo "</div>";
                        echo "<div class='col'>";
                        echo "<h5 style='font-weight:bold'>Payment Total</h5>";
                        echo "<p>".$payment_total."</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";

                    } else {

                    }

                    ?>
                </div>  
                <div class="col-md-9">
                    <div class="container">
                        <div class="container-fluid card-box">
                        <div class="title mt-3">
                            <div class="pb-4">
                                <div class="title">
                                    <?php
                                        require_once "../config.php";
                                        
                                        $event_sql = "SELECT * FROM event_info WHERE event_id = ? ";
                                        $attendee_sql = "SELECT * FROM attendees WHERE event_id = ? ";
                                        $attendee_count_sql = "SELECT COUNT(DISTINCT (student_number)) FROM attendees WHERE event_id = ?";
    
                                        if ($stmt = $mysqli->prepare($event_sql)) {
                                            $stmt->bind_param("i", $event_id);  
                                            if ($stmt->execute()) {
                                                $event_result = $stmt->get_result();
                                            }
                                        }
    
                                        if ($stmt = $mysqli->prepare($attendee_sql)) {
                                            $stmt->bind_param("i", $event_id);  
                                            if ($stmt->execute()) {
                                                $attendee_result = $stmt->get_result();
                                            }
                                        }
    
                                        if ($stmt = $mysqli->prepare($attendee_count_sql)) {
                                            $stmt->bind_param("i", $event_id);  
                                            if ($stmt->execute()) {
                                                $attendee_count = $stmt->get_result()->fetch_array()[0];
                                            }
                                        }
    
                                        $student_sql = "SELECT * FROM student_info";
                                        $student_result = $mysqli->query($student_sql);
    
                                        $student_number_array = "";
                                        
                                        while ($attendee_rows = $attendee_result->fetch_array()) {
                                            $student_number_array = $student_number_array . " " . $attendee_rows["student_number"];
                                        }
                                        $payment_total = $attendee_rows*$attendee_count;
                                        $student_number_array = explode(" ", $student_number_array);
    
                                        if ($stmt = $mysqli->prepare($attendee_sql)) {
                                            $stmt->bind_param("i", $event_id);  
                                            if ($stmt->execute()) {
                                                $attendee_result = $stmt->get_result();
                                            }
                                        }
    
                                        if (($event_result) && ($attendee_result)) {
                                            $event_rows = $event_result->fetch_array();
                                            if (empty($event_rows['event_id'])) {$event_name = "N/A";} else {$event_name = $event_rows['event_name'];}
    
                                            if ($attendee_result) {
                                                if($attendee_result->num_rows > 0) {
                                                    echo '<div class="row">';
                                                    echo '<div class="container-fluid p-5">';
                                                    echo '<table id="report" class="table table-bordered table-striped">';
                                                    echo "<thead>";
                                                    echo "<tr>";
                                                    echo "<th>First Name</th>";
                                                    echo "<th>Last Name</th>";
                                                    echo "<th>Student Number</th>";
                                                    echo "<th>Time In</th>";
                                                    echo "<th>Time Out</th>";
                                                    echo "</tr>";
                                                    echo "</thead>";
                                                    echo "<tbody align='left'>";
                                                    while ($attendee_rows = $attendee_result->fetch_array()) {
                                                        echo "<tr>";
                                                        //Very hacky way, please improve
                                                        echo "<td>" . $mysqli->query("SELECT first_name FROM student_info WHERE student_number ='".$attendee_rows['student_number']."'")->fetch_array()["first_name"] . "</td>";
                                                        echo "<td>" . $mysqli->query("SELECT last_name FROM student_info WHERE student_number ='".$attendee_rows['student_number']."'")->fetch_array()["last_name"] . "</td>";
                                                        echo "<td>" . $attendee_rows['student_number'] . "</td>";
                                                        echo "<td>" . $attendee_rows['time_in'] . "</td>";
                                                        echo "<td>" . $attendee_rows['time_out'] . "</td>";
                                                        echo "</tr>";
                                                    }
                                                    echo "</tbody>";
                                                    echo "</table>";
                                                    echo "</div>";
                                                    echo "</div>";
                                                    // Free result set
                                                    $attendee_result->free();
                            
                                                } else {
                            
                                                }
                                            } else {
                            
                                            }
                                        } else {
    
                                        }
    
                                    ?>
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