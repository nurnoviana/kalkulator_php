<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KALKULATOR SEDERHANA</title>
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <!-- styling tambahan -->
    <style>
        html {
            font-size: 125%;
            font-weight: 300;
            line-height: 1.3;
            box-sizing: border-box;
        }

        body {
            align-items: center;
            display: flex;
            height: 100vh;
            justify-content: center;
            margin-bottom: 2em;
        }

        h2 {
            margin-top: 2em;
            text-align: center;
        }

        .calculator {
            border-radius: 12px;
            box-shadow: 0 0 40px 0px rgba(0, 0, 0, 0.15);
            margin-left: auto;
            margin-right: auto;
            margin-top: 2em;
            margin-bottom: 2.5em;
            padding: 1em;
            max-width: 30em;
            overflow: hidden;
        }

        select {
            max-width: 10em;
        }

        button {
            float: right;
        }

        .container {
            max-width: 35em;
            background-image: linear-gradient(236deg, #74ebd5, #acb6e5);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
    </style>
</head>

<body>
    <?php
    // memanggil koneksi database pada file 'db-connect.php'
    include 'db-connect.php';
    //inisiasi bilangan awal
    $bil1 = null;
    $bil2 = null;
    if (isset($_POST['bil1'])) {
        $bil1 = $_POST['bil1'];
        $bil2 = $_POST['bil2'];
        $jumlah = 0;
        $operasi = $_POST['operasi'];
        switch ($operasi) {
                // operasi untuk penjumlahan
            case 'tambah':
                $jumlah = $bil1 + $bil2;
                break;
                // operasi untuk pengurangan
            case 'kurang':
                $jumlah = $bil1 - $bil2;
                break;
                // operasi untuk perkalian
            case 'kali':
                $jumlah = $bil1 * $bil2;
                break;
                // operasi untuk pembagian
            case 'bagi':
                $jumlah = $bil1 / $bil2;
                break;
                // operasi untuk perpangkatan
            case 'pangkat':
                $jumlah = pow($bil1, $bil2);
                break;
                // operasi untuk modulo
            case 'mod':
                $jumlah = $bil1 % $bil2;
                break;
        }

        //Menginsert data pada tabel bilangan
        $query = "INSERT INTO `bilangan` (`jumlah`) VALUES ('$jumlah')";
        mysqli_query($conn, $query);
    }
    ?>

    <div class="container text-white">
        <div class="rows">
            <h2>KALKULATOR SEDERHANA</h2>
            <div class="calculator">
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                    <div class="form-group">
                        <label>Masukkan Bilangan 1:</label>
                        <input type="text" name="bil1" class="form-control" value="<?php echo $bil1; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Pilih Operasi:</label>
                        <select class="form-control" name="operasi">
                            <option value="tambah">+</option>
                            <option value="kurang">-</option>
                            <option value="kali">*</option>
                            <option value="bagi">/</option>
                            <option value="pangkat">^</option>
                            <option value="mod">%</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Masukkan Bilangan 2:</label>
                        <input type="text" name="bil2" class="form-control" value="<?php echo $bil2; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-success">Hasil</button>
                </form>

                <?php
                if (isset($_POST['bil1'])) {
                    echo "<h1>$jumlah</h1>";
                }
                ?>
            </div>

        </div>

</body>

</html>