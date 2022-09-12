<?php $tanggal = tgl_indo($record['tgl_posting']); ?>

<div class="row">
    <div class="col-12">
        <div class="block card post post--layout--classic">

            <?php if($record['judul']!=='LOMBA VIDEO PENDEK INFRASTRUKTUR PUPR 2021'){ ?>
                <div class="post__header post-header post-header--layout--classic" 
                style="background: #ffc20e00;margin-bottom: 20px;padding-top: 30px;border-radius: 10px;">
                <h4 class="post-header__title" style="text-align:center;"><?= $record['judul']; ?></h4>

                </div>

            <?php } ?>

            <!-- <div class="post__featured"><a href="#"><img src="" alt=""></a></div> -->

            <div class="card-body post__content typography">

                <?= $record['isi_halaman']; ?>

            </div>

        </div>
    </div>

</div>