<div id="search">
            <form action="products.php" method="get">
                <input type="text" name="Keyword" value="<?php if(isset($_GET['Keyword'])) { echo $_GET['Keyword']; }?>" class="txt_field"/>
                <input type="submit" value="" class="sub_btn"  />
            </form>
        </div>
    </div> <!-- END of menubar -->

<div id="main">