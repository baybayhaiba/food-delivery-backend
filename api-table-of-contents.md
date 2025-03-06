# Mô tả ý nghĩa các Routes API - Backend Giao Đồ Ăn Nhanh

File này mô tả ý nghĩa và chức năng của từng route API được liệt kê trong [Mục lục API](api-table-of-contents.md).

---

## Authentication

Nhóm các routes liên quan đến xác thực người dùng.

### POST /api/register

**Ý nghĩa:**  Endpoint này cho phép người dùng mới đăng ký tài khoản trên ứng dụng.

**Chức năng:**

*   Nhận thông tin đăng ký từ người dùng (tên, email, mật khẩu, v.v.).
*   Xác thực dữ liệu đầu vào (ví dụ: kiểm tra email hợp lệ, mật khẩu đủ mạnh, v.v.).
*   Tạo một tài khoản người dùng mới trong database.
*   Trả về API token để người dùng có thể sử dụng để xác thực trong các request tiếp theo.

### POST /api/login

**Ý nghĩa:** Endpoint này cho phép người dùng đã đăng ký đăng nhập vào ứng dụng.

**Chức năng:**

*   Nhận thông tin đăng nhập (email và mật khẩu) từ người dùng.
*   Xác thực thông tin đăng nhập với dữ liệu người dùng trong database.
*   Nếu thông tin đăng nhập hợp lệ, tạo và trả về một API token cho người dùng.

### POST /api/logout

**Ý nghĩa:** Endpoint này cho phép người dùng đang đăng nhập đăng xuất khỏi ứng dụng.

**Chức năng:**

*   Xác thực người dùng thông qua API token được gửi trong header.
*   Hủy bỏ (xóa hoặc vô hiệu hóa) API token hiện tại của người dùng, khiến token không còn hiệu lực cho các request tiếp theo.

### GET /api/user

**Ý nghĩa:** Endpoint này cho phép người dùng đã đăng nhập lấy thông tin tài khoản của chính mình.

**Chức năng:**

*   Xác thực người dùng thông qua API token.
*   Lấy thông tin chi tiết của người dùng từ database.
*   Trả về thông tin người dùng (ví dụ: ID, tên, email, vai trò, v.v.).

---

## Restaurants

Nhóm các routes liên quan đến quản lý và hiển thị thông tin nhà hàng.

### GET /api/restaurants

**Ý nghĩa:** Endpoint này cung cấp danh sách tất cả các nhà hàng có trong hệ thống.

**Chức năng:**

*   Truy vấn database để lấy danh sách nhà hàng.
*   Hỗ trợ phân trang để quản lý danh sách nhà hàng lớn.
*   Trả về danh sách nhà hàng (có thể bao gồm thông tin cơ bản như tên, địa chỉ, hình ảnh, v.v.).

### GET /api/restaurants/{restaurant}

**Ý nghĩa:** Endpoint này cung cấp thông tin chi tiết của một nhà hàng cụ thể.

**Chức năng:**

*   Nhận ID của nhà hàng từ URL parameter `{restaurant}`.
*   Truy vấn database để lấy thông tin chi tiết của nhà hàng có ID tương ứng.
*   Trả về thông tin chi tiết của nhà hàng (bao gồm tất cả các trường thông tin như tên, mô tả, địa chỉ, giờ mở cửa, v.v.).

### POST /api/restaurants (Admin)

**Ý nghĩa:** Endpoint này (chỉ dành cho Admin) cho phép tạo mới một nhà hàng vào hệ thống.

**Chức năng:**

*   **Yêu cầu quyền Admin:** Chỉ người dùng có vai trò "admin" mới có thể truy cập endpoint này.
*   Nhận thông tin nhà hàng mới từ request body (tên, địa chỉ, mô tả, v.v.).
*   Xác thực dữ liệu đầu vào (ví dụ: kiểm tra tên nhà hàng không được trùng, địa chỉ hợp lệ, v.v.).
*   Tạo một bản ghi nhà hàng mới trong database.
*   Trả về thông tin nhà hàng vừa tạo.

### PUT/PATCH /api/restaurants/{restaurant} (Admin)

**Ý nghĩa:** Endpoint này (chỉ dành cho Admin) cho phép cập nhật thông tin của một nhà hàng đã tồn tại.

**Chức năng:**

*   **Yêu cầu quyền Admin:** Chỉ người dùng có vai trò "admin" mới có thể truy cập endpoint này.
*   Nhận ID của nhà hàng cần cập nhật từ URL parameter `{restaurant}`.
*   Nhận thông tin cập nhật từ request body (các trường thông tin nhà hàng cần thay đổi).
*   Xác thực dữ liệu đầu vào (nếu có).
*   Cập nhật thông tin nhà hàng trong database.
*   Trả về thông tin nhà hàng đã được cập nhật.

### DELETE /api/restaurants/{restaurant} (Admin)

**Ý nghĩa:** Endpoint này (chỉ dành cho Admin) cho phép xóa một nhà hàng khỏi hệ thống.

**Chức năng:**

*   **Yêu cầu quyền Admin:** Chỉ người dùng có vai trò "admin" mới có thể truy cập endpoint này.
*   Nhận ID của nhà hàng cần xóa từ URL parameter `{restaurant}`.
*   Xóa bản ghi nhà hàng khỏi database.
*   Trả về thông báo thành công.

### GET /api/restaurants/{restaurant}/dishes

**Ý nghĩa:** Endpoint này cung cấp danh sách các món ăn mà một nhà hàng cụ thể cung cấp.

**Chức năng:**

*   Nhận ID của nhà hàng từ URL parameter `{restaurant}`.
*   Truy vấn database để lấy danh sách các món ăn thuộc về nhà hàng có ID tương ứng.
*   Hỗ trợ phân trang cho danh sách món ăn (nếu có).
*   Trả về danh sách món ăn (có thể bao gồm thông tin như tên món, giá, hình ảnh, v.v.).

---
