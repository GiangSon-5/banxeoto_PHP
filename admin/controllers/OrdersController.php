<?php
include "models/ProductsModel.php";
include "models/OrdersModel.php";
require __DIR__ . "/../../vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ProductsController extends Controller {
    use ProductsModel;

    public function index() {
        $recordPerPage = 20;
        $numPage = ceil($this->modelTotal() / $recordPerPage);
        $data = $this->modelRead($recordPerPage);
        $this->loadView("ProductsView.php", ["data" => $data, "numPage" => $numPage]);
    }

    public function update() {
        $id = isset($_GET["id"]) && is_numeric($_GET["id"]) ? $_GET["id"] : 0;
        $action = "index.php?controller=products&action=updatePost&id=$id";
        $record = $this->modelGetRecord($id);
        $this->loadView("ProductsForm.php", ["record" => $record, "action" => $action]);
    }

    public function updatePost() {
        $id = isset($_GET["id"]) && is_numeric($_GET["id"]) ? $_GET["id"] : 0;
        $this->modelUpdate($id);
        header("location:index.php?controller=products");
    }

    public function create() {
        $action = "index.php?controller=products&action=createPost";
        $this->loadView("ProductsForm.php", ["action" => $action]);
    }

    public function createPost() {
        $this->modelCreate();
        header("location:index.php?controller=products");
    }

    public function delete() {
        $id = isset($_GET["id"]) && is_numeric($_GET["id"]) ? $_GET["id"] : 0;
        $this->modelDelete($id);
        header("location:index.php?controller=products");
    }
}
?>

<?php



class OrdersController extends Controller {
    use OrdersModel;

    public function index() {
        $recordPerPage = 25;
        $numPage = ceil($this->modelTotal() / $recordPerPage);
        $listRecord = $this->modelRead($recordPerPage);
        $this->loadView("OrdersView.php", ["listRecord" => $listRecord, "numPage" => $numPage]);
    }

    public function delivery() {
        $id = isset($_GET["id"]) ? $_GET["id"] : 0;
        $this->modelDelivery($id);
        echo "<script>location.href='index.php?controller=orders';</script>";
    }

    public function detail() {
        $id = isset($_GET["id"]) ? $_GET["id"] : 0;
        $data = $this->modelListOrderDetails($id);
        $this->loadView("OrderDetailView.php", ["data" => $data, "id" => $id]);
    }

    public function export() {
        $recordPerPage = 25;
        $numPage = ceil($this->modelTotal() / $recordPerPage);
        $data = $this->modelRead($recordPerPage);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Xuất đơn hàng');

        $sheet->getColumnDimension('A')->setWidth(40);
        $sheet->getColumnDimension('B')->setWidth(40);
        $sheet->getColumnDimension('C')->setWidth(40);
        $sheet->getColumnDimension('D')->setWidth(40);
        $sheet->getColumnDimension('E')->setWidth(40);
        $sheet->getColumnDimension('F')->setWidth(40);

        $sheet->getStyle('A1:F1')->getFont()->setBold(true);
        $sheet->setCellValue('A1', 'Tên');
        $sheet->setCellValue('B1', 'Số điện thoại');
        $sheet->setCellValue('C1', 'Địa chỉ');
        $sheet->setCellValue('D1', 'Ngày đặt');
        $sheet->setCellValue('E1', 'Trạng thái');
        $sheet->setCellValue('F1', 'Vận chuyển');

        $numRow = 2;
        foreach ($data as $rows) {
            $customer = $this->modelGetCustomers($rows->customer_id);
            $date = Date_create($rows->create_at);
            $textGiaoHang = ($rows->status == 1) ? 'Đã giao hàng' : 'Chưa giao hàng';

            $orderDetails = $this->modelListOrderDetails($rows->id);
            $detailText = '';
            foreach ($orderDetails as $detail) {
                $product = $this->modelGetProducts($detail->product_id);
                $detailText .= "ID: {$detail->product_id}, Name: {$product->name}, Price: {$detail->price}, Number: {$detail->number}\n";
            }

            $sheet->setCellValue('A' . $numRow, $customer->name);
            $sheet->setCellValue('B' . $numRow, $customer->phone);
            $sheet->setCellValue('C' . $numRow, $customer->address);
            $sheet->setCellValue('D' . $numRow, Date_format($date, "d/m/Y"));
            $sheet->setCellValue('E' . $numRow, $textGiaoHang);
            $sheet->setCellValue('F' . $numRow, $detailText);
            $numRow++;
        }

        ob_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=data.xlsx");
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');

        header("location:index.php?controller=orders");
    }
}
?>
