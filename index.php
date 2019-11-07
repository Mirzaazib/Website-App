<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" href="dist/img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="dist/css/style.css">
    <!-- Fontawesome -->
    <link href="login/assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Courgette|Oleo+Script|Philosopher|Roboto|Roboto+Slab|Viga&display=swap" rel="stylesheet">
    <title>MySPK</title>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">MySPK</a>
            <button class="navbar-toggler nav-toogle" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link page-scroll active" href="#Home">Home <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link page-scroll" href="#Documentation">Documentation</a>
                <a class="nav-item nav-link page-scroll" href="#About">About</a>
                <a class="nav-item btn btn-primary button" href="login/index.php">LOGIN</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- -->

    <!-- Jumbotron -->
    <div class="jumbotron jumbotron-fluid" id="Home">
        <div class="container">
            <h1 class="display-4">Sistem Pendukung Keputusan<br> Menentukan Lokasi Cabang yang Strategis</h1>
        </div>
    </div>
    <!-- -->

    <!-- Container -->
    <div class="container">
    
    <!-- Info Container -->
        <div class="row justify-content-center">
            <div class="col-10 info-panel">
                <div class="row">
                    <div class="col-lg">
                        <img src="dist/img/fast.png" alt="Employee" class="float-left">
                        <h4>Cepat</h4>
                        <p>Perhitungan dilakukan secara terkomputerisasi.</p>
                    </div>
                    <div class="col-lg">
                        <img src="dist/img/accurate.png" alt="High Res" class="float-left">
                        <h4>Akurat</h4>
                        <p>Menggunakan metode perhitungan Analytic Hierarchy process.</p>
                    </div>
                    <div class="col-lg">
                        <img src="dist/img/PDF.png" alt="Security" class="float-left">
                        <h4>Laporan</h4>
                        <p>Mencetak hasil perangkingan dengan format PDF.</p>
                    </div>
                </div>
            </div>
        </div>
    <!-- -->

    <!-- documentation -->
        <section class="workingspace" id="workingspace">
            <div class="container">
                <div class="row mb-5" id="Documentation">
                    <div class="col-sm-12">
                        <h2 class="text-center">Documentation</h2>
                        <hr>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <img src="dist/img/Kriteria.png" alt="workingspace" class="rounded img-fluid" style="width: 50%"> 
                    </div>
                    <div class="col-md-8">
                        <h3>Menentukan Data Kriteria</h3>
                        <p>Untuk melakukan perhitungan analisa kriteria menggunakan metode AHP masukkan terlebih dahulu data Kriteria yang akan digunakan.</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <img src="dist/img/Alternatif.png" alt="workingspace" class="rounded img-fluid" style="width: 50%"> 
                    </div>
                    <div class="col-lg-8">
                        <h3>Menentukan Data Alternatif</h3>
                        <p>Untuk melakukan perhitungan analaisa alternatif terhadap kriteria dengan menggunakan metode AHP, maka harus ditentukan terlebih dahulu data alternatif yang akan digunakan.</p>
                    </div>
                </div>
								<div class="row mb-3">
                    <div class="col-md-4">
                        <img src="dist/img/Analisa_kriteria.png" alt="workingspace" class="rounded img-fluid" style="width: 50%"> 
                    </div>
                    <div class="col-lg-8">
                        <h3>Analisa Data Kriteria</h3>
                        <p>Untuk melakukab analisa kriteria pengguna akan diminta untuk memasukkan nilai perbandingan antar kriteria pada pilihan kolom yang telah disediakan, jika hasil perhitungan rasio konsistensi dari penilaian perbandingan mempunyai rasio < dari 10% atau rasio < 0,1 maka hasil dapat diterima jika > dari 10% atau > dari 0,1 maka perhitungan harus diulang kembali.</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <img src="dist/img/Analisa_alternatif.png" alt="workingspace" class="rounded img-fluid" style="width: 50%"> 
                    </div>
                    <div class="col-lg-8">
                        <h3>Analisa Data Alternatif</h3>
                        <p>Untuk dapat melakukan analisa data alternatif pada setiap kriteria sebelumnya pengguna harus melakukan perhitungan analisa alternatif terlebih dahulu. Pilih nilai perbandingan nilai alternatif terhadap kriteria pada pilihan kolom yang telah disediakan.</p>
                    </div>
                </div>
								<div class="row mb-3">
                    <div class="col-md-4">
                        <img src="dist/img/Perankingan.png" alt="workingspace" class="rounded img-fluid" style="width: 50%"> 
                    </div>
                    <div class="col-lg-8">
                        <h3>Perankingan</h3>
                        <p>Jika telah melakukan langkah - langkah diatas maka dapat dilakukan perankingan yang menghasilkan urutan hasilnya.</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <img src="dist/img/Laporan.png" alt="workingspace" class="rounded img-fluid" style="width: 50%"> 
                    </div>
                    <div class="col-lg-8">
                        <h3>Pencetakan Hasil</h3>
                        <p>Jika perankingan telah dilakukan, apabila pengguna ingin mencetak hasilnya dapat mengklik tombol laoran maka akan didapatkan hasil berupa file PDF.</p>
                    </div>
				</div>
            </div>
        </section>
    <!-- -->
    
    <!-- about -->
        <section class="about" id="about">
            <div class="container">
                <div class="row" id="About">
                    <div class="col-sm-12">
                        <h2 class="text-center">About</h2>
                        <hr>
                        <p>Website Ini merupakan sebuah website Sistem Pendukung Keputusan untuk mencari lokasi yang strategis untuk pebukaan lokasi cabang Kedai Raden Bandung dengan menggunakan metode perhitungan Analytic Hierarchy process (AHP) yang dapat menyederhanakan dan mempercepat proses pengambilan keputusan yang memungkinkan untuk membentuk gagasan – gagasan dan asumsi sendiri yang menghasilkan suatu pemecahan masalah yang diinginkan. Perhitungan ini menggunakan Kriteria biaya sewa, populasi penduduk sekitar, akses menuju lokasi yang mudah, para pesaing di lokasi tersebut, dan perijinan usaha dan menggunakan alternatif tempat lokasi, yang menghasilkan lokasi terbaik. Pada website ini memungkinkan user dapat mencetak hasil dari perhitungan tersebut menjadi file PDF yang dapat diunduh.</p>               
                    </div>
                </div>
            </div>
        </section>
        <!-- -->
    
        
    </div>
    <!-- -->
    <div class="greetings">
        <div class="content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 text-center">
                        <img src="login/assets/images/profile/foto.jpg" class="foto" alt="">
                        <h4><span>Greetings From</span> Muhammad Mirza Azib</h4> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" style="text-align: right;">
                        <i class="fa fa-fw fa-envelope-square fa-2x">&nbspazib.mirza97@gmail.com</i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer -->
        <div class="footer">
            <div class="text-center">
                <p>&copy 2019 Right Reserved by Mirza Azib</p>
            </div>
        </div>
    <!-- -->
    

    <!-- My Font -->
    <link href="https://fonts.googleapis.com/css?family=Viga" rel="stylesheet"> 
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="dist/js/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <script src="dist/js/jquery.easing.1.3.js"></script>
	<script src="dist/js/script.js"></script>
    <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>-->
  </body>
</html>