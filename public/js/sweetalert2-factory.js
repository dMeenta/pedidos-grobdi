const ToastIcon = Object.freeze({
    SUCCESS: "success",
    ERROR: "error",
    WARNING: "warning",
    INFO: "info",
    QUESTION: "question",
});

function toast(message, icon = ToastIcon.INFO) {
    try {
        Swal.fire({
            toast: true,
            position: "top-end",
            icon: icon,
            title: message,
            showConfirmButton: false,
            timer: 2200,
            timerProgressBar: true,
        });
    } catch (error) {
        console.error(error);
    }
}
