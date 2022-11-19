<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['order'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = 'Số '. $_POST['flat'] .', '. $_POST['street'] .', '. $_POST['city'] .', '. $_POST['state'] .', '. $_POST['country'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $placed_on = date('d/m/Y');

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $cart_query->execute([$user_id]);
   if($cart_query->rowCount() > 0){
      while($cart_item = $cart_query->fetch(PDO::FETCH_ASSOC)){
         $cart_products[] = $cart_item['name'].' ( '.$cart_item['quantity'].' )';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      };
   };

   $total_products = implode(', ', $cart_products);

   $order_query = $conn->prepare("SELECT * FROM `orders` WHERE name = ? AND number = ? AND email = ? AND method = ? AND address = ? AND total_products = ? AND total_price = ?");
   $order_query->execute([$name, $number, $email, $method, $address, $total_products, $cart_total]);

   if($cart_total == 0){
      $message[] = 'Giỏ hàng còn trống';
   }elseif($order_query->rowCount() > 0){
      $message[] = 'Đã đặt hàng!';
   }else{
      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES(?,?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $cart_total, $placed_on]);
      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);
      $message[] = 'Đặt hàng thành công!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Đặt hàng</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" />

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
		.btn {
			text-color: white;
		}
      .error{
         font-size: 200%;
      }
      .is-valid{
         border-radius: 5px;
         background-color: green;
      }
      /* <div id="number-error" class="error invalid-feedback">Bạn chưa nhập số điện thoại</div> */
   </style>
</head>
<body>
   
<?php include 'header.php'; ?>

<section class="display-orders">

   <?php
      $cart_grand_total = 0;
      $select_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $select_cart_items->execute([$user_id]);
      if($select_cart_items->rowCount() > 0){
         while($fetch_cart_items = $select_cart_items->fetch(PDO::FETCH_ASSOC)){
            $cart_total_price = ($fetch_cart_items['price'] * $fetch_cart_items['quantity']);
            $cart_grand_total += $cart_total_price;
   ?>
   <p> <?= $fetch_cart_items['name']; ?> <span>(<?= $fetch_cart_items['price'].'đ x '. $fetch_cart_items['quantity']; ?>)</span> </p>
   <?php
    }
   }else{
      echo '<p class="empty">Giỏ hàng còn trống!</p>';
   }
   ?>
   <div class="grand-total">Tổng: <span><?= $cart_grand_total; ?>đ</span></div>
</section>

<section class="checkout-orders">

   <form action="" method="POST" id="checkoutform">

      <h3>Đặt hàng</h3>

      <div class="flex">
         <div class="inputBox">
            <span>Tên:</span>
            <input type="text" name="name" placeholder="Nhập tên" class="box">
         </div>
         <div class="inputBox">
            <span>Số điện thoại:</span>
            <input type="number" name="number" placeholder="Nhập số điện thoại" class="box">
         </div>
         <div class="inputBox">
            <span>Email:</span>
            <input type="email" name="email" placeholder="Nhập email" class="box">
         </div>
         <div class="inputBox">
            <span>Phương thức thanh toán:</span>
            <select name="method" class="box" required>
               <option value="Tiền mặt">Tiền mặt</option>
               <option value="Thẻ ATM">Thẻ ATM</option>
               <option value="Internet Baking">Internet Baking</option>
               <option value="Paypal">Paypal</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Số nhà:</span>
            <input type="text" name="flat" placeholder="vd: 2/40C" class="box">
         </div>
         <div class="inputBox">
            <span>Tên đường:</span>
            <input type="text" name="street" placeholder="vd: 3 tháng 2" class="box">
         </div>
         <div class="inputBox">
            <span>Tên phường/xã:</span>
            <input type="text" name="city" placeholder="vd: Hưng Lợi" class="box">
         </div>
         <div class="inputBox">
            <span>Tên quận/huyện:</span>
            <input type="text" name="state" placeholder="vd: Ninh Kiều" class="box">
         </div>
         <div class="inputBox">
            <span>Tên tỉnh/thành phố:</span>
            <input type="text" name="country" placeholder="vd: Cần Thơ" class="box">
         </div>
         <div class="inputBox">
            <span>Mã xác nhận:</span>
            <input type="number" min="0" name="pin_code" placeholder="vd: 147369" class="box">
         </div>
      </div>

      <input type="submit" name="order" class="btn <?= ($cart_grand_total > 1)?'':'disabled'; ?>" value="Đặt">

   </form>

</section>








<?php include 'footer.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/script.js"></script>
<script src="js/jquery.validate.js"></script>
<script type="text/javascript">
		$(document).ready(function () {
			$.validator.setDefaults({
				submitHander: function () { alert("Submitted"); }
			});
			$(document).ready(function () {
				$("#checkoutform").validate({
					rules: {
						name: "required",
						number: { required: true, maxlength: 10,minlength: 10 },
						email: { required: true, email: true },
						method: "required",
						flat: "required",
                  street: "required",
                  city: "required",
                  state: "required",
                  country: "required",
                  pin_code: "required"
					},
					messages: {
						name: "Bạn chưa nhập vào tên của bạn",
                  number: {
                     required: "Bạn chưa nhập số điện thoại", 
                     maxlength:"Số điên thoại phải có 10 số",
                     minlength:"Số điên thoại phải có 10 số"
                  },
						
						email: "Hộp thư điện tử không hợp lệ",
						method: "Bạn chưa chọn phương thức thanh toán",
						flat: "Bạn chưa nhập số nhà",
                  street: "Bạn chưa nhập tên đường",
                  city: "Bạn chưa nhập phường,xã",
                  state: "Bạn chưa nhập quận,huyện",
                  country: "Bạn chưa nhập tên tỉnh",
                  pin_code: "Bạn chưa nhập mã pin"
					},
					errorElement: "div",
					errorPlacement: function (error, element) {
						error.addClass("invalid-feedback");
						if (element.prop("type") === "checkbox") {
							error.insertAfter(element.siblings("labels"));
						} else {
							error.insertAfter(element);
						}
					},
					highlight: function (element, errorClass, validClass) {
						$(element).addClass("is-invalid").removeClass("is-valid");
					},
					unhighlight: function (element, errorClass, validClass) {
						$(element).addClass("is-valid").removeClass("is-invalid");
					}
				})
			});
		});
	</script>

</body>
</html>