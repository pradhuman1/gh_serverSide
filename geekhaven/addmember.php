<?php
    require "../database/member_info.php";
    session_start();
    $cookie_name = $_SESSION['member_id'];
    $t = $_SESSION['time'];
    if(isset($_COOKIE[$cookie_name])){
        if($_COOKIE[$cookie_name]==$t + ($t%2408) + $cookie_name){
            echo "welcome Admin";
        }else if($_COOKIE[$cookie_name]==$t + $cookie_name){
            header('location:home.php');
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

    </head>
    <body>
        <form method="post" action='../data_game/savemem.php'>  
            <label>Username</label>
            <input name="username" type="text" placeholder="username" require></input><br>
            <label>Password</label>            
            <input name="password" type="password" placeholder=password require></input><br>
            <label>Confirm Password</label>            
            <input name="cpassword" type="password" placeholder="confirm password" require></input><br>
            <label>Session</label>            
            <input name="session" type="text" placeholder="Session" require></input><br>
            <label>Wing</label>            
            <select name="wing">
                <option selected="selected">Choose one</option>
                <?php
                    $query = 'SELECT * FROM wings';
                    $result = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($result)){
                        $wing =$row['wing'];
                        ?>
                        <option value="<?php echo $wing; ?>"><?php echo $wing; ?></option>
                        <?php
                    }
                ?>
                <br>
            </select><br>
            <input name="add_btn" type="submit" value="add member"></input>
            <?php

            // echo time()*1000;

            ?>
        </form>
        <h2>Remove Member</h2>
        <form method="post" action='../data_game/savemem.php'>  
            <select name="members">
                    <option selected="selected">Choose one</option>
                    <?php
                        $query = 'SELECT * FROM credentials';
                        $result = mysqli_query($connection,$query);
                        while($row = mysqli_fetch_assoc($result)){
                            $member_id =$row['member_id'];
                            $query = "SELECT * FROM member WHERE `member_id`='$member_id'";
                            $query_run = mysqli_query($connection,$query);
                            $res = mysqli_fetch_assoc($query_run);
                            $name =$res['name'];
                            ?>
                            <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
                            <?php
                        }
                    ?>
                    <br>
                <input name="select_mem_btn" type="submit" value="Remove"> </input><br>   
            </select>

        </form>
        <br><br>

        <h2>Remove Past Member</h2>
        <form method="post" action='../data_game/savemem.php'>  
            <select name="past_members">
                    <option selected="selected">Choose one</option>
                    <?php
                        $query = 'SELECT * FROM past_members';
                        $result = mysqli_query($connection,$query);
                        while($row = mysqli_fetch_assoc($result)){
                            $name =$row['name'];
                            ?>
                            <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
                            <?php
                        }
                    ?>
                    <br>
                <input name="remove_past_mem_btn" type="submit" value="Remove"> </input><br>   
            </select>

        </form>
        <br><br>

        <form method= 'post' action='home.php'>
            <input type='submit' value='home'>
        </form>

    </body>
</html>