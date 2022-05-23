<?php $obj = new productController(); ?>
<?php $obj->declareArrays(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <title>Product Name from php</title>
    <link rel="stylesheet" href="/View/public/css/main.css" />
    <link rel="icon" href="/View/images/favicon.ico" type="image/x-icon"/>
  </head>
  <body class="product-grid-template">
    <nav class="main-nav wrap">
      <a href="/"><img src="/View/images/logo1.png" /></a>
      <ul class="nav-list">
        <li><a href="/">Home</a></li>
        <li><a href="#">Company</a></li>
        <li><a id="products" href="/en/category">Products</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </nav>
    <div class="table-container">
      <table class="product-table">
        <thead>
          <tr>
            <?php $obj->tableHeader('en'); ?>
          </tr>
        </thead>
        <tbody>
            <?php $obj->tableData('en') ?>
        </tbody>
      </table>
    </div>
    <footer class="footer wrap">
      <div class="footer-column1">
        <p>მისამართი:</p>
        <address>
          <span class="orange-text">თბილისი</span>, რუსთავის გზატკეცილი #36
          <br />
          <span class="orange-text">თბილისი</span>, ქიზიყის #44
          <br />
          <span class="orange-text">ბათუმი</span>, ლერმონტოვის და ხიმშიაშვილის
          ქუჩების მიმდებარე ტერიტორია
        </address>
      </div>
      <div class="footer-column2">
        <p>კონტაქტი:</p>
        <address>
          <a href="tel:032604141">(032) 260-41-41</a>
          <a href="mailto:giorgi.jalagania@caucasmetal.ge"
            >giorgi.jalagania@caucasmetal.ge</a
          >
          <a href="tel:+995551222356">(995) 551-222-356</a>
          <a href="mailto:g.kvintradze@caucasmetal.ge"
            >g.kvintradze@caucasmetal.ge</a
          >
          <a href="tel:+995568338833">(995) 568-338-833</a>
        </address>
      </div>
      <div class="footer-column3">
        <p>სამუშაო საათები:</p>
        <div class="working-hours">
          <p>ორშაბათი: <time>10:00</time> - <time>18:00</time></p>
          <p>სამშაბათი: <time>10:00</time> - <time>18:00</time></p>
          <p>ოთხშაბათი: <time>10:00</time> - <time>18:00</time></p>
          <p>ხუთშაბათი: <time>10:00</time> - <time>18:00</time></p>
          <p>პარასკევი: <time>10:00</time> - <time>18:00</time></p>
          <p>შაბათი: <time>10:00</time> - <time>16:00</time></p>
        </div>
      </div>
      <p class="copyright-text">
        Copyright &copy; 2022 All Rights Reserved by
        <a href="#">Caucasus <span class="orange-text">Metal</span></a
        >.
      </p>
    </footer>
  </body>
</html>
