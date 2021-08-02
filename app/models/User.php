<?php
    class User 
    {
        private $db;

        public function __construct ()
        {
            $this->db = new Database;
        }

        // Register User
        public function register ($data)
        {
            $this->db->query ('INSERT INTO users (name, email, password, created_by) VALUES (:name, :email, :password, :created_by)');
            
            // Bind values
            $this->db->bind (':name', $data ['name']);
            $this->db->bind (':email', $data ['email']);
            $this->db->bind (':password', $data ['password']);
            $this->db->bind (':created_by', $data ['add_by']);

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

        public function login ($email, $password)
        {
            $this->db->query ('SELECT * FROM users WHERE email = :email');
            $this->db->bind (':email', $email);

            $row = $this->db->single ();

            $hashed_password = $row->password;
            if (password_verify ($password, $hashed_password))
            {
                return $row;
            } 
            else
            {
                return false;
            }
        }

        // Find user by email
        public function findUserByEmail ($email)
        {
            $this->db->query ('SELECT * FROM users WHERE email = :email');
            
            // Bind value
            $this->db->bind (':email', $email);

            $row = $this->db->single ();

            // Check row
            if ($this->db->rowCount () > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        // Get User by ID
        public function getUserById ($id)
        {
            $this->db->query ('SELECT * FROM users WHERE id = :id');
            
            // Bind value
            $this->db->bind (':id', $id);

            $row = $this->db->single ();

            return $row;
        } 

        public function getUsers ()
        {
            $this->db->query ('SELECT * FROM users');

            $results = $this->db->resultSet ();

            return $results;
        }

        public function getUsersByPosts ($category)
        {
            $this->db->query ('SELECT *,
                                users.id as userId,
                                posts.id as postId, 
                                users.created_at as userCreated,
                                posts.created_at as postCreated
                                FROM users 
                                INNER JOIN posts 
                                ON users.id = posts.user_id
                                WHERE posts.category LIKE :category');
            
            $this->db->bind (':category', $category);
            
            $results = $this->db->resultSet ();

            return $results;
        }

        public function deleteUser ($id)
        {
            $this->db->query ('DELETE FROM users WHERE id = :id');
                
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