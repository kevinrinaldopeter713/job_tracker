<?php

$conn= mysqli_connect('localhost', 'job_application', 'job1234', 'job_application_tracker');

if(!$conn){
 echo 'connection error:'. mysqli_connect_error();
}

$sql = 'SELECT Email, Applicant_Name, Address , Contact_Number,Attachment FROM job_applications' ;
$result = mysqli_query($conn, $sql);
$job_applications = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result(($result));

$sql2 = 'SELECT Department, Title FROM job_description' ;
$result2 = mysqli_query($conn, $sql2);
$job_description = mysqli_fetch_all($result2, MYSQLI_ASSOC);

mysqli_free_result(($result2));


$sql3 = 'SELECT full_name FROM login_data';
$result3 = mysqli_query($conn, $sql3);
//free result from memory
$login_data = mysqli_fetch_all($result3);

mysqli_free_result(($result3));

mysqli_close($conn);

print_r($job_applications);



$Email=$Applicant_Name=$Address=$Contact_Number=$Attachment=$full_name=$Department=$Title='';
$errors= array('Email'=>'', 'Applicant_Name'=>'','Address'=>'' ,'Contact_Number'=>'','Attachment'=>'','full_name'=>'','Department'=>'','Title'=>'');

if(isset($_POST['submit'])){
    //echo $_POST['full_name'];
    //echo $_POST['Applicant_Name'];
    //echo $_POST['Address'];
    //echo $_POST['Contact_Number'];
    //echo $_POST['Attachment'];

if(empty($_POST['Email'])){
    $errors['Email']= 'an email is required </br>';
}else{
    $Email=$_POST['Email'];
    if(!filter_var($Email, FILTER_VALIDATE_EMAIL)){
        $errors['Email']=  'enter a valid email Address</br>';
    }
}

if(empty($_POST['Applicant_Name'])){
    $errors['Applicant_Name']=  'a Applicant_Name is required </br>';
}else{
    $Applicant_Name=$_POST['Applicant_Name'];
    if(!preg_match('/^[a-zA-Z\s]+$/',$Applicant_Name)){
        $errors['Applicant_Name']=  'Applicant_Name must be letters and spaces only</br>';
    }
}

if(empty($_POST['Address'])){
    $errors['Address']=  'an Address is required </br>';
}else{
    $Address=$_POST['Address'];
    if(!preg_match('/^[a-zA-Z\s]+$/',$Address)){
        $errors['Address']=  'Address must be letters and spaces only</br>';
    }

if(empty($_POST['Contact_Number'])){
    $errors['Contact_Number']=  'an phone number is required</br> ';
}else{
    $Contact_Number=$_POST['Contact_Number'];
    if(!filter_var($Contact_Number, FILTER_VALIDATE_INT)){
        $errors['Contact_Number']=  'phone number must be integers from 0-10 only</br>';
    }
}

if(empty($_POST['Attachment'])){
    $errors['Attachment']=  'a Attachment is required ';
}else{
    $Attachment=$_POST['Attachment'];
}


if(!isset($_POST['full_name'])){
    $errors['full_name']=  'a choice is required ';
}else{
    $Save=$_POST['full_name'];
}

if(!isset($_POST['Department'])){
    $errors['Department']=  'a choice is required ';
}else{
    $Department=$_POST['Department'];
}

if(!isset($_POST['Title'])){
    $errors['Title']=  'a choice is required ';
}else{
    $Title=$_POST['Title'];
}





}

if(array_filter($errors))
{

}else{

    $Email = mysqli_real_escape_string($conn, $_POST['Email']);
    $Applicant_Name = mysqli_real_escape_string($conn, $_POST['Applicant_Name']);
    $Address = mysqli_real_escape_string($conn, $_POST['Address']);
    $Contact_Number = mysqli_real_escape_string($conn, $_POST['Contact_Number']);
    $Attachment = mysqli_real_escape_string($conn, $_POST['Attachment']);
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $Department = mysqli_real_escape_string($conn, $_POST['Department']);
    $Title= mysqli_real_escape_string($conn, $_POST['Title']);

    $sql="INSERT INTO job_applications(Email,Applicant_Name,Address,Contact_Number,Attachment) VALUES('$Email','$Applicant_Name','$Address,'$Contact_Number,'$Attachment')";
    $sql2="INSERT INTO job_description(Department, Title) VALUES('$Department','$Title')";
    $sql3="INSERT INTO login_data(full_name) VALUES('$full_name')";
    if(mysqli_query($conn,$sql))
    {header('Location: index.php');
    }else{
        echo 'query error:'.mysqli_error($conn);
    }
    
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="applicant_form.css">
    <!-- FONT -->
    <link href="https://fonts.googleapis.com/csDepartment?family=Montserrat:wght@500&display=swap" rel="stylesheet">
  <!-- FONT Awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    
    <title>Applicant Form</title>
    
</head>
<body>
    <main>
        <p style="background-color: white;"> </p> 
      <h1 style="background-color: rgb(37, 175, 218); color: white;font-size: 18px;padding-left: 30px;padding-top:5px; padding-bottom:5px; display:inline-flexbox;"><i class="fa fa-location-arrow" aria-hidden="true"></i>Applying For A New Job?</h1>
    <!--  <p style="background-color: white;padding: 4px;"> </p> -->
     
      <form class="row g-3" style="padding-left: 25px;background-color:beige;padding-top: 20px;" method="POST" action="app_one.php">

        
        <div class="col-md-6" style="padding-top: 25px;">
            <label for="inputname" class="form-label" style="padding-right:5px">Name:</label>
            <input type="name" name='Applicant_Name' class="form-control" id="inputname" placeholder="Enter your name" value="<?php echo $Applicant_Name?>">
            <div style="color:red"><?php echo $errors['Applicant_Name'];?></div>
          </div>
        
          <div class="col-md-6" style="padding-top:25px;">
              <label for="inputemail" class="form-label"  style="padding-right:5px">Email Id:</label>
              <input type="mail" class="form-control" id="inputemail" name="Email" placeholder="Enter your Email" value="<?php echo $Email?>">
              <div style="color:red"><?php echo $errors['Email'];?></div>
          </div>

          <div class="col-md-10" style="padding-top:25px;">
            <label for="inputemail" class="form-label"  style="padding-right:5px">Residential Address:</label>
            <textarea id ="Address" input type="text" class="form-control" name="Address" value="<?php echo $Address?>"></textarea>
            <div style="color:red"><?php echo $errors['Address'];?></div>
        </div>

        <div class="col-md-6" style="padding-top: 25px;">
            <label for="inputnumber" class="form-label" style="padding-right:5px">Contact Number:</label>
            <input name="Contact_Number" type="tel" class="form-control" id="inputnumber" maxlength="10" minlength="1" value="<?php echo $Contact_Number?>">
            <div style="color:red"><?php echo $errors['Contact_Number'];?></div>
          </div>
        
          <div class="col-md-6" style="padding-top:25px;">
              <label for="inputresume" class="form-label"  style="padding-right:5px">Resume:</label></br>
              <input type="file" name="Attachment" >
              <div style="color:red"><?php echo $errors['Attachment'];?></div>
          </div>
        
        <div class="col-md-8" style="padding-top: 25px;">
          <label for="inputperson" class="form-label"  style="padding-right:5px">Person Under Whom You Are Applying:</label>
          <select name="full_name" id="inputperson" class="form-select">
            <option selected disabled>Choose...</option>
            <option>kevin</option>
            <option>anukreeti</option>
            <option>arpita</option>
            <option>siddesh</option>
        </select>
        <a style="padding-left:15px;"></a><input class="btn btn-primary" type="button"  value="Save">
        <div style="color:red"><?php echo $errors['full_name'];?></div>
        </div>

          <div class="col-md-8" style="padding-top: 25px;">
            <label for="inputDept" class="form-label"  style="padding-right:5px">Department:</label>
            <select name="Department" id="inputDept" class="form-select">
              <option selected disabled>Choose...</option>
              <option>software</option>
              <option>healthcare</option>
              <option>accounting and finances</option>
              <option>management</option>
              <option>sales and retail</option>
          </select>
          <a style="padding-left:15px;"></a><input class="btn btn-primary" type="button" value="Save">
          <div style="color:red"><?php echo $errors['Department'];?></div>
          </div>

          <div class="col-md-8" style="padding-top: 25px;">
            <label for="inputposition" class="form-label"  style="padding-right:5px">Position:</label>
            <select name='Title' id="inputposition" class="form-select">
              <option selected disabled>Choose...</option>
              <option>assistant</option>
              <option>manager</option>
              <option>professor</option>
              <option>secretary</option>
          </select>
          <a style="padding-left:15px;"></a><input class="btn btn-primary" type="button" value="Save">
          <div style="color:red"><?php echo $errors['Title'];?></div>
        </div>
          
       
        </br>
         
         <div class="save_cancel" style="float:right;margin-right: 20px;"> 
            <a style="margin-right:20px; padding: 5px 8px;"></a><input class="btn btn-success btn-md" type="submit" name="submit" value="Send Application" >
           <input class="btn btn-danger btn-md" style="padding: 5px 8px;"  type="submit" value="Cancel" onclick="goBack()"></a>
        </div> 

      </form>
    
    </main>
</body>
</html> 