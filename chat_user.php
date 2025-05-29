<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - Toko Online</title>
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            padding: 15px;
            color: white;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }
        .navbar {
            background: #fff;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .contact-section {
            background: white;
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }
        .contact-info {
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        .social-icons a {
            margin-right: 10px;
            font-size: 24px;
            color: #ff416c;
            transition: 0.3s;
        }
        .social-icons a:hover {
            color: #ff4b2b;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
    </style>
</head>
<body>
    <br>
    <br>
    <br>
    <main class="container mt-5">
        <section class="contact-section">
            <h2 class="text-center" style="font-weight: bold;">KIRIM PESAN</h2>
            <div class="row mt-4">
                <div class="col-md-12">
                    <br>
                    <form id="contact-form" method="POST">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="user_name" required>
                        </div>
                        <br>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="user_email" required>
                        </div>
                        <br>
                        <div class="mb-3">
                            <label for="pesan" class="form-label">Pesan</label>
                            <textarea class="form-control" id="pesan" name="message" rows="4" required></textarea>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-success w-100">Kirim</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Ambil data dari form
            $userName = $_POST['user_name'];
            $userEmail = $_POST['user_email'];
            $userMessage = $_POST['message'];

            // Kirim email menggunakan emailjs
            echo '<script type="text/javascript">
                emailjs.init("Irhq9Na5FJIiJhC_V");
                emailjs.send("service_x9wk9kx", "template_a6rpb8m", {
                    to_email: "muaffaaditya88@gmail.com",
                    from_email: "' . $userEmail . '",
                    subject: "Pesan dari ' . $userName . '",
                    message: "' . $userMessage . '",
                    reply_to: "' . $userEmail . '"
                }).then(function(response) {
                    alert("Pesan berhasil dikirim!");
                    document.getElementById("contact-form").reset();
                }).catch(function(error) {
                    console.error("Error mengirim email:", error);
                    alert("Gagal mengirim pesan. Silakan coba lagi!");
                });
            </script>';
        }
    ?>
    
</body>
</html>
<br>
<br>
<br>
<br>
<?php 
include 'footer.php';
?>
