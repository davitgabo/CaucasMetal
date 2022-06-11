<?php
define("__ROOT__", __DIR__);

require_once __ROOT__."/Routing/autoLoader.php";
require_once __ROOT__."/Routing/router.php";

$router = new router();
$router->route("/", "navigation", "render", "/public/ge/home");
$router->route("/ge", "navigation", "render", "/public/ge/home");
$router->route("/ge/home", "navigation", "render", "/public/ge/home");
$router->route("/ge/category", "navigation", "render", "/public/ge/category");
$router->route("ge/product/{argument}", "navigation", "render", "/public/ge/product");
$router->route("/en", "navigation", "render", "/public/en/home");
$router->route("/en/home", "navigation", "render", "/public/en/home");
$router->route("/en/category", "navigation", "render", "/public/en/category");
$router->route("en/product/{argument}", "navigation", "render", "/public/en/product");
$router->route("/loginCheck", "userController", "login");
$router->route("/login", "navigation", "render", "/public/login");
$router->route("/admin/products", "navigation", "render", "/admin/products");
$router->route("/logout", "userController", "logout");
$router->route("/admin/category", "navigation", "render", "/admin/category");
$router->route("/createCategory", "productController", "createNewCategory");
$router->route("/changeCurrency", "productController", "changeCurrency");
$router->route("changeCategoryCurrency/{argument}", "productController", "changeCurrencyByCategory");
$router->route("admin/products/delete/{argument}", "productController", "deleteProduct");
$router->route("admin/products/{argument}", "navigation", "render", "/admin/products");
$router->route("addProduct/{argument}", "productController", "addNewProduct");
$router->route("admin/category/delete/{argument}", "productController", "deleteCategory");
$router->route("changeSortMethod/{argument}", "productController", "changeSortMethod");