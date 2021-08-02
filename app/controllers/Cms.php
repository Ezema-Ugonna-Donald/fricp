<?php

    class Cms extends Controller
    {
        public function __construct ()
        {
            if (!isLoggedIn ())
            {
                redirect ('users/login');
            }

            $this->userModel = $this->model ('User');

            $this->genreModel = $this->model ('genre');
            
            $this->releaseModel = $this->model ('release');
            
            $this->commentModel = $this->model ('Comment');

            $this->intComment = 0;

            $this->adsModel = $this->model ('Ad');
        }

        public function index ()
        {
            // Get genres
            $genres = $this->genreModel->getGenres ();

            $data = [
                'title' => 'D-Z Tech Blog',
                'page' => 'index',
                'genres' => $genres
            ];

            $this->view ('cms/index', $data);
        }

        public function new_genre ()
        {
            // Track URL
            $_SESSION ['trackUrl'] = $this->resetUrl ('new_genre');
            
            $releases = $this->releaseModel->getReleases ();

            if ($_SERVER ['REQUEST_METHOD'] == 'POST')
            {
                // // Sanitize POST array
                // $_POST = filter_input_array (INPUT_POST, FILTER_SANITIZE_STRING);
                
                // Upload Image
                $image = $_FILES ['genre_image']['name'];
                $target = $_SERVER['DOCUMENT_ROOT'] . "/fricp/public/img/uploads/Genre_Image/" . basename ($image);
                $image_tmp_name = $_FILES ['genre_image']['tmp_name'];

                // Separate Releases
                $catSet = '';
                $catArr = $_POST ['release'];

                foreach($catArr as $cat)
                {
                    $catSet = test_input ($catSet . $cat);

                    if ($cat != end ($_POST ['release']))
                    {    
                        $catSet = $catSet . ', ';
                    }
                }
                
                $data = [
                    'page' => 'new_genre',
                    'title' => test_input ($_POST ['title']),
                    'body' => test_input ($_POST ['body']),
                    'release' => $catSet,
                    'releases' => $releases,
                    'genre_image' => $image,
                    'user_id' => $_SESSION ['user_id'],
                    'title_err' => '',
                    'body_err' => '',
                    'genre_image_err' => ''
                ];

                // Validate title 
                if (empty ($data ['title']))
                {
                    $data ['title_err'] = 'Please enter title';
                }

                // Validate body 
                if (empty ($data ['body']))
                {
                    $data ['body_err'] = 'Please enter genre text';
                }

                // Validate genre image 
                if (empty ($data ['genre_image']))
                {
                    $data ['genre_image_err'] = 'Please upload genre image';
                }

                // Make sure no errors
                if (empty ($data ['title_err']) && empty ($data ['body_err']) && empty ($data ['genre_image_err']))
                {
                   // Validated 
                   if ($this->genreModel->newGenre ($data))
                   {
                       // Check if image file is an actual image or fake image
                        $check = getimagesize($image_tmp_name);
                        
                        if ($check !== false)
                        {
                            move_uploaded_file($image_tmp_name, $target);
                        }

                        flash ('genre_message', 'Genre Added');

                        redirect ('cms');
                   }
                   else
                   {
                       die ('Something went wrong');
                   }
                }
                else
                {
                    // Load view with errors
                    $this->view ('cms/new_genre', $data);
                }
            }
            else
            {
                $releases = $this->releaseModel->getReleases ();

                $data = [
                    'page' => 'new_genre',
                    'title' => '',
                    'body' => '',
                    'release' => '',
                    'releases' => $releases,
                    'genre_image' => '',
                    'title_err' => '',
                    'body_err' => '',
                    'genre_image_err' => ''
                ];
    
                $this->view ('cms/new_genre', $data);
            }
        }

        public function edit_genre ($id)
        {
            $releases = $this->releaseModel->getReleases ();

            // $genre = $this->genreModel->getGenreById ($id);

            //     // // Check for owner
            //     // if ($genre->user_id != $_SESSION ['user_id'])
            //     // {
            //     //     redirect ('genres');
            //     // }

            // $var = 0;
            
            // $checkCat = $_POST ['release'] ?? $var;

            // $data = [
            //     'id' => $id,
            //     'genre_img' => $genre->genre_image,
            //     'title' => (!array_key_exists ('title', $_POST)) ? $genre->title : ((test_input ($_POST ['title']) == '') ? $_POST ['title'] : $post->title),
            //     'body' => (!array_key_exists ('body', $_POST)) ? $genre->body : ((test_input ($_POST ['body']) == '') ? $_POST ['body'] : $genre->body),
            //     'releasename' => $genre->release,
            //     'release' => [],
            //     'releases' => $releases,
            //     'user_id' => '',
            //     'genre_image' => '',
            //     'title_err' => (!array_key_exists ('title', $_POST)) ? '' : ((test_input ($_POST ['title']) == '') ? 'Please enter title' : ''),
            //     'release_err' => /**(isset ($checkCat)) ? '' : ((empty ($_POST ['release'])) ? 'Please select one or more releases' : '6')**/ '',
            //     'genre_image_err' => (!array_key_exists ('genre_image', $_FILES)) ? '' : (($_FILES ['genre_image']['name'] == '') ? 'Please upload genre image' : ''),
            //     'body_err' => (!array_key_exists ('body', $_POST)) ? '' : ((test_input ($_POST ['body']) == '') ? 'Please enter genre text' : '')
            // ];

            // // if ('' == null) die('Beans'); else die('Rice');

            // $this->view ('cms/edit_genre', $data);

            if ($_SERVER ['REQUEST_METHOD'] == 'POST')
            {
                // // Sanitize POST array
                // $_POST = filter_input_array (INPUT_POST, FILTER_SANITIZE_STRING);

                // Upload Image
                $image = $_FILES ['genre_image']['name'];
                $target = $_SERVER['DOCUMENT_ROOT'] . "/fricp/public/img/uploads/Genre_Image/" . basename ($image);
                $image_tmp_name = $_FILES ['genre_image']['tmp_name'];

                // $data = [
                //     'id' => $id,
                //     'genre_img' => '',
                //     'title' => '',
                //     'body' => '',
                //     'catergoryname' => '',
                //     'release' => '',
                //     'releases' => $releases,
                //     'genre_image' => $image,
                //     'user_id' => $_SESSION ['user_id'],
                //     'title_err' => '',
                //     'release_err' => '',
                //     'genre_image_err' => '',
                //     'body_err' => ''
                // ];

                $data = [
                    'id' => $id,
                    'genre_img' => '',
                    'title' => test_input ($_POST ['title']),
                    'body' => test_input ($_POST ['body']),
                    'catergoryname' => '',
                    'release' => '',
                    'releases' => $releases,
                    'genre_image' => $image,
                    'user_id' => $_SESSION ['user_id'],
                    'title_err' => '',
                    'release_err' => '',
                    'genre_image_err' => '',
                    'body_err' => ''
                ];

                // Validate title 
                if (empty ($data ['title']))
                {
                    $data ['title_err'] = 'Please enter title';
                }

                // Validate genre image 
                // if (empty ($data ['release']))
                // {
                //     $data ['release_err'] = 'Please select one or more releases';
                // }

                // Validate genre image 
                if (empty ($data ['genre_image']))
                {
                    $data ['genre_image_err'] = 'Please upload genre image';
                }

                // Validate body 
                if (empty ($data ['body']))
                {
                    $data ['body_err'] = 'Please enter genre text';
                }

                // Make sure no errors
                if (empty ($data ['title_err']) /**&& empty ($data ['release_err'])**/ && empty ($data ['genre_image_err']) && empty ($data ['body_err']))
                {
                    // Separate Releases
                    $catSet = '';
                    $catArr = $_POST ['release'];

                    foreach($catArr as $cat)
                    {
                        $catSet = test_input ($catSet . $cat);

                        if ($cat != end ($_POST ['release']))
                        {    
                            $catSet = $catSet . ', ';
                        }
                    }

                    $data ['release'] = $catSet;

                    // $data = [
                    //     'id' => $id,
                    //     'genre_img' => '',
                    //     'title' => test_input ($_POST ['title']),
                    //     'body' => test_input ($_POST ['body']),
                    //     'catergoryname' => '',
                    //     'release' => $catSet,
                    //     'releases' => $releases,
                    //     'genre_image' => $image,
                    //     'user_id' => $_SESSION ['user_id'],
                    //     'title_err' => '',
                    //     'release_err' => '',
                    //     'genre_image_err' => '',
                    //     'body_err' => ''
                    // ];

                   // Validated 
                   if ($this->genreModel->updateGenre ($data))
                   {
                       // Check if image file is an actual image or fake image
                       $check = getimagesize($image_tmp_name);
                        
                       if ($check !== false)
                       {
                           move_uploaded_file($image_tmp_name, $target);
                       }

                       flash ('genre_message', 'Genre Updated');

                       redirect ('cms');
                   }
                   else
                   {
                       die ('Something went wrong');
                   }
                }
                else
                {
                    // Load view with errors
                    $this->view ('cms/edit_genre', $data);
                }
            }
            else
            {
                // Get existing genre from model
                $genre = $this->genreModel->getGenreById ($id);

                // // Check for owner
                // if ($genre->user_id != $_SESSION ['user_id'])
                // {
                //     redirect ('genres');
                // }

                $data = [
                    'id' => $id,
                    'genre_img' => $genre->genre_image,
                    'title' => $genre->title,
                    'body' => $genre->body,
                    'releasename' => $genre->music_release,
                    'release' => '',
                    'releases' => $releases,
                    'user_id' => '',
                    'genre_image' => '',
                    'title_err' => '',
                    'release_err' => '',
                    'genre_image_err' => '',
                    'body_err' => ''
                ];
    
                $this->view ('cms/edit_genre', $data);
            }
        }

        public function delete_genre ($id)
        {
            if ($_SERVER ['REQUEST_METHOD'] == 'POST')
            {
                // Get existing genre from model
                $genre = $this->genreModel->getGenreById ($id);

                $target = $_SERVER['DOCUMENT_ROOT'] . '/fricp/public/img/uploads/Genre_Image/' . $genre->genre_image;

                // // Check for owner
                // if ($genre->user_id != $_SESSION ['user_id'])
                // {
                //     redirect ('genres');
                // }

                if ($this->genreModel->deleteGenre ($id))
                {
                    // Delete genre Image
                    unlink ($target);

                    flash ('genre_message', 'Genre Removed');
                    redirect ('cms');
                }
                else
                {
                    die ('Something went wrong');
                }
            }
            else
            {
                redirect ('cms');
            }
        }

        public function music_release ()
        {
            // Track URL
            $_SESSION ['trackUrl'] = $this->resetUrl ('music_release');

            // die (test_input ($_POST ['track']));

            // Load Releases from database 
            $tracks = $this->releaseModel->getReleases ();

            if ($_SERVER ['REQUEST_METHOD'] == 'POST')
            {
                // // Sanitize POST array
                // $_POST = filter_input_array (INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'page' => 'music_release',
                    'track' => test_input ($_POST ['track']),
                    'user_id' => $_SESSION ['user_id'],
                    'track_err' => '',
                    'tracks' => $tracks,
                    
                ];

                // Validate track title 
                if (empty ($data ['track']))
                {
                    $data ['track_err'] = 'Please enter track title';
                }

                // Make sure no errors
                if (empty ($data ['track_err']))
                {
                   // Validated 
                   if ($this->releaseModel->addRelease ($data))
                   {
                       flash ('track_message', 'Track Added');

                       redirect ('cms/music_release');
                   }
                   else
                   {
                       die ('Something went wrong');
                   }
                }
                else
                {
                    // Load view with errors
                    $this->view ('cms/music_release', $data);
                }
            }
            else
            {

                $data = [
                    'page' => 'music_release',
                    'track' => '',
                    'user_id' => '',
                    'track_err' => '',
                    'tracks' => $tracks,
                ];
    
                $this->view ('cms/music_release', $data);
            }
        }

        public function delete_music_release ($id)
        {
            if ($_SERVER ['REQUEST_METHOD'] == 'POST')
            {
                // Get existing genre from model
                $track = $this->releaseModel->getReleaseById ($id);

                if ($this->releaseModel->deleteRelease ($id))
                {
                    flash ('track_message', 'Track Removed');
                    redirect ('cms/music_release');
                }
                else
                {
                    die ('Something went wrong');
                }
            }
            else
            {
                redirect ('cms/music_release');
            }
        }

        public function manage_admins ()
        {
            // Track URL
            $_SESSION ['trackUrl'] = $this->resetUrl ('manage_admins');
            

            $users = $this->userModel->getUsers ();

            // Check for POST
            if ($_SERVER ['REQUEST_METHOD'] == 'POST')
            {
                // Process form
        
                // // Sanitize POST data
                // $_POST = filter_input_array (INPUT_POST, FILTER_SANITIZE_STRING);

                // Encrypt password
                $password = test_input ($_POST ['password']);

                // Init data
                $data = [
                    'users' => $users,
                    'name' => test_input ($_POST ['name']),
                    'email' => test_input ($_POST ['email']),
                    'password' => $password,
                    'confirm_password' => test_input ($_POST ['confirm_password']),
                    'add_by' => $_SESSION ['user_id'],
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                ];

                // Validate Name
                if (empty ($data ['name']))
                {
                    $data ['name_err'] = 'Please enter name';
                }

                // Validate Email
                if (empty ($data ['email']))
                {
                    $data ['email_err'] = 'Please enter email';
                }
                else
                {
                    // Check email
                    if ($this->userModel->findUserByEmail ($data ['email']))
                    {
                        $data ['email_err'] = 'Email is already taken';
                    }
                }

                // Validate Password
                if (empty ($data ['password']))
                {
                    $data ['password_err'] = 'Please enter password';
                }
                elseif (strlen ($data ['password']) < 6)
                {
                    $data ['password_err'] = 'Password must be at least 6 characters';
                }

                // Validate Confirm Password
                if (empty ($data ['confirm_password']))
                {
                    $data ['confirm_password_err'] = 'Please enter confirm password';
                }
                else
                {
                    if ($data ['confirm_password'] != $data ['password'])
                    {
                        $data ['confirm_password_err'] = 'Passwords do not match';
                    }
                    else
                    {
                        $data ['password'] = secure_encrypt ($data ['password']);
                    }
                }

                // Make sure errors are empty
                if (empty ($data ['email_err']) && empty ($data ['name_err']) 
                && empty ($data ['password_err']) && empty ($data ['confirm_password_err']))
                {
                    // Validated
                    
                    // Hash Password
                    $data ['password'] = password_hash ($data ['password'], PASSWORD_DEFAULT);

                    // Register User
                    if ($this->userModel->register($data))
                    {
                        flash ('register_success', 'New Admin with name '. $data ['name'] . ', added and can now login.');
                       redirect ('cms');
                    }
                    else
                    {
                        die ('Something went wrong');
                    }
                }
                else
                {
                    // Load view with errors
                    $this->view ('cms/manage_admins', $data);
                }
            }
            else
            {
                // Init data
                $data = [
                    'users' => $users,
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'add_by' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                ];

                // Load view
                $this->view ('cms/manage_admins', $data);
            }
        }

        public function delete_admin ($id)
        {
            if ($_SERVER ['REQUEST_METHOD'] == 'POST')
            {
                // Get existing post from model
                $release = $this->userModel->getUserById ($id);

                if ($this->userModel->deleteUser ($id))
                {
                    flash ('user_message', 'Admin Removed');
                    redirect ('cms/manage_admins');
                }
                else
                {
                    die ('Something went wrong');
                }
            }
            else
            {
                redirect ('cms/manage_admins');
            }
        }

        public function comments () {

            // Track URL
            $_SESSION ['trackUrl'] = $this->resetUrl ('manage_admins');

            $getUnApprovedComments = $this->commentModel->getUnApprovedComments ();

            $getApprovedComments = $this->commentModel->getApprovedComments ();
            
            if ($_SERVER ['REQUEST_METHOD'] == 'POST')
            {
                // // Sanitize POST array
                // $_POST = filter_input_array (INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'title' => 'D-Z Tech Blog',
                    'unapprovedComments' => $getUnApprovedComments,
                    'approvedComments' => $getApprovedComments
                ];
            }
            else
            {
                $data = [
                    'title' => 'D-Z Tech Blog',
                    'unapprovedComments' => $getUnApprovedComments,
                    'approvedComments' => $getApprovedComments
                ];

                $this->view ('cms/comments', $data);
            }
        }

        public function approve_comment ($id)
        {
            
            if ($_SERVER ['REQUEST_METHOD'] == 'POST')
            {
                // Get existing post from model
                $genre = $this->commentModel->getOneCommentById ($id);

                $numApprovedComments = $genre->genresNoApprovedComments;

                $this->intComment = intval ($numApprovedComments);

                $data = [
                    'user_id' => $_SESSION ['user_id'],
                    'id' => $id,
                    'genre_id' => $genre->genreId,
                    'noApproved' => $this->intComment
                ];

                if ($this->commentModel->approveComment ($data))
                {
                    flash ('comment_message', 'Comment Approved');

                    ++$this->intComment;

                    $data = [
                        'user_id' => $_SESSION ['user_id'],
                        'id' => $id,
                        'genre_id' => $genre->genreId,
                        'noApproved' => $this->intComment
                    ];

                    $this->genreModel->noApproved($data);

                    redirect ('cms/comments');
                }
                else
                {
                    die ('Something went wrong');
                }
            }
            else
            {
                redirect ('cms/comments');
            }
        }

        public function delete_comment ($id)
        {
            if ($_SERVER ['REQUEST_METHOD'] == 'POST')
            {
                // Get existing genre from model
                $genre = $this->commentModel->getOneCommentById ($id);

                if ($this->commentModel->deleteComment ($id))
                {
                    flash ('comment_message', 'Comment Removed');

                    redirect ('cms/comments');
                }
                else
                {
                    die ('Something went wrong');
                }
            }
            else
            {
                redirect ('cms/comments');
            }
        }

        public function disapprove_comment ($id)
        {
            if ($_SERVER ['REQUEST_METHOD'] == 'POST')
            {
                // Get existing genre from model
                $genre = $this->commentModel->getOneCommentById ($id);

                $numApprovedComments = $genre->genresNoApprovedComments;

                $intComment = intval ($numApprovedComments);

                $data = [
                    'user_id' => $_SESSION ['user_id'],
                    'id' => $id,
                    'genre_id' => $genre->genreId,
                    'noApproved' => $intComment
                ];

                if ($this->commentModel->disapproveComment ($data))
                {
                    flash ('comment_message', 'Comment Disapproved');

                    --$intComment;

                    $data = [
                        'user_id' => $_SESSION ['user_id'],
                        'id' => $id,
                        'genre_id' => $genre->genreId,
                        'noApproved' => $intComment
                    ];

                    $this->genreModel->noApproved($data);

                    redirect ('cms/comments');
                }
                else
                {
                    die ('Something went wrong');
                }
            }
            else
            {
                redirect ('cms/comments');
            }
        }

        public function manage_ads () 
        {
            // Track URL
            $_SESSION ['trackUrl'] = $this->resetUrl ('manage_admins');

            $ads = $this->adsModel->getAds ();

            // Check for POST
            if ($_SERVER ['REQUEST_METHOD'] == 'POST')
            {
                // Upload Image
                $image = $_FILES ['ad_image']['name'];
                $target = $_SERVER['DOCUMENT_ROOT'] . "/fricp/public/img/uploads/Ad_Image/" . basename ($image);
                $image_tmp_name = $_FILES ['ad_image']['tmp_name'];

                $data = [
                    'ads' => $ads,
                    'title' => 'D-Z Tech Blog',
                    'company_name' => test_input ($_POST ['company_name']),
                    'company_email' => test_input ($_POST ['company_email']),
                    'company_website' => test_input ($_POST ['company_website']),
                    'phone_number' => test_input ($_POST ['phone_number']),
                    'ad_image' => $image,
                    'ad_body' => test_input ($_POST ['ad_body']),
                    'added_by' => $_SESSION ["user_id"],
                    'company_name_err' => '',
                    'company_email_err' => '',
                    'company_website_err' => '',
                    'phone_number_err' => '',
                    'ad_image_err' => '',
                    'ad_body_err' => ''
                ];
    

                // Validate Company Name
                if (empty ($data ['company_name']))
                {
                    $data ['company_name_err'] = 'Please enter company name';
                }

                // // Validate Company Email
                // if (empty ($data ['company_email']))
                // {
                //     $data ['company_email_err'] = 'Please enter company email';
                // }

                // // Validate Company Email
                // if (empty ($data ['company_website']))
                // {
                //     $data ['company_website_err'] = 'Please enter company website';
                // }

                // Validate Company Phone Number
                if (empty ($data ['phone_number']))
                {
                    $data ['phone_number_err'] = 'Please enter company phone number';
                }

                // Validate Company Ad Image
                if (empty ($data ['ad_image']))
                {
                    $data ['ad_image_err'] = 'Please enter ad image';
                }

                // Validate Company Ad Body
                if (empty ($data ['ad_body']))
                {
                    $data ['ad_body_err'] = 'Please enter ad body';
                }

                // Make sure errors are empty
                if (empty ($data ['company_name_err']) && empty ($data ['phone_number_err'])
                    && empty ($data ['ad_image_err']) && empty ($data ['ad_body_err']))
                {
                    // Validated 
                    if ($this->adsModel->createAd ($data))
                    {
                        // Check if image file is an actual image or fake image
                            $check = getimagesize($image_tmp_name);
                            
                            if ($check !== false)
                            {
                                move_uploaded_file($image_tmp_name, $target);
                                // die('Ad Image Added Successfully');
                            }

                            // die('Ad Image Failed');

                            flash ('ad_message', 'Ad Created Successfully');

                            redirect ('cms/manage_ads');
                    }
                    else
                    {
                        die ('Something went wrong');
                    }
                }
                else
                {
                    // Load view with errors
                    $this->view ('cms/manage_ads', $data);
                }
            }
            else
            {
                // Init data
                $data = [
                    'ads' => $ads,
                    'title' => 'D-Z Tech Blog',
                    'company_name' => '',
                    'company_name_err' => '',
                    'company_email' => '',
                    'company_email_err' => '',
                    'company_website' => '',
                    'company_website_err' => '',
                    'phone_number' => '',
                    'phone_number_err' => '',
                    'ad_image' => '',
                    'ad_image_err' => '',
                    'ad_body' => '',
                    'ad_body_err' => '',
                    'created_at' => '',
                    'user_id' => ''
                ];

                // Load view
                $this->view ('cms/manage_ads', $data);
            }
        }

        public function delete_ad ($id)
        {
            if ($_SERVER ['REQUEST_METHOD'] == 'POST')
            {
                // Get existing genre from model
                $release = $this->adsModel->getAdById ($id);

                if ($this->adsModel->deleteAd ($id))
                {
                    flash ('ad_message', 'Ad Removed');
                    redirect ('cms/manage_ads');
                }
                else
                {
                    die ('Something went wrong');
                }
            }
            else
            {
                redirect ('cms/manage_ads');
            }
        }

        public function resetUrl ($page)
        {
            $sessionUrl = explode ('/', $_SERVER ['PHP_SELF']);
            $sessionUrl [3] = 'cms';
            $sessionUrl [4] = $page;
            unset ($sessionUrl [0]);
            unset ($sessionUrl [1]);
            unset ($sessionUrl [2]);
            $session = implode ('/', $sessionUrl);

            return $session;
        }
    }