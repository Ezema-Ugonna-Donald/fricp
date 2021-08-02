<?php
    class Ad 
    {
        private $db;

        public function __construct ()
        {
            $this->db = new Database;
        }

        // Create Ads
        public function createAd ($data)
        {
            $this->db->query ('INSERT INTO ads (user_id,company_name, company_email, company_website, 
                                phone_number, ad_image, ad_body) 
                                VALUES (:added_by, :company_name, :company_email, :company_website, 
                                :phone_number, :ad_image, :ad_body)');
            
            // Bind values
            $this->db->bind (':added_by', $data ['added_by']);
            $this->db->bind (':company_name', $data ['company_name']);
            $this->db->bind (':company_email', $data ['company_email']);
            $this->db->bind (':company_website', $data ['company_website']);
            $this->db->bind (':phone_number', $data ['phone_number']);
            $this->db->bind (':ad_image', $data ['ad_image']);
            $this->db->bind (':ad_body', $data ['ad_body']);

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

        // Get Ad by ID
        public function getAdById ($id)
        {
            $this->db->query ('SELECT * FROM ads WHERE id = :id');
            
            // Bind value
            $this->db->bind (':id', $id);

            $row = $this->db->single ();

            return $row;
        } 

        // Get Ads
        public function getAds ()
        {
            $this->db->query ('SELECT * FROM ads');
            
            $results = $this->db->resultSet ();

            return $results;
        }

        public function deleteAd ($id)
        {
            $this->db->query ('DELETE FROM ads WHERE id = :id');
                
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