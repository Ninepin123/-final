<?php
session_start();
include("connection.php");

if (isset($_GET["item_id"]) && isset($_GET["quantity"])) {
    $item_id = $_GET["item_id"];
    $quantity = $_GET["quantity"];

    // 查詢商品資訊
    $sql_query = "SELECT * FROM menu_items WHERE id='" . $item_id . "'";
    $result = mysql_query($sql_query);

    if ($result && mysql_num_rows($result) > 0) {
        $row = mysql_fetch_array($result);
        $item_name = $row["name"];
        $item_price = $row["price"];

        // 初始化購物車
        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = [];
        }

        // 加入或更新購物車
        if (isset($_SESSION["cart"][$item_id])) {
            $_SESSION["cart"][$item_id]["quantity"] += $quantity;
        } else {
            $_SESSION["cart"][$item_id] = [
                "name" => $item_name,
                "price" => $item_price,
                "quantity" => $quantity
            ];
        }

        echo "<div class='alert alert-success text-center'>商品已加入購物車！</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>商品不存在！</div>";
    }
}

if (isset($_GET["action"]) && $_GET["action"] == "clear_cart") {
    unset($_SESSION["cart"]);
    echo "<div class='alert alert-warning text-center'>購物車已清空！</div>";
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>購物車</title>
    <!-- 引入 Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            flex: 1;
        }
        h1 {
            color: #343a40;
        }
        .table {
            margin-top: 20px;
        }
        .btn {
            border-radius: 20px;
        }
        footer {
            background-color: #222529;
            color: #ffffff;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
        .item-img {
            max-width: 50px;
            max-height: 50px;
            margin-right: 10px;
        }
        .item-name {
            display: flex;
            align-items: center;
        }
        td:nth-child(3) {
            width: 15%;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <h1 class="text-center mb-4">購物車</h1>

        <!-- 顯示購物車內容 -->
        <?php if (isset($_SESSION["cart"]) && count($_SESSION["cart"]) > 0): ?>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>商品名稱</th>
                        <th>單價</th>
                        <th>數量</th>
                        <th>總價</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $grand_total = 0; 
                    foreach ($_SESSION["cart"] as $item_id => $item): 
                        $total_price = $item["price"] * $item["quantity"];
                        $grand_total += $total_price;
                    ?>
                        <tr>
                            <td class="item-name">
                                <img src="assets/<?= htmlspecialchars($item_id) ?>.png" alt="商品圖片" class="item-img">
                                <?= htmlspecialchars($item["name"]) ?>
                            </td>
                            <td>$<?= number_format($item["price"], 2) ?></td>
                            <td><?= $item["quantity"] ?></td>
                            <td>$<?= number_format($total_price, 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center mt-4">
                <h3 class="text-end">總金額：$<?= number_format($grand_total, 2) ?></h3>
                <a href="?action=clear_cart" class="btn btn-danger">清空購物車</a>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center">購物車是空的。</div>
        <?php endif; ?>

        <!-- 返回菜單按鈕 -->
        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-primary">回到菜單</a>
        </div>
    </div>

    <footer>
        Copyright &copy; 網頁程式設計期末專題
    </footer>
</body>
</html>
