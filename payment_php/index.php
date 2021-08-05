<?php

$error = '';
$name = '';
$email = '';
$subject = '';
$mobile = '';
$message = '';
$bonus = '';
$date = '';
$month = '';

function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}

if(isset($_POST["submit"]))
{
 if(empty($_POST["name"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Name</label></p>';
 }
 else
 {
  $name = clean_text($_POST["name"]);
  if(!preg_match("/^[a-zA-Z ]*$/",$name))
  {
   $error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
  }
 }
 if(empty($_POST["email"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Email</label></p>';
 }
 else
 {
  $email = clean_text($_POST["email"]);
  if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
   $error .= '<p><label class="text-danger">Invalid email format</label></p>';
  }
 }
  if(empty($_POST["bonus"]))
 {
  $error .= '<p><label class="text-danger">Bonus is required</label></p>';
 }
 else
 {
  $bonus = clean_text($_POST["bonus"]);
 }
 
  if(empty($_POST["date"]))
 {
  $error .= '<p><label class="text-danger">Date is required</label></p>';
 }
 else
 {
  $date = clean_text($_POST["date"]);
 }
 

  if(empty($_POST["month"]))
 {
  $error .= '<p><label class="text-danger">Month is required</label></p>';
 }
 else
 {
  $month = clean_text($_POST["month"]);
 }
 

 if(empty($_POST["subject"]))
 {
  $error .= '<p><label class="text-danger">Subject is required</label></p>';
 }
 else
 {
  $subject = clean_text($_POST["subject"]);
 }

if(empty($_POST["mobile"]))
 {
  $error .= '<p><label class="text-danger">Mobile is required</label></p>';
 }
 else
 {
  $mobile = clean_text($_POST["mobile"]);
 }
 
 if(empty($_POST["message"]))
 {
  $error .= '<p><label class="text-danger">Message is required</label></p>';
 }
 else
 {
  $message = clean_text($_POST["message"]);
 }

 if($error == '')
 {
  $file_open = fopen("contact_data.csv", "a");
  $no_rows = count(file("contact_data.csv"));
  if($no_rows > 1)
  {
   $no_rows = ($no_rows - 1) + 1;
  }
  $form_data = array(
   'sr_no'  => $no_rows,
   'name'  => $name,
   'email'  => $email,
   'subject' => $subject,
   'mobile' => $mobile,
   'message' => $message,
   'bonus' => $bonus,
   'month' => $month,
   'date' => $date
  );
  fputcsv($file_open, $form_data);
  $error = '<label class="text-success">Thank you! :)</label>';
  $name = '';
  $email = '';
  $subject = '';
  $mobile = '';
  $message = '';
  $bonus = '';
  $date = '';
  $month = '';
 }
}

?>
<!DOCTYPE html>
<html>
 <head>
  <title>Payment dates store in CSV File</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 </head>
 <body>
  <br />
  <div class="container">
   <h2 align="center"> Payment dates store in CSV File</h2>
   <br />
   <div class="col-md-6" style="margin:0 auto; float:none;">
    <form method="post">
    
     <br />
     <?php if(!empty($error)) {
         echo '<div class="alert alert-success" role="alert">'.$error.'</div>';
     }
     ?>
     <div class="form-group">
      <label>Enter Name</label>
      <input type="text" name="name" placeholder="Enter Name" class="form-control" value="<?php echo $name; ?>" />
     </div>
     <div class="form-group">
      <label>Enter Email</label>
      <input type="text" name="email" class="form-control" placeholder="Enter Email" value="<?php echo $email; ?>" />
     </div>
     <div class="form-group">
      <label>Enter Subject</label>
      <input type="text" name="subject" class="form-control" placeholder="Enter Subject" value="<?php echo $subject; ?>" />
     </div>
     <div class="form-group">
      <label>Enter Mobile</label>
      <input type="text" name="mobile" class="form-control" placeholder="Enter Mobile" value="<?php echo $mobile; ?>" />
     </div>
	 <div class="form-group">
      <label>Enter Date of the month</label>
      <input type="date" name="date" class="form-control" placeholder="Date" value="<?php echo $date; ?>" />
     </div>
	  <div class="form-group">
      <label>Enter Month name</label>
      <input type="month" name="month" class="form-control" placeholder="Month Name" value="<?php echo $month; ?>" />
     </div>
	  <div class="form-group">
      <label>Enter Bonus</label>
      <input type="text" name="bonus" class="form-control" placeholder="Enter Bonus" value="<?php echo $bonus; ?>" />
     </div>
     <div class="form-group">
      <label>Enter Message</label>
      <textarea name="message" class="form-control" placeholder="Enter Message"><?php echo $message; ?></textarea>
     </div>
     <div class="form-group" align="center">
      <input type="submit" name="submit" class="btn btn-info" value="Submit" />
     </div>
    </form>
   </div>
  </div>
 </body>
</html>