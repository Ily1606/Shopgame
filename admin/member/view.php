<div class="table-responsive">
    <table class="table table-bordered table-hover" id="h_table">
        <thead>
            <tr>
                <th>#</th>
                <th>Họ và tên</th>
                <th>Username</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Giới tính</th>
                <th>Ngày tạo tài khoản</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php $res = mysqli_query($conn, "SELECT * FROM table_accounts ORDER BY id DESC");
            $count = 0;
            while ($row = mysqli_fetch_array($res)) {
                $count++;
            ?>
                <tr>
                    <td>
                        <?php echo $count; ?>
                    </td>
                    <td>
                        <img src="<?php echo $row["avatar"]; ?>" class="rounded-circle" width="40px" height="40px">
                        <?php echo $row['first_name'] . " " . $row["last_name"]; ?>
                    </td>
                    <td>
                        <a href="/profile.php?id=<?php echo $row['id']; ?>"><?php echo ($row['username'] ? $row["username"] : "Xem trang cá nhân"); ?></a>
                    </td>
                    <td>
                        <?php echo $row["email"]; ?>
                    </td>
                    <td>
                        <?php echo $row["number_phone"]; ?>
                    </td>
                    <td>
                        <?php echo ($row["gender"] == 1 ? "Nam" : "Nữ"); ?>
                    </td>
                    <td>
                        <?php echo $row["create_time"]; ?>
                    </td>
                    <td>
                        <?php if ($row["status"] == 1) { ?>
                            <button class="btn btn-danger banner_user" attr_id="<?php echo $row["id"]; ?>">Banned</button>
                        <?php } else { ?>
                            <button class="btn btn-success banner_user" attr_id="<?php echo $row["id"]; ?>">Unbanned</button>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        $(".banner_user").click(function() {
            var btn_target = $(this);
            html = btn_target.text();
            btn_target.html('<i class="fa-spinner fa fa-spin"></i> Đang kiểm tra...').attr('disabled', true);
            $.ajax({
                url: "/admin/member/action.php?action=banner&id=" + $(this).attr("attr_id"),
                success: function(e) {
                    btn_target.html(html).attr('disabled', false);
                    e = JSON.parse(e);
                    if (e.status) {
                        setTimeout(function() {
                            window.location.reload();
                        }, 3000)
                        toastr.success(e.message);
                    } else {
                        toastr.error(e.message);
                    }
                }
            })
        });
    });
</script>