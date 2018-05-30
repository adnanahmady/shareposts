<?php include APPROOT . '\views\inc\header.php'; ?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card bg-light">
                <div class="card-header text-center">
                    <h3><?php echo $data['title']; ?></h3>
                </div>
                <div class="card-body">
                    <form action="<?php echo APPURL, '/users/register'; ?>" method="post">
                        <div class="form-group">
                            <label for="name">name: <sup class="text-danger">*</sup></label>
                            <input name="name" type="text" class="form-control form-control-lg <?php echo (!empty($data['name_err']) ? 'is-invalid' : ''); ?>" value="<?php echo $data['name']; ?>">
                            <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="email">email: <sup class="text-danger">*</sup></label>
                            <input name="email" type="text" class="form-control form-control-lg <?php echo (!empty($data['email_err']) ? 'is-invalid' : ''); ?>" value="<?php echo $data['email']; ?>">
                            <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="password">password: <sup class="text-danger">*</sup></label>
                            <input name="password" type="password" class="form-control form-control-lg <?php echo (!empty($data['password_err']) ? 'is-invalid' : ''); ?>" value="<?php echo $data['password']; ?>">
                            <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="password_confirm">password_confirm: <sup class="text-danger">*</sup></label>
                            <input name="password_confirm" type="password" class="form-control form-control-lg <?php echo (!empty($data['password_confirm_err']) ? 'is-invalid' : ''); ?>" value="<?php echo $data['password_confirm']; ?>">
                            <span class="invalid-feedback"><?php echo $data['password_confirm_err']; ?></span>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <input type="submit" value="Register" class="btn btn-primary btn-block">
                            </div>
                            <div class="col"><a href="<?php echo APPURL, '/users/login'; ?>" class="btn btn-light btn-block">Have an acount? Login</a></div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include APPROOT . '\views\inc\footer.php'; ?>