<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MotoPOS - Products</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
    
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
            background-color: var(--headertble);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 10px;
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
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background-color: var(--primary);
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
            background-color: #2980b9;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .filter-button:hover .filter-product-icon{
            fill: rgb(229, 229, 239);
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

        .view-options {
            display: flex;
            align-items: center;
        }

        .view-option {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
        }

        .view-option.active {
            background-color: rgba(52, 152, 219, 0.1);
            color: var(--primary);
        }

        .product-id {
            color: var(--primary);
            font-weight: 500;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
        }

        .status-in-stock {
            background-color: rgba(46, 204, 113, 0.1);
            color: var(--secondary);
        }

        .status-out-of-stock {
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
            gap: 6px
        }

        .table-action-button:hover .edit-product-icon,
        .action-button:hover .edit-product-icon{
            fill:goldenrod;
        }

        .table-action-button:hover .delete-product-icon,
        .action-button:hover .delete-product-icon{
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

        /*Form------------------------------------------------------*/
        
        .floating-add-form, .floating-edit-form{
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.05);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .form-add-content, .form-edit-content{
            background-color: whitesmoke;
            padding: 25px;
            border-radius: 10px;
            width: 90%;
            max-width: 700px;
            min-height: 500px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .form-add-content h2,
        .form-edit-content h2{
            margin-bottom: 20px;
            text-align: center;
        }

        .form-add-content form,
        .form-edit-content form {
            display: flex;
            flex: 1;
            gap: 20px;
        }

        .image-upload-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 250px; /* Set a minimum width for the image section */
        }

        .form-fields-section {
            flex: 2;
            display: flex;
            flex-direction: column;
        }

        /* Image Upload Styles */
         .image-upload-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            height: 100%;
        }

        .image-preview-placeholder {
            width: 100%;
            height: 200px;
            background-color: #f5f5f5;
            border: 2px dashed #ccc;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
            color: #7f8c8d;
            overflow: hidden;
            flex: 1;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .image-preview-placeholder:hover {
            border-color: #3498db;
            background-color: #f0f8ff;
        }

        .image-preview-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: none;
        }

        .file-info {
            font-size: 12px;
            color: #7f8c8d;
            text-align: center;
            margin-top: 10px;
        }

        .image-upload-container input[type="file"] {
            display: none;
        }

        /* Form Fields Styling */
        .form-fields-section label {
            margin-top: 10px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-fields-section input,
        .form-fields-section select,
        .form-fields-section textarea {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            width: 100%;
        }

        /* Close Button */
        .close-addform-button,
        .close-editform-button {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            cursor: pointer;
            color: #333;
        }

        .close-addform-button:hover,
        .close-editform-button:hover {
            color: #000;
        }
        
        form{
            display: flex;
            flex-direction: column;
        }

        form label{
            margin-top: 10px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        form input, form textarea, form select{
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        form button{
            padding: 10px;
            background-color:  rgb(22, 22, 22);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        form button:hover{
            background-color: rgb(60, 59, 59);
        }

        input[type="file"]{
            margin-bottom: 15px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            width: 100%;
            box-sizing: border-box;
        }

        .image-preview{
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
            display: none;
        }

        input[type="date"]{
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            margin-bottom: 15px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="date"]:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
        }

        .addform-button,
        .editform-button {
            display: flex;
            justify-content: space-between;
            margin-top: auto;
            padding-top: 15px;
        }

        .addform-button button,
        .editform-button button {
            padding: 10px 20px;
            background-color: rgb(22, 22, 22);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 48%;
        }

        .addform-button button:hover,
        .editform-button button:hover {
            background-color: rgb(60, 59, 59);
        }

        input[type="file"] {
            margin-bottom: 0;
        }

        /*Form------------------------------------------------------*/
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

                <div class="nav-logo">
                    <img src="{{ asset('images/TurboParts3.png') }}" alt="">
                </div>
    
                <a class="home-link" href="{{ route('admin.dashboard') }}">Home</a>
                <a href="{{ route('admin.products') }}">Products</a>
                <a href="{{ route('admin.inventory') }}">Inventory</a>
                <a href="{{ route('admin.sales') }}">Sales</a>
                <a href="{{ route('admin.archives') }}">Archives</a>
                <a href="{{ route('admin.settings') }}">Settings</a>
                <!-- Move the Log out link to the bottom -->
                <a class="logout-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Log out
                </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
            </div>
            <h1>MOTOPOS</h1>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="main-content">
                <!-- Header with user icon in the top-right corner -->
                <div class="header">
                    <div id="current-date"></div>
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
                    <input type="text" placeholder="Enter Product's info to search">
                </div>

                <!-- Page Header -->
                <div class="page-header">
                    <h1 class="page-title">Products</h1>
                </div>

                <!-- Rest of the content -->
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

                <div class="products-table-container">
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
                                    <th>Added</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="product-id">#PROD-001</td>
                                    <td>Smartphone X</td>
                                    <td>Electronics</td>
                                    <td>$699.99</td>
                                    <td>25</td>
                                    <td>Jan 15, 2023</td>
                                    <td><span class="status-badge status-in-stock">In Stock</span></td>
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
                                <!-- Add more rows here -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!--Add Form------------------------------------------------------------------->
                <div id="floating-add-form" class="floating-add-form">
                    <div class="form-add-content">

                        <span id="close-addform-button" class="close-addform-button">&times;</span>

                        <h2>Add New Product</h2>

                        <form action="#">

                           <div class="image-upload-section">
                                <label for="product-image">Product Image:</label>
                                <div class="image-upload-container">
                                    <div class="image-preview-placeholder" id="image-preview-placeholder">
                                        <span>+ Upload Image</span>
                                    </div>
                                    <input type="file" id="product-image" name="product-image" accept="image/*">
                                    <div class="file-info">Max file size: 2MB. Supported formats: JPG, PNG, WebP</div>
                                </div>
                           </div>

                           <div class="form-fields-section">
                                
                            <label for="addproduct-name">Name:</label>
                            <input type="text" id="addproduct-name" name="addproduct-name" required>

                            <label for="addproduct-category">Category:</label>
                            <select name="addproduct-category" id="addproduct-category" class="category-option" required>
                                <option>OKE</option>
                                <option>OKE</option>
                                <option>OKE</option>
                            </select>

                            <label for="addproduct-stock">Stock:</label>
                            <input type="number" id="addproduct-stock" name="addproduct-stock" required>

                            <label for="addproduct-price">Price:</label>
                            <input type="number" id="addproduct-price" name="addproduct-price" required>

                            <label for="addproduct-calendar">Date Added:</label>
                            <input type="date" id="addproduct-calendar" name="addproduct-calendar" required>

                            <div class="addform-button">
                                <button type="submit">Add</button>
                                <button type="reset">Reset</button>
                            </div>
                           </div>

                        </form>

                    </div>
                </div>
                <!--Add Form------------------------------------------------------------------->

                <!--Edit Form------------------------------------------------------------------>
                <div id="floating-edit-form" class="floating-edit-form">
                    <div class="form-edit-content">

                        <span id="close-editform-button" class="close-editform-button">&times;</span>

                        <h2>Update Product's Information</h2>

                        <form action="#">
                            <div class="image-upload-section">
                                <label for="edit-product-image">Product Image:</label>
                                <div class="image-upload-container">
                                    <div class="image-preview-placeholder" id="edit-image-preview-placeholder">
                                        <span>+ Upload Image</span>
                                    </div>
                                    <input type="file" id="edit-product-image" name="edit-product-image" accept="image/*">
                                    <div class="file-info">Max file size: 2MB. Supported formats: JPG, PNG, WebP</div>
                                </div>
                            </div>

                            <div class="form-fields-section">
                                
                            <label for="editproduct-id">ID</label>
                            <input type="number" name="editproduct-id" id="editproduct-id" readonly>
    
                            <label for="editproduct-name">Name:</label>
                            <input type="text" name="editproduct-name" id="editproduct-name">
    
                            <label for="editproduct-category">Category:</label>
                            <select name="editproduct-category" id="editproduct-category">
                                <option>OKE</option>
                                <option>OKE</option>
                                <option>OKE</option>
                            </select>
    
                            <label for="editproduct-stock">Stock:</label>
                            <input type="number" name="editproduct-stock" id="editproduct-stock" required>
    
                            <label for="editproduct-price">Price:</label>
                            <input type="number" name="editproduct-price" id="editproduct-price">
    
                            <div class="editform-button">
                                <button type="submit">Update</button>
                                <button type="reset">Reset</button>
                            </div>
                            </div>

                        </form>

                    </div>
                </div>         
                <!--Edit Form------------------------------------------------------------------>

            </div>
        </div>

    </main>

    <script src="{{ asset('js/scriptForTime.js') }}"></script>

    <script>
 // Image preview functionality for both forms
 function setupImagePreview(formId, previewId, inputId) {
            const form = document.getElementById(formId);
            if (!form) return;
            
            const preview = document.getElementById(previewId);
            const input = document.getElementById(inputId);
            
            // Click on placeholder triggers file input
            preview.addEventListener('click', () => {
                input.click();
            });
            
            // Handle file selection
            input.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    // Validate file size (2MB max)
                    if (file.size > 2 * 1024 * 1024) {
                        alert('File size exceeds 2MB limit');
                        return;
                    }
                    
                    // Validate file type
                    const validTypes = ['image/jpeg', 'image/png', 'image/webp'];
                    if (!validTypes.includes(file.type)) {
                        alert('Only JPG, PNG, and WebP formats are allowed');
                        return;
                    }
                    
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        preview.innerHTML = '';
                        const img = document.createElement('img');
                        img.src = event.target.result;
                        preview.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                }
            });
        }

        // Set up both forms
        document.addEventListener('DOMContentLoaded', function() {
            setupImagePreview('floating-add-form', 'image-preview-placeholder', 'product-image');
            setupImagePreview('floating-edit-form', 'edit-image-preview-placeholder', 'edit-product-image');
            
            // Form open/close functionality
            document.getElementById('add-button').addEventListener('click', () => {
                document.getElementById('floating-add-form').style.display = 'flex';
            });

            document.getElementById('close-addform-button').addEventListener('click', () => {
                document.getElementById('floating-add-form').style.display = 'none';
            });

            const editButtons = [
                document.getElementById('table-editaction-button'),
                document.getElementById('edit-action-button')
            ];
            
            editButtons.forEach(button => {
                if (button) {
                    button.addEventListener('click', () => {
                        document.getElementById('floating-edit-form').style.display = 'flex';
                    });
                }
            });

            document.getElementById('close-editform-button').addEventListener('click', () => {
                document.getElementById('floating-edit-form').style.display = 'none';
            });

            // Close forms when clicking outside
            window.addEventListener('click', (event) => {
                if (event.target === document.getElementById('floating-add-form')) {
                    document.getElementById('floating-add-form').style.display = 'none';
                }
                if (event.target === document.getElementById('floating-edit-form')) {
                    document.getElementById('floating-edit-form').style.display = 'none';
                }
            });
        });
        //Image preview------------------------------------------------

        
    </script>
</body>
</html>