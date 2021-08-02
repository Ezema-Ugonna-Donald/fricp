<?php
    class Pages extends Controller
    {
        public function __construct ()
        {
            $this->genreModel = $this->model ('Genre'); 

            $this->commentModel = $this->model ('Comment');  

            $this->releaseModel = $this->model ('Release');  

            $this->adsModel = $this->model ('Ad');
        }

        public function index ()
        {
            if (isset ($_GET ['search']))
            {
                $data = [
                    'title' => 'Fricp',
                    'genres' => '',
                    'search' => test_input ($_GET ['search']),
                    'searchResult' => '',
                    'page' => '',
                    'numGenres' => '',
                    'pageNum' => '',
                    'ads' => '',
                    'releases' => ''
                ];


                // Make sure field is not empty
                if (!empty ($data ['search']))
                {
                   // Validated 
                   redirect ('genres/search/' . $data ['search']);
                }
                else
                {
                    // Load view with errors
                    $this->view ('pages/index', $data);
                }
            }
            elseif (isset ($_GET ['page']) && !empty ($_GET ['page']))
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

                $pagination = $this->genreModel->pagination ($startPage, $endPage);
                
                $recentGenresPagination = $this->genreModel->pagination (0, $endPage);

                $numGenres = $this->genreModel->getGenres ();

                $genreCount = count ($numGenres);

                $genrePaginate = $genreCount / 4;

                $genrePaginate = ceil ($genrePaginate);

                $ads = $this->adsModel->getAds ();

                $releases = $this->releaseModel->getReleases ();

                $data = [
                    'title' => 'In Your Head',
                    'genres' => $pagination,
                    'search' => '',
                    'searchResult' => '',
                    'page' => test_input ($_GET ['page']),
                    'numGenres' => $genrePaginate,
                    'genreCount' => $genreCount,
                    'pageNum' => $page,
                    'ads' => $ads,
                    'genres' => $genres,
                    'recentGenres' => $recentGenresPagination
                ];
                

                $this->view ('pages/index', $data);
            }
            else
            {
                $startPage = (1 * 4) - 4;

                $endPage = 4;

                $pagination = $this->genreModel->pagination ($startPage, $endPage);
                
                $recentGenresPagination = $this->genreModel->pagination (0, $endPage);

                $genres = $this->genreModel->getGenres ();

                $numGenres = $genres;

                $genreCount = count ($numGenres);

                $genrePaginate = $genreCount / 4;

                $genrePaginate = ceil ($genrePaginate);

                $ads = $this->adsModel->getAds ();

                $releases = $this->releaseModel->getReleases ();

                $data = [
                    'title' => 'Fricp',
                    'genres' => $pagination,
                    'search' => '',
                    'searchResult' => '',
                    'page' => '',
                    'numGenres' => $genrePaginate,
                    'genreCount' => $genreCount,
                    'pageNum' => 1,
                    'ads' => $ads,
                    'releases' => $releases,
                    'recentGenres' => $recentGenresPagination
                ];

                $this->view ('pages/index', $data);
            } 
        }

        public function about ()
        {
            $data = [
                'title' => 'About Us'
            ];
            $this->view ('pages/about', $data); 
        }
    }
    