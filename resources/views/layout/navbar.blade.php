<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sidebar Custom</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
    }

    .sidebar {
      width: 250px;
      height: 100vh;
      background-color: #1d2b41;
      color: white;
      padding-top: 20px;
    }

    .sidebar h4 {
      color: white;
      text-align: center;
      margin-bottom: 30px;
    }

    .nav-link {
      color: white;
      padding: 12px 20px;
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
      border-radius: 4px;
      transition: 0.2s ease;
      font-weight: 400;
    }

    .nav-link:hover,
    .nav-link.active {
      background-color: #2d63c8;
      color: white;
    }

    .nav-link i {
      font-size: 1.1rem;
    }

    .nav-item {
      margin-bottom: 5px;
    }

    .collapse .nav-link {
      padding-left: 40px;
    }
  </style>
</head>
<body>

  <div class="sidebar">
    <h4>E-Office</h4>
    <ul class="nav flex-column px-3" id="sidebarMenu">
      <li class="nav-item">
        <a href="/" class="nav-link"><i class="bi bi-globe"></i> Dashboard</a>
      </li>

      <li class="nav-item">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#masterDataMenu" aria-expanded="false">
          <i class="bi bi-database"></i> Master Data
        </a>
        <div class="collapse" id="masterDataMenu">
          <ul class="list-unstyled fw-normal pb-1 small ps-1">
            <li><a href="/departement" class="nav-link">Master Departemen</a></li>
            <li><a href="/pengguna" class="nav-link">Master Pengguna</a></li>
            <li><a href="/jenis-surat" class="nav-link">Master Jenis Surat</a></li>
            <li><a href="/tujuan-surat" class="nav-link">Master Tujuan Surat</a></li>
            <li><a href="/dokumen-proyek" class="nav-link">Master Dokumen Proyek</a></li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a href="/suratKeluar" class="nav-link"><i class="bi bi-envelope"></i> Surat Keluar</a>
      </li>
      <li class="nav-item">
        <a href="/pra-proyek" class="nav-link"><i class="bi bi-diagram-2"></i> Pra-Proyek</a>
      </li>
      <li class="nav-item">
        <a href="/monitoringProyek" class="nav-link"><i class="bi bi-kanban"></i> Monitoring Proyek</a>
      </li>
      <li class="nav-item">
        <a href="/laporan" class="nav-link"><i class="bi bi-file-earmark-text"></i> Laporan</a>
      </li>
      <li class="nav-item">
        <a href="/pengaturan" class="nav-link"><i class="bi bi-gear"></i> Pengaturan</a>
      </li>
    </ul>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Highlight Active Menu -->
  <script>
    const links = document.querySelectorAll('.nav-link');
    links.forEach(link => {
      link.addEventListener('click', function () {
        links.forEach(item => item.classList.remove('active'));
        this.classList.add('active');
      });
    });
  </script>

</body>
</html>
