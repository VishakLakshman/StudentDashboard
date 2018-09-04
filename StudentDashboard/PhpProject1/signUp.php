<?php
echo 'inside php';
require('connectToDb.php');
function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}
    if (isset($_POST['firstName']) and isset($_POST['lastName']) and isset($_POST['email']) and isset($_POST['dob']) and isset($_POST['age']) and isset($_POST['phone'])){
    debug_to_console('inside if');
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    
    echo $_POST['personType'];
    
    if(isset($_POST['personType']))
        {
        
        
        $personType = $_POST['personType'];
        if($personType == 'Student'){
            $year = $_POST['year'];
            $on_campus = $_POST['on_campus'];
            $major = $_POST['major'];
            $minor = $_POST['minor'];
            $adviser = $_POST['adviser'];
            
            try{
                
              $query = "INSERT INTO student (FirstName, LastName, Email,Dob,Age,Phone,Year,OnCampus,MajorCode,MinorCode,Advisor) VALUES "
                    . "( '$firstName' , '$lastName' ,'$email', '$dob','$age','$phone','$year','$on_campus','$major','$minor','$adviser')";
            echo 'query';
            $result = mysqli_query($connection, $query) or die(mysqli_error($connection)); 
            echo 'after execution';
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
            
            
            echo 'in if block';
        } else {

            echo 'in else block';
        }
    }else{
        echo 'in inner else block';
    }
}


