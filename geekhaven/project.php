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
    <h1>Projects</h1><hr>
    </head>
    <body>
    <h2>Add Project</h2>
        <form method="post" >  
            Select Wing : 
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
                $_SESSION['wingID'] = $wingID;
                ?>
                <form method="post" action='../data_game/projectdata.php'>
                <label>Project Name</label>
                <input name="project_name" type="text" placeholder="Project name" require ></input><br>
                <label>Project Link</label>            
                <input name="pro_link" type="text" placeholder="Project Link" ></input><br>
                <label>Blog Link</label>            
                <input name="blog_link" type="text" placeholder="Blog Link" ></input><br>
                <label>Source Code Link</label>            
                <input name="source_code" type="text" placeholder="Source Code Link" ></input><br>
                <label>Description</label>            
                <input name="description" type="text" placeholder="Description" ></input><br>
                <label>Image</label>            
                <input name="image" type="text" placeholder="Image" ></input><br>
                <input name="add_project" type="submit" value="Add a Project" ></input>
            </form>
                <?php
            } 

        ?><br>
        <h2>Remove Project</h2>

        <form method="post" action='../data_game/projectdata.php'>  
            <select name="projects">
                    <option selected="selected">Choose one</option>
                    <?php
                        $query = 'SELECT * FROM Projects';
                        $result = mysqli_query($connection,$query);
                        while($row = mysqli_fetch_assoc($result)){
                            $name =$row['project_name'];
                            
                            ?>
                            <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
                            <?php
                        }
                    ?>
                    <br>
                <input name="select_pro_btn" type="submit" value="Remove"> </input><br>   
            </select>

        </form>

        <br><br>
        <form method= 'post' action='home.php'>
            <input type='submit' value='home'>
        </form>
        
    </body>
</html>