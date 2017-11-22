<div class="top-bar">
    <div class="container">
        <div class="row">
            <!-- logo -->
            <div class="col-md-2 logo">
                <a href="#"><img src="<?php echo get_asset_url('img/bsm-logo-name-full-white.png') ?>" alt="Admin Dashboard"></a>
                <h1 class="sr-only">PT. BSM</h1>
            </div>
            <!-- end logo -->
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-12">
                        <div class="top-bar-right">
                            <!-- responsive menu bar icon -->
                            <a href="#" class="hidden-md hidden-lg main-nav-toggle"><i class="fa fa-bars"></i></a>
                            <!-- logged user and the menu -->
                            <div class="logged-user">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                                        <img class="avatar" style="max-width: 28px; max-height: 30px;" src="<?php echo $me->avatar ? $me->avatar : get_asset_url('img/user-avatar.png'); ?>" alt="User Avatar">
                                        <span class="name"><?php echo $me->nama; ?> [ <?php echo $me->bidang->nama; ?> ]</span> <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                        <li>
                                            <a href="<?php echo site_url('auth/logout'); ?>">
                                                <i class="fa fa-power-off"></i>
                                                <span class="text">Logout</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- end logged user and the menu -->
                        </div>
                        <!-- /top-bar-right -->
                    </div>
                </div>
                <!-- /row -->
            </div>
        </div>
    </div>
</div>