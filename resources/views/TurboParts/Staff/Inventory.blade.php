<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff-Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .container{
            display: flex;
            min-height: 100vh;
        }
        .main-container {
            flex: 1;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: flex-end; /* Align user-area to the right */
            align-items: center; /* Vertically center items */
            margin-bottom: 20px; /* Add spacing below the header */
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
            background-color: var(--headertble);
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

        #add-category{
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background-color: var(--importanthl);
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 14px;
            cursor: pointer;
            transition: 0.3s;
        }

        #add-category:hover{
             background-color: var(--textnavlink);
        }

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
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background-color: var(--normalbtn);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            margin-left: auto;
            transition: all 0.3s ease; 
            padding: 8px 15px 10px 12px;   
        }

        .filter-button:hover{
            background-color: var(--hoverbtn);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .filter-button:hover .filter-product-icon{
            fill: rgb(229, 229, 239);
        }

        .filter-product-icon{
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .filter-product-icon{
            width: 20px;
            height: 20px;
            fill: white;
            transition: fill 0.3 ease;
        }

        .filter-product-icon{
            width: 25px;
            height: 25px;
        }

        .tables-container{
            display: flex;
            gap: 1.5rem;
            width: 100%;
            padding: 0 15px;
            box-sizing: border-box;
        }

        .table-wrapper{
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }

        .stocks-table-container{
            flex: 3;
        }

        .current-category{
            flex: 1;
        }

        .current-category{
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .current-category-table .stocks-table-container{
            max-height: 200px;
        }

        .stocks-table-container .table-responsive{
            max-height: 300px;
        }

        .stocks-table-container {
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

        .table-action-button:hover .edit-product-icon,
        .action-button:hover .edit-product-icon{
            fill:goldenrod;
        }

        .table-action-button:hover .delete-product-icon,
        .action-button:hover .delete-product-icon{
            fill: red;
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
        }

        .edit-product-icon,
        .delete-product-icon{
            width: 25px;
            height: 25px;
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

    /*--------------------------------------------------*/
        .category-modal{
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 100;
            justify-content: center;
            align-items: center;
        }

        .category-modal-content{
            background: white;
            width: 90%;
            max-width: 400px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            overflow: hidden;
        }

        .modal-header {
            padding: 20px;
            border-bottom: 1px solid #eee;
            background: #f9fafc;
        }

        .modal-title {
            margin: 0;
            font-size: 22px;
            color: #333;
            font-weight: 600;
        }

        .close-btn {
            position: absolute;
            right: 20px;
            top: 20px;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #777;
            padding: 0;
            margin: 0;
            line-height: 1;
        }

        .close-btn:hover {
            color: #666;
        }

        .category-modalbody {
            display: flex;
            padding: 0;
        }

        .form-category-section{
            flex: 1.5;
            padding: 20px;
        }

        .upload-categoryform{
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
            font-size: 14px;
        }

        .new-category {
            width: 100%;
            max-width: 340px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            transition: border 0.2s;
        }

        .category-button{
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
        }

        #back_button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background-color: var(--aluminum);
            color: #333;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 14px;
            cursor: pointer;
            transition: 0.3s;
        }

        #back_button:hover{
            background-color: var(--tableborder);
        }

        #add_newcategory {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background-color: var(--normalbtn);
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 14px;
            cursor: pointer;
            transition: 0.3s;
        }

        #add_newcategory:hover{
            background-color: var(--hoverbtn);
        }
/*--------------------------------------------------*/

        .modal-header, .editmodal-header, .updatestocks-header{
            position: relative;
            padding: 20px;
            border-bottom: 1px solid #eee;
            background: #f9fafc;
        }

/*Edit----------------------------------------------*/
    .editcategory-modal{
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 100;
            justify-content: center;
            align-items: center;
        }

        .editcategory-modal-content{
            background: white;
            width: 90%;
            max-width: 400px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            overflow: hidden;
        }

        .editmodal-header{
            padding: 20px;
            border-bottom: 1px solid #eee;
            background: #f9fafc;
        }

        .editmodal-title {
                margin: 0;
                font-size: 22px;
                color: #333;
                font-weight: 600;
        }

        .editclose-btn{
            position: absolute;
            right: 20px;
            top: 20px;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #777;
            padding: 0;
            margin: 0;
            line-height: 1;
        }

        .editclose-btn:hover{
            color: #666;
        }

        .editcategory-modalbody{
            display: flex;
            padding: 0;
        }

        .editform-category-section{
            flex: 1.5;
            padding: 20px;
        }

        .upload-editcategoryform{
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .editform-group {
                margin-bottom: 15px;
        }

        .editform-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
            font-size: 14px;
        }

        .edit-category{
            width: 100%;
            max-width: 340px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            transition: border 0.2s;
        }

        .editcategory-button{
                display: flex;
                justify-content: flex-end;
                align-items: center;
                gap: 10px;
            }

        #edit_backBtn{
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background-color: var(--aluminum);
            color: #333;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 14px;
            cursor: pointer;
            transition: 0.3s;
        }

        #edit_backBtn:hover{
            background-color: var(--tableborder);
        }

        #edit_categoryBtn{
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background-color: var(--normalbtn);
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 14px;
            cursor: pointer;
            transition: 0.3s;
        }

        #edit_categoryBtn:hover{
            background-color: var(--hoverbtn);
        }


    /*update stocks css-------------------------------------- */
        .updatestocks-modal{
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 100;
            justify-content: center;
            align-items: center;
        }

        .updatestocks-modal-content{
            background: white;
            width: 90%;
            max-width: 400px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            overflow: hidden;
        }

        .updatestocks-header{
            padding: 20px;
            border-bottom: 1px solid #eee;
            background: #f9fafc;
        }

        .updatestocks-title{
            margin: 0;
            font-size: 22px;
            color: #333;
            font-weight: 600;
        }

        .updatestocks-closebtn{
            position: absolute;
            right: 20px;
            top: 20px;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #777;
            padding: 0;
            margin: 0;
            line-height: 1;  
        }

        .updatestocks-btn{
            color: #666;
        }

        .updatestocks-body{
            display: flex;
            padding: 0;
        }

        .updatestocks-form-section{
            flex: 1.5;
            padding: 20px;
        }

        .updatestocks-form{
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .updatestocks-formgroup{
            margin-bottom: 15px;
        }

        .updatestocks-label{
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
            font-size: 14px;
        }

        .updatestocks-txt, .updatestocks-input{
            width: 100%;
            max-width: 340px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            transition: border 0.2s;
        }

        .updatestocks-btn{
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
        }

        #updatestocks_addbtn{
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background-color: var(--normalbtn);
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 14px;
            cursor: pointer;
            transition: 0.3s;
        }

        #updatestocks_addbtn{
            background-color: var(--hoverbtn);
        }

        #updatestocks_backbtn{
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background-color: var(--aluminum);
            color: #333;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 14px;
            cursor: pointer;
            transition: 0.3s;
        }

        #updatestocks_backbtn{
            background-color: var(--tableborder);
        }
    /*update stocks css-------------------------------------- */
    .button-group {
        display: flex;
        justify-content: flex-end; /* Aligns buttons to the right */
        gap: 10px; /* Small gap between buttons */
        margin: 15px;
    }

    .action-button {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border: none;
        border-radius: 5px;
        padding: 10px 15px;
        font-size: 14px;
        cursor: pointer;
        transition: 0.3s;
    }

   #add-stock {
        background-color: var(--importanthl);
        color: white;
    }

    #add-stock:hover {
        background-color: var(--textnavlink);
    }

    #add-category {
        background-color: var(--importanthl);
        color: white;
    }

    #add-category:hover {
        background-color: var(--textnavlink);
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

                <div class="nav-logo">
                    <img src="{{ asset('images/TurboParts3.png') }}" alt="">
                </div>
                
                <a class="home-link" href="{{ route('staff.products') }}">Products</a>
                <a href="{{ route('staff.inventory') }}">Inventory</a>
                <a class="logout-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Log out
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            <h1>TurboParts</h1>
        </nav>
    </header> 

    <main>
       
        <div class="container">
            <div class="main-container">

                <div class="header">
                    <div id="current-date"></div>
                    <div id="real-time-display"></div>
                        <span>Staff:</span>
                        <div class="user-area">
                            <div class="user-profile">
                                <div class="user-avatar">RI</div>
                                <span>Ren Indino</span>
                            </div>
                        </div>
                </div>

                <div class="search-bar">
                    <div class="search-container">
                        <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
                    </div>
                        <input type="text" placeholder="Enter Product's info to search">
                </div>

                <div class="page-header">  
                    <h1 class="page-title">Inventory</h1>
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

                        <button class="filter-button">
                            <svg class="filter-product-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M440-160q-17 0-28.5-11.5T400-200v-240L168-736q-15-20-4.5-42t36.5-22h560q26 0 36.5 22t-4.5 42L560-440v240q0 17-11.5 28.5T520-160h-80Zm40-308 198-252H282l198 252Zm0 0Z"/></svg>                            
                            Apply Filters
                        </button>
                    </div>
                </div>

                <!-- Replace your current add-stocks and add-button divs with this: -->
                    <div class="button-group">
                        <button id="add-stock" class="action-button">
                            <svg class="add-product-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                                <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/>
                            </svg>
                            Add Stock
                        </button>

                        <button id="add-category" class="action-button">
                            <svg class="add-product-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                                <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/>
                            </svg>
                            Add Category
                        </button>
                    </div>

                <div class="tables-container">

                        <div class="table-wrapper current-category">
                            <div class="table-header">
                                <div class="table-title">Current Product Category</div>
                            </div>

                            <div class="table-responsive current-category-table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($categories as $category)
                                        <tr>
                                            <td>{{ $category->category_id }}</td>
                                            <td>{{ $category->category_name}}</td>
                                            <td>
                                                <button id="table-editaction-button" class="table-action-button" data-category-id="{{ $category->category_id }}">
                                                    <svg class="edit-product-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                                                </button>

                                                <button id="table-deleteaction-button" class="table-action-button" data-category-id="{{ $category->category_id }}">
                                                    <svg class="delete-product-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    <div class="table-wrapper stocks-table-container">
                        <div class="table-header">
                            <div class="table-title">Stocks</div>
                        </div>

                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Current Stocks</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($inventories as $inventory)
                                    <tr>
                                        <td>{{ $inventory->inventory_id }}</td>
                                        <td>{{ $inventory->product->product_name }}</td>
                                        <td>{{ $inventory->stocks_quantity }}</td>
                                        <td>
                                            <div class="table-actions">
                                                <button id="stockstable-editaction-button" class="table-action-button">
                                                    <svg class="edit-product-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                   
                </div>

        <!-- Add Category--------------------------------------------------------------->
            <div class="category-modal" id="category_modal">
                <div class="category-modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Add New Category</h3>
                        <button class="close-btn" id="closemodalBtn">&times;</button>
                    </div>

                    <div class="category-modalbody">
                         
                        <div class="form-category-section">
                    
                            <form action="" class="upload-categoryform" id="upload_categoryform">
                                @csrf
                                <div class="form-group">
                                    <div class="form-label">New Product's Category</div>
                                    <input type="text" name="category_name" id="new_category" class="new-category" required>
                                </div>

                                <div class="category-button">                              
                                    <button type="submit" id="add_newcategory">Add New Category</button>
                                    <button id="back_button">Back</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Add Category--------------------------------------------------------------->

        <!-- Edit Stocks--------------------------------------------------------------->
        <div class="updatestocks-modal" id="updateStocks_modal">
            <div class="updatestocks-modal-content">
                <div class="updatestocks-header">
                    <h3 class="updatestocks-title">Update Product's Stocks</h3>
                    <button class="updatestocks-closebtn" id="updatestocks_closebtn">&times;</button>
                </div>

                <div class="updatestocks-body">
                    <div class="updatestocks-form-section">
                        <form action="" class="updatestocks-form" id="updatestocks_form" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="updatestock-formgroup">
                                 <div class="updatestocks-label">Product's Name:</div>
                                 <input type="text" name="product_name" id="product_name" class="updatestocks-txt" disabled>
                            </div>

                            <div class="updatestock-formgroup">
                                <div class="updatestocks-label">Update Stocks:</div>
                                <input type="number" name="stocks_quantity" id="stocks_quantity" class="updatestocks-input" required>
                            </div>

                            <div class="updatestocks-btn">
                                <button type="submit" id="updatestocks_addbtn">Update Stocks</button>
                                <button type="button" id="updatestocks_backbtn">Back</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
        <!-- Edit Stocks--------------------------------------------------------------->

        <!--Edit Category--------------------------------------------------------------->
        <div class="editcategory-modal" id="editcategory_modal">
            <div class="editcategory-modal-content">
                <div class="editmodal-header">
                    <h3 class="editmodal-title">Edit Current Category</h3>
                    <button class="editclose-btn" id="editcloseBtn">&times;</button>
                </div>

                <div class="editcategory-modalbody">

                    <div class="editform-category-section">
                        <form action="" class="upload-editcategoryform" id="upload_editcategory">
                            @csrf
                            @method('PUT')
                            <div class="editform-group">
                                <div class="editform-label">Edit Category</div>
                                <input type="text" name="category_name" id="edit_category" class="edit-category" required>
                            </div>

                            <div class="editcategory-button">
                                <button type="submit" id="edit_categoryBtn">Update Category</button>
                                <button id="edit_backBtn">Back</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
        <!--Edit Category--------------------------------------------------------------->


            </div>
        </div>

    </main>

    <script src="{{ asset('js/scriptForTime.js') }}"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function() {
        const updateStockModal = document.getElementById('updateStocks_modal');
        const updateStockForm = document.getElementById('updatestocks_form');

        document.querySelectorAll('#stockstable-editaction-button').forEach(button => {
            button.addEventListener('click', async function(){
                const row = this.closest('tr');
                const inventoryId = row.querySelector('td:first-child').textContent;

                try{
                    const response = await fetch(`/TurboParts/Staff/inventories/${inventoryId}/edit`);
                    const inventory = await response.json();

                    document.getElementById('product_name').value = inventory.product.product_name;
                    document.getElementById('stocks_quantity').value = inventory.stocks_quantity;
                    updateStockForm.action = `/TurboParts/Staff/inventories/${inventoryId}`;
                    updateStockModal.style.display = 'flex';
                }  catch (error) {
                console.error('Error:', error);
                alert('Failed to load inventory data');
                }
            });
          
       });

       document.getElementById('updatestocks_closebtn').addEventListener('click', function() {
        updateStockModal.style.display = 'none';
        });

        document.getElementById('updatestocks_backbtn').addEventListener('click', function() {
            updateStockModal.style.display = 'none';
        });

        window.addEventListener('click', function(e) {
            if(e.target === updateStockModal) {
                updateStockModal.style.display = 'none';
            }
        });

    });
    </script>
   
    <script>
        const modals = {
            add: document.getElementById('category_modal'),
            edit: document.getElementById('editcategory_modal')
        };

        function openModal(modal) {
            modal.style.display = 'flex';
        }

        function closeModal(modal) {
            modal.style.display = 'none';
        }

        document.getElementById('add-category').addEventListener('click', () => openModal(modals.add));
        document.getElementById('closemodalBtn').addEventListener('click', () => closeModal(modals.add));
        document.getElementById('back_button').addEventListener('click', () => closeModal(modals.add));

        window.addEventListener('click', (e) => {
            if (e.target === modals.add || e.target === modals.edit) {
                closeModal(e.target);
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('upload_categoryform')?.addEventListener('submit', async function(e) {
                e.preventDefault();
                const form = e.target;
                const submitBtn = form.querySelector('button[type="submit"]');
                
                try {
                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Adding...';
                    const response = await fetch('{{ route("staff.categories.store") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            category_name: document.getElementById('new_category').value
                        })
                    });
                    const data = await response.json();
                    if (!response.ok) throw new Error(data.message || 'Failed to add category');
                    alert('Category added successfully!');
                    window.location.reload();
                } catch (error) {
                    alert('Error: ' + error.message);
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Add New Category';
                }
            });

            document.addEventListener('click', async function(e) {
                if (e.target.closest('#table-editaction-button')) {
                    const button = e.target.closest('#table-editaction-button');
                    const categoryId = button.dataset.categoryId;
                    try {
                        const response = await fetch(`/TurboParts/Staff/categories/${categoryId}/edit`);
                        const category = await response.json();
                        document.getElementById('edit_category').value = category.category_name;
                        document.getElementById('upload_editcategory').action = `/TurboParts/Staff/categories/${categoryId}`;
                        openModal(modals.edit);
                    } catch (error) {
                        alert('Error loading category: ' + error.message);
                    }
                }
                
                if (e.target.closest('#table-deleteaction-button')) {
                    if (confirm('Are you sure you want to delete this category?')) {
                        const button = e.target.closest('#table-deleteaction-button');
                        const categoryId = button.dataset.categoryId;
                        try {
                            const response = await fetch(`/TurboParts/Staff/categories/${categoryId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                }
                            });
                            const data = await response.json();
                            if (!response.ok) throw new Error(data.message || 'Delete failed');
                            alert('Category deleted successfully!');
                            window.location.reload();
                        } catch (error) {
                            alert('Error: ' + error.message);
                        }
                    }
                }
            });

            document.getElementById('upload_editcategory')?.addEventListener('submit', async function(e) {
                e.preventDefault();
                const form = e.target;
                const submitBtn = form.querySelector('button[type="submit"]');
                try {
                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Updating...';
                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'X-HTTP-Method-Override': 'PUT'
                        },
                        body: JSON.stringify({
                            category_name: document.getElementById('edit_category').value,
                            _method: 'PUT'
                        })
                    });
                    const data = await response.json();
                    if (!response.ok) throw new Error(data.message || 'Update failed');
                    alert('Category updated successfully!');
                    window.location.reload();
                } catch (error) {
                    alert('Error: ' + error.message);
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Update Category';
                }
            });

            document.getElementById('editcloseBtn').addEventListener('click', () => closeModal(modals.edit));
            document.getElementById('edit_backBtn').addEventListener('click', (e) => {
                e.preventDefault();
                closeModal(modals.edit);
            });
        });
    </script>

</body>
</html> 