<?php
// include head
require APPROOT . '/views/includes/head.php';

?>

<div class="navbar">

    <?php
    // include head
    require APPROOT . '/views/includes/nav.php';

    ?>

</div>

<div class="container-login">
    <div class="wrapper-login">
        <h2>Register</h2>


        <!-- POST used as sensitive info i.e. password cannot be in URL -->
        <form id="register-form" action="<?php echo URLROOT; ?>/users/register" method="POST">
            <input type="text" placeholder="Username" name="username">
            <span class="invalidFeedback">
                <?php
                // whenever a user enters invalid username, give error message
                echo $data['usernameError'];
                ?>
            </span>

            <input type="text" placeholder="E-mail" name="email">
            <span class="invalidFeedback">
                <?php
                // whenever a user enters invalid username, give error message
                echo $data['emailError'];
                ?>
            </span>

            <input type="password" placeholder="Password" name="password">
            <span class="invalidFeedback">
                <?php
                // whenever a user enters invalid username, give error message
                echo $data['passwordError'];
                ?>
            </span>

            <input type="password" placeholder="Confirm Password" name="confirmPassword">
            <span class="invalidFeedback">
                <?php
                // whenever a user enters invalid username, give error message
                echo $data['confirmPasswordError'];
                ?>
            </span>

            <button id="submit" type="submit" value="submit">Sign Up</button>

            <p class="options">Already have an account? <a href="<?php echo URLROOT; ?>/users/login">Log In!</a></p>

        </form>

    </div>

</div>