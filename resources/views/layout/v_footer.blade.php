<div class="footer">
        <div class="header-footer carousel slide"  data-interval="5000" id="header" data-ride="carousel">
            <ol class="carousel-indicators chiso">
                <li data-target="#header" data-slide-to="0" class="active"></li>
                <li data-target="#header" data-slide-to="1"></li>
            </ol>
            <!--slide-->
            <div class="carousel-inner text-center">
                <div class="carousel-item active ">
                    <p>_CHUYỆN CON MÈO DẠY HẢI ÂU BAY, LUIS SEPÚLVEDA</p>
                    <span>Hihi</span>
                </div>
                <div class="carousel-item">
                    <p>_CÔ GÁI ĐẾN TỪ HÔM QUA, NGUYỄN NHẬT ÁNH_</p>
                    <span>Tôi đã từng chờ em dài hơn những năm tháng nhạt nhòa. Dù thế nào tôi vẫn nhắc lại,
                        em là người dưng tôi thương nhất cuộc đời này...
                    </span>
                </div>
            </div>
            <!--left and right controls-->
            <a class="carousel-control-prev" href="#header" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#header" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
        <div class="body-footer">
            <div class="row">
                <div class="col body-footer-customer">
                    <p class="pt-4 font-weight-bold">HỖ TRỢ CHĂM SÓC KHÁCH HÀNG</p>
                    <p> Địa chỉ: KTX khu B- Đông Hòa- Dĩ An- Bình Dương</p>
                    <p> Hotline: 0376206101</p>
                    <p> Email: 17520257@gm.uit.edu.vn</p>
                </div>
                <div class="col ml-4">
                    <p class="pt-4 font-weight-bold">DỊCH VỤ</p>
                    <ul class="list-unstyled">
                        <li class="pb-3">
                            <a href="#" class="text-decoration-none" id="dichvu">Giới thiệu</a>
                        </li>
                        <li class="pb-3">
                            <a href="#" class="text-decoration-none" id="dichvu">Điều khoản sử dụng</a>
                        </li>
                        <li class="pb-3">
                            <a href="#" class="text-decoration-none" id="dichvu">Hướng dẫn thanh toán</a>
                        </li>
                    </ul>
                </div>
                <div class="col">
                    <p class="font-weight-bold pt-4">KẾT NỐI</p>
                    <div>
                        <a href="#" class="body-footer-icon fb">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="body-footer-icon ins ml-2">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="body-footer-icon youtu ml-2">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
                <a href="#" id="back-to-top" title="Back to top">&uarr;</a>
            </div>
        </div>
      </div>
      <script type="text/javascript">
          if ($('#back-to-top').length) 
    {
        var scrollTrigger = 100, // px
        backToTop = function ()
        {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) 
            {
                $('#back-to-top').addClass('show');
            } 
            else 
            {
                $('#back-to-top').removeClass('show');
            }
        };
        backToTop();
        $(window).on('scroll', function () 
        {
            backToTop();
        });
        $('#back-to-top').on('click', function (e) 
        {
            e.preventDefault();
            $('html,body').animate({
            scrollTop: 0
            }, 1000);
        });
    }
      </script>