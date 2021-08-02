<?php require_once APPROOT . '\views\inc\cms\header.inc.php'; ?>
<div class="main-page">
    <div class="main-content">
        <h1>Manage Tracks</h1>
        <div>
            <?php flash ('music_release_message'); ?>
        </div>
        <div>
            <form action="<?= URLROOT ?>/cms/music_release" method="post">
                <fieldset>
                    <div class="form-group">
                        <label for="track">Track Title:</label>
                        <input class="form-control <?= (!empty ($data ['track_err'])) ? 'is-invalid' : '' ?>"
                        type="text" id="track" name="track" placeholder="Enter Track Title" value="<?= $data ['track'] ?>">
                        <span class="invalid-feedback"><?= $data ['track_err'] ?></span>
                    </div>
                    <input class="btn btn-success btn-block" type="submit" name="submit" value="Add New Track">
                </fieldset>
            </form>
        </div>
        <div class="table-responsive table-load">
            <table class="table table-striped table-hover">
                <thead class="thead">
                    <tr>
                        <th>S/N</th>
                        <th>Date & Time</th>
                        <th>Track Title</th>
                        <th>Creator Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <?php $sn = 0; ?>
                <?php foreach ($data ['tracks'] as $track) : ?>
                <?php $sn++ ?>
                <tr>
                    <td><?= $sn ?></td>
                    <td><?= $track->releaseCreated ?></td>
                    <td><?= $track->tracks ?></td>
                    <td><?= $track->name ?></td>
                    <td>
                        <form action="<?= URLROOT ?>/cms/delete_music_release/<?= $track->releaseId ?>" method="post">
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