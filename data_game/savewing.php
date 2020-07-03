<?php
    require "../database/wingsdb.php";    
    session_start();
?>

<?php
        if(isset($_POST['add_btn'])){
            $wing = $_POST['wing'];
            $info = $_POST['info'];
            $logo = $_POST['logo'];
            $wing_id = time()*1000;
            $query = "SELECT * FROM wings WHERE wing='$wing'" ;
            $query_run = mysqli_query($connection,$query);       
            if(mysqli_num_rows($query_run)>0){
                echo 'WING ALREADY EXIST';
            }else{
                $query = "INSERT INTO wings VALUES('$wing_id','$wing','$info','$logo')" ;
                $query_run = mysqli_query($connection,$query); 
                header('location:../geekhaven/wing.php'); 
            }   
        }

        if(isset($_POST['update_btn'])){
            $wing_id = $_SESSION['wingID'];
            $wing = $_POST['new_wing'];
            $info = $_POST['new_info'];
            $logo = $_POST['new_logo'];
            
            $query = "UPDATE wings SET `wing`='$wing',`info`='$info',`logo`='$logo' WHERE `wing_id`='$wing_id'" ;  
            $query_run = mysqli_query($connection,$query);
            echo 'Updated successfully';
            header('location:../geekhaven/wing.php');     
                  
        }
        if(isset($_POST['remove_btn'])){
            $wing_id = $_SESSION['wingID'];
            $wing = $_POST['new_wing'];
            $info = $_POST['new_info'];
            $logo = $_POST['new_logo'];
            
            $query = "DELETE FROM wings WHERE `wing_id`='$wing_id'" ;  
            $query_run = mysqli_query($connection,$query);
            header('location:../geekhaven/wing.php');     
                  
        }
?>