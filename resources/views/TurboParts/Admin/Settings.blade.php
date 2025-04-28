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
            background-color: var(--normalbtn);
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

        /*Add User Modal Styel---------------------------*/
        .modal-overlay{
            position: fixed;
            top: 0;
            left: 0;
            right:0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal-overlay.active{
            opacity: 1;
            visibility: visible;
        }

        .modal-content{
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            transform: translateY(-20px);
            transition: transform 0.3s ease;
        }

        .modal-overlay.active .modal-content{
            transform: translateY(0);
        }

        .modal-header{
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-title{
            font-size: 20px;
            font-weight: 600;
            color: #333; 
        }

        .modal-close{
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #777;
        }

        .form-group{
            margin-bottom: 15px;
        }

        .form-group label{
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #555;
        }

        .form-group input,
        .form-group select{
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-group input:focus,
        .form-group select:focus{
            outline: none;
            border-color: #4caf50;
        }

        .modal-footer{
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .btn{
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: backgroud-color 0.3s;
        }

        .btn-primary{
            background-color: #4caf50;
            color: white;
            border: none;
        }

        .btn-primary:hover{
            background-color: #45a049;
        }

        .btn-secondary{
            background-color: #f5f5f5;
            color: #333;
            border: 1px solid #ddd;
            margin-right: 10px;
        }

        .btn-secondary:hover{
            background-color: #e9e9e9;
        }
        /*Add User Modal Styel---------------------------*/

        /* Edit User Modal Styles */
        .edit-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .edit-modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .edit-modal-content {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            transform: translateY(-20px);
            transition: transform 0.3s ease;
        }

        .edit-modal-overlay.active .edit-modal-content {
            transform: translateY(0);
        }

        /* Password Update Toggle */
        .password-toggle {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .password-toggle label {
            margin-left: 8px;
            cursor: pointer;
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

                    <!--POPUP INFO------------------------------------------------>
                        <div class="popup-trigger" id="popup_svgtrigger">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                                <path d="M440-280h80v-240h-80v240Zm40-320q17 0 28.5-11.5T520-640q0-17-11.5-28.5T480-680q-17 0-28.5 11.5T440-640q0 17 11.5 28.5T480-600Zm0 520q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/>
                            </svg>
                        </div>

                            <div class="popup-overlay" id="popup">
                                <div class="popup-content">
                                    <button class="close-btn" aria-label="Close">&times;</button>
                                    <h2>Important Information</h2>
                                    <p>This is your pop-up content. You can put any HTML here including:</p>
                                    <ul>
                                        <li>Text paragraphs</li>
                                        <li>Images</li>
                                        <li>Forms</li>
                                        <li>Videos</li>
                                    </ul>
                                    <p>The modal will close when you click outside, press Escape, or click the close button.</p>
                                    <div style="margin-top: 20px; padding: 10px; background: #f5f5f5; border-radius: 5px;">
                                        <small>You can customize this content as needed.</small>
                                    </div>
                                </div>
                            </div>
                    <!--POPUP INFO------------------------------------------------>


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
                                        <th>Password</th>
                                        <th>Role</th>
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
                                        <td>123456</td>
                                        <td>Cashier</td>
                                        <td>Active</td>
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

        <!--Pop Add form for adding user---------------------->
        
        <div class="modal-overlay" id="addUserModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Add Users</h3>
                    <button class="modal-close">&times;</button>
                </div>
                <form id="addUserForm">
                    <div class="form-group">
                        <label for="userName">Name:</label>
                        <input type="text" id="userName" name="userName" required>
                    </div>
                    <div class="form-group">
                        <label for="userPassword">Password:</label>
                        <input type="password" id="userPassword" name="userPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="userRole">Role:</label>
                        <select id="userRole" name="userRole" required>
                            <option value="">Select Role</option>
                            <option value="admin">Admin</option>
                            <option value="cashier">Cashier</option>
                            <option value="manager">Manager</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary modal-close">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>  
        <!--Pop Add form for adding user---------------------->

        <!--Pop Edit form for editing user---------------------->
        <div class="edit-modal-overlay" id="editUserModal">
            <div class="edit-modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit User</h3>
                    <button class="modal-close">&times;</button>
                </div>
                <form id="editUserForm" method="POST" action="">
                    
                    <input type="hidden" id="editUserId" name="id">
                    
                    <div class="form-group">
                        <label for="editUserName">Name:</label>
                        <input type="text" id="editUserName" name="name" required>
                    </div>
                    
                    <div class="password-toggle">
                        <input type="checkbox" id="updatePassword">
                        <label for="updatePassword">Update Password</label>
                    </div>
                    
                    <div class="form-group password-field" style="display: none;">
                        <label for="editUserPassword">New Password:</label>
                        <input type="password" id="editUserPassword" name="password">
                    </div>
                    
                    <div class="form-group">
                        <label for="editUserRole">Role:</label>
                        <select id="editUserRole" name="role" required>
                            <option value="">Select Role</option>
                            <option value="admin">Admin</option>
                            <option value="cashier">Cashier</option>
                            <option value="manager">Manager</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="editUserStatus">Status:</label>
                        <select id="editUserStatus" name="status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary modal-close">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
        <!--Pop Edit form for editing user---------------------->


        </main>

        <script src="{{ asset('js/scriptForTime.js') }}"></script>
        <script src="{{ asset('js/Popup.js') }}"></script>

        <script>
            //Add User Form POP-UP-----------------------

            document.addEventListener('DOMContentLoaded', function() {
            const addButton = document.getElementById('add-button');
            const modal = document.getElementById('addUserModal');
            const closeButtons = document.querySelectorAll('.modal-close');
            const form = document.getElementById('addUserForm');

                // Open modal when Add User button is clicked
                addButton.addEventListener('click', function() {
                    modal.classList.add('active');
                });

                // Close modal when close button or cancel is clicked
                closeButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        modal.classList.remove('active');
                    });
                });

                // Close modal when clicking outside the modal content
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        modal.classList.remove('active');
                    }
                });

                // Close modal with Escape key
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && modal.classList.contains('active')) {
                        modal.classList.remove('active');
                    }
                });

                // Form submission
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    // Get form values
                    const name = document.getElementById('userName').value;
                    const password = document.getElementById('userPassword').value;
                    const role = document.getElementById('userRole').value;
                    
                    // Here you would typically send this data to your server
                    console.log('Adding user:', { name, password, role });
                    
                    // Close the modal
                    modal.classList.remove('active');
                    
                    // Reset the form
                    form.reset();
                    
                    // Show success message (you can customize this)
                    alert('User added successfully!');
                });
            });
            //Add User Form POP-UP-----------------------
        </script>

    <script>
            // Edit User Modal Functionality
            document.addEventListener('DOMContentLoaded', function() {
                const editButtons = document.querySelectorAll('#table-editaction-button');
                const editModal = document.getElementById('editUserModal');
                const closeButtons = document.querySelectorAll('.modal-close');
                const editForm = document.getElementById('editUserForm');
                const updatePasswordCheckbox = document.getElementById('updatePassword');
                const passwordField = document.querySelector('.password-field');

                // Password toggle functionality
                updatePasswordCheckbox.addEventListener('change', function() {
                    passwordField.style.display = this.checked ? 'block' : 'none';
                    if (!this.checked) {
                        document.getElementById('editUserPassword').value = '';
                    }
                });

                // Open edit modal when Edit button is clicked
                editButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        // Get user data from the table row (this is mock data - in real app you'd fetch from server)
                        const row = this.closest('tr');
                        const userId = row.cells[0].textContent;
                        const userName = row.cells[1].textContent;
                        const userRole = row.cells[3].textContent.toLowerCase();
                        const userStatus = row.cells[4].textContent.toLowerCase();

                        // Set form action URL (using Laravel route)
                       
                        
                        // Populate form fields
                        document.getElementById('editUserId').value = userId;
                        document.getElementById('editUserName').value = userName;
                        document.getElementById('editUserRole').value = userRole;
                        document.getElementById('editUserStatus').value = userStatus;
                        
                        // Reset password fields
                        updatePasswordCheckbox.checked = false;
                        passwordField.style.display = 'none';
                        document.getElementById('editUserPassword').value = '';
                        
                        // Show modal
                        editModal.classList.add('active');
                    });
                });

                // Close modal when close button or cancel is clicked
                closeButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        editModal.classList.remove('active');
                    });
                });

                // Close modal when clicking outside the modal content
                editModal.addEventListener('click', function(e) {
                    if (e.target === editModal) {
                        editModal.classList.remove('active');
                    }
                });

                // Close modal with Escape key
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && editModal.classList.contains('active')) {
                        editModal.classList.remove('active');
                    }
                });

                // Form submission
                editForm.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    
                    try {
                        const response = await fetch(editForm.action, {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: new FormData(editForm)
                        });

                        const data = await response.json();
                        
                        if (!response.ok) {
                            if (data.errors) {
                                // Handle validation errors
                                console.error('Validation errors:', data.errors);
                            }
                            throw new Error(data.message || 'Failed to update user');
                        }
                        
                        // Success case
                        editModal.classList.remove('active');
                        
                        // Refresh the page or update UI as needed
                        window.location.reload();
                        
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Error: ' + error.message);
                    }
                });
            });
        </script>
    
</body>
</html>