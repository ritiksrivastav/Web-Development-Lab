<?php
include('config.php');
?>

<?php
    if(isset($_POST['Submit']))
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $gender = $_POST['Gender'];
        $city = $_POST['City'];

        $sql = "INSERT INTO `users` (`username`, `e-mail`, `Gender`, `City`) VALUES ('$username', '$email', '$gender', '$city')";
        mysqli_query($conn , $sql);
    
    }
    else{
        echo "Please click the submit button to submit data";
    }

?>

<html>
    <body>
        
        <form method="POST" action="add.php">
        Username : <input type="text" name="username" placeholder = "Type your username" required><br>
        Email : <input type="email" name="email" placeholder = "Type your email" required><br>
        <!-- Password : <input type="password" name="password" minlength="5"><br> -->
        <!-- Birthday : <input type = "date" name="var4"><br> -->
        Gender:<br>
        <input type="radio" value = "MALE" name="Gender">Male<br>
        <input type="radio" value = "FEMALE" name="Gender">Female<br>
        <input type="radio" value = "OTHERS" name="Gender">Other<br>
        <!-- Contact : <input type="number" name="var5" required> <br> -->
        City :
    <select id="City" name="City">
    <option value="Dehradun">Dehradun</option>
    <option value="Meeruth">Meeruth</option>
    <option value="Ranchi">Ranchi</option>
    <option value="Delhi">Delhi</option>
    <option value="Haridwar">Haridwar</option>
    <option value="Varanasi">Varanasi</option>
    <option value="Lucknow">Lucknow</option>
    <option value="Prayagraj">Prayagraj</option>
    <option value="Muradabad">Muradabad</option>
    <option value="Mumbai">Mumbai</option>
    <option value="Laksar">Laksar</option>
    <option value="Rurkee">Rurkee</option>
  </select><br>
        <input type="submit" value="Submit" name="Submit">
    </form>
    </body>
</html>


<?php
//INSERT INTO `users` (`id`, `username`, `e-mail`, `Gender`, `City`) VALUES ('10001', 'AnandRaj', 'aanandraj460@gmail.com', 'Male', 'Garhwa');
?>