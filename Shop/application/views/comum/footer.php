<script>
  document.addEventListener("DOMContentLoaded", function () {
    var cartDialog = document.querySelector("dialog");
    var cartItemsList = document.getElementById("cartItems");

    document.querySelector(".fas.fa-shopping-cart").onclick = () => {
      cartDialog.showModal();
      updateCartItems();
    };

    
    function updateCartCount() {
      fetch("<?php echo site_url('cart/count'); ?>")
        .then(response => response.text())
        .then(count => {
          var cartCountElement = document.getElementById("cartCount");
          if (cartCountElement) {
            cartCountElement.textContent = count;
          }
        });
    }

    
    updateCartCount();

    
    <?php if(isset($product)): ?>
      document.getElementById("addToCartForm").addEventListener("submit", function(event) {
        event.preventDefault();

        var productID = <?php echo $product->id; ?>;
        var formData = new FormData();
        formData.append("product_id", productID);

        
        fetch("<?php echo site_url('cart/add'); ?>", {
          method: "POST",
          body: formData
        })
          .then(response => response.text())
          .then(() => {
            
            updateCartCount();

            
          })
          .catch(error => {
            console.error("Error:", error);
          });
      });
    <?php endif; ?>
  });
</script>
</body>
</html>
