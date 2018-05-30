<?php include APPROOT . '\views\inc\header.php'; ?>
    <a href="<?php echo APPURL, '/posts/index'; ?>" class="btn btn-light mb-3"><i class="fa fa-backward"></i> back</a>
    <div class="row">
        <div class="col-12 mt-3">
            <div class="card bg-light">
                <div class="card-header">
                    <h6 class="card-title"><?php echo $data['post']->title ?></h6>
                    <p class="card-text"><strong>Created by:</strong> <?php echo $data['user']->username; ?> - <strong>On</strong> <?php echo $data[ 'post' ]->created_at; ?></p>
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo $data[ 'post' ]->body; ?></p>
                </div>
                <?php if ( $_SESSION[ 'user_id' ] == $data[ 'post' ]->user_id ) : ?>
                <div class="card-footer">
                    <div class="row">
                        <div class="col">
                            <a href="<?php echo APPURL . '/posts/edit/' . $data[ 'post' ]->id; ?>" class="btn btn-primary">Edit</a>
                        </div>
                        <div class="col">
                            <form action="<?php echo APPURL . '/posts/delete/' . $data['post']->id; ?>" method="post">
                                <input type="submit" value="Delete" class="btn btn-danger pull-right">
                            </form>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php include APPROOT . '\views\inc\footer.php'; ?>