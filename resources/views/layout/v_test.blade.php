<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"> 
    <title>BOOK STORE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- link css-->
    <link rel="stylesheet" type="text/css" href="../../public/css/body_home.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/header_login.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/body_category.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/body_detailbook.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/body_search.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/footer.css">
    <script src="https://kit.fontawesome.com/6e4540c13e.js" crossorigin="anonymous"></script>
</head>
<body>

    <img src="../image/banhxe.jpg">
    <form action="" method="POST">
        {{ csrf_field() }}
        <div> Giá:10000đ</div>
        <label>Số lượng</label>
        <input type="number" name="number" min="1" value="1">
        <input type="productid_hidden" name="hidden" value="id">

        <button type="submit" class="btn btn-fefault cart">
            <i class="fa fa-shopping-cart"></i>
            Thêm giỏ hàng
        </button>
    </form>
</body>
</html>