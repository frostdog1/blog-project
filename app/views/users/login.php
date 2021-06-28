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
        <h2>Login</h2>


        <!-- POST used as sensitive info i.e. password cannot be in URL -->
        <form action="<?php echo URLROOT; ?>/users/login" method="POST">
            <input type="text" placeholder="Username" name="username">
            <span class="invalidFeedback">
                <?php
                // whenever a user enters invalid username, give error message
                echo $data['usernameError'];
                ?>
            </span>

            <input type="password" placeholder="Password" name="password">
            <span class="invalidFeedback">
                <?php
                // whenever a user enters invalid username, give error message
                echo $data['passwordError'];
                ?>
            </span>

            <button id="submit" type="submit" value="submit">Sign In</button>

            <p class="options">Not registered? <a href="<?php echo URLROOT; ?>/users/register">Sign Up!</a></p>

        </form>

    </div>

</div>