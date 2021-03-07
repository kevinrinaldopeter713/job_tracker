<?php

$conn= mysqli_connect('localhost','job_tracker','job_tracker','job_application_tracker');

if(!$conn){
 echo 'connection error:'. mysqli_connect_error();
}

$sql = 'SELECT email,name,text,tel,file,S1,S2,S3 FROM application_form ORDER BY created_at' ;
        
// make query and get result
$result = mysqli_query($conn, $sql);

// fetch the resulting rows as an array
$application_form = mysqli_fetch_all($result, MYSQLI_ASSOC);

//free result from memory
mysqli_free_result(($result));

mysqli_close($conn);



$email=$name=$text=$tel=$file=$S1=$S2=$S3='';
$errors= array('email'=>'', 'name'=>'','text'=>'' ,'tel'=>'','file'=>'','S1'=>'','S2'=>'','S3'=>'');

if(isset($_POST['submit'])){
    //echo $_POST['email'];
    //echo $_POST['name'];
    //echo $_POST['text'];
    //echo $_POST['tel'];
    //echo $_POST['file'];

if(empty($_POST['email'])){
    $errors['email']= 'an email is required </br>';
}else{
    $email=$_POST['email'];
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email']=  'enter a valid email address</br>';
    }
}

if(empty($_POST['name'])){
    $errors['name']=  'a name is required </br>';
}else{
    $name=$_POST['name'];
    if(!preg_match('/^[a-zA-Z\s]+$/',$name)){
        $errors['name']=  'name must be letters and spaces only</br>';
    }
}

if(empty($_POST['text'])){
    $errors['text']=  'an address is required </br>';
}else{
    $text=$_POST['text'];
    if(!preg_match('/^[a-zA-Z\s]+$/',$text)){
        $errors['text']=  'address must be letters and spaces only</br>';
    }

if(empty($_POST['tel'])){
    $errors['tel']=  'an phone number is required</br> ';
}else{
    $tel=$_POST['tel'];
    if(!filter_var($tel, FILTER_VALIDATE_INT)){
        $errors['tel']=  'phone number must be integers from 0-10 only</br>';
    }
}

if(empty($_POST['file'])){
    $errors['file']=  'a file is required ';
}else{
    $file=$_POST['file'];
}


if(!isset($_POST['S1'])){
    $errors['S1']=  'a choice is required ';
}else{
    $Save=$_POST['S1'];
}

if(!isset($_POST['S2'])){
    $errors['S2']=  'a choice is required ';
}else{
    $S2=$_POST['S2'];
}

if(!isset($_POST['S3'])){
    $errors['S3']=  'a choice is required ';
}else{
    $S3=$_POST['S3'];
}





}

if(array_filter($errors))
{

}else{

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $text = mysqli_real_escape_string($conn, $_POST['text']);
    $tel = mysqli_real_escape_string($conn, $_POST['tel']);
    $file = mysqli_real_escape_string($conn, $_POST['file']);
    $S1 = mysqli_real_escape_string($conn, $_POST['S1']);
    $S2 = mysqli_real_escape_string($conn, $_POST['S2']);
    $S3= mysqli_real_escape_string($conn, $_POST['S3']);

    $sql="INSERT INTO application_form(email,name,text,tel,file,S1,S2,S3) VALUES('$email','$name','$text,'$tel,'$file,'$S1,'$S2','$S3')";
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
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
            <input type="name" name='name' class="form-control" id="inputname" placeholder="Enter your name" value="<?php echo $name?>">
            <div style="color:red"><?php echo $errors['name'];?></div>
          </div>
        
          <div class="col-md-6" style="padding-top:25px;">
              <label for="inputemail" class="form-label"  style="padding-right:5px">Email Id:</label>
              <input type="mail" class="form-control" id="inputemail" name="email" placeholder="Enter your Email" value="<?php echo $email?>">
              <div style="color:red"><?php echo $errors['email'];?></div>
          </div>

          <div class="col-md-10" style="padding-top:25px;">
            <label for="inputemail" class="form-label"  style="padding-right:5px">Residential Address:</label>
            <textarea id ="Address" input type="text" class="form-control" name="text" value="<?php echo $text?>"></textarea>
            <div style="color:red"><?php echo $errors['text'];?></div>
        </div>

        <div class="col-md-6" style="padding-top: 25px;">
            <label for="inputnumber" class="form-label" style="padding-right:5px">Contact Number:</label>
            <input name="tel" type="tel" class="form-control" id="inputnumber" maxlength="10" minlength="1" value="<?php echo $tel?>">
            <div style="color:red"><?php echo $errors['tel'];?></div>
          </div>
        
          <div class="col-md-6" style="padding-top:25px;">
              <label for="inputresume" class="form-label"  style="padding-right:5px">Resume:</label></br>
              <input type="file" name="file" >
              <div style="color:red"><?php echo $errors['file'];?></div>
          </div>
        
        <div class="col-md-8" style="padding-top: 25px;">
          <label for="inputperson" class="form-label"  style="padding-right:5px">Person Under Whom You Are Applying:</label>
          <select name="S1" id="inputperson" class="form-select">
            <option selected disabled>Choose...</option>
            <option>kevin</option>
            <option>anukreeti</option>
            <option>arpita</option>
            <option>siddesh</option>
        </select>
        <a style="padding-left:15px;"></a><input class="btn btn-primary" type="button"  value="Save">
        <div style="color:red"><?php echo $errors['S1'];?></div>
        </div>

          <div class="col-md-8" style="padding-top: 25px;">
            <label for="inputDept" class="form-label"  style="padding-right:5px">Department:</label>
            <select name="S2" id="inputDept" class="form-select">
              <option selected disabled>Choose...</option>
              <option>software</option>
              <option>healthcare</option>
              <option>accounting and finances</option>
              <option>management</option>
              <option>sales and retail</option>
          </select>
          <a style="padding-left:15px;"></a><input class="btn btn-primary" type="button" value="Save">
          <div style="color:red"><?php echo $errors['S2'];?></div>
          </div>

          <div class="col-md-8" style="padding-top: 25px;">
            <label for="inputposition" class="form-label"  style="padding-right:5px">Position:</label>
            <select name='S3' id="inputposition" class="form-select">
              <option selected disabled>Choose...</option>
              <option>assistant</option>
              <option>manager</option>
              <option>professor</option>
              <option>secretary</option>
          </select>
          <a style="padding-left:15px;"></a><input class="btn btn-primary" type="button" value="Save">
          <div style="color:red"><?php echo $errors['S3'];?></div>
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