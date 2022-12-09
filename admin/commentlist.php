<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
include_once '../model/mcomment.php';
include_once '../model/mproduct.php';
include_once '../model/muser.php';
?>

<?php
if(isset($_GET['delid'])){
	$id = $_GET['delid'];
	$del_prod = comment::delete_comment($id);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách bình luận </h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên KH</th>
                        <th>Số điện thoại</th>
                        <th>Tên SP</th>
                        <th>Hình ảnh</th>
                        <th>Bình luận</th>
                        <th>Điểm</th>
                        <th>Thời gian</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = comment::get_comment();
                    if (mysqli_num_rows($result) > 0) {
                        $index = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $index++;
                    ?>
                            <tr class="gradeX odd">
                                <td><?= $index ?></td>
                                <?php
                                $result_1 = user::getuserbyid($row['user_id']);
                                $row_1 = mysqli_fetch_array($result_1);
                                ?>
                                <td><?= $row_1['name'] ?></td>
                                <td><?= $row_1['phone'] ?></td>
                                <?php
                                $result_2 = product::getprodbyId($row['product_id']);
                                $row_2 = mysqli_fetch_array($result_2);
                                ?>
                                <td><?= $row_2['product_name'] ?></td>
                                <td><img style="padding: 5px;" src="<?= $row_2['image'] ?>" alt="" width="120px"></td>
                                <td><?= $row['comment'] ?></td>
                                <td><?= $row['score'] ?></td>
                                <td><?= $row['time'] ?></td>
                                <td><a onclick="return confirm('Bạn có muốn loại bình luận này không?')" href="?delid=<?= $row['id'] ?>">Xóa</a></td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr class="gradeX odd">
                            <td colspan="9">Không có bình luận gần đây.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>

<?php include 'inc/footer.php'; ?>