<?php require_once APPROOT . '\views\inc\cms\header.inc.php'; ?>
<div class="main-page">
    <div class="main-content">
        
        <div>
        <?php flash ('comment_message'); ?>
        </div>
        
        <?php if (($data ['unapprovedComments']) >= 1) : ?>
        <h1>Comments Pending</h1>
        <div class="table-responsive table-load">
            <table class="table table-striped table-hover">
                <thead class="thead">
                    <tr>
                        <th>S/N</th>
                        <th>Commentator</th>
                        <th>Date & Time</th>
                        <th>Commentator Comment</th>
                        <th>Commentator Email</th>
                        <th>Commentator Website</th>
                        <th>Action</th>
                        <th>Live Preview</th>
                    </tr>
                </thead>
                <?php $sn = 0; ?>
                <?php foreach ($data ['unapprovedComments'] as $unapprovedcomment) : ?>
                <?php $sn++ ?>
                <tr>
                    <td><?= $sn ?></td>
                    <td><?= $unapprovedcomment->name ?></td>
                    <td><?= $unapprovedcomment->commentCreated ?></td>
                    <td><?= $unapprovedcomment->comment ?></td>
                    <td><?= $unapprovedcomment->email ?></td>
                    <td><?= $unapprovedcomment->website ?></td>
                    <td>
                        <form action="<?= URLROOT ?>/cms/approve_comment/<?= $unapprovedcomment->commentId ?>" method="post" class="pull-left">
                            <button type="submit" class="btn btn-success"><i class="fas fa-thumbs-up"></i> Approve</button>
                        </form>
                        <form action="<?= URLROOT ?>/cms/delete_comment/<?= $unapprovedcomment->commentId ?>" method="post" class="pull-right">
                            <button type="submit" class="btn btn-danger"><i class="fas fa-times"></i> Delete</button>
                        </form>
                    </td>
                    <td>
                        <?php 
                            $title = explode (' ', $unapprovedcomment->genreTitle); 
                            $genreTitleId = $genreUrl = implode ('-', $title);
                        ?>
                        <a target="_blank" href="<?= URLROOT ?>/genres/show/<?= $genreTitleId ?>">
                            <span class="btn btn-primary"><i class="far fa-eye"></i> Live Preview</span>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <?php endif; ?>

        <h1>Comments Approved</h1>
        <div>
        
        </div>
        <?php if (($data ['approvedComments']) >= 1) : ?>
        <div class="table-responsive table-load">
            <table class="table table-striped table-hover">
                <thead class="thead">
                    <tr>
                        <th>S/N</th>
                        <th>Commentator</th>
                        <th>Date & Time</th>
                        <th>Commentator Comment</th>
                        <th>Commentator Email</th>
                        <th>Commentator Website</th>
                        <th>Action</th>
                        <th>Live Preview</th>
                    </tr>
                </thead>
                <?php $sn = 0; ?>
                <?php foreach ($data ['approvedComments'] as $approvedComment) : ?>
                <?php $sn++ ?>
                <tr>
                    <td><?= $sn ?></td>
                    <td><?= $approvedComment->name ?></td>
                    <td><?= $approvedComment->commentCreated ?></td>
                    <td><?= $approvedComment->comment ?></td>
                    <td><?= $approvedComment->email ?></td>
                    <td><?= $approvedComment->website ?></td>
                    <td>
                        <form action="<?= URLROOT ?>/cms/disapprove_comment/<?= $approvedComment->commentId ?>" method="post" class="pull-right">
                            <button type="submit" class="btn btn-warning"><i class="fas fa-thumbs-down"></i> Disapprove</button>
                        </form>
                    </td>
                    <td>
                        <?php 
                            $title = explode (' ', $approvedComment->genreTitle); 
                            $genreTitleId = $genreUrl = implode ('-', $title);
                        ?>
                        <a target="_blank" href="<?= URLROOT ?>/genres/show/<?= $genreTitleId ?>">
                            <span class="btn btn-primary"><i class="far fa-eye"></i> Live Preview</span>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php require_once APPROOT . '\views\inc\cms\footer.inc.php'; ?>