<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Receipt</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
            --success-color: #27ae60;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Header styling with time display */
        .header {
            background-color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .header h2 {
            color: var(--primary-color);
            margin: 0;
            font-size: 1.5rem;
        }

        #current-date{
            font-size: 20px;
            font-weight: 500;
            color: var(--primary-color);
            margin-bottom: 5px;
            text-align: right;
        }

        #real-time-display {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--secondary-color);
            background-color: var(--light-color);
            padding: 8px 15px;
            border-radius: var(--border-radius);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border-left: 4px solid var(--secondary-color);
        }

        #real-time-display:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .pos-container {
            display: flex;
            min-height: 100vh;
            padding: 20px;
            gap: 20px;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Product Section (Now on Left) */
        .product-section {
            flex: 3;
            display: flex;
            flex-direction: column;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 20px;
        }

        .search-bar {
            text-align: center; /* Center the search bar content */
            margin: 20px 0 40px 0; /* Add spacing above and below the search bar */
        }

        .search-bar h3 {
            margin-bottom: 10px;
            color: var(--gunmetal); /* Add spacing below the "Search" heading */
            font-weight: 600;
        }

        .search-bar input {
            width: 500px;
            padding: 10px 15px 10px 40px;
            border: 1px solid var(--tableborder);
            border-radius: 30px;
            font-size: 14px;
            transition: all 0.3s ease;
            background-color: white;
            color: var(--oil-black);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .search-container{
            position: relative;
            display: inline-block;
        }

        .search-icon{
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 25px;
            height: 25px;
            fill: #777;
            pointer-events: none;
            padding-bottom: 10px;
        }

        /* Product List */
        .product-list {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            padding: 5px;
        }

        .product-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.2s;
        }

        .product-item:hover {
            transform: translateY(-3px);
        }

        .product-item button {
            width: 100%;
            padding: 15px 10px;
            font-size: 14px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            white-space: normal;
            word-wrap: break-word;
            text-align: center;
            transition: background-color 0.2s;
            box-shadow: var(--box-shadow);
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-item button:hover {
            background-color: var(--secondary-color);
        }

        .product-price {
            margin-top: 5px;
            font-weight: bold;
            color: var(--primary-color);
            font-size: 14px;
        }

        /* Receipt Section (Now on Right) */
        .receipt-section {
            flex: 1;
            background-color: white;
            padding: 20px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            display: flex;
            flex-direction: column;
            min-width: 300px;
        }

        .receipt-header {
            border-bottom: 2px solid var(--light-color);
            padding-bottom: 15px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .receipt-header h3 {
            color: var(--primary-color);
            font-size: 1.5rem;
        }

        .receipt-items {
            flex: 1;
            overflow-y: auto;
            margin-bottom: 15px;
        }

        .receipt-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px dashed #eee;
        }

        .receipt-item:last-child {
            border-bottom: none;
        }

        .receipt-item-info {
            flex: 1;
        }

        .receipt-item-name {
            font-weight: 500;
        }

        .receipt-item-price {
            color: var(--primary-color);
            font-weight: bold;
        }

        .receipt-item-remove {
            background-color: var(--accent-color);
            border: none;
            color: white;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 10px;
            transition: background-color 0.2s;
        }

        .receipt-item-remove:hover {
            background-color: #c0392b;
        }

        .receipt-total {
            margin-top: auto;
            padding-top: 15px;
            border-top: 2px solid var(--light-color);
            text-align: right;
            font-size: 1.2rem;
        }

        .total-amount {
            font-weight: bold;
            color: var(--success-color);
            font-size: 1.4rem;
        }

        .receipt-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.2s;
            flex: 1;
            text-align: center;
        }

        .btn-primary {
            background-color: var(--success-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: #219653;
        }

        .btn-secondary {
            background-color: var(--light-color);
            color: var(--dark-color);
        }

        .btn-secondary:hover {
            background-color: #d5dbdb;
        }

        .payment-dropdown {
            padding: 12px;
            border-radius: var(--border-radius);
            border: 1px solid #ddd;
            font-size: 14px;
            background-color: white;
            width: 100%;
            box-sizing: border-box;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }
            
            .pos-container {
                flex-direction: column; /* Changed to column to keep receipt on bottom */
                padding: 10px;
            }
            
            .product-list {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); /* 1-4 columns depending on screen width */
            }
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
        <div class="header">
            <h2>Point of Sale</h2>
            <div id="current-date"></div>
            <div id="real-time-display">00:00:00</div>
        </div>
        
        <div class="container">
            <div class="main-container pos-container">
                <!-- Product Section - Now on Left -->
                <div class="product-section">
                    <div class="search-bar">
                        <div class="search-container">
                            <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
                        </div>
                        <input type="text" placeholder="Enter Product's info to search">                    
                    </div>
                    
                    <div class="product-list" id="productList">
                        <!-- Example of a product button -->
                        <div class="product-item">
                            <button onclick="addToReceipt('Brake Pads', 120)">Brake Pads</button>
                            <div class="product-price">₱120</div>
                        </div>
                        <div class="product-item">
                            <button onclick="addToReceipt('Engine Oil', 250)">Engine Oil</button>
                            <div class="product-price">₱250</div>
                        </div>
                        <div class="product-item">
                            <button onclick="addToReceipt('Spark Plug', 75)">Spark Plug</button>
                            <div class="product-price">₱75</div>
                        </div>
                        <div class="product-item">
                            <button onclick="addToReceipt('Battery', 3200)">Battery</button>
                            <div class="product-price">₱3,200</div>
                        </div>
                        <div class="product-item">
                            <button onclick="addToReceipt('Headlight Bulb', 300)">Headlight Bulb</button>
                            <div class="product-price">₱300</div>
                        </div>
                        <div class="product-item">
                            <button onclick="addToReceipt('Windshield Wipers', 450)">Windshield Wipers</button>
                            <div class="product-price">₱450</div>
                        </div>
                        <div class="product-item">
                            <button onclick="addToReceipt('Radiator Coolant', 150)">Radiator Coolant</button>
                            <div class="product-price">₱150</div>
                        </div>
                        <div class="product-item">
                            <button onclick="addToReceipt('Fuel Filter', 200)">Fuel Filter</button>
                            <div class="product-price">₱200</div>
                        </div>
                        <div class="product-item">
                            <button onclick="addToReceipt('Transmission Fluid', 500)">Transmission Fluid</button>
                            <div class="product-price">₱500</div>
                        </div>
                        <div class="product-item">
                            <button onclick="addToReceipt('Air Filter', 180)">Air Filter</button>
                            <div class="product-price">₱180</div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary - Now on Right -->
                <div class="receipt-section">
                    <div class="receipt-header">
                        <h3>Order Summary</h3>
                        <div class="receipt-number">#0001</div>
                    </div>
                    
                    <div class="receipt-items" id="receiptItems">
                        <!-- Items will be added here dynamically -->
                    </div>
                    
                    <div class="receipt-total">
                        <div>Total:</div>
                        <div class="total-amount">₱<span id="totalAmount">0.00</span></div>
                    </div>

                    <!-- Payment Mode Dropdown -->
                    <div class="receipt-actions">
                        <select class="payment-dropdown" id="paymentMode">
                            <option value="cash">Cash</option>
                            <option value="credit-card">Credit Card</option>
                            <option value="debit-card">Debit Card</option>
                        </select>
                        <button class="btn btn-secondary" onclick="clearReceipt()">Clear</button>
                        <button class="btn btn-primary" onclick="processPayment()">Pay Now</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

<script src="{{ asset('js/scriptForTime.js')}}"></script>
<script>
    let receipt = [];
    let receiptNumber = 1;

    function addToReceipt(name, price) {
        // Check if item already exists in receipt
        const existingItem = receipt.find(item => item.name === name);
        if (existingItem) {
            existingItem.quantity += 1;
            existingItem.totalPrice = existingItem.quantity * existingItem.price;
        } else {
            receipt.push({ 
                name, 
                price,
                quantity: 1,
                totalPrice: price
            });
        }
        renderReceipt();
    }

    function removeFromReceipt(index) {
        receipt.splice(index, 1);
        renderReceipt();
    }

    function clearReceipt() {
        if (receipt.length > 0 && confirm("Are you sure you want to clear the current order?")) {
            receipt = [];
            renderReceipt();
        }
    }

    function processPayment() {
        const paymentMode = document.getElementById("paymentMode").value;
        if (receipt.length === 0) {
            alert("Please add items to the receipt first");
            return;
        }
        
        // In a real app, this would connect to a payment processor
        alert(`Payment processed for ₱${calculateTotal().toFixed(2)} via ${paymentMode}\nReceipt #${receiptNumber++}`);
        receipt = [];
        renderReceipt();
    }

    function calculateTotal() {
        return receipt.reduce((sum, item) => sum + item.totalPrice, 0);
    }

    function renderReceipt() {
        const container = document.getElementById("receiptItems");
        const totalElem = document.getElementById("totalAmount");
        container.innerHTML = "";
        
        if (receipt.length === 0) {
            container.innerHTML = '<div style="text-align: center; color: #777; padding: 20px;">No items added</div>';
            totalElem.innerText = "0.00";
            return;
        }

        receipt.forEach((item, i) => {
            const itemElement = document.createElement("div");
            itemElement.className = "receipt-item";
            itemElement.innerHTML = `
                <div class="receipt-item-info">
                    <div class="receipt-item-name">${item.name} × ${item.quantity}</div>
                </div>
                <div class="receipt-item-price">₱${item.totalPrice.toFixed(2)}</div>
                <button class="receipt-item-remove" onclick="removeFromReceipt(${i})">×</button>
            `;
            container.appendChild(itemElement);
        });

        totalElem.innerText = calculateTotal().toFixed(2);
    }

    // Product search filter
    document.getElementById("searchInput").addEventListener("input", function() {
        const filter = this.value.toLowerCase();
        const items = document.querySelectorAll(".product-item");
        
        items.forEach(item => {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(filter) ? "flex" : "none";
        });
    });

    // Initialize with empty receipt
    renderReceipt();
</script>

</body>
</html>