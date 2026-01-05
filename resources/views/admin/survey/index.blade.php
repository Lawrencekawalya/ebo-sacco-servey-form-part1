@php use Illuminate\Support\Str; @endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>EBO Staff Satisfaction Survey 2025 - Admin Dashboard</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/fav_icon.png') }}">">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            /* --primary-color: #0a58ca;
            --primary-dark: #084298;
            --secondary-color: #00A448; */
            --primary-color: #00A448;
            --primary-dark: #019642;
            --secondary-color: #0a58ca;
            --danger-color: #dc3545;
            --warning-color: #f0ad4e;
            --success-color: #28a745;
            --gray-light: #f8f9fa;
            --gray-medium: #6c757d;
            --gray-dark: #343a40;
            --border-color: #e9ecef;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --shadow-light: 0 2px 8px rgba(0, 0, 0, 0.06);
            --radius: 12px;
            --radius-sm: 8px;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Arial', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e8eff7 100%);
            color: #333;
            line-height: 1.6;
            min-height: 100vh;
        }

        /*  */

        /* Header & Navigation */
        .header {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-color) 100%);
            color: white;
            padding: 20px 30px;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            backdrop-filter: blur(10px);
        }

        .logo-text h1 {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .logo-text p {
            font-size: 13px;
            opacity: 0.9;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 15px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .user-profile:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-weight: bold;
            font-size: 16px;
        }

        .user-profile form {
            margin: 0;
        }

        .user-profile button {
            background: none;
            border: none;
            padding: 0;
            font-size: 12px;
            color: #dc2626;
            cursor: pointer;
            transition: color 0.2s ease, opacity 0.2s ease;
        }

        .user-profile button:hover {
            color: #b91c1c;
            opacity: 0.85;
        }

        .user-profile button:focus {
            outline: none;
        }

        /* Main Container */
        .main-container {
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 20px;
            /* display: grid; */
            grid-template-columns: 250px 1fr;
            gap: 30px;
        }

        /* Sidebar */
        .sidebar {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow-light);
            padding: 25px 20px;
            height: fit-content;
            position: sticky;
            top: 100px;
        }

        .nav-title {
            font-size: 14px;
            text-transform: uppercase;
            color: var(--gray-medium);
            letter-spacing: 1px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .nav-menu {
            list-style: none;
            margin-bottom: 30px;
        }

        .nav-item {
            margin-bottom: 8px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            text-decoration: none;
            color: var(--gray-dark);
            border-radius: var(--radius-sm);
            transition: all 0.3s;
            font-weight: 500;
        }

        .nav-link:hover {
            background: var(--gray-light);
            color: var(--primary-color);
        }

        .nav-link.active {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            box-shadow: var(--shadow-light);
        }

        .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        /* Content Area */
        .content {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .stat-card {
            background: white;
            border-radius: var(--radius);
            padding: 25px;
            box-shadow: var(--shadow-light);
            display: flex;
            align-items: center;
            gap: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
        }

        .stat-icon.total {
            background: linear-gradient(135deg, #0a58ca 0%, #084298 100%);
        }

        .stat-icon.confirmed {
            background: linear-gradient(135deg, #00A448 0%, #008c3a 100%);
        }

        .stat-icon.pending {
            background: linear-gradient(135deg, #f0ad4e 0%, #e09b3e 100%);
        }

        .stat-icon.rate {
            background: linear-gradient(135deg, #6f42c1 0%, #5a32a3 100%);
        }

        .stat-content {
            flex: 1;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: var(--gray-dark);
            line-height: 1;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 14px;
            color: var(--gray-medium);
            font-weight: 500;
        }

        .stat-change {
            font-size: 12px;
            color: var(--success-color);
            margin-top: 5px;
        }

        .stat-change.negative {
            color: var(--danger-color);
        }

        /* Filters Bar */
        .filters-bar {
            background: white;
            border-radius: var(--radius);
            padding: 20px 25px;
            box-shadow: var(--shadow-light);
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: center;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .filter-label {
            font-size: 14px;
            color: var(--gray-medium);
            font-weight: 500;
            white-space: nowrap;
        }

        .filter-select,
        .filter-input,
        .filter-date {
            padding: 10px 15px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            font-size: 14px;
            color: var(--gray-dark);
            background: white;
            min-width: 150px;
        }

        .filter-select:focus,
        .filter-input:focus,
        .filter-date:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(10, 88, 202, 0.1);
        }

        .filter-btn {
            padding: 10px 25px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: var(--radius-sm);
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-btn:hover {
            background: var(--primary-dark);
        }

        .filter-btn.secondary {
            background: white;
            color: var(--gray-dark);
            border: 1px solid var(--border-color);
        }

        .filter-btn.secondary:hover {
            background: var(--gray-light);
        }

        /* Main Table Container */
        .table-container {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow-light);
            overflow: hidden;
        }

        .table-header {
            padding: 25px 30px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--gray-dark);
        }

        .table-actions {
            display: flex;
            gap: 10px;
        }

        .action-btn {
            padding: 8px 16px;
            background: white;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            color: var(--gray-dark);
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .action-btn:hover {
            background: var(--gray-light);
            border-color: var(--gray-medium);
        }

        .action-btn.primary {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .action-btn.primary:hover {
            background: var(--primary-dark);
        }

        /* Table */
        .responsive-table {
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1200px;
        }

        .data-table thead {
            background: var(--gray-light);
            position: sticky;
            top: 0;
        }

        .data-table th {
            padding: 18px 20px;
            text-align: left;
            font-weight: 600;
            color: var(--gray-dark);
            font-size: 14px;
            border-bottom: 2px solid var(--border-color);
            white-space: nowrap;
            position: relative;
        }

        .data-table th.sortable {
            cursor: pointer;
            user-select: none;
        }

        .data-table th.sortable:hover {
            background: #e9ecef;
        }

        .sort-icon {
            margin-left: 5px;
            color: var(--gray-medium);
            font-size: 12px;
        }

        .data-table td {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border-color);
            font-size: 14px;
            color: var(--gray-dark);
            vertical-align: top;
        }

        .data-table tbody tr {
            transition: background 0.2s;
        }

        .data-table tbody tr:hover {
            background: var(--gray-light);
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-badge.confirmed {
            background: rgba(40, 167, 69, 0.1);
            color: var(--success-color);
            border: 1px solid rgba(40, 167, 69, 0.2);
        }

        .status-badge.pending {
            background: rgba(108, 117, 125, 0.1);
            color: var(--gray-medium);
            border: 1px solid rgba(108, 117, 125, 0.2);
        }

        .status-badge.draft {
            background: rgba(240, 173, 78, 0.1);
            color: var(--warning-color);
            border: 1px solid rgba(240, 173, 78, 0.2);
        }

        /* Response Text */
        .response-text {
            max-width: 300px;
            max-height: 100px;
            overflow: auto;
            padding: 5px;
            line-height: 1.4;
            font-size: 13px;
            color: var(--gray-dark);
        }

        .response-text.short {
            max-height: none;
        }

        .view-more {
            color: var(--primary-color);
            font-size: 12px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 5px;
        }

        .view-more:hover {
            text-decoration: underline;
        }

        /* Charts Section */
        .charts-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 20px;
        }

        .chart-card {
            background: white;
            border-radius: var(--radius);
            padding: 25px;
            box-shadow: var(--shadow-light);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--gray-dark);
        }

        .chart-container {
            position: relative;
            height: 250px;
            width: 100%;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 30px;
            color: var(--gray-medium);
        }

        .empty-icon {
            font-size: 60px;
            color: #dee2e6;
            margin-bottom: 20px;
        }

        .empty-state h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: var(--gray-medium);
        }

        .empty-state p {
            font-size: 15px;
            max-width: 500px;
            margin: 0 auto 25px;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 30px;
            border-top: 1px solid var(--border-color);
            background: white;
        }

        .pagination-info {
            font-size: 14px;
            color: var(--gray-medium);
        }

        .pagination-controls {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .page-btn {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            background: white;
            color: var(--gray-dark);
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
            font-weight: 500;
        }

        .page-btn:hover:not(:disabled) {
            background: var(--gray-light);
            border-color: var(--gray-medium);
        }

        .page-btn.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .page-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 25px;
            color: var(--gray-medium);
            font-size: 14px;
            border-top: 1px solid var(--border-color);
            margin-top: 30px;
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow-light);
        }

        .footer a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: var(--radius);
            width: 100%;
            max-width: 800px;
            max-height: 90vh;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: modalSlideIn 0.3s ease;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            padding: 25px 30px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--gray-dark);
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 24px;
            color: var(--gray-medium);
            cursor: pointer;
            line-height: 1;
            padding: 5px;
        }

        .modal-close:hover {
            color: var(--danger-color);
        }

        .modal-body {
            padding: 30px;
            overflow-y: auto;
            max-height: 60vh;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .main-container {
                grid-template-columns: 1fr;
            }

            .sidebar {
                display: none;
            }

            .charts-section {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .filters-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-group {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-select,
            .filter-input,
            .filter-date {
                width: 100%;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Export Dropdown */
        .export-dropdown {
            position: relative;
        }

        .export-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: var(--radius-sm);
            box-shadow: var(--shadow);
            min-width: 180px;
            display: none;
            z-index: 10;
        }

        .export-dropdown:hover .export-menu {
            display: block;
        }

        .export-item {
            display: block;
            padding: 12px 20px;
            text-decoration: none;
            color: var(--gray-dark);
            font-size: 14px;
            transition: background 0.2s;
            border-bottom: 1px solid var(--border-color);
        }

        .export-item:last-child {
            border-bottom: none;
        }

        .export-item:hover {
            background: var(--gray-light);
            color: var(--primary-color);
        }

        .export-item i {
            margin-right: 10px;
            width: 18px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <div class="logo-container">
                <div class="logo-icon">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <div class="logo-text">
                    <h1>EBO Staff Satisfaction Survey 2025</h1>
                    <p>Admin Dashboard</p>
                </div>
            </div>
            <div class="header-actions">
                <div class="user-profile">
                    <div class="user-avatar">AD</div>
                    <div>
                        <div style="font-weight: 600;">Admin User</div>
                        <div style="font-size: 12px; opacity: 0.9;">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                    <i class="fas fa-chevron-down" style="font-size: 12px;"></i>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <div class="main-container">
        <!-- Sidebar -->
        {{-- <aside class="sidebar">
            <div class="nav-title">Navigation</div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-table"></i>
                        <span>Survey Responses</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-chart-pie"></i>
                        <span>Analytics & Reports</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cog"></i>
                        <span>Survey Settings</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-users"></i>
                        <span>User Management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-download"></i>
                        <span>Export Data</span>
                    </a>
                </li>
            </ul>

            <div class="nav-title">Quick Stats</div>
            <div style="padding: 15px; background: var(--gray-light); border-radius: var(--radius-sm);">
                <div style="font-size: 12px; color: var(--gray-medium); margin-bottom: 10px;">Response Rate</div>
                <div style="font-size: 24px; font-weight: 700; color: var(--primary-color);">78.5%</div>
                <div style="font-size: 12px; color: var(--success-color); margin-top: 5px;">
                    <i class="fas fa-arrow-up"></i> 12% from last month
                </div>
            </div>
        </aside> --}}

        <!-- Content Area -->
        <main class="content">
            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon total">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{ $submissions->count() }}</div>
                        <div class="stat-label">Total Responses</div>
                        {{-- <div class="stat-change">
                            <i class="fas fa-arrow-up"></i> 24% from last survey
                        </div> --}}
                    </div>
                </div>

                {{-- <div class="stat-card">
                    <div class="stat-icon confirmed">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{ $confirmedCount }}</div>
                        <div class="stat-label">Confirmed Submissions</div>
                        <div class="stat-change">
                            <i class="fas fa-arrow-up"></i> 18% increase
                        </div>
                    </div>
                </div> --}}

                {{-- <div class="stat-card">
                    <div class="stat-icon pending">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{ $pendingCount }}</div>
                        <div class="stat-label">Pending Confirmations</div>
                        <div class="stat-change negative">
                            <i class="fas fa-arrow-down"></i> 5% decrease
                        </div>
                    </div>
                </div> --}}

                <div class="stat-card">
                    <div class="stat-icon rate">
                        <i class="fas fa-percentage"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">
                            {{ $averageSatisfaction ?: 'N/A' }}
                        </div>
                        <div class="stat-label">Avg. Satisfaction Score</div>
                        {{-- <div class="stat-change">
                            <i class="fas fa-arrow-up"></i> 0.3 improvement
                        </div> --}}
                    </div>
                </div>
            </div>

            <!-- Filters Bar -->
            <form method="GET" action="{{ url()->current() }}" class="filters-bar">

                {{-- <div class="filter-group">
                    <label class="filter-label">Status:</label>
                    <select class="filter-select" name="status" id="statusFilter">
                        <option value="all">All Statuses</option>
                        <option value="confirmed" @selected(request('status') === 'confirmed')>Confirmed</option>
                        <option value="pending" @selected(request('status') === 'pending')>Pending</option>
                        <option value="draft" @selected(request('status') === 'draft')>Draft</option>
                    </select>
                </div> --}}

                <div class="filter-group">
                    <label class="filter-label">Date Range:</label>
                    <input type="date" class="filter-date" name="dateFrom" value="{{ request('dateFrom') }}">
                    <span>to</span>
                    <input type="date" class="filter-date" name="dateTo" value="{{ request('dateTo') }}">
                </div>

                <div class="filter-group" style="margin-left: auto;">
                    <button type="button" class="filter-btn secondary" onclick="clearFilters()">
                        <i class="fas fa-filter"></i> Clear Filters
                    </button>

                    <button type="submit" class="filter-btn">
                        <i class="fas fa-search"></i> Apply Filters
                    </button>
                </div>

            </form>

            <!-- Charts Section -->
            <div class="charts-section">
                <div class="chart-card">
                    <div class="chart-header">
                        <h3 class="chart-title">Satisfaction Distribution</h3>
                        <select
                            style="padding: 8px 12px; border-radius: 6px; border: 1px solid var(--border-color); font-size: 13px;">
                            <option>Question 8</option>
                        </select>
                    </div>
                    <div class="chart-container">
                        <canvas id="satisfactionChart"></canvas>
                    </div>
                </div>

                <div class="chart-card">
                    <div class="chart-header">
                        <h3 class="chart-title">Response Timeline</h3>
                        <form method="GET">
                            <select name="range" onchange="this.form.submit()"
                                style="padding: 8px 12px; border-radius: 6px; border: 1px solid var(--border-color); font-size: 13px;">
                                <option value="7" {{ request('range') == '7' ? 'selected' : '' }}>
                                    Last 7 Days
                                </option>
                                <option value="30" {{ request('range') == '30' ? 'selected' : '' }}>
                                    Last 30 Days
                                </option>
                                <option value="all" {{ request('range', 'all') == 'all' ? 'selected' : '' }}>
                                    All Time
                                </option>
                            </select>
                        </form>

                    </div>
                    <div class="chart-container">
                        <canvas id="timelineChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Main Table -->
            <div class="table-container">
                <div class="table-header">
                    <h2 class="table-title">Survey Responses</h2>
                    <div class="table-actions">
                        <div class="export-dropdown">
                            <button class="action-btn primary">
                                <i class="fas fa-download"></i> Export Data
                                <i class="fas fa-chevron-down"></i>
                            </button>

                            <div class="export-menu">
                                {{-- <a href="{{ route('responses.export', ['type' => 'excel'] + request()->query()) }}"
                                    class="export-item">
                                    <i class="fas fa-file-excel"></i> Export to Excel
                                </a> --}}

                                <a href="{{ route('responses.export', ['type' => 'csv'] + request()->query()) }}"
                                    class="export-item">
                                    <i class="fas fa-file-csv"></i> Export to CSV
                                </a>
                            </div>
                        </div>

                        <button class="action-btn" onclick="refreshData()">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>

                        <button class="action-btn" onclick="showAllResponses()">
                            <i class="fas fa-eye"></i> View All
                        </button>
                    </div>
                </div>

                @if ($submissions->isEmpty())
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-inbox"></i>
                        </div>
                        <h3>No Responses Yet</h3>
                        <p>Survey responses will appear here once participants start submitting their feedback.</p>
                        {{-- <button class="filter-btn" style="margin-top: 10px;">
                            <i class="fas fa-bell"></i> Set Up Notifications
                        </button> --}}
                    </div>
                @else
                    <div class="responsive-table">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th class="sortable" onclick="sortTable(0)">
                                        Employee Email <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    <th class="sortable" onclick="sortTable(1)">
                                        Submitted At <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    {{-- <th class="sortable" onclick="sortTable(2)">
                                        Status <i class="fas fa-sort sort-icon"></i>
                                    </th> --}}
                                    {{-- <th>Department</th> --}}
                                    <th>Manager Rating</th>
                                    <th>Satisfaction</th>
                                    <th>Feedback</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($submissions as $submission)
                                    <tr>
                                        <td>
                                            <div style="font-weight: 500; color: var(--primary-color);">
                                                {{ $submission->email }}
                                            </div>
                                            <div style="font-size: 12px; color: var(--gray-medium); margin-top: 2px;">
                                                ID: {{ substr(md5($submission->id), 0, 8) }}
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                {{ $submission->created_at->format('M d, Y') }}
                                            </div>
                                            <div style="font-size: 12px; color: var(--gray-medium);">
                                                {{ $submission->created_at->format('h:i A') }}
                                            </div>
                                        </td>
                                        {{-- <td>
                                            <span class="status-badge {{ $submission->status }}">
                                                <i class="fas fa-circle" style="font-size: 8px;"></i>
                                                {{ ucfirst($submission->status) }}
                                            </span>
                                        </td> --}}
                                        {{-- <td>
                                            {{ $submission->department ?? '—' }}
                                        </td> --}}
                                        <td>
                                            @php
                                                $managerRating = $submission->answers['q1'] ?? null;
                                                $ratingDisplay = $managerRating
                                                    ? ucwords(str_replace('_', ' ', $managerRating))
                                                    : '—';
                                            @endphp
                                            <div>{{ $ratingDisplay }}</div>
                                            @if ($managerRating)
                                                <div
                                                    style="font-size: 12px; color: var(--gray-medium); margin-top: 3px;">
                                                    @if (str_contains($managerRating, 'strongly_agree') || str_contains($managerRating, 'agree'))
                                                        <i class="fas fa-thumbs-up"
                                                            style="color: var(--success-color);"></i> Positive
                                                    @elseif(str_contains($managerRating, 'disagree') || str_contains($managerRating, 'strongly_disagree'))
                                                        <i class="fas fa-thumbs-down"
                                                            style="color: var(--danger-color);"></i> Negative
                                                    @endif
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $satisfaction = $submission->answers['q8'] ?? null;
                                                $satDisplay = $satisfaction
                                                    ? ucwords(str_replace('_', ' ', $satisfaction))
                                                    : '—';
                                            @endphp
                                            <div>{{ $satDisplay }}</div>
                                            @if ($satisfaction)
                                                <div class="progress-bar"
                                                    style="height: 6px; background: #e9ecef; border-radius: 3px; margin-top: 5px; overflow: hidden;">
                                                    @php
                                                        $width = 0;
                                                        if (str_contains($satisfaction, 'very_satisfied')) {
                                                            $width = 100;
                                                        } elseif (str_contains($satisfaction, 'satisfied')) {
                                                            $width = 75;
                                                        } elseif (str_contains($satisfaction, 'dissatisfied')) {
                                                            $width = 40;
                                                        } elseif (str_contains($satisfaction, 'very_dissatisfied')) {
                                                            $width = 20;
                                                        }
                                                    @endphp
                                                    <div
                                                        style="height: 100%; width: {{ $width }}%; background: 
                                                        @if (str_contains($satisfaction, 'very_satisfied')) var(--success-color)
                                                        @elseif(str_contains($satisfaction, 'satisfied')) #20c997
                                                        @elseif(str_contains($satisfaction, 'dissatisfied')) var(--warning-color)
                                                        @elseif(str_contains($satisfaction, 'very_dissatisfied')) var(--danger-color)
                                                        @else #e9ecef @endif;">
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $feedback = $submission->answers['q15'] ?? null;
                                            @endphp

                                            @if ($feedback)
                                                <div class="response-text short" title="{{ $feedback }}">
                                                    {{ Str::limit($feedback, 10) }}
                                                </div>
                                            @else
                                                —
                                            @endif
                                        </td>
                                        {{-- <td>
                                            @php
                                                $feedback = $submission->answers['q15'] ?? null;
                                            @endphp
                                            @if ($feedback && strlen($feedback) > 50)
                                                <div class="response-text">{{ substr($feedback, 0, 50) }}...</div>
                                                <a href="#" class="view-more"
                                                    onclick="showFullResponse('{{ $submission->id }}')">
                                                    View more
                                                </a>
                                            @elseif($feedback)
                                                <div class="response-text short">{{ $feedback }}</div>
                                            @else
                                                —
                                            @endif
                                        </td> --}}
                                        <td>
                                            <div style="display: flex; gap: 8px;">
                                                <button class="action-btn"
                                                    onclick="viewResponse('{{ $submission->id }}')"
                                                    title="View Details">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="action-btn"
                                                    onclick="exportResponse('{{ $submission->id }}')" title="Export">
                                                    <i class="fas fa-download"></i>
                                                </button>
                                                @if ($submission->status === 'pending')
                                                    <button class="action-btn"
                                                        onclick="resendConfirmation('{{ $submission->id }}')"
                                                        title="Resend Confirmation">
                                                        <i class="fas fa-paper-plane"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination">
                        <div class="pagination-info">
                            Showing {{ $submissions->firstItem() ?? 0 }} to {{ $submissions->lastItem() ?? 0 }} of
                            {{ $submissions->total() }} entries
                        </div>
                        <div class="pagination-controls">
                            <button class="page-btn" onclick="changePage(1)"
                                {{ $submissions->currentPage() == 1 ? 'disabled' : '' }}>
                                <i class="fas fa-chevron-left"></i>
                            </button>

                            @php
                                $currentPage = $submissions->currentPage();
                                $totalPages = $submissions->lastPage();
                                $startPage = max(1, $currentPage - 2);
                                $endPage = min($totalPages, $currentPage + 2);
                            @endphp

                            @for ($i = $startPage; $i <= $endPage; $i++)
                                <button class="page-btn {{ $i == $currentPage ? 'active' : '' }}"
                                    onclick="changePage({{ $i }})">
                                    {{ $i }}
                                </button>
                            @endfor

                            <button class="page-btn" onclick="changePage({{ $totalPages }})"
                                {{ $submissions->currentPage() == $totalPages ? 'disabled' : '' }}>
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>EBO Staff Satisfaction Survey 2025 Admin Dashboard • Last updated: {{ date('F j, Y, g:i a') }}</p>
                <p>For technical support, contact <a href="mailto:it-support@ebo.org">IT Support</a> | <a
                        href="#">Privacy Policy</a> | <a href="#">Terms of Use</a></p>
                <br>
                Powered by <strong>
                    <a href="http://rightclick.co.ug" style="text-decoration: underline">
                        Right Click Signs Uganda
                    </a>
                </strong>
            </div>
        </main>
    </div>

    <!-- Response Detail Modal -->
    <div class="modal" id="responseModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Response Details</h3>
                <button class="modal-close" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body" id="responseModalBody">
                <!-- Dynamic content will be loaded here -->
            </div>
        </div>
    </div>

    <script>
        // Initialize Charts
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Data coming from Laravel controller
            const satisfactionDistribution = @json($satisfactionDistribution);
            const timelineLabels = @json($timelineLabels);
            const timelineCounts = @json($timelineCounts);
            // Satisfaction Chart
            const satisfactionCtx = document
                .getElementById('satisfactionChart')
                .getContext('2d');

            const satisfactionValues = [
                satisfactionDistribution.very_satisfied,
                satisfactionDistribution.satisfied,
                satisfactionDistribution.dissatisfied,
                satisfactionDistribution.very_dissatisfied
            ];

            const totalResponses = satisfactionValues.reduce((a, b) => a + b, 0);

            new Chart(satisfactionCtx, {
                type: 'doughnut',
                data: {
                    labels: [
                        'Very Satisfied',
                        'Satisfied',
                        'Dissatisfied',
                        'Very Dissatisfied'
                    ],
                    datasets: [{
                        data: satisfactionValues,
                        backgroundColor: [
                            '#00A448',
                            '#0a58ca',
                            '#f0ad4e',
                            '#dc3545'
                        ],
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const value = context.raw;
                                    const percentage = totalResponses > 0 ?
                                        ((value / totalResponses) * 100).toFixed(1) :
                                        0;

                                    return `${context.label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });

            // const satisfactionCtx = document.getElementById('satisfactionChart').getContext('2d');
            // new Chart(satisfactionCtx, {
            //     type: 'doughnut',
            //     data: {
            //         labels: ['Very Satisfied', 'Satisfied', 'Dissatisfied', 'Very Dissatisfied'],
            //         datasets: [{
            //             data: [35, 45, 15, 5],
            //             backgroundColor: [
            //                 '#00A448',
            //                 '#0a58ca',
            //                 '#f0ad4e',
            //                 '#dc3545'
            //             ],
            //             borderWidth: 2,
            //             borderColor: '#fff'
            //         }]
            //     },
            //     options: {
            //         responsive: true,
            //         maintainAspectRatio: false,
            //         plugins: {
            //             legend: {
            //                 position: 'bottom',
            //                 labels: {
            //                     padding: 20,
            //                     usePointStyle: true
            //                 }
            //             },
            //             tooltip: {
            //                 callbacks: {
            //                     label: function(context) {
            //                         return `${context.label}: ${context.raw}%`;
            //                     }
            //                 }
            //             }
            //         }
            //     }
            // });

            // Timeline Chart
            const timelineCtx = document
                .getElementById('timelineChart')
                .getContext('2d');

            new Chart(timelineCtx, {
                type: 'line',
                data: {
                    labels: timelineLabels,
                    datasets: [{
                        label: 'Responses',
                        data: timelineCounts,
                        borderColor: '#0a58ca',
                        backgroundColor: 'rgba(10, 88, 202, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                precision: 0
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        }
                    }
                }
            });


            // const timelineCtx = document.getElementById('timelineChart').getContext('2d');
            // new Chart(timelineCtx, {
            //     type: 'line',
            //     data: {
            //         labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            //         datasets: [{
            //             label: 'Responses',
            //             data: [12, 19, 8, 15, 22, 3, 10],
            //             borderColor: '#0a58ca',
            //             backgroundColor: 'rgba(10, 88, 202, 0.1)',
            //             borderWidth: 3,
            //             fill: true,
            //             tension: 0.4
            //         }]
            //     },
            //     options: {
            //         responsive: true,
            //         maintainAspectRatio: false,
            //         plugins: {
            //             legend: {
            //                 display: false
            //             }
            //         },
            //         scales: {
            //             y: {
            //                 beginAtZero: true,
            //                 grid: {
            //                     color: 'rgba(0, 0, 0, 0.05)'
            //                 }
            //             },
            //             x: {
            //                 grid: {
            //                     color: 'rgba(0, 0, 0, 0.05)'
            //                 }
            //             }
            //         }
            //     }
            // });
        });


        function buildDetails(i) {
            return `
               <div>
                    <div style="font-size: 13px; color: var(--gray-medium); margin-bottom: 8px;"> Q${
                        i + 1}.${
                        ['Manager cares about concerns', 'Feel appreciated', 'Work stress frequency','Suggestions taken seriously'][i] || 'Question ' + (i + 1)
                        } </div>
                    <div style="font-weight: 500;"> ${
                        ['Agree', 'Strongly Agree', 'Sometimes', 'Always'][i] || 'Response ' + (i + 1)
                        } </div>
                </div>
            `;
        }

        // Modal Functions
        function viewResponse(submissionId) {
            fetch(`/admin/survey/${submissionId}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('responseModalBody').innerHTML = html;
                    document.getElementById('responseModal').classList.add('active');
                })
                .catch(() => {
                    alert('Failed to load response details');
                });
        }

        function closeModal() {
            document.getElementById('responseModal').classList.remove('active');
        }

        function showFullResponse(submissionId) {
            // Similar to viewResponse but focused on full text
            viewResponse(submissionId);
        }

        function clearFilters() {
            window.location.href = window.location.pathname;
        }

        // Table Sorting
        let sortDirection = {};

        function sortTable(columnIndex) {
            const table = document.querySelector('.data-table');
            const rows = Array.from(table.querySelectorAll('tbody tr'));
            const header = table.querySelectorAll('th')[columnIndex];
            const sortIcon = header.querySelector('.sort-icon');

            // Toggle sort direction
            if (!sortDirection[columnIndex]) sortDirection[columnIndex] = 'asc';
            else if (sortDirection[columnIndex] === 'asc') sortDirection[columnIndex] = 'desc';
            else sortDirection[columnIndex] = 'asc';

            // Update sort icon
            sortIcon.className = sortDirection[columnIndex] === 'asc' ?
                'fas fa-sort-up sort-icon' : 'fas fa-sort-down sort-icon';

            // Sort rows
            rows.sort((a, b) => {
                const aValue = a.querySelectorAll('td')[columnIndex]?.textContent?.trim() || '';
                const bValue = b.querySelectorAll('td')[columnIndex]?.textContent?.trim() || '';

                if (sortDirection[columnIndex] === 'asc') {
                    return aValue.localeCompare(bValue);
                } else {
                    return bValue.localeCompare(aValue);
                }
            });

            // Reappend sorted rows
            const tbody = table.querySelector('tbody');
            tbody.innerHTML = '';
            rows.forEach(row => tbody.appendChild(row));
        }

        // Filter Functions
        function applyFilters() {
            const statusFilter = document.getElementById('statusFilter').value;
            const departmentFilter = document.getElementById('departmentFilter').value;
            const dateFrom = document.getElementById('dateFrom').value;
            const dateTo = document.getElementById('dateTo').value;

            // In a real app, this would make an API call
            console.log('Applying filters:', {
                statusFilter,
                departmentFilter,
                dateFrom,
                dateTo
            });
            alert('Filters applied! (In a real app, this would refresh the data)');
        }

        function refreshData() {
            // In a real app, this would refresh from server
            alert('Refreshing data...');
            location.reload();
        }

        // function showAllResponses() {
        //     // Reset filters and show all
        //     document.getElementById('statusFilter').value = 'all';
        //     document.getElementById('departmentFilter').value = 'all';
        //     document.getElementById('dateFrom').value = '';
        //     document.getElementById('dateTo').value = '';
        //     applyFilters();
        // }
        function showAllResponses() {
            window.location.href = window.location.pathname;
        }

        function resendConfirmation(submissionId) {
            if (!confirm('Resend confirmation email to this user?')) {
                return;
            }

            fetch(`/admin/survey/${submissionId}/resend-confirmation`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(async response => {
                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.message || 'Failed to resend email');
                    }

                    alert(data.message);
                })
                .catch(error => {
                    alert(error.message);
                });
        }

        function exportResponse(id) {
            // window.open(
            //     `/admin/survey/${id}/export-pdf`,
            //     '_blank'
            // );
            window.location.href = `/admin/survey/${id}/export-pdf`;
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('responseModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        // Simulate data for demo
        // @if ($submissions->isEmpty())
        //     // For demo purposes, add some sample data if empty
        //     setTimeout(() => {
        //         const emptyState = document.querySelector('.empty-state');
        //         if (emptyState) {
        //             emptyState.innerHTML = `
    //                 <div style="color: var(--success-color); font-size: 40px; margin-bottom: 20px;">
    //                     <i class="fas fa-check-circle"></i>
    //                 </div>
    //                 <h3>Demo Data Loaded</h3>
    //                 <p>This is a preview of how the dashboard looks with data. In a real application, actual survey responses would appear here.</p>
    //                 <button class="filter-btn" style="margin-top: 10px;" onclick="location.reload()">
    //                     <i class="fas fa-sync-alt"></i> Reset to Empty State
    //                 </button>
    //             `;
        //         }
        //     }, 1000);
        // @endif
    </script>
</body>

</html>
