<?php
include('config.php');

?>
<?php
    $sql = "SELECT * FROM `users`";
    $result = mysqli_query($conn,$sql);
    if($result->num_rows > 0)
    {
    ?>
        <table border = "1px">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>username</th>
                    <th>email</th>
                    <th>Gender</th>
                    <th>City</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php
               // while($row = $result->fetch_array())
               while($row = $result->fetch_assoc())
                {?>
                    <tr>
                        <td><?php echo $row['id']?></td>  
                        <td><?php echo $row['username']?></td>  
                        <td><?php echo $row['e-mail']?></td>  
                        <td><?php echo $row['Gender']?></td>  
                        <td><?php echo $row['City']?></td>
                        <td><a href="edit.php?id=<?php echo $row['id']?>">
                        <input type= "button" value = "Edit" ></a></td>      
                        <td><a href="delete.php?id=<?php echo $row['id']?>">
                        <input type= "button" value = "Delete" ></a></td>  
                    </tr>
               <?php }  ?>            
            </tbody>
            </thead>
        </table>

 <?php   }
?>
