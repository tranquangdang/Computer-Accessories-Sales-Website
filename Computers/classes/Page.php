<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');
 ?>
<?php 

class Page
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }
    //Phân trang
    public function Pagination($tableName, $targetpage, $total_pages, $page)
    {
        $limit = 12;
        $stages = 3;

        if ($page == 0) {$page = 1;}
        $prev = $page - 1;
        $next = $page + 1;
        $lastpage = ceil($total_pages / $limit);
        $LastPagem1 = $lastpage - 1;

        $paginate = '';
        if ($lastpage > 1) {

            $paginate .= "<div class='paginate'>";
            //Quay lại
            if ($page > 1) {
                $paginate .= "<a href='$targetpage page=$prev'>Quay lại</a>";
            } else {
                $paginate .= "<span class='disabled'>Quay lại</span>";}

            // Pages
            if ($lastpage < 7 + ($stages * 2)) //Ít trang nên không ẩn
            {
                for ($counter = 1; $counter <= $lastpage; $counter++) {
                    if ($counter == $page) {
                        $paginate .= "<span class='current'>$counter</span>";
                    } else {
                        $paginate .= "<a href='$targetpage page=$counter'>$counter</a>";}
                }
            } elseif ($lastpage > 5 + ($stages * 2))//Nhiều trang nên ẩn bớt
            {
                //Ẩn các trang sau nếu đang ở đầu
                if ($page < 1 + ($stages * 2)) {
                    for ($counter = 1; $counter < 4 + ($stages * 2); $counter++) {
                        if ($counter == $page) {
                            $paginate .= "<span class='current'>$counter</span>";
                        } else {
                            $paginate .= "<a href='$targetpage page=$counter'>$counter</a>";}
                    }
                    $paginate .= "...";
                    $paginate .= "<a href='$targetpage page=$LastPagem1'>$LastPagem1</a>";
                    $paginate .= "<a href='$targetpage page=$lastpage'>$lastpage</a>";
                }
                //Ẩn các trang sau và đầu nếu đang ở giữa
                elseif ($lastpage - ($stages * 2) > $page && $page > ($stages * 2)) {
                    $paginate .= "<a href='$targetpage page=1'>1</a>";
                    $paginate .= "<a href='$targetpage page=2'>2</a>";
                    $paginate .= "...";
                    for ($counter = $page - $stages; $counter <= $page + $stages; $counter++) {
                        if ($counter == $page) {
                            $paginate .= "<span class='current'>$counter</span>";
                        } else {
                            $paginate .= "<a href='$targetpage page=$counter'>$counter</a>";}
                    }
                    $paginate .= "...";
                    $paginate .= "<a href='$targetpage page=$LastPagem1'>$LastPagem1</a>";
                    $paginate .= "<a href='$targetpage page=$lastpage'>$lastpage</a>";
                }
                //Ẩn các trang đầu nếu đang ở cuối
                else {
                    $paginate .= "<a href='$targetpage page=1'>1</a>";
                    $paginate .= "<a href='$targetpage page=2'>2</a>";
                    $paginate .= "...";
                    for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++) {
                        if ($counter == $page) {
                            $paginate .= "<span class='current'>$counter</span>";
                        } else {
                            $paginate .= "<a href='$targetpage page=$counter'>$counter</a>";}
                    }
                }
            }

            //Tiếp theo
            if ($page < $counter - 1) {
                $paginate .= "<a href='$targetpage page=$next'>Tiếp theo</a>";
            } else {
                $paginate .= "<span class='disabled'>Tiếp theo</span>";
            }
            $paginate .= "</div>";
        }
        //Hiển thị phân trang
        echo '<div id="paginate">'.'<p>'.$total_pages . ' Kết quả</p>'.'<p>'.$paginate.'</p></div>';
    }
}

?>