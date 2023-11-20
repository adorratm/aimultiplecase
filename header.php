<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">AIMultiple Case Study</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-auto me-lg-0 align-items-center align-self-center align-content-center">
                <li class="nav-item"><a class="nav-link" href="index.php">1. Case</a></li>
                <li class="nav-item"><a class="nav-link" href="bot.php">2. Case</a></li>
                <li class="nav-item"><a class="nav-link" href="xss-unsecure.php?data=<?= "<script>alert('Xss Test')</script>" ?>">3. Case</a></li>
                <li class="nav-item"><a class="nav-link" href="xss-secure.php?data=<?= "<script>alert('Xss Test')</script>" ?>">4. Case</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img width="50" class="rounded-circle" src="https://avatars.githubusercontent.com/u/39022587" alt="EMRE KILIÇ">
                        EMRE KILIÇ
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" target="_blank" href="https://github.com/adorratm"><i class="fa fa-github"></i> Github</a>
                        </li>
                        <li>
                            <a class="dropdown-item" target="_blank" href="https://linkedin.com/in/emrekilic98"><i class="fa fa-linkedin"></i> Linkedin</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="mailto:emrekilic19983@gmail.com"><i class="fa fa-envelope-open"></i> emrekilic19983@gmail.com</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="tel:+905456239989"><i class="fa fa-phone"></i> +905456239989</a>
                        </li>
                        <li>
                            <a class="dropdown-item" target="_blank" href="https://wa.me/905456239989?text=<?= urlencode("Merhaba Emre,") ?>"><i class="fa fa-whatsapp"></i> Whatsapp</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>