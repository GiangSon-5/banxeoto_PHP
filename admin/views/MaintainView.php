<!-- load file layout chung -->
<?php $this->layoutPath = "Layout.php"; ?>
<div class="col-md-12">
<!-- <div style="display:flex;height: 30px;justify-content: space-between;align-items: center;margin-bottom: 30px;"> -->
        <div></div>
        <h2 style="text-align: center">Lịch bảo dưỡng</h2>
        <!-- <button type="button" class="btn btn-success"><a href="index.php?controller=maintain&action=export" style="color:white">Xuất excel</a></button> -->
<!-- </div> -->
    <div class="panel panel-primary">
        <div class="panel-body">
            <table class="table table-bordered table-hover" style="text-align: center;">
                <tr>
                    <th style="width:120px;text-align: center;">Khách hàng</th>
                    <th style="width:120px; text-align: center;">Số điện thoại</th>
                    <th style="width:120px; text-align: center;">Địa chỉ</th>
                    <th style="width:120px;text-align: center;">Sản phẩm</th>
                    <th style="width:150px; text-align: center;">Lịch bảo dưỡng</th>
                    <th style="width:150px; text-align: center;"></th>
                </tr>
                <?php foreach($listRecord as $rows): ?>
                <?php
                    //lay ban ghi customer
                    $product = $this->modelGetProducts($rows->product_id);
                 ?>
                 <?php if($product): ?>
                 <tr>
                     <td><?php echo $rows->name; ?></td>
                     <td><?php echo $rows->phone; ?></td>
                     <td><?php echo $rows->address; ?></td>
                     <td>
                     <?php if( file_exists("../assets/upload/products/".$product->photo)): ?>
                        <img src="../assets/upload/products/<?php echo $product->photo; ?>" style="width: 100px;">
                        <?php endif; ?>
                        </td>
                     <td style="text-align: center;">
                         <?php if($rows->status == 1): ?>
                            Đã bảo dưỡng
                         <?php else: ?>
                            <?= $rows->ngaybaoduong ?  $rows->ngaybaoduong : $product->ngaybaoduong ?>
                         <?php endif; ?>
                     </td>
                     <td>
                        <?php if(!$rows->status): ?>
                        <form action="index.php?controller=maintain&action=update" method="post">
                            <input type="hidden" value="<?= $rows->id ?>" name="id">
                            <div style="display:flex">
                                <input type="submit" class="btn btn-primary" style="margin-left: 10px;height: 34px;padding: 0 15px" value="Cập nhật">
                            </div>
                        </form>
                        <?php endif; ?>
                    </td>
                 </tr>
                <?php endif; ?>
                <?php endforeach; ?>
            </table>
            <style type="text/css">
                .pagination{padding:0px; margin:0px;}
            </style>
            <ul class="pagination">
                <li class="page-item">
                    <?php for($i = 1; $i <= $numPage; $i++): ?>
                    <a href="index.php?controller=maintain&p=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                    <?php endfor; ?>
                </li>
            </ul>
        </div>
    </div>
</div>
