<?php $obj = new productController(); ?>
<?php $obj->getCategoryArray(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <title>პროდუქცია</title>
    <link rel="stylesheet" href="/View/public/css/main.css" />
    <link rel="icon" href="/View/images/favicon.ico" type="image/x-icon"/>
  </head>
  <body class="category-grid-template">
    <nav class="main-nav wrap">
      <a href="/"><img src="/View/images/logo1.png" /></a>
      <ul class="nav-list">
        <li><a href="/">მთავარი</a></li>
        <li><a href="#">კომპანია</a></li>
        <li><a id="products" href="/ge/category">პროდუქცია</a></li>
        <li><a href="#">კონტაქტი</a></li>
      </ul>
    </nav>
    <main class="category">
      <?php foreach ($obj->categoryArray as $value): ?>
      <div class="category-container">
        <a href="/ge/product/<?=$value['EngName']?>">
          <img
            src="/View/images/<?=$value['ImagePath']?>"
            class="category-images"
          />
        </a>
        <h2 class="category-names">
          <?=str_replace('_', ' ', $value['Name'])?>
        </h2>
      </div>
      <?php endforeach; ?>
    </main>
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
