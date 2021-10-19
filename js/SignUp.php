
<?php
include_once 'database/database.php';
$error=null;


if(isset($_POST['submit'])){
$email=$_POST['email'];
$pass=$_POST['password'];
$pass2=$_POST['password2'];

if (strpos($email,'@')!=true)
{
    $error="<p>Enter valid email</p>";
}
else if($pass!=$pass2){
    $error.="<p>passwords donot match</p>";
}
else{
    //All tests passed.
    $email=$mysqli->real_escape_string($email);
    $pass=$mysqli->real_escape_string($pass);
    $pass2=$mysqli->real_escape_string($pass2);

    //generate vkey
    $vkey=md5($time.$email);
    echo$vkey;

}

}

?>
