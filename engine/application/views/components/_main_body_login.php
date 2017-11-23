<div id="site" class="wrapper full-page-wrapper page-auth page-login text-center">
    <div class="inner-page">
        <div class="logo">
            <a href="#"><img src="<?php echo get_asset_url('img/logo-stabilitas-lock.png') ?>" alt=""></a>
        </div>
        <?php if (isset($subview)) { $this->load->view($subview); } ?>
    </div>
</div>