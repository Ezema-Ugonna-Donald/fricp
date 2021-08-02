<?php
    class Genres extends Controller
    {
        public function __construct ()
        {
            $this->genreModel = $this->model ('Genre');

            $this->userModel = $this->model ('User');

            $this->commentModel = $this->model ('Comment'); 

            $this->releaseModel = $this->model ('Release');  

            $this->intComment = 0; 

            $this->adsModel = $this->model ('Ad');
        }

        // public function index ()
        // {
        //     // Get genres
        //     $genres = $this->genreModel->getGenres ();

        //     $data = [
        //         'title' => 'Web Lore',
        //             'genres' => $genres,
        //             'search' => '',
        //             'searchResult' => '',
        //             'page' => '',
        //             'numGenres' => '',
        //             'pageNum' => '',
        //             'ads' => '',
        //             'releases' => ''
        //     ];

        //     $this->view ('genres/index', $data);
        // }

        public function show ($genreTitleId)
        {
            $titleId = explode ('-', $genreTitleId);

            $title = implode (' ', $titleId);

            // die($title);

            $genre = $this->genreModel->getGenreByTitle ($title);

            // die($genre->user_id);

            $id = (int) $genre->genreId;
            // $id = $genre->genreId;

            // die($id);

            $getComments = $this->commentModel->getApprovedCommentsById ($id);

            // die ($getComments->genreTitle);

            $releases = $this->releaseModel->getReleases ();

            $startPage = (1 * 4) - 4;

            $endPage = 4;

            $pagination = $this->genreModel->pagination ($startPage, $endPage);

            $genres = $this->genreModel->getGenres ();

            $numGenres = $genres;

            $genreCount = count ($numGenres);

            $genrePaginate = $genreCount / 4;

            $genrePaginate = ceil ($genrePaginate);

            // Count Number of comments on genre
            $numOfComments = count ($getComments);

            $ads = $this->adsModel->getAds ();

            // $user = $this->userModel->getUserById ($genre->user_id);

            $data = [
                'genre' => $genre,
                'genres' => $pagination,
                'search' => '',
                'id' => $id,
                'numOfComments' => $numOfComments,
                'getComments' => $getComments,
                'releases' => $releases,
                'ads' => $ads
            ];

            // die ($data["ads"][0]->company_name);

            $this->view ('genres/show', $data);
        }

        public function search ($search)
        {
            $searchParameter = substr($_SERVER ['REQUEST_URI'], 25);
            
            $searchTest = explode ('%20', $searchParameter);
            $resultSearch = implode (' ', $searchTest);

            // print_r($resultSearch);

            $genres = $this->genreModel->getGenres ();

            $releases = $this->releaseModel->getReleases ();

            $startPage = (1 * 4) - 4;

            $endPage = 4;

            $pagination = $this->genreModel->pagination ($startPage, $endPage);

            $numGenres = $genres;

            $genreCount = count ($numGenres);

            $genrePaginate = $genreCount / 4;

            $genrePaginate = ceil ($genrePaginate); 

            $ads = $this->adsModel->getAds ();
            
            if (isset ($_GET ['page']) && !empty ($_GET ['page'])) 
            {
                $page = test_input ($_GET ['page']);

                // Condition if user enters parameter less than or equal to 0
                if ($page < 1) 
                {
                    $startPage = 0;
                }
                else
                {
                    $startPage = ($page * 4) - 4;
                }
                 
                $endPage = 4;

                $searchPagination = $this->genreModel->searchPagination ($resultSearch, $startPage, $endPage);

                $genres = $this->genreModel->searchGenres ($resultSearch);
                die($genres);

                $numGenres = $genres;

                $genreCount = count ($numGenres);

                $genrePaginate = $genreCount / 4;

                $genrePaginate = ceil ($genrePaginate);

                $data = [
                    'title' => 'Fricp',
                    'numOfComments' => '',
                    'genres' => $pagination,
                    'genre' => $pagination,
                    'numGenres' => $genrePaginate,
                    'genreCount' => $genreCount,
                    'pageNum' => $page,
                    'search' => $searchParameter,
                    'searchResult' => $searchPagination,
                    'releases' => $releases,
                    'ads' => $ads
                ];

                $this->view ('genres/search', $data);
            }
            elseif($searchPagination = $this->genreModel->searchPagination ($resultSearch, $startPage, $endPage))
            {
                $genres = $this->genreModel->searchGenres ($resultSearch);

                $numGenres = $genres;

                $genreCount = count ($numGenres);

                $genrePaginate = $genreCount / 4;

                $genrePaginate = ceil ($genrePaginate);

                $data = [
                    'title' => 'Fricp',
                    'numOfComments' => '',
                    'genres' => $pagination,
                    'genre' => $pagination,
                    'numGenres' => $genrePaginate,
                    'isnsightCount' => $genreCount,
                    'pageNum' => 1,
                    'search' => $searchParameter,
                    'searchResult' => $searchPagination,
                    'releases' => $releases,
                    'ads' => $ads
                ];

                $this->view ('genres/search', $data);
            }
            else
            {
                $data = [
                    'title' => 'Fricp',
                    'numOfComments' => '',
                    'genres' => $pagination,
                    'genre' => $pagination,
                    'numGenres' => $genrePaginate,
                    'genreCount' => $genreCount,
                    'pageNum' => 1,
                    'search' => $searchParameter,
                    'searchResult' => $searchPagination,
                    'releases' => $releases,
                    'ads' => $ads
                ];

                $this->view ('genres/search', $data);
            }
        }

        public function release ($release)
        {
            $releaseParameter = substr($_SERVER ['REQUEST_URI'], 31);

            // die ($releaseParameter);
            
            // $releaseParameter = substr($_SERVER ['REQUEST_URI'], 18);
            // die(substr($_SERVER ['REQUEST_URI'], 29));

            // die ($releaseParameter);
            
            $slashpos = strpos($releaseParameter, "/");

            // die ($slashpos);
                
            if ($slashpos > 0) 
                $releaseParameter = substr($releaseParameter, 0, $slashpos);
            
            $releaseTest = explode ('%20', $releaseParameter);
            $resultReleases = implode (' ', $releaseTest);
            
            // var_dump($releaseTest);
            // die($resultReleases);
            
            $genre = $this->genreModel->getGenresWithRelease ($resultReleases);
            // die(var_dump($genre));

            // $genres = $this->genreModel->getGenres ();

            $releases = $this->releaseModel->getReleases ();

            $startPage = (1 * 4) - 4;

            $endPage = 4;

            $pagination = $this->genreModel->getGenresWithReleasePagination ($resultReleases, $startPage, $endPage);
            
            $genrePagination = $this->genreModel->pagination ($startPage, $endPage);

            $genres = $this->genreModel->getGenresWithRelease ($resultReleases);

            $numGenres = $genres;

            $genreCount = count ($numGenres);

            $genrePaginate = $genreCount / 4;

            $genrePaginate = ceil ($genrePaginate);

            $ads = $this->adsModel->getAds ();

            if (isset ($_GET ['page']) && !empty ($_GET ['page'])) 
            {
                $page = test_input ($_GET ['page']);

                // Condition if user enters parameter less than or equal to 0
                if ($page < 1) 
                {
                    $startPage = 0;
                }
                else
                {
                    $startPage = ($page * 4) - 4;
                }
                 
                $endPage = 4;

                $pagination = $this->genreModel->getGenresWithReleasePagination ($resultReleases, $startPage, $endPage);
                
                $genrePagination = $this->genreModel->pagination (0, $endPage);

                $genres = $this->genreModel->getGenresWithRelease ($resultReleases);

                $numGenres = $genres;

                $genreCount = count ($numGenres);

                $genrePaginate = $genreCount / 4;

                $genrePaginate = ceil ($genrePaginate);

                $data = [
                    'genres' => $genrePagination,
                    'genre' => $pagination,
                    'search' => '',
                    'numGenres' => $genrePaginate,
                    'genreCount' => $genreCount,
                    'pageNum' => $page,
                    'releaseKey' => $resultReleases,
                    'releases' => $releases,
                    'ads' => $ads
                ];

                $this->view ('genres/release', $data);
            }
            // elseif ($pagination = $this->genreModel->getGenresWithReleasePagination ($resultRelease, $startPage, $endPage))
            // {
            //     $genres = $this->genreModel->getGenresWithRelease ($resultRelease);
                
            //     $genrePagination = $this->genreModel->pagination ($startPage, $endPage);

            //     $numGenres = $genres;

            //     $genreCount = count ($numGenres);

            //     $genrePaginate = $genreCount / 4;

            //     $genrePaginate = ceil ($genrePaginate);

            //     $data = [
            //         'genres' => $genrePagination,
            //         'genre' => $pagination,
            //         'search' => '',
            //         'numGenres' => $genrePaginate,
            //         'genreCount' => $genreCount,
            //         'pageNum' => 1,
            //         'releaseKey' => $resultRelease,
            //         'releases' => $releases
            //     ];

            //     $this->view ('genres/releases', $data);
            // }
            else
            {
                $data = [
                    'genres' => $genrePagination,
                    'genre' => $pagination,
                    'search' => '',
                    'numGenres' => $genrePaginate,
                    'genreCount' => $genreCount,
                    'pageNum' => 1,
                    'releaseKey' => $resultReleases,
                    'releases' => $releases,
                    'ads' => $ads
                ];

                $this->view ('genres/release', $data);
            }
        }

        public function comments ($id) 
        {
            // Load Approved Comments from database 
            $getComments = $this->commentModel->getApprovedCommentsById ($id);

            $getUnApprovedComments = $this->commentModel->getUnApprovedCommentsById ($id);
            
            $title = sizeof($getComments) != 0 ? $getComments[0]->genreTitle : $getUnApprovedComments[0]->genreTitle;

            $titleArray = explode (' ', $title);

            $titleId = implode ('-', $titleArray);

            if ($_SERVER ['REQUEST_METHOD'] == 'POST')
            {
                // // Sanitize POST array
                // $_POST = filter_input_array (INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'getComments' => $getComments,
                    'id' => $id,
                    'commentator' => test_input ($_POST ['commentator']),
                    'commentatorEmail' => test_input ($_POST ['commentatorEmail']),
                    'commentatorWebsite' => test_input ($_POST ['commentatorWebsite']),
                    'comment' => test_input ($_POST ['comment']),
                    'commentator_err' => '',
                    'comment_err' => '',                    
                ];

                // Validate commentator 
                if (empty ($data ['commentator']))
                {
                    $data ['commentator_err'] = 'Please enter name';
                }

                // Validate comment 
                if (empty ($data ['comment']))
                {
                    $data ['comment_err'] = 'Please enter comment';
                }

                // Make sure no errors
                if (empty ($data ['commentator_err']) && empty ($data ['comment_err']))
                {
                   // Validated 
                   if ($this->commentModel->addComment ($data))
                   {
                       $getUnApprovedComments = $this->commentModel->getUnApprovedCommentsById ($id);
            
                        $title = sizeof($getComments) != 0 ? $getComments[0]->genreTitle : $getUnApprovedComments[0]->genreTitle;
            
                        $titleArray = explode (' ', $title);
            
                        $titleId = implode ('-', $titleArray);
                       
                       flash ('comment_message', 'Thanks for your contribution. Your comment will be approved soon');
                       
                       $this->commentAlert();

                       redirect ('genres/show/'. $titleId);
                   }
                   else
                   {
                       die ('Something went wrong');
                   }
                }
                else
                {
                    // Load view with errors
                    redirect ('genres/show/'. $titleId);
                }
            }
            else
            {

                $data = [
                    'getComments' => $getComments,
                    'id' => $id,
                    'commentator' => '',
                    'commentatorEmail' => '',
                    'commentatorWebsite' => '',
                    'comment' => '',
                    'commentator_err' => '',
                    'comment_err' => '',   
                ];
    
                $this->view ('genres/show/' . $titleId, $data);
            }
        }

        public function commentAlert() 
        {
            $to = 'donald.ezema@deziccapelotechnologies.com';
            $from = 'info@deziccapelotechnologies.com';
            $subject = 'D-Z Tech Blog: Comment Alert';
            $message = "Hello, \r\nSomeone just commented on your article.\r\n";
            $headers = 'From:'. $from . "\r\n"; // Sender's Email
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=utf-8\r\n";
    
            if (mail($to, $subject, $message, $headers))
            {
                return true;
            }
            else 
            {
                return false;
            }
        }

        public function test ($release)
        {
            // $pagination = $this->genreModel->getGenresWithReleasePagination ('PHP', 0, 4);

            $searchParameter = substr($_SERVER ['REQUEST_URI'], 23);
            
            $searchTest = explode ('%20', $searchParameter);
            $resultSearch = implode (' ', $searchTest);

            // print_r($resultSearch);
            echo $resultSearch . ": This release<br>";


                // Condition if user enters parameter less than or equal to 0
                if (0 < 1) 
                {
                    $startPage = 0;
                }
                else
                {
                    $startPage = ($page * 4) - 4;
                }
                 
                $endPage = 4;

                $searchPagination = $this->genreModel->searchPagination ($resultSearch, $startPage, $endPage);
                $genres = $this->genreModel->searchGenres ($resultSearch);

                $numGenres = $genres;

            try
            {    
                // $genre = $this->genreModel->getGenresWithRelease ('CSS');

                var_dump ($searchPagination);
            }
            catch (Exception $e)
            {
                die ($e->getMessage ());
            }
        }
    }