<?php require "include/topheader.php"; ?>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $custLogin = $customer->customerLogin($_POST);
}
?>
<?php require "include/header.php"; ?>
<?php require "include/search.php"; ?>
<div class="loginform">
<div class="login_panel">
    <?php
    if (isset($custLogin)) {
        echo $custLogin;
    }
?>
    <h3>Đăng Nhập</h3>
    <form action="" method="post">
        <input name="Email" placeholder="Email" type="text" />
        <br>
        <input name="Pass" placeholder="Password" type="password" />

        <p class="note"><a href="#">Quên mật khẩu?</a></p>
        <div class="buttons">
            <div><button class="grey" name="login">Đăng nhập</button></div>
        </div>
    </form>
</div>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
        $customerReg = $customer->customerRegistration($_POST);
    }
?>
<div class="register_account">
<?php
if (isset($customerReg)) {
    echo $customerReg;
}
?>
    <h3>Đăng kí tài khoản</h3>
    <form action="" method="post">
        <table>
            <tbody>
                <tr>
                    <td>
                        <div>
                            <input type="text" name="CustName" placeholder="Họ và tên" />
                        </div>
                        <div>
                            <input type="text" name="CustAddress" placeholder="Địa chỉ" />
                        </div>
                        <div>
                            <input type="text" name="TelNo" placeholder="Số điện thoại" />
                        </div>
                        <div>
                            <input type="text" name="Email" placeholder="Email" />
                        </div>
                        <div>
                            <input type="text" name="Pass" placeholder="Mật khẩu" />
                        </div>

                    </td>
                </tr>
            </tbody>
        </table>
        <div class="search">
            <div><button class="grey" name="register">Đăng kí</button></div>
        </div>
        <p class="terms">Bằng cách đăng kí bạn đã chấp nhận <a href="#">Điều khoản</a> của trang web.</p>
        <div class="cleaner"></div>
    </form>
</div>
<div class="cleaner"></div>
</div>
</div> <!-- END of main -->

<?php require "include/footer.php"?>