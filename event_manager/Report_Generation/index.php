<?php
    require_once "../config.php";

    $search = "";
    $input_search = "";
    $search_err = "";

    if (empty($_GET["search"])) {
    } else {
        $search = $_GET["search"];
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $input_search = trim($_POST["search"]);
        $search = $input_search;
    }

    if (empty($_GET["event_id"])) {
    } else if ($_GET["event_id"] == '1; DROP TABLE') {
        echo "ulol try mo";
    } else {
        $event_id = urldecode($_GET["event_id"]);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Report Generation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }     
      input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
        display: none;
      }
    </style>

</head>
<style>
  @font-face {
        font-family: myFirstFont;
        src: url("../font/Montserrat-VariableFont_wght.ttf");
  }
  body {
    background-image: url("./img/bg1.png");
    background-size: cover;
    height: 100vh;
    font-family: myFirstFont;
    
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
    background: rgba(246, 246, 242, 1);
    justify-content: center; 
    align-items: center; 
    max-height: 85vh;
    max-width: 85vw;
    overflow: scroll;
  }
  .left{
    overflow: scroll;
  }
  .left h1,p{
    font-family: myFirstFont;
  }
  .left-box a{
    top: 8px; 
    left: 16px; 
    width:50px; 
    height: 50px;
    border-radius: 10px 0px 0px 10px; 
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
</style>
</head>
<body>
  <div class="container-fluid h-100 d-flex justify-content-center align-items-center">
    <div class="container">
      <div class="col-md-6 px-0">
        <div class="left-box">
            <form method="post">
                <div class="input-group p-3" style="background-image:url(./img/bg2.png); border-radius: 10px 0px 0px 0px; ">
                    <div class="col-md-2">
                    <a class=" btn-lg position-relative input-group-button" href="../Dashboard/dashboard.php?from=report"><img src="./img/back.png" style="position: absolute; top: 10px; left: 0px; width:50px;height: 50px;"></a>
                    </div>
                    <div class="col-md-10">
                        <div class="input-group p-3">
                    <input type="text" style= "border-radius:3px" name="search" class="form-control <?php echo (!empty($search_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $search?>"/>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                    </div>
                    
                </div>
                <div class="left p-4">
                    <h1 style="text-align:center; color:#013365; padding:10px;border-bottom-style:double;border-bottom-color: black;">Select an Event!</h1>
                    <script>
                        $(document).ready(function() {
                            $('#events').DataTable( {   
                                dom: 'l'
                            } );
                        } );
                    </script>
                    <?php
                        require_once '../config.php';

                        if (!empty($search)) {
                            $event_sql = "SELECT * FROM event_info WHERE event_name LIKE ? OR 
                                                                event_type LIKE ? OR
                                                                venue LIKE ? OR
                                                                oic LIKE ?";
            
                            if ($stmt = $mysqli->prepare($event_sql)) {
                                $stmt->bind_param("ssss", $param_search, $param_search, $param_search, $param_search);
                                $param_search = "%" . $search  . "%";
                                if ($stmt->execute()) {
                                    $event_result = $stmt->get_result();
                                } else {
                                    echo "search failed";
                                }
                            }
                            $stmt->close();
                        } else {
                            $event_sql = "SELECT * FROM event_info";
                            if ($stmt = $mysqli->prepare($event_sql)) {
                                if ($stmt->execute()) {
                                    $event_result = $stmt->get_result();
                                } else {
                                    echo "search failed";
                                }
                            }
                            $stmt->close();
                        }

                        if ($event_result) {
                            if($event_result->num_rows > 0) {
                                echo '<table id="events" class="table table-bordered table-striped table-hover">';
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>Event Name</th>";
                                echo "<th>Date</th>";
                                echo "<th>Attendees</th>";
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while ($rows = $event_result->fetch_array()) {
                                    $attendee_sql = 'SELECT * FROM attendees WHERE event_id ="'.$rows['event_id'].'"';
                                    $attendee_result = $mysqli->query($attendee_sql);
                                    $attendee_count_sql = "SELECT COUNT(DISTINCT (student_number)) FROM attendees WHERE event_id = '".$rows["event_id"]."'";
                                    $attendee_count = $mysqli->query($attendee_count_sql)->fetch_array()[0];
                                    echo "<tr class='position-relative'>";
                                    echo "<td>" . $rows['event_name'] . "<a class='stretched-link' href='index.php?event_id=".$rows['event_id']."&search=".$search."'></a></td>";
                                    echo "<td>" . $rows['date'] . "</td>";
                                    echo "<td>" . $attendee_count  . "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                                echo "</table>";
                                // Free result set
                                $event_result->free();

                            } else {

                            }
                        } else {

                        }
                    ?>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-6 px-0">
        <div class="right-box">
            <div class="right">
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
                        echo '<div class="row mx-4" style="text-align:center; color:#013365; padding:10px;border-bottom-style:double;border-bottom-color: black;">';
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
                        echo "<div class='col'>";
                        echo "<a href='expanded.php?event_id=".$event_id."'><button type='submit' class='btn btn-primary'>Expand</button></a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";

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
                                    echo "<td>" . $mysqli->query("SELECT first_name FROM student_info WHERE student_number='".$attendee_rows['student_number']."'")->fetch_array()["first_name"] . "</td>";
                                    echo "<td>" . $mysqli->query("SELECT last_name FROM student_info WHERE student_number='".$attendee_rows['student_number']."'")->fetch_array()["last_name"] . "</td>";
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
</body>
</html>
