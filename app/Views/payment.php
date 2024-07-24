<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Plans - MenuScanOrder</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #252F3F;
            color: #F7FAFC;
            font-family: 'Nunito', sans-serif;
        }
        .container {
            padding-top: 50px;
        }
        .card {
            background-color: #323C4A;
            border: none;
            padding: 20px;
            margin-bottom: 20px;
        }
        .card-header {
            color: #4FD1C5;
            font-size: 1.5rem;
        }
        .card-body {
            color: #CBD5E0;
        }
        .btn-primary {
            background-color: #4FD1C5;
            border: none;
        }
        .btn-primary:hover {
            background-color: #3CDBD3;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
    <a class="navbar-brand" href="#">MenuScanOrder</a>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Basic Plan</div>
                <div class="card-body">
                    <p>50 requests/hour</p>
                    <p>Basic analytics</p>
                    <p>Email support</p>
                    <button class="btn btn-primary">Subscribe</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Pro Plan</div>
                <div class="card-body">
                    <p>150 requests/hour</p>
                    <p>Advanced analytics</p>
                    <p>Priority email support</p>
                    <button class="btn btn-primary">Subscribe</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Unlimited Plan</div>
                <div class="card-body">
                    <p>Unlimited requests</p>
                    <p>Full analytics suite</p>
                    <p>24/7 support</p>
                    <button class="btn btn-primary">Subscribe</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
