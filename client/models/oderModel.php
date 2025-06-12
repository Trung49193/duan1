<?php
class orderModel
{
    public $conn;
    function __construct()
    {
        $this->conn = connDBAss();
    }
    function getOrdersByStatus($id, $status = null)
    {
        $sql = "SELECT * FROM bills JOIN detail_bills ON bills.id_bill = detail_bills.id_bill WHERE id_customer = $id";
        if ($status !== null) {
            $sql .= " AND status = $status";
        }
        $sql .= " ORDER BY bills.id_bill DESC";
        return $this->conn->query($sql)->fetchAll();
    }
    function getOrderDetails($id_bill)
    {
        $sql = "SELECT * FROM detail_bills JOIN bills ON detail_bills.id_bill = bills.id_bill JOIN variant ON detail_bills.id_variant = variant.id_variant JOIN products ON detail_bills.id_product = products.id_product WHERE detail_bills.id_bill = $id_bill";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    function cancelOrder($id_bill)
    {
        $sql = "UPDATE bills SET status = 6 WHERE id_bill = $id_bill AND status IN (0, 1, 2)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }
    function getOrderStatus($id_bill)
    {
        $sql = "SELECT status FROM bills WHERE id_bill = $id_bill";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}