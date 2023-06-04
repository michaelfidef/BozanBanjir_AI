<?php
$conn = mysqli_connect("localhost", "root", "", "project_banjir");

$query = "SELECT * FROM sungai_ciliwung";
$result = mysqli_query($conn, $query);

$row = mysqli_fetch_assoc($result);
$oldkl = $row['kl'];
$oldfa = $row['fa'];
$oldmg = $row['mg'];
$oldit = $row['it'];
$oldjm = $row['jm'];

if (isset($_POST['submit'])) {
    $kl = $_POST['Katulampa'];
    $fa = $_POST['flushingAncol'];
    $jm = $_POST['jembatanMerah'];
    $mg = $_POST['manggarai'];
    $it = $_POST['istiqlal'];

    $sql = "UPDATE sungai_ciliwung SET kl='$kl', fa='$fa', mg='$mg', it='$it', jm='$jm'";
    $result = mysqli_query($conn, $sql);
} else {
    $kl = 0;
    $fa = 0;
    $mg = 0;
    $it = 0;
    $jm = 0;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bozan Banjir || Ciliwung</title>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <div class="container">
        <h1>
            Pendeteksi Pintu Air Sungai Ciliwung
        </h1>
        <h3>Isi Data Ketinggian Air pada setiap pintu air</h3>
        <form action="" method="POST">
            <div class="atas">
                <input type="number" min="1" name="Katulampa" id="Katulampa" placeholder="Katulampa" required>
                <input type="number" min="1" name="flushingAncol" id="flushingAncol" placeholder="Flushing Ancol" required>
                <input type="number" min="1" name="manggarai" id="manggarai" placeholder="Manggarai" required>
            </div>
            <div class="bawah">
                <input type="number" min="1" name="istiqlal" id="istiqlal" placeholder="Istiqlal" required>
                <input type="number" min="1" name="jembatanMerah" id="jembatanMerah" placeholder="Jembatan Merah" required>
            </div>
            <div class="submit">
                <p>Jaga dan Peduli Sungai Ciliwung sejak dini!</p>
                <button type="button" name="show" id="show" onclick="reveal()">Lihat</button>
                <button type="submit" name="submit" id="submit">Cek Perkiraan</button>
            </div>
        </form>
    </div>
    <div class="initabel" id="initabel">
        <table width="100%">
            <tr>
                <th>Kondisi</th>
                <th>Katulampa</th>
                <th>Flushing Ancol</th>
                <th>Manggarai</th>
                <th>Istiqlal</th>
                <th>Jembatan Merah</th>
            </tr>
            <tr>
                <td>Sebelum</td>
                <td><?= $oldkl ?></td>
                <td><?= $oldfa ?></td>
                <td><?= $oldmg ?></td>
                <td><?= $oldit ?></td>
                <td><?= $oldjm ?></td>
            </tr>
            <tr>
                <td>Status Sebelum</td>
                <td id="statuskl1"></td>
                <td id="statusfa1"></td>
                <td id="statusmg1"></td>
                <td id="statusit1"></td>
                <td id="statusjm1"></td>
            </tr>
            <tr>
                <td>Saat Ini</td>
                <td><?= $kl ?></td>
                <td><?= $fa ?></td>
                <td><?= $mg ?></td>
                <td><?= $it ?></td>
                <td><?= $jm ?></td>
            </tr>
            <tr>
                <td>Status Saat Ini</td>
                <td id="statuskl2"></td>
                <td id="statusfa2"></td>
                <td id="statusmg2"></td>
                <td id="statusit2"></td>
                <td id="statusjm2"></td>
            </tr>
            <tr>
                <td>Prediksi</td>
                <td id="statuskl3"></td>
                <td id="statusfa3"></td>
                <td id="statusmg3"></td>
                <td id="statusit3"></td>
                <td id="statusjm3"></td>
            </tr>
            <tr>
                <td>Status Prediksi</td>
                <td id="statuskl4"></td>
                <td id="statusfa4"></td>
                <td id="statusmg4"></td>
                <td id="statusit4"></td>
                <td id="statusjm4"></td>
            </tr>
            <tr>
                <td>Pintu Air</td>
                <td id="PAkl"></td>
                <td id="PAfa"></td>
                <td id="PAmg"></td>
                <td id="PAit"></td>
                <td id="PAjm"></td>
            </tr>
            <tr>
                <td>Hasil Prediksi</td>
                <td colspan="5" id="hasil"></td>
            </tr>
        </table>
    </div>
</body>

<script>
    function reveal() {
        var x = document.getElementById("initabel");
        if (x.style.visibility === "hidden") {
            x.style.visibility = "visible";
            x.style.opacity = "1";
            x.style.transition = "visibility 0s, opacity 0.5s linear";
        } else {
            x.style.visibility = "hidden";
            x.style.opacity = "0";
        }
    }
</script>

<script>
    function Katulampa(tinggi) {
        if (tinggi > 200) {
            statusKatulampa = 'Bahaya';
        } else if (tinggi > 150) {
            statusKatulampa = 'Siaga';
        } else if (tinggi >= 80) {
            statusKatulampa = 'Waspada';
        } else {
            statusKatulampa = 'Normal';
        }
        return statusKatulampa;
    }

    function FlushingAncol(tinggi) {
        if (tinggi > 220) {
            statusFlushingAncol = 'Bahaya';
        } else if (tinggi > 190) {
            statusFlushingAncol = 'Siaga';
        } else if (tinggi >= 180) {
            statusFlushingAncol = 'Waspada';
        } else {
            statusFlushingAncol = 'Normal';
        }
        return statusFlushingAncol;
    }

    function Manggarai(tinggi) {
        if (tinggi > 960) {
            statusManggarai = 'Bahaya';
        } else if (tinggi > 860) {
            statusManggarai = 'Siaga'
        } else if (tinggi >= 750) {
            statusManggarai = 'Waspada'
        } else {
            statusManggarai = 'Normal';
        }
        return statusManggarai;
    }

    function Istiqlal(tinggi) {
        if (tinggi > 350) {
            statusIstiqlal = 'Bahaya';
        } else if (tinggi > 300) {
            statusIstiqlal = 'Siaga';
        } else if (tinggi >= 250) {
            statusIstiqlal = 'Waspada';
        } else {
            statusIstiqlal = 'Normal';
        }
        return statusIstiqlal;
    }

    function JembatanMerah(tinggi) {
        if (tinggi > 200) {
            statusMerah = 'Bahaya';
        } else if (tinggi > 150) {
            statusMerah = 'Siaga';
        } else if (tinggi >= 140) {
            statusMerah = 'Waspada';
        } else {
            statusMerah = 'Normal';
        }
        return statusMerah;
    }

    function prediksiKetinggian(sebelum, sekarang) {
        if (sekarang > sebelum) {
            return sekarang + (sekarang - sebelum);
        } else if (sebelum > sekarang) {
            return sekarang + (sebelum - sekarang);
        } else {
            return sebelum;
        }
    }

    function pintuAirkl(katulampa){
        kl = katulampa

        if (kl == 'Normal') {
            kondisi = 'Dibuka 20%'
        }else if(kl == 'Waspada'){
            kondisi = 'Dibuka 40%'
        }else if(kl == 'Siaga'){
            kondisi = 'Dibuka 70%'
        }else if(kl == 'Bahaya'){
            kondisi = 'Dibuka 100%'
        }
        return kondisi 
    }
    
    function pintuAirfa(flushingAncol){
        fa = flushingAncol
        if (fa == 'Normal') {
            kondisi = 'Dibuka 20%'
        }else if(fa == 'Waspada'){
            kondisi = 'Dibuka 40%'
        }else if(fa == 'Siaga'){
            kondisi = 'Dibuka 70%'
        }else if(fa == 'Bahaya'){
            kondisi = 'Dibuka 100%'
        }
        return kondisi
    }

    function pintuAirmg(manggarai){
        mg = manggarai 
        if (mg == 'Normal') {
            kondisi = 'Dibuka 40%'
        }else if(mg == 'Waspada'){
            kondisi = 'Dibuka 80%'
        }else if(mg == 'Siaga'){
            kondisi = 'Dibuka 90%'
        }else if(mg == 'Bahaya'){
            kondisi = 'Dibuka 100%'
        }
        return kondisi
    }

    function pintuAirit(istiqlal){
        it = istiqlal
        if (it == 'Normal') {
            kondisi = 'Dibuka 20%'
        }else if(it == 'Waspada'){
            kondisi = 'Dibuka 40%'
        }else if(it == 'Siaga'){
            kondisi = 'Dibuka 70%'
        }else if(it == 'Bahaya'){
            kondisi = 'Dibuka 100%'
        }
        return kondisi
    }

    function pintuAirjm(jembatanMerah){
        jm = jembatanMerah
        if (jm == 'Normal') {
            kondisi = 'Dibuka 20%'
        }else if(jm == 'Waspada'){
            kondisi = 'Dibuka 40%'
        }else if(jm == 'Siaga'){
            kondisi = 'Dibuka 70%'
        }else if(jm == 'Bahaya'){
            kondisi = 'Dibuka 100%'
        }
        return kondisi
    }

    function prediksiBanjir(Katulampa, flushingAncol, manggarai, istiqlal, jembatanMerah) {
        kl = Katulampa
        fa = flushingAncol
        mg = manggarai
        it = istiqlal
        jm = jembatanMerah

        if (kl == 'Siaga' || kl == 'Bahaya') {
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        } else if (kl == 'Waspada') {
            // Jika status ketinggian Katulampa berada pada posisi "Waspada"
            // Maka akan dilanjutkan pengecekan kondisi 4 lokasi pemantauan lainnya

            // Jika keempatnya "Bahaya"
            if (fa == 'Bahaya' && mg == 'Bahaya' && it == 'Bahaya' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'

                // Jika 3 "Bahaya" 1 "Siaga"
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Bahaya' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Bahaya' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'

                // Jika 3 "Bahaya" 1 "Waspada"
            } else if (fa == 'Waspada' && mg == 'Bahaya' && it == 'Bahaya' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Waspada' && it == 'Bahaya' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Bahaya' && it == 'Waspada' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Bahaya' && it == 'Bahaya' && jm == 'Waspada') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'

                // Jika 3 "Bahaya" 1 "Normal"
            } else if (fa == 'Normal' && mg == 'Bahaya' && it == 'Bahaya' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Normal' && it == 'Bahaya' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Bahaya' && it == 'Normal' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Bahaya' && it == 'Bahaya' && jm == 'Normal') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'

                // Jika 2 "Bahaya" 2 "Siaga"
            } else if (fa == 'Siaga' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai dan Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'

                // Jika 2 "Bahaya" 1 "Siaga" 1 "Waspada"
            } else if (fa == 'Bahaya' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Flushing Ancol dan Manggarai berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Bahaya' && it == 'Waspada' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Flushing Ancol dan Manggarai berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Flushing Ancol dan Istiqlal berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Waspada' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Flushing Ancol dan Istiqlal berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Waspada' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Flushing Ancol dan Jembatan Merah berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Waspada' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Flushing Ancol dan Jembatan Merah berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Bahaya' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Manggarai dan Istiqlal berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Waspada' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Manggarai dan Jembatan Merah berpotensi terjadi banjir!'
            } else if (fa == 'Waspada' && mg == 'Bahaya' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Manggarai dan Istiqlal berpotensi terjadi banjir!'
            } else if (fa == 'Waspada' && mg == 'Bahaya' && it == 'Waspada' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Manggarai dan Jembatan Merah berpotensi terjadi banjir!'
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Istiqlal dan Jembatan Merah berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Bahaya' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Istiqlal dan Jembatan Merah berpotensi terjadi banjir!'

                // Jika 2 "Bahaya" 1 "Siaga" 1 "Normal"
            } else if (fa == 'Bahaya' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Bahaya' && it == 'Normal' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Normal' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Normal' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Normal' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Bahaya' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Normal' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai dan Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Normal' && mg == 'Bahaya' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
            } else if (fa == 'Normal' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Normal' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Siaga' && mg == 'Normal' && it == 'Bahaya' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'

                // Jika 2 "Bahaya" 2 "Waspada"
            } else if (fa == 'Waspada' && mg == 'Waspada' && it == 'Bahaya' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Waspada' && it == 'Waspada' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Bahaya' && it == 'Waspada' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
            } else if (fa == 'Waspada' && mg == 'Bahaya' && it == 'Bahaya' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Waspada' && mg == 'Bahaya' && it == 'Waspada' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Waspada' && it == 'Bahaya' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'

                // Jika 2 "Bahaya" 1 "Waspada" 1 "Normal"
            } else if (fa == 'Bahaya' && mg == 'Bahaya' && it == 'Waspada' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Bahaya' && it == 'Normal' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Waspada' && it == 'Bahaya' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Normal' && it == 'Bahaya' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Waspada' && it == 'Normal' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Normal' && it == 'Waspada' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Waspada' && mg == 'Bahaya' && it == 'Bahaya' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'
            } else if (fa == 'Waspada' && mg == 'Bahaya' && it == 'Normal' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai dan Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Normal' && mg == 'Bahaya' && it == 'Bahaya' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'
            } else if (fa == 'Normal' && mg == 'Bahaya' && it == 'Waspada' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai dan Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Normal' && mg == 'Waspada' && it == 'Bahaya' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Waspada' && mg == 'Normal' && it == 'Bahaya' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'

                // Jika 1 "Bahaya" 3 "Siaga"
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Siaga' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Siaga' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'

                // Jika 1 "Bahaya" 2 "Siaga" 1 "Waspada"
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Waspada' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Waspada' && it == 'Siaga' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Waspada' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Waspada' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Waspada') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Siaga' && it == 'Waspada' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'

                // Jika 1 "Bahaya" 2 "Siaga" 1 "Normal"
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Siaga' && jm == 'Normal') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Normal' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Normal' && it == 'Siaga' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Normal') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Normal' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Normal' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Normal') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Normal' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Normal' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Siaga' && it == 'Normal' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Normal' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Normal' && mg == 'Siaga' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'


                // Jika 1 "Bahaya" 1 "Siaga" 2 "Waspada"
                //Bahaya, Siaga, Waspada, Waspada
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Waspada' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
                //Siaga, Bahaya, Waspada, Waspada
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Waspada' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
                //Waspada, Bahaya, Siaga, Waspada
            } else if (fa == 'Waspada' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
                //Bahaya, Waspada, Siaga, Waspada
            } else if (fa == 'Bahaya' && mg == 'Waspada' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
                //Siaga, Waspada, Bahaya, Waspada
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Bahaya' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!!'
                //Waspada, Siaga, Bahaya, Waspada
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
                // Waspada, Siaga, Waspada, Bahaya
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Waspada' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Siaga, Waspada, Waspada, Bahaya
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Waspada' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Waspada, Waspada, Siaga, Bahaya
            } else if (fa == 'Waspada' && mg == 'Waspada' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Waspada, Bahaya, Waspada, Siaga
            } else if (fa == 'Waspada' && mg == 'Bahaya' && it == 'Waspada' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
                // Bahaya, Waspada, Waspada, Siaga
            } else if (fa == 'Bahaya' && mg == 'Waspada' && it == 'Waspada' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
                // Waspada, Waspada, Bahaya, Siaga
            } else if (fa == 'Waspada' && mg == 'Waspada' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'

                // Jika 1 "Bahaya" 1 "Siaga" 1 "Waspada" 1 "Normal"
                // Normal, Siaga, Waspada, Bahaya
            } else if (fa == 'Normal' && mg == 'Siaga' && it == 'Waspada' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Siaga, Normal, Waspada, Bahaya
            } else if (fa == 'Siaga' && mg == 'Normal' && it == 'Waspada' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi terjadi banjir!'
                // Waspada, Normal, Siaga, Bahaya
            } else if (fa == 'Waspada' && mg == 'Normal' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada Lokasi Jembatan Merah berpotensi terjadi banjir!'
                // Normal, Waspada, Siaga, Bahaya
            } else if (fa == 'Normal' && mg == 'Waspada' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi terjadi banjir!'
                // Siaga, Waspada, Normal, Bahaya
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Normal' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi terjadi banjir!'
                // Waspada, Siaga, Normal, Bahaya
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Normal' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi terjadi banjir!'
                // Waspada, Siaga, Bahaya, Normal
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi terjadi banjir!'
                // Siaga, Waspada, Bahaya, Normal
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Bahaya' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi istiqlal berpotensi terjadi banjir!'
                // Bahaya, Waspada, Siaga, Normal
            } else if (fa == 'Bahaya' && mg == 'Waspada' && it == 'Siaga' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi terjadi banjir!'
                // Waspada, Bahaya, Siaga, Normal
            } else if (fa == 'Waspada' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Menggarai berpotensi terjadi banjir!'
                // Siaga, Bahaya, Waspada, Normal
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Waspada' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi terjadi banjir!'
                // Bahaya, Siaga, Waspada, Normal
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Waspada' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi terjadi banjir!'
                // Bahaya, Normal, Waspada, Siaga
            } else if (fa == 'Bahaya' && mg == 'Normal' && it == 'Waspada' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi terjadi banjir!'
                // Normal, Bahaya, Waspada, Siaga
            } else if (fa == 'Normal' && mg == 'Bahaya' && it == 'Waspada' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi terjadi banjir!'
                // Waspada, Bahaya, Normal, Siaga
            } else if (fa == 'Waspada' && mg == 'Bahaya' && it == 'Normal' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi terjadi banjir!'
                // Bahaya, Waspada, Normal, Siaga
            } else if (fa == 'Bahaya' && mg == 'Waspada' && it == 'Normal' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi flushing Ancol berpotensi terjadi banjir!'
                // Normal, Waspada, Bahaya, Siaga
            } else if (fa == 'Normal' && mg == 'Waspada' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi terjadi banjir!'
                // Waspada, Normal, Bahaya, Siaga
            } else if (fa == 'Waspada' && mg == 'Normal' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi terjadi banjir!'
                // Siaga, Normal, Bahaya, Waspada
            } else if (fa == 'Siaga' && mg == 'Normal' && it == 'Bahaya' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi terjadi banjir!'
                // Normal, Siaga, Bahaya, Waspada
            } else if (fa == 'Normal' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi terjadi banjir!'
                // Bahaya, Siaga, Normal, Waspada
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Normal' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi flushing Ancol berpotensi terjadi banjir!'
                // Siaga, Bahaya, Normal, Waspada
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Normal' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi terjadi banjir!'
                // Normal, Bahaya, Siaga, Waspada
            } else if (fa == 'Normal' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi terjadi banjir!'
                // Bahaya, Normal, Siaga, Waspada
            } else if (fa == 'Bahaya' && mg == 'Normal' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi flushing Ancol berpotensi terjadi banjir!'

                // Jika 1 "Bahaya" 1 "Siaga" 2 "Normal"
                // Normal, Normal, Siaga, Bahaya
            } else if (fa == 'Normal' && mg == 'Normal' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Normal, Bahaya, Normal, Siaga
            } else if (fa == 'Normal' && mg == 'Normal' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Normal, Normal, Bahaya, Siaga
            } else if (fa == 'Normal' && mg == 'Normal' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
                // Normal, Siaga, Bahaya, Normal
            } else if (fa == 'Normal' && mg == 'Siaga' && it == 'Normal' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Normal, Bahaya, Siaga, Normal
            } else if (fa == 'Normal' && mg == 'Bahaya' && it == 'Normal' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
                // Normal, Siaga, Normal, Bahaya
            } else if (fa == 'Normal' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
                // Normal, Bahaya, Siaga, Normal
            } else if (fa == 'Normal' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
                // Siaga, Normal, Normal, Bahaya
            } else if (fa == 'Siaga' && mg == 'Normal' && it == 'Normal' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Siaga, Normal, Bahaya, Normal
            } else if (fa == 'Siaga' && mg == 'Normal' && it == 'Bahaya' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
                // Bahaya, Normal, Normal, Siaga
            } else if (fa == 'Bahaya' && mg == 'Normal' && it == 'Normal' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
                // Bahaya, Normal, Siaga, Normal
            } else if (fa == 'Bahaya' && mg == 'Normal' && it == 'Siaga' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
                // Bahaya, Siaga, Normal, Normal
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Normal' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
                // Siaga, Bahaya, Normal, Normal
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Normal' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'

                // Jika 1 "Bahaya" 1 "Waspada" 2 "Normal"

                // Normal, Normal, Waspada, Bahaya
            } else if (fa == 'Normal' && mg == 'Normal' && it == 'Waspada' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Normal, Normal, Bahaya, Waspada
            } else if (fa == 'Normal' && mg == 'Normal' && it == 'Bahaya' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
                // Normal, Waspada, Normal, Bahaya
            } else if (fa == 'Normal' && mg == 'Waspada' && it == 'Normal' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Normal, Bahaya, Normal, Waspada
            } else if (fa == 'Normal' && mg == 'Bahaya' && it == 'Normal' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
                // Normal, Waspada, Bahaya, Normal
            } else if (fa == 'Normal' && mg == 'Waspada' && it == 'Bahaya' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
                // Normal, Bahaya, Waspada, Normal
            } else if (fa == 'Normal' && mg == 'Bahaya' && it == 'Waspada' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
                // Waspada, Normal, Normal, Bahaya
            } else if (fa == 'Waspada' && mg == 'Normal' && it == 'Normal' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Waspada, Normal, Bahaya, Normal
            } else if (fa == 'Waspada' && mg == 'Normal' && it == 'Bahaya' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
                // Bahaya, Normal, Normal, Waspada
            } else if (fa == 'Bahaya' && mg == 'Normal' && it == 'Normal' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
                // Bahaya, Normal, Waspada, Normal
            } else if (fa == 'Bahaya' && mg == 'Normal' && it == 'Waspada' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
                // Bahaya, Waspada, Normal, Normal
            } else if (fa == 'Bahaya' && mg == 'Waspada' && it == 'Normal' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
                // Waspada, Bahaya, Normal, Normal
            } else if (fa == 'Waspada' && mg == 'Bahaya' && it == 'Normal' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'

                // Jika 1 "Bahaya" 3 "Waspada"
            } else if (fa == 'Bahaya' && mg == 'Waspada' && it == 'Waspada' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
            } else if (fa == 'Waspada' && mg == 'Bahaya' && it == 'Waspada' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
            } else if (fa == 'Waspada' && mg == 'Waspada' && it == 'Bahaya' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
            } else if (fa == 'Waspada' && mg == 'Waspada' && it == 'Waspada' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'

                // Jika 1 "Bahaya" 3 "Normal"
            } else if (fa == 'Bahaya' && mg == 'Normal' && it == 'Normal' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
            } else if (fa == 'Normal' && mg == 'Bahaya' && it == 'Normal' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
            } else if (fa == 'Normal' && mg == 'Normal' && it == 'Bahaya' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
            } else if (fa == 'Normal' && mg == 'Normal' && it == 'Normal' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'

                // 4 Siaga
            } else if (fa == 'Siaga' && mg == 'Siaga' && it == 'Siaga' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
                // 3 Siaga 1 Waspada
            } else if (fa == 'Siaga' && mg == 'Siaga' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Siaga' && it == 'Waspada' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Siaga' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Siaga' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
                // 3 Siaga 1 Normal
            } else if (fa == 'Siaga' && mg == 'Siaga' && it == 'Siaga' && jm == 'Normal') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Siaga' && it == 'Normal' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Normal' && it == 'Siaga' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Normal' && mg == 'Siaga' && it == 'Siaga' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'

                // 2 Siaga 2 Waspada

                // Siaga, Siaga, Waspada, Waspada
            } else if (fa == 'Siaga' && mg == 'Siaga' && it == 'Waspada' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
                // Siaga, Waspada, Siaga, Waspada
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
                // Siaga, Waspada, Waspada, Siaga
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Waspada' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
                // Waspada, Siaga, Siaga, Waspada
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Manggarai dan istiqlal berpotensi banjir!'
                // Waspada, Siaga, Waspada, Siaga
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Waspada' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Manggarai dan Jembatan Merah berpotensi banjir!'
                // Waspada, Waspada, Siaga, Siaga
            } else if (fa == 'Waspada' && mg == 'Waspada' && it == 'Siaga' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'


                // 2 Siaga 1 Waspada 1 Normal

                // Normal, Siaga, Siaga, Waspada
            } else if (fa == 'Normal' && mg == 'Siaga' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'
                // Normal, Siaga, Waspada, Siaga
            } else if (fa == 'Normal' && mg == 'Siaga' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'
                // Normal, Waspada, Siaga, Siaga
            } else if (fa == 'Normal' && mg == 'Waspada' && it == 'Siaga' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'
                // Siaga, Normal, Siaga, Waspada
            } else if (fa == 'Siaga' && mg == 'Normal' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
                // Siaga, Normal, Waspada, Siaga
            } else if (fa == 'Siaga' && mg == 'Normal' && it == 'Waspada' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
                // Siaga, Siaga, Normal, Waspada
            } else if (fa == 'Siaga' && mg == 'Siaga' && it == 'Normal' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
                // Siaga, Siaga, Waspada, Normal
            } else if (fa == 'Siaga' && mg == 'Siaga' && it == 'Waspada' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
                // Siaga, Waspada, Normal, Siaga
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Normal' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol dan Jembatan Merah  berpotensi banjir!'
                // Siaga, Waspada, Siaga, Normal
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Siaga' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
                // Waspada, Normal, Siaga, Siaga
            } else if (fa == 'Waspada' && mg == 'Normal' && it == 'Siaga' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'
                // Waspada, Siaga, Normal, Siaga
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Normal' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Manggarai dan Jembatan Merah berpotensi banjir!'
                // Waspada, Siaga, Siaga, Normal
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Siaga' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'

                // 2 Siaga 2 Normal
            } else if (fa == 'Waspada' && mg == 'Waspada' && it == 'Normal' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol dan Manggarai warga perlu waspada!'
                // Normal, Waspada, Waspada, Normal
            } else if (fa == 'Normal' && mg == 'Waspada' && it == 'Waspada' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Manggarai dan Istiqlal warga perlu waspada!'
                // Waspada, Normal, Waspada, Normal
            } else if (fa == 'Waspada' && mg == 'Normal' && it == 'Waspada' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol dan Istiqlal warga perlu waspada!'
                // Normal, Waspada, Normal, Waspada
            } else if (fa == 'Normal' && mg == 'Waspada' && it == 'Normal' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Manggarai dan Jembatan Merah warga perlu waspada!'
                // Waspada, Normal, Normal, Waspada
            } else if (fa == 'Waspada' && mg == 'Normal' && it == 'Normal' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol dan Manggarai warga perlu waspada!'
                // Normal, Normal, Waspada, Waspada
            } else if (fa == 'Normal' && mg == 'Normal' && it == 'Waspada' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Istiqlal dan Jembatan Merah warga perlu waspada!'

                // 1 Siaga 3 Waspada
            } else if (fa == 'Waspada' && mg == 'Waspada' && it == 'Waspada' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Waspada' && mg == 'Waspada' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Istiqlal berpotensi banjir!!'
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Waspada' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Manggarai berpotensi banjir!'
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Waspada' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol berpotensi banjir!'
                // 1 Siaga 3 Normal
            } else if (fa == 'Normal' && mg == 'Normal' && it == 'Normal' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Normal' && mg == 'Normal' && it == 'Siaga' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Istiqlal berpotensi banjir!!'
            } else if (fa == 'Normal' && mg == 'Siaga' && it == 'Normal' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Manggarai berpotensi banjir!'
            } else if (fa == 'Siaga' && mg == 'Normal' && it == 'Normal' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol berpotensi banjir!'
                // 2 Waspada 2 Normal

                // Waspada, Waspada, Normal, Normal
            } else if (fa == 'Waspada' && mg == 'Waspada' && it == 'Normal' && jm == 'Normal') {
                pesan = '[AMAN] Pada lokasi Flushing Ancol dan Manggarai warga perlu waspada!'
                // Normal, Waspada, Waspada, Normal
            } else if (fa == 'Normal' && mg == 'Waspada' && it == 'Waspada' && jm == 'Normal') {
                pesan = '[AMAN] Pada lokasi Manggarai dan Istiqlal warga perlu waspada!'
                // Waspada, Normal, Waspada, Normal
            } else if (fa == 'Waspada' && mg == 'Normal' && it == 'Waspada' && jm == 'Normal') {
                pesan = '[AMAN] Pada lokasi Flushing Ancol dan Istiqlal warga perlu waspada!'
                // Normal, Waspada, Normal, Waspada
            } else if (fa == 'Normal' && mg == 'Waspada' && it == 'Normal' && jm == 'Waspada') {
                pesan = '[AMAN] Pada lokasi Manggarai dan Jembatan Merah warga perlu waspada!'
                // Waspada, Normal, Normal, Waspada
            } else if (fa == 'Waspada' && mg == 'Normal' && it == 'Normal' && jm == 'Waspada') {
                pesan = '[AMAN] Pada lokasi Flushing Ancol dan Manggarai warga perlu waspada!'
                // Normal, Normal, Waspada, Waspada
            } else if (fa == 'Normal' && mg == 'Normal' && it == 'Waspada' && jm == 'Waspada') {
                pesan = '[AMAN] Pada lokasi Istiqlal dan Jembatan Merah warga perlu waspada!'


                // 2 Waspada 1 Siaga 1 Normal

                // Waspada, Waspada, Siaga, Normal
            } else if (fa == 'Waspada' && mg == 'Waspada' && it == 'Siaga' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Istiqlal warga perlu waspada!'
                // Siaga, Waspada, Waspada, Normal
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Waspada' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol warga perlu waspada!'
                // Waspada, Siaga, Waspada, Normal
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Waspada' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Manggarai warga perlu waspada!'
                // Siaga, Waspada, Normal, Waspada
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Normal' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol warga perlu waspada!'
                // Waspada, Siaga, Normal, Waspada
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Normal' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Manggarai warga perlu waspada!'
                // Normal, Siaga, Waspada, Waspada
            } else if (fa == 'Normal' && mg == 'Siaga' && it == 'Waspada' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Manggarai warga perlu waspada!'
                // Siaga, Normal, Waspada, Waspada
            } else if (fa == 'Siaga' && mg == 'Normal' && it == 'Waspada' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol berpotensi banjir!'
                // Waspada, Normal, Siaga, Waspada
            } else if (fa == 'Waspada' && mg == 'Normal' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Istiqlal berpotensi banjir!'
                // Normal, Waspada, Siaga, Waspada
            } else if (fa == 'Normal' && mg == 'Waspada' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Istiqlal berpotensi banjir!'
                // Waspada, Waspada, Normal, Siaga
            } else if (fa == 'Waspada' && mg == 'Waspada' && it == 'Normal' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Normal, Waspada, Waspada, Siaga
            } else if (fa == 'Normal' && mg == 'Waspada' && it == 'Waspada' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Waspada, Normal, Waspada, Siaga
            } else if (fa == 'Waspada' && mg == 'Normal' && it == 'Waspada' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'
                // 1 Waspada 3 Normal
            } else if (fa == 'Normal' && mg == 'Normal' && it == 'Normal' && jm == 'Waspada') {
                pesan = '[AMAN] Pada lokasi Jembatan Merah warga perlu waspada!'
            } else if (fa == 'Normal' && mg == 'Normal' && it == 'Waspada' && jm == 'Normal') {
                pesan = '[AMAN] Pada lokasi Istiqlal warga perlu waspada!'
            } else if (fa == 'Normal' && mg == 'Waspada' && it == 'Normal' && jm == 'Normal') {
                pesan = '[AMAN] Pada lokasi Manggarai warga perlu waspada!'
            } else if (fa == 'Waspada' && mg == 'Normal' && it == 'Normal' && jm == 'Normal') {
                pesan = '[AMAN] Pada lokasi Flushing Ancol warga perlu waspada!'

                //2 Normal 1 Siaga 1 Waspada

                // Normal, Normal, Siaga, Waspada
            } else if (fa == 'Normal' && mg == 'Normal' && it == '' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Siaga, Normal, Normal, Waspada
            } else if (fa == 'Siaga' && mg == 'Normal' && it == 'Normal' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol berpotensi banjir!'
                // Normal, Siaga, Normal, Waspada
            } else if (fa == 'Normal' && mg == 'Siaga' && it == 'Normal' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Manggarai berpotensi banjir!'
                // Siaga, Normal, Waspada, Normal
            } else if (fa == 'Siaga' && mg == 'Normal' && it == 'Waspada' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol warga perlu waspada!'
                // Normal, Siaga, Waspada, Normal
            } else if (fa == 'Normal' && mg == 'Siaga' && it == 'Waspada' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Manggarai berpotensi banjir!'
                // Waspada, Siaga, Normal, Normal
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Normal' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Manggarai berpotensi banjir!'
                // Siaga, Waspada, Normal, Normal
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Normal' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol berpotensi banjir!'
                // Normal, Waspada, Siaga, Normal
            } else if (fa == 'Normal' && mg == 'Waspada' && it == 'Siaga' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Istiqlal berpotensi banjir!'
                // Waspada, Normal, Siaga, Normal
            } else if (fa == 'Waspada' && mg == 'Normal' && it == 'Siaga' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Istiqlal berpotensi banjir!'
                // Normal, Normal, Waspada, Siaga
            } else if (fa == 'Normal' && mg == 'Normal' && it == 'Waspada' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Waspada, Normal, Normal, Siaga
            } else if (fa == 'Waspada' && mg == 'Normal' && it == 'Normal' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Normal, Waspada, Normal, Siaga
            } else if (fa == 'Normal' && mg == 'Waspada' && it == 'Normal' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'
            } else {
                pesan = '[AMAN] Pada lokasi Katulampa warga perlu waspada!'
            }
        } else {
            // Jika keempatnya "Bahaya"
            if (fa == 'Bahaya' && mg == 'Bahaya' && it == 'Bahaya' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'

                // Jika 3 "Bahaya" 1 "Siaga"
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Bahaya' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Bahaya' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'

                // Jika 3 "Bahaya" 1 "Waspada"
            } else if (fa == 'Waspada' && mg == 'Bahaya' && it == 'Bahaya' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Waspada' && it == 'Bahaya' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Bahaya' && it == 'Waspada' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Bahaya' && it == 'Bahaya' && jm == 'Waspada') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'

                // Jika 3 "Bahaya" 1 "Normal"
            } else if (fa == 'Normal' && mg == 'Bahaya' && it == 'Bahaya' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Normal' && it == 'Bahaya' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Bahaya' && it == 'Normal' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Bahaya' && it == 'Bahaya' && jm == 'Normal') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'

                // Jika 2 "Bahaya" 2 "Siaga"
            } else if (fa == 'Siaga' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai dan Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'

                // Jika 2 "Bahaya" 1 "Siaga" 1 "Waspada"
            } else if (fa == 'Bahaya' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Flushing Ancol dan Manggarai berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Bahaya' && it == 'Waspada' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Flushing Ancol dan Manggarai berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Flushing Ancol dan Istiqlal berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Waspada' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Flushing Ancol dan Istiqlal berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Waspada' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Flushing Ancol dan Jembatan Merah berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Waspada' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Flushing Ancol dan Jembatan Merah berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Bahaya' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Manggarai dan Istiqlal berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Waspada' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Manggarai dan Jembatan Merah berpotensi terjadi banjir!'
            } else if (fa == 'Waspada' && mg == 'Bahaya' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Manggarai dan Istiqlal berpotensi terjadi banjir!'
            } else if (fa == 'Waspada' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Manggarai dan Jembatan Merah berpotensi terjadi banjir!'
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Istiqlal dan Jembatan Merah berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Bahaya' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Istiqlal dan Jembatan Merah berpotensi terjadi banjir!'

                // Jika 2 "Bahaya" 1 "Siaga" 1 "Normal"
            } else if (fa == 'Bahaya' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Bahaya' && it == 'Normal' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Normal' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Normal' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Normal' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Bahaya' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Normal' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai dan Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Normal' && mg == 'Bahaya' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
            } else if (fa == 'Normal' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai dan Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Normal' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Siaga' && mg == 'Normal' && it == 'Bahaya' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'

                // Jika 2 "Bahaya" 2 "Waspada"
            } else if (fa == 'Waspada' && mg == 'Waspada' && it == 'Bahaya' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Waspada' && it == 'Waspada' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Bahaya' && it == 'Waspada' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
            } else if (fa == 'Waspada' && mg == 'Bahaya' && it == 'Bahaya' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Waspada' && mg == 'Bahaya' && it == 'Waspada' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Waspada' && it == 'Bahaya' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'

                // Jika 2 "Bahaya" 1 "Waspada" 1 "Normal"
            } else if (fa == 'Bahaya' && mg == 'Bahaya' && it == 'Waspada' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Bahaya' && it == 'Normal' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Waspada' && it == 'Bahaya' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Normal' && it == 'Bahaya' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Waspada' && it == 'Normal' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Normal' && it == 'Waspada' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Waspada' && mg == 'Bahaya' && it == 'Bahaya' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'
            } else if (fa == 'Waspada' && mg == 'Bahaya' && it == 'Normal' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai dan Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Normal' && mg == 'Bahaya' && it == 'Bahaya' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'
            } else if (fa == 'Normal' && mg == 'Bahaya' && it == 'Waspada' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai dan Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Normal' && mg == 'Waspada' && it == 'Bahaya' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Waspada' && mg == 'Normal' && it == 'Bahaya' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'

                // Jika 1 "Bahaya" 3 "Siaga"
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Siaga' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Siaga' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'

                // Jika 1 "Bahaya" 2 "Siaga" 1 "Waspada"
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Waspada' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Waspada' && it == 'Siaga' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Waspada' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Waspada' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Waspada') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Siaga' && it == 'Waspada' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'

                // Jika 1 "Bahaya" 2 "Siaga" 1 "Normal"
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Siaga' && jm == 'Normal') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Normal' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Bahaya' && mg == 'Normal' && it == 'Siaga' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Normal') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Normal' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Normal' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Normal') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Normal' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Normal' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Siaga' && it == 'Normal' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Normal' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Normal' && mg == 'Siaga' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'


                // Jika 1 "Bahaya" 1 "Siaga" 2 "Waspada"
                //Bahaya, Siaga, Waspada, Waspada
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Waspada' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
                //Siaga, Bahaya, Waspada, Waspada
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Waspada' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
                //Waspada, Bahaya, Siaga, Waspada
            } else if (fa == 'Waspada' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
                //Bahaya, Waspada, Siaga, Waspada
            } else if (fa == 'Bahaya' && mg == 'Waspada' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
                //Siaga, Waspada, Bahaya, Waspada
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Bahaya' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!!'
                //Waspada, Siaga, Bahaya, Waspada
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
                // Waspada, Siaga, Waspada, Bahaya
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Waspada' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Siaga, Waspada, Waspada, Bahaya
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Waspada' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Waspada, Waspada, Siaga, Bahaya
            } else if (fa == 'Waspada' && mg == 'Waspada' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Waspada, Bahaya, Waspada, Siaga
            } else if (fa == 'Waspada' && mg == 'Bahaya' && it == 'Waspada' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
                // Bahaya, Waspada, Waspada, Siaga
            } else if (fa == 'Bahaya' && mg == 'Waspada' && it == 'Waspada' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
                // Waspada, Waspada, Bahaya, Siaga
            } else if (fa == 'Waspada' && mg == 'Waspada' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'

                // Jika 1 "Bahaya" 1 "Siaga" 1 "Waspada" 1 "Normal"(UDAH BENER)
                // Normal, Siaga, Waspada, Bahaya
            } else if (fa == 'Normal' && mg == 'Siaga' && it == 'Waspada' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Siaga, Normal, Waspada, Bahaya
            } else if (fa == 'Siaga' && mg == 'Normal' && it == 'Waspada' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi terjadi banjir!'
                // Waspada, Normal, Siaga, Bahaya
            } else if (fa == 'Waspada' && mg == 'Normal' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada Lokasi Jembatan Merah berpotensi terjadi banjir!'
                // Normal, Waspada, Siaga, Bahaya
            } else if (fa == 'Normal' && mg == 'Waspada' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi terjadi banjir!'
                // Siaga, Waspada, Normal, Bahaya
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Normal' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi terjadi banjir!'
                // Waspada, Siaga, Normal, Bahaya
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Normal' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi terjadi banjir!'
                // Waspada, Siaga, Bahaya, Normal
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi terjadi banjir!'
                // Siaga, Waspada, Bahaya, Normal
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Bahaya' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi istiqlal berpotensi terjadi banjir!'
                // Bahaya, Waspada, Siaga, Normal
            } else if (fa == 'Bahaya' && mg == 'Waspada' && it == 'Siaga' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi terjadi banjir!'
                // Waspada, Bahaya, Siaga, Normal
            } else if (fa == 'Waspada' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Menggarai berpotensi terjadi banjir!'
                // Siaga, Bahaya, Waspada, Normal
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Waspada' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi terjadi banjir!'
                // Bahaya, Siaga, Waspada, Normal
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Waspada' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi terjadi banjir!'
                // Bahaya, Normal, Waspada, Siaga
            } else if (fa == 'Bahaya' && mg == 'Normal' && it == 'Waspada' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi terjadi banjir!'
                // Normal, Bahaya, Waspada, Siaga
            } else if (fa == 'Normal' && mg == 'Bahaya' && it == 'Waspada' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi terjadi banjir!'
                // Waspada, Bahaya, Normal, Siaga
            } else if (fa == 'Waspada' && mg == 'Bahaya' && it == 'Normal' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi terjadi banjir!'
                // Bahaya, Waspada, Normal, Siaga
            } else if (fa == 'Bahaya' && mg == 'Waspada' && it == 'Normal' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi terjadi banjir!'
                // Normal, Waspada, Bahaya, Siaga
            } else if (fa == 'Normal' && mg == 'Waspada' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi terjadi banjir!'
                // Waspada, Normal, Bahaya, Siaga
            } else if (fa == 'Waspada' && mg == 'Normal' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi terjadi banjir!'
                // Siaga, Normal, Bahaya, Waspada
            } else if (fa == 'Siaga' && mg == 'Normal' && it == 'Bahaya' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi terjadi banjir!'
                // Normal, Siaga, Bahaya, Waspada
            } else if (fa == 'Normal' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi terjadi banjir!'
                // Bahaya, Siaga, Normal, Waspada
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Normal' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi terjadi banjir!'
                // Siaga, Bahaya, Normal, Waspada
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Normal' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi terjadi banjir!'
                // Normal, Bahaya, Siaga, Waspada
            } else if (fa == 'Normal' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi terjadi banjir!'
                // Bahaya, Normal, Siaga, Waspada
            } else if (fa == 'Bahaya' && mg == 'Normal' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi terjadi banjir!'

                // Jika 1 "Bahaya" 1 "Siaga" 2 "Normal"
                // Normal, Normal, Siaga, Bahaya
            } else if (fa == 'Normal' && mg == 'Normal' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Normal, Bahaya, Normal, Siaga
            } else if (fa == 'Normal' && mg == 'Normal' && it == 'Siaga' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Normal, Normal, Bahaya, Siaga
            } else if (fa == 'Normal' && mg == 'Normal' && it == 'Bahaya' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
                // Normal, Siaga, Bahaya, Normal
            } else if (fa == 'Normal' && mg == 'Siaga' && it == 'Normal' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Normal, Bahaya, Siaga, Normal
            } else if (fa == 'Normal' && mg == 'Bahaya' && it == 'Normal' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
                // Normal, Siaga, Normal, Bahaya
            } else if (fa == 'Normal' && mg == 'Siaga' && it == 'Bahaya' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
                // Normal, Bahaya, Siaga, Normal
            } else if (fa == 'Normal' && mg == 'Bahaya' && it == 'Siaga' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
                // Siaga, Normal, Normal, Bahaya
            } else if (fa == 'Siaga' && mg == 'Normal' && it == 'Normal' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Siaga, Normal, Bahaya, Normal
            } else if (fa == 'Siaga' && mg == 'Normal' && it == 'Bahaya' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
                // Bahaya, Normal, Normal, Siaga
            } else if (fa == 'Bahaya' && mg == 'Normal' && it == 'Normal' && jm == 'Siaga') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
                // Bahaya, Normal, Siaga, Normal
            } else if (fa == 'Bahaya' && mg == 'Normal' && it == 'Siaga' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
                // Bahaya, Siaga, Normal, Normal
            } else if (fa == 'Bahaya' && mg == 'Siaga' && it == 'Normal' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
                // Siaga, Bahaya, Normal, Normal
            } else if (fa == 'Siaga' && mg == 'Bahaya' && it == 'Normal' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'

                // Jika 1 "Bahaya" 1 "Waspada" 2 "Normal"

                // Normal, Normal, Waspada, Bahaya
            } else if (fa == 'Normal' && mg == 'Normal' && it == 'Waspada' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Normal, Normal, Bahaya, Waspada
            } else if (fa == 'Normal' && mg == 'Normal' && it == 'Bahaya' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
                // Normal, Waspada, Normal, Bahaya
            } else if (fa == 'Normal' && mg == 'Waspada' && it == 'Normal' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Normal, Bahaya, Normal, Waspada
            } else if (fa == 'Normal' && mg == 'Bahaya' && it == 'Normal' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
                // Normal, Waspada, Bahaya, Normal
            } else if (fa == 'Normal' && mg == 'Waspada' && it == 'Bahaya' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
                // Normal, Bahaya, Waspada, Normal
            } else if (fa == 'Normal' && mg == 'Bahaya' && it == 'Waspada' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
                // Waspada, Normal, Normal, Bahaya
            } else if (fa == 'Waspada' && mg == 'Normal' && it == 'Normal' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Waspada, Normal, Bahaya, Normal
            } else if (fa == 'Waspada' && mg == 'Normal' && it == 'Bahaya' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
                // Bahaya, Normal, Normal, Waspada
            } else if (fa == 'Bahaya' && mg == 'Normal' && it == 'Normal' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
                // Bahaya, Normal, Waspada, Normal
            } else if (fa == 'Bahaya' && mg == 'Normal' && it == 'Waspada' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
                // Bahaya, Waspada, Normal, Normal
            } else if (fa == 'Bahaya' && mg == 'Waspada' && it == 'Normal' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
                // Waspada, Bahaya, Normal, Normal
            } else if (fa == 'Waspada' && mg == 'Bahaya' && it == 'Normal' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'

                // Jika 1 "Bahaya" 3 "Waspada"
            } else if (fa == 'Bahaya' && mg == 'Waspada' && it == 'Waspada' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
            } else if (fa == 'Waspada' && mg == 'Bahaya' && it == 'Waspada' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
            } else if (fa == 'Waspada' && mg == 'Waspada' && it == 'Bahaya' && jm == 'Waspada') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
            } else if (fa == 'Waspada' && mg == 'Waspada' && it == 'Waspada' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'

                // Jika 1 "Bahaya" 3 "Normal"
            } else if (fa == 'Bahaya' && mg == 'Normal' && it == 'Normal' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
            } else if (fa == 'Normal' && mg == 'Bahaya' && it == 'Normal' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
            } else if (fa == 'Normal' && mg == 'Normal' && it == 'Bahaya' && jm == 'Normal') {
                pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
            } else if (fa == 'Normal' && mg == 'Normal' && it == 'Normal' && jm == 'Bahaya') {
                pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'

                // 4 Siaga
            } else if (fa == 'Siaga' && mg == 'Siaga' && it == 'Siaga' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
                // 3 Siaga 1 Waspada
            } else if (fa == 'Siaga' && mg == 'Siaga' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Siaga' && it == 'Waspada' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Siaga' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Siaga' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
                // 3 Siaga 1 Normal
            } else if (fa == 'Siaga' && mg == 'Siaga' && it == 'Siaga' && jm == 'Normal') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Siaga' && it == 'Normal' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Siaga' && mg == 'Normal' && it == 'Siaga' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            } else if (fa == 'Normal' && mg == 'Siaga' && it == 'Siaga' && jm == 'Siaga') {
                pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'



                // 2 Siaga 1 Waspada 1 Normal

                // Normal, Siaga, Siaga, Waspada
            } else if (fa == 'Normal' && mg == 'Siaga' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'
                // Normal, Siaga, Waspada, Siaga
            } else if (fa == 'Normal' && mg == 'Siaga' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'
                // Normal, Waspada, Siaga, Siaga
            } else if (fa == 'Normal' && mg == 'Waspada' && it == 'Siaga' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'
                // Siaga, Normal, Siaga, Waspada
            } else if (fa == 'Siaga' && mg == 'Normal' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
                // Siaga, Normal, Waspada, Siaga
            } else if (fa == 'Siaga' && mg == 'Normal' && it == 'Waspada' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
                // Siaga, Siaga, Normal, Waspada
            } else if (fa == 'Siaga' && mg == 'Siaga' && it == 'Normal' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
                // Siaga, Siaga, Waspada, Normal
            } else if (fa == 'Siaga' && mg == 'Siaga' && it == 'Waspada' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
                // Siaga, Waspada, Normal, Siaga
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Normal' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol dan Jembatan Merah  berpotensi banjir!'
                // Siaga, Waspada, Siaga, Normal
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Siaga' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
                // Waspada, Normal, Siaga, Siaga
            } else if (fa == 'Waspada' && mg == 'Normal' && it == 'Siaga' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'
                // Waspada, Siaga, Normal, Siaga
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Normal' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Manggarai dan Jembatan Merah berpotensi banjir!'
                // Waspada, Siaga, Siaga, Normal
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Siaga' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'

                // 2 Siaga 2 Waspada

                // Siaga, Siaga, Waspada, Waspada
            } else if (fa == 'Siaga' && mg == 'Siaga' && it == 'Waspada' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
                // Siaga, Waspada, Siaga, Waspada
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
                // Siaga, Waspada, Waspada, Siaga
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Waspada' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
                // Waspada, Siaga, Siaga, Waspada
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Manggarai dan istiqlal berpotensi banjir!'
                // Waspada, Siaga, Waspada, Siaga
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Waspada' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Manggarai dan Jembatan Merah berpotensi banjir!'
                // Waspada, Waspada, Siaga, Siaga
            } else if (fa == 'Waspada' && mg == 'Waspada' && it == 'Siaga' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'

                // 2 Waspada 1 Siaga 1 Normal

                // Waspada, Waspada, Siaga, Normal
            } else if (fa == 'Waspada' && mg == 'Waspada' && it == 'Siaga' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Istiqlal berpotensi banjir!'
                // Siaga, Waspada, Waspada, Normal
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Waspada' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol berpotensi banjir!'
                // Waspada, Siaga, Waspada, Normal
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Waspada' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Manggarai berpotensi banjir!'
                // Siaga, Waspada, Normal, Waspada
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Normal' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol berpotensi banjir!'
                // Waspada, Siaga, Normal, Waspada
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Normal' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Manggarai berpotensi banjir!'
                // Normal, Siaga, Waspada, Waspada
            } else if (fa == 'Normal' && mg == 'Siaga' && it == 'Waspada' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Manggarai berpotensi banjir!'
                // Siaga, Normal, Waspada, Waspada
            } else if (fa == 'Siaga' && mg == 'Normal' && it == 'Waspada' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol berpotensi banjir!'
                // Waspada, Normal, Siaga, Waspada
            } else if (fa == 'Waspada' && mg == 'Normal' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Istiqlal berpotensi banjir!'
                // Normal, Waspada, Siaga, Waspada
            } else if (fa == 'Normal' && mg == 'Waspada' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Istiqlal berpotensi banjir!'
                // Waspada, Waspada, Normal, Siaga
            } else if (fa == 'Waspada' && mg == 'Waspada' && it == 'Normal' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Normal, Waspada, Waspada, Siaga
            } else if (fa == 'Normal' && mg == 'Waspada' && it == 'Waspada' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Waspada, Normal, Waspada, Siaga
            } else if (fa == 'Waspada' && mg == 'Normal' && it == 'Waspada' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'

                //2 Normal 1 Siaga 1 Waspada

                // Normal, Normal, Siaga, Waspada
            } else if (fa == 'Normal' && mg == 'Normal' && it == '' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Siaga, Normal, Normal, Waspada
            } else if (fa == 'Siaga' && mg == 'Normal' && it == 'Normal' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol berpotensi banjir!'
                // Normal, Siaga, Normal, Waspada
            } else if (fa == 'Normal' && mg == 'Siaga' && it == 'Normal' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Manggarai berpotensi banjir!'
                // Siaga, Normal, Waspada, Normal
            } else if (fa == 'Siaga' && mg == 'Normal' && it == 'Waspada' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol warga perlu waspada!'
                // Normal, Siaga, Waspada, Normal
            } else if (fa == 'Normal' && mg == 'Siaga' && it == 'Waspada' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Manggarai berpotensi banjir!'
                // Waspada, Siaga, Normal, Normal
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Normal' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Manggarai berpotensi banjir!'
                // Siaga, Waspada, Normal, Normal
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Normal' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol berpotensi banjir!'
                // Normal, Waspada, Siaga, Normal
            } else if (fa == 'Normal' && mg == 'Waspada' && it == 'Siaga' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Istiqlal berpotensi banjir!'
                // Waspada, Normal, Siaga, Normal
            } else if (fa == 'Waspada' && mg == 'Normal' && it == 'Siaga' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Istiqlal berpotensi banjir!'
                // Normal, Normal, Waspada, Siaga
            } else if (fa == 'Normal' && mg == 'Normal' && it == 'Waspada' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Waspada, Normal, Normal, Siaga
            } else if (fa == 'Waspada' && mg == 'Normal' && it == 'Normal' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'
                // Normal, Waspada, Normal, Siaga
            } else if (fa == 'Normal' && mg == 'Waspada' && it == 'Normal' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'

                // 1 Siaga 3 Waspada
            } else if (fa == 'Waspada' && mg == 'Waspada' && it == 'Waspada' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Waspada' && mg == 'Waspada' && it == 'Siaga' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Istiqlal berpotensi banjir!!'
            } else if (fa == 'Waspada' && mg == 'Siaga' && it == 'Waspada' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Manggarai berpotensi banjir!'
            } else if (fa == 'Siaga' && mg == 'Waspada' && it == 'Waspada' && jm == 'Waspada') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol berpotensi banjir!'
                // 1 Siaga 3 Normal
            } else if (fa == 'Normal' && mg == 'Normal' && it == 'Normal' && jm == 'Siaga') {
                pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'
            } else if (fa == 'Normal' && mg == 'Normal' && it == 'Siaga' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Istiqlal berpotensi banjir!!'
            } else if (fa == 'Normal' && mg == 'Siaga' && it == 'Normal' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Manggarai berpotensi banjir!'
            } else if (fa == 'Siaga' && mg == 'Normal' && it == 'Normal' && jm == 'Normal') {
                pesan = '[AWAS] Pada lokasi Flushing Ancol berpotensi banjir!'
                // 2 Waspada 2 Normal

                // Waspada, Waspada, Normal, Normal
            } else if (fa == 'Waspada' && mg == 'Waspada' && it == 'Normal' && jm == 'Normal') {
                pesan = '[AMAN] Pada lokasi Flushing Ancol dan Manggarai warga perlu waspada!'
                // Normal, Waspada, Waspada, Normal
            } else if (fa == 'Normal' && mg == 'Waspada' && it == 'Waspada' && jm == 'Normal') {
                pesan = '[AMAN] Pada lokasi Manggarai dan Istiqlal warga perlu waspada!'
                // Waspada, Normal, Waspada, Normal
            } else if (fa == 'Waspada' && mg == 'Normal' && it == 'Waspada' && jm == 'Normal') {
                pesan = '[AMAN] Pada lokasi Flushing Ancol dan Istiqlal warga perlu waspada!'
                // Normal, Waspada, Normal, Waspada
            } else if (fa == 'Normal' && mg == 'Waspada' && it == 'Normal' && jm == 'Waspada') {
                pesan = '[AMAN] Pada lokasi Manggarai dan Jembatan Merah warga perlu waspada!'
                // Waspada, Normal, Normal, Waspada
            } else if (fa == 'Waspada' && mg == 'Normal' && it == 'Normal' && jm == 'Waspada') {
                pesan = '[AMAN] Pada lokasi Flushing Ancol dan Manggarai warga perlu waspada!'
                // Normal, Normal, Waspada, Waspada
            } else if (fa == 'Normal' && mg == 'Normal' && it == 'Waspada' && jm == 'Waspada') {
                pesan = '[AMAN] Pada lokasi Istiqlal dan Jembatan Merah warga perlu waspada!'

                // 1 Waspada 3 Normal
            } else if (fa == 'Normal' && mg == 'Normal' && it == 'Normal' && jm == 'Waspada') {
                pesan = '[AMAN] Pada lokasi Jembatan Merah warga perlu waspada!'
            } else if (fa == 'Normal' && mg == 'Normal' && it == 'Waspada' && jm == 'Normal') {
                pesan = '[AMAN] Pada lokasi Istiqlal warga perlu waspada!'
            } else if (fa == 'Normal' && mg == 'Waspada' && it == 'Normal' && jm == 'Normal') {
                pesan = '[AMAN] Pada lokasi Manggarai warga perlu waspada!'
            } else if (fa == 'Waspada' && mg == 'Normal' && it == 'Normal' && jm == 'Normal') {
                pesan = '[AMAN] Pada lokasi Flushing Ancol warga perlu waspada!'
            } else {
                pesan = '[AMAN] DAS Ciliwung tidak memiliki potensi banjir!'
            }
        }
        return pesan
    }

    var oldkl = <?= $oldkl ?>;
    var oldfa = <?= $oldfa ?>;
    var oldmg = <?= $oldmg ?>;
    var oldit = <?= $oldit ?>;
    var oldjm = <?= $oldjm ?>;

    var kl = <?= $kl ?>;
    var fa = <?= $fa ?>;
    var mg = <?= $mg ?>;
    var it = <?= $it ?>;
    var jm = <?= $jm ?>;

    var predkl = prediksiKetinggian(<?= $oldkl ?>, <?= $kl ?>);
    var predfa = prediksiKetinggian(<?= $oldfa ?>, <?= $fa ?>);
    var predmg = prediksiKetinggian(<?= $oldmg ?>, <?= $mg ?>);
    var predit = prediksiKetinggian(<?= $oldit ?>, <?= $it ?>);
    var predjm = prediksiKetinggian(<?= $oldjm ?>, <?= $jm ?>);

    var statkl = Katulampa(predkl);
    var statfa = FlushingAncol(predfa);
    var statmg = Manggarai(predmg);
    var statit = Istiqlal(predit);
    var statjm = JembatanMerah(predjm);

    document.getElementById("statuskl1").innerHTML = Katulampa(oldkl);
    document.getElementById("statusfa1").innerHTML = FlushingAncol(oldfa);
    document.getElementById("statusmg1").innerHTML = Manggarai(oldmg);
    document.getElementById("statusit1").innerHTML = Istiqlal(oldit);
    document.getElementById("statusjm1").innerHTML = JembatanMerah(oldjm);

    document.getElementById("statuskl2").innerHTML = Katulampa(kl);
    document.getElementById("statusfa2").innerHTML = FlushingAncol(fa);
    document.getElementById("statusmg2").innerHTML = Manggarai(mg);
    document.getElementById("statusit2").innerHTML = Istiqlal(it);
    document.getElementById("statusjm2").innerHTML = JembatanMerah(jm);

    document.getElementById("statuskl3").innerHTML = prediksiKetinggian(oldkl, kl);
    document.getElementById("statusfa3").innerHTML = prediksiKetinggian(oldfa, fa);
    document.getElementById("statusmg3").innerHTML = prediksiKetinggian(oldmg, mg);
    document.getElementById("statusit3").innerHTML = prediksiKetinggian(oldit, it);
    document.getElementById("statusjm3").innerHTML = prediksiKetinggian(oldjm, jm);

    document.getElementById("statuskl4").innerHTML = Katulampa(prediksiKetinggian(oldkl, kl));
    document.getElementById("statusfa4").innerHTML = FlushingAncol(prediksiKetinggian(oldfa, fa));
    document.getElementById("statusmg4").innerHTML = Manggarai(prediksiKetinggian(oldmg, mg));
    document.getElementById("statusit4").innerHTML = Istiqlal(prediksiKetinggian(oldit, it));
    document.getElementById("statusjm4").innerHTML = JembatanMerah(prediksiKetinggian(oldjm, jm));

    var pintukl = pintuAirkl(Katulampa(kl));
    var pintufa = pintuAirfa(FlushingAncol(fa));
    var pintumg = pintuAirmg(Manggarai(mg));
    var pintuit = pintuAirit(Istiqlal(it));
    var pintujm = pintuAirjm(JembatanMerah(jm));

    document.getElementById("PAkl").innerHTML = pintukl;
    document.getElementById("PAfa").innerHTML = pintufa;
    document.getElementById("PAmg").innerHTML = pintumg;
    document.getElementById("PAit").innerHTML = pintuit;
    document.getElementById("PAjm").innerHTML = pintujm;

    var hasil = prediksiBanjir(statkl, statfa, statmg, statit, statjm);
    document.getElementById("hasil").innerHTML = hasil;
</script>

</html>