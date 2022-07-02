<?php
session_start();
require '../../logic/dbconn.php';
require '../../logic/functions.php';
require '../../libs/TCPDF-main/tcpdf.php';

if ($_GET['action'] == 'download') {
    $userId = $conn->query("SELECT id FROM tbl_users WHERE username = '" . $_SESSION['username'] . "'")->fetch_assoc()['id'];

    $transactionData = $conn->query(
        "SELECT s.transaction_code, s.id_packet, p.nama AS nama_packet, p.harga, s.id_user, u.username, s.start_date, s.expire_date
    FROM tbl_subscription s
    JOIN tbl_packet p ON s.id_packet = p.id
    JOIN tbl_users u ON  s.id_user = u.id
    WHERE s.id_user = $userId
    "
    )->fetch_assoc();

    $pdfTransaction = generatePdf('HitungCuan', 'Bukti Transaksi', 'Membership');

    $montserratRegular = TCPDF_FONTS::addTTFfont('../../assets/fonts/montserrat/Montserrat-Regular.ttf', 'TrueTypeUnicode', '', 96);
    $montserratBold = TCPDF_FONTS::addTTFfont('../../assets/fonts/montserrat/Montserrat-Bold.ttf', 'TrueTypeUnicode', '', 96);

    $pdfTransaction->AddPage();

    // Judul pdf
    $pdfTransaction->SetFont($montserratBold, '', 20, '', false);
    $title = '<h1 style="text-align:center;">Membership HitungCuan</h1><br>';
    $pdfTransaction->writeHTML($title, true, false, true, false, '');

    $pdfTransaction->SetFont($montserratRegular, '', 14, '', false);
    $dataTable = "
    <table>
        <tr>
            <td>Kode Transaksi</td>
            <td>" . " : " . $transactionData['transaction_code'] . "</td>
        </tr>
        <tr>
            <td>ID Paket</td>
            <td>" . " : " . $transactionData['id_packet'] . "</td>
        </tr>
        <tr>
            <td>Nama Paket</td>
            <td>" . " : " . $transactionData['nama_packet'] . "</td>
        </tr>
        <tr>
            <td>Harga Paket</td>
            <td>" . " : " . rupiah($transactionData['harga']) . "</td>
        </tr>
        <tr>
            <td>ID User</td>
            <td>" . " : " . $transactionData['id_user'] . "</td>
        </tr>
        <tr>
            <td>Username</td>
            <td>" . " : " . $transactionData['username'] . "</td>
        </tr>
        <tr>
            <td>Tanggal Pembelian</td>
            <td>" . " : " . tgl_indo($transactionData['start_date']) . "</td>
        </tr>
        <tr>
            <td>Tanggal Expire</td>
            <td>" . " : " . tgl_indo($transactionData['expire_date']) . "</td>
        </tr>
    </table>
    <br>
    ";

    $pdfTransaction->writeHTML($dataTable, true, false, true, false, '');

    $closingStatement =
        '<br>
    <h1 style="text-align:center;">Terimakasih sudah menjadi customer kami</h1>
    <br>';
    $pdfTransaction->writeHTML($closingStatement, true, false, true, false, '');

    $ttd = '
    <table>
        <tr>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
                <img src="../../assets/images/developerAutograph.png" alt="image" style="width: 100px">
            </td>
        </tr>
    </table>
    ';
    $pdfTransaction->writeHTML($ttd, true, false, true, false, '');

    $pdfTransaction->lastPage();
    // kode transaksi
    // id paket
    // nama paket
    // harga paket
    // id user
    // username
    // tanggal start
    // tanggal expire

    // Simpan di folder
    $fileName = "HitungCuan_Membership_" . $transactionData['transaction_code'] . ".pdf";
    $pdfTransaction->Output(dirname(__FILE__) . '../pdfTransaction/' . $fileName, 'F');

    $res['success'] = false;
    if (file_exists('pdfTransaction/' . $fileName)) {
        $res['success'] = true;
        $res['fileName'] = $fileName;
    }
    echo json_encode($res);
}
