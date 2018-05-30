<?php include APPROOT . '\views\inc\header.php'; ?>
    <div class="row">
        <h1 class="col">Posts</h1>
        <div class="col">
            <a class="btn btn-primary pull-right" href="<?php echo APPURL . '/posts/add'; ?>">
                <i class="fa fa-pencil"></i> Add Post
            </a>
        </div>
    </div>
    <div class="row"><div class="col-12"><?php msg('post_added'); ?></div></div>
    <div class="row">
        <?php foreach($data['posts'] as $posts) : ?>
            <div class="col-sm-6 mt-3">
                <div class="card bg-light">
                    <div class="card-header">
                        <h6 class="card-title"><?php echo $posts->title; ?></h6>
                        <p class="card-text"><strong>Created by:</strong> <?php echo $posts->username; ?> - <strong>On</strong> <?php echo $posts->postCreated; ?></p>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?php echo $posts->body; ?></p>
                    </div>
                    <div class="card-footer">
                        <a href="<?php echo APPURL . '/posts/show/' . $posts->postId; ?>" class="btn btn-success btn-block">Read More ...</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php include APPROOT . '\views\inc\footer.php'; ?>