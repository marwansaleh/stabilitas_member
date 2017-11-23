
<div class="top-bar">
    <div class="container">
        <div class="row">
            <!-- logo -->
            <div class="col-md-2 logo">
                <a href="#"><img src="<?php echo get_asset_url('img/logo-stabilitas.png') ?>" alt="Admin Dashboard" height="20px" width="100px"></a>
                <h1 class="sr-only">Stabilitas</h1>
            </div>
            <!-- end logo -->
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-12">
                        <div class="top-bar-right">
                            <!-- responsive menu bar icon -->
                            <a href="#" class="hidden-md hidden-lg main-nav-toggle"><i class="fa fa-bars"></i></a>
                            <!-- container for status WS BROKOLI BRI -->
                            <div class="btn-group">
                                <a href="#" class="btn btn-link btn-status-ws" title="Cannot connect to BROKOLI BRI">
                                    <i class="fa fa-exclamation-triangle"></i>
                                </a>
                            </div>
                            <!-- logged user and the menu -->
                            <div class="logged-user">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                                        <img class="avatar img-rounded" style="max-width: 28px; max-height: 30px;" src="<?php echo get_asset_url('img/avatar/'.$me->avatar) ?>" alt="User Avatar">
                                        <span class="name"><?php echo $me->username; ?></span> <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="#" id="btn-change-password">
                                                <i class="fa fa-user"></i>
                                                <span class="text">Ganti Password</span>
                                            </a>
                                        </li>
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