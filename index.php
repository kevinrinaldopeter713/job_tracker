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




?>
<!DOCTYPE html>
<html>
<h4 class="center grey-text">Applications</h4>
<div class="container">
<?php foreach($application_form as $application_form){ ?>
  <h6><?php echo htmlspecialchars($application_form['email']); ?></h6>
  <h6><?php echo htmlspecialchars($application_form['name']); ?></h6>
  <h6><?php echo htmlspecialchars($application_form['text']); ?></h6>
  <h6><?php echo htmlspecialchars($application_form['tel']); ?></h6>
  <h6><?php echo htmlspecialchars($application_form['file']); ?></h6>
  <h6><?php echo htmlspecialchars($application_form['S1']); ?></h6>
  <h6><?php echo htmlspecialchars($application_form['S2']); ?></h6>
  <h6><?php echo htmlspecialchars($application_form['S3']); ?></h6>
}
</body>
</html>