<?php require ("include/topheader.php") ?>
<?php require ("include/header.php") ?>
<?php require ("include/search.php") ?>
<?php require ("include/sidebar.php") ?>
        <div id="content" class="float_r" style="margin-bottom: 70px">
        
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><a href="#"><img src="images/slider/01.jpg" alt="" /></a></div>
                    <div class="swiper-slide"><a href="#"><img src="images/slider/02.jpg" alt="" /></a></div>
                    <div class="swiper-slide"><a href="#"><img src="images/slider/03.jpg" alt="" /></a></div>
                    <div class="swiper-slide"><a href="#"><img src="images/slider/04.jpg" alt="" /></a></div>
                    <div class="swiper-slide"><a href="#"><img src="images/slider/05.jpg" alt="" /></a></div>
                    <div class="swiper-slide"><a href="#"><img src="images/slider/06.jpg" alt="" /></a></div>
                    <div class="swiper-slide"><a href="#"><img src="images/slider/07.jpg" alt="" /></a></div>
                    <div class="swiper-slide"><a href="#"><img src="images/slider/08.jpg" alt="" /></a></div>
                    <div class="swiper-slide"><a href="#"><img src="images/slider/09.jpg" alt="" /></a></div>
                </div>
                
                <div class="swiper-pagination"></div>

                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        	<h1>Sản phẩm mới</h1>
            <?php 
                include ("include/productList.php"); 
            ?>    
        </div> 
        <div class="cleaner"></div>
    </div> <!-- END of main -->
    
    <?php require ("include/footer.php") ?>
<script>
    var swiper = new Swiper('.swiper-container', {
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    });
</script>