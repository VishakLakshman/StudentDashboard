<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sign-Up/Login Form</title>
        <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">  
        <link rel="stylesheet" href="style.css">

    </head>
    <body>
        <?php
        // put your code here
        
        require('connectToDb.php');
        ?>


        <div class="form" >

            <ul class="tab-group">
                <li class="tab active"><a href="#signup">Sign Up</a></li>
                <li class="tab"><a href="#login">Log In</a></li>
            </ul>

            <div class="tab-content">
                <div id="signup">   
                    <h1>Sign Up for Free</h1>

                    <form action="signUp.php" method="post">

                        <div class="top-row">
                            <div class="field-wrap">
                                <label>
                                    First Name<span class="req">*</span>
                                </label>
                                <input name="firstName" type="text" required autocomplete="off" />
                            </div>

                            <div class="field-wrap">
                                <label>
                                    Last Name<span class="req">*</span>
                                </label>
                                <input name="lastName"type="text" required autocomplete="off"/>
                            </div>
                        </div>

                        <div class="field-wrap">
                            <label>
                                Email Address<span class="req">*</span>
                            </label>
                            <input name="email"type="email" required autocomplete="off"/>
                        </div>

                        <div class="top-row">
                            <div class="field-wrap divideBy3" style="width:33%">
                                <label>
                                    Date of Birth<span class="req">*</span>
                                </label>
                                <input type="text" name="dob" required autocomplete="off"/>                        
                            </div>

                            <div class="field-wrap divideBy3" style="width:25%">
                                <label>
                                    Age<span class="req">*</span>
                                </label>
                                <input type="text" name="age" required autocomplete="off"/>                        
                            </div>

                            <div class="field-wrap divideBy3" style="width:33%">
                                <label>
                                    Phone<span class="req">*</span>
                                </label>
                                <input type="text"name="phone"required autocomplete="off"/>                        
                            </div>               
                        </div>                         

                        <div class="top-row">
                            <div class="field-wrap">

                                <input style="width:10%; display:inline" type="radio" name="personType" value="Student" onclick="handleClick(this)"> 
                                <label style="margin-left:20px;margin-top: -8px; ">Student</label>


                            </div>
                            <div class="field-wrap">
                                <input style="width:10%; display:inline" type="radio" name="personType" value="Faculty" onclick="handleClick(this)">
                                <label style="margin-left:20px;margin-top: -8px; ">Faculty</label>

                            </div>
                        </div>



                        <div id="student" style="display: none">
                            <div class="top-row">
                                <div class="field-wrap">
                                    <select name="year" required style="color: rgba(255, 255, 255, 0.5);">
                                        <option value="year"><label>Select Year</label><span class="req">*</span></option> 
                                        <option value="1"><label>1st</label></option>
                                        <option value="2"><label>2nd</label></option> 
                                        <option value="3"><label>3rd</label></option>
                                        <option value="4"><label>4th</label></option>

                                    </select>

                                </div>

                                <div class="field-wrap">
                                    <select name="on_campus" required style="color: rgba(255, 255, 255, 0.5);">
                                        <option value="volvo"><label>On Campus</label><span class="req">*</span></option>
                                        <option value="1"><label>Yes</label></option>
                                        <option value="0"><label>No</label></option>
                                    </select>
                                </div>
                            </div>



                            <div class="top-row">

                                <div class="field-wrap divideBy3" style="width:33%">
                                    <select name="major" required style="color: rgba(255, 255, 255, 0.5);">
                                        <option value="volvo"><label>Major</label><span class="req">*</span></option>
                                        <?php
                                        //require('connectToDb.php');
                                        $sql = mysqli_query($connection, "SELECT DISTINCT MajorName FROM Major");
                                        while ($row = $sql->fetch_assoc()) {
                                            echo "<option value='". $row['MajorCode'] ."'><label>".$row['MajorName'] . "</label></option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="field-wrap divideBy3" style="width:25%">
                                    <select name="minor" required style="color: rgba(255, 255, 255, 0.5);">
                                        <option value="volvo"><label>Minor</label><span class="req">*</span></option>
                                        <?php
                                        //require('connectToDb.php');
                                        $sql = mysqli_query($connection, "SELECT DISTINCT MinorName FROM Minor");
                                        while ($row = $sql->fetch_assoc()) {
                                            echo "<option value='". $row['MinorCode'] ."'><label>" . $row['MinorName'] . "</label></option>";
                                        }
                                        ?>

                                    </select>

                                </div>

                                <div class="field-wrap divideBy3" style="width:33%">
                                    <select name="adviser" required style="color: rgba(255, 255, 255, 0.5);">
                                        <option value="volvo"><label>Advisor</label><span class="req">*</span></option>
                                        <?php
                                        //require('connectToDb.php');
                                        $sql = mysqli_query($connection, "SELECT DISTINCT FirstName, LastName FROM FacultyAdviser");
                                        while ($row = $sql->fetch_assoc()) {
                                            echo "<option value='". $row['ID'] ."'><label>". $row['FirstName'] . $row['LastName'] . "</label></option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>

<!--                        <div id="faculty" style="display: none">

                            <div class="top-row">
                                <div class="field-wrap">
                                    <label>
                                        Highest Degree<span class="req">*</span>
                                    </label>
                                    <input id="degree" name="degree" type="text" required autocomplete="off"/>
                                </div>

                                <div class="field-wrap">
                                    <select name="department" style="color: rgba(255, 255, 255, 0.5);">
                                        <option value="volvo"><label>Department</label><span class="req">*</span></option>
                                        <?php
                                        //require('connectToDb.php');
                                        $sql = mysqli_query($connection, "SELECT DISTINCT DepartmentName FROM Department");
                                        while ($row = $sql->fetch_assoc()) {
                                            echo "<option value'". $row['DepartmentName'] ."'><label>" . $row['DepartmentName'] . "</label></option>";
                                        }
                                        ?>
                                    </select>
                                </div>


                            </div>
                        </div>-->


                        <div class="field-wrap">
                            <label>
                                Set A Password<span class="req">*</span>
                            </label>
                            <input id="password" name="password" type="password"required autocomplete="off"/>
                        </div>




                        <button type="submit" class="button button-block"/>Get Started</button>

                    </form>

                </div>

                <div id="login">   
                    <h1>Welcome Back!</h1>

                    <form action="logIn.php" method="post">

                        <div class="field-wrap">
                            <label>
                                User Name<span class="req">*</span>
                            </label>
                            <input id="username" name="username" type="text"required autocomplete="off"/>
                        </div>

                        <div class="field-wrap">
                            <label>
                                Password<span class="req">*</span>
                            </label>
                            <input id="password" name="password" type="password"required autocomplete="off"/>
                        </div>

                        <button class="button button-block"/>Log In</button>

                    </form>

                </div>

            </div><!-- tab-content -->

        </div> <!-- /form -->

        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="index.js"></script>
    </body>
</html>
