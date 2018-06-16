<section class="hero is-warning is-bold">
    <div class="hero-head">
        <nav class="navbar ">
            <div class="container">
                <div class="navbar-brand">
                    <a class="navbar-item" href="/">
                        <span class="title">
                            Camagru
                        </span>
                    </a>
                    <span class="navbar-burger burger"
                          data-target="navbarMenuHeroA">
                    <span></span>
                    <span></span>
                    <span></span>
                  </span>
                </div>
                <div id="navbarMenuHeroA" class="navbar-menu">
                    <div class="navbar-end">
                        <a class="navbar-item" href="/gallery">
                            Gallery
                        </a>
						<?php if (array_key_exists("login", $_SESSION)): ?>
                            <a class="navbar-item" href="/picture">
                                Take a picture
                            </a>
                            <a class="navbar-item" href="/user">
                                Parameters
                            </a>
                            <span class="navbar-item">
                                <a class="button is-warning is-inverted" href="/logout">
                                    <span class="icon">
                                        <i class="far fa-dot-circle"></i>
                                    </span>
                                    <span>Logout</span>
                                </a>
                            </span>
						<?php else: ?>
                            <span class="navbar-item">
                                <a class="button is-warning is-inverted"
                                   href="/login">
                                    <span class="icon">
                                        <i class="far fa-dot-circle"></i>
                                    </span>
                                    <span>Login</span>
                                </a>
                            </span>
						<?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</section>

<?php if (array_key_exists("message", $_SESSION)) { ?>
    <section
            class="section hero has-text-centered <?php echo $_SESSION["couleur"]; ?> is-bold">
        <div class="container">
            <h1 class="title"> <?php echo $_SESSION["message"]; ?> </h1>
        </div>
    </section>
<?php } ?>

<script src="/public/js/burger.js"></script>