<? php
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
      $message = "message sent successfully";
    } else {
     $error ="Something went wrong. Please try again later.";
    }

}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Contact Us</title>
    <!-- Font awesome -->
    <!-- <link href="font-awesome.css" type='text/css' rel="stylesheet"> -->
    <!-- <link href="css/animate.css" rel="stylesheet"> -->

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
    <link rel="stylesheet"type="text/css" href="css/about.css">
    

    <style>
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke=' #008000 ' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }

        .navbar-toggler {
            border-color: #008000;
        }
    </style>
</head>


<body>
    <nav class="navbar navbar-expand-md text-white navbar-light">
        <div class="container">
            <a class="navbar-brand" href="index.html"><img src="css/img/nav.png" id='logo' alt="Brand"></a>
            <button class="navbar-toggler bg-white" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                <span class="navbar-toggler-icon text-white"></span>
            </button>
            <div class="collapse navbar-collapse text-white" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.html">ABOUT</a>
                    </li>
                    <li class="nav-item">
						<a class="nav-link" href="howto.html">TIPS</a>
					</li>
                    <li class="nav-item">
						<a class="nav-link" href="FAQ.html">FAQ</a>
					</li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="signup.php">REGISTER</a>
                    </li>                 -->
                    <li class="nav-item">
                        <a class="nav-link" href="signin.php">SIGN IN</a>
                    </li>                
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5" class="animate-bottom">
        <div class="text-content">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <h2 class="pt-3">About Us</h2>
                    <img src="css/img/networth.png" id='circle' class='img-flud' alt="">
                    <p>Charites Finance is a start up that aims to create a stable financial life
                        for its users. We are
                        interested in helping you have a knowledge of your current financial status and assist you in
                        maximizing your money for a secure future.</p>
                </div>

                <div class="col-md-6">
                    <h2 class="pt-3">Contact Us</h2>
                    <?php
                    if(!empty($messages)){
                        echo "<div  class='alert-success'>";
                        echo $messages;
                        echo "</div>";
                    }
                    if(!empty($error)){
                        echo "<div  class='alert-danger'>";
                        echo $error;
                        echo "</div>";
                    }
                    ?>
                    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST" id="form-contact">
                        <input type="text" class='field' name="name" placeholder="Your Name" required>
                        <input type="email" class="field" name="email" placeholder="Email Address" required>
                        <input type="text" class="field" name="number" placeholder="Telephone Number" required>
                        <textarea type="text" name="message" class="field area" id="" placeholder="Message"
                            required></textarea>
                        <button type="submit" name="submit" class='btn' value="send">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
   

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <h3 class=''>About Us</h3>
                    <p>Charites Finance is a start up that aims to create a stable financial life for its users. We are
                        interested in helping you have a knowledge of your current financial status and assist you in
                        maximizing your money for a secure future.</p>
                </div>
                <div class="col-md-4">
                    <h3 class=''>About the App</h3>
                    <p>This free calculator helps you get a view of your financial positon by adding the values of your
                        assets and substracting your liabilites.</p>
                </div>
                <div class="col-md-3">
                    <h3 class='      '>Contact Us</h3>
                    <address style="margin-bottom:30px;">
                        Team Charites <br>
                        3, Remote House,<br>
                        HNG Avenue, Nigeria <br>
                        +234-1111-0000 <br>
                        info@charitesfinance.com
                    </address>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                <p style='text-align: center' class='   rollIn'>
                    CharitesFinance.com &copy;  2019
                </p>
            </div>
            </div>
        </div>
        </footer>


    <script src="js/jquery.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/contact.js"></script>

</body>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
</html> 