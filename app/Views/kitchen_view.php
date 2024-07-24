<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kitchen Orders</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #252F3F;
            color: #F7FAFC;
            font-family: 'Nunito', sans-serif;
        }
        .navbar {
            background-color: #252F3F;
            border-bottom: 3px solid #4FD1C5;
        }
        .navbar-dark .navbar-brand, .navbar-dark .nav-link {
            color: #F7FAFC;
        }
        .navbar-dark .navbar-brand:hover, .nav-link:hover {
            color: #D53F8C;
        }
        .table-section {
            background: #323C4A;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-top: 1rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .table-responsive {
            width: 100%;
        }
        .status-button {
            border: none;
            padding: 5px 15px;
            border-radius: 0.25rem;
            cursor: pointer;
            font-size: 0.875rem;
            margin-left: 10px;
        }
        .preparing { background-color: #FFC107; }
        .ready { background-color: #28A745; }
        .bump-button { 
            background-color: #DC3545; 
            color: white; 
            padding: 6px 12px; 
            margin-top: 10px;
            border-radius: 0.25rem;
            align-self: flex-end;
            margin-bottom: 10px;
        }
        .status-button.active { background-color: #198754; } /* Bootstrap success color for active status */
    </style>
</head>
<body>
   
<nav class="navbar navbar-expand-lg navbar-dark ">
    <a class="navbar-brand" href="#">MenuScanOrder</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="/menuscanorder">Home</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="../menu/Yourmenu">Your Menu</a>
            </li>
            <li class="nav-item " >
                <a class="nav-link" href="../table">Seating Plan</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="../kitchen/orders">Orders</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="../Logout">Logout</a>
        </li>
        </ul>
    </div>
</nav>

    <div class="container mt-4">
        <?php foreach ($tables as $table_id => $orders): ?>
        <div class="table-section" id="table-section-<?= $table_id; ?>">
            <h4>Table <?= $table_id ?></h4>
            <div class="table-responsive">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                        <tr id="order-<?= $order['order_id']; ?>">
                            <td><?= $order['item_name']; ?></td>
                            <td><?= $order['qty']; ?></td>
                            <td>
                                <button class="status-button preparing" onclick="updateStatus(<?= $order['order_id']; ?>, 'Preparing')">Preparing</button>
                                <button class="status-button ready" onclick="updateStatus(<?= $order['order_id']; ?>, 'Ready')">Ready</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <button class="bump-button" onclick="bumpTable(<?= $table_id; ?>)">Bump Order</button>
        </div>
        <?php endforeach; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <script>
        function updateStatus(orderId, status) {
            var url = '<?= site_url('kitchen/update-status') ?>';
            $.ajax({
                url: url,
                type: 'POST',
                data: { 'order_id': orderId, 'status': status },
                success: function(response) {
                    if (response.success) {
                        const statusCell = $('#order-' + orderId + ' td:last');
                        statusCell.find('button').removeClass('active');
                        statusCell.find('.' + status.toLowerCase()).addClass('active');
                    } else {
                        alert('Failed to update status: ' + (response.message || 'Unknown error'));
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("AJAX error:", textStatus, errorThrown);
                    alert('Error updating status. Please check the console for more details.');
                }
            });
        }

        function bumpTable(tableId) {
            var url = '<?= site_url('kitchen/bump-table') ?>';
            $.ajax({
                url: url,
                type: 'POST',
                data: { 'table_id': tableId },
                success: function(response) {
                    if (response.success) {
                        $('#table-section-' + tableId).remove();
                        alert('Table ' + tableId + ' cleared');
                    } else {
                        alert('Failed to clear table: ' + (response.message || 'Unknown error'));
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("AJAX error:", textStatus, errorThrown);
                    alert('Error clearing table. Please check the console for more details.');
                }
            });
        }
    </script>
</body>
</html>
