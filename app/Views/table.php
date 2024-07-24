<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seating Plan - MenuScanOrder</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #252F3F;
            color: #F7FAFC;
        }
        .navbar {
            background-color: transparent !important;

}

        .modal-content {
            background-color:  #252F3F;
            color: #F7FAFC;
        }
        .table-card {
        margin-top: 2rem;
    }
    .table-card .card {
    background-color: #323C4A; 
    border: none;
    width: 300px; 
    height: 300px; 
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 15px; 
    margin: 10px; 
}

.table-card img {
    width: 150px; 
    height: auto; 
    margin-bottom: 15px; 
}

.card-title {
    color: #4FD1C5; 
    font-size: 1.2rem; 
    margin-bottom: 5px; 
}

    .modal-header .close {
        color: #F7FAFC;
        text-shadow: none;
        opacity: 1;
    }
   
    .card-body {
        padding: 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .btn-info {
        background-color: #4FD1C5; 
        border: none;
    }
    .btn-info:hover {
        background-color: #3CDBD3; 
    }
    .card-text {
        color: #CBD5E0; 
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
                <a class="nav-link" href="/menuscanorder">Home</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="menu/Yourmenu">Your Menu</a>
            </li>
            <li class="nav-item active" >
                <a class="nav-link" href="table">Seating Plan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="kitchen/orders">Orders</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="Logout">Logout</a>
        </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="text-center mb-4">Seating Plan</h1>
    <div class="text-center">
        <button class="btn btn-primary" data-toggle="modal" data-target="#addTableModal">Add Table</button>
    </div>
    <!-- Add Table Modal -->
    <div class="modal fade" id="addTableModal" tabindex="-1" role="dialog" aria-labelledby="addTableModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTableModalLabel">Add Table</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addTableForm">
                        <div class="form-group">
                            <label for="tableNumber">Table Number</label>
                            <input type="text" class="form-control" id="tableNumber" name="table_number" required>
                        </div>
                        <div class="form-group">
                            <label for="userId">User ID</label>
                            <input type="text" class="form-control" id="userId" name="user_id" required>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Table</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Table cards will be appended here -->
    <div id="tableCards" class="row">
    <?php foreach ($tables as $table): ?>
    <div class="col-md-4 table-card">
        <div class="card">
            <img src="<?= $table['qr_code']; ?>" class="card-img-top" alt="QR Code">
            <div class="card-body">
                <h5 class="card-title">Table <?= $table['table_id']; ?></h5>
                <button onclick="printQR('<?= $table['qr_code']; ?>')" class="btn btn-info">Print QR</button>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('#addTableForm').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();

        var tableNumber = $('#tableNumber').val().trim();
        var userId = $('#userId').val().trim();

        if(tableNumber === '' || userId === '') {
            alert('Please fill in all fields.');
            return;
        }
       
        $.ajax({
            type: 'POST',
         
            url: "<?= site_url('add-table') ?>",

            data: formData,
            dataType: 'json',
            success: function(response) {

                if(response.status === 'success') {
                    alert('Table added successfully.');
                    var qrCodeURL = response.qr_code;
                    console.log(qrCodeURL);

                    var cardHTML = `<div class="col-md-4 table-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <img src="${qrCodeURL}" alt="QR Code" class="img-fluid">
                                                <h3 class="text-center mt-2">Table ${tableNumber}</h3>
                                                <button onclick="printQR('${qrCodeURL}')" class="btn btn-info">Print QR</button>

                                            </div>
                                        </div>
                                    </div>`;
                    $('#tableCards').append(cardHTML);
                    $('#addTableModal').modal('hide');
                    $('#addTableForm')[0].reset();
                } else {
                    alert('Failed to add table: ' + response.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('AJAX error: ' + textStatus + ': ' + errorThrown);
            }
        });
    });
});
function printQR(url) {
    var win = window.open(url);
    win.onload = function() {
        win.print();
    };
}

</script>

</body>
</html>