<header>
    <nav>
        <div class="navbar-container">
            <div class="nav">
                
                <div class="search-form">
                    <form action="<?= $_SERVER ['PHP_SELF'] ?>" method="get">
                        <div class="navbar-search">
                            <a id="pre-search" title="sehch-me" href="#">
                                sech me
                            </a>
                        </div>
                        <div class="nav-search">
                            <!-- <span id="search-hover"><img src="/img/icons/dzt-sehch-icon-01" alt=""></span>  -->
                            <div class="nav-search-input">
                                <!-- <i class="fas fa-search"></i> -->
                                <input type="text" name="search" id="" placeholder="Juoh Esseh..." value="<?= $data ['search'] ?>">
                            </div>
                            <!-- <div>
                                <a id="sehcha" title="sehch-me-oo" href="#">
                                    sehch me ooo
                                </a>
                            </div> -->
                        </div>
                    </form>
                </div>
                
                <!-- <div class="nav-title">
                    <a href="<?= URLROOT ?>"><img class="nav-logo" src="<?= URLROOT ?>/img/logo/fricpLogoSkinTexture.png" alt="Site Logo"> <span><?= SITENAME ?></span></a>
                </div> -->
                <!-- <div class="navbar-close">
                    <i class="fas fa-times"></i>
                </div> -->
            </div>

            <a href="<?= URLROOT ?>" title="home button">
                <div class="navbar-logo" >
                    <img src="<?= URLROOT ?>/img/logo/fricp.png" alt="Fric P, the intellectual beat killer">
                </div>               
            </a>
            
            <a href="#" title="menu-button">
                <div class="navbar-menu" href="#">
                    <img src="<?= URLROOT ?>/img/icons/dzt-menu-icon-00.png" alt="browse me">
                </div>
            </a>
        </div>
        <div class="nav-wrapper">
            <div class="navbar">
                <a href="<?= URLROOT ?>">
                    <div class="navbar-tab">Home</div>
                </a>
                <a href="#">
                    <div class="navbar-tab dropdown">In Your Head</div>
                </a>
                <a href="#">
                    <div class="navbar-tab">About</div>
                </a>
                <a href="#">
                    <div class="navbar-tab">Contact</div>
                </a>
                <a href="#">
                    <div class="navbar-tab">Login</div>
                </a>
                <a href="#">
                    <div class="navbar-tab">Register</div>
                </a>
            </div>
        </div>
    </nav>
</header>