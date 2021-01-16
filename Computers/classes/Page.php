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
    public function Pagination($targetpage, $total_pages, $page)
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
                $paginate .= "<a href='$targetpage"."page=$prev'>Quay lại</a>";
            } else {
                $paginate .= "<span class='disabled'>Quay lại</span>";}

            //Pages
            if ($lastpage < 7 + ($stages * 2)) //Ít trang nên không ẩn
            {
                for ($counter = 1; $counter <= $lastpage; $counter++) {
                    if ($counter == $page) {
                        $paginate .= "<span class='current'>$counter</span>";
                    } else {
                        $paginate .= "<a href='$targetpage"."page=$counter'>$counter</a>";
                    }
                }
            } elseif ($lastpage > 5 + ($stages * 2)) { //Nhiều trang nên ẩn bớt
                if ($page < 1 + ($stages * 2)) { //Ẩn các trang sau nếu đang ở đầu
                    for ($counter = 1; $counter < 4 + ($stages * 2); $counter++) {
                        if ($counter == $page) {
                            $paginate .= "<span class='current'>$counter</span>";
                        } else {
                            $paginate .= "<a href='$targetpage"."page=$counter'>$counter</a>";
                        }
                    }
                    $paginate .= "...";
                    $paginate .= "<a href='$targetpage"."page=$LastPagem1'>$LastPagem1</a>";
                    $paginate .= "<a href='$targetpage"."page=$lastpage'>$lastpage</a>";
                } elseif ($lastpage - ($stages * 2) > $page && $page > ($stages * 2)) { //Ẩn các trang sau và đầu nếu đang ở giữa
                    $paginate .= "<a href='$targetpage"."page=1'>1</a>";
                    $paginate .= "<a href='$targetpage"."page=2'>2</a>";
                    $paginate .= "...";
                    for ($counter = $page - $stages; $counter <= $page + $stages; $counter++) {
                        if ($counter == $page) {
                            $paginate .= "<span class='current'>$counter</span>";
                        } else {
                            $paginate .= "<a href='$targetpage"."page=$counter'>$counter</a>";
                        }
                    }
                    $paginate .= "...";
                    $paginate .= "<a href='$targetpage"."page=$LastPagem1'>$LastPagem1</a>";
                    $paginate .= "<a href='$targetpage"."page=$lastpage'>$lastpage</a>";
                } else {  //Ẩn các trang đầu nếu đang ở cuối
                    $paginate .= "<a href='$targetpage page=1'>1</a>";
                    $paginate .= "<a href='$targetpage page=2'>2</a>";
                    $paginate .= "...";
                    for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++) {
                        if ($counter == $page) {
                            $paginate .= "<span class='current'>$counter</span>";
                        } else {
                            $paginate .= "<a href='$targetpage"."page=$counter'>$counter</a>";
                        }
                    }
                }
            }
            //Tiếp theo
            if ($page < $counter - 1) {
                $paginate .= "<a href='$targetpage"."page=$next'>Tiếp theo</a>";
            } else {
                $paginate .= "<span class='disabled'>Tiếp theo</span>";
            }
            $paginate .= "</div>";
        }
        //Hiển thị phân trang
        echo '<div id="paginate">'.'<p>'.$total_pages . ' Kết quả</p>'.'<p>'.$paginate.'</p></div>';
    }

    //Thay đổi value của biến $_GET trong url
    public function buildQuery($variable, $value){
        $variable  = mysqli_real_escape_string($this->database->link, $variable);
        $value  = mysqli_real_escape_string($this->database->link, $value);
        $query = $_GET;
        $query[$variable] = $value;
        $query_result = http_build_query($query);
        return $_SERVER['PHP_SELF'].'?'.$query_result;
    }

    public function sortSQL($type) {
        $type  = mysqli_real_escape_string($this->database->link, $type);
        if ($type == 'asc') {
            return ' ORDER BY UnitPrice ASC ';
        } else if ($type == 'desc') {
            return ' ORDER BY UnitPrice DESC ';
        } else if ($type == 'new') {
            return ' ORDER BY TimeCreate DESC ';
        } else if ($type == 'discount') {
            return ' AND PerDiscount > 0 ORDER BY PerDiscount DESC ';
        } else if ($type == 'topsell') {
            return ' AND tblOrderInvoiceDetail.ProductID = tblProduct.ProductID GROUP BY ProductID ORDER BY SUM(QtyOrdered) DESC ';
        } else {
            return '';
        }
    }

    public function setVariableSort($type) {
        $type  = mysqli_real_escape_string($this->database->link, $type);
        if ($type == 'asc') {
            return 'Sort=asc';
        } else if ($type == 'desc') {
            return 'Sort=desc';
        } else if ($type == 'new') {
            return 'Sort=new';
        } else if ($type == 'discount') {
            return 'Sort=discount';
        } else if ($type == 'topsell') {
            return 'Sort=topsell';
        } else {
            return '';
        }
    }

    public function checkType($type) {
        $type  = mysqli_real_escape_string($this->database->link, $type);
        if($type == 'CPU01' || $type == 'CPU02') {
            return 'CPU';
        } else if($type == 'MAIN1' || $type == 'MAIN2') {
            return 'MAIN';
        } else {
            return "";
        }
    }
}

?>