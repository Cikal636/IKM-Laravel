<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farm Chicken - Peternakan Ayam</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        html{
            scroll-behavior:smooth;
        }

        @keyframes fadeUp {
            from{
                opacity:0;
                transform:translateY(40px);
            }
            to{
                opacity:1;
                transform:translateY(0);
            }
        }

        @keyframes zoomIn {
            from{
                opacity:0;
                transform:scale(0.9);
            }
            to{
                opacity:1;
                transform:scale(1);
            }
        }

        @keyframes float {
            0%{ transform:translateY(0px); }
            50%{ transform:translateY(-12px); }
            100%{ transform:translateY(0px); }
        }

        @keyframes slideRight {
            from{
                opacity:0;
                transform:translateX(-60px);
            }
            to{
                opacity:1;
                transform:translateX(0);
            }
        }

        @keyframes slideLeft {
            from{
                opacity:0;
                transform:translateX(60px);
            }
            to{
                opacity:1;
                transform:translateX(0);
            }
        }
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins', sans-serif;
        }

        body{
            animation:fadeUp 1s ease;
            background:#f8f8f8;
            color:#333;
            overflow-x:hidden;
        }

        header{
            width:100%;
            position:fixed;
            top:0;
            left:0;
            z-index:1000;
            background:rgba(255, 255, 255, 0.95);
            box-shadow:0 2px 10px rgba(0,0,0,0.08);
        }

        .navbar{
            width:90%;
            margin:auto;
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:18px 0;
        }

        .logo{
            display:flex;
            align-items:center;
            gap:10px;
            font-size:24px;
            font-weight:700;
            color:#c96b00;
        }

        .logo img{
            animation:float 3s ease-in-out infinite;
            width:45px;
            height:45px;
        }

        .nav-menu{
            display:flex;
            gap:30px;
            align-items:center;
        }

        .nav-menu a{
            text-decoration:none;
            color:#333;
            font-weight:500;
            transition:0.3s;
        }

        .nav-menu a:hover{
            color:#c96b00;
        }

        .btn-login{
            background:#c96b00;
            color:white !important;
            padding:10px 24px;
            border-radius:30px;
            transition:0.3s;
        }

        .btn-login:hover{
            background:#a75500;
        }

        .hero{
            min-height:100vh;
            background:
            linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.45)),
            url('https://images.unsplash.com/photo-1548550023-2bdb3c5beed7?q=80&w=1600&auto=format&fit=crop');
            background-size:cover;
            background-position:center;
            display:flex;
            align-items:center;
            justify-content:center;
            text-align:center;
            padding:120px 20px 50px;
        }

        .hero-content{
            animation:zoomIn 1.2s ease;
            max-width:850px;
            color:white;
        }

        .hero-content h1{
            font-size:64px;
            line-height:1.2;
            margin-bottom:20px;
            font-weight:700;
        }

        .hero-content p{
            font-size:18px;
            line-height:1.8;
            margin-bottom:35px;
            color:#f1f1f1;
        }

        .hero-buttons{
            display:flex;
            justify-content:center;
            gap:20px;
            flex-wrap:wrap;
        }

        .btn{
            text-decoration:none;
            padding:14px 30px;
            border-radius:40px;
            font-weight:600;
            transition:0.3s;
        }

        .btn-primary{
            background:#c96b00;
            color:white;
        }

        .btn-primary:hover{
            background:#a75500;
            transform:translateY(-2px);
        }

        .btn-secondary{
            background:white;
            color:#333;
        }

        .btn-secondary:hover{
            background:#ececec;
            transform:translateY(-2px);
        }

        .section{
            padding:90px 8%;
        }

        .section-title{
            text-align:center;
            margin-bottom:60px;
        }

        .section-title h2{
            font-size:40px;
            color:#222;
            margin-bottom:10px;
        }

        .section-title p{
            color:#777;
            font-size:16px;
        }

        .products{
            display:grid;
            grid-template-columns:repeat(auto-fit, minmax(250px, 1fr));
            gap:30px;
        }

        .product-card{
            animation:fadeUp 1s ease;
            position:relative;
            background:white;
            border-radius:22px;
            overflow:hidden;
            box-shadow:0 8px 25px rgba(0,0,0,0.08);
            transition:0.3s;
        }

        .product-card:hover{
            transform:translateY(-8px);
        }

        .product-card img{
            transition:0.5s;
            width:100%;
            height:240px;
            object-fit:cover;
        }

        .product-content{
            padding:25px;
        }

        .product-content h3{
            margin-bottom:10px;
            color:#222;
        }

        .product-content p{
            color:#666;
            line-height:1.7;
            font-size:14px;
        }

        .about{
            background:#fff7ef;
            border-radius:30px;
            display:grid;
            grid-template-columns:repeat(auto-fit, minmax(320px,1fr));
            gap:40px;
            align-items:center;
            padding:50px;
        }

        .about img{
            animation:slideRight 1.2s ease;
            width:100%;
            border-radius:25px;
            box-shadow:0 10px 30px rgba(0,0,0,0.1);
        }

        .about-text{
            animation:slideLeft 1.2s ease;
        }

        .about-text h2{
            font-size:42px;
            margin-bottom:20px;
            color:#222;
        }

        .about-text p{
            color:#666;
            line-height:1.9;
            margin-bottom:15px;
        }

        .footer{
            background:#1f1f1f;
            color:white;
            text-align:center;
            padding:30px 20px;
            margin-top:60px;
        }

        .footer h3{
            margin-bottom:10px;
            color:#ffb04c;
        }

        @media(max-width:768px){
            .hero-content h1{
                font-size:42px;
            }

            .navbar{
                flex-direction:column;
                gap:15px;
            }

            .nav-menu{
                gap:15px;
                flex-wrap:wrap;
                justify-content:center;
            }

            .about{
                padding:30px;
            }

            .about-text h2{
                font-size:32px;
            }
        }
    
        .product-card:hover{
            box-shadow:0 18px 35px rgba(201,107,0,0.25);
        }

        .product-card:hover img{
            transform:scale(1.08);
        }

        .product-card::before{
            content:'';
            position:absolute;
            top:0;
            left:-100%;
            width:100%;
            height:100%;
            background:linear-gradient(120deg, transparent, rgba(255,255,255,0.35), transparent);
            transition:0.7s;
            z-index:2;
        }

        .product-card:hover::before{
            left:100%;
        }

        .btn:hover{
            letter-spacing:0.5px;
        }

        .hero-image img{
            width:100%;
            height:500px;
            object-fit:cover;
            border-radius:20px;
        }
    </style>
</head>
<body>

    <header>
        <div class="navbar">
            <div class="logo">
                <img src="{{ asset('img/pppp.png') }}" alt="Logo IKM">
                BA FARM CHICK
            </div>

            <div class="nav-menu">
                <a href="#home">Home</a>
                <a href="#produk">Produk</a>
                <a href="#tentang">Tentang</a>
                <a href="#kontak">Kontak</a>
                <a href="{{ url('/login') }}" class="btn-login">Login</a>
            </div>
        </div>
    </header>

    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Lakukan Transaksi Dengan Mudah Melalui Website Kami</h1>
            <p>
                Platform untuk mengelola data pegawai, pelanggan, produk, kendaraan, surat jalan, invoice, dan laporan secara terintegrasi.
            </p>

            <div class="hero-buttons">
                <a href="#produk" class="btn btn-primary">Lihat Produk</a>
                <a href="{{ url('/dashboard') }}" class="btn btn-secondary">Masuk</a>
            </div>
        </div>
    </section>

    <section class="section" id="produk">
        <div class="section-title">
            <h2>Produk Kami</h2>
            <p>Layanan dan fitur utama manajemen sistem</p>
        </div>

        <div class="products">

            <div class="product-card">
                <img src="https://images.unsplash.com/photo-1548550023-2bdb3c5beed7?q=80&w=1200&auto=format&fit=crop" alt="Data Pegawai">
                <div class="product-content">
                    <h3>Pegawai & Pelanggan</h3>
                    <p>
                        Pengelolaan database pegawai dan data pelanggan secara terpusat untuk mempermudah koordinasi bisnis.
                    </p>
                </div>
            </div>

            <div class="product-card">
                <img src="https://images.unsplash.com/photo-1604503468506-a8da13d82791?q=80&w=1200&auto=format&fit=crop" alt="Manajemen Produk">
                <div class="product-content">
                    <h3>Produk & Kendaraan</h3>
                    <p>
                        Pantau stok komoditas serta logistik armada kendaraan operasional yang digunakan untuk distribusi harian.
                    </p>
                </div>
            </div>

            <div class="product-card">
                <img src="https://images.unsplash.com/photo-1527477396000-e27163b481c2?q=80&w=1200&auto=format&fit=crop" alt="Surat Jalan">
                <div class="product-content">
                    <h3>Surat Jalan & Invoice</h3>
                    <p>
                        Pembuatan dokumen administrasi pengiriman barang dan penagihan terintegrasi yang cepat serta akurat.
                    </p>
                </div>
            </div>

            <div class="product-card">
                <img src="https://images.unsplash.com/photo-1587593810167-a84920ea0781?q=80&w=1200&auto=format&fit=crop" alt="Laporan">
                <div class="product-content">
                    <h3>Laporan Terintegrasi</h3>
                    <p>
                        Sistem pelaporan berkala otomatis yang menyajikan visualisasi data perkembangan performa usaha Anda.
                    </p>
                </div>
            </div>

        </div>
    </section>

    <section class="section" id="tentang">
        <div class="about">

            <div class="hero-image">
                <img src="https://images.unsplash.com/photo-1548550023-2bdb3c5beed7?q=80&w=1200&auto=format&fit=crop" alt="Sistem IKM">
            </div>
            <div class="about-text">
                <h2>Tentang Sistem BA Farm Chick</h2>
                <p>
                    Sistem Informasi BA Farm Chick merupakan platform modern yang dirancang khusus untuk memfasilitasi integrasi manajemen operasional industri menengah.
                </p>

                <p>
                    Kami mengutamakan efisiensi akurasi data, kebersihan alur birokrasi, dan kemudahan pelayanan untuk mempercepat performa bisnis Anda.
                </p>

                <p>
                    Dengan proses pengolahan data yang dinamis dan aman, sistem ini siap menjadi pilar utama pemantauan kemajuan usaha Anda.
                </p>
            </div>

        </div>
    </section>

    <footer class="footer" id="kontak">
        <h3>Sistem Informasi BA Farm Chick</h3>
        <p>Platform Integrasi Data Operasional Modern</p>
        <p style="margin-top:10px; color:#ccc;">
            &copy; {{ date('Y') }} BA Farm Chick. All Rights Reserved.
        </p>
    </footer>

    <script>
        const cards = document.querySelectorAll('.product-card');

        function revealCards(){
            cards.forEach(card => {
                const cardTop = card.getBoundingClientRect().top;

                if(cardTop < window.innerHeight - 100){
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }
            });
        }

        cards.forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(40px)';
            card.style.transition = '0.8s ease';
        });

        window.addEventListener('scroll', revealCards);
        revealCards();
    </script>

</body>
</html>