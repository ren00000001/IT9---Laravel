<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MotoPOS - Settings</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>

        .container{
            display: flex;
            min-height: 100vh;
        }

        .main-content{
            flex: 1;
            padding: 20px;
        }

        .header{
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 20px;
            gap: 20px;
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

        .add-button{
            display: flex;
            justify-content: flex-end;
            margin: 15px;
        }

        #add-button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background-color: green;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 14px;
            cursor: pointer;
            transition: 0.3s;
        }

        #add-button:hover{
            background-color: rgb(25, 99, 25);
        }

        .add-product-icon{
            width: 25px;
            height: 25px;
        }

        .user-table-container{
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

        .table-action-button {
            background: none;
            border: none;
            color: #7f8c8d;
            cursor: pointer;
            font-size: 16px;
            gap: 6px;
        }

        .table-action-button,
        .edit-product-icon,
        .delete-product-icon{
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .edit-product-icon,
        .delete-product-icon{
            padding: 5px 5px;
            width: 25px;
            height: 25px;
        }
        
        .table-action-button:hover .edit-product-icon{
            fill: goldenrod;
        }

        .table-action-button:hover .delete-product-icon{
            fill: red;
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

        
    </style>
</head>
<body>

        <header>
            <nav>
                <input type="checkbox" id="sidebar-active">
                <label for="sidebar-active" class="open-sidebar-button">
                    <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px" fill="#000000"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg>
                 </label>

                 <label for="sidebar-active" id="overlay"></label>
                 <div class="links-container">
                    <label for="sidebar-active" class="close-sidebar-button">
                        <svg xmlns="http://www.w3.org/2000/svg" height="32px" viewBox="0 -960 960 960" width="32px" fill="#000000"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                    </label>
                    
                <a class="home-link" href="{{ route('admin.dashboard') }}">Home</a>
                <a href="{{ route('admin.products') }}">Products</a>
                <a href="{{ route('admin.customers') }}">Customers</a>
                <a href="{{ route('admin.inventory') }}">Inventory</a>
                <a href="{{ route('admin.supplier') }}">Supplier</a>
                <a href="{{ route('admin.sales') }}">Sales</a>
                <a href="{{ route('admin.archives') }}">Archives</a>
                <a href="{{ route('admin.settings') }}">Settings</a>
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
                        <span>User:</span>
                        <div class="user-area">
                            <div class="user-profile">
                                <div class="user-avatar">RI</div>
                                <span>Ren Indino</span>
                            </div>
                        </div>
                    </div>

                    <div class="page-header">
                        <h1 class="page-title">Users</h1>
                    </div>

                    <div class="add-button">
                        <button id="add-button">
                            <svg class="add-product-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                            Add User
                        </button>
                    </div>

                    <div class="user-table-container">
                        <div class="table-header">
                            <div class="table-title">All Users</div>
                        </div>
    
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Login</th>
                                        <th>Logout</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Alex</td>
                                        <td><span class="status-badge status-active">Active</span></td>
                                        <td>April 10, 2025 8:30am</td>
                                        <td>April 10, 2025 10:23am</td>
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
    
                </div>  
            </div>
        </main>

        <script src="{{ asset('js/scriptForTime.js') }}"></script>
    
</body>
</html>