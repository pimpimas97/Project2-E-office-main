<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Master Dokumen Proyek</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('css/main.css') }}"/>
  <style>
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
    }

    .wrapper {
      display: flex;
      height: 100vh;
      overflow: hidden;
    }

    .sidebar {
      width: 250px;
      background-color: #f8f9fa;
      border-right: 1px solid #dee2e6;
      flex-shrink: 0;
    }

    .content {
      flex-grow: 1;
      overflow-y: auto;
      padding: 2rem;
      background-color: #f5f5f5;
    }

    .content-inner {
      min-height: 100%;
    }
  </style>
</head>
<body>

<div class="wrapper">
  <!-- Sidebar -->
  <div class="sidebar">
    @include('layout.navbar')
  </div>

  <!-- Konten utama scrollable -->
  <div class="content">
    <div class="content-inner">

      <!-- Header -->
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold m-0">Master Dokumen Proyek</h5>
        <div class="d-flex align-items-center">
          <img src="{{ asset('img/user-icon.png') }}" alt="User Icon" width="20" class="me-2" />
          <span>Admin User</span>
        </div>
      </div>

      <hr class="mb-4 mt-2">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb bg-body-tertiary p-2 rounded">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Dokumen Proyek</li>
        </ol>
      </nav>
<!-- Form Dokumen Proyek -->
<div class="card shadow-sm mb-5">
  <div class="card-body">
    <h4 class="card-title text-center mb-4">
      {{ isset($dokumen) ? 'Edit Dokumen Proyek' : 'Form Master Dokumen Proyek' }}
    </h4>
    
    <form action="{{ isset($dokumen) ? route('dokumen-proyek.update', $dokumen->id_dokumen) : route('dokumen-proyek.store') }}" 
          method="POST" enctype="multipart/form-data">
      @csrf
      @if(isset($dokumen))
        @method('PUT')
      @endif

      <div class="mb-3">
        <label for="id_dokumen" class="form-label">ID Dokumen</label>
        <input type="text" class="form-control" name="id_dokumen"
               value="{{ old('id_dokumen', $dokumen->id_dokumen ?? '') }}"
               placeholder="Masukkan ID Dokumen" {{ isset($dokumen) ? 'readonly' : '' }}>
      </div>

      <div class="mb-3">
        <label for="jenis_dokumen" class="form-label">Jenis Dokumen</label>
        <select class="form-select" name="jenis_dokumen">
          <option disabled {{ !isset($dokumen) ? 'selected' : '' }}>-- Pilih Jenis Dokumen --</option>
          <option value="Surat" {{ (old('jenis_dokumen', $dokumen->jenis_dokumen ?? '') == 'Surat') ? 'selected' : '' }}>Surat</option>
          <option value="Memo" {{ (old('jenis_dokumen', $dokumen->jenis_dokumen ?? '') == 'Memo') ? 'selected' : '' }}>Memo</option>
          <option value="Laporan" {{ (old('jenis_dokumen', $dokumen->jenis_dokumen ?? '') == 'Laporan') ? 'selected' : '' }}>Laporan</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="template_dokumen" class="form-label">Template Dokumen</label>
        <input type="file" class="form-control" name="template_dokumen">
        @if(isset($dokumen) && $dokumen->template_dokumen)
          <small class="text-muted">
            File saat ini: <a href="{{ Storage::url($dokumen->template_dokumen) }}" target="_blank">{{ basename($dokumen->template_dokumen) }}</a>
          </small>
        @endif
      </div>

      <div class="mb-4">
        <label for="approval" class="form-label">Persyaratan Approval</label>
        <input type="text" class="form-control" name="approval"
               value="{{ old('approval', $dokumen->approval ?? '') }}"
               placeholder="Contoh: Manajer Proyek, Direktur">
      </div>

      <div class="d-flex flex-wrap gap-2">
        <button type="submit" class="btn btn-success">
          {{ isset($dokumen) ? 'Update' : 'Simpan' }}
        </button>
        @if(isset($dokumen))
          <a href="{{ route('dokumen-proyek.index') }}" class="btn btn-secondary">Batal</a>
        @else
          <a href="{{ route('dokumen-proyek.index') }}" class="btn btn-primary">Tampilkan</a>
        @endif
      </div>
    </form>
  </div>
</div>

      <!-- Tabel Dokumen Proyek -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-3">Data Dokumen Proyek</h5>
          @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif
          <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
              <thead class="table-light">
                <tr>
                  <th>ID Dokumen</th>
                  <th>Jenis Dokumen</th>
                  <th>Template</th>
                  <th>Persyaratan Approval</th>
                  <th class="text-center" style="width: 80px;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($data as $item)
                  <tr>
                    <td>{{ $item->id_dokumen }}</td>
                    <td>{{ $item->jenis_dokumen }}</td>
                    <td>
                      @if($item->template_dokumen)
                        <a href="{{ Storage::url($item->template_dokumen) }}" target="_blank">{{ basename($item->template_dokumen) }}</a>
                      @else
                        <em>Tidak ada file</em>
                      @endif
                    </td>
                    <td>{{ $item->approval }}</td>
                    <td class="text-center d-flex gap-1 justify-content-center">
                      <a href="{{ route('dokumen-proyek.edit', $item->id_dokumen) }}" class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil-square"></i>
                      </a>  
                      <form action="{{ route('dokumen-proyek.destroy', $item->id_dokumen) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr><td colspan="5" class="text-center text-muted">Belum ada data.</td></tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div> <!-- end content-inner -->
  </div> <!-- end content -->
</div> <!-- end wrapper -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
