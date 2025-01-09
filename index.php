<?php
    include("connection.php");
    $select_db=@mysql_select_db("restaurant");
    if($select_db){
        echo '<br>找到資料庫!<br>';
        
    }
    else{
        echo '<br>找不到資料庫!<br>';
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>點餐系統</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">日式料理</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">主頁</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">關於</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">餐點清單</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="menu.html">所有餐點</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="#!">最近受歡迎餐點</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form method="GET" action="buycar.php">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill"></span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="py-5" style="background-image: url('assets/bg_title.png'); background-size: cover; background-position: center;">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">商品介紹</h1>
                    <p class="lead fw-normal text-white-50 mb-0">各式各樣海量美食等你來吃!</p>
                </div>
            </div>
        </header>
        
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="assets/7.png" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">炸物</h5>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <a class="btn btn-outline-dark mt-auto" href="#" data-bs-toggle="modal" data-bs-target="#friedmenuModal">點我到菜單</a>
                            </div>
                        </div>
                    </div>
<!-- Modal 結構 -->
<div class="modal fade" id="friedmenuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="menuModalLabel">菜單內容</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                // 連接資料庫並查詢資料
                $sql_query = "SELECT * FROM menu_items WHERE category_id=1";
                $result = mysql_query($sql_query);

                echo '<center><table width="100%" border="0">';
                $cnt = 0;
                while ($row = mysql_fetch_array($result)) {
                    $cnt++;
                    if ($cnt % 5 == 0) {
                        echo '<tr>';
                    }
                    echo '<td width="20%" style="text-align: center;">';
                    echo '<img src="assets/' . $row['id'] . '.png" width="100" height="100" class="menu-item" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" data-price="' . $row['price'] . '" style="cursor: pointer;"><br>';
                    echo $row['name'] . '<br>';
                    echo '$' . $row['price'];
                    echo '</td>';
                    if ($cnt % 5 == 0) {
                        echo '</tr>';
                    }
                }
                echo '</table>';
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
            </div>
        </div>
    </div>
</div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="assets/6.png" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">壽司</h5>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <a class="btn btn-outline-dark mt-auto" href="#" data-bs-toggle="modal" data-bs-target="#sushimenuModal">點我到菜單</a>
                            </div>
                        </div>
                    </div>
<!-- Modal 結構 -->
<div class="modal fade" id="sushimenuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="menuModalLabel">菜單內容</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                // 連接資料庫並查詢資料
                $sql_query = "SELECT * FROM menu_items WHERE category_id=2";
                $result = mysql_query($sql_query);

                echo '<center><table width="100%" border="0">';
                $cnt = 0;
                while ($row = mysql_fetch_array($result)) {
                    $cnt++;
                    if ($cnt % 5 == 0) {
                        echo '<tr>';
                    }
                    echo '<td width="20%" style="text-align: center;">';
                    echo '<img src="assets/' . $row['id'] . '.png" width="100" height="100" class="menu-item" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" data-price="' . $row['price'] . '" style="cursor: pointer;"><br>';
                    echo $row['name'] . '<br>';
                    echo '$' . $row['price'];
                    echo '</td>';
                    if ($cnt % 5 == 0) {
                        echo '</tr>';
                    }
                }
                echo '</table>';
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
            </div>
        </div>
    </div>
</div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="assets/3.png" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">烏龍麵</h5>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <a class="btn btn-outline-dark mt-auto" href="#" data-bs-toggle="modal" data-bs-target="#noodlemenuModal">點我到菜單</a>
                            </div>
                        </div>
                    </div>
<!-- Modal 結構 -->
<div class="modal fade" id="noodlemenuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="menuModalLabel">菜單內容</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                // 連接資料庫並查詢資料
                $sql_query = "SELECT * FROM menu_items WHERE category_id=3";
                $result = mysql_query($sql_query);

                echo '<center><table width="100%" border="0">';
                $cnt = 0;
                while ($row = mysql_fetch_array($result)) {
                    $cnt++;
                    if ($cnt % 5 == 0) {
                        echo '<tr>';
                    }
                    echo '<td width="20%" style="text-align: center;">';
                    echo '<img src="assets/' . $row['id'] . '.png" width="100" height="100" class="menu-item" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" data-price="' . $row['price'] . '" style="cursor: pointer;"><br>';
                    echo $row['name'] . '<br>';
                    echo '$' . $row['price'];
                    echo '</td>';
                    if ($cnt % 5 == 0) {
                        echo '</tr>';
                    }
                }
                echo '</table>';
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
            </div>
        </div>
    </div>
</div>

                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="assets/9.png" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">甜點</h5>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <a class="btn btn-outline-dark mt-auto" href="#" data-bs-toggle="modal" data-bs-target="#dessertmenuModal">點我到菜單</a>
                            </div>
                        </div>
                    </div>
<!-- Modal 結構 -->
<div class="modal fade" id="dessertmenuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="menuModalLabel">菜單內容</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                // 連接資料庫並查詢資料
                $sql_query = "SELECT * FROM menu_items WHERE category_id=4";
                $result = mysql_query($sql_query);

                echo '<center><table width="100%" border="0">';
                $cnt = 0;
                while ($row = mysql_fetch_array($result)) {
                    $cnt++;
                    if ($cnt % 5 == 0) {
                        echo '<tr>';
                    }
                    echo '<td width="20%" style="text-align: center;">';
                    echo '<img src="assets/' . $row['id'] . '.png" width="100" height="100" class="menu-item" data-id="' . $row['id'] . '" data-name="' . $row['name'] . '" data-price="' . $row['price'] . '" style="cursor: pointer;"><br>';
                    echo $row['name'] . '<br>';
                    echo '$' . $row['price'];
                    echo '</td>';
                    if ($cnt % 5 == 0) {
                        echo '</tr>';
                    }
                }
                echo '</table>';
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
            </div>
        </div>
    </div>
</div>
<!-- 動態彈窗 (數量輸入) -->
<div class="modal fade" id="quantityModal" tabindex="-1" aria-labelledby="quantityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="get" action="buycar.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="quantityModalLabel">輸入數量</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="item-name"></p>
                    <input type="hidden" name="item_id" id="item-id">
                    <div class="mb-3">
                        <label for="quantity" class="form-label">數量</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">送出</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- JavaScript -->
<script>
    // 當點擊商品圖片時，彈出數量輸入框
    document.querySelectorAll('.menu-item').forEach(item => {
        item.addEventListener('click', function () {
            const itemId = this.dataset.id;
            const itemName = this.dataset.name;

            // 設定彈窗內容
            document.getElementById('item-id').value = itemId;
            document.getElementById('item-name').innerText = "商品名稱: " + itemName;

            // 顯示數量輸入的彈窗
            const quantityModal = new bootstrap.Modal(document.getElementById('quantityModal'));
            quantityModal.show();
        });
    });
</script>                  
                </div>
                
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; 網頁程式設計期末專題</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
