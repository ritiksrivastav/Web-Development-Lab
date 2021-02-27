<?php
include('config.php');
?>


<?php
$id = $_GET['id'];
$sql = "SELECT * FROM `users` WHERE `id` = $id";
$result = mysqli_query($conn,$sql);
$row = $result->fetch_assoc();
$username = $row['username'];
$email = $row['e-mail'];
$gender = $row['Gender'];
$city  = $row['City'];
?>

<html>
    <body>
        
        <form method="POST" action="edit.php?id=<?php echo"$id" ?>">
        Username : <input type="text" name="username"  value = <?php echo "$username"?>  placeholder = "Type your username" required><br>
        Email : <input type="email" name="email" value = <?php echo "$email"?> placeholder = "Type your email" required><br>
        <!-- Password : <input type="password" name="password" minlength="5"><br> -->
        <!-- Birthday : <input type = "date" name="var4"><br> -->
        Gender:<br>
        <input type="radio" value = "MALE" name="Gender">Male<br>
        <input type="radio" value = "FEMALE" name="Gender" >Female<br>
        <input type="radio" value = "OTHERS" name="Gender" >Other<br>
        <!-- Contact : <input type="number" name="var5" required> <br> -->
        City <select name = "city">
        <option value="Dehradun" <?php  if($city == "Dehradun"){ echo "selected";}?> >Dehradun</option>
        <option value="Meeruth" <?php  if ($city == "Meertuth") { echo "selected";}?> >Meeruth</option>
        <option value="Ranchi" <?php  if ($city == "Ranchi") { echo "selected";}?> >Ranchi</option>
        <option value="Delhi" <?php  if ($city == "Delhi") { echo "selected";}?> >Delhi</option>
        <option value="Haridwar" <?php  if ($city == "Haridwar") { echo "selected";}?> >Haridwar</option>
        <option value="Varanasi" <?php  if ($city == "Varanasi") { echo "selected";}?> >Varanasi</option>
        <option value="Lucknow" <?php  if ($city == "Lucknow") { echo "selected";}?> >Lucknow</option>
        <option value="Prayagraj" <?php  if ($city == "Prayagraj") { echo "selected";}?> >Prayagraj</option>
        <option value="Muradabad" <?php  if ($city == "Muradabad") { echo "selected";}?> >Muradabad</option>
        <option value="Mumbai" <?php  if ($city == "Mumbai") { echo "selected";}?> >Mumbai</option>
        <option value="Laksar" <?php  if ($city == "Laksar") { echo "selected";}?> >Laksar</option>
        <option value="Rurkee" <?php  if ($city == "Rurkee") { echo "selected";}?> >Rurkee</option>
        </select><br>
        <input type="submit" value="Update" name="Update">
    </form>
    </body>
</html>


<?php
if(isset($_POST['Update'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $gender = $_POST['Gender'];
    $city  = $_POST['city'];

    $sql = "UPDATE `users` SET username='$username',`e-mail`='$email',Gender='$gender',City='$city' WHERE id='$id'";
    if(mysqli_query($conn, $sql))
    {
        echo " DATA UPDATED.";
        header("Location:details.php");
    }
    else
    {
        echo "UPDATION FAILED";
    }
}

?>