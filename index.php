<?php
include_once "connection.php";

if (isset($_POST["sub"])) {
    if (isset($_POST["fullname"]) && isset($_POST["email"]) && isset($_POST["num"]) && isset($_POST["date"]) && isset($_POST["carrer"]) && isset($_POST["state"]) && isset($_POST["nation"]) && isset($_POST["school"]) && isset($_POST["qual"]) && isset($_POST["work"]) && isset($_POST["skil"]) && isset($_POST["hobby"]) && isset($_POST["refer"])) {
        $full = mysqli_real_escape_string($conn, $_POST["fullname"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $num = mysqli_real_escape_string($conn, $_POST["num"]);
        $date = mysqli_real_escape_string($conn, $_POST["date"]);
        $carr = mysqli_real_escape_string($conn, $_POST["carrer"]);
        $sta = mysqli_real_escape_string($conn, $_POST["state"]);
        $nation = mysqli_real_escape_string($conn, $_POST["nation"]);
        $scho = mysqli_real_escape_string($conn, $_POST["school"]);
        $qual = mysqli_real_escape_string($conn, $_POST["qual"]);
        $work = mysqli_real_escape_string($conn, $_POST["work"]);
        $skil = mysqli_real_escape_string($conn, $_POST["skil"]);
        $hobby = mysqli_real_escape_string($conn, $_POST["hobby"]);
        $ref = mysqli_real_escape_string($conn, $_POST["refer"]);


        if (filter_var("$email, FILTER_VALIDATE_EMAIL")) {
            $email_erro = "Invalid email Address!";
        }
        if (filter_var("$num, FILTER_VALIDATE_INT")) {
            $num_error = "Number should be intergers only!";
        }
        $sq2 = "SELECT * FROM form WHERE phone = '$num'";
$ret = mysqli_query($conn,$sq2);
        $sql = "SELECT * FROM form WHERE email = '$email'";
        $rest = mysqli_query($conn,$sql);
        if(mysqli_num_rows($rest) ==1 ){
            echo "Email Already Exist.....!";
        }elseif(mysqli_num_rows($ret) == 1){
            echo "Phone Number Already Exist....!"; 
        }else{
            $sql = "INSERT INTO form (fullname,career,date_birth,phone,email,state,school,quali,Nation,work,skill,hobby,refere) VALUES('$full','$carr','$date','$num','$email','$sta','$scho','$qual','$nation','$work','$skil','$hobby','$ref') ";
            $sql1 = mysqli_query($conn,$sql);
            // print_r(mysqli_error_list($conn));
            if($sql1){
                echo "Your Resum has been Submitted Sucessfully!";
            }else{
                echo "error";
            }
        }
       
    } else {
        echo "NO";
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>

<body>
    <div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
            FULLNAME: <input type="text" name="fullname" placeholder="FULLNAME"><br><br>
            EMAIL: <input type="email" name="email" placeholder="EMAIL"><br><br>
            PHONE: <input type="number" name="num" placeholder="PHONE"><br><br>
            DATE OF BIRTH: <input type="date" name="date" placeholder="Date Of Birth"><br><br>
            CARREER OBJECTIVES: <input type="text" name="carrer" placeholder="Carrer Objective"><br><br>
            STATE:<select name="state">
                <?php
                $se = "SELECT * FROM states";
                $re = mysqli_query($conn, $se);
                while ($row = mysqli_fetch_assoc($re)) {
                ?>
                    <option value="<?php echo $row["id"] ?>"><?php echo $row["name"] ?></option>
                <?php
                }
                ?>
            </select><br><br>
            NATIONALITY: <input type="text" name="nation" placeholder="Nationality"><br><br>
            SCHOOLS: <input type="text" name="school" placeholder="Schools Attended"><br><br>
            ACADEMIC QUALIFICATIONS:<input type="text" name="qual" placeholder="Academic Qualifications"><br><br>
            WORK EXPERIENCES: <input type="text" name="work" placeholder="Work Experiences"><br><br>
            SKILLS: <input type="text" name="skil" placeholder="Skills"><br><br>
            HOBBY: <input type="text" name="hobby" placeholder="Hobby/Interests"><br><br>
            REFEREES:<input type="text" name="refer" placeholder="Refrence"><br><br>
            <button type="submit" name="sub">Submit Form</button>
        </form>
    </div>
</body>

</html>