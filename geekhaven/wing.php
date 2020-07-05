<?php
    require "../database/wingsdb.php";    
    session_start();
    $cookie_name = $_SESSION['member_id'];
    $t = $_SESSION['time'];
    if(isset($_COOKIE[$cookie_name])){
        if($_COOKIE[$cookie_name]==$t + ($t%2408) + $cookie_name){
            echo "welcome Admin";
        }else if($_COOKIE[$cookie_name]==$t + $cookie_name){
            echo "welcome member";
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
        <h1>Add Wing</h1>
    </head>
    <body>
    <form method="post" action='../data_game/savewing.php'>  
        <label>Wing Name</label>
        <input name="wing" type="text" placeholder="wing name" require></input><br>
        <label>Information</label>            
        <input name="info" type="text" placeholder=information require></input><br>
        <label>Logo</label>            
        <input name="logo" type="text" placeholder="logo" require></input><br>
        <input name="add_btn" type="submit" value="Add Wing"></input>
    </form>
    <br><br>

    <h1>Update/Remove Wing</h1>
    <br>
    <form method="post">  
        <select name="wings">
            <option selected="selected">Choose one</option>
            <?php
                $query = 'SELECT * FROM wings';
                $result = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($result)){
                    $wing_id =$row['wing_id'];
                    $wing =$row['wing'];
                    
                    ?>
                    <option value="<?php echo $wing_id; ?>"><?php echo $wing; ?></option>
                    <?php
                }
            ?>
            <br>
        <input name="select_btn" type="submit" value="Go"> </input><br>   
        </select>

    </form>
    <?php
        if(isset($_POST['select_btn'])){
            $wingID = $_POST['wings'];
            $query = "SELECT * FROM wings WHERE wing_id='$wingID'";
            $query_run = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($query_run)){
                $wing_id =$row['wing_id'];    
                $_SESSION['wingID'] = $wing_id;            
                $wing =$row['wing'];
                $info =$row['info'];
                $logo =$row['logo'];    
            }
            ?>
            <form method='post' action='../data_game/savewing.php'>
                <label>Wing Name</label>
                <input name="new_wing" type="text" placeholder="wing name" value="<?php echo $wing; ?>" require ></input><br>
                <label>Information</label>            
                <input name="new_info" type="text" placeholder=information value="<?php echo $info; ?>"></input><br>
                <label>Logo</label>            
                <input name="new_logo" type="text" placeholder="logo" value="<?php echo $logo; ?>"></input><br>
                <input name="update_btn" type="submit" value="Update Wing"></input>
                <input name="remove_btn" type="submit" value="Remove Wing"></input>
                
            </form>
            <?php
        }

    ?>
    <br><br>
    <form method= 'post' action='home.php'>
        <input type='submit' value='home'>
    </form>
    </body>
</html>