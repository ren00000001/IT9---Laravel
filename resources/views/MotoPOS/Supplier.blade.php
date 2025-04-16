<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>

        .container{
            display: flex;
            min-height: 100vh;
        }

        .main-content{
            flex: 1;
            padding: 20px
        }

        .header{
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 20px;
            gap: 25px;
        }

        #real-time-display {
            font-weight: bold;
            margin-right: 15px;
            padding: 5px 10px;
            background-color: #f0f0f0;
            border-radius: 4px;
            font-size: 0.9rem;
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
            background-color: black;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 10px;
        }

        .search-bar {
            text-align: center; /* Center the search bar content */
            margin: 20px 0; /* Add spacing above and below the search bar */
        }

        .search-bar h3 {
            margin-bottom: 10px; /* Add spacing below the "Search" heading */
        }

        .search-bar input {
            width: 300px; /* Set a fixed width for the search input */
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .page-header {
            display: flex;
            justify-content: space-between; /* Align title and button horizontally */
            align-items: center; /* Vertically center items */
            margin-top: 20px; /* Add spacing above the page header */
            margin-bottom: 20px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 600;
        }

        .back-to-inventory{
            display: flex;
            justify-content: flex-end;
            margin-bottom: 15px;
        }

        #back-to-inventory {
            background-color: green;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s
        }

        #back-to-inventory:hover{
            background-color: rgb(6, 98, 6);
        }

        /* Rest of your CSS styles */
        .filter-section {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
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
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 15px;
            font-size: 14px;
            cursor: pointer;
            margin-left: auto;
        }

        .add-button{
            display: flex;
            justify-content: flex-end;
            margin: 15px;
        }

        #add-button{
            background-color: grey;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 14px;
            cursor: pointer;
            transition: 0.3s
        }

        #add-button:hover{
            background-color: rgb(109, 109, 107);
        }

        .supplier-table-container {
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

        .class-title {
            font-size: 18px;
            font-weight: 600;
        }

        table {
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 0.9em;
            min-width: 400px;
            border-radius: 5px 5px 0 0;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
            width: 100%;
            table-layout: fixed; /* Ensures the table respects column widths */
        }

        table th {
            background-color: rgb(22, 22, 22); /* Keep the header background color */
            color: white; /* Keep the header text color */
            text-align: left;
            font-weight: bold;
            padding: 12px 15px;
            white-space: nowrap; /* Prevents text from wrapping */
            overflow: hidden; /* Hides overflow content */
            text-overflow: ellipsis; /* Adds an ellipsis (...) for overflow text */
        }

        table td {
            padding: 12px 15px;
            white-space: nowrap; /* Prevents text from wrapping */
            overflow: hidden; /* Hides overflow content */
            text-overflow: ellipsis; /* Adds an ellipsis (...) for overflow text */
        }

        table tbody tr {
            border-bottom: 1px solid rgb(153, 153, 153);
        }

        table tbody tr:last-of-type {
            border-bottom: 2px solid rgb(22, 22, 22);
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
        }

        .table-action-button:hover {
            color: #3498db;
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

                <div class="search-bar">
                    <input type="text" placeholder="Enter Supplier's info to search">
                </div>

                <div class="page-header">
                    <h1 class="page-title">Supplier</h1>
                </div>

                <div class="filter-section">
                    <div class="filter-row">
                        <div class="filter-group">
                            <span class="filter-label">Category:</span>
                            <select class="filter-input">
                                <option>All Categories</option>
                                <option>OKE</option>
                                <option>NOT OKE</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <span class="filter-label">Stock:</span>
                            <select class="filter-input">
                                <option>All</option>
                                <option>OKE</option>
                                <option>NOT OKE</option>
                            </select>
                        </div>

                        <button class="filter-button">Apply Filters</button>
                    </div>
                </div>

                <div class="add-button">
                    <button id="add-button">Add Supply</button>
                </div>

                <div class="supplier-table-container">
                    <div class="table-header">
                        <div class="class-title">Supplier</div>
                    </div>

                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product's Name</th>
                                    <th>Stocks</th>
                                    <th>Stock-In</th>
                                    <th>Date Last Stock-In</th>
                                    <th>Stock-Out</th>
                                    <th>Date Last Stock-Out</th>
                                    <th>Supplier</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>gauikrgia</td>
                                    <td>zfdhughuzd</td>
                                    <td>zfdhughuzd</td>
                                    <td>fzjhfdk</td>
                                    <td>fkjZfigS</td>
                                    <td>gdfugSf</td>
                                    <td>fkhjhLD</td>
                                    <td>zgjfi</td>
                                    <td>
                                        <div class="table-actions">
                                            <button class="table-action-button">Edit</button>
                                            <button class="table-action-button">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

            </div>
        </div>
           
    </main>

    <script src="scriptForTime.js"></script>

</body>
</html>