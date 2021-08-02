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
                <?php if ($data ['searchResult']) : ?>
                    <?php foreach ($data ['searchResult'] as $search) : ?>
                    <div class="post">
                        <div class="post-title">
                            <h1><?= htmlentities ($search->title) ?></h1>
                        </div>
                        <div class="post-img">
                            <img src="<?= URLROOT ?>/img/uploads/Genre_Image/<?= htmlentities ($search->genre_image) ?>" alt="" srcset="">
                        </div>
                        <div class="post-description">
                            <small>Written by <?= htmlentities ($search->name) ?> on <?= htmlentities ($search->genreCreated) ?></small>
                            <span>Comment(s): <?= $search->genresNoApprovedComments ?></span>
                        </div>
                        <hr>
                        <div class="post-body">
                            <p>
                                <?php if (strlen ($search->body) > 150) : ?>
                                <?php $search->body = substr ($search->body, 0, 150) . '...'; ?>
                                <?php endif; ?>
                                <?= htmlentities ($search->body) ?>
                            </p>
                            <?php 
                                $title = explode (' ', $search->title); 
                                $genreTitleId = $genreUrl = implode ('-', $title);
                            ?>
                            <a href="<?= URLROOT ?>/genres/show/<?= $genreTitleId ?>">
                                <span>Read More &raquo;</span>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php if ($data ['genreCount'] > 4) : ?>
                    <div class="pagination-container">
                        <ul class="pagination-ul">
                            <?php if ($data ['pageNum'] > 1) : ?>
                            <li>
                                <a href="<?= URLROOT ?>/genres/search/<?= $data ['search'] ?>/?page=<?= $data ['pageNum'] - 1 ?>">&laquo;</a>
                            </li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $data ['numGenres']; $i++) : ?>
                            <li class="<?= ($i == $data ['pageNum']) ? 'active' : '' ?>">
                                <a href="<?= URLROOT ?>/genres/search/<?= $data ['search'] ?>/?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                            <?php endfor; ?>

                            <?php if ($data ['pageNum'] + 1 <= $data ['numGenres']) : ?>
                            <li>
                                <a href="<?= URLROOT ?>/genres/search/<?= $data ['search'] ?>/?page=<?= $data ['pageNum'] + 1 ?>">&raquo;</a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                <?php else : ?>
                    <?php foreach ($data ['genre'] as $genre) : ?>
                    <div class="post">
                        <div class="post-title">
                            <h1><?= htmlentities ($genre->title) ?></h1>
                        </div>
                        <div class="post-img">
                            <img src="<?= URLROOT ?>/img/uploads/Genre_Image/<?= htmlentities ($genre->genre_image) ?>" alt="" srcset="">
                        </div>
                        <div class="post-description">
                            <small>Written by <?= htmlentities ($genre->name) ?> on <?= htmlentities ($genre->genreCreated) ?></small>
                            <span>Comment(s): <?= $genre->genresNoApprovedComments ?></span>
                        </div>
                        <hr>
                        <div class="post-body">
                            <p>
                                <?php if (strlen ($genre->body) > 150) : ?>
                                <?php $genre->body = substr ($genre->body, 0, 150) . '...'; ?>
                                <?php endif; ?>
                                <?= htmlentities ($genre->body) ?>
                            </p>
                            <?php 
                                $title = explode (' ', $genre->title); 
                                $genreTitleId = $genreUrl = implode ('-', $title);
                            ?>
                            <a id="read-more" href="<?= URLROOT ?>/genres/show/<?= $genreTitleId ?>">
                                <span>Read More &raquo;</span>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php if ($data ['genreCount'] > 4) : ?>
                    <div class="pagination-container">
                        <ul class="pagination-ul">
                            <?php if ($data ['pageNum'] > 1) : ?>
                            <li>
                                <a href="<?= URLROOT ?>/genres/search/<?= $data ['search'] ?>/?page=<?= $data ['pageNum'] - 1 ?>">&laquo;</a>
                            </li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $data ['numGenres']; $i++) : ?>
                            <li class="<?= ($i == $data ['pageNum']) ? 'active' : '' ?>">
                                <a href="<?= URLROOT ?>/genres/search/<?= $data ['search'] ?>/?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                            <?php endfor; ?>

                            <?php if ($data ['pageNum'] + 1 <= $data ['numGenres']) : ?>
                            <li>
                                <a href="<?= URLROOT ?>/genres/search/<?= $data ['search'] ?>/?page=<?= $data ['pageNum'] + 1 ?>">&raquo;</a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <?php require_once APPROOT . '\views\inc\blog\sidearea.inc.php'; ?>
        </div>
    </section>
</article>
<?php require_once APPROOT . '\views\inc\blog\footer.inc.php'; ?>