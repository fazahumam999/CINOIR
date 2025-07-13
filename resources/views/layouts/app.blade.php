<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CINOIR')</title>

    <!-- Bootstrap, DataTables, Icons & Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Prompt', sans-serif;
            background-color: #f9f9f9;
        }

        .sidebar {
            height: 100vh;
            width: 240px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 1rem;
        }

        .sidebar .nav-link {
            color: #fff;
            padding: 10px 20px;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #495057;
            color: #FFD700;
        }

        .sidebar .sidebar-title {
            color: #FFD700;
            text-align: center;
            font-weight: bold;
            font-size: 1.3rem;
            margin-bottom: 1rem;
        }

        .main-content {
            margin-left: 240px;
            padding: 1.5rem;
        }

        header {
            margin-bottom: 1.2rem;
        }

        .breadcrumb {
            background: none;
            padding-left: 0;
        }

        .breadcrumb-item a {
            text-decoration: none;
            color: #ffc107;
        }

        .breadcrumb-item.active {
            color: #6c757d;
        }

        footer {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.9rem;
            color: #aaa;
        }

        .btn-primary {
            background-color: #6f42c1;
            border: none;
        }

        .btn-primary:hover {
            background-color: #5936a2;
        }

        .table thead {
            background-color: #f1f1f1;
        }

        .card {
            border: none;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <nav class="sidebar d-flex flex-column">
        <div class="sidebar-title">
            <i class="bi bi-film"></i> CINOIR
        </div>
        <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="/admin/dashboard"><i class="bi bi-house-door"></i> Dashboard</a>
        <a class="nav-link {{ request()->is('admin/cinemas*') ? 'active' : '' }}" href="/admin/cinemas"><i class="bi bi-building"></i> Bioskop</a>
        <a class="nav-link {{ request()->is('admin/movies*') ? 'active' : '' }}" href="/admin/movies"><i class="bi bi-camera-reels"></i> Film</a>
        <a class="nav-link {{ request()->is('admin/banners*') ? 'active' : '' }}" href="{{ route('admin.banners.index') }}"><i class="bi bi-image"></i> Promotion</a>
        <a class="nav-link {{ request()->is('admin/schedules*') ? 'active' : '' }}" href="/admin/schedules"><i class="bi bi-calendar3"></i> Jadwal</a>
        <a class="nav-link {{ request()->is('admin/tickets*') ? 'active' : '' }}" href="/admin/tickets"><i class="bi bi-ticket-detailed"></i> Tiket</a>
        <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}" href="/admin/users"><i class="bi bi-person"></i> Pengguna</a>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <header>
            <h4>@yield('title')</h4>
            @hasSection('breadcrumb')
                @yield('breadcrumb')
            @endif
        </header>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        @endif

        @yield('content')

        <footer class="mt-4">
            <small>&copy; {{ date('Y') }} CineGold. All Rights Reserved.</small>
        </footer>
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    @stack('scripts')
    
</body>
</html>
