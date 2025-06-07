<?php
class payController
{
    public $payModel;
    function __construct()
    {
        $this->payModel = new payModel();
    }
    function pay()
    {
        if (!isset($_SESSION['user'])) {
            $_SESSION['Message'] = "Bạn cần đăng nhập để thanh toán!";
            header('Location: ?act=login');
            exit();
        }
        require_once 'view/pay.php';
    }
    function payment()
    {
        if (isset($_POST['order_cart'])) {
            if (!empty($_SESSION['mycart'])) {
                $receiver_name = $_POST['receiver_name'];
                $receiver_phone = $_POST['receiver_phone'];
                $receiver_address = $_POST['receiver_address'];
                $id_customer = $_SESSION['user']['customer_info']['id_customer']; // Giả sử user đã đăng nhập

                // Lấy danh sách sản phẩm trong giỏ hàng
                $cartItems = $_SESSION['mycart'];

                // Gọi hàm lưu đơn hàng
                $result = $this->payModel->saveOrder($id_customer, $receiver_name, $receiver_phone, $receiver_address, $cartItems);

                if ($result) {
                    $_SESSION['payment_status'] = 'success';
                    $_SESSION['payment_message'] = 'Đặt hàng thành công!';
                    unset($_SESSION['mycart']);
                }
            } else {
                $_SESSION['payment_status'] = 'error';
                $_SESSION['payment_message'] = 'Giỏ hàng của bạn hiện đang trống!';
            }
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }
    
}