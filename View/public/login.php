<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <title>ავტორიზაცია</title>
    <link rel="stylesheet" href="View/public/css/login.css" />
    <link rel="icon" href="/View/images/favicon.ico" type="image/x-icon"/>
  </head>
  <body>
    <form action="/loginCheck" method="post" class="login-form">
      <img src="View/images/logo1.png" />
      <h4>ადმინ<span>პანელი</span></h4>
      <input
        type="text"
        name="username"
        placeholder="მომხმარებლის სახელი"
        autocomplete="off"
      />
      <input
        type="password"
        name="password"
        placeholder="პაროლი"
        autocomplete="off"
      />
      <input type="submit" value="შესვლა" class="login-submit-button" />
      <a href="#" class="forgot-password">პაროლი დაგავიწყდა?</a>
    </form>
  </body>
</html>
