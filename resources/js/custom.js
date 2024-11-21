
// Hàm bật/tắt trường khi role_id là Customer
function toggleFields(roleId) {
    const isCustomer = roleId == 2;
    const fields = ['name', 'address', 'email', 'phone'];

    fields.forEach(function (field) {
        const element = document.getElementById(field);
        if (element) {
            element.disabled = isCustomer;
        }
    });
}

// Kiểm tra role_id hiện tại khi tải trang
document.addEventListener('DOMContentLoaded', function () {
    const roleElement = document.getElementById('role_id');
    if (roleElement) {
        toggleFields(roleElement.value);

        // Lắng nghe sự kiện thay đổi role_id
        roleElement.addEventListener('change', function () {
            toggleFields(this.value);
        });
    }
});
