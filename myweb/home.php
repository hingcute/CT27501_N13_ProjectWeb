<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['add_to_wishlist'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);

   $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
   $check_wishlist_numbers->execute([$p_name, $user_id]);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_wishlist_numbers->rowCount() > 0){
      $message[] = 'Đã có trong mục yêu thích!';
   }elseif($check_cart_numbers->rowCount() > 0){
      $message[] = 'Đã có trong giỏ hàng!';
   }else{
      $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
      $insert_wishlist->execute([$user_id, $pid, $p_name, $p_price, $p_image]);
      $message[] = 'Đã thêm vào mục yêu thích!';
   }

}

if(isset($_POST['add_to_cart'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);
   $p_qty = $_POST['p_qty'];
   $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_cart_numbers->rowCount() > 0){
      $message[] = 'Đã có trong giỏ hàng!';
   }else{

      $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
      $check_wishlist_numbers->execute([$p_name, $user_id]);

      if($check_wishlist_numbers->rowCount() > 0){
         $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
         $delete_wishlist->execute([$p_name, $user_id]);
      }

      $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
      $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_image]);
      $message[] = 'Đã thêm vào giỏ hàng!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Trang chủ</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="home-bg">

   <section class="home">

      <div class="content">
         <span>Đừng đi đâu cả, hãy để chúng tôi lo!</span>
         <h3>Hãy bắt đầu với thực phẩm hữu cơ, nó rất có lợi cho sức khỏe của bạn đó <3</h3>
         <p>H&T.Fresh là một công ty phân phối thực phẩm tiêu dùng đến tay người dân trong hoàn cảnh dịch bệnh hiện nay!</p>
      
         <a href="about.php" class="btn">Liên hệ chúng tôi</a>
      </div>

   </section>

</div>

<section class="home-category">

   <h1 class="title">Phân loại thực phẩm</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/cat-1.png" alt="">
         <h3>Trái cây</h3>
         <p>Khai thác tối đa nguồn dinh dưỡng từ 100% trái cây tươi, rau quả tự nhiên, nguyên chất.</p>
         <a href="category.php?category=Trái cây" class="btn">các loại trái cây</a>
      </div>

      <div class="box">
         <img src="images/cat-2.png" alt="">
         <h3>Thịt</h3>
         <p>Thịt lợn chứa hàm lượng protein cao cùng nhiều vitamin và khoáng chất.</p>
         <a href="category.php?category=Thịt" class="btn">các loại thịt</a>
      </div>

      <div class="box">
         <img src="images/cat-3.png" alt="">
         <h3>Rau củ</h3>
         <p>Trong rau củ chứa nhiều nhất là các loại Vitamin và chất xơ giúp ngăn ngừa nhiều căn bệnh.</p>
         <a href="category.php?category=Rau củ" class="btn">các loại Rau củ</a>
      </div>

      <div class="box">
         <img src="images/cat-4.png" alt="">
         <h3>Cá</h3>
         <p>Cá có nhiều vitamin D, E, canxi, omega-3, DHA,... có lợi cho tim mạch, thị giác,...</p>
         <a href="category.php?category=Cá" class="btn">các loại Cá</a>
      </div>

   </div>

</section>

<section class="products">

   <h1 class="title">Cửa hàng thực phẩm</h1>

   <div class="box-container">

   <?php
      $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" class="box" method="POST">
      <div class="price"><span><?= $fetch_products['price']; ?></span>đ</div>
      <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <div class="name"><?= $fetch_products['name']; ?></div>
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
      <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
      <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
      <input type="number" min="1" value="1" name="p_qty" class="qty">
      <input type="submit" value="Thêm vào yêu thích" class="option-btn" name="add_to_wishlist">
      <input type="submit" value="Thêm vào giỏ hàng" class="btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">Chưa có sản phẩm nào!</p>';
   }
   ?>

   </div>

</section>







<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>