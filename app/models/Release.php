<?php

class Release
{
    private $db;

    public function __construct ()
    {
        $this->db = new Database;
    }

    public function getReleases ()
    {
        $this->db->query ('SELECT *, 
                            music_release.id as releaseId, 
                            users.id as userId,
                            music_release.created_at as releaseCreated,
                            users.created_at as userCreated
                            FROM music_release
                            INNER JOIN users
                            ON music_release.user_id = users.id
                            ORDER BY music_release.created_at DESC
                            ');

        $results = $this->db->resultSet ();

        return $results;
    }

    public function getReleaseById ($id)
    {
        $this->db->query ('SELECT *, 
                            music_release.id as releaseId, 
                            users.id as userId,
                            music_release.created_at as releaseCreated,
                            users.created_at as userCreated
                            FROM music_release
                            INNER JOIN users
                            ON music_release.user_id = users.id
                            WHERE music_release.user_id = :id
                            ORDER BY music_release.created_at DESC
                            ');

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

    public function addRelease ($data)
    {
        $this->db->query ('INSERT INTO music_release (tracks, user_id) VALUES (:track, :user_id)');
        
        // Bind values
        $this->db->bind (':track', $data ['track']);
        $this->db->bind (':user_id', $data ['user_id']);

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

    public function deleteRelease ($id)
    {
        $this->db->query ('DELETE FROM music_release WHERE id = :id');
            
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
}