<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to MenuScanOrder</title>
    <!-- Tailwind CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('images/bg.png');
            background-size: cover;
            background-position: center;
            font-family: 'Nunito', sans-serif;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            padding: 1rem 2rem;
            background-color: rgba(37, 47, 63, 0.9);
        }
        .logo {
            color: #FFF; /* Sets the logo text color to white */
            text-decoration: none; /* Removes underline from links */
            font-size: 1.5rem;
            font-weight: bold;
        }
        .nav-links a {
            color: #F7FAFC;
            text-decoration: none;
            margin-left: 1rem;
        }
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            .nav-links.show {
                display: block;
                position: absolute;
                width: 100%;
                top: 4rem;
                left: 0;
                padding: 1rem;
                background-color: rgba(37, 47, 63, 0.9);
            }
            .burger {
                display: block;
                cursor: pointer;
            }
            .burger-line {
                width: 25px;
                height: 2px;
                background-color: #F7FAFC;
                margin: 5px;
                transition: all 0.3s ease;
            }
            .burger.open .burger-line:nth-child(1) {
                transform: translateY(7px) rotate(45deg);
            }
            .burger.open .burger-line:nth-child(2) {
                opacity: 0;
            }
            .burger.open .burger-line:nth-child(3) {
                transform: translateY(-7px) rotate(-45deg);
            }
        }
        
    </style>
</head>
<body class="bg-modern-slate text-crisp-linen">
<nav class="navbar">
        <a href="/" class="logo">MenuScanOrder</a>
        <div class="burger">
            <div class="burger-line"></div>
            <div class="burger-line"></div>
            <div the="burger-line"></div>
        </div>
        <div class="nav-links">
            <a href="/menuscanorder" class="text-lg hover:text-golden-hour">Home</a>
            <a href="menu/Yourmenu" class="text-lg hover:text-golden-hour">Your Menu</a>
            <a href="table" class="text-lg hover:text-golden-hour">Seating Plan</a>
            <a href="kitchen/orders" class="text-lg hover:text-golden-hour">Orders</a>
            <a class="nav-link" href="Logout">Logout</a>
         
        </div>
    </nav>


    <header class="min-h-screen flex items-center justify-center text-center relative">
        <div class="absolute inset-0 bg-black opacity-25"></div>
        <div class="z-10">
            <h1 class="text-5xl font-bold text-white mb-4">Crafting Culinary Experiences</h1>
            <p class="text-xl text-gray-300">Empowering restaurants with seamless digital integration</p>
        </div>
    </header>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const burger = document.querySelector('.burger');
            const navLinks = document.querySelector('.nav-links');
            burger.addEventListener('click', () => {
                burger.classList.toggle('open');
                navLinks.classList.toggle('show');
            });
        });
    </script>
</body>
</html>
