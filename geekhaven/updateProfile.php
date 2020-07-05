<?php
    // include './addmember.php'
    require "../database/member_info.php";    
    session_start();
    $cookie_name = $_SESSION['member_id'];
    $t = $_SESSION['time'];
    if(isset($_COOKIE[$cookie_name])){
        if($_COOKIE[$cookie_name]==$t + ($t%2408) + $cookie_name){

        }else if($_COOKIE[$cookie_name]==$t + $cookie_name){
            
        }else{
            header('location:login.php');
        }
    }else{
        header('location:login.php');
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <h1>Update Profile</h1>
    </head>
    <body>
        <?php
            $mem_id = $_SESSION['member_id'];
            $query = "SELECT * FROM member WHERE member_id='$mem_id'";
            $query_run = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($query_run)){
                $name =$row['name'];                
                $roll =$row['roll_no'];
                $image =$row['image'];
                $des =$row['description']; 
            }
        ?>
        <form method='post' action='../data_game/profileupdate.php'>
            <label>Name</label>
            <input name="name" type="text" placeholder="Name" value="<?php echo $name;?>"require></input><br>
            <label>Roll Number</label>            
            <input name="roll_no" type="text" placeholder="roll Number" value="<?php echo $roll;?>"require></input><br>
            <label>Image</label>            
            <input name="image" type="text" placeholder="image" value="<?php echo $image;?>"></input><br>
            <label>Description</label>            
            <input name="description" type="text" placeholder="description" value="<?php echo $des;?>"></input><br>
            <input name="submit" type="submit" value="Save"></input>
        </form>
        <?php
            if(isset($_POST['submit'])){
                $name = $_POST['name'];
                $roll = $_POST['roll_no'];
                $img = $_POST['image'];
                $description = $_POST['description'];
                $query = "UPDATE member SET `name`='$name',`roll_no`='$roll',`image`='$img',`description`='$description' WHERE `member_id`='$mem_id'";
                $query_run = mysqli_query($connection,$query);
                echo "UPDATED SUCCESSFULLY";
            }
            // echo $id;
        ?>
        <br>
        <br>
        <hr>
        <h2>Update Social Handles</h2><br>
        <form method='post' action="social_handles.php">
            <input name="handle" type="submit" value="Social Handles"></input>
        </form>
        <br><br>
        <form method= 'post' action='home.php'>
            <input type='submit' value='home'>
        </form>
    </body>
</html>