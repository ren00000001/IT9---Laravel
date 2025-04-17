<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MotoPOS - Sales</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>


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
            background-color: var(--foricon);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 10px;
        }

        .card-container{
            display: flex;
            flex-direction: row;
            gap: 30px;
            margin-bottom: 20px;
        }

        .stats-card{
            display: flex;
            flex-direction: column;
            gap: 30px;
            width: 40%
        }

        .card{
            background-color: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            width: 100%;
            box-sizing: border-box;  
        }

        .card-content{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title{
            font-size: 16px;
            color: #6c757d;
            margin-bottom: 15px;
        }

        .card-value{
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .chart-products-card{
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            width: 58%;
        }

        .chart-title{
            font-size: 18px;
            margin-bottom: 15px;
        }

        .top-products .product-item{
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid lightgray;
        }

        .product-name{
            display: flex;
            align-items: center;
        }

        .product-color{
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-right: 8px;
        }

        .product-sales{
            font-weight: 500;
        }

        .chart{
            display: flex;
            gap: 30px;
            margin-bottom: 20px;
        }

        .chart-card{
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .chart-card:first-child{
            flex: 2;
        }

        .chart-card:last-child{
            flex: 1;
        }

        .chart-title{
            font-size: 18px;
            margin-bottom: 15px;
        }

        .recentsales-table-container{
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
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
        .delete.product-icon{
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
            transition: background-color 0.3s ease;
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
                <label for="" class="close-sidebar-button">
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

                <div class="page-header">
                    <h1 class="page-title">Sales</h1>
                </div>

                <div class="card-container">
                    <div class="stats-card">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-title">Total Revenue</div>
                                <div class="card-value">$243,598</div>
                            </div>
                        </div>
    
                        <div class="card">
                            <div class="card-content">
                                <div class="card-title">Total Orders</div>
                                <div class="card-value">1,345</div>
                            </div>
                        </div>
                    </div>

                    <div class="chart-products-card">
                        <div class="chart-title">Top 3 Products</div>

                        <div class="top-products">

                            <div class="product-item">
                                <div class="product-name">
                                    <div class="product color" style="background-color: #4361ee;"></div>
                                    <span>Product 1</span>
                                </div>
                                <div class="product-sales">Orders:</div>
                                <div class="product-sales">123</div>
                                <div class="product-sales">Sales:</div>
                                <div class="product-sales">$10,000</div>
                            </div>

                            <div class="product-item">
                                <div class="product-name">
                                    <div class="product color" style="background-color: #4361ee;"></div>
                                    <span>Product 2</span>
                                </div>
                                <div class="product-sales">Orders:</div>
                                <div class="product-sales">123</div>
                                <div class="product-sales">Sales:</div>
                                <div class="product-sales">$10,000</div>
                            </div>

                            <div class="product-item">
                                <div class="product-name">
                                    <div class="product color" style="background-color: #4361ee;"></div>
                                    <span>Product 3</span>
                                </div>
                                <div class="product-sales">Orders:</div>
                                <div class="product-sales">123</div>
                                <div class="product-sales">Sales:</div>
                                <div class="product-sales">$10,000</div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="chart">
                    <div class="chart-card">
                        <div class="chart-title">Sales Overview</div>
                        <canvas id="sales-chart"></canvas>
                    </div>
    
                    <div class="chart-card">
                        <div class="chart-title">Product Orders</div>
                        <canvas id="orders-chart"></canvas>
                    </div>
                </div>

                <div class="recentsales-table-container">
                    <div class="table-header">
                        <div class="table-title">Recent Purchase</div>
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
        </div>
    </main>

    <script src="{{ asset('js/scriptForTime.js') }}"></script>
    <script>

        const salesData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                labels: "Revenue",
                data: [18500, 21200, 19800, 24600, 23100, 25400, 28900, 26700, 29100, 32400, 30600, 34500],
                borderColor: '#4361ee',
                backgroundColor: 'rgba(67, 97, 238, 0.1)',
                fill: true,
                tension: 0.4
            }]
        };

        const salesChart = new Chart(document.getElementById('sales-chart'), {
            type: 'line',
            data: salesData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value){
                                return '$' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        const productsData = {
            labels: ['Premium Headphones', 'Wireless Keyboard', 'Smart Watch', 'Bluetooth Speaker', 'Wireless Mouse'],
            datasets: [{
                data: [420, 350, 280, 210, 180],
                backgroundColor: ['#4361ee', '#3f37c9', '#4895ef', '#4cc9f0', '#f72585'],
                borderWidth: 0
            }]
        };

        const ordersChart = new Chart(document.getElementById('orders-chart'), {
            type: 'doughnut',
            data: productsData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 12,
                            padding: 15
                        }
                    }
                },
                cutout: '65%'
            }
        });

    </script>
    
</body>
</html>