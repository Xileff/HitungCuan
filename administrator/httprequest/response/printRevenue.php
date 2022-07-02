<?php
require_once '../../../logic/dbconn.php';
require_once '../../../logic/functions.php';
require_once '../../../libs/TCPDF-main/tcpdf.php';

if ($_GET['action'] == 'download') {
  // id, id paket,  ama paket, nominal
  $dateBegin = htmlspecialchars(stripslashes($_GET['dateStart']));
  $dateEnd = htmlspecialchars(stripslashes($_GET['dateEnd']));
  $limit = htmlspecialchars(stripslashes($_GET['limit']));
  $selectOrder = htmlspecialchars(stripslashes($_GET['order']));

  $dateBegin = mysqli_real_escape_string($conn, $dateBegin);
  $dateEnd = mysqli_real_escape_string($conn, $dateEnd);
  $limit = mysqli_real_escape_string($conn, $limit);
  $selectOrder = mysqli_real_escape_string($conn, $selectOrder);

  $regexDate = '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';
  if (!preg_match($regexDate, $dateBegin) || !preg_match($regexDate, $dateEnd)) {
    $res['msg'] = 'Format tanggal tidak benar';
    echo json_encode($res);
    return;
  }

  if (!in_array($selectOrder, ['asc', 'desc'])) {
    $res['msg'] = 'Input tidak valid';
    echo json_encode($res);
    return;
  }

  $strSql = "SELECT r.id, p.id AS id_paket, p.nama, r.tanggal, r.nominal 
            FROM tbl_revenue r 
            JOIN tbl_packet p 
            ON r.id_packet = p.id 
            WHERE r.tanggal >= '$dateBegin' AND r.tanggal <= '$dateEnd'  
            ORDER BY r.tanggal $selectOrder
            LIMIT $limit;";

  $revenue = $conn->query($strSql);

  // Pdf
  $pdfRevenue = generatePdf('HitungCuan', 'Revenue', 'Rincian Penghasilan');
  $montserratRegular = TCPDF_FONTS::addTTFfont('../../../assets/fonts/montserrat/Montserrat-Regular.ttf', 'TrueTypeUnicode', '', 96);
  $montserratBold = TCPDF_FONTS::addTTFfont('../../../assets/fonts/montserrat/Montserrat-Bold.ttf', 'TrueTypeUnicode', '', 96);

  $pdfRevenue->AddPage();

  // Judul pdf
  $pdfRevenue->SetFont($montserratBold, '', 20, '', false);
  $title = '<h1 style="text-align:center;">Revenue HitungCuan</h1>';
  $pdfRevenue->writeHTML($title, true, false, true, false, '');

  // Range tanggal di bawah judul
  $pdfRevenue->SetFont($montserratRegular, '', 14, '', false);
  $range = '<br><h3 style="text-align:center; font-weight: regular; margin-top: 25px;">' . tgl_indo($dateBegin) . " s.d. " . tgl_indo($dateEnd) . "</h1><hr><br>";
  $pdfRevenue->writeHTML($range, true, false, true, false, '');

  // Tabel
  $pdfRevenue->SetFont($montserratRegular, '', 12, '', false);
  $tableRevenue = '
<table border="1" cellpadding="3" style="text-align: center;">
  <thead>
    <tr style="background-color: #D3D3D3;">
      <th >ID</th>
      <th >ID Paket</th>
      <th >Nama paket</th>
      <th >Tanggal</th>
      <th >Nominal</th>
    </tr>
  </thead>
  <tbody>
  ';

  $totalRevenue = 0;
  while ($rev = $revenue->fetch_assoc()) {
    $id = $rev['id'];
    $idPaket = $rev['id_paket'];
    $namaPaket = $rev['nama'];
    $tanggal = tgl_indo($rev['tanggal']);
    $totalRevenue += $rev['nominal'];
    $nominal = rupiah($rev['nominal']);

    $tableRevenue .= "
    <tr>
      <td>$id</td>
      <td>$idPaket</td>
      <td>$namaPaket</td>
      <td>$tanggal</td>
      <td>$nominal</td>
    </tr>
    ";
  }

  $tableRevenue .= '
    </tbody>
</table>
<h1 style="text-align:center;">' . rupiah($totalRevenue) . '</h1>';

  $pdfRevenue->writeHTML($tableRevenue, true, false, true, false, '');
  $pdfRevenue->lastPage();

  $fileName = "Revenue_Hitungcuan_" . $dateBegin . "_" . $dateEnd . ".pdf";
  $pdfRevenue->Output(dirname(__FILE__) . '../revenueReport/' . $fileName, 'F');

  echo json_encode(['fileName' => $fileName]);
}

// Hapus file yg udh didownload dari server, biar ga penuh
else if ($_GET['action'] == 'delete') {
  $fileName = $_GET['fileName'];
  unlink('revenueReport/' . $fileName);
}
