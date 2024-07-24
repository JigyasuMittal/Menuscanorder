<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - MenuScanOrder</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #252F3F;
            color: #F7FAFC;
            font-family: 'Nunito', sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            background-color: #323C4A;
            border: none;
            padding: 20px;
        }
        .form-control {
            background-color: #2D3748;
            color: #F7FAFC;
            border: none;
            margin-bottom: 10px;
        }
        .btn-primary {
            background-color: #4FD1C5;
            border: none;
        }
        .login-link {
            color: #CBD5E0;
            display: block;
            text-align: center;
            margin-top: 15px;
        }
        #password-strength {
            color: #CBD5E0;
            font-size: 0.875rem;
            margin-top: 5px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
    <a class="navbar-brand" href="#">MenuScanOrder</a>
</nav>
<div class="container">
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <h2 class="text-center">Signup</h2>
                <form action="<?= site_url('restaurant-owner/store') ?>" method="post">
                    <input type="text" class="form-control" name="user_id" placeholder="User Id" required>
                    <input type="text" class="form-control" name="name" placeholder="Full Name" required>
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                    <input type="tel" class="form-control" name="contact" placeholder="Contact" required>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <div id="password-strength"></div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Signup</button>
                </form>
                <a href="/menuscanorder/login" class="login-link">Already an user? Login</a>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#password').on('keyup', function() {
        var strength = 0;
        var value = $(this).val();
        if (value.length > 6) strength += 1;
        if (value.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1;
        if (value.match(/([a-zA-Z])/) && value.match(/([0-9])/)) strength += 1;
        if (value.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1;
        
        var status = '';
        switch(strength) {
            case 0: status = 'Very Weak'; break;
            case 1: status = 'Weak'; break;
            case 2: status = 'Good'; break;
            case 3: status = 'Strong'; break;
            case 4: status = 'Very Strong'; break;
        }
        $('#password-strength').text('Strength: ' + status);
    });
});
</script>
</body>
</html>
