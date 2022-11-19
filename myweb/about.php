<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Giới thiệu</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   
  

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="about">

   <div class="row">

      <div class="box">
         <img src="images/about-img-1.png" alt="">
         <h3>Tại sao chọn chúng tôi?</h3>
         <p>Do tình hình dịch Covid-19 diễn biến phức tạp cho nên chính phủ ban hành chỉ thị 15, 16 hạn chế người dân ra đường tiếp xúc với nhau. Do vậy hãy để chúng tôi mang đến cho các bạn các loại thực phẩm đảm bảo an toàn thực phẩm nhất, tốt nhất, sạch nhất và phù hợp ví tiền đối với mọi người.</p>
         <a href="contact.php" class="btn">Liên hệ chúng tôi</a>
      </div>

      <div class="box">
         <img src="images/about-img-2.png" alt="">
         <h3>Chúng tôi cung cấp những gì?</h3>
         <p>Với sự hợp tác cùng với các trang trại từ Đà Lạt, sự kiểm duyệt của cục quản lý thực phẩm đạt chỉ tiêu. Chúng tôi chuyên cung cấp thực phẩm sạch tươi sống, thực phẩm sạch nhà hàng, thực phẩm sạch mầm non. Cung cấp trái cây tươi, rau củ quả sạch, thịt cá tươi sống...</p>
         <a href="shop.php" class="btn">cửa hàng chúng tôi</a>
      </div>

   </div>

</section>


<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>