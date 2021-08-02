<div class="ad-row">
    <?php foreach ($data ['ads'] as $ad) : ?>
        <div class="ad-carousel">
            <div class="ads">
                <div class="ads-description">
                    <p><?= $ad->ad_body ?></p>
                </div>
                <div class="ads-img">
                    <img src="<?= URLROOT ?>/img/uploads/Ad_Image/<?= htmlentities ($ad->ad_image) ?>" alt="<?= $ad->company_name ?> Advert" srcset="">
                </div>
                <div class="ads-text">
                    <div class="ad-header">
                        <h3><?= $ad->company_name ?></h3>
                    </div>
                    <!-- <p><?= $ad->ad_body ?></p> -->
                    <?php if ($ad->company_email != '') : ?>
                        <p><span class="social-icon"><img src="<?= URLROOT ?>/img/socialIcons/paper-plane.png"/></span> <span class="ad-field"><?= $ad->company_email ?></span></p>
                    <?php endif; ?>
                    <p><span class="social-icon"><img src="<?= URLROOT ?>/img/socialIcons/phone-line.png"/></span> <span class="ad-field"><?= $ad->phone_number ?></span></p>
                    <?php if ($ad->company_website != '') : ?>
                    <p id="ad-site"><span class="social-icon"><img src="<?= URLROOT ?>/img/socialIcons/registration-web.png"/></span> <span class="ad-field"><a target="_blank" href="https://<?= $ad->company_website ?>"><?= $ad->company_website ?></a></span></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>