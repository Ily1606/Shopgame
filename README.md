# Dự án website thuơng mại điện tử - vật phẩm game
## Thành viên thực hiện
>
> 1. Nguyễn Tường Nguyên
>
> 2. Nguyễn Đức Huy
>
> 3. Võ Nguyễn Nhật Trường

## Cách sử dụng

1. Tạo CSDL cấu hình lại file _connect.php
2. Import CSDL ở file databases/shopgame.sql vào CSDL vừa tạo
3. Thay đổi tài khoản gmail ở file /functions/momo/checkmomo.php và /functions/momo/gmail.php

## Các chức năng chính

1. Đăng ký
2. Đăng nhập
3. Trang profile (/profile.php?id=<user_id>)
4. Trang quản trị viên (/admin/)
5. Trang giỏ hàng
6. Hệ thống nạp tiền tự động qua momo (run file /functions/momo/checkmomo.php)
7. Trang thông tin sản phẩm
8. Thêm, sửa sản phẩm
9. Các danh mục game, loại sản phẩm
10. Thêm danh mục game, loại sản phẩm (ở mục thêm sản phẩm)
11. Tìm kiếm sản phẩm theo từ khóa (tách từng từ ra để tìm, không phải tìm kiếm theo cả cụm từ)
12. Đăng nhập bằng facebook, google

## Các kỹ năng áp dụng

1. Mô hình MVC (moddle/user.php)
2. Hướng đối tượng (functions/Class... file)
3. Ajax đăng nhập, đăng ký
4. Nén ảnh, lấy mail theo IMAP PHP (dùng để giao dịch của momo)
5. Gửi mail dạng HTML (dùng để thông báo với người dùng nếu người dùng thanh toán trực tuyến thành công)

## Kết luận update ngày 01/12/2020
>
> Tập trung vào front-end, dựng back-end theo hướng đối tượng trước.

## Kết luận update ngày 12/01/2021
> Tính năng mới update:
>* Admin
1. Ban thành viên, ban sản phẩm
2. Bảo trì hệ thống
3. Lịch sử nạp tiền tự động
>* Trang chủ
1. Chỉnh sửa giao diện (hiệu ứng cánh hoa rơi (tết), header, navigation, banner)
2. Thêm mục sale
> Thêm chương trình sale cho người dùng (ở mục thêm sản phẩm ở trang profile)
> Hiển thị nhiều hơn 1 ảnh của sản phẩm ở trang thông tin sản phẩm
