<?php require_once APPROOT . '\views\inc\blog\header.inc.php'; ?>
<div class="sub-categories">
    <?php foreach ($data ['releases'] as $release) : ?>
        <a href="<?= URLROOT ?>/genres/release/<?= $release->tracks ?>">
            <div class="sub-categories-list"><?= $release->tracks ?></div>
        </a>
    <?php endforeach; ?>
</div>
<article>
    <section>
    <div id="fric-p-dimension"></div>
    </section>
    <section>
        
        <?php require_once APPROOT . '\views\inc\blog\ad.inc.php'; ?> 

        
        <?php //require_once APPROOT . '\views\inc\blog\sidearea.inc.php'; ?>
        
    </section>
</article>
<?php require_once APPROOT . '\views\inc\blog\footer.inc.php'; ?>
