<?php
    //load LayoutTrangChu.php
    $this->layoutPath = "LayoutTrangTrong.php";
    ?>
<div class="template-cart">
    <div class="table-responsive">
        <table class="table table-cart">
            <thead>
                <tr>
                    <th>Ảnh sản phẩm</th>
                    <th class="name">Tên sản phẩm</th>
                    <th class="price">Giá</th>
                    <th class="price">Lịch bảo dưỡng</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listRecord as $order): ?>
                <?php
                    $products = $this->modelListOrderDetails($order->id);
                    ?>
                <?php foreach($products as $item): ?>
                <?php
                    //lay ban ghi product tuong ung voi product_id
                    $product = $this->modelGetProducts($item->product_id);
                    if ($product):
                    ?>
                <tr>
                        <td>
                            <img src="assets/upload/products/<?php echo $product->photo; ?>" class="img-responsive"  />
                        </td>
                        <td><a href="index.php?controller=products&action=detail&id=<?php echo $product->id; ?>"><?php echo $product->name; ?></a>
                        </td>
                        <td> <?php echo number_format($product->price); ?>₫ </td>
                        <td>
                            <?php if ( $item->status == 1): ?>
                                Đã bảo dưỡng
                            <?php else: ?>
                                <form action="index.php?controller=orders&action=update" method="post">
                                    <input type="hidden" value="<?= $item->id ?>" name="id">
                                    <div style="display:flex">
                                        <input type="date" value="<?php echo $item->ngaybaoduong? $item->ngaybaoduong : $product->ngaybaoduong; ?>" name="ngaybaoduong" class="form-control" required>
                                        <input type="submit" class="button pull-right" style="margin-left: 10px;height: 34px;padding: 0 15px" value="Cập nhật">
                                    </div>
                                </form>
                            <?php endif ?>
                        </td>
                </tr>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $('.checkout').click(function() {
      if (confirm('Xử lý đơn hàng thành công')) {
        window.location.href = 'index.php?controller=cart&action=checkout';
      }
    })
</script>
