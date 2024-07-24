<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MenuScanOrder</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="/path_to_your_custom_stylesheet.css" rel="stylesheet">
    <style>
        body {
            background-color: #252F3F;
            color: #F7FAFC;
        }
        .navbar {
            background-color: transparent;
        }
        .container {
            padding-top: 50px;
        }
        .form-group label {
            color: #F7FAFC;
        }
        .btn-primary {
            background-color: #4FD1C5;
            border: none;
        }
        .btn-primary:hover {
            background-color: #3CDBD3;
        }
        .alert-danger {
            background-color: #D53F8C;
            color: #F7FAFC;
        }
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
    </style>
        <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="475337302108-7rj5t5hmb39soun8n6ql674bifu6qajn.apps.googleusercontent.com">

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
    <a class="navbar-brand" href="#">MenuScanOrder</a>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <h2 class="text-center">Login</h2>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session()->getFlashdata('error'); ?>
                    </div>
                <?php endif; ?>
                <form action="<?= site_url('login/authenticate') ?>" method="post">
                    <input type="text" class="form-control" name="user_id" placeholder="User Id" required>
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
                <a href="/menuscanorder/signup" class="login-link">Don't have an account? Signup</a>

            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // JavaScript for handling session messages and redirecting
    <?php if(session()->getFlashdata('success')): ?>
        alert('<?= session()->getFlashdata('success'); ?>');
        window.location.href = '<?= site_url('/payment'); ?>';
    <?php endif; ?>

    function onSignIn(googleUser) {
            // Get the ID token from the Google user object
            var id_token = googleUser.getAuthResponse().id_token;

            // Send the ID token to your server with an AJAX call
            $.ajax({
                type: 'POST',
                url: '<?= site_url('login') ?>', // Adjust this URL to your route
                data: {idtoken: id_token},
                success: function(response) {
                    // Handle the response from your server here
                    console.log(response);
                    // Redirect the user after successful login
                    window.location.href = '<?= site_url('/payment'); ?>';
                },
                error: function(error) {
                    // Handle errors here
                    console.log(error);
                }
            });
        }
</script>

</body>
</html>
