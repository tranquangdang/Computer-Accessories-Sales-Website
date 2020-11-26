<?php require ("include/header.php") ?>
        <div id="content" class="float_r">
        	<div id="slider-wrapper">
                <div id="slider" class="nivoSlider">
                    <a href="#"><img src="images/slider/01.jpg" alt="" /></a>
                    <a href="#"><img src="images/slider/02.jpg" alt="" /></a>
                    <a href="#"><img src="images/slider/03.jpg" alt="" /></a>
                    <a href="#"><img src="images/slider/04.jpg" alt="" /></a>
                    <a href="#"><img src="images/slider/05.jpg" alt="" /></a>
                    <a href="#"><img src="images/slider/06.jpg" alt="" /></a>
                    <a href="#"><img src="images/slider/07.jpg" alt="" /></a>
                    <a href="#"><img src="images/slider/08.jpg" alt="" /></a>
                    <a href="#"><img src="images/slider/09.jpg" alt="" /></a>
                </div>
                <div id="htmlcaption" class="nivo-html-caption">
                    <strong>This</strong> is an example of a <em>HTML</em> caption with <a href="#">a link</a>.
                </div>
            </div>
            <script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
            <script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>
            <script type="text/javascript">
            $(window).load(function() {
                $('#slider').nivoSlider();
            });
            </script>
        	<h1>Sản phẩm mới</h1>
            <?php require ("include/productList.php") ?>    
        </div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <?php require ("include/footer.php") ?>