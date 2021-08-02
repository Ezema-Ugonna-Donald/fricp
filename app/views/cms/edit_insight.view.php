<?php require_once APPROOT . '\views\inc\cms\header.inc.php'; ?>
<div class="main-page">
    <div class="main-content">
        <h1>Edit genre</h1>
    <div>
        
    </div>
        <div>
            <form action="<?= URLROOT ?>/cms/edit_genre/<?= $data ['id'] ?>" method="post" enctype="multipart/form-data">
                <fieldset>
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input class="form-control <?= (!empty ($data ['title_err'])) ? 'is-invalid' : '' ?>" value="<?= $data ['title'] ?>" type="text" 
                        name="title" id="title" placeholder="Enter Title" value="<?= $data ['title'] ?>">
                        <span class="invalid-feedback"><?= $data ['title_err'] ?></span>
                    </div>
                    <div class="edit-display">
                        <span>Existing In Your Head: <?= $data ['releasename'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="release">In Your Head:</label>
                        <select name="release[]" class="form-control" multiple>
                            <?php foreach ($data ['releases'] as $release) : ?>
                            <option value= "<?= $release->tracks ?>"><?= $release->tracks ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="invalid-feedback"><?= $data ['release_err'] ?></span>
                    </div>
                    <div class="edit-display">
                        <div>Existing Image:</div>
                        <img src="<?= URLROOT ?>/img/uploads/Genre_Image/<?= htmlentities ($data ['genre_img']) ?>" width= "170" height="70" alt="" srcset="">
                    </div>
                    <div class="form-group">
                        <label for="genre_image">Select Image:</label>
                        <input class="form-control <?= (!empty ($data ['genre_image_err'])) ? 'is-invalid' : '' ?>" 
                        type="file" name="genre_image" placeholder="Enter Title">
                        <span class="invalid-feedback"><?= $data ['genre_image_err'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="body">genre:</label>
                        <textarea class="form-control <?= (!empty ($data ['body_err'])) ? 'is-invalid' : '' ?>" 
                        name="body" placeholder="Type your genre..."><?= $data ['body'] ?>
                        </textarea>
                        <span class="invalid-feedback"><?= $data ['body_err'] ?></span>
                    </div>
                    <input class="btn btn-success btn-block" type="submit" name="submit" value="Edit Genre">
                </fieldset>
            </form>
        </div>
    </div>
</div>
<?php require_once APPROOT . '\views\inc\cms\footer.inc.php'; ?>