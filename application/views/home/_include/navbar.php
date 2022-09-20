<?php $this->load->model('Model_app');
$this->load->model('Model_menu');?>

        <!-- mobile site__header -->
        <header class="site__header d-lg-none">
            <!-- data-sticky-mode - one of [pullToShow, alwaysOnTop] -->
            <div class="mobile-header mobile-header--sticky" data-sticky-mode="alwaysOnTop">
                <div class="mobile-header__panel">
                    <div class="container">

                        <div class="mobile-header__body">
                            <button class="mobile-header__menu-button">
                                <svg width="18px" height="14px">
                                    <use xlink:href="<?= base_url('assets/template/tema/') ?>images/sprite.svg#menu-18x14"></use>
                                </svg>
                            </button>
                            <a style="position: fixed;left: 4em;" href="<?= base_url();?>" class="site-header__logo2"><img src="<?= base_url();?>assets/logo-t1.png" height="40px"></a>
                            <!-- <a style="    position: fixed;left: 11em;" href="<?= base_url();?>" class="site-header__logo2"><img src="<?= base_url();?>assets/logo-t2.png" height="40px"></a> -->

                            <?php
                                $logo = $this->M_app->view_ordering_limit('tb_web_logo', 'id_logo', 'DESC', 0, 1);
                                foreach ($logo->result_array() as $row) {
                                    echo "<a href='" . base_url() . "' class='mobile-header__logo'><img height='40px' src='" . base_url() . "assets/images/logo/$row[gambar]'/></a>";
                                }
                            ?>


                            <div class="mobile-header__indicators">


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </header>

        <header class="site__header d-lg-block d-none">
            <div class="site-header">
                <!-- .topbar -->
                <?php
                $menu = $this->M_menu->menu_topbar();
                if ($menu->num_rows() > 0) { ?>

                    <div class="site-header__topbar topbar">
                        <div class="topbar__container container">
                            <div class="topbar__row">
                                <?php foreach ($menu->result_array() as $rowx) {?>

                                    <div class="topbar__item topbar__item--link">
                                        <a class="topbar-link" href="<?= base_url($rowx['link']) ; ?>">
                                        <?= $rowx['nama_menu']; ?>
                                        </a>
                                    </div>
                                <?php } ?>
                                <div class="topbar__spring"></div>
                            </div>
                        </div>
                    </div>

                <?php } ?>
                <!-- .topbar / end -->
                <div class="site-header__nav-panel">
                    <!-- data-sticky-mode - one of [pullToShow, alwaysOnTop] -->
                    <div class="nav-panel nav-panel--sticky" data-sticky-mode="alwaysOnTop">
                        <div class="nav-panel__container container" style="padding-left: 160px;">
                            <div class="nav-panel__row">

                                <a style="    position: fixed;left: 1em;" href="https://ciptakarya.pu.go.id/seknashabitat/index.php/home.html" target="_blank" class="site-header__logo2">
                                <img src="<?= base_url();?>assets/logo-t1.png" height="60px"></a>

                                <div class="nav-panel__nav-links nav-links">
                                    <ul class="nav-links__list">

                                        <?php $menu = $this->M_menu->menu_main();

                                        $item_menu= array();
                                        foreach ($menu->result_array() as $row) {
                                            $dropdown = $this->M_menu->dropdown_menu($row['id_menu'])->num_rows();

                                            $rurl = $this->uri->ruri_string();
                                            $active_link = $row['link'] == $rurl ? 'nav-links_item_active':'';

                                            if ($dropdown == 0) {
                                        ?>

                                                <li class="nav-links__item <?= $active_link ?>">
                                                    <a class="nav-links__item-link  /*btn-medium btn-warning*/" href="<?= base_url() . $row['link']; ?>">
                                                        <div class="nav-links__item-body"><?= $row['nama_menu']; ?></div>
                                                    </a>
                                                </li>

                                            <?php } else { ?>

                                                <li class="nav-links__item nav-links__item--has-submenu ">
                                                    <a class="nav-links__item-link  /*btn-medium btn-warning*/" href="#">
                                                        <div class="nav-links__item-body"><?= $row['nama_menu']; ?>
                                                            <svg class="nav-links__item-arrow" width="9px" height="6px">
                                                                <use xlink:href="<?= base_url('assets/template/tema/') ?>images/sprite.svg#arrow-rounded-down-9x6">
                                                                </use>
                                                            </svg>
                                                        </div>
                                                    </a>
                                                    <div class="nav-links__submenu nav-links__submenu--type--menu">
                                                        <!-- .menu -->
                                                        <div class="menu menu--layout--classic">
                                                            <div class="menu__submenus-container"></div>
                                                            <ul class="menu__list">
                                                                <?php
                                                                $dropmenu = $this->M_menu->dropdown_menu($row['id_menu']);
                                                                foreach ($dropmenu->result_array() as $row) {
                                                                    $active_link2 = $row['link'] == $rurl ? 'nav-links_item_active':'';
                                                                ?>
 

                                                                    <li class="menu__item <?= $active_link2 ?>">
                                                                        <div class="menu__item-submenu-offset"></div>
                                                                        <a class="menu__item-link" href="<?= base_url() . $row['link']; ?>">
                                                                            <?= $row['nama_menu']; ?>
                                                                        </a>
                                                                    </li>

                                                                <?php } ?>

                                                            </ul>
                                                        </div><!-- .menu / end -->
                                                    </div>
                                                </li>

                                            <?php }
                                        } ?>


                                    </ul>
                                </div><!-- .nav-links / end -->


                                <?php
                                    $logo = $this->M_app->view_ordering_limit('tb_web_logo', 'id_logo', 'DESC', 0, 1);
                                    foreach ($logo->result_array() as $row) {
                                        echo "<a href='https://pu.go.id/' target='_blank' class='site-header__logo'><img height='70px' src='" . base_url() . "assets/images/logo/$row[gambar]'/></a>";
                                    }
                                ?>

                            </div>




                        </div>
                    </div>
                </div>
            </div>
        </header>