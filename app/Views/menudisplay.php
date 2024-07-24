<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Display</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #252F3F;
            color: #F7FAFC;
            padding: 0;
            margin: 0;
        }
        .menu-section, .order-summary-container, .modal-content {
            background: #2C3E50;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        .menu-item, .modal-header, .modal-body {
            padding: 0.5rem 0;
            border-bottom: 1px solid #4FD1C5;
        }
        .menu-item:hover, .modal-header:hover {
            background-color: #34495E;
        }
        .menu-category-title, .modal-title {
            font-size: 2.5rem;
            color: #D53F8C;
        }
        .menu-item-name {
            font-weight: bold;
        }
        .order-summary-container, .modal-body {
            border: 1px solid #4FD1C5;
            align-items: center;
            color: #F7FAFC;
        }
        #special-instructions, .modal-body {
            background: #34495E;
            border: 1px solid #4FD1C5;
            color: white;
            width: 100%;
        }
        .remove-btn, .close, .refresh-btn {
            background-color: #D53F8C;
            color: #ECF0F1;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        #place-order-btn, .close {
            background-color: #16A085;
            color: #ECF0F1;
            border: none;
            width: 100%;
            margin-top: 1rem;
        }
        #place-order-btn:hover, .close:hover, .refresh-btn:hover {
            background-color: #1ABC9C;
        }
        th, td {
            color: #F7FAFC;
        }
        .table th, .table td {
            border-top: none;
        }
    </style>
</head>
<body>


    <div class="container py-4">
        <div class="menu-section">
            <h1 class="text-center mb-4">Menu for Table: <?= esc($tableId) ?></h1>
            <?php if (!empty($menu_items)): ?>
                <?php foreach ($menu_items as $category => $items): ?>
                    <h2 class="menu-category-title"><?= esc($category); ?></h2>
                    <?php foreach ($items as $item): ?>
                        <div class="menu-item d-flex justify-content-between align-items-center" onclick="addToOrder('<?= esc($item['item_name']); ?>', <?= esc($item['price']); ?>)">
                            <div>
                                <h3 class="menu-item-name"><?= esc($item['item_name']); ?></h3>
                                <p class="menu-item-description"><?= esc($item['description']); ?></p>
                            </div>
                            <span class="menu-item-price">$<?= number_format(esc($item['price']), 2); ?></span>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="order-summary-container">
            <h2>Your Order</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="order-items"></tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">Total</th>
                        <th id="total-price">$0.00</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
            <textarea id="special-instructions" placeholder="Special instructions..."></textarea>
            <button id="place-order-btn">Place Order</button>
        </div>
    </div>
    <!-- Order Status Modal -->
    <div class="modal fade" id="orderStatusModal" tabindex="-1" role="dialog" aria-labelledby="orderStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderStatusModalLabel">Your Order Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Table ID</th>
                                <th>Item Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="orderDetails"></tbody>
                    </table>
                    <button class="refresh-btn" onclick="fetchOrderStatus()">Refresh Status</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        let order = {};

        function addToOrder(itemName, price) {
            if (!order[itemName]) {
                order[itemName] = { qty: 1, price: price };
            } else {
                order[itemName].qty++;
            }
            updateOrderSummary();
        }

        function removeFromOrder(itemName) {
            if (order[itemName] && order[itemName].qty > 1) {
                order[itemName].qty--;
            } else {
                delete order[itemName];
            }
            updateOrderSummary();
        }

        function updateOrderSummary() {
            const orderContainer = document.getElementById('order-items');
            const totalPrice = document.getElementById('total-price');
            let total = 0;
            orderContainer.innerHTML = '';

            for (let item in order) {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item}</td>
                    <td>${order[item].qty}</td>
                    <td>$${(order[item].price * order[item].qty).toFixed(2)}</td>
                    <td><button onclick="removeFromOrder('${item}')">Remove</button></td>
                `;
                orderContainer.appendChild(row);
                total += order[item].price * order[item].qty;
            }

            totalPrice.textContent = `$${total.toFixed(2)}`;
        }

        document.getElementById('place-order-btn').addEventListener('click', function() {
    const orderDetails = {
        table_id: '<?= $tableId ?>',
        items: order,
        instructions: document.getElementById('special-instructions').value
    };

    const userId = '<?= $userId ?>'; 

    fetch('<?= site_url("order/place-order") ?>?user_id=' + userId, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(orderDetails)
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Order Placed');
            fetchOrderStatus(); 
        } else {
            alert('Failed to place order');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while placing the order.');
    });
});

function fetchOrderStatus() {
    const userId = '<?= $userId ?>'; 

    console.log("Fetching order status for table:", <?= $tableId ?>);
    fetch('<?= site_url("order/get-order-status") ?>?table_id=<?= $tableId ?>&user_id=' + userId, {
        method: 'GET'
    })
    .then(response => response.json())
    .then(data => {
        console.log("Received data:", data); // Debug log
        if (data.status === 'success' && data.orders.length > 0) {
            updateModalContent(data.orders);
        } else {
            updateNoOrdersFound(); 
        }
        $('#orderStatusModal').modal('show');
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while fetching order status.');
    });
}

function updateModalContent(orders) {
    console.log("Updating modal content with orders:", orders); 
    let contentHtml = orders.map(order => `
        <tr>
            <td>${order.order_id}</td>
            <td>${order.table_id}</td>
            <td>${order.item_name}</td>
            <td>${order.status}</td>
        </tr>
    `).join('');
    document.getElementById('orderDetails').innerHTML = contentHtml;
}

function updateNoOrdersFound() {
    console.log("No orders found, updating modal for ready state."); 
    document.getElementById('orderDetails').innerHTML = '<tr><td colspan="4" class="text-center">Your order is ready and on its way!</td></tr>';
}


    </script>
</body>
</html>
