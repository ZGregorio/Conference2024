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

if (empty($_GET["id"])) {
  echo "something went wrong";
} else if (!is_numeric($_GET["id"])) {
  echo "ulol try mo";
} else {
  $id = urldecode($_GET["id"]);
}

// Processing form data when form is submitted
if (isset($_POST['delete']) && !empty($_POST['delete'])) {
            $sql = "DELETE FROM student_info WHERE id = ?";
            if ($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param('i',$param_id);

                $param_id = $_POST['id'];
                if ($stmt->execute()) {
                    header("location: index.php");
                }
            }
        }
if (isset($_POST['id']) && !empty($_POST['id'])) {
    //Get ID from URL
    $id = trim($_POST["id"]);
    //Validate name
    $input_first_name = trim($_POST["first_name"]);
    if (empty($input_first_name)) {
        $first_name_err = "Please enter a name.";
    } elseif (!filter_var($input_first_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $first_name_err = "Please enter a valid name.";
    } else {
        $first_name = $input_first_name;
    }

    $input_last_name = trim($_POST["last_name"]);
    if (empty($input_last_name)) {
        $last_name_err = "Please enter a last_name.";
    } elseif (!filter_var($input_last_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $last_name_err = "Please enter a valid last_name.";
    } else {
        $last_name = $input_last_name;
    }

    $input_middle_initial = trim($_POST["middle_initial"]);
    if (!filter_var($input_middle_initial, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))){
        $middle_initial_err = "Please enter a valid middle_initial.";
    } else {
        $middle_initial = $input_middle_initial;
    }   

    //Validate student number
    $input_student_number = trim($_POST["student_number"]);
    if (empty($input_student_number)) {
        $student_number_err = "Please enter the student_number amount.";
    } else {
        $student_number = $input_student_number;
    }

    //Validate program
    $program = $_POST["program"];
    if (empty($program)) {
        $program_err = "Please enter your program.";
    } else {
        $program = $program;
    }

    // Validate current year
    $current_year = $_POST["current_year"];
    if (empty($current_year)){
        $current_year_err = "Please enter your current year.";
    } else {
        $current_year = $current_year;
    }


    // Validate ue email
    $input_ue_email = trim($_POST["ue_email"]);
    if (empty($input_ue_email)) {
        $ue_email_err = "Please enter an UE email.";
    } else {
        $ue_email = $input_ue_email;
    }

    // Validate contact number
    $input_contact_number = trim($_POST["contact_number"]);
    if (empty($input_contact_number)) {
        $contact_number_err = "Please enter your contact number. ";
    } elseif (!ctype_digit($input_contact_number)) {
        $contact_number_err = "Please enter a positive integer value.";
    } else {
        $contact_number = $input_contact_number;
    }

    // Check input errors before inserting in database
    if (empty($first_name_err) && empty($last_name_err) && empty($student_number_err) && empty($program_err) && empty($current_year_err) && empty($ue_email_err) && empty($contact_number_err)) {
        // Prepare an insert statement
        $sql = "UPDATE student_info SET first_name=?, last_name=?, middle_initial=?, student_number=?, program=?, current_year=?, ue_email=?, contact_number=? WHERE id =?";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssssssssi", $param_first_name, $param_last_name, $param_middle_initial, $param_student_number, $param_program, $param_current_year, $param_ue_email, $param_contact_number, $param_id );

            // Set parameters
            $param_id=$id;
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
        //$stmt->close();
    }

    // Close connection
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<?php
                    //throw user to error page if id isnt in url
            empty($_GET["id"]) ? header("location: error.php") : "";
        ?>

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
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
  .rounded-circle{
    height: 10vw;
    width: 10vw;
    position: absolute;
    bottom:33px;
    box-shadow: 8px 8px 15px rgba(0,0,0,0.3)
  }
  .center{
    border-radius:100px;
    width:100%;
    height:100%;
  }
  ::-webkit-scrollbar{
    display: none;
  }
  .del{
    left:33px;
  }
</style>

<body>
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
                echo '<form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'?id='.$id.'&flag=edit" method="post">';
                echo '<button type="submit" class="btn btn-danger">Yes</button>';
                echo '<input type="hidden" name="id" value="'.$id.'">';
                echo '<input type="hidden" name="delete" value="YES">';
                echo '</form>';
                ?>
            </div>
        </div>
    </div>
</div>


  <div class="container no-gutters">
    <div class="col-md-6 no-gutters">
      <div class="left-box">
        <a href="index.php"><img src="./img/back.png" style="position: absolute; top: 8px; left: 16px; width:50px;height: 50px;"></a>
        <div class="left">
          <h1>Student Edit</h1>
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
                                <?php
                                $id = $_GET['id'];
                                $sql = "SELECT * FROM student_info WHERE id = $id";
                                $result = $mysqli->query($sql);
                                $result = $result->fetch_array();
                                $placeholder = $result['last_name'];
                                $is_invalid = (!empty($last_name_err)) ? "is-invalid" : "";
                                echo '<input type="text" name="last_name" class="form-control'.$is_invalid.'" value="'.$placeholder.'">';
                                
                            ?>
                            <span class="invalid-feedback"><?php echo $last_name_err; ?></span>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
                                <label>First Name</label><br>
                                <?php
                            // i put this in every text field
                            // it gets the value of the element to edit
                            // every text field makes a database query
                                $id = $_GET['id'];
                                $sql = "SELECT * FROM student_info WHERE id = $id";
                                $result = $mysqli->query($sql);
                                $result = $result->fetch_array();
                                $placeholder = $result['first_name'];
                                $is_invalid = (!empty($first_name_err)) ? "is-invalid" : "";
                                echo '<input type="text" name="first_name" class="form-control'.$is_invalid.'" value="'.$placeholder.'">';
                            ?>
                            <span class="invalid-feedback"><?php echo $first_name_err; ?></span>
                            </div>
                            <div class="col-md-4">
                                <label>M.I.</label><br>
                                <?php
                                $id = $_GET['id'];
                                $sql = "SELECT * FROM student_info WHERE id = $id";
                                $result = $mysqli->query($sql);
                                $result = $result->fetch_array();
                                $placeholder = $result['middle_initial'];
                                echo '<input type="text" name="middle_initial" class="form-control" value="'.$placeholder.'">';
                            ?>
                            <span class="invalid-feedback"><?php echo $middle_initial_err; ?></span>
                            </div>
                        </div>        	
                    </div>  
                    <div class="form-group">
                        <label>Student Number</label><br>
                        <?php
                                $id = $_GET['id'];
                                $sql = "SELECT * FROM student_info WHERE id = $id";
                                $result = $mysqli->query($sql);
                                $result = $result->fetch_array();
                                $placeholder = $result['student_number'];
                                $is_invalid = (!empty($student_number_err)) ? "is-invalid" : "";
                                echo '<input type="text" name="student_number" class="form-control'.$is_invalid.'" value="'.$placeholder.'">';
                            ?>
                            <span class="invalid-feedback"><?php echo $student_number_err; ?> </span>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                              <label>Program</label>
                              <?php
                                $id = $_GET['id'];
                                $sql = "SELECT * FROM student_info WHERE id = $id";
                                $result = $mysqli->query($sql);
                                $result = $result->fetch_array();
                                $placeholder = $result['program'];
                                $is_invalid = (!empty($program_err)) ? "is-invalid" : "";
                                echo '<select type ="text" name = "program" class="form-control'.$is_invalid.'" value"'.$placeholder.'"
                                <option value="">Select program</option>
                                <option value="CpE">Computer Engineering</option>
                                <option value="ECE">Electrical Engineering</option>
                                <option value="CE">Civil Engineering</option>
                                <option value="ME">Mechanical Engineering</option>
                                <option value="EE">Electronic Engineering</option>
                                    </select>';
                            ?>
                            <span class="invalid-feedback"><?php echo $program_err; ?></span>
                            </div>
                            <div class="col">
                            <label>Year Level</label>
                            <?php
                                $id = $_GET['id'];
                                $sql = "SELECT * FROM student_info WHERE id = $id";
                                $result = $mysqli->query($sql);
                                $result = $result->fetch_array();
                                $placeholder = $result['current_year'];
                                $is_invalid = (!empty($current_year_err)) ? "is-invalid" : "";
                                echo '<select type ="text" name="current_year" class="form-control'.$is_invalid.'" value"'.$placeholder.'"
                                <option value="">Current Year</option>
                                <option value="1st">1st</option>
                                <option value="2nd">2nd</option>
                                <option value="3rd">3rd</option>
                                <option value="4th">4th</option>
                                
                                    </select>';
                            ?>
                            </div>
                        </div>        	
                    </div>  
                    <div class="form-group">
                        <label>Email</label><br>
                        <?php
                                $id = $_GET['id'];
                                $sql = "SELECT * FROM student_info WHERE id = $id";
                                $result = $mysqli->query($sql);
                                $result = $result->fetch_array();
                                $placeholder = $result['ue_email'];
                                $is_invalid = (!empty($ue_email_err)) ? "is-invalid" : "";
                                echo '<input type="email" name="ue_email" class="form-control'.$is_invalid.'" value="'.$placeholder.'">';
                            ?>
                            <span class="invalid-feedback"><?php echo $ue_email_err; ?></span>
                    </div>
                    <div class="form-group">
                            <label>Contact Number</label>
                            <?php
                                $id = $_GET['id'];
                                $sql = "SELECT * FROM student_info WHERE id = $id";
                                $result = $mysqli->query($sql);
                                $result = $result->fetch_array();
                                $placeholder = $result['contact_number'];
                                $is_invalid = (!empty($contact_number_err)) ? "is-invalid" : "";
                                echo '<input type="number" name="contact_number" class="form-control'.$is_invalid.'" value="'.$placeholder.'">';
                            ?>
                            <span class="invalid-feedback"><?php echo $contact_number_err; ?></span>
                        </div>
                        
                        <input type="hidden" name="id" value="<?php echo trim($_GET["id"])?>">
                        </div>
                        <input type="submit"  style="background-color: #CC1429; border: #CC1429 solid;" class="btn btn-primary" value="Submit">
                        
                    </form>
                    <footer class="footer mt-auto py-3 fixed-bottom">
                      <div class="rounded-circle del d-flex justify-content-center align-items-center">
                      <a href="#" data-toggle="modal" data-target="#Delete"><img src="./img/delete.png" class="center"></a>
                    </footer>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>     
