<?php

class Comment
{
    private $db;

    public function __construct ()
    {
        $this->db = new Database;
    }

    public function getApprovedComments ()
    {
        $this->db->query ('SELECT *, 
                               comments.id as commentId, 
                               genres.id as genreId,
                               comments.created_at as commentCreated,
                               genres.created_at as genreCreated,
                               genres.title as genreTitle 
                               FROM comments
                               INNER JOIN genres
                               ON comments.genre_id = genres.id
                               AND comments.status = :status
                               ORDER BY comments.created_at DESC
                               ');

        $this->db->bind (':status', 'ON');

        $results = $this->db->resultSet ();

        return $results;
    }

    public function getApprovedCommentsById ($id)
    {
        $this->db->query ('SELECT *, 
                               comments.id as commentId, 
                               genres.id as genreId,
                               comments.created_at as commentCreated,
                               genres.created_at as genreCreated,
                               genres.title as genreTitle  
                               FROM comments
                               INNER JOIN genres
                               ON comments.genre_id = genres.id
                               WHERE comments.genre_id = :id
                               AND comments.status = :status
                               ORDER BY comments.created_at DESC
                               ');

        $this->db->bind (':id', $id);
        $this->db->bind (':status', 'ON');

        $results = $this->db->resultSet ();

        return $results;
    }

    public function getUnApprovedComments ()
    {
        $this->db->query ('SELECT *, 
                               comments.id as commentId, 
                               genres.id as genreId,
                               comments.created_at as commentCreated,
                               genres.created_at as genreCreated,
                               genres.title as genreTitle
                               FROM comments
                               INNER JOIN genres
                               ON comments.genre_id = genres.id
                               AND comments.status = :status
                               ORDER BY comments.created_at DESC
                               ');

        $this->db->bind (':status', 'OFF');

        $results = $this->db->resultSet ();

        return $results;
    }
    
    public function getUnApprovedCommentsById ($id)
    {
        $this->db->query ('SELECT *, 
                               comments.id as commentId, 
                               genres.id as genreId,
                               comments.created_at as commentCreated,
                               genres.created_at as genreCreated,
                               genres.title as genreTitle
                               FROM comments
                               INNER JOIN genres
                               ON comments.genre_id = genres.id
                               WHERE comments.genre_id = :id
                               AND comments.status = :status
                               ORDER BY comments.created_at DESC
                               ');

        $this->db->bind (':id', $id);

        $this->db->bind (':status', 'OFF');

        $results = $this->db->resultSet ();

        return $results;
    }

    public function getOneCommentById ($id)
    {
        $this->db->query ('SELECT *,
                            comments.id as commentId, 
                            genres.id as genreId,
                            comments.created_at as commentCreated,
                            genres.created_at as genreCreated, 
                            genres.no_approved_comments as genresNoApprovedComments 
                            FROM comments
                            INNER JOIN genres
                            ON comments.genre_id = genres.id 
                            WHERE comments.id = :id');

        $this->db->bind (':id', $id);

        $row = $this->db->single ();

        return $row;
    }

    public function addComment ($data)
    {
        $this->db->query ('INSERT INTO comments (genre_id, name, email, website, comment, approved_by, status)
                                VALUES (:genre_id, :name,  :email, :website, :comment, :approved_by, :status)');
        
        // Bind values
        $this->db->bind (':genre_id', $data ['id']);
        $this->db->bind (':name', $data ['commentator']);
        $this->db->bind (':email', $data ['commentatorEmail']);
        $this->db->bind (':website', $data ['commentatorWebsite']);
        $this->db->bind (':comment', $data ['comment']);
        $this->db->bind (':approved_by', 0);
        $this->db->bind (':status', 'OFF');

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

    public function approveComment ($data)
    {
        $this->db->query ('UPDATE comments SET status = :status, 
                            approved_by = :approved_by WHERE id = :id');
        
        $this->db->bind (':id', $data ['id']);
        $this->db->bind (':status', 'ON');
        $this->db->bind (':approved_by', $data ['user_id']);

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

    public function deleteComment ($id)
    {
        $this->db->query ('DELETE FROM comments WHERE id = :id');
            
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

    public function disapproveComment ($data)
    {
        $this->db->query ('UPDATE comments SET status = :status, 
                            approved_by = :approved_by WHERE id = :id');
        
        $this->db->bind (':id', $data ['id']);
        $this->db->bind (':status', 'OFF');
        $this->db->bind (':approved_by', $data ['user_id']);

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
}