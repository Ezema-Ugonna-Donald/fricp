<?php require_once APPROOT . '\views\inc\cms\header.inc.php'; ?>
<div class="main-page">
    <div class="main-content">
        <h1>Add New Genre</h1>
    <div>
    
    </div>
        <div>
            <form action="<?= URLROOT ?>/cms/new_genre" method="post" enctype="multipart/form-data">
                <fieldset>
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input class="form-control <?= (!empty ($data ['title_err'])) ? 'is-invalid' : '' ?>" value="<?= $data ['title'] ?>" type="text" 
                        name="title" id="title" placeholder="Enter Title" value="<?= $data ['title'] ?>">
                        <span class="invalid-feedback"><?= $data ['title_err'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="release">In Your Head:</label>
                        <select name="release[]" class="form-control" multiple>
                            <?php foreach ($data ['releases'] as $release) : ?>
                            <option><?= $release->tracks ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="genre_image">Select Image:</label>
                        <input class="form-control <?= (!empty ($data ['genre_image_err'])) ? 'is-invalid' : '' ?>" 
                        type="file" name="genre_image" placeholder="Select genre Image">
                        <span class="invalid-feedback"><?= $data ['genre_image_err'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="body">Genre Body:</label>
                        <textarea class="form-control <?= (!empty ($data ['body_err'])) ? 'is-invalid' : '' ?>" 
                        name="body" placeholder="Type your genre..."><?= $data ['body'] ?></textarea>
                        <span class="invalid-feedback"><?= $data ['body_err'] ?></span>
                    </div>
                    <input class="btn btn-success btn-block" type="submit" name="submit" value="Add New Genre">
                </fieldset>
            </form>
        </div>
    </div>
</div>
<?php require_once APPROOT . '\views\inc\cms\footer.inc.php'; ?>