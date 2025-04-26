<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    
    <style>
        .container{
            display: flex;
            min-height: 100vh;
        }

        .main-container{
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

        .back-button-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .back-button{
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 15px;
            border-radius: 5px;
            background-color: var(--secondbtn);
            color: white;
            border: none;
            cursor: pointer;
            transition: 0.3s;
            gap: 8px;
            font-size: 14px;
            text-decoration: none;
        }

        .back-button:hover{
            background-color: var(--hoverbtn);
        }

        .back-button svg {
            width: 20px;
            height: 20px;
        }

        .fullhistory-table-container{
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 1 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .table-header{
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .table-header{
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .table-title{
            font-size: 18px;
            font-weight: 600;
        }

        .table-actions{
            display: flex;
            gap: 5px;
        }

        .table-action-button{
            background: none;
            border: none;
            color: #7f8c8d;
            cursor: pointer;
            font-size: 16px;
            gap: 6px;
        }

        .table-action-button,
        .delete-product-icon{
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .delete-product-icon{
            padding: 5px 5px;
            width: 25px;
            height: 25px;
        }

        .table-action-button:hover .delete-product-icon{
            fill: red;
        }

        .table-action-button:hover{
            transition: backgroun-color 0.3s ease;
        }

        #table-deleteaction-button:hover{
            background-color: rgba(255, 0, 0, 0.1);
        }

    </style>
</head>
<body>
    
    <header>
        <nav>
            <h1>TurboParts</h1>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="main-container">

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
                    <div class="search-container">
                        <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
                    </div>
                    <input type="text" placeholder="Enter Product's info to search">
                </div>

                <div class="back-button-container">
                    <a href="{{ route('admin.sales') }}" class="back-button">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
                        Back
                    </a>
                </div>
                      
                <div class="page-header">
                    <h1 class="page-title">Full History of Sales</h1>
                </div>

                <div class="fullhistory-table-container">
                    <div class="table-header">
                        <div class="table-title">History of Sales</div>
                    </div>
                    
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Account</th>
                                    <th>Date</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total Payment</th>
                                    <th>Payment Method</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td>3</td>
                                    <td>costumer1@email.com</td>
                                    <td>April 9, 2025</td>
                                    <td>Spark plug</td>
                                    <td>3</td>
                                    <td>$24</td>
                                    <td>Gcash</td>
                                    <td>
                                        <div class="table-actions">
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
    </main>

    <script src="{{ asset('js/scriptForTime.js') }}"></script>
</body>
</html>