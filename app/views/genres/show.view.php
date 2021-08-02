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
    <?php require_once APPROOT . '\views\inc\blog\ad.inc.php'; ?>
    <div class="blog-container">
        <div class="blog-col">
            <div class="post">
                <?php flash ('comment_message'); ?>
                <div class="post-title">
                    <h1><?= htmlentities ($data ['genre']->title) ?></h1>
                </div>
                <div class="post-img">
                    <img src="<?= URLROOT ?>/img/uploads/Genre_Image/<?= htmlentities ($data ['genre']->genre_image) ?>" alt="" srcset="">
                </div>
                <div class="post-description">
                    <small>Written by <?= htmlentities ($data ['genre']->name) ?> on <?= htmlentities ($data ['genre']->genreCreated) ?></small>
                    <span>Comment(s): <?= $data ['numOfComments'] ?></span>
                </div>
                <hr>
                <div class="post-body">
                    <p>
                        <?= htmlentities ($data ['genre']->body) ?>
                    </p>
                </div>
            </div>
            <?php if ($data ['numOfComments'] >= 1) : ?>
            <div class="comment-section">
                <div class="comment-head">
                    <h1>Comments about this genre</h1>
                </div>
                <?php foreach ($data ['getComments'] as $comment) : ?>
                <div class="comment-display">
                    <div class="commentator">
                        <div class="commentator-img">
                            <img src="<?= URLROOT ?>/img/comments/user.jpg">
                        </div>
                        <div class="commentator-description">
                            <div class="comment-detail">
                                <div class="commentator-id"><?= htmlentities ($comment->name) ?></div>
                                <div class="comment-website"><?= htmlentities ($comment->website) ?></div>
                                <div class="comment-time"><?= htmlentities ($comment->commentCreated) ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="comment-text">
                        <p><?= htmlentities ($comment->comment) ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            
            <div class="comment-section">
                <form action="<?= URLROOT ?>/genres/comments/<?= $data ['genre']->genreId ?>" method="post">
                    <div class="comment-form">
                        <div class="comment-head">
                            <h1>Share your tracks about this genre</h1>
                            <h4>Please, try to be nice</h4>
                        </div>
                        <div class="comment-body">
                            <div class="form-field">
                                <label for="commentator">Name: </label>
                                <div class="field">
                                    <span><i class="fas fa-user"></i></span>
                                    <input type="text" name="commentator" id="" placeholder="Enter name..." >
                                </div>
                            </div>
                            <div class="form-field">
                                <label for="commentatorEmail">Email: </label>
                                <div class="field">
                                    <span><i class="fas fa-at"></i></span>
                                    <input type="text" name="commentatorEmail" id="" placeholder="Enter email...">
                                </div>
                            </div>
                            <div class="form-field">
                                <label for="commentatorWebsite">Website (Optional): </label>
                                <div class="field">
                                    <span><i class="fas fa-globe"></i></span>
                                    <input type="text" name="commentatorWebsite" id="" placeholder="Enter website...">
                                </div>
                            </div>
                            <div class="form-field">
                                <label for="comment">Comment: </label>
                                <textarea name="comment" id="" placeholder="Please enter comment here..."></textarea>
                            </div>
                            <div class="form-btn">
                                <button type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php require_once APPROOT . '\views\inc\blog\sidearea.inc.php'; ?>
    </div>
    </section>
</article>
<?php require_once APPROOT . '\views\inc\blog\footer.inc.php'; ?>