<?php $obj = new productController(); ?>
<?php $obj->getCategoryArray(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>კატეგორია</title>
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
    <div class="category-container" id="category-container">
      <label class="add-category-button" onclick="hide('category-container')">
        <svg class="plus-svg" width="24" height="24" viewBox="0 0 24 24"
         fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M12 4C11.4477 4 11 4.44772 11 5V11H5C4.44772 11 4 11.4477 4 12C4
             12.5523 4.44772 13 5 13H11V19C11 19.5523 11.4477 20 12 20C12.5523
              20 13 19.5523 13 19V13H19C19.5523 13 20 12.5523 20 12C20 11.4477
               19.5523 11 19 11H13V5C13 4.44772 12.5523 4 12 4Z"
                fill="currentColor">
        </svg>
      </label>
      <?php foreach ($obj->categoryArray as $value): ?>

        <div class="category-element">
            <a href="/admin/products/<?=$value['EngName']?>">
          <img class="category-element-image" src="/View/images/<?=$value['ImagePath']?> ">
            </a>
          <div class="category-name-container">
            <h3 class="category-element-name"><?=str_replace('_', ' ', $value['Name'])?></h3>
          </div>
          <a class="remove-category" onclick="confirmRemove('<?=$value['Name']?>','/admin/category/delete/<?=$value['EngName']?>')" ><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.2253 4.81108C5.83477 4.42056 5.20161 4.42056 4.81108 4.81108C4.42056 5.20161 4.42056 5.83477 4.81108 6.2253L10.5858 12L4.81114 17.7747C4.42062 18.1652 4.42062 18.7984 4.81114 19.1889C5.20167 19.5794 5.83483 19.5794 6.22535 19.1889L12 13.4142L17.7747 19.1889C18.1652 19.5794 18.7984 19.5794 19.1889 19.1889C19.5794 18.7984 19.5794 18.1652 19.1889 17.7747L13.4142 12L19.189 6.2253C19.5795 5.83477 19.5795 5.20161 19.189 4.81108C18.7985 4.42056 18.1653 4.42056 17.7748 4.81108L12 10.5858L6.2253 4.81108Z" fill="currentColor" /></svg></a>
          <!-- TODO After clicking category remove button confirmation dialog -->
        </div>
      <?php endforeach; ?>
    </div>
    <form class="add-category" id="add-category" action="/createCategory" method="post" enctype="multipart/form-data">
      <a class="close" href="/admin/category"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.2253 4.81108C5.83477 4.42056 5.20161 4.42056 4.81108 4.81108C4.42056 5.20161 4.42056 5.83477 4.81108 6.2253L10.5858 12L4.81114 17.7747C4.42062 18.1652 4.42062 18.7984 4.81114 19.1889C5.20167 19.5794 5.83483 19.5794 6.22535 19.1889L12 13.4142L17.7747 19.1889C18.1652 19.5794 18.7984 19.5794 19.1889 19.1889C19.5794 18.7984 19.5794 18.1652 19.1889 17.7747L13.4142 12L19.189 6.2253C19.5795 5.83477 19.5795 5.20161 19.189 4.81108C18.7985 4.42056 18.1653 4.42056 17.7748 4.81108L12 10.5858L6.2253 4.81108Z" fill="currentColor" /></svg></a>
      <div class="image-preview-container">
        <!-- TODO Image upload validation -->
        <!-- TODO ADD Empty Image Placeholder -->
        <img id='image-preview' src='https://source.unsplash.com/featured?technology'>
        <div class="upload-image">

          <input class="upload-category-image" type="file" name="image" id="file" class="file" required>
          <label class="upload-category-image-label" for="file" class="input-file-label">ატვირთე ფოტო</label>
        </div>
      </div>
      <div class="input-fields-container" id='input-fields-container'>
        <div class="two-columns" id="two-columns">
          <input required class="category-input-text" type="text" name="nameGeo" placeholder="კატეგორიის სახელი">
          <input required class="category-input-text" type="text" name="nameEng" placeholder="Category Name">
          <input required class="category-input-text" type="text" name="PriceGeo" placeholder="კატეგორიის ფასი" id="price">
          <input required class="category-input-text" type="text" name="PriceEng" placeholder="Category Price">
          <textarea name="DescGeo" rows="4" cols="20" placeholder="კატეგორიის აღწერა" ></textarea>
          <textarea name="DescEng" rows="4" cols="20" placeholder="Category description" ></textarea>
        </div>
        <button class="input-add" id="input-add" type="button" onclick="addInputField('two-columns')">+</button>
      </div>
      <!-- TODO Show green success bar on submit and go to product page -->
      <input class="add-category-submit" type="submit" value="ატვირთე" name="uploadData">
    </form>
    <form class="category-dollar-value" action="/changeCurrency" method="post">
        <label for="currency">დოლარის კურსი: <?=$obj->mainCurrency['Currency']?></label>
        <input type="text" name="mainCurrency" id="currency" placeholder="კატეგორიის დოლარის კურსი">
      <input type="submit" value="ატვირთე">
    </form>
    <script type="text/javascript" src="/View/admin/script/script.js"></script>
  </body>
</html>
