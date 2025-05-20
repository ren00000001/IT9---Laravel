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

        .main-content{
            flex: 1;
            padding: 20px;
        }

        .header{
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 20px;
            gap: 25px;
        }

        .user-area{
            display: flex;
            align-items: center;
        }

        .user-profile{
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .user-avatar{
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
            gap: 20px;
        }

        #add-button {
           display: flex;
           align-items: center;
           justify-content: center;
           gap: 8px;
           background-color: var(--secondbtn);
           color: white;
           border: none;
           border-radius: 5px;
           padding: 10px 15px;
           font-size: 14px;
           cursor: pointer;
           transition: 0.3s;
        }

        #add-button:hover{
            background-color: var(--hoverbtn);
        }

        .add-product-icon{
            width: 25px;
            height: 25px;
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

        .products-table-container{
            flex: 3;
        }

        .stock-notif{
            flex: 1;
        }

        .stock-notif{
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }
        
        .stock-notif .table-responsive {
            max-height: 200px; /* Slightly smaller since it has fewer columns */
        }

        .products-table-container .table-responsive {
            max-height: 300px; /* Taller to accommodate more complex rows */
        }

        .products-table-container {
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
            gap: 6px
        }

        .table-action-button:hover .edit-product-icon{
            fill: goldenrod
        }

        .table-action-button:hover .delete-product-icon{
            fill: red;
        }

        .filter-product-icon,
        .table-action-button,
        .edit-product-icon,
        .delete-product-icon{
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .filter-product-icon{
            width: 20px;
            height: 20px;
            fill: white;
            transition: fill 0.3s ease;
        }

        .edit-product-icon,
        .delete-product-icon{
            padding: 5px 5px;
        }

        .filter-product-icon,
        .edit-product-icon,
        .delete-product-icon{
            width: 25px;
            height: 25px;
        }

        .action-button:hover{
            transition: background-color 0.3s ease;
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

        /*Modal------------------------------------------------------------*/
            .modal{
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

            .modal-content {
                background: white;
                width: 90%;
                max-width: 900px;
                max-height: 600px;
                border-radius: 12px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.15);
                overflow: hidden;
                display: flex;
                flex-direction: column;
            }

            .modal-header {
                position: relative;
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
                float: right;
                font-size: 24px;
                color: #999;
                cursor: pointer;
                line-height: 1;
            }
            
            .close-btn:hover {
                color: #666;
            }    
            
            .modal-body {
                display: flex;
                padding: 0;
            }

            .preview-section {
                flex: 1;
                padding: 20px;
                background: #f5f7fa;
                border-right: 1px solid #eee;
                min-height: 300px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: space-between;
            }
        
            .preview-container {
                width: 100%;
                max-width: 250px;
                height: 180px;
                border: 2px dashed #ccc;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: white;
                overflow: hidden;
                position: relative;
            }
            
            .preview-image {
                max-width: 100%;
                max-height: 100%;
                display: none;
            }
            
            .preview-placeholder {
                text-align: center;
                color: #999;
                padding: 20px;
            }
            
            .preview-placeholder i {
                font-size: 40px;
                margin-bottom: 10px;
                display: block;
                color: #ccc;
            }

           .preview-form-group{
                 margin-bottom: 15px;
                 width: 100%;
                 margin-top: auto;
                 padding-top: 20px;
            }

            .form-section {
                flex: 1.5;
                padding: 20px;
            }
            
            .upload-form {
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
            
            .form-control {
                width: 100%;
                padding: 10px 12px;
                max-width: 460px;
                border: 1px solid #ddd;
                border-radius: 6px;
                font-size: 14px;
                transition: border 0.2s;
            }
            
            .form-control:focus {
                border-color: #4CAF50;
                outline: none;
            }
            
            textarea.form-control {
                min-height: 80px;
                resize: vertical;
            }

            .file-input-wrapper {
                display: flex;
                position: relative;
                overflow: hidden;
                justify-content: space-between;
            }
            
            .file-input-label {
                display: block;
                background: #4CAF50;
                color: white;
                padding: 10px 15px;
                border-radius: 6px;
                text-align: center;
                cursor: pointer;
                font-weight: 500;
                transition: background 0.2s;
            }
            
            .file-input-label:hover {
                background: #3d8b40;
            }

            #clearSelectionBtn{
                display: block;
                background: #4CAF50;
                color: white;
                padding: 10px 15px;
                border-radius: 6px;
                text-align: center;
                cursor: pointer;
                font-weight: 500;
                transition: background 0.2s;
            }
            
            .file-input {
                position: absolute;
                left: 0;
                top: 0;
                opacity: 0;
                width: 100%;
                height: 100%;
                cursor: pointer;
            }

            .submit-btn {
                background: #2196F3;
                color: white;
                border: none;
                padding: 12px;
                border-radius: 6px;
                font-size: 15px;
                font-weight: 500;
                cursor: pointer;
                transition: background 0.2s;
                margin-top: 10px;
                margin-bottom: 10px;
            }
            
            .submit-btn:hover {
                background: #0b7dda;
            }

            .file-info {
                font-size: 13px;
                color: #666;
                margin-top: 5px;
            }

            .open-modal-btn {
                background: #4CAF50;
                color: white;
                border: none;
                padding: 12px 24px;
                border-radius: 6px;
                font-size: 16px;
                font-weight: 500;
                cursor: pointer;
                transition: background 0.2s;
            }
            
            .open-modal-btn:hover {
                background: #3d8b40;
            }
            
            .clear-btn {
                background: #f44336;
                color: white;
                border: none;
                padding: 10px 15px;
                border-radius: 6px;
                margin-left: 10px;
                cursor: pointer;
                transition: background 0.2s;
            }

            .clear-btn:hover {
                background: #d32f2f;
            }
        /*Modal------------------------------------------------------------*/


        /*Edit modal-------------------------------------------------------*/
        .edit-modal{
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

        .edit-modal-content{
            background: white;
            width: 90%;
            max-width: 900px;
            max-height: 600px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .edit-modal-header{
            position: relative;
            padding: 20px;
            border-bottom: 1px solid #eee;
            background: #f9fafc;
        }

        .edit-modal-title{
            margin: 0;
            font-size: 22px;
            color: #333;
            font-weight: 600;
        }

        .edit-close-btn{
            float: right;
            font-size: 24px;
            color: #999;
            cursor: pointer;
            line-height: 1;
        }

        .edit-close-btn:hover{
            color: #666;
        }

        .edit-modal-body{
            display: flex;
            padding: 0;
        }

        .edit-preview-section{
            flex: 1;
            padding: 20px;
            background: #f5f7fa;
            border-right: 1px solid #eee;
            min-height: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
        }

        .edit-preview-container{
            width: 100%;
            max-width: 250px;
            height: 180px;
            border: 2px dashed #ccc;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            overflow: hidden;
            position: relative;
        }

        .edit-preview-image{
            max-width: 100%;
            max-height: 100%;
            display: none;   
        }

        .edit-preview-placeholder{
            text-align: center;
            color: #999;
            padding: 20px;
        }

        .edit-preview-placeholder i {
            font-size: 40px;
            margin-bottom: 10px;
            display: block;
            color: #ccc;
        }

        .editpreview-form-group{
            margin-bottom: 15px;
            width: 100%;
            margin-top: auto;
            padding-top: 20px;
        }

        .edit-form-section{
            flex: 1.5;
            padding: 20px;
        }

        .edit-upload-form{
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .edit-form-group{
            margin-bottom: 15px;
            width: 100%;
            max-width: 460px;
        }

        .edit-form-label{
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
            font-size: 14px;
        }

        .edit-form-control{
            width: 100%;
            padding: 10px 12px;
            max-width: 460px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            transition: border 0.2s;   
        }

        .edit-form-control:focus{
            border-color: #4CAF50;
            outline: none;
        }

        textarea.edit-form-control {
            min-height: 80px;
            resize: vertical;min-height: 80px;
            resize: vertical;
            width: 100%;
            padding: 10px 12px;
            max-width: 460px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            transition: border 0.2s;
        }

        .edit-file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 460px;
        }

        .edit-file-input-label{
            display: block;
            background: #4CAF50;
            color: white;
            padding: 10px 15px;
            border-radius: 6px;
            text-align: center;
            cursor: pointer;
            font-weight: 500;
            transition: background 0.2s;
        }

        .edit-file-input-label:hover{
            background: #3d8b40;
        }

        .edit-file-input{
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .edit-submit-btn{
            background: #2196F3;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 10px; 
            margin-bottom: 10px;  
            width: 100%;  
            max-width: 460px;   
        }

        .edit-submit-btn:hover{
            background: #0b7dda;
        }

        .edit-file-info{
            font-size: 13px;
            color: #666;
            margin-top: 5px;
        }

        .edit-open-modal-btn{
            background: #4CAF50;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
        }

        .edit-open-modal-btn:hover {
            background: #3d8b40;
        }
        
        .edit-clear-btn {
            background: #f44336;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 6px;
            margin-left: 10px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .edit-clear-btn:hover {
            background: #d32f2f;
        }
/*edit modal-------------------------------------------*/

        /*category modal--------------------------------------------------*/
        .category-modal{
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 100;
            justify-content: center;
            align-items: center;
        }

        .category-modal-content{
            background: white;
            width: 90%;
            max-width: 700px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .category-modalbody{
            display: flex;
            padding: 0;
        }

        .form-category-section{
            flex: 1;
            padding: 20px;
        }

        .upload-categoryform{
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .new-category{
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14ppx;
            transition: border 0.2s
        }

        .new-category:focus{
            border-color: grey;
            outline: none;
        }

        .product-category{
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
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
           background-color: green;
           color: white;
           border: none;
           border-radius: 5px;
           padding: 10px 15px;
           font-size: 14px;
           cursor: pointer;
           transition: 0.3s;
        }

        #back_button:hover{
            background-color: rgb(25, 99, 25);
        }

        #add_newcategory {
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

        #add_newcategory:hover{
            background-color: rgb(25, 99, 25);
        }


        /*category modal--------------------------------------------------*/

    </style>
</head>
<body>

@if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
            <button onclick="this.parentElement.style.display='none'">&times;</button>
        </div>
@endif

@if(session('error'))
        <div class="alert-error">
            {{ session('error') }}
            <button onclick="this.parentElement.style.display='none'">&times;</button>
        </div>
@endif
     
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
            <div class="main-content">

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
                    <h1 class="page-title">Products</h1>
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

                <div class="add-button">
                    <button id="add-button">
                        <svg class="add-product-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                        Add Product
                    </button>
                </div>

                <div class="tables-container">

                        <div class="table-wrapper stock-notif">
                            <div class="table-header">
                                <div class="table-title">Low Stock Notif</div>
                            </div>

                            <div class="table-responsive stock-notif-table">
                                    <table>
                                        <thead>
                                        <tr>
                                                <th>Product</th>
                                                <th>Current Stocks</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                           @forelse($lowStockProducts as $product)
                                            <tr>
                                                <td>{{ $product->product_name}}</td>
                                                <td>{{ $product->inventory->stocks_quantity }} left</td>
                                            </tr>
                                                @empty
                                            <tr>
                                                <td colspan="2" style="text-align: center;">No low stock products</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                            </div>
                        </div>

                    <div class="table-wrapper products-table-container">
                        <div class="table-header">
                            <div class="table-title">All Products</div>
                        </div>

                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->product_id }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->category->category_name }}</td>
                                        <td>${{ number_format($product->product_price, 2) }}</td>
                                        <td>{{ $product->product_quantity }}</td>
                                        <td>
                                            <span class="status-badge status-{{ $product->product_quantity > 0 ? 'in-stock' : 'out-of-stock '}}">
                                            {{ $product->product_quantity > 0 ? 'In-Stock' : 'Out-of-Stock' }}
                                            </span>
                                        </td>
                                        <td>Jan 15, 2023</td>
                                        <td>
                                            <div class="table-actions">
                                                <button class="table-action-button" onclick="openEditModal('{{ $product->product_id }}',
                                                                                                            '{{ $product->product_name}}',
                                                                                                            '{{ $product->category_id}}',
                                                                                                            '{{ $product->product_price }}',
                                                                                                            '{{ $product->product_description}}'
                                                                                                            )">
                                                    <svg class="edit-product-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                                                </button>


                                                <form method="POST" action="{{ route('staff.products.destroy', $product->product_id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"  class="table-action-button" onclick="return confirm('Are you sure you want to delete this product?')">
                                                        <svg class="delete-product-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
                                                    </button>
                                                </form>
                        
                                            </div>
                                        </td>
                                    </tr>    
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>

    <!--Add Modal------------------------------------------------------------------->
            <div class="modal" id="productmodal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="modalTitle">Add Product</h3>
                        <span class="close-btn" id="closeModalBtn">&times;</span>
                    </div>

                    <div class="modal-body">
                        <div class="preview-section">
                            <div class="preview-container" id="previewContainer">
                                <img class="preview-image" id="previewImage" alt="Product Preview Image">
                                <div class="preview-placeholder" id="previewPlaceholder">
                                   Product Image
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Product Image</label>

                                <div class="file-input-wrapper">
                                    <button class="file-input-label">Choose Image</button>
                                    <input type="file" name="product_image" id="product_image" class="file-input" accept="image/*">                           
                                </div>
                                <button type="button" id="clearSelectionBtn">Clear</button>

                                <div class="file-info">Supports: JPG & PNG(MAX 5mb)</div>
                            </div>

                        </div>

                        <div class="form-section">
                            <form class="upload-form" id="productForm" method="POST" action="{{ route('staff.products.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="product_name" class="form-label">Product Name</label>
                                    <input type="text" name="product_name" id="product_name" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="category_id" class="form-label">Product Category</label>
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        <option value="">Select a Category</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->category_id }}">{{ $category->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="product_price" class="form-label">Price</label>
                                    <input type="number" step="0.01" name="product_price" id="product_price" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="product_description" class="form-label">Description</label>
                                    <textarea name="product_description" id="product_description" class="from-control"></textarea>
                                </div>

                                <button type="submit" class="submit-btn" id="submitBtn">Add New Product</button>
                                
                        </form>
                        </div>
                    </div>
                </div>
            </div>
    <!--Add Modal------------------------------------------------------------------->

    <!--Edit Modal------------------------------------------------------------------>
        <div class="edit-modal" id="editProductModal">
            <div class="edit-modal-content">
                <div class="edit-modal-header">
                    <h3 class="edit-modal-title" id="editModalTitle">Edit Product</h3>
                    <span class="edit-close-btn" id="editCloseModalBtn">&times;</span>
                </div>

                <div class="edit-modal-body">
                    <div class="edit-preview-section">
                        <div class="edit-preview-container" id="editPreviewContainer">
                            <img class="edit-preview-image" id="editPreviewImage" alt="Product Preview Image">
                            <div class="edit-preview-placeholder" id="editPreviewPlaceholder">
                                Product Image
                            </div>
                        </div>

                        <div class="editpreview-form-group">
                            <label class="edit-form-label">Product Image</label>

                            <div class="edit-file-input-wrapper">
                                <button class="edit-file-input-label">Choose Image</button>
                                <input type="file" name="product_image" id="product_image" class="edit-file-input" accept="image/*">   
                            </div>
                            <button type="button" id="EditClearSelectionBtn">Clear</button>

                            <div class="edit-file-info">Supports: JPG & PNG(MAX 5mb)</div>
                        </div>
                    </div>

                    <div class="edit-form-section">
                        <form class="edit-upload-form" id="editProductForm" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="edit-form-group">
                                <label for="product_name" class="edit-form-label">Product Name:</label>
                                <input type="text" name="product_name" id="product_name" class="edit-form-control" required>
                            </div>

                            <div class="edit-form-group">
                                <label for="category_id" class="edit-form-label">Product Category</label>
                                <select name="category_id" id="category_id" class="edit-form-control" required>
                                    <option value="">Select a Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->category_id}}">{{ $category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="edit-form-group">
                                <label for="product_price" class="edit-form-label">Price</label>
                                <input type="number" step="0.01" name="product_price" id="product_price" class="edit-form-control" required>
                            </div>

                            <div class="edit-form-group">
                                <label for="product_description" class="edit-form-label">Description</label>
                                <textarea name="product_description" id="product_description" class="edit-form-control"></textarea>
                            </div>

                            <button type="submit" class="edit-submit-btn" id="EditSubmitBtn">Update Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!--Edit Modal------------------------------------------------------------------>


            </div>
       </div>
       
    </main>
    <script src="{{ asset('js/scriptForTime.js') }}"></script>
    <script src="{{ asset('js/popNotif.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
 
    const addModal = document.getElementById('productmodal');
    const addOpenBtn = document.getElementById('add-button');
    const addCloseBtn = document.getElementById('closeModalBtn');
    
    addOpenBtn.addEventListener('click', function() {
        addModal.style.display = 'flex';
    });
    
    addCloseBtn.addEventListener('click', function() {
        addModal.style.display = 'none';
    });

    const editModal = document.getElementById('editProductModal');
    const editCloseBtn = document.getElementById('editCloseModalBtn');

    window.openEditModal = function(id, name, category, price, description) {
        const editForm = document.getElementById('editProductForm');

        editForm.action = `/TurboParts/Staff/products/${id}`;

        editForm.querySelector('[name="product_name"]').value = name;
        editForm.querySelector('[name="category_id"]').value = category;
        editForm.querySelector('[name="product_price"]').value = price;
        editForm.querySelector('[name="product_description"]').value = description;
 
        editModal.style.display = 'flex';
    };

    function closeEditModal() {
        editModal.style.display = 'none';
    }

    editCloseBtn.addEventListener('click', closeEditModal);

    window.addEventListener('click', function(e) {
        if(e.target === addModal) {
            addModal.style.display = 'none';
        }
        if(e.target === editModal) {
            closeEditModal();
        }
    });

    const productImageInput = document.getElementById('product_image');
    const previewContainer = document.getElementById('previewContainer');
    const previewImage = document.getElementById('previewImage');
    const previewPlaceholder = document.getElementById('previewPlaceholder');
    const clearSelectionBtn = document.getElementById('clearSelectionBtn');

   if (productImageInput) {
        productImageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                    previewPlaceholder.style.display = 'none';
                }
                
                reader.readAsDataURL(file);
            }
        });

     clearSelectionBtn.addEventListener('click', function() {
        productImageInput.value = '';
        previewImage.src = '';
        previewPlaceholder.style.display = 'block';
        
     });

    }

    //const editProductImageInput = document.getElementById('edit_product_image');
    const editProductImageInput = document.querySelector('#editProductModal input[name="product_image"]');
    const editPreviewContainer = document.getElementById('editPreviewContainer');
    const editPreviewImage = document.getElementById('editPreviewImage');
    const editPreviewPlaceholder = document.getElementById('editPreviewPlaceholder');
    const editClearSelectionBtn = document.getElementById('EditClearSelectionBtn');

    if (editProductImageInput) {
        editProductImageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    editPreviewImage.src = e.target.result;
                    editPreviewImage.style.display = 'block';
                    editPreviewPlaceholder.style.display = 'none';
                }
                
                reader.readAsDataURL(file);
            }
        });

        editClearSelectionBtn.addEventListener('click', function() {
        editProductImageInput.value = ''; 
        editPreviewImage.src = ''; 
        editPreviewImage.style.display = 'none'; 
        editPreviewPlaceholder.style.display = 'block'; 
    });

    }
});

</script>

</body>
</html> 