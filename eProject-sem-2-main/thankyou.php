<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You Page</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .thank-you-page {
            background: linear-gradient(135deg, #ff6b6b, #4ecdc4);
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 2rem;
        }
        
        .thank-you-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .thank-you-card:hover {
            transform: translateY(-5px);
        }

        .decorative-img {
            height: 250px;
            object-fit: cover;
            border-bottom: 3px solid #fff;
        }

        .thank-you-content {
            padding: 2.5rem;
            text-align: center;
        }

        .heart-icon {
            color: #ff6b6b;
            font-size: 2.5rem;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>
    <div class="thank-you-page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="thank-you-card">
                        
                        
                        <div class="thank-you-content">
                            <i class="fas fa-heart heart-icon mb-4"></i>
                            <h1 class="mb-4 text-primary">Thank You!</h1>
                            
                            <p class="lead mb-4">
                                Your kindness and support mean the world to us. We're truly grateful for 
                                the time, effort, and trust you've shared. This journey wouldn't be 
                                the same without amazing people like you!
                            </p>
                            
                            <div class="social-links mt-5">
                                <h5 class="mb-3">Stay Connected</h5>
                                <a href="#" class="btn btn-outline-primary mx-2">
                                    <i class="fab fa-facebook"></i>
                                </a>
                                <a href="#" class="btn btn-outline-info mx-2">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-outline-danger mx-2">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>