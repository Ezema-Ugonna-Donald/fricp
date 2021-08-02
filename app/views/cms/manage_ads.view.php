<?php require_once APPROOT . '\views\inc\cms\header.inc.php'; ?>
<div class="main-page">
    <div class="main-content">
        <h1>Manage Ads</h1>
        <div>
           <?php flash ('ad_message'); ?>
        </div>
        <div>
            <form action="<?= URLROOT ?>/cms/manage_ads" method="post" enctype="multipart/form-data">
                <fieldset>
                    <div class="form-group">
                        <label for="company_name">Company Name:</label>
                        <input class="form-control <?= (!empty ($data ['company_name_err'])) ? 'is-invalid' : '' ?>"
                        type="text" name="company_name" placeholder="Enter Your Company Name" value="<?= $data ['company_name'] ?>">
                        <span class="invalid-feedback"><?= $data ['company_name_err'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="company_email">Company Email:</label>
                        <input class="form-control <?= (!empty ($data ['company_email_err'])) ? 'is-invalid' : '' ?>"
                        type="text" name="company_email" placeholder="Enter Your Company Email" value="<?= $data ['company_email'] ?>">
                        <span class="invalid-feedback"><?= $data ['company_email_err'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="company_website">Company Website:</label>
                        <input class="form-control <?= (!empty ($data ['company_website_err'])) ? 'is-invalid' : '' ?>"
                        type="text" name="company_website" placeholder="Enter Your Website" value="<?= $data ['company_website'] ?>">
                        <span class="invalid-feedback"><?= $data ['company_website_err'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone Number:</label>
                        <input class="form-control <?= (!empty ($data ['phone_number_err'])) ? 'is-invalid' : '' ?>"
                        type="text" name="phone_number" placeholder="Enter Your Phone Number" value="<?= $data ['phone_number'] ?>">
                        <span class="invalid-feedback"><?= $data ['phone_number_err'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="ad_image">Select Ad Image:</label>
                        <input class="form-control <?= (!empty ($data ['ad_image_err'])) ? 'is-invalid' : '' ?>" 
                        type="file" name="ad_image" placeholder="Select Ad Image">
                        <span class="invalid-feedback"><?= $data ['ad_image_err'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="ad_body">Ad Body:</label>
                        <textarea class="form-control <?= (!empty ($data ['ad_body_err'])) ? 'is-invalid' : '' ?>" 
                        name="ad_body" placeholder="Type Ad Body here..."><?= $data ['ad_body'] ?></textarea>
                        <span class="invalid-feedback"><?= $data ['ad_body_err'] ?></span>
                    </div>
                    <input class="btn btn-success btn-block" type="submit" name="submit" value="Add New Advert">
                </fieldset>
            </form>
        </div>
        <div class="table-responsive table-load">
            <table class="table table-striped table-hover">
                <thead class="thead">
                    <tr>
                        <th>S/N</th>
                        <th>Company Name</th>
                        <th>Company Email</th>
                        <th>Company Website</th>
                        <th>Phone Number</th>
                        <th>Ad Image</th>
                        <th>Ad Body</th>
                        <th>Date & Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php $sn = 0; ?>
                <?php foreach ($data ['ads'] as $ad) : ?>
                <?php $sn++ ?>
                <tr>
                    <td><?= $sn ?></td>
                    <td>
                        <?php if (strlen ($ad->company_name) > 20) : ?>
                        <?php $ad->company_name = substr ($ad->company_name, 0, 20) . '...'; ?>
                        <?php endif; ?>
                        <?= htmlentities ($ad->company_name) ?>
                    </td>
                    <td><?= $ad->company_email ?></td>
                    <td><a target="_blank" href="https://<?= $ad->company_website ?>"><?= $ad->company_website ?></a></td>
                    <td><?= $ad->phone_number ?></td>
                    <td><img src="<?= URLROOT ?>/img/uploads/Ad_Image/<?= htmlentities ($ad->ad_image) ?>" width= "170" height="70" alt="" srcset=""></td>
                    <td>
                        <?php if (strlen ($ad->ad_body) > 20) : ?>
                        <?php $ad->ad_body = substr ($ad->ad_body, 0, 20) . '...'; ?>
                        <?php endif; ?>
                        <?= htmlentities ($ad->ad_body) ?>
                    </td>
                    <td><?= $ad->created_at ?></td>
                    <td>
                        <form action="<?= URLROOT ?>/cms/delete_ad/<?= $ad->id ?>" method="post">
                            <button type="submit" class="btn btn-danger"><i class="fas fa-times"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
<?php require_once APPROOT . '\views\inc\cms\footer.inc.php'; ?>