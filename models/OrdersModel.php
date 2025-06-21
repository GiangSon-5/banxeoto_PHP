<?php
	trait OrdersModel{
		//ham liet ke danh sach cac ban ghi, co phan trang
		public function modelRead($recordPerPage){
			//lay tong to so ban ghi
			$total = $this->modelTotal();
			//tinh so trang
			$numPage = ceil($total/$recordPerPage);
			//lay so trang hien tai truyen tu url
			$userId = $_SESSION["customer_id"];
			$page = isset($_GET["p"]) && $_GET["p"] > 0 ? $_GET["p"]-1 : 0;
			//lay tu ban ghi nao
			$from = $page * $recordPerPage;
			//thuc hien truy van
			$conn = Connection::getInstance();
			$query = $conn->query("select * from orders where customer_id = $userId order by id,status desc limit $from, $recordPerPage");
			//tra ve tat ca cac ban truy van duoc
			return $query->fetchAll();
		}
		//ham tinh tong so ban ghi
		public function modelTotal(){
			//---
			$conn = Connection::getInstance();
			$userId = $_SESSION["customer_id"];
			$query = $conn->query("select id from orders where customer_id = $userId");
			//lay tong so ban ghi
			return $query->rowCount();
			//---
		}
		//lay mot ban ghi table orders
		public function modelGetOrders($id){
			//---
			$conn = Connection::getInstance();
			$query = $conn->query("select * from orders where id = $id");
			//tra ve mot ban ghi
			return $query->fetch();
			//---
		}
		//lay mot ban ghi trong table customers
		public function modelGetCustomers($id){
			//---
			$conn = Connection::getInstance();
			$query = $conn->query("select * from customers where id = $id");
			//tra ve mot ban ghi
			return $query->fetch();
			//---
		}
		//lay mot ban ghi trong table products
		public function modelGetProducts($id){
			//---
			$conn = Connection::getInstance();
			$query = $conn->query("select * from products where id = $id");
			//tra ve mot ban ghi
			return $query->fetch();
			//---
		}
		//xac nhan da giao hang
		public function modelDelivery($id){
			//---
			$conn = Connection::getInstance();
			$conn->query("update orders set status = 1 where id = $id");
		}
		//lay danh sach cac san pham trong talbe orderdetails
		public function modelListOrderDetails($id){
			//---
			$conn = Connection::getInstance();
			$query = $conn->query("select * from orderdetails where order_id = $id");
			//tra ve mot ban ghi
			return $query->fetchAll();
			//---
		}

		public function modelUpdate($id){
			$id = isset($_POST["id"])&&is_numeric($_POST["id"])?$_POST["id"]:0;
			$ngaybaoduong = $_POST["ngaybaoduong"];
			$conn = Connection::getInstance();
			$query = $conn->prepare("update orderdetails set ngaybaoduong=:_ngaybaoduong where id=:_id");
			$query->execute([":_ngaybaoduong"=>$ngaybaoduong,":_id"=>$id]);
			return true;
		}
	}
 ?>
