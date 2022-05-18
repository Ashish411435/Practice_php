<?php include 'db_connection.php';  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</head>

<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $name = $_POST['name'];
        $designation = $_POST['designation'];
        // echo $designation;

        if (!empty($name)) {
            // Validate password strength
            //   $up =(preg_match('@[a-z]@'),$name);


            // $uppercase = preg_match('@[A-Z]@', $name);
            // $lowercase = preg_match('@[a-z]@', $name);
            // $number    = preg_match('@[0-9]@', $name);
            // $specialChars = preg_match('@[^\w]@', $name);

            // if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($name) < 8) {
            //     echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
            // }else{
            //     echo 'Strong password.';
            // }

            //  $desg = password_hash($designation, PASSWORD_DEFAULT);     

             $lc = preg_match('@[a-z]@',$name);
             $uc = preg_match('@[A-Z]@',$name);
             $nc = preg_match('@[0-9]@',$name);
             $cc = preg_match('@[^/w]@',$name);
                 
             if(!$lc || !$uc || !$nc || !$cc || !strlen($name > 7)){
                 echo "Password not strong";
             }
             else{
                 echo "Password is strong";
             }


            // $sql= "INSERT INTO `logins`(`name`, `course`) VALUES ('$name', '$desg');";
            // $sql= "SELECT * FROM `logins` WHERE name='$name' AND course='$desg';";


            // $sql = "SELECT * FROM `logins` WHERE name='$name';";

            // $result = mysqli_query($con, $sql);

            // $count =   mysqli_num_rows($result);

            // if ($count > 0) {
            //     while ($row = mysqli_fetch_assoc($result)) {
            //         $hash = $designation;
            //         $hash_pass = $row['course'];
            //         // echo $hash_pass;
            //         if (password_verify($hash, $hash_pass)) {

            //             $ss = $row['name'];
            //             echo $ss;
            //             echo '<script>alert()</script>';
            //         }
            //     }

                // if ($result) {

                //     echo "ok";
                // } else {
                //     echo "not ok";
                // }
            }
        // }
    }

    ?>

    <div class="container mt-5">
        <form method="POST" action=<?php echo $_SERVER['PHP_SELF'];  ?>>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Enter Your Name</label>
                <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <br>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Your Designation</label>
                    <input name="designation" type="text" class="form-control" id="exampleInputPassword1">
                </div>
                <br>
                <!-- <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Your Salary</label>
    <input name="salary" type="text" class="form-control" id="exampleInputPassword1">
  </div> -->

                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


</body>

</html>