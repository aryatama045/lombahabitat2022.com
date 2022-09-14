<?php $tanggal = tgl_indo($record['tgl_posting']); ?>

<div class="post__header post-header" 
    style="background: hsl(196deg 100% 47%) !important;
    margin-bottom: 20px;
    margin-top: 0px;
    padding-top: 50px;
    padding-bottom: 24px;">
    <h4 class="post-header__title" style="text-align:center;color:white;"><?= $record['judul']; ?></h4>
</div>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="block
            <?= $this->uri->ruri_string()=='page/detail/hadiah-juara'?'':'card'; ?>
            post--layout--classic">


                <!-- <div class="post__featured"><a href="#"><img src="" alt=""></a></div> -->

                <div class="<?= $this->uri->ruri_string()=='page/detail/hadiah-juara'?'':'card-body'; ?>
                post__content typography">

                    <?= $record['isi_halaman']; ?>

                </div>

            </div>
        </div>

    </div>
</div>