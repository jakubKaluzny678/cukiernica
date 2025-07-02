<?php
$host = 'localhost';
$db = 'cukierniaUsers';
$user = 'root';
$pass = '';
$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
$stmt = $pdo->query("SELECT * FROM photos ORDER BY uploaded_at DESC");
$photos = $stmt->fetchAll(PDO::FETCH_ASSOC);
$klasyczne = [];
$okolicznosciowe = array_filter($photos, fn($p) => $p['category'] === 'okolicznosciowe');

foreach ($photos as $photo) {
    if ($photo['category'] === 'klasyczne') {
        $klasyczne[] = $photo;
    } elseif ($photo['category'] === 'okolicznosciowe') {
        $okolicznosciowe[] = $photo;
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Domowe torty z sercem – artystyczne, klasyczne i okolicznościowe. Ręcznie zdobione, tematyczne dekoracje, zamówienia w Jedlcu." />
  <meta name="keywords" content="torty Jedlec, torty na zamówienie Jedlec, domowe torty Jedlec, cukiernia Jedlec, Cukiernica Jedlec" />
  <meta name="robots" content="index, nofollow" />
  <title>Cukiernica</title>
  <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"></noscript>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link rel="preload" href="./src/style.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-transparent text-body position-top sticky-desktop">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.html" rel="nofollow">
        <img src="testImages/cukierniaLogo-800.webp"
        alt="Logo pracowni cukierniczej Ewy Biegańskiej"
        class="img-fluid rounded-4">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="index.html">Strona Główna</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="inde">Oferta</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.html#orderingACake">Jak zamówić?</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-active" href="#" id="gallery">Galeria</a>
          </li>
          <li class="nav-item dropdown">
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Pierwsza Pozycja</a></li>
              <li><a class="dropdown-item" href="#">Druga Pozycja</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Trzecia Pozycja</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>      
    <div class="container-lg photoGallery" id="photoGalleryId">
      <div class="mainSectionGallery">
          <img
          src="testImages/Czekobanana1-left-400.webp" width="400" height="667" 
          alt="">
        <p class="text-muted">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magni, perferendis nostrum? Sed delectus eligendi dolor itaque iste officiis dicta exercitationem, porro placeat quo magnam odio voluptatibus adipisci omnis explicabo alias.</p>
        <button type="button" class="btn btn-dark btn-lg visitButton"><a href="#photoGallery">Odwiedź moją galerie</a></button>
      </div>
      <div class="container text-center" id="photoGallery">
        <div class="row photoGallery">
          <h1 class="text-center">Małe torty klasyczne</h1>
          <div class="col">
            <?php foreach ($klasyczne as $photo): ?>
            <div class="foto">
                <img src="admin/uploads/<?php echo htmlspecialchars($photo['filename']); ?>" alt="">
            </div>
          <?php endforeach; ?>
       </div>
          </div>
          <div class="col">
          </div>
          <div class="col">
          </div>
        </div>
        <div class="row photoGallery">
          <h1 class="text-center mt-5">Torty okolicznościowe</h1>
          <div class="col">
            <?php foreach ($okolicznosciowe as $photo): ?>
                <img src="admin/uploads/<?php echo htmlspecialchars($photo['filename']); ?>" alt="">
            <?php endforeach; ?>
          </div>
          <div class="col">
          </div>
          <div class="col">
          </div>
        </div>
      </div>
      <div class="row photoGallery">
        <h1 class="text-center mt-5">Torty artystyczne</h1>
          <div class="col">
            <video src="./src/images/galleryPhotos/galleryVideos/FDownloader.Net_AQNBUrasLO7DKh6jATDr8RAP0wY_WhOikd0OqqZKSRF3zZgi6DxNg9cdiZVzwHAH5hySUY2f8IN-6OYeLrclnsDg_720p_(HD).mp4" alt="" srcset="" class="rounded-4 img-fluid" autoplay controls muted loop>
          </div>
          <div class="col">
            <video src="./src/images/galleryPhotos/galleryVideos/FDownloader.Net_AQNP-t3hbdJ712LKrNveGXI3qDT24BO9CeQN9ooPQnJfZARAGTGv_hoVBtEmXbGuvxDCEUaYx8_4Sa7wNYqqSYLC_720p_(HD).mp4" alt="" srcset="" class="rounded-4 img-fluid" autoplay controls muted loop>
          </div>
          <div class="col">
            <video src="./src/images/galleryPhotos/galleryVideos/FDownloader.Net_AQNY1JXLJyU-8bz_Lj1-KkNepkgm6ncjgIfA79RK6fFSbPp2sAV7psQuVK_q1l6-CTCLkkZwqgNKVmUb1j2uIh3a_720p_(HD).mp4" alt="" srcset="" class="rounded-4 img-fluid" autoplay controls muted loop>
          </div>
        </h1>
      </div>
    </div>
    <button id="toggleSideBar" class="position-fixed start-0 top-50 translate-middle-y z-3 btn btn-dark" type="button" aria-label="Ikony social media">
      <i class="bi bi-person-lines-fill"></i>
  </button>
  <div class="scrolling-side-bar d-flex justify-content-center flex-column container position-fixed top-50 translate-middle-y align-items-center z-2 overflow-hidden gap-2" id="scrollSideBar" style="left: 0; width: 0; height: auto; transition: width 0.6s ease, padding 0.3s ease;">
  <a href="https://facebook.com" class="d-inline-block" aria-label="Odwiedź mojego Facebooka">
  <i class="bi bi-facebook rounded-4 p-1"
     style="background-color: #1877F2; color: #fff; text-align: center; font-size: 1.5rem;">
  </i>
  </a>
  <a href="" class="d-inline-block" aria-label="Odwiedź mojego Instagrama">
  <i class="bi bi-instagram rounded-4 p-1" style="background: linear-gradient(45deg, #feda77, #f58529, #dd2a7b, #8134af, #515bd4);color: #fff;text-align: center;font-size: 1.5rem;"></i>
  </a>
  <a href="" class="d-inline-block" aria-label="Zadzwoń do mnie">
  <i class="bi bi-telephone-fill rounded-4 p-1" style="background-color: #25D366;color: #fff;text-align: center;font-size: 1.5rem;" data-bs-toggle="tooltip" title="+48 726 771 575"></i>
  </a>
    <a target="_blank" href="https://maps.app.goo.gl/bn9HbbYfNUbPHyoWA" aria-label="Lokalizacja" class="d-inline-block" style="font-size: 1.5rem;">
    <i class="bi bi-geo-alt"></i>
  </a>
  </div>
</body>
<script defer>
      document.addEventListener('DOMContentLoaded', function () {
      const trigger = document.getElementById('toggleSideBar');
      const sidebar = document.getElementById('scrollSideBar');

      function showSidebarMobile() {
        sidebar.style.visibility = 'visible';
        sidebar.style.width = '4rem';
        trigger.style.display = 'none';
      }

      function hideSidebarMobile() {
        sidebar.style.width = '0';
        sidebar.style.visibility = 'hidden';
        trigger.style.display = 'block';
      }

      trigger.addEventListener('click', function (e) {
        e.stopPropagation();
        showSidebarMobile();
      });

      document.addEventListener('click', function (e) {
        if (!sidebar.contains(e.target) && !trigger.contains(e.target)) {
          hideSidebarMobile();
        }
      });

      sidebar.addEventListener('click', function (e) {
        e.stopPropagation();
      });
    });
    if (window.innerWidth >= 768) {
  const trigger = document.getElementById('toggleSideBar');
  const sidebar = document.getElementById('scrollSideBar');

  function showSidebarDesktop() {
    trigger.style.display = 'none';
    sidebar.style.visibility = 'visible';
    sidebar.style.width = '3.75rem';
    sidebar.style.padding = '1rem 0';
  }

  function hideSidebarDesktop() {
    setTimeout(() => {
      if (!sidebar.matches(':hover') && !trigger.matches(':hover')) {
        sidebar.style.width = '0';
        sidebar.style.padding = '0';
        sidebar.style.visibility = 'hidden';
        trigger.style.display = 'block';
      }
    }, 100); // krótka zwłoka, by nie migotało
  }

  trigger.addEventListener('mouseenter', showSidebarDesktop);
  trigger.addEventListener('mouseleave', hideSidebarDesktop);
  sidebar.addEventListener('mouseleave', hideSidebarDesktop);
}

</script>
<script> 
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>    
</html>
