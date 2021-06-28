<nav class="top-nav">

    <ul>

        <li>
            <a href="<?php echo URLROOT; ?>/pages/index">Home</a>
        </li>
        <li>
            <a href="<?php echo URLROOT; ?>/pages/index">About</a>
        </li>
        <li>
            <a href="<?php echo URLROOT; ?>/posts/index">Blog</a>
        </li>
        <li>
            <a href="<?php echo URLROOT; ?>/pages/index">Contact</a>
        </li>
        <li class="btn-login">
            <!-- alternate login button to logout depending on session state -->
            <?php if (isset($_SESSION['user_id'])) : ?>
                <a href="<?php echo URLROOT; ?>/users/logout">Logout</a>

            <?php else : ?>
                <a href="<?php echo URLROOT; ?>/users/login">Sign In</a>
            <?php endif; ?>

        </li>
    </ul>


</nav>