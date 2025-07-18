<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">CertBy Mailer</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <button class="btn btn-outline-dark" id="darkModeToggle" onclick="toggleDarkMode()">
            <i class="fas fa-moon" id="darkModeIcon"></i>
          </button>
        </li>
      </ul>
      <form class="d-flex" action="logout.php" method="post">
        <button class="btn btn-danger" type="submit"><i class="fas fa-sign-out-alt"></i> Çıkış Yap</button>
      </form>
    </div>
  </div>
</nav>
