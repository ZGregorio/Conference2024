<?php
// Include config file
require_once "../config.php";

// Define variables and initialize with empty values
$first_name = "";
$last_name = "";
$middle_initial = "";
$student_number = "";
$program = "";
$current_year = "";
$ue_email = "";
$contact_number = "";
$first_name_err = "";
$last_name_err = "";
$middle_initial_err = "";
$student_number_err = "";
$program_err = "";
$current_year_err = "";
$ue_email_err = "";
$contact_number_err = "";

$con = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Validate name

    $input_first_name = strtoupper(trim($_POST["first_name"]));
    if (empty($input_first_name)) {
        $first_name_err = "Please enter your first name.";
    } elseif (!filter_var($input_first_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $first_name_err = "Please enter a valid first name.";
    } else {
        $first_name = $input_first_name;
    }

    $input_last_name = strtoupper(trim($_POST["last_name"]));
    if (empty($input_last_name)) {
        $last_name_err = "Please enter your last name.";
    } elseif (!filter_var($input_last_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $last_name_err = "Please enter a valid last name.";
    } else {
        $last_name = $input_last_name;
    }

    $input_middle_initial = strtoupper(trim($_POST["middle_initial"]));
    if (empty($input_middle_initial)){
        $middle_initial = $input_middle_initial;
    } elseif (filter_var($input_middle_initial, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))){
        $middle_initial = $input_middle_initial;
        
    }   else {
        $middle_initial_err = "Please enter a valid middle initial.";
    }   

    //Validate student number
    
    
    $input_student_number = trim($_POST["student_number"]);
    $u = "SELECT student_number FROM student_info WHERE student_number ='$input_student_number'";
    $uu = mysqli_query($con,$u);
    if (empty($input_student_number)) {
        $student_number_err = "Please enter your student number.";
    } elseif (mysqli_num_rows($uu) > 0 ) {
        $student_number_err = "Student number exist.";
    } elseif (True) {
        $student_number = $input_student_number;       
    }else{
        $student_number_err = "Please enter a valid student number.";
    }

    //Validate program
    $program = $_POST["program"];
    if (empty($program)) {
        $program_err = "Please enter your program.";
    } else {
        $program = $program;
    }

    // Validate current year
    $input_current_year = $_POST["current_year"];
    if (empty($input_current_year)){
        $current_year_err = "Please enter your current year.";
    } else {
        $current_year = $input_current_year;
    }


    // Validate ue email
    $input_ue_email = trim($_POST["ue_email"]);
    if (empty($input_ue_email)) {
        $ue_email_err = "Please enter an UE email.";     
    } elseif (preg_match("/\b(ue.edu.ph)\b/i", $input_ue_email)){
        $ue_email = $input_ue_email;
    } else {
        $ue_email_err = "Please enter an UE email.";
    }

    // Validate contact number
    $input_contact_number = trim($_POST["contact_number"]);
    if (empty($input_contact_number)) {
        $contact_number_err = "Please enter your contact number. ";
    } elseif (preg_match('/^[0-9]{11}+$/', $input_contact_number)) {
        $contact_number = $input_contact_number;
    } else {
        $contact_number_err = "Please enter a valid contact number.";
    }

    // Check input errors before inserting in database
    if (empty($first_name_err) && empty($last_name_err) && empty($middle_initial_err) && empty($student_number_err) && empty($program_err) && empty($current_year_err) && empty($ue_email_err) && empty($contact_number_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO student_info (first_name, last_name, middle_initial, student_number, program, current_year, ue_email, contact_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssssssss", $param_first_name, $param_last_name, $param_middle_initial, $param_student_number, $param_program, $param_current_year, $param_ue_email, $param_contact_number);

            // Set parameters
            $param_first_name = $first_name;
            $param_last_name = $last_name;
            $param_middle_initial = $middle_initial;
            $param_student_number = $student_number;
            $param_program = $program;
            $param_current_year = $current_year;
            $param_ue_email = $ue_email;
            $param_contact_number = $contact_number;

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
       // $stmt->close();
    }

    // Close connection
    $mysqli->close();
}
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
    background-image: url("./img/bg2.png");
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
    background-image:url('./img/bg.png');
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
<body>
  <div class="container no-gutters">
    <div class="col-md-6 no-gutters">
      <div class="left-box">
        <a href="index.php"><img src="./img/back.png" style="position: absolute; top: 8px; left: 16px; width:50px;height: 50px;"></a>
        <div class="left">
          <h1>Student Registration</h1>
          <p>Plan, Create, Celebrate: Events Made Easy</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 no-gutters">
      <div class="right-box">
        <div class="right">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <div class="form-group">
                                <label>Last Name</label><br>
                                <input name="last_name" type="text" class="form-control <?php echo (!empty($last_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $last_name; ?>">
                                <span class="invalid-feedback"><?php echo $last_name_err; ?></span>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
                                <label>First Name</label><br>
                                <input name="first_name" type="text" class="form-control <?php echo (!empty($first_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $first_name; ?>">
                                <span class="invalid-feedback"><?php echo $first_name_err; ?></span>
                            </div>
                            <div class="col-md-4">
                                <label>M.I.</label><br>
                                <input name="middle_initial" type="text" class="form-control <?php echo (!empty($middle_initial_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $middle_initial; ?>">
                                <span class="invalid-feedback"><?php echo $middle_initial_err; ?></span>
                            </div>
                        </div>        	
                    </div>  
                    <div class="form-group">
                        <label>Student Number</label><br>
                        <input name="student_number" type="text" class="form-control <?php echo (!empty($student_number_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $student_number; ?>">
                        <span class="invalid-feedback"><?php echo $student_number_err; ?></span>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                              <label>Program</label>
                              <select name="program" name="program" class="form-control <?php echo (!empty($program_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $program; ?>">
                              <span class="invalid-feedback"><?php echo $program_err; ?></span> 
                              <option value="">Select program</option>
                              <option value="CpE">Computer Engineering</option>
                              <option value="ECE">Electrical Engineering</option>
                              <option value="CE">Civil Engineering</option>
                              <option value="ME">Mechanical Engineering</option>
                              <option value="EE">Electronic Engineering</option>
                              </select>
                            </div>
                            <div class="col">
                            <label>Year Level</label>
                        <select name="current_year" name="current_year" class="form-control <?php echo (!empty($current_year_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $current_year; ?>">
                        <span class="invalid-feedback"><?php echo $current_year_err; ?></span>
                            <option value="">Current Year</option>
                            <option value="1st">1st</option>
                            <option value="2nd">2nd</option>
                            <option value="3rd">3rd</option>
                            <option value="4th">4th</option>                       
                        </select>
                            </div>
                        </div>        	
                    </div>  
                    <div class="form-group">
                        <label>Email</label><br>
                        <input name="ue_email" type="email" placeholder ="example@ue.edu.ph" class="form-control <?php echo (!empty($ue_email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ue_email; ?>">
                        <span class="invalid-feedback"><?php echo $ue_email_err; ?></span>
                    </div>
                    <div class="form-group">
                            <label>Contact Number</label>
                            <input type="number" name="contact_number" placeholder="09*********" class="form-control <?php echo (!empty($contact_number_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $contact_number; ?>">
                            <span class="invalid-feedback"><?php echo $contact_number_err; ?></span>  
                        </div>
                        
                    </div>
                    <div class="form-group">
                            <button type="submit" style="background-color: #CC1429; border: #CC1429 solid;" class="btn btn-success btn-lg btn-block">Register</button>
                    </div>
                    </div>
                </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
