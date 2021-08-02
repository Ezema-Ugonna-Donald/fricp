<div class="blog-side">
                <!-- <div class="sidearea">
                    
                </div> -->
                <div class="sidearea">
                    <div class="sidearea-header">
                        <h2>In Your Head</h2>
                    </div>
                    <a target="_blank" href="https://blog.deziccapelotechnologies.com"><div class="sidearea-categories">D-Z Tech Blog</div></a>
                
                    <?php foreach ($data ['releases'] as $release) : ?>
                    <a href="<?= URLROOT ?>/genres/release/<?= $release->tracks ?>"><div class="sidearea-categories"><?= $release->tracks ?></div></a>
                    <?php endforeach; ?>
                </div>
                <div class="sidearea">
                    <div class="sidearea-header">
                        <h2>Recent Genres</h2>
                    </div>
                    <?php foreach ($data ['genres'] as $genre) : ?>
                    <div class="recent-posts">
                        <div class="recent-posts-img">
                            <img src="<?= URLROOT ?>/img/uploads/Genre_Image/<?= htmlentities ($genre->genre_image) ?>" alt="" srcset="">
                        </div>
                        <div class="recent-posts-detail">
                            <div class="recent-posts-title">
                            <?php 
                                $title = explode (' ', $genre->title); 
                                $genreTitleId2 = $genreUrl = implode ('-', $title);
                            ?>
                                <a href="<?= URLROOT ?>/genres/show/<?= $genreTitleId2 ?>">
                                    <h5><?= htmlentities ($genre->title) ?></h5>
                                </a>
                            </div>
                            <div class="recent-posts-time"><small><?= htmlentities ($genre->genreCreated) ?></small></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>