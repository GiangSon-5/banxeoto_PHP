<?php
	trait MaintainModel{
		//ham liet ke danh sach cac ban ghi, co phan trang
		public function modelRead($recordPerPage){
			//lay tong to so ban ghi
			$total = $this->modelTotal();
			//tinh so trang
			$numPage = ceil($total/$recordPerPage);
			//lay so trang hien tai truyen tu url
			$page = isset($_GET["p"]) && $_GET["p"] > 0 ? $_GET["p"]-1 : 0;
			//lay tu ban ghi nao
			$from = $page * $recordPerPage;
			$search = isset($_GET["search"]) ? $_GET["search"] : null;
			//thuc hien truy van
			$conn = Connection::getInstance();
			$checkUser = "";
			if ($search) {
				$checkUser = "where customers.name like '%$search%'";
			}

			$query = $conn->query("select customers.name, customers.phone, customers.address, orderdetails.* from orderdetails
			join orders on orderdetails.order_id = orders.id
			join customers on customers.id = orders.customer_id
			$checkUser
			order by id,status desc limit $from, $recordPerPage");
			//tra ve tat ca cac ban truy van duoc
			return $query->fetchAll();
		}
		//ham tinh tong so ban ghi
		public function modelTotal(){
			//---
			$conn = Connection::getInstance();
			$query = $conn->query("select id from orderdetails");
			//lay tong so ban ghi
			return $query->rowCount();
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
			$conn = Connection::getInstance();
			$query = $conn->prepare("update orderdetails set status=:_status where id=:_id");
			$query->execute([":_status"=>1,":_id"=>$id]);
			return true;
		}
	}
 ?>
