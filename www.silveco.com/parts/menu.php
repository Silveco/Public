
<!-- Navigation -->

    <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
        <div class="top-menu">
            <div class="container">
                <div class="language-bar">
                    <div class="dropdown">
                        <button class="btn btn-lang dropdown-toggle" type="button" data-toggle="dropdown"><img class="flag-now" src="/img/si.svg" /> Slovenščina
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a href="/EN/" class="lang-txt"><img src="/img/gb.svg" />English</a></li>
                            <li><a href="/FR/" class="lang-txt"><img src="/img/fr.svg" />Français</a></li>
                        </ul>
                    </div>
                </div>
                <div class="contact-favicons">
                    <p>Kontakt: <strong>01 420 57 20 </strong> <a class="cyan" href="mailto:info@silveco.com"> info@silveco.com</a></p>
                    <div class="fb-like" data-href="https://www.facebook.com/silvecoprintinghouse/" data-layout="button_count" data-action="recommend" data-size="small" data-show-faces="true" data-share="true"></div>

                    <a href="mailto:info@silveco.com"><i class="fa fa-envelope-square" aria-hidden="true"></i></a>
                    <a target="_blank" href="https://www.facebook.com/silvecoprintinghouse/"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>

                </div>
                                          <div class="user-login lgin">
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                              <?php
                                              require_once('includes/config.php');

                                              ?>
                                              <?php if($user->is_logged_in()) {
                                                  echo '<a href="/logout.php" class="lgout">Odjava</a>';
                                                  echo $_SESSION['username'];

                                              } else {
                                                  echo '<a href="/login.php">Prijava</a>';
                                              }
                                              ?>
                                            </div>
            </div>
        </div>
        <div class="container topnav">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand topnav" href="/"><img class="logo" src="/img/Silvecologo-HW.png"/> </a>
            </div>



            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="/">
                            <p class="link-heading">Domov</p>
                            <p class="link-sub-heading">na naslovno stran</p>
                        </a>

                    </li>
                    <li>
                        <a href="/about-us">
                            <p class="link-heading">O podjetju</p>
                            <p class="link-sub-heading">nekaj podatkov</p>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <p class="link-heading">Dejavnosti</p>
                            <p class="link-sub-heading">s čim se ukvarjamo</p>

                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="/tiskarna">Tiskarna SILVECO</a></li>
                            <li><a href="/studio-orca">Grafični Studio ORCA</a></li>
                            <li><a href="/cd">Replikacija CD & DVD</a></li>
                            <li><a href="/omninet">Spletni Studio OMNINET</a></li>
                        </ul>
                    </li>
                    <!-- <li class="dropdown">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                             <p class="link-heading">Povezave</p>
                             <p class="link-sub-heading">do aplikacij</p>

                         </a>
                          <ul class="dropdown-menu">
                             <li><a href="http://app.silveco.si/index.php?controller=authentication" target="_blank">Partnerji dostop</a></li>
                             <li><a href="http://files.silveco.si" target="_blank">Upravljalec datotek</a></li>
                             <li><a href="https://host20.registrar-servers.com:2083/" target="_blank">Prijava v CPanel</a></li>
                             <li><a href="https://host20.registrar-servers.com:2096" target="_blank">Prijava v Webmail</a></li>
                         </ul>
                    </li>-->


                    <li>
                        <a href="/contact">
                            <p class="link-heading">Kontakt</p>
                            <p class="link-sub-heading">stopite v stik z nami</p>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
