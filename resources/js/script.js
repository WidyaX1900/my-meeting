$(function() {
    $("#addMeetingRoomBtn").on("click", function () {
        $("#addMeetingRoomFormModal").modal("show");
        $("#alertInfo").html("");
    });

    let timeout;
    $("#addMeetingRoomForm").on("submit", function (event) {
        event.preventDefault();
        $("#alertInfo").html("");

        $('.ajax-error').each(function () {
            timeout = $(this).data("timeout");
            if (timeout) clearTimeout(timeout);
            $(this).html("");
        });

        const formObj = $(this)[0];
        const formData = new FormData(formObj);

        $.ajax({
            url: "/meeting_room/store",
            method: "post",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.status === "success") {
                    $("#meetingRoomTable").load(location.href + " #meetingRoomTable > *");
                    $("#name").val("");
                    $("#addMeetingRoomFormModal").modal("hide");

                }

                if (response.validation_errors) {
                    const errors = response.validation_errors;
                    Object.entries(errors).forEach(([field, error]) => {
                        const html = `<i class="fa-solid fa-circle-info"></i> ${error}`;

                        $(`#${field}-error`).html(html);
                        timeout = setTimeout(() => {
                            $(`#${field}-error`).html("");
                        }, 5000);

                        $(`#${field}-error`).data("timeout", timeout);
                    });
                }

            },
        });
    });
});