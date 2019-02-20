<nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
    <div class="container"><a class="navbar-brand" href="#">Kamu</a><button class="navbar-toggler"
            data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item" role="presentation"><a class="nav-link" href="#">Restaurants</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="#">Food</a></li>
                <?php if(loggedIn()){
                            echo '<li class="nav-item" role="presentation"><a class="nav-link" href="#">Saved Lists</a></li>';
                            echo '<li class="nav-item" role="presentation"><a class="nav-link" href="#">Recent</a></li>';
                        }
                        ?>
            </ul>
            <span class="navbar-text actions">
                <?php
                    if (!loggedIn()){
                        echo '<a href="/mcv/public/page/login" class="login">Log In</a>';
                        echo '<a class="btn btn-light action-button" role="button" href="/mcv/public/page/signup">Sign Up</a>';
                    }
                    if (loggedIn()){
                        echo '<a class="btn btn-light action-button" role="button" href="/mcv/public/account/logout">Sign Out</a>';
                    }
                    ?>
            </span>
        </div>
    </div>
</nav>