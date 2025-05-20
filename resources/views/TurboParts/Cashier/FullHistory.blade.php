<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
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

          /* Receipt Modal Styles */
        .receipt-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .receipt-modal-content {
            background-color: white;
            width: 400px;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .receipt-headers {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px dashed #ccc;
        }

        .receipt-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin: 0;
        }

        .receipt-number {
            font-size: 16px;
            color: #666;
        }

        .receipt-body {
            margin-bottom: 20px;
        }

        .receipt-body-label {
            font-weight: bold;
            margin-bottom: 10px;
            color: #444;
        }

        .receipt-products {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .receipt-products th {
            text-align: left;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
            font-weight: 600;
            color: white;
        }

        .receipt-products td {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .receipt-products td:first-child {
            padding-left: 20px;
        }

        .receipt-product-name {
            width: 60%;
            padding-left: 20px;
            text-align: left;
        }

        .receipt-product-qty {
            width: 15%;
            text-align: center;
        }

        .receipt-product-price {
            width: 25%;
            text-align: right;
        }

        .receipt-total {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            font-size: 18px;
            margin-top: 15px;
            padding-top: 10px;
            border-top: 1px dashed #ccc;
        }

        .receipt-footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #777;
            padding-top: 15px;
            border-top: 1px dashed #ccc;
        }

        .receipt-body-paymethod {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px dashed #ccc;
        }

        .receipt-paymethod {
            display: flex;
            justify-content: space-between;
        }

        .modal-close-button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 20px;
            width: 100%;
            transition: background-color 0.3s;
        }

        .modal-close-button:hover {
            background-color: #d32f2f;
        }

        .print-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 10px;
            width: 100%;
            transition: background-color 0.3s;
        }

        .print-button:hover {
            background-color: #388E3C;
        }

        .receipt-buttons {
            display: flex;
            gap: 10px;
        }

        .receipt-processed-by {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px dashed #ccc;
        }

        #receiptProcessedBy {
            font-weight: 500;
            margin-top: 5px;
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
                    <a href="{{ route('cashier.sales') }}" class="back-button">
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
                                    <th>Receipt No.</th>
                                    <th>Date</th>
                                    <th>Total Payment</th>
                                    <th>Payment Method</th>
                                    <th>Handled By</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->order_id }}</td>
                                    <td>{{ $order->order_id }}</td>
                                    <td>{{ $order->order_date->format('F j, Y') }}</td>
                                    <td>₱{{ number_format($order->total, 2) }}</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</td>
                                @if($order->user)
                                    <td>{{ $order->user->user_firstname }} {{ $order->user->user_lastname }}</td>
                                @else
                                    Unkown User
                                @endif
                                    <td>
                                        <div class="table-actions">
                                            <button class="view-receipt-btn" data-order-id="{{ $order->order_id }}">view</button>
                                            <button id="table-deleteaction-button" class="table-action-button">
                                                <svg class="delete-product-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


    <!--Receipt Modal--------------------------------------------------------------------------------->
       <div class="receipt-modal" id="receiptModal">
            <div class="receipt-modal-content">
                <div class="receipt-headers">
                    <h3 class="receipt-title">TurboParts</h3>
                    <div class="receipt-number">Receipt No: <span id="receiptNumber">0000</span></div>
                </div>

                <div class="receipt-date" id="receiptDate">Date: May 16, 2025 3:45 PM</div>

                <div class="receipt-body">
                    <div class="receipt-body-label">Products Purchased</div>
                    <table class="receipt-products">
                        <thead>
                            <tr>
                                <th class="receipt-product-name">Product</th>
                                <th class="receipt-product-qty">Qty</th>
                                <th class="receipt-product-price">Price</th>
                            </tr>
                        </thead>
                        <tbody id="receiptProductsList">
                            <!-- Products will be dynamically inserted here -->
                            <tr>
                                <td>Engine Oil 10W-40</td>
                                <td>2</td>
                                <td>₱1,200.00</td>
                            </tr>
                            <tr>
                                <td>Air Filter</td>
                                <td>1</td>
                                <td>₱850.00</td>
                            </tr>
                            <tr>
                                <td>Spark Plug</td>
                                <td>4</td>
                                <td>₱350.00</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="receipt-total">
                        <span>Total:</span>
                        <span id="receiptTotal">₱3,650.00</span>
                    </div>

                    <div class="receipt-body-paymethod">
                        <div class="receipt-body-label">Payment Method</div>
                        <div class="receipt-paymethod">
                            <span id="receiptPaymentMethod">Cash</span>
                            <span id="receiptAmountPaid">₱4,000.00</span>
                        </div>
                        <div class="receipt-change">
                            <span>Change:</span>
                            <span id="receiptChange">₱350.00</span>
                        </div>
                    </div>
                </div>

                <div class="receipt-processed-by">
                    <div class="receipt-body-label">Handled By</div>
                    <div id="receiptProcessedBy">Unknown</div>
                </div>

                <div class="receipt-footer">
                    <p>Thank you for your purchase!</p>
                    <p>Please come again</p>
                </div>

                <div class="receipt-buttons">
                    <button class="print-button" onclick="window.print()">Print Receipt</button>
                    <button class="modal-close-button">Close</button>
                </div>
            </div>
        </div>
       
    <!--Receipt Modal--------------------------------------------------------------------------------->

            </div>
        </div>
    </main>

    <script src="{{ asset('js/scriptForTime.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('receiptModal');
            const closeButton = document.querySelector('.modal-close-button');
            const viewButtons = document.querySelectorAll('.view-receipt-btn');

            // Open modal and load data
            viewButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const orderId = this.getAttribute('data-order-id');
                    
                    // Show loading state
                    modal.style.display = 'flex';
                    document.getElementById('receiptProductsList').innerHTML = `
                        <tr>
                            <td colspan="3" style="text-align: center; padding: 20px;">
                                <div class="spinner"></div>
                                Loading receipt data...
                            </td>
                        </tr>
                    `;

                    // Fetch order data
                    fetch(`/orders/${orderId}/receipt`)
                        .then(response => {
                            // First check if the response is JSON
                            const contentType = response.headers.get('content-type');
                            if (!contentType || !contentType.includes('application/json')) {
                                throw new Error('Server returned non-JSON response');
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Received data:', data); 
                            if (!data.success) {
                                throw new Error(data.message || 'Failed to load receipt data');
                            }
                            populateReceipt(data.order, data.items);
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            document.getElementById('receiptProductsList').innerHTML = `
                                <tr>
                                    <td colspan="3" style="text-align: center; padding: 20px; color: red;">
                                        Error: ${error.message}
                                    </td>
                                </tr>
                            `;
                        });
                });
            });

            // Close modal
            if (closeButton) {
                closeButton.addEventListener('click', function() {
                    modal.style.display = 'none';
                });
            }

            // Close when clicking outside
            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });

            // Populate receipt data
            function populateReceipt(order, items) {
                try {
                    // Order info
                    document.getElementById('receiptNumber').textContent = order.order_id;
                    document.getElementById('receiptDate').textContent = 
                        'Date: ' + new Date(order.order_date).toLocaleString();
                    
                    const totalAmount = parseFloat(order.total).toFixed(2);
                    document.getElementById('receiptTotal').textContent = '₱' + totalAmount;
                    
                    // Payment method (formatted nicely)
                    const paymentMethod = order.payment_method === 'credit_card' ? 'Credit Card' :
                                        order.payment_method === 'debit_card' ? 'Debit Card' :
                                        order.payment_method === 'cash' ? 'Cash' :
                                        'Other';
                    document.getElementById('receiptPaymentMethod').textContent = paymentMethod;
                    
                    // Cashier name (user who processed the order)
                    const cashierName = order.user 
                        ? `${order.user.user_firstname} ${order.user.user_lastname}`
                        : 'Unknown Cashier';
                    document.getElementById('receiptProcessedBy').textContent = cashierName;
                    
                    // Payment details - handle cash amount and change
                    const amountPaidEl = document.getElementById('receiptAmountPaid');
                    const changeEl = document.getElementById('receiptChange');
                    
                    if (order.payment_method === 'cash' && (order.cash_amount || order.cash_amount === 0)) {
                        const amountPaid = parseFloat(order.cash_amount).toFixed(2);
                        const change = (order.cash_amount - order.total).toFixed(2);
                        
                        amountPaidEl.textContent = '₱' + amountPaid;
                        changeEl.textContent = '₱' + change;
                        
                        // Store values in data attributes as backup
                        amountPaidEl.dataset.originalValue = amountPaid;
                        changeEl.dataset.originalValue = change;
                    } else {
                        // For non-cash payments
                        amountPaidEl.textContent = '₱' + totalAmount;
                        changeEl.textContent = '₱0.00';
                        
                        // Clear backup values
                        amountPaidEl.dataset.originalValue = totalAmount;
                        changeEl.dataset.originalValue = '0.00';
                    }
                    
                    // Clear and populate items
                    const productsList = document.getElementById('receiptProductsList');
                    productsList.innerHTML = '';
                    
                    items.forEach(item => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${item.product.product_name}</td>
                            <td>${item.quantity}</td>
                            <td>₱${parseFloat(item.unit_price).toFixed(2)}</td>
                        `;
                        productsList.appendChild(row);
                    });
                    
                    // Add a safety check that runs every second
                    if (!window.receiptValueChecker) {
                        window.receiptValueChecker = setInterval(() => {
                            const currentChange = document.getElementById('receiptChange').textContent;
                            const originalChange = document.getElementById('receiptChange').dataset.originalValue;
                            
                            const currentAmount = document.getElementById('receiptAmountPaid').textContent;
                            const originalAmount = document.getElementById('receiptAmountPaid').dataset.originalValue;
                            
                            if (currentChange !== '₱' + originalChange) {
                                document.getElementById('receiptChange').textContent = '₱' + originalChange;
                            }
                            
                            if (currentAmount !== '₱' + originalAmount) {
                                document.getElementById('receiptAmountPaid').textContent = '₱' + originalAmount;
                            }
                        }, 1000);
                    }
                } catch (error) {
                    console.error('Error populating receipt:', error);
                    alert('Error loading receipt details. Please check console for details.');
                }
            }

            // Update your close modal handler
            if (closeButton) {
                closeButton.addEventListener('click', function() {
                    modal.style.display = 'none';
                    if (window.receiptValueChecker) {
                        clearInterval(window.receiptValueChecker);
                        window.receiptValueChecker = null;
                    }
                });
            }

            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                    if (window.receiptValueChecker) {
                        clearInterval(window.receiptValueChecker);
                        window.receiptValueChecker = null;
                    }
                }
            });

            // Print function
            window.printReceipt = function() {
                const printContent = document.getElementById('receiptModal').innerHTML;
                const originalContent = document.body.innerHTML;
                
                document.body.innerHTML = printContent;
                window.print();
                document.body.innerHTML = originalContent;
                document.getElementById('receiptModal').style.display = 'flex';
            }
        });
        </script>

    </body>
</html>