<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">


  <link rel="apple-touch-icon" type="image/png" href="https://cpwebassets.codepen.io/assets/favicon/apple-touch-icon-5ae1a0698dcc2402e9712f7d01ed509a57814f994c660df9f7a952f3060705ee.png">

  <meta name="apple-mobile-web-app-title" content="CodePen">


  <link rel="mask-icon" type="image/x-icon" href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-b4b4269c16397ad2f0f7a01bcdf513a1994f4c94b8af2f191c09eb0d601762b1.svg" color="#111">


  <title> Invoice</title>

  <link rel="canonical" href="https://codepen.io/Swah43/pen/abQMERy">


  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700|Montserrat:300,400,700">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.3.1/css/foundation-flex.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <style>
    body {
      font-family: "Montserrat", sans-serif;
      font-weight: 400;
      color: #322d28;
    }

    header.top-bar h1 {
      font-family: "Montserrat", sans-serif;
    }

    main {
      margin-top: 4rem;
      min-height: calc(100vh - 107px);
    }

    main .inner-container {
      max-width: 800px;
      margin: 0 auto;
    }

    table.invoice {
      background: #fff;
    }

    table.invoice .num {
      font-weight: 200;
      text-transform: uppercase;
      letter-spacing: 1.5px;
      font-size: 0.8em;
    }

    table.invoice tr,
    table.invoice td {
      background: #fff;
      text-align: left;
      font-weight: 400;
      color: #322d28;
    }


    table.invoice tr.header td h2 {
      text-align: right;
      font-family: "Montserrat", sans-serif;
      font-weight: 200;
      font-size: 2rem;
      color: #1779ba;
    }

    table.invoice tr.intro td:nth-child(2) {
      text-align: right;
    }

    table.invoice tr.details>td {
      padding-top: 4rem;
      padding-bottom: 0;
    }

    table.invoice tr.details td.id,
    table.invoice tr.details td.qty,
    table.invoice tr.details th.id,
    table.invoice tr.details th.qty {
      text-align: center;
    }

    table.invoice tr.details td:last-child,
    table.invoice tr.details th:last-child {
      text-align: right;
    }

    table.invoice tr.details table thead,
    table.invoice tr.details table tbody {
      position: relative;
    }

    table.invoice tr.details table thead:after,
    table.invoice tr.details table tbody:after {
      content: "";
      height: 1px;
      position: absolute;
      width: 100%;
      left: 0;
      margin-top: -1px;
      background: #c8c3be;
    }

    table.invoice tr.totals td {
      padding-top: 0;
    }

    table.invoice tr.totals table tr td {
      padding-top: 0;
      padding-bottom: 0;
    }

    table.invoice tr.totals table tr td:nth-child(1) {
      font-weight: 500;
    }

    table.invoice tr.totals table tr td:nth-child(2) {
      text-align: right;
      font-weight: 200;
    }

    table.invoice tr.totals table tr:nth-last-child(2) td {
      padding-bottom: 0.5em;
    }

    table.invoice tr.totals table tr:nth-last-child(2) td:last-child {
      position: relative;
    }

    table.invoice tr.totals table tr:nth-last-child(2) td:last-child:after {
      content: "";
      height: 4px;
      border-top: 1px solid #1779ba;
      border-bottom: 1px solid #1779ba;
      position: relative;
      right: 0;
      bottom: -0.575rem;
      display: block;
    }

    table.invoice tr.totals table tr.total td {
      font-size: 1.2em;
      padding-top: 0.5em;
      font-weight: 700;
    }

    table.invoice tr.totals table tr.total td:last-child {
      font-weight: 700;
    }

    .additional-info h5 {
      font-size: 0.8em;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 2px;
      color: #1779ba;
    }

    table.invoice tr,
    table.invoice td {
      width: 49%;
    }

    .callout.large {
      width: 80%;
    }
  </style>


</head>


<body>
  <div class="row expanded">
    <main class="columns">
      <div class="inner-container">
        <section class="row align-center">
          <div class="callout large invoice-container">
            <table class="invoice">
              <tr class="header">
                <td class="">
                  <img src="<?= base_url() ?>mystyle/fiesta.jpg" width="200px">
                </td>
                <td class="align-right">
                  <h2>Invoice</h2>
                  <h3 style="text-align:right; color:#ADE792; font-size:20px">LUNAS</h3>
                </td>
              </tr>
              <tr class="intro">
                <td class="text-right" width="100px">
                  Order #<?= $kd_pesanan ?>
                </td>
              </tr>
              <tr>
                <td width="60px">
                  Nama : <?= $user->nama_pembeli ?>
                  <br>
                  Telepon : <?= $user->telp ?>
                  <br>
                  Alamat : <?= $user->alamat ?>
                </td>
              </tr>
            </table>
            <table>
              <thead>
                <tr>
                  <th>Nama Barang</th>
                  <th>Harga</th>
                  <th>Qty</th>
                  <th class="amt">Subtotal</th>
                </tr>
              </thead>
              <tbody>
                <?php $total_harga = 0; ?>
                <?php foreach ($orders as $v) : ?>
                  <tr class="item">
                    <td><?= $v->nama_barang ?></td>
                    <td><?= $v->harga_jual ?></td>
                    <td><?= $v->jml_barang ?></td>
                    <td>Rp <?= number_format($v->total_harga) ?></td>
                  </tr>
                  <?php $total_harga = $total_harga + $v->total_harga ?>
                <?php endforeach; ?>
              </tbody>
              <tfoot>
                <tr class="totals">
                  <td colspan="3">Total</td>
                  <td class="qty">Rp <?= number_format($total_harga) ?></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </section>
      </div>
    </main>
  </div>
  <br><br><br><br><br>
  <script type="text/javascript">
    window.print();
  </script>
</body>

</html>