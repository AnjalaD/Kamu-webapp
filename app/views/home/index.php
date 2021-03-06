<?php $this->set_title('Home'); ?>
<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<form id="search-form-SearchBar" class="search-form" method="post" action="<?=SROOT?>search" maxlength="50">
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text" id="inputGTSearch"><i class="fa fa-search" id="searchIcon"></i></span></div>
            <input class="form-control Home_SearchBar" autocomplete="off" type="text" placeholder="I am looking for.." name="search_string" id="Home_SearchBar">
            <div class="input-group-append">
                <button class="btn btn-light" type="submit" name="restaurant" value="1" id="buttonRestaurent" style="font-weight:bold;">Restaurant</button>
                <button class="btn btn-light" type="submit" name="food" value="1" id="buttonFood" style="font-weight:bold;">Food</button>
            </div>
        </div>
    </form>
    <!-- End: Pretty Search Form -->
    <div class="carousel slide" data-ride="carousel" id="carousel-1" data-interval="4000">
        <div class="carousel-inner" role="listbox" style="height:500px;">
            <div class="carousel-item"><img class="w-100 d-block" src="<?=SROOT?>assets/img/home_res1.jpg" alt="Slide Image"></div>
            <div class="carousel-item"><img class="w-100 d-block" src="<?=SROOT?>assets/img/home_res2.jpg" alt="Slide Image"></div>
            <div class="carousel-item active"><img class="w-100 d-block" src="<?=SROOT?>assets/img/home_res3.jpg" alt="Slide Image"></div>
        </div>
        <div>
            <!-- Start: Previous --><a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev"><span class="carousel-control-prev-icon"></span><span class="sr-only">Previous</span></a>
            <!-- End: Previous -->
            <!-- Start: Next --><a class="carousel-control-next" href="#carousel-1" role="button" data-slide="next"><span class="carousel-control-next-icon"></span><span class="sr-only">Next</span></a>
            <!-- End: Next -->
        </div>
        <ol class="carousel-indicators">
            <li data-target="#carousel-1" data-slide-to="0"></li>
            <li data-target="#carousel-1" data-slide-to="1"></li>
            <li data-target="#carousel-1" data-slide-to="2" class="active"></li>
        </ol>
    </div>
    <p id="paraHowitWorks" style="font-family:Aclonica;">How it works?</p>
    <!-- Start: 1 Row 3 Columns -->
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-4" id="column1"><img src="<?=SROOT?>assets/img/icons8-pie-64.png" id="tinyImage1" class="tinyImage" style="background-position:center;">
                    <p id="paragraphTextTopic1" class="paragraphTextTopic">Search the taste....<br></p>
                    <p id="paragraphText1" class="paragraphText">You can search for different tastes in world class restaurents<br></p>
                </div>
                <div class="col-md-4" id="column2"><img src="<?=SROOT?>assets/img/icons8-list-view-64.png" id="tinyImage2" class="tinyImage">
                    <p id="paragaraphTextTopic2" class="paragraphTextTopic">Save what you prefer...<br></p>
                    <p id="paragaraphText2" class="paragraphText">You can Save yor preferences and re use whenever you want&nbsp;<br></p>
                </div>
                <div class="col-md-4" id="column3"><img src="<?=SROOT?>assets/img/no-waiting.png" id="tinyImage3" class="tinyImage">
                    <p id="paragraphTextTopic3" class="paragraphTextTopic">No waiting...<br></p>
                    <p id="paragraphText3" class="paragraphText">You don't have to wait in the queue anymore. Just send your menu..<br></p>
                </div>
            </div>
        </div>
    </div>
    <!-- End: 1 Row 3 Columns -->
    <!-- Start: Footer Clean -->
    <div id="footer" class="footer-clean">
        <footer>
            <div class="container">
                <div class="row justify-content-center">
                    
                    <!-- End: Developed By -->
                    <!-- Start: Careers -->
                    <div class="col-sm-7 col-md-3 item">
                        <h3 id="Heading3" class="Heading">Developed By</h3>
                        <ul id="footerText3" class="footerText">
                            <li><a href="#">Anjala Dilhara</a></li>
                            <li><a href="#">Budvin Chathura</a></li>
                            <li><a href="#">Thumula Perera</a></li>
                            <li><a href="#">Chamika Nandasiri</a></li>

                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-3 item"></div>
                    <!-- End: Careers -->
                    <!-- Start: Social Icons -->
                    <div class="col-lg-3 item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a>
                        <p class="copyright">devSoft Ltd.</p>
                    </div>
                    <!-- End: Social Icons -->
                </div>
            </div>
        </footer>
    </div>

<?php $this->end(); ?>