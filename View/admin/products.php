<?php $obj = new productController(); ?>
<?php $obj->declareArrays(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>პროდუქცია</title>
    <link rel="stylesheet" href="/View/admin/css/admin.css">
    <link rel="icon" href="/View/images/favicon.ico" type="image/x-icon"/>
  </head>
  <body>
    <nav class="admin-nav">
      <ul class="admin-nav-ul">
        <li class="admin-nav-ul-list-items"><a href="/admin/category">კატეგორია</a></li>
        <li class="admin-nav-ul-list-items" onclick="dropdownToggle('hide')">პროდუქცია</li>
        <ul id='hide' class="hide">
            <?php $obj->navigationBar(); ?>
        </ul>
      </ul>
      <a href="/logout" id="logout">გასვლა</a>
    </nav>
    <!-- TODO Edit and remove buttons -->
    <table class="product-table">
            <thead>
                <tr>
                    <?php $obj->tableHeader('admin');?>
                    <th>
                        <h1>მოდიფიკაცია</h1>
                    </th>
                </tr>
            </thead>
            <tbody>
                    <?php $obj->tableInputForm();?>
                    <?php $obj->tableData('admin'); ?>
            </tbody>
    </table>

    <form class="category-dollar-value" action="/changeCategoryCurrency/<?= $obj->columnArray['tableName'];?>" method="post">
        <label for="currency">დოლარის კურსი: <?= $obj->categoryCurrency ?? null;?></label>
        <input type="text" name="CategoryCurrency" id="currency" placeholder="კატეგორიის დოლარის კურსი">
        <input type="submit" value="ატვირთე">
    </form>
    <script type="text/javascript" src="/View/admin/script/script.js"></script>
  </body>
</html>
