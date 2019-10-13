<-- // <?php
// $con = mysqli_connect('sql12.freemysqlhosting.net','sql12308286', 'ZwVT4iplj3');
// mysqli_select_db($con,'sql12308286');

// $messages='';
// $error='';



// // Processing form data when form is submitted
// if(isset($_POST['submit'])){

//     $name = trim($_POST["name"]);
//     $email = trim($_POST["email"]);
//     $phone = trim($_POST["number"]);
//     $message = trim($_POST["message"]);

// if(empty($name)){
//    $error='name field cant be empty';
// }
// elseif (empty($email)){
//     $error='Mail field Cant be empty';
// }
// elseif(empty($phone)){
//    $error='Phone Field cant be empty';
// }
// elseif (empty($message)){
//     $error='message field cant be empty';
// }
// elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)){
//     $error='Invalid Email Address';
// }
// else {


//     $sql = "INSERT INTO contact (`name`,`email`,`phone`,`message`) VALUES (?, ?, ?, ? )";
//     $stmt = mysqli_prepare($con, $sql);
//     mysqli_stmt_bind_param($name,$email,$phone,$message);
//     if(mysqli_stmt_execute($stmt)){
//         $messages='message sent succesfully';
//     }
//     else{
//         $error="Something went wrong. Please try again later.";
//     }
// }
// }
?>
 -->


<?php
$servername = "sql12.freemysqlhosting.net";
$database = "sql12308286"; 
$username = "sql12308286";
$password = "ZwVT4iplj3";
$sql = "mysql:host=$servername;dbname=$database;";
$dsn_Options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];


// Create a new connection to the MySQL database using PDO, $my_Db_Connection is an object
try { 
  $my_Db_Connection = new PDO($sql, $username, $password, $dsn_Options);
  echo "Connected successfully";
} catch (PDOException $error) {
  echo 'Connection error: ' . $error->getMessage();
}
// Processing form data when form is submitted
if(isset($_POST['submit'])){

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["number"]);
    $message = trim($_POST["message"]);

if(empty($name)){
   $error='name field cant be empty';
}
elseif (empty($email)){
    $error='Mail field Cant be empty';
}
elseif(empty($phone)){
   $error='Phone Field cant be empty';
}
elseif (empty($message)){
    $error='message field cant be empty';
}
elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $error='Invalid Email Address';
}
else {

    // Here we create a variable that calls the prepare() method of the database object
    // The SQL query you want to run is entered as the parameter, and placeholders are written like this :placeholder_name
    $my_Insert_Statement = $my_Db_Connection->prepare("INSERT INTO contact (`name`,`email`,`phone`,`message`) VALUES (?,?,?)");
    
    // Now we tell the script which variable each placeholder actually refers to using the bindParam() method
    // First parameter is the placeholder in the statement above - the second parameter is a variable that it should refer to
    $my_Insert_Statement->bind_param('ssis',$name,$email,$phone,$message); 
    // $my_Insert_Statement->bindParam(:full_name, $name);
    // $my_Insert_Statement->bindParam(:email, $email);
    // $my_Insert_Statement->bindParam(:phone, $phone);
    // $my_Insert_Statement->bindParam(:message, $message);
    
    // Execute the query using the data we just defined
    // The execute() method returns TRUE if it is successful and FALSE if it is not, allowing you to write your own messages here
    if ($my_Insert_Statement->execute()) {
      echo "New record created successfully";
    } else {
      echo "Unable to create record";
    }

}
