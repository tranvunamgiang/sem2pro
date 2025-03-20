function validateForm() {
    let valid = true;

    // Lấy giá trị của các trường thông tin khách hàng
    let name = document.getElementById("customer_name").value.trim();
    let email = document.getElementById("email").value.trim();
    let address = document.getElementById("shipping_address").value.trim();
    let telephone = document.getElementById("telephone").value.trim();
    let paymentMethod = document.querySelector('input[name="payment_method"]:checked');

    // Kiểm tra thông tin khách hàng không được để trống
    if (name === "") {
        document.getElementById("nameError").innerText = "Full Name is required.";
        valid = false;
    } else {
        document.getElementById("nameError").innerText = "";
    }

    if (email === "") {
        document.getElementById("emailError").innerText = "Email is required.";
        valid = false;
    } else {
        document.getElementById("emailError").innerText = "";
    }

    if (address === "") {
        document.getElementById("addressError").innerText = "Shipping Address is required.";
        valid = false;
    } else {
        document.getElementById("addressError").innerText = "";
    }

    if (telephone === "") {
        document.getElementById("telephoneError").innerText = "Telephone is required.";
        valid = false;
    } else {
        document.getElementById("telephoneError").innerText = "";
    }

    // Kiểm tra phương thức thanh toán đã chọn chưa
    if (!paymentMethod) {
        alert("Please select a payment method.");
        valid = false;
    }

    return valid;
}
