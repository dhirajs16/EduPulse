

// console.log("admin")
$(document).ready(function () {
    $("body").on("submit", ".delete-role-form", function (e) {
        e.preventDefault(); // Prevent the form from submitting immediately

        const form = this; // Store reference to the form

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // Submit the form if confirmed
            }
        });
    });
});
