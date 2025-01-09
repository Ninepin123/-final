<script>
    // 初始化購物車
    let cart = [];

    // 當點擊商品圖片時，彈出數量輸入框
    document.querySelectorAll('.menu-item').forEach(item => {
        item.addEventListener('click', function () {
            const itemId = this.dataset.id;
            const itemName = this.dataset.name;
            const itemPrice = this.dataset.price;

            // 彈出數量輸入框
            const quantity = parseInt(prompt(`請輸入 ${itemName} 的數量：`, 1));
            if (quantity > 0) {
                // 檢查商品是否已在購物車中
                const existingItem = cart.find(cartItem => cartItem.id === itemId);
                if (existingItem) {
                    existingItem.quantity += quantity;
                } else {
                    cart.push({
                        id: itemId,
                        name: itemName,
                        price: parseFloat(itemPrice),
                        quantity: quantity
                    });
                }
                updateCartUI();
            } else {
                alert('請輸入有效的數量！');
            }
        });
    });

    // 更新購物車 UI
    function updateCartUI() {
        const cartCount = cart.reduce((count, item) => count + item.quantity, 0);
        document.getElementById('cartCount').innerText = cartCount;

        const cartItemsDiv = document.getElementById('cartItems');
        const cartTotalDiv = document.getElementById('cartTotal');
        cartItemsDiv.innerHTML = '';
        let total = 0;

        cart.forEach(item => {
            const itemTotal = item.price * item.quantity;
            total += itemTotal;

            cartItemsDiv.innerHTML += `
                <div>
                    ${item.name} - $${item.price.toFixed(2)} x ${item.quantity} = $${itemTotal.toFixed(2)}
                </div>
            `;
        });

        cartTotalDiv.innerText = `總價: $${total.toFixed(2)}`;

        // 更新隱藏表單的購物車數據
        document.getElementById('cartData').value = JSON.stringify(cart);
    }
</script>
