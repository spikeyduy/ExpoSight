<?php
/*
 * This should be protected via authentication and only authorize those who
 * know the password.
 * This will allow an admin to log in and post new content.
 */
//include('databaseConn.php');
if(isset($_POST['submit'])){
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $content = $_POST['content'];

    $error = "";

    // should decide on an encryption method
    // Need to make sure that people can't drop table and all that jazz
    $encryptedPass = SHA1($pass);
    // Don't know if I should be escaping these strings
    // $encryptedPass = $mysqli->real_escape_string($encryptedPass);
    // Should repeat for the rest of the forms !!!!
    // Gets the authentication data to compare
    $authCheck = "SELECT * FROM `users` WHERE username = `admin`";
    $result = $mysqli->query($authCheck);
    $authRows = $result->fetch_array(MYSQLI_ASSOC);
    // CHeck username is correct
    if($name == "" || $name != $authRows['username']){
        $error .= "* Wrong username"."<br/>";
    }
    // Check if password is correct
    if($pass == "" || $pass != $authRows['password']){
        $error .= "* Wrong Password"."<br/>";
    }
    if($error == ""){
        $addNewPost = "INSERT INTO `posts` (content) VALUES ($content)";
        if($mysqli->query($addNewPost) == TRUE){
            echo "You have successfully posted a new sight!";
        } else {
            echo "Something went wrong";
        }
    }
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Exponential Sight | Post a new Sight</title>
        <meta name="description" content="Add a new Sight">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <header>
            <div class="head">
                <div class="title">
                    <h1>Exponential Sight</h1>
                </div>
                <div class="navBar">
                    <ul>
                        <li><a href="home.html">Home</a></li>
                        <li><a href="about.html">About Me</a></li>
                        <li><a href="archive.html">Archive</a></li>

                    </ul>
                </div>
            </div>
        </header>
        <h1>Add a new Sight</h1>
        <!--Where admin will be able to input a new post and sign it-->
        <form action = "" method = "post">
            <table id="form">
                <tr>
                    <td class="label">* Username</td>
                    <td><input type="text" name="user"></td>
                </tr>
                <tr>
                    <td class="label">* Password</td>
                    <td><input type="password" name="pass"></td>
                </tr>
                <tr>
                    <td class="label">* Post</td>
                    <td><textarea name="content" cols="50" rows="10"></textarea></td>
                </tr>
                <tr>
                    <td colspan="2" id="submit"><input type="submit" name="submit" value="Submit"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php
                            if(isset($error)){
                                echo $error;
                            }
                        ?>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>

