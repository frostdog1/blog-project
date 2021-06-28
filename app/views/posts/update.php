<?php
require APPROOT . '/views/includes/head.php';
?>

<div class="navbar dark">
    <?php
    require APPROOT . '/views/includes/nav.php';
    ?>
</div>

<div class="container center">
    <h1>
        Update Post
    </h1>

    <!-- pass out the post id using controller-->
    <form action="<?php echo URLROOT; ?>/posts/update/<?php echo $data['post']->id ?>" method="POST">
        <div class="form-item">
            <input type="text" name="title" placeholder="Title..." value="<?php echo $data['post']->title ?>">

            <!-- echo out error if the title is invalid -->
            <span class="invalidFeedback">
                <?php echo $data['titleError']; ?>
            </span>
        </div>

        <!-- store the data from the post in the input fields -->
        <div class="form-item">
            <textarea name="body" placeholder="Enter your post...">
                <?php
                echo $data['post']->body;

                ?>
            </textarea>

            <span class="invalidFeedback">
                <?php echo $data['bodyError']; ?>
            </span>
        </div>

        <button class="btn green" name="submit" type="submit">Submit</button>
    </form>
</div>