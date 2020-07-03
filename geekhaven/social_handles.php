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
        <h1>Update Social Handles</h1>
    </head>
    <body>
        <?php
            $mem_id = $_SESSION['member_id'];
            $query = "SELECT * FROM member WHERE member_id='$mem_id'";
            $query_run = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($query_run)){
                $handle_id =$row['social_handles']; 
            }
            $query = "SELECT * FROM social_handles WHERE social_handles_id='$handle_id'";
            $query_run = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($query_run)){
                $handle_id =$row['social_handles_id'];
                $_SESSION['handleID'] = $handle_id;
                $git = $row['github'];
                $mail = $row['mail']; 
                $face = $row['facebook']; 
                $insta = $row['instagram']; 
                $chef = $row['codechef']; 
                $force = $row['codeforces']; 
                $in = $row['linkedin']; 
                $rank = $row['hackerrank'];
                $earth = $row['hackerearth']; 
                $twi = $row['twitter'];                  
            }
        ?>
        <form method='post' action='../data_game/handle.php'>
            <label>Github ID</label>
            <input name="git" type="text" placeholder="Github ID" value="<?php echo $git;?>"require></input><br>
            <label>Mail ID</label>
            <input name="mail" type="text" placeholder="Mail ID" value="<?php echo $mail;?>"require></input><br>
            <label>Facebook</label>
            <input name="face" type="text" placeholder="Facebook" value="<?php echo $face;?>"require></input><br>
            <label>Instagram</label>
            <input name="insta" type="text" placeholder="Instagram" value="<?php echo $insta;?>"require></input><br>
            <label>Codechef</label>
            <input name="chef" type="text" placeholder="Codechef" value="<?php echo $chef;?>"require></input><br>
            <label>Codeforces</label>
            <input name="force" type="text" placeholder="Codeforces" value="<?php echo $force;?>"require></input><br>
            <label>LinkedIN</label>
            <input name="in" type="text" placeholder="LinkedIN" value="<?php echo $in;?>"require></input><br>
            <label>Hackerrank</label>
            <input name="rank" type="text" placeholder="Hackerrank" value="<?php echo $rank;?>"require></input><br>
            <label>Hackerearth</label>
            <input name="earth" type="text" placeholder="Hackerearth" value="<?php echo $earth;?>"require></input><br>
            <label>Twitter</label>
            <input name="twi" type="text" placeholder="Twitter" value="<?php echo $twi;?>"require></input><br>

            <input name="submit" type="submit" value="Save"></input>
        </form>
        
    </body>
</html>