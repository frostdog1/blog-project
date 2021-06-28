<?php
// include head
require APPROOT . '/views/includes/head.php';

?>

<div class="navbar dark">
    <?php
    require APPROOT . '/views/includes/nav.php';
    ?>

</div>

<div class="container">




    <?php // if user is not logged in there will be no create button for blog posts
    // as no session id

    if (isLoggedIn()) : ?>

        <a class="btn green" href="<?php echo URLROOT; ?>/posts/create">
            New Post
        </a>

    <?php endif; ?>



    <?php
    // looping through posts and send
    // each title to the view


    foreach ($data['posts'] as $post) : ?>

        <div class="container-item">
            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post->user_id) : ?>
                <a class="btn orange" href="<?php echo URLROOT . "/posts/update/" . $post->id ?>">
                    Update Post
                </a>

                <form action="<?php echo URLROOT . "/posts/delete/" . $post->id ?>" method="POST">
                    <input type="submit" , name="delete" value="Delete" class="btn red">
                </form>
            <?php endif; ?>
            <h2>
                <?php echo $post->title ?>
            </h2>

            <h3>
                <?php echo 'Created on: ' . date('j F h:m', strtotime($post->created_at)) ?>
            </h3>

            <p>
                <?php echo $post->body ?>
            </p>
        </div>

    <?php endforeach; ?>




</div>