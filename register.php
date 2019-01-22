<?php
    include("includes/config.php");
    include("includes/classes/account.php");
    include("includes/classes/constants.php");

    $account = new Account($con);

    include("includes/handlers/register-handler.php");
    include("includes/handlers/login-handler.php");

    function getInputValue($name){
        if(isset($_POST[$name])){
            echo $_POST[$name];
        }
    }
?>

<html>
<head>
	<title>Welcome to Spotify!</title>

    <link rel="stylesheet" type="text/css" href="assets/css/register.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="assets/js/register.js"></script>

</head>
<body>
    <?php
        if(isset($_POST['registerButton'])) {
            echo '<script>
                        $(document).ready(function() {
         
                            $("#loginForm").hide();
                            $("#registerForm").show();
                
                        });
                  </script>';
        }
        else{
	        echo '<script>
                        $(document).ready(function() {
         
                            $("#loginForm").show();
                            $("#registerForm").hide();
                
                        });
                  </script>';
        }
    ?>


    <div id="background">

        <div id="loginContainer">

            <div id="inputContainer">
                <form id="loginForm" action="register.php" method="POST">
                    <h2>Login to your account</h2>
                        <p>
                            <?php echo $account->getError(constants::$loginFailed); ?>
                            <label for="loginUserName">Username</label>
                            <input id="loginUserName" name="loginUserName" type="text" placeholder="e.g Viktor2003" value="<?php getInputValue('loginUserName') ?>" required> <!-- Give placeholder for example to users -->
                        </p>
                            <p>
                                <label for="loginPassword">Password</label> <!-- Label used when I pick Password(String) my mouse,before that I click for him,I can writing to line -->
                                <input id="loginPassword" name="loginPassword" type="password" placeholder="Your password" required>
                            </p>

                            <button type="submit" name="loginButton">Log in</button>

                    <div class="hasAccountText">
                        <span id="hideLogin">Don't have an account yet? Signup here.</span>
                    </div>

                </form>


                <form id="registerForm" action="register.php" method="POST">
                    <h2>Create your free account</h2>
                        <p>
                            <?php echo $account->getError(constants::$userNameCharacters); ?>
                            <?php echo $account->getError(constants::$userNameTaken); ?>
                            <label for="userName">Username</label>
                            <input id="userName" name="userName" type="text" placeholder="e.g Viktor2003" value="<?php getInputValue('userName') ?>" required> <!-- Give placeholder for example to users("value for save parameters when error in form filling) -->
                        </p>

                            <p>
                                <?php echo $account->getError(constants::$firstNameCharacters); ?>
                                <label for="firstName">First name</label>
                                <input id="firstName" name="firstName" type="text" placeholder="e.g Viktor" value="<?php getInputValue('firstName') ?>" required> <!-- Give placeholder for example to users -->
                            </p>

                                <p>
                                    <?php echo $account->getError(constants::$lastNameCharacters); ?>
                                    <label for="lastName">Last name</label>
                                    <input id="lastName" name="lastName" type="text" placeholder="e.g Pavlyshyn" value="<?php getInputValue('lastName') ?>" required> <!-- Give placeholder for example to users -->
                                </p>

                            <p>
                                <?php echo $account->getError(constants::$emailInvalid); ?>
                                <?php echo $account->getError(constants::$emailTaken); ?>
                                <label for="email">Email</label>
                                <input id="email" name="email" type="email" placeholder="e.g Viktor2003@gmail.com" value="<?php getInputValue('email') ?>" required> <!-- Give placeholder for example to users -->
                            </p>
                        <p>
                            <?php echo $account->getError(constants::$passwordsDoNoMatch); ?>
                            <?php echo $account->getError(constants::$passwordsNoAlphanumeric); ?>
                            <?php echo $account->getError(constants::$passwordsCharacters); ?>
                            <label for="password">Password</label> <!-- Label used when I pick Password(String) my mouse,before that I click for him,I can writing to line -->
                            <input id="password" name="password" type="password" placeholder="Your password" required>
                        </p>

                    <p>
                        <label for="password2">Confirm password</label> <!-- Label used when I pick Password(String) my mouse,before that I click for him,I can writing to line -->
                        <input id="password2" name="password2" type="password" placeholder="Your password" required>
                    </p>

                    <button type="submit" name="registerButton">Sing up</button>

                    <div class="hasAccountText">
                        <span id="hideRegister">Already have an account? Log in here.</span>
                    </div>

                </form>
            </div>

            <div id="loginText">
                <h1>Get great music, right now</h1>
                <h2>Listen to loads of songs for free </h2>
                <ul>
                    <li>Discover music you'll fall in love with</li>
                    <li>Create your own playlists</li>
                    <li>Follow artists to keep up to date</li>
                </ul>
            </div>

        </div>
    </div>
</body>
</html>