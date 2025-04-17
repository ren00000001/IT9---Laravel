<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MotoPOS - Customer</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
         :root {
            --primary: #3498db;
            --foricon: #222121;
            --secondary: #2ecc71;
            --danger: #e74c3c;
            --dark: #34495e;
            --light: #ecf0f1;
            --text: #2c3e50;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        /* Keep the user icon in the top-right corner */
        .header{
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 20px;
            gap: 25px;
        }

        .user-area {
            display: flex;
            align-items: center;
        }

        .user-profile {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--foricon);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 10px;
        }

        .filter-section{
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .filter-row {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 15px;
        }

        .filter-group {
            display: flex;
            align-items: center;
        } 

        .filter-label {
            margin-right: 10px;
            font-weight: 500;
        }

        .filter-input {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .filter-button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            padding: 8px 15px 10px 12px;
            cursor: pointer;
            margin-left: auto;
            transition: all 0.3s ease;
        }

        .filter-button:hover{
            background-color: #2980b9;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .filter-button:hover .filter-product-icon{
            fill: rgb(229, 229, 239);
        }

        .filter-product-icon{
            width: 25px;
            height: 25px;
            fill: white;
            transition: fill 0.3s ease;
        }

        .customer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .customer-card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
        }
        
        .customer-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .customer-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--dark);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 18px;
            margin-right: 15px;
        }
        
        .customer-info {
            flex: 1;
        }
        
        .customer-name {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .customer-email {
            font-size: 14px;
            color: #7f8c8d;
        }
        
        .loyalty-badge {
            background-color: rgba(241, 196, 15, 0.1);
            color: #f1c40f;
            font-size: 12px;
            padding: 3px 8px;
            border-radius: 10px;
            margin-left: 10px;
        }
        
        .customer-stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        
        .stat-group {
            text-align: center;
        }
        
        .stat-value {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .stat-label {
            font-size: 12px;
            color: #7f8c8d;
        }
        
        .customer-meta {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            color: #7f8c8d;
            margin-bottom: 15px;
        }
        
        .meta-item {
            display: flex;
            align-items: center;
        }
        
        .meta-item i {
            margin-right: 5px;
            font-size: 14px;
        }
        
        .customer-actions {
            margin-top: auto;
            display: flex;
            justify-content: space-between;
        }
        
        .action-btn {
            background-color: rgba(52, 152, 219, 0.1);
            color: var(--primary);
            border: none;
            border-radius: 5px;
            padding: 8px 12px;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
        }
        
        .action-btn i {
            margin-right: 5px;
        }

        .customers-table-container {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }
        
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .table-title {
            font-size: 18px;
            font-weight: 600;
        }
        
        .customer-id {
            color: var(--primary);
            font-weight: 500;
        }
        
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
        }
        
        .status-active {
            background-color: rgba(46, 204, 113, 0.1);
            color: var(--secondary);
        }
        
        .status-inactive {
            background-color: rgba(231, 76, 60, 0.1);
            color: var(--danger);
        }
        
        .table-actions {
            display: flex;
            gap: 5px;
        }
        
        .table-action-button {
            background: none;
            border: none;
            color: #7f8c8d;
            cursor: pointer;
            font-size: 16px;
            gap: 6px;
        }

        .table-action-button:hover .edit-product-icon{
            fill: goldenrod;
        }

        .table-action-button:hover .delete-product-icon{
            fill:red;
        }

        .filter-product-icon,
        .table-action-button,
        .edit-product-icon,
        .delete-product-icon{
            display: inline-flex;
            align-items: center;
            gap: 8px;  
        }

        .edit-product-icon,
        .delete-product-icon{
            width: 25px;
            height: 25px;
            padding: 5px 5px;
        }
        
        #edit-action-button:hover{
            background-color: rgba(242, 210, 32, 0.2);
            color: goldenrod;
        }

        #delete-action-button:hover{
            background-color: rgba(255, 0, 0, 0.1);
            color: red;
        }

        .table-action-button:hover{
            transition: background-color 0.3s ease;
        }

        #table-editaction-button:hover{
            background-color: rgba(242, 210, 32, 0.2);
        }

        #table-deleteaction-button:hover{
            background-color: rgba(255, 0, 0, 0.1);
        }
        
        /* Pagination */
        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }
        
        .page-info {
            font-size: 14px;
            color: #7f8c8d;
        }
        
        .page-buttons {
            display: flex;
            gap: 5px;
        }
        
        .page-btn {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            background-color: white;
            border: 1px solid #ddd;
            cursor: pointer;
        }
        
        .page-btn.active {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
        }

    </style>
</head>
<body>

    <header>
        <nav>
            <input type="checkbox" id="sidebar-active">
            <label for="sidebar-active" class="open-sidebar-button">
                <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px" fill="#000000"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg>
            </label>
    
            <label id="overlay" for="sidebar-active"></label>
            <div class="links-container">
                <label for="sidebar-active" class="close-sidebar-button">
                    <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px" fill="#000000"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                </label>
    
                <a class="home-link" href="{{ route('dashboard') }}">Home</a>
                <a href="{{ route('products') }}">Products</a>
                <a href="{{ route('customers') }}">Customers</a>
                <a href="{{ route('inventory') }}">Inventory</a>
                <a href="{{ route('supplier') }}">Supplier</a>
                <a href="{{ route('sales') }}">Sales</a>
                <a href="{{ route('archives') }}">Archives</a>
                <a href="{{ route('settings') }}">Settings</a>
                <!-- Move the Log out link to the bottom -->
                <a class="logout-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Log out
                </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
            </div>
            <h1>OKE</h1>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="main-content">

                <div class="header">
                    <div id="real-time-display"></div>
                    <span>Admin:</span>
                    <div class="user-area">
                        <div class="user-profile">
                            <div class="user-avatar">RI</div>
                            <span>Ren Indino</span>
                        </div>
                    </div>
                </div>

                <!-- Search Bar -->
                <div class="search-bar">
                    <div class="search-container">
                        <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
                    </div>
                    <input type="text" placeholder="Enter Customer's info to search">
                </div>

                <!-- Page Header -->
                <div class="page-header">
                    <h1 class="page-title">Customer</h1>
                </div>

                <div class="filter-section">
                    <div class="filter-row">
                        <div class="filter-group">
                            <span class="filter-label">Group:</span>
                            <select class="filter-input">
                                <option>All Groups</option>
                                <option>OKE</option>
                                <option>NOT OKE</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <span class="filter-label">Status:</span>
                            <select class="filter-input">
                                <option>All Status</option>
                                <option>Active</option>
                                <option>Inactive</option>
                            </select>
                        </div>

                        <button class="filter-button">
                            <svg class="filter-product-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M440-160q-17 0-28.5-11.5T400-200v-240L168-736q-15-20-4.5-42t36.5-22h560q26 0 36.5 22t-4.5 42L560-440v240q0 17-11.5 28.5T520-160h-80Zm40-308 198-252H282l198 252Zm0 0Z"/></svg>
                            Apply Filters
                        </button>
                    </div>
                </div>

                <div class="customers-table-container">
                    <div class="table-header">
                        <div class="table-title">All Customers</div>
                    </div>
                    
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Orders</th>
                                    <th>Spent</th>
                                    <th>Joined</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="customer-id">#CUS-001</td>
                                    <td>John Smith</td>
                                    <td>john.smith@example.com</td>
                                    <td>(555) 123-4567</td>
                                    <td>42</td>
                                    <td>$3,842</td>
                                    <td>Jan 15, 2023</td>
                                    <td><span class="status-badge status-active">Active</span></td>
                                    <td>
                                        <div class="table-actions">
                                        <button id="table-editaction-button" class="table-action-button">
                                                <svg class="edit-product-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                                            </button>
                                            <button id="table-deleteaction-button" class="table-action-button">
                                                <svg class="delete-product-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
                                            </button>
                                         </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="customer-id">#CUS-002</td>
                                    <td>Sarah Johnson</td>
                                    <td>sarah.j@example.com</td>
                                    <td>(555) 987-6543</td>
                                    <td>67</td>
                                    <td>$5,921</td>
                                    <td>Nov 22, 2022</td>
                                    <td><span class="status-badge status-active">Active</span></td>
                                    <td>
                                        <div class="table-actions">
                                            <button id="table-editaction-button" class="table-action-button">
                                                <svg class="edit-product-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                                            </button>
                                            <button id="table-deleteaction-button" class="table-action-button">
                                                <svg class="delete-product-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="customer-grid">
                    <div class="customer-card">
                        <div class="customer-header">
                            <div class="customer-avatar">JS</div>
                            <div class="customer-info">
                                <div class="customer-name">John Smith<span class="loyalty-badge">Gold</span></div>
                                <div class="customer-email">john.smith@example.com</div>
                            </div>
                        </div>
                        
                        <div class="customer-stats">
                            <div class="stat-group">
                                <div class="stat-value">42</div>
                                <div class="stat-label">Orders</div>
                            </div>
                            <div class="stat-group">
                                <div class="stat-value">$3,842</div>
                                <div class="stat-label">Total Spent</div>
                            </div>
                        </div>
                        
                        <div class="customer-meta">
                            <div class="meta-item">
                                <span>(555) 123-4567</span>
                            </div>
                            <div class="meta-item">
                                <span>Since Jan 2023</span>
                            </div>
                        </div>
                        
                        <div class="customer-actions">
                            <button class="action-btn">
                                Edit
                            </button>
                            <button class="action-btn">
                                Delete
                            </button>
                        </div>
                    </div>
                    
                    <div class="customer-card">
                        <div class="customer-header">
                            <div class="customer-avatar">SJ</div>
                            <div class="customer-info">
                                <div class="customer-name">Sarah Johnson<span class="loyalty-badge">Platinum</span></div>
                                <div class="customer-email">sarah.j@example.com</div>
                            </div>
                        </div>
                        
                        <div class="customer-stats">
                            <div class="stat-group">
                                <div class="stat-value">67</div>
                                <div class="stat-label">Orders</div>
                            </div>
                            <div class="stat-group">
                                <div class="stat-value">$5,921</div>
                                <div class="stat-label">Total Spent</div>
                            </div>
                        </div>
                        
                        <div class="customer-meta">
                            <div class="meta-item">
                                <span>(555) 987-6543</span>
                            </div>
                            <div class="meta-item">
                                <span>Since Nov 2022</span>
                            </div>
                        </div>
                        
                        <div class="customer-actions">
                            <button class="action-btn">
                                Edit
                            </button>
                            <button class="action-btn">
                                Delete
                            </button>
                        </div>
                    </div>
                    
                    <div class="customer-card">
                        <div class="customer-header">
                            <div class="customer-avatar">MB</div>
                            <div class="customer-info">
                                <div class="customer-name">Michael Brown<span class="loyalty-badge">Silver</span></div>
                                <div class="customer-email">mbrown@example.com</div>
                            </div>
                        </div>
                        
                        <div class="customer-stats">
                            <div class="stat-group">
                                <div class="stat-value">18</div>
                                <div class="stat-label">Orders</div>
                            </div>
                            <div class="stat-group">
                                <div class="stat-value">$1,325</div>
                                <div class="stat-label">Total Spent</div>
                            </div>
                     </div>
                        
                        <div class="customer-meta">
                            <div class="meta-item">
                                <span>(555) 456-7890</span>
                            </div>
                            <div class="meta-item">
                                <span>Since May 2023</span>
                            </div>
                        </div>
                        
                        <div class="customer-actions">
                            <button class="action-btn">
                                Edit
                            </button>
                            <button class="action-btn">
                                Delete
                            </button>
                        </div>
                    </div>
                    
                    <div class="customer-card">
                        <div class="customer-header">
                            <div class="customer-avatar">ED</div>
                            <div class="customer-info">
                                <div class="customer-name">Emily Davis</div>
                                <div class="customer-email">emilyd@example.com</div>
                            </div>
                        </div>
                        
                        <div class="customer-stats">
                            <div class="stat-group">
                                <div class="stat-value">7</div>
                                <div class="stat-label">Orders</div>
                            </div>
                            <div class="stat-group">
                                <div class="stat-value">$486</div>
                                <div class="stat-label">Total Spent</div>
                            </div>
                       </div>
                        
                        <div class="customer-meta">
                            <div class="meta-item">
                                <span>(555) 789-0123</span>
                            </div>
                            <div class="meta-item">
                                <span>Since Feb 2024</span>
                            </div>
                        </div>
                        
                        <div class="customer-actions">
                            <button class="action-btn">
                                Edit
                            </button>
                            <button class="action-btn">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </main>

    <script src="{{ asset('js/scriptForTime.js') }}"></script>

</body>
</html>