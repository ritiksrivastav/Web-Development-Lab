<html>
   
   <head>
      <title>PHP Form Validation</title>
   </head>
   
   <body>
      <?php
         
         // define variables and set to empty values
         $name = $email = $contact = $city = $course =$interest= "";
		 $Err="";
         if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if (empty($_POST["name"])) {
				$Err="Name is required";
			}else{
				$name = test_input($_POST["name"]);
			}
            if (empty($_POST["email"])) {
				$Err="Email is required";
			}else{
				$email = test_input($_POST["email"]);
			}
            if (empty($_POST["contact"])) {
				$Err="Contact is required";
			}else{
				$contact = test_input($_POST["contact"]);
			}
            if (empty($_POST["city"])) {
				$Err="City is required";
			}else{
				$city = test_input($_POST["city"]);
			}
            if (empty($_POST["course"])) {
				$Err="Course is required";
			}else{
				$course = test_input($_POST["course"]);
			}
            if (empty($_POST["interest"])) {
				$Err="Interest is required";
			}else{
				$interest = test_input($_POST["interest"]);
			}
         }
         function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }
      ?>
   
      <h2>Registration Form</h2>
      
      <form method = "post">
         <label>Name:</label> 
         <input type = "text" name = "name"><br><br> 
		 <label>E-mail:</label> 
         <input type = "mail" name = "email"><br><br>
		 <label>Contact:</label> 
         <input type = "text" name = "contact"><br><br>
		 <label>City:</label> 
         <input type = "text" name = "city"><br><br>
		 <label>Course:</label> 
         <input type = "text" name = "course"><br><br>
         <label>Interest:</label><br> 
         <input type = "radio" name = "interest" value = "Sports">Sports<br>
         <input type = "radio" name = "interest" value = "Singing">Singing<br>
		 <input type = "radio" name = "interest" value = "Painting">Painting<br>
         <input type = "radio" name = "interest" value = "Dancing">Dancing<br>
		 <input type = "radio" name = "interest" value = "Travelling">Travelling<br>   		 
         <input type = "submit" name = "submit" value = "Submit">
		 </form>
	  <?php
			
         echo "<h2>Your Given details are as :</h2>";
		 echo$Err;
		 echo"
		 <table border=1px>
			<thead>
				<tr>
					<th>Name</th>
					<th>E-mail</th>
					<th>Contact</th>
					<th>Course</th>
					<th>City</th>
					<th>Interest</th>
				</tr>
			</thead>
			<tbody>
				<tr>
				<td>$name</td>
				<td>$email</td>
				<td>$contact</td>
				<td>$course</td>
				<td>$city</td>
				<td>$interest</td>
				</tr>
			</tbody>
		</table>";
      ?>
   </body>
</html>