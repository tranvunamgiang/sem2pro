<!DOCTYPE html>
<html lang="en">
<head>
<?php include("html/head.php"); ?>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - BookStore</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background: url('https://source.unsplash.com/1600x900/?books,library') no-repeat center center/cover;
        }
        .contact-form {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="contact-form">
                <h2 class="text-center mb-4">Contact Us</h2>
                <form id="contactForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Send Message</button>
                </form>
                <div id="responseMessage" class="mt-3 text-center"></div>
            </div>
        </div>
        <div class="col-md-4 d-flex align-items-center">
            <img src="https://images.pexels.com/photos/5591676/pexels-photo-5591676.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" class="img-fluid rounded shadow" alt="Person Holding a Book">
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#contactForm').submit(function(event) {
            event.preventDefault();
            $('#responseMessage').html('<div class="alert alert-success">Thank you for reaching out! We will get back to you soon.</div>');
            $('#contactForm')[0].reset();
        });
    });
</script>

</body>
<?php include("html/footer.php"); ?>
</html>

<script src="js/jquery-1.11.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
		crossorigin="anonymous"></script>
	<script src="js/plugins.js"></script>
	<script src="js/script.js"></script>
