<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <!--Title-->
    <title>Mophy - PHP Payment Admin Dashboard Bootstrap Template | DexignZone</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="keywords"
        content="PHP payment admin template, Bootstrap admin dashboard, payment system template, payment management UI, responsive admin template, PHP SaaS Admin Dashboard, Saas Dashboard Template, DexignZone, SSL Encryption, Mobile Optimization, e-commerce, UX/UI, Bootstrap 5, Admin Panel, HTML5, CSS3, Responsive Web App, User Interface Design, mobile commerce, dark layout, PWA (Progressive Web App), App Development, Product Showcase, Customizable, Modern Design, UI/UX Design">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <meta name="description"
        content="Discover Mophy, an advanced PHP payment admin dashboard crafted with Bootstrap for seamless payment management. This responsive and feature-rich admin panel simplifies payment processing, offering intuitive controls and insightful analytics. Empower your business with Mophy comprehensive tools and responsive design">
    <meta name="og:title" content="Mophy - PHP Payment Admin Dashboard Bootstrap Template | DexignZone">
    <meta name="og:description"
        content="Discover Mophy, an advanced PHP payment admin dashboard crafted with Bootstrap for seamless payment management. This responsive and feature-rich admin panel simplifies payment processing, offering intuitive controls and insightful analytics. Empower your business with Mophy comprehensive tools and responsive design">
    <meta name="og:image" content="https://mophy.dexignzone.com/php/social-image.png">
    <meta name="format-detection" content="telephone=no">
    <meta name="twitter:title" content="Mophy - PHP Payment Admin Dashboard Bootstrap Template | DexignZone">
    <meta name="twitter:description"
        content="Discover Mophy, an advanced PHP payment admin dashboard crafted with Bootstrap for seamless payment management. This responsive and feature-rich admin panel simplifies payment processing, offering intuitive controls and insightful analytics. Empower your business with Mophy comprehensive tools and responsive design">
    <meta name="twitter:image" content="https://mophy.dexignzone.com/php/social-image.png">
    <meta name="twitter:card" content="summary_large_image">

    <!-- MOBILE SPECIFIC -->


    <!-- Favicon icon -->
    <link rel="shortcut icon" type="image/png" href="assets/images/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet" type="text/css" />
    <link href="assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />


</head>

<body class="h-100">
    <div class="login-account">
        <div class="row h-100">
            <div class="col-lg-6 align-self-start">
                <div class="account-info-area" style="background-image: url(images/rainbow.gif)">
                    <div class="login-content">
                        <p class="sub-title">Log in to your admin dashboard with your credentials</p>
                        <h1 class="title">The Evolution of <span>Mophy</span></h1>
                        <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-7 col-sm-12 mx-auto align-self-center">
                <div class="login-form">
                    <div class="login-head">
                        <h3 class="title">Welcome Back</h3>
                        <p>Login page allows users to enter login credentials for authentication and access to secure
                            content.</p>
                    </div>
                    <h6 class="login-title"><span>Login</span></h6>
                    
                    <form id="loginForm">
                        <div class="mb-4">
                            <label class="form-label required">บัญชีผู้ใช้</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="mb-4 position-relative">
                            <label class="mb-1 form-label required">รหัสผ่าน</label>
                            <input type="password" id="password" name="password" class="form-control">
                            <span class="show-pass eye">

                                <i class="fa fa-eye-slash"></i>
                                <i class="fa fa-eye"></i>

                            </span>
                        </div>
                        <div id="errorMessage" class="error-message"></div>
                        
                        <div class="text-center mb-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign Me In</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->



    <script>
        var enableSupportButton = '1'
    </script>

    <script src="assets/vendor/global/global.min.js" type="text/javascript"></script>
    <script src="assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="assets/js/custom.js" type="text/javascript"></script>
    <script src="assets/js/deznav-init.js" type="text/javascript"></script>
    <script src="assets/js/demo.js" type="text/javascript"></script>
    <script src="assets/js/styleSwitcher.js" type="text/javascript"></script>
    <script>
        document.getElementById("loginForm").addEventListener("submit", function(event) {
            event.preventDefault();

            // Clear previous error messages
            document.getElementById("errorMessage").innerText = '';

            // Get values from form
            const username = document.getElementById("username").value;
            const password = document.getElementById("password").value;

            // Prepare the request data
            const data = { username: username, password: password };

            // Send the data to the PHP API
            fetch('https://api-eduservice.yru.ac.th/auth.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Login successful!');
                    // You can redirect the user to a dashboard or another page
                    window.location.href = 'dashboard.php';
                } else {
                    // Display error message
                    document.getElementById("errorMessage").innerText = data.message;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById("errorMessage").innerText = 'An error occurred. Please try again.';
            });
        });
    </script>

</body>

</html>