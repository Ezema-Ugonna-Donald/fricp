<?php require_once APPROOT . '\views\inc\cms\header.inc.php'; ?>
<div class="main-page">
    <div class="main-content">
        <?php flash ('genre_message'); ?>
        <?php flash ('register_success'); ?>
        <?php flash ('login_message'); ?>
        <h1>Dashboard</h1>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-load">
                        <thead class="thead">
                            <tr>
                                <th>S/N</th>
                                <th>Title</th>
                                <th>In Your Head</th>
                                <th>Date & Time</th>
                                <th>Author</th>
                                <th>Banner</th>
                                <th>Comments</th>
                                <th>Actions</th>
                                <th>Live Preview</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sn = 0; ?>
                            <?php foreach ($data ['genres'] as $genre) : ?>
                            <?php $sn++ ?>
                            <tr>
                                <td><?= $sn ?></td>
                                <td>
                                    <?php if (strlen ($genre->title) > 20) : ?>
                                    <?php $genre->title = substr ($genre->title, 0, 20) . '...'; ?>
                                    <?php endif; ?>
                                    <?= htmlentities ($genre->title) ?>
                                </td>
                                <td><?= $genre->music_release ?></td>
                                <td><?= $genre->genreCreated ?></td>
                                <td><?= $genre->name ?></td>
                                <td><img src="<?= URLROOT ?>/img/uploads/Genre_Image/<?= htmlentities ($genre->genre_image) ?>" width= "170" height="70" alt="" srcset=""></td>
                                <td>Comments</td>
                                <td>
                                    <a href="<?= URLROOT ?>/cms/edit_genre/<?= $genre->genreId ?>"><span class="btn btn-warning"><i class="far fa-edit"></i> Edit</span></a>
                                    <form action="<?= URLROOT ?>/cms/delete_genre/<?= $genre->genreId ?>" method="post" class="pull-right">
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-times"></i> Delete</button>
                                    </form>
                                </td>
                                <td><a target="_blank" href="<?= URLROOT ?>/genres/show/<?= $genre->genreId ?>"><span class="btn btn-primary"><i class="far fa-eye"></i> Live Preview</span></a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once APPROOT . '\views\inc\cms\footer.inc.php'; ?>