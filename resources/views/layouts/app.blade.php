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
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
    :root {
        --primary-dark: #0D1323;
        --primary-light: #1D2A4A;
        --primary-accent: #3A506B;
        --secondary-color: #5BC0BE;
        --light-bg: #F8FAFC;
        --text-dark: #1E293B;
        --text-light: #64748B;
    }
    
    body {
        font-family: 'Prompt', sans-serif;
        background-color: var(--light-bg);
        color: var(--text-dark);
        overflow-x: hidden;
    }

    /* Sidebar Styling */
    .sidebar {
        height: 100vh;
        width: 240px;
        position: fixed;
        top: 0;
        left: 0;
        background-color: var(--primary-dark);
        padding: 1.5rem 0;
        box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        transition: all 0.3s ease;
    }

    .sidebar .sidebar-title {
        color: white;
        text-align: center;
        font-weight: 600;
        font-size: 1.5rem;
        margin-bottom: 2rem;
        padding: 0 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
    }

    .sidebar .sidebar-title i {
        color: var(--secondary-color);
        font-size: 1.8rem;
    }

    .sidebar .nav-link {
        color: rgba(255, 255, 255, 0.8);
        padding: 0.75rem 1.5rem;
        margin: 0.25rem 1rem;
        border-radius: 6px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 400;
    }

    .sidebar .nav-link i {
        width: 24px;
        text-align: center;
        font-size: 1.1rem;
    }

    .sidebar .nav-link:hover {
        background-color: var(--primary-light);
        color: white;
        transform: translateX(17px);
    }

    .sidebar .nav-link.active {
        background-color: var(--primary-accent);
        color: white;
        font-weight: 500;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Main Content Area */
    .main-content {
        margin-left: 240px;
        padding: 2rem 2.5rem;
        min-height: 100vh;
        transition: all 0.3s ease;
    }

    /* Header Styling */
    .main-content header {
        margin-bottom: 2rem;
    }

    .main-content header h4 {
        color: var(--primary-dark);
        font-weight: 600;
        margin-bottom: 1rem;
        position: relative;
        padding-bottom: 0.5rem;
    }

    .main-content header h4::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 3px;
        background-color: var(--secondary-color);
        border-radius: 3px;
    }

    /* Alert Styling */
    .alert {
        border-left: 4px solid;
    }

    .alert-success {
        border-left-color: #28a745;
    }

    /* Footer Styling */
    footer {
        margin-top: 3rem;
        padding-top: 1.5rem;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
        color: var(--text-light);
        font-size: 0.85rem;
    }

    /* Responsive Adjustments */
    @media (max-width: 992px) {
        .sidebar {
            width: 220px;
            transform: translateX(-100%);
        }
        
        .sidebar.active {
            transform: translateX(0);
        }
        
        .main-content {
            margin-left: 0;
        }
    }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <nav class="sidebar d-flex flex-column">
        <div class="sidebar-title">
            <i class="bi bi-film"></i> CINOIR
        </div>
        <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/admin/dashboard">
            <i class="bi bi-house-door"></i> Dashboard
        </a>
        <a class="nav-link {{ request()->is('banners') ? 'active' : '' }}" href="/admin/banners">
            <i class="bi bi-image"></i> Promotion
        </a>
        <a class="nav-link {{ request()->is('cinemas*') ? 'active' : '' }}" href="/admin/cinemas">
            <i class="bi bi-building"></i> Bioskop
        </a>
        <a class="nav-link {{ request()->is('movies*') ? 'active' : '' }}" href="/admin/movies">
            <i class="bi bi-camera-reels"></i> Film
        </a>
        <a class="nav-link {{ request()->is('schedules*') ? 'active' : '' }}" href="/admin/schedules">
            <i class="bi bi-calendar3"></i> Jadwal
        </a>
        <a class="nav-link {{ request()->is('tickets*') ? 'active' : '' }}" href="/admin/tickets">
            <i class="bi bi-ticket-detailed"></i> Tiket
        </a>
        <a class="nav-link {{ request()->is('users*') ? 'active' : '' }}" href="/admin/users">
            <i class="bi bi-person"></i> Pengguna
        </a>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <header>
            <h4>@yield('title')</h4>
            @hasSection('breadcrumb')
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent px-0">
                        @yield('breadcrumb')
                    </ol>
                </nav>
            @endif
        </header>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        @endif

        @yield('content')

        <footer class="mt-4">
            <small>&copy; {{ date('Y') }} CINOIR. All Rights Reserved.</small>
        </footer>
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        // Mobile sidebar toggle (optional)
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.sidebar');
            // You can add a toggle button in your header if needed
        });
    </script>

    @stack('scripts')
    
</body>
</html>