<?php
// Include config file
require_once "../config.php";

// Define variables and initialize with empty values
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

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        $sql = "INSERT INTO event_info (event_name, event_description, event_type, date, start_time, end_time, registration_fee, venue, oic) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssssssss", $param_event_name, $param_event_description, $param_event_type, $param_date, $param_start_time, $param_end_time, $param_registration_fee, $param_venue, $param_oic);

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

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        $stmt->close();
        echo $stmt."close";
    }

    // Close connection
    echo "$mysqli close";
    $mysqli->close();
}
// END OF PHP PART
// START OF HTML PART
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
    background-image: url("./img/bg.png");
    background-size: cover;
    height: 100vh;
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
</style>
</head>
<body>
  <div class="container-fluid h-100 d-flex justify-content-center align-items-center">
    <div class="container">
      <div class="col-md-6 px-0">
        <div class="left-box">
          <a href="index.php"><img src="./img/back.png" style="position: absolute; top: 8px; left: 16px; width:50px;height: 50px;"></a>
          <div class="left">
            <h1>Register Event</h1>
            <p>Plan, Create, Celebrate: Events Made Easy</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 px-0">
        <div class="right-box">
          <div class="right">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              <div class="form-group">
                  <div class="form-group">
                      <label>Event Name</label><br>
                      <input type="text" class="form-control <?php echo (!empty($event_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $event_name; ?>" name="event_name" required="required">
                      <span class="invalid-feedback"><?php echo $event_name_err; ?></span>
                  </div>
                  <div class="form-group">
                      <label>Event Description</label><br>
                      <textarea type="text" class="form-control <?php echo (!empty($event_description_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $event_description; ?>" name="event_description" required="required"></textarea>
                      <span class="invalid-feedback"><?php echo $event_description_err; ?></span>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col">
                        <label>Event Type</label>
                        <select name="event_type" class="form-control <?php echo (!empty($event_type_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $event_type; ?>" required="required">
                        <span class="invalid-feedback"><?php echo $event_type_err; ?></span>
                            <option value="Other">Other</option>
                            <option value="Meetup">Meetup</option>
                            <option value="Seminar">Seminar</option>
                            <option value="Sports">Sports</option>
                            <option value="Convention">Convention</option>
                        </select>
                    </div>
                        <div class="col">
                          <label>Event Date</label><br>
                          <input type="date" class="form-control <?php echo (!empty($date_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $date; ?>" name="date" required="required">
                          <span class="invalid-feedback"><?php echo $date_err; ?></span>
                      </div>
                    </div>        	
                  </div>  
                  <div class="form-group">
                      <div class="row">
                          <div class="col">
                              <label>Start Time</label><br>
                              <input type="time" class="form-control <?php echo (!empty($start_time_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $start_time; ?>" name="start_time" required="required">
                              <span class="invalid-feedback"><?php echo $start_time_err; ?></span>
                          </div>
                          <div class="col">
                              <label>End Time</label><br>
                              <input type="time" class="form-control <?php echo (!empty($end_time_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $end_time; ?>" name="end_time" required="required">
                              <span class="invalid-feedback"><?php echo $end_time_err; ?></span>
                          </div>
                      </div>        	
                  </div>  
                  </div>
                  <div class="form-group">
                    <label>Registration Fee</label><br>
                    <input type="number" class="form-control <?php echo (!empty($registration_fee_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $registration_fee; ?>" name="registration_fee" required="required">
                    <span class="invalid-feedback"><?php echo $registration_fee_err; ?></span>
                  </div>
                  <div class="form-group">
                    <label>Venue</label><br>
                    <input type="text" class="form-control <?php echo (!empty($venue_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $venue; ?>" name="venue" required="required">
                    <span class="invalid-feedback"><?php echo $venue_err; ?></span>
                  </div>
                  <div class="form-group">
                    <label>Officer in Charge</label><br>
                    <input type="text" class="form-control <?php echo (!empty($oic_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $oic; ?>"name="oic" required="required">
                    <span class="invalid-feedback"><?php echo $oic_err; ?></span>
                  </div>
                  <div class="form-group">
                          <button type="submit" class="btn btn-success btn-lg btn-block">Register</button>
                  </div>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
