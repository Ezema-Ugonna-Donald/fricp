<?php   

    class Genre 
    {
        private $db;

        public function __construct ()
        {
            $this->db = new Database;
        }

        public function getGenres ()
        {
            $this->db->query ('SELECT *, 
                               genres.id as genreId, 
                               users.id as userId,
                               genres.created_at as genreCreated,
                               users.created_at as userCreated
                            --    genres.no_approved_comments as genresNoApprovedComments 
                               FROM genres
                               INNER JOIN users
                               ON genres.user_id = users.id
                               ORDER BY genres.created_at DESC
                               ');

            $results = $this->db->resultSet ();

            return $results;
        }

        public function getGenresWithRelease ($release)
        {
            $this->db->query ('SELECT *, 
                               genres.music_release as genreRelease, 
                            --    release.releasename as releaseName,
                            genres.created_at as genreCreated,
                            --    release.created_at as releaseCreated,
                            genres.id as genreId,
                            genres.no_approved_comments as genresNoApprovedComments 
                               FROM genres
                            --    INNER JOIN release
                            --    ON genres.release = releaseName
                               INNER JOIN users
                               ON genres.user_id = users.id
                               WHERE genres.music_release LIKE :music_release
                               ORDER BY genres.created_at DESC
                               ');

            // Bind values
            $this->db->bind (':music_release', '%' . $release . '%');

            $results = $this->db->resultSet ();

            return $results;
        }

        public function getGenresWithReleasePagination ($release, $startPage, $endPage)
        {
            $this->db->query ('SELECT *, 
                               genres.music_release as genreRelease, 
                            --    release.releasename as releaseName,
                            genres.created_at as genreCreated,
                            --    release.created_at as releaseCreated,
                            genres.id as genreId,
                            genres.no_approved_comments as genresNoApprovedComments 
                               FROM genres
                            --    INNER JOIN release
                            --    ON genres.release = releaseName
                               INNER JOIN users
                               ON genres.user_id = users.id
                               WHERE genres.music_release LIKE :music_release
                               ORDER BY genres.created_at DESC
                               LIMIT :startPage, :endPage
                               ');

            // Bind values
            $this->db->bind (':music_release', '%' . $release . '%');

            $this->db->bind (':startPage', $startPage);

            $this->db->bind (':endPage', $endPage);

            $results = $this->db->resultSet ();

            return $results;
        }

        public function searchGenres ($data)
        {
            $this->db->query ('SELECT *, 
                                genres.id as genreId, 
                                users.id as userId,
                                genres.created_at as genreCreated,
                                users.created_at as userCreated,
                                genres.no_approved_comments as genresNoApprovedComments 
                                FROM genres 
                                INNER JOIN users 
                                ON genres.user_id = users.id
                                WHERE genres.created_at LIKE :search 
                                OR genres.title LIKE :search 
                                OR genres.music_release LIKE :search 
                                OR genres.body LIKE :search
                                ORDER BY genres.created_at DESC
                                ');

            // Bind values
            $this->db->bind (':search', '%' . $data . '%');

            $results = $this->db->resultSet ();

            return $results;
        }

        public function searchPagination ($search, $startPage, $endPage)
        {
            $this->db->query ('SELECT *, 
                                genres.id as genreId, 
                                users.id as userId,
                                genres.created_at as genreCreated,
                                users.created_at as userCreated,
                                genres.no_approved_comments as genresNoApprovedComments 
                                FROM genres 
                                INNER JOIN users 
                                ON genres.user_id = users.id
                                WHERE genres.created_at LIKE :search 
                                OR genres.title LIKE :search 
                                OR genres.music_release LIKE :search 
                                OR genres.body LIKE :search
                                ORDER BY genres.created_at DESC
                                LIMIT :startPage, :endPage');

            // Bind values
            $this->db->bind (':search', '%' . $search . '%');

            $this->db->bind (':startPage', $startPage);

            $this->db->bind (':endPage', $endPage);

            $results = $this->db->resultSet ();

            return $results;
        }

        public function newGenre ($data)
        {
            $this->db->query ('INSERT INTO genres (title, user_id, music_release, genre_image, body)
                                 VALUES (:title, :user_id, :music_release, :genre_image, :body)');
            
            // Bind values
            $this->db->bind (':title', $data ['title']);
            $this->db->bind (':user_id', $data ['user_id']);
            $this->db->bind (':music_release', $data ['release']);
            $this->db->bind (':genre_image', $data ['genre_image']);
            $this->db->bind (':body', $data ['body']);

            // Execute 
            if ($this->db->execute ())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function updateGenre ($data)
        {
            $this->db->query ('UPDATE genres SET title = :title, 
                                                user_id = :user_id, 
                                                music_release = :music_release, 
                                                genre_image = :genre_image,
                                                body = :body
                                                WHERE id = :id');
            
            // Bind values
            $this->db->bind (':id', $data ['id']);
            $this->db->bind (':title', $data ['title']);
            $this->db->bind (':user_id', $data ['user_id']);
            $this->db->bind (':music_release', $data ['music_release']);
            $this->db->bind (':genre_image', $data ['genre_image']);
            $this->db->bind (':body', $data ['body']);

            // Execute 
            if ($this->db->execute ())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function deleteGenre ($id)
        {
            $this->db->query ('DELETE FROM genres WHERE id = :id');
            
            // Bind values
            $this->db->bind (':id', $id);

            // Execute 
            if ($this->db->execute ())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function getGenreById ($id)
        {
            $this->db->query ('SELECT *,
                                genres.id as genreId, 
                                users.id as userId,
                                genres.created_at as genreCreated,
                                users.created_at as userCreated
                                FROM genres 
                                INNER JOIN users 
                                ON genres.user_id = users.id
                                WHERE genres.id = :id');

            $this->db->bind (':id', $id);

            $row = $this->db->single ();

            return $row;
        }
        
        public function getGenreByTitle ($titleId)
        {
            $this->db->query ('SELECT *,
                                genres.id as genreId, 
                                users.id as userId,
                                genres.created_at as genreCreated,
                                users.created_at as userCreated
                                FROM genres 
                                INNER JOIN users 
                                ON genres.user_id = users.id
                                WHERE genres.title = :title');

            $this->db->bind (':title', $titleId);

            $row = $this->db->single ();

            return $row;
        }

        public function pagination ($startPage, $endPage)
        {
            $this->db->query ('SELECT *, 
                                genres.id as genreId, 
                                users.id as userId,
                                genres.created_at as genreCreated,
                                users.created_at as userCreated
                                -- genres.no_approved_comments as genresNoApprovedComments 
                                FROM genres
                                INNER JOIN users
                                ON genres.user_id = users.id 
                                ORDER BY genreId desc 
                                LIMIT :startPage, :endPage');

            $this->db->bind (':startPage', $startPage);

            $this->db->bind (':endPage', $endPage);

            $results = $this->db->resultSet ();

            return $results;
        }

        public function numGenres ()
        {
            $this->db->query ('SELECT COUNT(*) FROM genres');

            $results = $this->db->resultSet ();

            return $results;
        }

            public function getComments ()
        {
            $this->allGenres = $this->getGenres ();

            foreach ($this->allGenres as $allGenre)
            {
                $this->db->query ('SELECT *, 
                                    comments.id as commentId, 
                                    genres.id as genreId,
                                    comments.created_at as commentCreated,
                                    genres.created_at as genreCreated
                                    FROM comments
                                    INNER JOIN genres
                                    ON comments.genre_id = genres.id');

                $results = $this->db->resultSet ();

                return $results;
            
            }
            
        }

        public function numApprovedComments ($id)
        {
            $this->db->query ('SELECT no_approved_comments FROM genres WHERE id = :id');

            $this->db->bind (':id', $id);

            $row = $this->db->single ();

            return $row;
        }

        public function noApproved ($data)
        {
            $this->db->query ('UPDATE genres SET no_approved_comments = :no_approved_comments 
                                WHERE id = :id');

            $this->db->bind (':id', $data ['genre_id']);
            $this->db->bind (':no_approved_comments', $data ['noApproved']);

            if ($this->db->execute ())
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }