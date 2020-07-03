<?php
    require "../database/member_info.php";
    session_start();
    $mem_id = $_SESSION['member_id'];
    $cookie_name = $mem_id;
    
    if(isset($_COOKIE[$cookie_name])){
        header('location:home.php');
    }
?>

<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <form method="post">  
            <label>Username</label>
            <input name="username" type="text" placeholder="username" require></input><br>
            <label>Password</label>            
            <input name="password" type="password" placeholder=password require></input><br>

            <input name="add_btn" type="submit" value="Login"></input>
            <?php
            if(isset($_POST['add_btn'])){
                $username = $_POST['username'];
                $pass = $_POST['password'];
                $time = time()*1000;
                $query = "select * from credentials WHERE username='$username' AND password='$pass'"; 
                $query_run = mysqli_query($connection,$query);
                if(mysqli_num_rows($query_run)>0){
                    $result = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($result)){
                        $mem_id =$row['member_id'];
                        $admin = $row['admin_value'];
                    }
                    $_SESSION['member_id'] = $mem_id;
                    $_SESSION['time'] = $time;
                    
                    $cookie_name = $mem_id;
                    $cookie_value = $time+($time%2408)*($admin)+$mem_id;
                    setcookie($cookie_name,$cookie_value,time()+(86400*5));
                    echo $cookie_name;
                    echo $cookie_value;
                    header('location:home.php');
                }else{
                    echo 'INCORRECT loginID or password';
                }
            }
            // echo time()*1000;

            ?>
        </form>
    </body>
</html>