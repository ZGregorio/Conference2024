<?php 
    require_once "../config.php";
    $flag = $_GET["flag"];

    $event_name = "";
    $event_description = "";
    $event_type = "";
    $date = "";
    $start_time = "";
    $end_time = "";
    $registration_fee = "";
    $venue = "";
    $oic = "";
    $event_name_err = "";
    $event_description_err = "";
    $event_type_err = "";
    $date_err = "";
    $start_time_err = "";
    $end_time_err = "";
    $registration_fee_err = "";
    $venue_err = "";
    $oic_err = "";

    if (empty($_GET["event_id"])) {
        echo "something went wrong";
    } else if (!is_numeric($_GET["event_id"])) {
        echo "ulol try mo";
    } else {
        $event_id = urldecode($_GET["event_id"]);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['delete']) && !empty($_POST['delete'])) {
            $sql = "DELETE FROM event_info WHERE event_id = ?";
            if ($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param('i',$param_id);

                $param_id = $_POST['id'];
                if ($stmt->execute()) {
                    header("location: index.php");
                }
            }
        }
        if ($flag == "edit") {
            if (isset($_POST['id']) && !empty($_POST['id'])) {
                //Get ID from URL
                $event_id = trim($_POST["id"]);
            
                //Validate event name
                $input_event_name = trim($_POST["event_name"]);
                if (empty($input_event_name)) {
                    $event_name_err = "Please enter a name.";
                } else {
                    $event_name = $input_event_name;
                }
                //Validate event description
                $input_event_description = trim($_POST["event_description"]);
                if (empty($input_event_description)) {
                    $event_description_err = "Please enter a event_description.";
                } else {
                    $event_description = $input_event_description;
                }
                //Validate event type
                $input_event_type = trim($_POST["event_type"]);
                if (empty($input_event_type)) {
                    $event_type_err = "Please enter a event_type.";
                } else {
                    $event_type = $input_event_type;
                }
            
                //Validate event date
                $input_date = trim($_POST["date"]);
                if (empty($input_date)) {
                    $date_err = "Please enter a valid event date";
                } else {
                    $date = $input_date;
                }
            
                //Validate start_time.
                $input_start_time = trim($_POST["start_time"]);
                if (empty($input_start_time)) {
                    $start_time_err = "Please enter a start_time.";
                } else {
                    $start_time = $input_start_time;
                }
            
                // Validate end time.
                $input_end_time = trim($_POST["end_time"]);
                if (empty($input_end_time)) {
                    $end_time_err = "Please enter the end_time amount.";
                } else {
                    $end_time = $input_end_time;
                }
            
                // Validate registration fee.
                $input_registration_fee = trim($_POST["registration_fee"]);
                if (empty($input_registration_fee)) {
                    $registration_fee_err = "Please enter an registration_fee.";
                } else {
                    $registration_fee = $input_registration_fee;
                }
            
                // Validate venue.
                $input_venue = trim($_POST["venue"]);
                if (empty($input_venue)) {
                    $venue_err = "Please enter the venue amount.";
                } else {
                    $venue = $input_venue;
                }
            
                // Validate oic.
                $input_oic = trim($_POST["oic"]);
                if (empty($input_oic)) {
                    $oic_err = "Please enter an oic.";
                } else {
                    $oic = $input_oic;
                }
            
                // Check input errors before inserting in database
                if (empty($event_name_err) && empty($event_description_err) && empty($event_type_err) && empty($date_err) && empty($start_time_err) && empty($end_time_err) && empty($registration_fee_err) && empty($venue_err) && empty($oic_err)) {
                    // Prepare an insert statement
                    $sql = "UPDATE event_info SET event_name=?, event_description=?, event_type=?, date=?, start_time=?, end_time=?, registration_fee=?, venue=?, oic=? WHERE event_id=?";
            
                    if ($stmt = $mysqli->prepare($sql)) {
                        // Bind variables to the prepared statement as parameters
                        $stmt->bind_param("sssssssssi", $param_event_name, $param_event_description, $param_event_type, $param_date, $param_start_time, $param_end_time, $param_registration_fee, $param_venue, $param_oic, $param_event_id);
            
                        // Set parameters
                        $param_event_name = $event_name;
                        $param_event_description = $event_description;
                        $param_event_type = $event_type;
                        $param_date = $date;
                        $param_start_time = $start_time;
                        $param_end_time = $end_time;
                        $param_registration_fee = $registration_fee;
                        $param_venue = $venue;
                        $param_oic = $oic;
                        $param_event_id = $event_id;
            
                        // Attempt to execute the prepared statement
                        if ($stmt->execute()) {
                            // Records created successfully. Redirect to landing page
                            header("location: view.php?event_id=".$event_id."&flag=view");
                            exit();
                        } else {
                            echo "Oops! Something went wrong. Please try again later.";
                            header("location: error.php?asdas");
                        }
                    }
                    // Close statement
                    echo "nigga";
                    $stmt->close();
                }
                // Close connection
                echo "bruh";
                $mysqli->close();
            } else {
                
                echo "id";
                // put error here
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Event list</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper {
            width: 900px;
            margin: 0 auto;
        }
        @font-face {
        font-family: myFirstFont;
        src: url("../font/Montserrat-VariableFont_wght.ttf");
        }
        body {
            background-image: url("./img/bg1.png");
            background-size: cover;
            height:100vh;
        }
        .container{
            display: flex;
            margin: auto;
            padding: 40px 0;
        }
        .left-box{
            width: 100%;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3); 
            border-radius: 10px 0px 0px 10px; 
            height: 100%;
            background-size:cover ;
            background-image:url('./img/bg2.png');
            justify-content: center; 
            align-items: center; 
            max-height: 85vh;
            max-width: 85vw;
        }
        .left{
            text-align: center;
            padding: 200px 0;
        }
        .left h1,p{
            font-family: myFirstFont;
            color: white;
        }
        .left-box a{
            position: absolute; 
            top: 8px; 
            left: 16px; 
            width:50px; 
            height: 50px;
        }
        .left h1{
            font-weight:bold;
        }
        .right-box{
            width: 100%;
            height: 100%;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3); 
            border-radius: 0px 10px 10px 0px; 
            background: rgba(246, 246, 242, 1);
            justify-content: center; 
            align-items: center; 
            margin: 0;
            max-height: 85vh;
            max-width: 85vw;
            overflow: scroll;
        }
        .right{
            padding: 50px;
            line-height: 1.8;
            margin: 0 auto;
            text-align: center;
            
        }
        .right label{
            font-weight: bold;
        }
        .right input, .right select, .right textarea{
            width: 100%; 
            padding:5px; 
            padding-left:5px; 
            border-radius: 5px; 
            border: 1px solid black
        }
        .right form{
            color: black;
            border-radius: 3px;
            margin-bottom: 15px;
            background: rgba(246, 246, 242, 1);
            width: 100%;
            line-height: 1.8; 
        }
        .right .btn{
            background-color: #013365; 
            border: #013365 solid;
            font-family: myFirstFont;
            font-weight: bold;
            outline: none !important;
        }
        .left img{
            
        }
        ::-webkit-scrollbar{
            display: none}
        body {
            background-image: url("./img/bg1.png");
            background-size: cover;
        }
        .container{
            display: flex;
            margin: auto;
            padding: 40px 0;
        }
        .left-box{
            width: 100%;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3); 
            border-radius: 10px 0px 0px 10px; 
            height: 100%;
            background-size:cover ;
            background-image:url('./img/bg3.png');
            justify-content: center; 
            align-items: center; 
            max-height: 85vh;
            max-width: 85vw;
        }
        .left{
            text-align: center;
            padding: 200px 0;
        }
        .left h1,p{
            font-family: myFirstFont;
            color: white;
        }
        .left-box a{
            position: absolute; 
            top: 8px; 
            left: 16px; 
            width:50px; 
            height: 50px;
        }
        .left h1{
            font-weight:bold;
        }
        .right-box{
            width: 100%;
            height: 100%;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3); 
            border-radius: 0px 10px 10px 0px; 
            background: rgba(246, 246, 242, 1);
            justify-content: center; 
            align-items: center; 
            margin: 0;
            max-height: 85vh;
            max-width: 85vw;
            overflow: scroll;
        }
        .right{
            padding: 50px;
            line-height: 1.8;
            margin: 0 auto;
            text-align: center;
            
        }
        .right label{
            font-weight: bold;
        }
        .right input, .right select, .right textarea{
            width: 100%; 
            padding:5px; 
            padding-left:5px; 
            border-radius: 5px; 
            border: 1px solid black
        }
        .right form{
            color: black;
            border-radius: 3px;
            margin-bottom: 15px;
            background: rgba(246, 246, 242, 1);
            width: 100%;
            line-height: 1.8; 
        }
        .right .btn{
            background-color: #013365; 
            border: #013365 solid;
            font-family: myFirstFont;
            font-weight: bold;
            outline: none !important;
        }
        .left img{
            
        }
        ::-webkit-scrollbar{
            display: none;
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
        .edit{
            right:33px;
        }

        .rounded-circle{
            height: 10vw;
            width: 10vw;
            position: absolute;
            bottom:33px;
            box-shadow: 8px 8px 15px rgba(0,0,0,0.3);
            
        }
        .del{
            left:33px;
            
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
            border-radius: 10px 10px 0px 0px;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        }
        .box1{
            background: rgba(246, 246, 242, 1);
            border-radius: 3px;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        }
        .card-box{
            height: 25vh;
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
            height:45vh;
        }
        .search-box h1{
            font-family:myFirstFont;
            text-align:center;
            font-weight:bold;
        }
        .search-box p{
            font-family:myFirstFont;
            text-align:center;
        }
        ::-webkit-scrollbar{
            display: none;
        }
        .title{
            font-family:myFirstFont;
            text-align: center;
        }
        .title label{
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
    <div class="wrapper">
        <div class="container-fluid d-flex justify-content-center align-items-center">
            <div class="modal fade" id="Delete" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="DeleteLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="Delete">Are you sure?</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this entry?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                            <?php
                            echo '<form method="post">';
                            echo '<button type="submit" class="btn btn-danger">Yes</button>';
                            echo '<input type="hidden" name="id" value="'.$event_id.'">';
                            echo '<input type="hidden" name="delete" value="YES">';
                            echo '</form>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                require_once "../config.php";

                $sql = "SELECT * FROM event_info WHERE event_id = ? ";
                if ($stmt = $mysqli->prepare($sql)) {
                    $stmt->bind_param("i", $event_id);  
                    if ($stmt->execute()) {
                        $result = $stmt->get_result();
                    }
                }

                if ($result) {
                    if ($result->num_rows > 0) {
                        $rows = $result->fetch_array();
                        if ($flag == "edit") {
                            
                            echo '<div class="container no-gutters">';
                            echo '<div class="col-md-6 no-gutters">';
                            echo '<div class="left-box">';
                            echo '<a href="view.php?event_id='.$event_id.'&flag=view"><img src="./img/back2.png" style="position: absolute; top: 8px; left: 16px; width:50px;height: 50px;"></a>';
                            echo '<div class="left">';
                            echo '<h1>Edit Event</h1>';
                            echo '<p>Plan, Create, Celebrate: Events Made Easy</p>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '<div class="col-md-6 no-gutters">';
                            echo '<div class="right-box">';
                            echo '<div class="right">';
                            echo '<form method="post">';

                            echo '<div class="form-group">';
                            echo "<label>Event Name</label>";
                            $placeholder = $rows['event_name'];
                            $is_invalid = (!empty($event_name_err)) ? "is-invalid" : "";
                            echo '<input type="text" name="event_name" class="form-control'.$is_invalid.'" value="'.$placeholder.'">';
                            echo '</div>';

                            echo '<div class="form-group">';
                            echo "<label>Event Description</label>";
                            $is_invalid = (!empty($event_description_err)) ? "is-invalid" : "";
                            echo '<textarea type="text" name="event_description" class="form-control'.$is_invalid.'" value="'.$placeholder.'">'.$rows['event_description'].'</textarea>';
                            echo '</div>';
                            
                            echo '<div class="form-group">';
                            echo '<div class="row">';
                            echo '<div class="col">';
                            echo "<label>Event Type</label>";
                            $placeholder = $rows['event_type'];
                            $is_invalid = (!empty($event_type_err)) ? "is-invalid" : "";
                            echo '<select name="event_type" class="form-control '.$is_invalid.'" value='.$event_type.'required="required">';
                            $option1 = '<option value="Other">Other</option>';
                            $option2 = '<option value="Meetup">Meetup</option>';
                            $option3 = '<option value="Seminar">Seminar</option>';
                            $option4 = '<option value="Sports">Sports</option>';
                            $option5 = '<option value="Convention">Convention</option>';
                            $option_list = array($option1, $option2, $option3, $option4, $option5);

                            switch ($placeholder) {
                                case "Other":
                                    $i = 0;
                                    break;
                                case "Meetup":
                                    $i = 1;
                                    break;
                                case "Seminar":
                                    $i = 2;
                                    break;
                                case "Sports":
                                    $i = 3;
                                    break;
                                case "Convention":
                                    $i = 4;
                                    break;
                            }

                            $j = count($option_list);
                            while($j > 0) {
                                echo $option_list[$i];
                                if ($i == 4) {
                                    $i = 0;
                                } else {
                                    $i += 1;
                                }
                                $j -=1;
                            }
                            echo '</select>';
                            echo '</div>';

                            echo '<div class="col">';
                            echo "<label>Date</label>";
                            $placeholder = $rows['date'];
                            $is_invalid = (!empty($date_err)) ? "is-invalid" : "";
                            echo '<input type="date" name="date" class="form-control'.$is_invalid.'" value="'.$placeholder.'">';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';

                            echo '<div class="form-group">';
                            echo '<div class="row">';
                            echo '<div class="col">';
                            echo "<label>Start Time</label>";
                            $placeholder = $rows['start_time'];
                            $is_invalid = (!empty($start_time_err)) ? "is-invalid" : "";
                            echo '<input type="time" name="start_time" class="form-control'.$is_invalid.'" value="'.$placeholder.'">';
                            echo '</div>';

                            echo '<div class="col">';
                            echo "<label>End Time</label>";
                            $placeholder = $rows['end_time'];
                            $is_invalid = (!empty($end_time_err)) ? "is-invalid" : "";
                            echo '<input type="time" name="end_time" class="form-control'.$is_invalid.'" value="'.$placeholder.'">';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';

                            echo '<div class="form-group">';
                            echo "<label>Registration Fee</label>";
                            $placeholder = $rows['registration_fee'];
                            $is_invalid = (!empty($registration_fee_err)) ? "is-invalid" : "";
                            echo '<input type="text" name="registration_fee" class="form-control'.$is_invalid.'" value="'.$placeholder.'">';
                            echo '</div>';

                            echo '<div class="form-group">';
                            echo "<label>Venue</label>";
                            $placeholder = $rows['venue'];
                            $is_invalid = (!empty($venue_err)) ? "is-invalid" : "";
                            echo '<input type="text" name="venue" class="form-control'.$is_invalid.'" value="'.$placeholder.'">';
                            echo '</div>';

                            echo '<div class="form-group">';
                            echo "<label>Officer-In-Charge</label>";
                            $placeholder = $rows['oic'];
                            $is_invalid = (!empty($oic_err)) ? "is-invalid" : "";
                            echo '<input type="text" name="oic" class="form-control'.$is_invalid.'" value="'.$placeholder.'">';
                            echo '</div>';

                            echo '<input type="hidden" name="id" value="'.$event_id.'">';
                            echo '<input type="submit" class="btn btn-primary" value="Submit">';
                            echo '</form>';
                        } else {
                            echo '<div class="wrapper my-5">';
                            
                            echo '<div class="box">';
                            echo '<div class="search-box" style="background-image: url(./img/'.$rows["event_type"].'.png); background-size: cover; border-radius: 10px 10px 0px 0px;">';
                            echo '<div class = "row" >';
                            echo '<div class="col-md-12">';
                            echo '<a class=" btn-lg position-relative input-group-button" href="../Event_Creation/index.php"><img src="./img/back.png" style="position: absolute; top: 0px; left: 0px; width:50px;height: 50px;"></a>';
                            
                            echo "<h1>".$rows['event_name']."</h1>";
                            echo "<p class='fst-italic'>".$rows['event_type']."</p>";
                            echo "<p class='mt-5'>".$rows['event_description']."</p>";
                            
                            echo '<form method="post">';
                            echo '<div class="input-group input-group-lg">';
                            
                            echo '<div class="input-group-append">';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '<div class="box1 pt-3">';
                            echo '<div class="container">';
                            echo '<div class="container-fluid card-box">';
                            echo '<div class="title">';
                            echo '</div>';

                            // echo '<a href="index.php"><button class="btn btn-danger">Back</button></a>';
                            // echo '<a href="view.php?event_id='.$event_id.'&flag=edit" class="btn btn-secondary ml-2">Edit</a>';
                            
                            echo '<div class="title">';
                            echo '<div class="row">';
                            echo '<div class="col">';
                            echo "<label>Date</label>";
                            echo "<p>".$rows['date']."</p>";
                            echo "<label>Venue</label>";
                            echo "<p>".$rows['venue']."</p>";
                            echo '</div>';
                            

                            echo '<div class="col">';
                            echo "<label>Start Time</label>";
                            echo "<p>".$rows['start_time']."</p>";
                            echo "<label>End Time</label>";
                            echo "<p>".$rows['end_time']."</p>";
                            echo '</div>';

                            echo '<div class="col">';
                            echo "<label>Registration Fee</label>";
                            echo "<p>".$rows['registration_fee']."</p>";
                            echo "<label>Officer-In-Charge</label>";
                            echo "<p>".$rows['oic']."</p>";
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';

                            echo '<footer class="footer mt-auto py-3 fixed-bottom">';
                            echo '<div class="rounded-circle edit bg-primary d-flex justify-content-center align-items-center">';
                            echo '<a class="stretched-link" href="view.php?event_id='.$event_id.'&flag=edit"> <img src="./img/edit.png" class="center"></a>';
                            echo '</div>';
                            echo '<div class="rounded-circle del bg-primary d-flex justify-content-center align-items-center">';
                            echo '<a class="btn" data-toggle="modal" data-target="#Delete"><img src="./img/delete.png" class="center"></a>';
                            echo '</footer>';
                        }
                    }
                }
            ?>
        </div>
        </div>
    </div>
</body>

</html>
