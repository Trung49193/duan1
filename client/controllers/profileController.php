<?php

require_once 'model/user.php';

class profileController
{
    public function profile()
    {
        if (isset($_SESSION['user'])) {
            $email = $_SESSION['user']['email'];  // Lấy email từ session
            $userProfile = getUserProfile($email);  // Lấy thông tin từ model
            
            if ($userProfile) {
                require_once 'view/profile.php';  // Truyền dữ liệu vào view
            } else {
                echo "Không tìm thấy thông tin người dùng!";
            }
        } else {
            // Nếu chưa đăng nhập, chuyển hướng đến login
            header('Location: ?act=login');
            exit;
        }
    }
    public function updateProfile()
    {
        if (!isset($_SESSION['user'])) {
            // Nếu chưa đăng nhập, chuyển hướng đến login
            header('Location: ?act=login');
            exit;
        }

        // Lấy dữ liệu từ form
        $fullname = $_POST['fullname'] ?? null;
        $phone = $_POST['phone'] ?? null;
        $address = $_POST['address'] ?? null;

        // Xác minh dữ liệu đầu vào
        if (empty($fullname) || empty($phone) || empty($address)) {
            echo "Vui lòng nhập đầy đủ thông tin!";
            return;
        }

        // Lấy ID user từ session
        $userId = $_SESSION['user']['id_user'];

        // Cập nhật thông tin người dùng
        $updateSuccess = updateUserProfile($userId, $fullname, $phone, $address);

        if ($updateSuccess) {
            // Cập nhật session nếu cần
            $_SESSION['user']['full_name'] = $fullname;
            
            // Chuyển hướng lại trang profile
            header('Location: ?act=profile');
            exit;
        } else {
            echo "Cập nhật hồ sơ không thành công. Vui lòng thử lại!";
        }
    }

    
}


?>

