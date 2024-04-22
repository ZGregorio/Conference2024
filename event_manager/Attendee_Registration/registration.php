<?php
    require_once "../config.php";

    $student_number = "";
    $input_student_number = "";
    $student_number_err = "";
    $first_name = "";
    $last_name = "";
    $middle_initial = "";
    $time_type = "";
    $event_id = urldecode($_GET["event_id"]);
    $id = "";
    $time_out_err = "";

    $sql = "SELECT * FROM event_info WHERE event_id = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param('i',$param_event_id);
        $param_event_id = $event_id;
        if ($result = $stmt->execute()) {
            $result = $stmt->get_result();
            $result = $result->fetch_array();
            $payment = $result["registration_fee"];
            $event_name = $result["event_name"];
            $event_description = $result["event_description"];
        }
    }

    function my_base_convert($numstring, $frombase, $tobase) 
    {
      $chars = "0123456789abcdefghijklmnopqrstuvwxyz";
      $tostring = substr($chars, 0, $tobase);

      $length = strlen($numstring);
      $result = '';
      for ($i = 0; $i < $length; $i++)
      {
          $number[$i] = strpos($chars, $numstring[$i]);
      }
      do
      {
        $divide = 0;
        $newlen = 0;
        for ($i = 0; $i < $length; $i++)
        {
            $divide = $divide * $frombase + $number[$i];
            if ($divide >= $tobase)
            {
                $number[$newlen++] = (int)($divide / $tobase);
                $divide = $divide % $tobase;
            } elseif ($newlen > 0)
            {
                $number[$newlen++] = 0;
            }
        }
        $length = $newlen;
        $result = $tostring[$divide] . $result;
      } while ($newlen != 0);
      return $result;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $input_time = trim($_POST["time_type"]);
        $input_student_number = trim($_POST["student_number"]);

        $input_student_number = my_base_convert($input_student_number, 10, 16);
        if (strlen($input_student_number) != 32) {
          $input_student_number = "0".$input_student_number;
        }

        $input_student_number = substr($input_student_number, 0, 8);
        //header("location: ".$input_student_number);

        $u = "SELECT student_number FROM attendees WHERE student_number ='$input_student_number' AND event_id='$event_id' AND time_in IS NOT NULL";
        $uu = $mysqli->query($u);
        $u = "SELECT student_number FROM student_info WHERE student_number ='$input_student_number'";
        $uu2 = $mysqli->query($u);

        if (empty($input_student_number)) {
            $student_number_err = "WARNING: Invalid QR Pass!";
        } elseif (mysqli_num_rows($uu2) < 1 ) {
            $student_number_err = "WARNING: QR Pass is not registered! <br> Please approach the event admin.".$input_student_number;
        } elseif ((mysqli_num_rows($uu) > 0) && ($input_time == "In")) {
            $student_number_err = "WARNING: QR Pass already used. <br> Please approach the event admin.";
        } elseif (True) { //nag True muna ako paki ayos pls.
            $student_number = $input_student_number;       
        }else{
            $student_number_err = "Please enter a valid student number.";
        }

        if (($input_time == "Out") && empty($student_number_err)) {
          $u = "SELECT id FROM attendees WHERE time_in IS NOT NULL AND time_out IS NULL AND student_number = '".$student_number."' AND event_id = '".$event_id."'";
          $uu3 = $mysqli->query($u);
          if ((mysqli_num_rows($uu3) > 0) && $input_time == "Out") {
            $time_out_err = "";
            $id = $uu3->fetch_array()["id"];
          } elseif ((mysqli_num_rows($uu3) == 0) && $input_time == "Out"){
            $time_out_err = "Please time in first.";
          } else {
            $time_out_err = "";
          }
        } else {
          $time_out_err = "";
        }
        
        if (empty($student_number_err) && ($input_time=="In") && empty($time_out_err)) { 
            $dt = new DateTime("now", new DateTimeZone('Asia/Hong_Kong')); 
            $sql = "INSERT INTO attendees (student_number, event_id, payment, time_in) VALUES (?, ?, ?, ?)";

            if ($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param("ssis", $param_student_number, $param_event_id, $param_payment, $param_time_in);

                $param_payment = $payment;
                $param_event_id = $event_id;
                $param_student_number = $student_number;
                $param_time_in = $dt->format('H:i:s');

                if ($stmt->execute()) {
                    header("location: registration.php?event_id=".urlencode($event_id)."&payment=".urlencode($payment)."&sn=".urlencode($student_number))."&time_type=".urlencode($input_time);
                    echo $input_time;
                } else {
                    echo "something went wrong ):";
                }
            }
            $stmt->close();
        } elseif (empty($student_number_err) && ($input_time == "Out") && empty($time_out_err)) {
            $dt = new DateTime("now", new DateTimeZone('Asia/Hong_Kong')); 
            $time_in = "";
            $sql = "SELECT time_in FROM attendees WHERE id = ? AND event_id = ?";
            if ($stmt = $mysqli->prepare($sql)) {
              $stmt->bind_param("ii", $param_id, $param_event_id);

              $param_id = $id;
              $param_event_id = $event_id;

              if ($stmt->execute()) {
                $time_in = new DateTime($stmt->get_result()->fetch_array()[0], new DateTimeZone('Asia/Hong_Kong'));
              } else {
                echo "couldn't get time_in from id";
              }
            }


            $sql = "UPDATE attendees SET time_out = ?, time_attended = ? WHERE id = ? AND event_id = ?";

            if ($stmt = $mysqli->prepare($sql)) {
              $stmt->bind_param("ssii", $param_time_out, $param_time_attended, $param_id, $param_event_id);

              $param_time_out = $dt->format('H:i:s');
              $param_id = $id;
              $param_event_id = $event_id;
              $param_time_attended = ($dt->diff($time_in))->format("H:i:s");

              if ($stmt->execute()) {
                header("location: registration.php?event_id=".urlencode($event_id)."&payment=".urlencode($payment)."&sn=".urlencode($student_number)."&time_type=".urlencode($input_time));
              } else {
                echo "something went wrong ):";
              }
            }
        } elseif (!empty($time_out_err) || !empty($student_number_err)) {  
          // nothing happens :) because errors will be displayed
        } else {
          echo "Something went wrong!"; 
        }
    } 
    $sql = "SELECT * FROM student_info WHERE student_number = ?";
    if (!empty($_GET["sn"]) && empty($student_number_err) && empty($time_out_err)) {
      if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param('s',$param_student_number);
        $param_student_number = urldecode($_GET['sn']);
        if ($result = $stmt->execute()) {
            $result = $stmt->get_result();
            $result = $result->fetch_array();
            $first_name = $result["first_name"];
            $last_name = $result["last_name"];
            $middle_initial = $result["middle_initial"];
        }
      } 
    }
    if (!empty($_GET["time_type"]))  {
      $input_time = trim($_GET["time_type"]);
    } else {
      $input_time = "";
    }
    $mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
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
        src: url("../font/Poppins-Bold.ttf");
  }
  @font-face {
        font-family: mySecondFont;
        src: url("../font/Poppins-Black.ttf");
  }
  body {
    font-family: myFirstFont;
    background-image: url("./img/bg.png");
    background-size: cover;
    height: 100vh;
    overflow:hidden;
  }
  .container{
    display: flex;
    margin: 0;
    padding: 40px, 0px;
  }
  .left-box{
    width: 100%;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3); 
    border-radius: 10px 0px 0px 10px; 
    height: 135%;
    background-size:100% 100%;
    background-repeat: no-repeat;
    background-image:url('./img/background.png');
    max-height: 70vh;
    max-width: 85vw;
  }
  .left{
    text-align: center;
    padding: 170px 0;
  }
  .left h1,p{
    font-family: myFirstFont;
    color: #161F34;
    font-weight:bold;
  }
  .left-box a{
    position: absolute; 
    top: 8px; 
    left: 16px; 
    width:50px; 
    height: 50px;
  }
  .right-box{
    width: 100%;
    height: 125%;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3); 
    border-radius: 0px 10px 10px 0px; 
    background: white;
    margin: 0;
    max-height: 70vh;
    max-width: 85vw;
    overflow: scroll;
  }
  .right{
    padding: 20px;
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
    width: 100%;
    line-height: 1.8; 
  }
  .right .btn{
    background-color: #013365; 
    border: #013365 solid;
    font-family: myFirstFont;
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
        <a href="index.php"><img src="./img/back.png" style="opacity: 0.0;position: absolute; top: 8px; left: 16px; width:50px;height: 50px;"></a>
          <div class="left">
          </div>
        </div>
      </div>
      <div class="col-md-6 px-0">
        <div class="right-box d-flex justify-content-center">
          <div class="right container-fluid">
            <form method="post" id="form" name="form">
              <div class="form-group">
                <p class="fw-bold" style="font-weight:normal; font-size:45px; font-family:mySecondFont">Scan your QR Pass
              </div>
              <div class="form-group">
                <select style="width:350px; margin: 0 auto; margin-left: auto; margin-right: auto; text-align:center; " name="time_type" class="form-control" value="<?php echo $_POST["time_type"]; ?>">
                <?php
                  $in = "<option value='In' style='font-weight: bold; color: #161F34;'>Time in</option>";
                  $out = "<option value='Out' style='font-weight: bold; color: #161F34;'>Time out</option>";
                  echo $_GET["time_type"];

                  if ($_GET["time_type"] == "Out") {
                    echo $out;
                    echo $in;
                  } else {
                    echo $in;
                    echo $out;
                  }
                ?>
                </select>
                  <br>
                <input type="text" style="background-image: none; color: black; font-size:50pt; width:350px; margin: 0 auto; margin-left: auto; margin-right: auto; text-align:center;" name="student_number" id="student_number" class="form-control" value="<?php echo $student_number?>" autofocus/>
                <p style="font-size:20px; color:red"> <?php echo $student_number_err; ?> </p>
                <p style="font-size:20px; color:red"> <?php echo $time_out_err; ?> </p>
                <span class=""> <?php 
                  if (!empty($last_name) && !empty($first_name) && (empty($input_time))) {
                    echo "<br><p style='font-size:20px;line-height: 0.7'>Welcome to <span style='color: red;'>UE</span> Tech Con 2024!,";
                    echo "<p style='font-size:30px; line-height: 1;'>".$last_name.", ".$first_name." ".$middle_initial."."; 
                  } elseif (!empty($last_name) && !empty($first_name) && (!empty($input_time))) {
                    echo "<br><p style='font-size:20px;line-height: 0.7'>Thank you for coming to <span style='color: red;'>UE</span> Tech Con 2024!,";
                    echo "<p style='font-size:30px; line-height: 1;'>".$last_name.", ".$first_name." ".$middle_initial."."; 
                  } else {

                  }
                  ?> </span>
                <br>
                <p style="font-size:15px; opacity: 0.0; line-height:02">brhrbr</p>
              </div>
              <div style="">
                <p style="bottom: 0; line-height: 1.3; font-size: 20px;">Happy Learning, future <br><span style="font-family:mySecondFont">Computer Engineers!</span></p>
              </div>
              </form> 

              <script>
                var input = document.querySelector('#student_number');
                input.addEventListener('keyup', checkLength);
                function checkLength(e){
                    if(e.target.value.length>600){
                        document.forms["form"].submit();
                    }
                }
              </script>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
