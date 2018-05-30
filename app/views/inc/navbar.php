<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
    <div class="container">
        <a class="navbar-brand" href="#"><?php echo SITENAME; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <?php create_item('/', 'Home'); ?>
                <?php create_item('/pages/about', 'About Us'); ?>
            </ul>
            <ul class="navbar-nav ml-auto">
                <?php if ( userLoggedIn() ) : ?>
                    <?php echo '<li class="nav-item active nav-link">Welcome Dear ' . $_SESSION[ 'user_name' ] . '</li>'; ?>
                    <?php create_item( '/users/logout', 'Logout' ); ?>
                <?php else : ?>
                    <?php create_item('/users/register', 'Register'); ?>
                    <?php create_item('/users/login', 'Login'); ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>