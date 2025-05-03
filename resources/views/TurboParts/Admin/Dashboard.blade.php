<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MotoPOS - Dashboard</title>
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
            gap: 25px;
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
            background-color: black;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 10px;
        }

        #current-date{
            font-size: 20px;
            font-weight: 500;
            color: var(--primary-color);
            margin-bottom: 5px;
            text-align: right;
        }

        .cards{
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            padding: 0 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .card{
            background: linear-gradient(135deg, #FFFFFF 0%, #F8F9FA 100%);
            border-radius: 8px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            overflow: hidden;
            min-width: 250px;
            height: 120px;
            transition:  all 0.3 ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
        }

        .card-body{
            padding: 1.25rem;
            height: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-card{
            width: 100%;
            display: flex;
            align-items: space-between;
            align-items: center;
        }

        .stat-value{
            font-size: 27px;
            font-weight: 700;
            color: var(--gunmetal);
            flex-shrink: 0;
            margin-right: 1rem
        }

        .stat-label{
            font-size: 20px;
            color: #6c757d;
            text-align: right;
            white-space: nowrap;
            font-weight: 600;
        }

        .primary { 
            background: linear-gradient(135deg, #f0f2f5 0%, #e4e7eb 100%);
            border-left: 4px solid var(--steel);
            box-shadow: inset 2px 0 3px rgba(142, 158, 171, 0.3);
        }

        .success { 
            background: linear-gradient(135deg, #f5f7f0 0%, #e8ebdf 100%);
            border-left: 4px solid var(--chrome);
            box-shadow: inset 2px 0 3px rgba(192, 192, 192, 0.4);
        }

        .warning { 
            background: linear-gradient(135deg, #f7f5f0 0%, #ebe7df 100%);
            border-left: 4px solid var(--brass);
            box-shadow: inset 2px 0 3px rgba(181, 166, 66, 0.3);
        }

        .danger { 
            background: linear-gradient(135deg, #f5f0f0 0%, #ebdfdf 100%);
            border-left: 4px solid var(--copper);
            box-shadow: inset 2px 0 3px rgba(184, 115, 51, 0.3);
        }

        .dashboard-table-container{
            background: linear-gradient(135deg, #FFFFFF 0%, #F8F9FA 100%);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            overflow: hidden;
        }

        .table-header{
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            border-bottom: 2px solid var(--light-gray);
            padding-bottom: 10px;
        }

        .table-title{
            font-size: 20px;
            font-weight: 600;
            color: var(--gunmetal);
            position: relative;
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
            <h1>TurboParts</h1>
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

                <div class="page-header">
                    <h1 class="page-title">Dashboard</h1>
                </div>

                <div class="cards">
                    <div class="card stat-card primary">
                        <div class="card-body">
                            <div class="stat-value">₱40,000</div>
                            <div class="stat-label">Total Revenue</div>
                        </div>
                    </div>

                    <div class="card stat-card success">
                        <div class="card-body">
                           <div class="stat-value">215</div>
                           <div class="stat-label">New Orders/week</div>
                        </div>
                    </div>

                    <div class="card stat-card warning">
                        <div class="card-body">
                            <div class="stat-value">1,234</div>
                            <div class="stat-label">Total Orders</div>
                        </div>
                    </div>

                    <div class="card stat-card danger">
                        <div class="card-body">
                            <div class="stat-value">12</div>
                            <div class="stat-label">Total Users</div>
                        </div>
                    </div>
                </div>

                <div class="dashboard-table-container">
                    <div class="table-header">
                        <div class="table-title">Recent Purchases</div>
                    </div>

                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Costumer ID</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Date Purchased</th>
                                    <th>Payement Method</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>rims</td>
                                    <td>2</td>
                                    <td>$1000</td>
                                    <td>3/20/25</td>
                                    <td>PayMaya</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </main>

    <!--<p>very important!!!! mao ni i prompt sa ai: now imagine how can i achieve that when i add a new product or update or delete a product in that html from another html that can only be operated by the admin and the html you created just now can be only seen by a customer</p>-->


    <script src="{{ asset('js/scriptForTime.js') }}"></script>
    <script src="{{ asset('js/supplierfortoggle.js') }}"></script>
    <script src="{{ asset('js/Popup.js') }}"></script>

</body>
</html>
