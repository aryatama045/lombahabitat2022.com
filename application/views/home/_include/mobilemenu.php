

<div class="mobilemenu">
    <div class="mobilemenu__backdrop"></div>
    <div class="mobilemenu__body">
        <div class="mobilemenu__header">
            <div class="mobilemenu__title">Menu</div><button type="button" class="mobilemenu__close"><svg width="20px" height="20px">
                    <use xlink:href="<?php echo base_url('assets/template/tema/'); ?>images/sprite.svg#cross-20"></use>
                </svg></button>
        </div>
        <div class="mobilemenu__content">
            <ul class="mobile-links mobile-links--level--0" data-collapse data-collapse-opened-class="mobile-links__item--open">

            <?php
            $menu = $this->M_menu->menu_main();
            foreach ($menu->result_array() as $row) {
                $dropdown = $this->M_menu->dropdown_menu($row['id_menu'])->num_rows();
                if ($dropdown == 0) {
            ?>
                    <li class="nav-links__item">
                        <a class="nav-links__item-link" href="<?= base_url() . $row['link']; ?>">
                            <div class="nav-links__item-body"><?= $row['nama_menu']; ?></div>
                        </a>
                    </li>

                <?php } else { ?>

                    <li class="nav-links__item nav-links__item--has-submenu">
                        <a class="nav-links__item-link" href="#">
                            <div class="nav-links__item-body"><?= $row['nama_menu']; ?>
                                <svg class="nav-links__item-arrow" width="9px" height="6px">
                                    <use xlink:href="<?= base_url('assets/template/tema/') ?>images/sprite.svg#arrow-rounded-down-9x6">
                                    </use>
                                </svg>
                            </div>
                        </a>
                            
                                <ul >
                                    <?php
                                    $dropmenu = $this->M_menu->dropdown_menu($row['id_menu']);
                                    foreach ($dropmenu->result_array() as $row) { ?>

                                        <li class="menu__item">
                                            <div class="menu__item-submenu-offset"></div>
                                            <a class="menu__item-link" href="<?= base_url() . $row['link']; ?>">
                                                <?= $row['nama_menu']; ?>
                                            </a>
                                        </li>

                                    <?php } ?>

                                </ul>

            <?php }
            } ?>

            </ul>

            <br>
           
            <!-- <a style="margin-left: 3em;" href="<?= base_url() ?>" class="mobile-header__logo-menu">
                <img width="150px" src="<?= base_url('assets/images/favicon/') ?><?= $iden['favicon']; ?>">
            </a> -->
        
        </div>
    </div>
</div>