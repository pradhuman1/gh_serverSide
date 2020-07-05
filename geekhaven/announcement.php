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
        <h1>Announcements</h1><hr>
    </head>
    <body>
        <h2>Add announcement</h2>
        <form method='post' action='../data_game/announce.php'>
            <label>Announcement Title</label>
            <input name="name" type="text" placeholder="Title" require></input><br>
            <label>Organiser</label>            
            <input name="organiser" type="text" placeholder="organiser" ></input><br>
            <label>Venue</label>            
            <input name="venue" type="text" placeholder="venue" ></input><br>
            <label>Date</label>            
            <input name="date" type="text" placeholder="date" ></input><br>
            <label>Time</label>            
            <input name="time" type="text" placeholder="Time" ></input><br>
            <label>Topic</label>            
            <input name="topic" type="text" placeholder="Topic" ></input><br>
            <label>Details</label>            
            <input name="details" type="text" placeholder="details" ></input><br>
            <label>Link</label>            
            <input name="link" type="text" placeholder="link" ></input><br>
            <label>Attachment</label>            
            <input name="attach" type="text" placeholder="attachment" ></input><br>
            <label>Image</label>            
            <input name="image" type="text" placeholder="image" ></input><br>

            <input name="submit" type="submit" value="Submit"></input>
        </form>
        <hr>

        <h2>Remove Announcement</h2>

        <form method="post" action='../data_game/announce.php'>  
        <select name="announcements">
            <option selected="selected">Choose one</option>
            <?php
                $query = 'SELECT * FROM announcements';
                $result = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($result)){
                    $name =$row['name'];
                    
                    ?>
                    <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
                    <?php
                }
            ?>
            <br>
        <input name="select_btn" type="submit" value="Delete"> </input><br>   
        </select>

    </form>

    <br><br>
    <form method= 'post' action='home.php'>
        <input type='submit' value='home'>
    </form>

    </body>
</html>