<?php
require_once 'layout/header.php';
require_once 'layout/navbar.php';
?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <?php require_once 'layout/topbar.php' ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Chi tiết đơn hàng</h1>
            </div>

            <!-- Content Row -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thông tin sản phẩm trong đơn hàng</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Màu sắc</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                foreach ($oneBill as $index => $item):
                                    $itemTotal = $item['price'] * $item['quantity'];
                                    $total += $itemTotal;
                                    ?>
                                    <tr>
                                        <td><img src="../assets/img/<?= $item['img_product'] ?>" alt="" width="100px"></td>
                                        <td><?= $item['name_product'] ?></td>
                                        <td><?= $item['name_color'] ?></td>
                                        <td><?= number_format($item['price']) ?>đ</td>
                                        <td><?= $item['quantity'] ?></td>
                                        <td><?= number_format($item['price'] * $item['quantity']) ?>đ</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="5" class="text-left">Tổng tiền:</th>
                                    <th><?= number_format($total) ?>đ</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Status Update -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Cập nhật trạng thái đơn hàng</h6>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="status" class="form-label">Trạng thái</label>
                            <select class="form-control" id="status" name="status">
                                <?php foreach ($statusDescriptions as $key => $value): ?>
                                    <?php if ($key >= $status): // Chỉ hiển thị các trạng thái >= trạng thái hiện tại ?>
                                        <option value="<?= $key ?>" <?= $key == $status ? 'selected' : '' ?>>
                                            <?= $value ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <?php if ($status > 5):?>
                                    <option value="6">Đã hủy</option>
                                <?php endif;?>
                            </select>
                        </div>
                        <button type="submit" name="btn_update" class="btn btn-primary mt-3">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    <?php
    require_once 'layout/scripts.php';
    require_once 'layout/footer.php';
    ?>