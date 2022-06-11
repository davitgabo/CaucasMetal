<?php $obj = new productController(); ?>
<?php $obj->getCategoryArray(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>პროდუქცია</title>
    <link rel="stylesheet" href="/View/public/css/main.css" />
    <link rel="icon" href="/View/images/favicon.ico" type="image/x-icon"/>
  </head>
  <body class="category-grid-template">
    <nav class="main-nav wrap">
      <a href="/">
        <img class="logo" src="/View/images/logo1.png" alt="" />
      </a>
      <ul>
        <li>
          <a href="/">
            <svg
              class="nav-svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M21 8.77217L14.0208 1.79299C12.8492 0.621414 10.9497 0.621413 9.77817 1.79299L3 8.57116V23.0858H10V17.0858C10 15.9812 10.8954 15.0858 12 15.0858C13.1046 15.0858 14 15.9812 14 17.0858V23.0858H21V8.77217ZM11.1924 3.2072L5 9.39959V21.0858H8V17.0858C8 14.8767 9.79086 13.0858 12 13.0858C14.2091 13.0858 16 14.8767 16 17.0858V21.0858H19V9.6006L12.6066 3.2072C12.2161 2.81668 11.5829 2.81668 11.1924 3.2072Z"
                fill="currentColor"
              />
            </svg>
            <span class="nav-text">მთავარი</span>
          </a>
        </li>
        <li>
          <a href="/">
            <svg
              class="nav-svg"
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              stroke-width="2"
              stroke="currentColor"
              fill="none"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <circle cx="12" cy="7" r="4"></circle>
              <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
            </svg>
            <span class="nav-text">კომპანია</span>
          </a>
        </li>
        <li>
          <a href="/ge/category">
            <svg
              class="nav-svg"
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              stroke-width="2"
              stroke="currentColor"
              fill="none"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <line x1="3" y1="21" x2="21" y2="21"></line>
              <path
                d="M3 7v1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1h-18l2 -4h14l2 4"
              ></path>
              <line x1="5" y1="21" x2="5" y2="10.85"></line>
              <line x1="19" y1="21" x2="19" y2="10.85"></line>
              <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4"></path>
            </svg>
            <span class="nav-text">პროდუქტი</span>
          </a>
        </li>
        <li>
          <a href="#footer">
            <svg
              class="nav-svg"
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              stroke-width="2"
              stroke="currentColor"
              fill="none"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path
                d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"
              ></path>
            </svg>
            <span class="nav-text">კონტაქტი</span>
          </a>
        </li>
      </ul>
    </nav>
    <main class="category wrap">
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
    <footer class="footer wrap" id="footer">
      <div>
        <p class="footer-header">მისამართი:</p>
        <address>თბილისი, რუსთავის გზატკეცილი #36</address>
        <br />
        <address>თბილისი, ქიზიყის #44</address>
        <br />
        <address>
          ბათუმი, ლერმონტოვის და ხიმშიაშვილის ქუჩების მიმდებარე ტერიტორია
        </address>
      </div>
      <div>
        <p class="footer-header">კონტაქტი:</p>
        <address>
          <a href="tel:032604141">(032) 260-41-41</a>
          <br />
          <br />
          <a href="mailto:giorgi.jalagania@caucasmetal.ge"
            >giorgi.jalagania@caucasmetal.ge</a
          >
          <br />
          <br />
          <a href="tel:+995551222356">(995) 551-222-356</a>
          <br />
          <br />
          <a href="mailto:g.kvintradze@caucasmetal.ge"
            >g.kvintradze@caucasmetal.ge</a
          >
          <br />
          <br />
          <a href="tel:+995568338833">(995) 568-338-833</a>
        </address>
      </div>
      <div>
        <p class="footer-header">სამუშაო საათები:</p>
        <div class="working-hours">
          <p>ორშაბათი - პარასკევი: <time>10:00</time> - <time>18:00</time></p>
          <br />
          <p>შაბათი: <time>10:00</time> - <time>16:00</time></p>
        </div>
      </div>
      <p class="copyright">
        Copyright &copy; 2022 All Rights Reserved by Caucasus Metal
      </p>
    </footer>
    <script type="text/javascript" src="/View/public/script/script.js"></script>
  </body>
</html>
