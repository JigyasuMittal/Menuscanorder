<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Menu - MenuScanOrder</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            background-color: #252F3F;
            color: #F7FAFC;
            font-family: 'Nunito', sans-serif;
        }
        .navbar-dark .navbar-brand, .navbar-dark .nav-link {
            color: #F7FAFC;
            transition: color 0.3s ease;
        }
        .nav-link:hover, .navbar-dark .navbar-brand:hover {
            color: #D53F8C;
        }
        .navbar {
            background-color: transparent !important; /* This will enforce transparency */

}
        .menu-section .category-title {
            font-size: 1.5rem;
            color: #F7FAFC;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }
        .menu-item {
            padding-bottom: 1rem;
            margin-bottom: 1rem;
            border-bottom: 1px solid #4FD1C5;
        }
        .menu-item-name {
            font-size: 1.25rem;
        }
        .menu-item-description {
            font-size: 0.875rem;
            color: #CBD5E0;
        }
        .menu-item-price {
            font-weight: bold;
        }
        .btn-edit-menu {
            background-color: #D53F8C;
            color: #FFFFFF;
        }
        .btn-edit-menu:hover {
            background-color: #C5308D;
        }
        .modal-content {
            background-color: #2D3748;
            color: #F7FAFC;
        }
        .modal-header .close {
            color: #F7FAFC;
        }
        .modal-header {
            border-bottom: 1px solid #4A5568;
        }
        .modal-footer {
            border-top: 1px solid #4A5568;
        }
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
                <a class="nav-link" href="../">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="Yourmenu">Your Menu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../table">Seating Plan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../kitchen/orders">Orders</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="../Logout">Logout</a>
        </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="text-center mb-4">Your Menu</h1>
    <!-- Menu items structure -->
  
    <?php if (isset($menu_items) && is_array($menu_items)): ?>
        <?php foreach ($menu_items as $category => $items): ?>
            <h2 class="menu-category-title"><?= esc($category); ?></h2>
            <?php foreach ($items as $item): ?>
                <div class="menu-item d-flex justify-content-between align-items-center">
                    <div style="flex-grow: 1;">
                        <h3 class="menu-item-name"><?= esc($item['item_name']); ?></h3>
                        <p class="menu-item-description"><?= esc($item['description'] ?? ''); ?></p>
                    </div>
                    <div class="menu-item-actions" style="white-space: nowrap;">
                        <span class="menu-item-price" style="margin-right: 20px;">$<?= esc($item['price']); ?></span>
                        <button class="btn btn-danger btn-sm mx-2 delete-item" data-id="<?= esc($item['item_id']); ?>">Delete</button>
                        <button class="btn btn-primary btn-sm modify-item" data-toggle="modal" data-target="#modifyItemModal" data-id="<?= esc($item['item_id']); ?>">Modify</button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endforeach; ?>
    <?php endif; ?>

    <div class="text-center mt-4">
        <button class="btn btn-edit-menu" data-toggle="modal" data-target="#addItemModal">Add Items</button>
    </div>
</div>

<!-- Modal for Adding Menu Items -->
<div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addItemModalLabel">Add New Menu Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addItemForm">
                    <div class="form-group">
                        <label for="itemId">Item ID</label>
                        <input type="text" class="form-control" id="itemId" name="item_id" required>
                    </div>
                    <div class="form-group">
                        <label for="userId">User ID</label>
                        <input type="text" class="form-control" id="userId" name="user_id" required>
                    </div>
                    <div class="form-group">
                        <label for="itemName">Name</label>
                        <input type="text" class="form-control" id="itemName" name="item_name" required>
                    </div>
                    <div class="form-group">
                        <label for="itemPrice">Price</label>
                        <input type="number" step="0.01" class="form-control" id="itemPrice" name="price" required>
                    </div>
                    <div class="form-group">
                        <label for="itemDescription">Description</label>
                        <textarea class="form-control" id="itemDescription" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="itemCategory">Category</label>
                        <input type="text" class="form-control" id="itemCategory" name="category" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" the "btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" the "btn btn-primary" form="addItemForm">Add Item</button>
            </div>
        </div>
    </div>
</div>
<!-- Modify Item Modal -->
<div class="modal fade" id="modifyItemModal" tabindex="-1" role="dialog" aria-labelledby="modifyItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modifyItemModalLabel">Modify Menu Item</h5>
                <button type="button" the close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="modifyItemForm">
                    <div class="form-group">
                        <label for="modifyItemName">Name</label>
                        <input type="text" class="form-control" id="modifyItemName" name="item_name" required>
                    </div>
                    <div class="form-group">
                        <label for="modifyItemPrice">Price</label>
                        <input type="number" step="0.01" class="form-control" id="modifyItemPrice" name="price" required>
                    </div>
                    <div class="form-group">
                        <label for="modifyItemDescription">Description</label>
                        <textarea class="form-control" id="modifyItemDescription" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="modifyItemCategory">Category</label>
                        <input type="text" class="form-control" id="modifyItemCategory" name="category" required>
                    </div>
                    <input type="hidden" id="modifyItemId" name="item_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" the "btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" the "btn btn-primary" form="modifyItemForm">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- AJAX Script for Adding Items -->
<script>
    $(document).ready(function() {
        $('#addItemForm').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "<?= site_url('menu/add-item') ?>",
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if(response.status === 'success') {
                        alert('Item added successfully!');
                        $('#addItemModal').modal('hide');
                        location.reload(); // Reload the page to update the menu
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function() {
                    alert('Failed to add the item. Please try again.');
                }
            });
        });

        $('.delete-item').on('click', function() {
            let itemId = $(this).data('id');
            if (confirm('Are you sure you want to delete this item?')) {
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('menu/delete-item') ?>',
                    data: { item_id: itemId },
                    success: function(response) {
                        if (response.status === 'success') {
                            alert('Item deleted successfully!');
                            location.reload(); // Refresh the page
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function() {
                        alert('Error deleting item.');
                    }
                });
            }
        });

        $('.modify-item').on('click', function() {
            var itemId = $(this).data('id');
            $.ajax({
                type: 'GET',
                url: '<?= site_url('menu/get-item-details') ?>',
                data: { item_id: itemId },
                success: function(response) {
                    if(response.status === 'success') {
                        $('#modifyItemName').val(response.data.item_name);
                        $('#modifyItemPrice').val(response.data.price);
                        $('#modifyItemDescription').val(response.data.description);
                        $('#modifyItemCategory').val(response.data.category);
                        $('#modifyItemId').val(itemId);
                        $('#modifyItemModal').modal('show');
                    } else {
                        alert('Error fetching item details: ' + response.message);
                    }
                },
                error: function() {
                    alert('Failed to fetch item details.');
                }
            });
        });

        $('#modifyItemForm').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: '<?= site_url('menu/modify-item') ?>',
                data: formData,
                success: function(response) {
                    if(response.status === 'success') {
                        alert('Item modified successfully!');
                        $('#modifyItemModal').modal('hide');
                        location.reload(); // Reload the page to see changes
                    } else {
                        alert('Error modifying item: ' + response.message);
                    }
                },
                error: function() {
                    alert('Failed to modify item.');
                }
            });
        });
    });
</script>

</body>
</html>
