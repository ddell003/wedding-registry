<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light site-navbar-target" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.html">Katie & Parker</a>
        <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <div class="navbar-collapse collapse" id="ftco-nav">
            <ul class="navbar-nav nav ml-auto">
                <li class="nav-item"><a href="#home-section" class="nav-link"><span>Home Large</span></a></li>
                <?php //<li class="nav-item"><a href="#groom-bride-section" class="nav-link"><span>Groom &amp; Bride</span></a></li>?>
                <?php //<li class="nav-item"><a href="#lovestory-section" class="nav-link"><span>Love Story</span></a></li> ?>
                <li class="nav-item"><a href="#greeting-section" class="nav-link"><span>Greetings</span></a></li>
                <li class="nav-item"><a href="#people-section" class="nav-link"><span>People</span></a></li>
                <li class="nav-item"><a href="#when-where-section" class="nav-link"><span>When &amp; Where</span></a></li>
                <li class="nav-item"><a href="#faq" class="nav-link"><span>FAQ</span></a></li>
                <li class="nav-item">
                    @auth
                        <a href="{{ url('/rsvp') }}" class="nav-link"><span>RSVP</span></a>
                    @else
                        <a href="{{ route('login') }}" class="nav-link"><span>RSVP</span></a>
                    @endauth

                </li>
                <li class="nav-item">
                    @auth
                        <a href="{{ url('/registry') }}" class="nav-link"><span>Registry</span></a>
                    @else
                        <a href="{{ route('login') }}" class="nav-link"><span>Registry</span></a>
                    @endauth

                </li>
                <li class="nav-item"><a href="#gallery-section" class="nav-link"><span>Gallery</span></a></li>
            </ul>
        </div>
    </div>
</nav>
