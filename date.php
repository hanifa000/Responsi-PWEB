<?php
//timezone!!
date_default_timezone_set('Asia/Jakarta');

//prev & next bulan
if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    //Bulan ini
    $ym = date('Y-m');
}

//cek format
$wkt = strtotime($ym . '-01');  //hari pertama bulan ini
if ($wkt === false) {
    $ym = date('Y-m');
    $wkt = strtotime($ym . '-01');
}

//hari ini(Format:2022-07-19)
$today = date('Y-m-j');

//judul(Format:July, 2022)
$title = date('F, Y', $wkt);

//buat prev & next link untuk bulan
$prev = date('Y-m', strtotime('-1 month', $wkt));
$next = date('Y-m', strtotime('+1 month', $wkt));

//jumlah hari dlm sebulan
$hitung = date('t', $wkt);

//1:mon 2:tue 3: wed ... 7:sun
//kalo w ga berfungsi(?)
$str = date('N', $wkt);

//array u/ kalender
$minggu = [];
$week = '';

//cell(s) kosong/tgl bulan lalu
$week .= str_repeat('<td></td>', $str - 1);

for ($hari = 1; $hari <= $hitung; $hari++, $str++) {
    $tanggal = $ym . '-' . $hari;

    if ($today == $tanggal) {
        $week .= '<td class="today">';
    } else {
        $week .= '<td>';
    }
    $week .= $hari . '</td>';

    //minggu/akhir pekan
    if ($str % 7 == 0 || $hari == $hitung) {

        //hari terakhir bulan ini
        if ($hari == $hitung && $str % 7 != 0) {
            //tambah cell(s) kosong
            $week .= str_repeat('<td></td>', 7 - $str % 7);
        }

        $minggu[] = '<tr>' . $week . '</tr>';
        $week = '';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Calendar</title>
    <!--boostrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--font-->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@800&family=Poppins:wght@500;700&display=swap" rel="stylesheet">
    <style>
        /*body {
            background-color: floralwhite;
        }*/
        h1{
            margin:0;
            text-transform: uppercase;
            text-align: center;
        }
        .container {
            font-family: 'Open Sans', sans-serif;
            font-family: 'Poppins', sans-serif;
            margin: 60px auto;
        }
        .list-inline {
            text-align: center;
            margin-bottom: 30px;
        }
        .title {
            font-weight: bold;
            font-size: 26px;
        }
        th {
            text-align: center;
        }
        td {
            height: 100px;
        }
        th:nth-of-type(6), td:nth-of-type(6) {
            color: grey;
        }
        th:nth-of-type(7), td:nth-of-type(7) {
            color: red;
        }
        .today {
            background-color: floralwhite;
        }
    </style>
</head>
<body>
    <br><a href="index.html" style="color : brown;">&nbsp;>>back<<</a><br>
        <h1>kalender</h1>
        <p align="center"><i>"hari ini harus lebih baik dari hari kemarin"</i><br></p>
    <div class="container">
        <ul class="list-inline">
            <li class="list-inline-item"><a href="?ym=<?= $prev; ?>" class="btn btn-link">&lt; prev</a></li>
            <li class="list-inline-item"><span class="title"><?= $title; ?></span></li>
            <li class="list-inline-item"><a href="?ym=<?= $next; ?>" class="btn btn-link">next &gt;</a></li>
        </ul>
        <p class="text-right"><a href="date.php">Today</a></p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>M</th>
                    <th>T</th>
                    <th>W</th>
                    <th>T</th>
                    <th>F</th>
                    <th>S</th>
                    <th>S</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($minggu as $week) {
                        echo $week;
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>