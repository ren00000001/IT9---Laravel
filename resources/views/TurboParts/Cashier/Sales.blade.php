<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier-Sales</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

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
            background-color: var(--normalnavlink);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 10px;
        }

        .viewfullhistory-btn{
            display: flex;
            justify-content: flex-end;
            margin: 15px;
        }

        #viewfullhistory-btn{
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

        #viewfullhistory-btn:hover{
            background-color: var(--hoverbtn);
        }

        .cards{
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            padding: 0 1.5rem;
            margin-bottom: 1.5rem; 
        }

        .card{
            background-color: whitesmoke;
            border-radius: 8px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69. 0.1);
            overfloW: hidden;
            min-width: 250px;
            height: 120px;
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

        .table-container{
            display: flex;
            gap: 1.5rem;
            width: 100%;
            padding: 0 1.5rem;
            box-sizing: border-box;
        }

        .table-wrapper{
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 15px;
           
        }

        .main-table{
            flex: 3;
        }

        .sub-table{
            flex: 1;
        }

        .main-table table th:nth-child(1),
        .main-table table th:nth-child(2),
        .main-table table th:nth-child(4){
            width: 8%;
        }

        .main-table table th:nth-child(3),
        .main-table table th:nth-child(5),
        .main-table table th:nth-child(6){
            width: 12%;
        }

        .main-table table th:nth-child(7){
            width: 15%;
        }

        /* <a href="{{ route('cashier.viewhistory') }}" style="text-decoration: none;">
                            <button class="viewhistory-button">Full History<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ffffff"><path d="M647-440H160v-80h487L423-744l57-56 320 320-320 320-57-56 224-224Z"/></svg>
                            </button>
                        </a>*/
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
                
                <a class="home-link" href="{{ route('cashier.pos') }}">Point of Sale</a>
                <a href="{{ route('cashier.sales') }}">Sales</a>
                <a href="{{ route('cashier.inventory') }}">Inventory</a>
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

                    <div id="real-time-display"></div>
                    <span>Cashier:</span>
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
                    <input type="text" placeholder="Search Sale's...">
                </div>

                <div class="page-header">
                    <div class="page-title">Sales Overview</div>
                </div>

               

                    <div class="viewfullhistory-btn">
                        <a href="{{ route('cashier.viewhistory') }}" style="text-decoration: none;">
                            <button id="viewfullhistory-btn">Full History<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ffffff"><path d="M647-440H160v-80h487L423-744l57-56 320 320-320 320-57-56 224-224Z"/></svg>
                            </button>
                        </a>
                    </div>  
               

                <div class="cards">
                    <div class="card stat-card primary">
                        <div class="card-body">
                            <div class="stat-value">$1234</div>
                            <div class="stat-label">Total Sales</div>
                        </div>
                    </div>

                    <div class="card stat-card success">
                        <div class="card-body">
                            <div class="stat-value">34</div>
                            <div class="stat-label">New Orders/month</div>
                        </div>
                    </div>

                    <div class="card stat-card warning">
                        <div class="card-body">
                            <div class="stat-value">230</div>
                            <div class="stat-label">Total Orders</div>
                        </div>
                    </div>
                </div>
                
                <div class="table-container">

                    <div class="table-wrapper main-table">
                        <h2>Recent Purchases</h2>
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

                    <div class="table-wrapper sub-table">
                    <h2>Best Selling</h2>
                    <table>
                         <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Orders</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Helmet</td>
                                    <td>$299</td>
                                    <td>30</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    
    </main>

    <script src="{{ asset('js/scriptForTime.js') }}" ></script>
    <script src="{{ asset('js/Popup.js') }}"></script>
    
</body>
</html>