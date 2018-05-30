<?php include APPROOT . '\views\inc\header.php'; ?>
    <a href="<?php echo APPURL, '/posts/index'; ?>" class="btn btn-light mb-3"><i class="fa fa-backward"></i> back</a>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card bg-light">
                <div class="card-header text-center">
                    <h3><?php echo $data['title']; ?></h3>
                </div>
                <div class="card-body">
                    <form action="<?php echo APPURL, '/posts/add'; ?>" method="post">

                        <div class="form-group">
                            <label for="post_title">post_title: <sup class="text-danger">*</sup></label>
                            <input name="post_title" type="text" class="form-control form-control-lg <?php echo (!empty($data['post_title_err']) ? 'is-invalid' : ''); ?>" value="<?php echo $data['post_title']; ?>">
                            <span class="invalid-feedback"><?php echo $data['post_title_err']; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="post_body">post_body: <sup class="text-danger">*</sup></label>
                            <textarea name="post_body" type="post_body" class="form-control form-control-lg <?php echo (!empty($data['post_body_err']) ? 'is-invalid' : ''); ?>"><?php echo $data['post_body']; ?></textarea>
                            <span class="invalid-feedback"><?php echo $data['post_body_err']; ?></span>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <input type="submit" value="Add post" class="btn btn-primary">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include APPROOT . '\views\inc\footer.php'; ?>