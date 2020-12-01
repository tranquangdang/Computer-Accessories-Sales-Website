<?php require ("include/header.php") ?>
<?php require ("include/sidebar.php") ?>
        <div id="content" class="float_r">
            <?php 
                require ("include/productList.php");
                $Pagination = new Page();
                $Pagination->Pagination('tblProduct','products.php',$total_pages,$page);
            ?>   
        </div> 
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <?php require ("include/footer.php") ?>