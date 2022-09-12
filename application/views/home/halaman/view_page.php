<?php $tanggal = tgl_indo($record['tgl_posting']); ?>

<div class="post__header post-header" 
    style="background: #1e82c4 !important;
    margin-bottom: 20px;
    margin-top: 10px;
    padding-top: 40px;
    padding-bottom: 24px;">
    <h4 class="post-header__title" style="text-align:center;"><?= $record['judul']; ?></h4>
</div>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="block card post post--layout--classic">


                <!-- <div class="post__featured"><a href="#"><img src="" alt=""></a></div> -->

                <div class="card-body post__content typography">

                    <?= $record['isi_halaman']; ?>

                </div>

            </div>
        </div>

    </div>
</div>