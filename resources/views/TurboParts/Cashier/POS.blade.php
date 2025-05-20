@php
    $posProducts = App\Models\Product::with('inventory')->get();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Receipt</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
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

        .container {
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

        .product-item button {
        flex-direction: column;
        padding: 10px;
        }
        
        .product-item img {
            border-radius: 4px;
            margin-bottom: 8px;
        }
        
        .product-price {
            font-weight: bold;
            color: var(--primary-color);
            margin-top: 5px;
        }
        
        .product-stock {
            font-size: 12px;
            color: #666;
            margin-top: 3px;
        }

        .no-image {
            height: 120px;
            width: 200px;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .pos-container {
            display: flex;
            gap: 20px;
            padding: 20px;
        }

        .product-item {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .product-item:hover {
            background-color: #f5f5f5;
        }

        .receipt-section {
            flex: 1;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
        }
        .receipt-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .remove-item {
            color: red;
            cursor: pointer;
        }
       .out-of-stock {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .out-of-stock button {
        pointer-events: none;
        background-color: #ccc !important;
    }

    #cashAmount {
        margin-top: 5px;
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
    }

    #changeDisplay {
        padding: 5px;
        background-color: #f8f9fa;
        border-radius: 4px;
        text-align: right;
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
                        @foreach($posProducts as $product)
                        <div class="product-item @if(($product->inventory->stocks_quantity ?? 0) <= 0) out-of-stock @endif">
                            <button onclick="addToReceipt('{{ $product->product_id }}', '{{ $product->product_name }}', '{{ $product->product_price }}','{{ $product->inventory->stocks_quantity ?? 0 }}')">
                                @if($product->product_image)
                                    <img src="{{ asset('storage/' . $product->product_image) }}" 
                                        alt="{{ $product->product_name }}" 
                                        style="width: 50px; height: 50px; object-fit: cover; margin-bottom: 5px;">
                                @else
                                    <div class="no-image">No Image</div>
                                @endif
                                {{ $product->product_name }}
                            </button>
                            <div class="product-price">₱{{ number_format($product->product_price, 2) }}</div>
                            <div class="product-stock">Stock: {{ $product->inventory->stocks_quantity ?? 0 }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- Order Summary - Now on Right -->
                <div class="receipt-section">
                    <div class="receipt-header">
                        <h3>Order Summary</h3>
                    </div>

                    <div class="receipt-items" id="receiptItems">
                        <!-- Items will appear here -->
                    </div>

                    <div class="receipt-total">
                        <div>Total:</div>
                        <div class="total-amount">₱<span id="totalAmount">0.00</span></div>
                    </div>

                    <div id="cashInputContainer" style="display: none; margin-top: 10px;">
                        <label for="cashAmount">Amount Received:</label>
                        <input type="number" id="cashAmount" class="payment-dropdown" placeholder="Enter cash amount" step="0.01" min="0">
                        <div id="changeDisplay" style="margin-top: 5px; font-weight: bold;"></div>
                    </div>

                    <select class="payment-dropdown" id="paymentMode">
                        <option value="credit_card">Credit Card</option>
                        <option value="debit_card">Debit Card</option>
                        <option value="cash">Cash</option>
                    </select>

                     <div class="receipt-actions">
                        <button class="btn btn-secondary" onclick="clearReceipt()">Clear</button>
                        <button class="btn btn-primary" onclick="processPayment()">Pay Now</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

<script src="{{ asset('js/scriptForTime.js')}}"></script>

<script>
    document.getElementById('paymentMode').addEventListener('change', function() {
        const cashInputContainer = document.getElementById('cashInputContainer');
        if (this.value === 'cash') {
            cashInputContainer.style.display = 'block';
        } else {
            cashInputContainer.style.display = 'none';
        }
    });

    document.getElementById('cashAmount').addEventListener('input', function() {
        const total = parseFloat(document.getElementById('totalAmount').textContent);
        const cashAmount = parseFloat(this.value) || 0;
        const change = cashAmount - total;
        
        const changeDisplay = document.getElementById('changeDisplay');
        if (change >= 0) {
            changeDisplay.textContent = `Change: ₱${change.toFixed(2)}`;
            changeDisplay.style.color = '#27ae60'; // Green color
        } else {
            changeDisplay.textContent = `Insufficient: ₱${Math.abs(change).toFixed(2)}`;
            changeDisplay.style.color = '#e74c3c'; // Red color
        }
    });

    let receiptItems = [];

    function addToReceipt(productId, name, price, stock) {
        if (stock <= 0) {
            alert('This product is out of stock')
            return;
        }

        const existingItem = receiptItems.find(item => item.productId === productId);

        if (existingItem) {
            if (existingItem.quantity >= stock) {
                alert(`Only ${stock} items available in stock!`);
                return;
            }
            existingItem.quantity++;
            existingItem.total = existingItem.quantity * price;
        }
        else {
            receiptItems.push({
                productId: productId,
                name: name,
                price: parseFloat(price),
                quantity: 1,
                total: parseFloat(price)
            });
        }

        updateReceiptDisplay();
    }

    function updateReceiptDisplay() {
        const container = document.getElementById("receiptItems");
        const totalElem = document.getElementById('totalAmount');
        
        container.innerHTML = "";

        receiptItems.forEach((item, index) => {
            const itemElement = document.createElement("div");
            itemElement.className = "receipt-item"; 
            itemElement.innerHTML = `
                                    <div>${item.name} &times; ${item.quantity}</div>
                                    <div>₱${item.total.toFixed(2)}</div>
                                    <button onclick="removeItem(${index})">&times;</button>
                                    `;
                container.appendChild(itemElement);
        });

        const total = receiptItems.reduce((sum, item) => sum + item.total, 0);
        totalElem.textContent = total.toFixed(2);
    }


    function removeItem(index){
        const item = receiptItems[index];
        item.quantity--;
        item.total = item.quantity * item.price;

        if(item.quantity <= 0){
            receiptItems.splice(index, 1);
        }

        updateReceiptDisplay();
    }

    function clearReceipt(){
        if (receiptItems.length > 0 && confirm('Clear the current order?')) {
            receiptItems = [];
            updateReceiptDisplay();
        }
    }

   async function processPayment() {
    const paymentMode = document.getElementById("paymentMode").value;
    const cashAmount = paymentMode === 'cash' ? parseFloat(document.getElementById('cashAmount').value) : null;

    if (receiptItems.length === 0) {
        alert("Please add items to the receipt first");
        return;
    }

    // Validate cash amount if payment is cash
    if (paymentMode === 'cash') {
        if (isNaN(cashAmount) || cashAmount <= 0) {
            alert("Please enter a valid cash amount");
            return;
        }
        
        const total = parseFloat(document.getElementById('totalAmount').textContent);
        if (cashAmount < total) {
            alert("Cash amount is less than the total amount");
            return;
        }
    }

    const payButton = document.querySelector('.btn-primary');
    payButton.disabled = true;
    payButton.textContent = 'Processing...';

    try {

         const requestData = {
            items: receiptItems,
            payment_method: paymentMode
        };

        // Only add cash_amount if payment is cash
        if (paymentMode === 'cash') {
            data.cash_amount = cashAmount;
        }

        const response = await fetch('/cashier/process-order', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify(requestData)
        });

        // Check if response is JSON
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            const text = await response.text();
            throw new Error(`Server returned: ${text.substring(0, 100)}...`);
        }

        const data = await response.json();

        if (!response.ok || !data.success) {
            throw new Error(data.message || 'Payment failed');
        }

        alert(`Order #${data.order_id} completed successfully!`);
        receiptItems = [];
        updateReceiptDisplay();

    } catch (error) {
        console.error('Error:', error);
        alert('Payment Error: ' + error.message);
    } finally {
        payButton.disabled = false;
        payButton.textContent = 'Pay Now';
    }
}

</script>

</body>
</html>