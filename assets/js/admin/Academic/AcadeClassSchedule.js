  // แสดงภาพตัวอย่างเมื่อเลือกไฟล์
  $('#schestu_filename').on('change', function (event) {
    var reader = new FileReader();
    reader.onload = function (e) {
        $('#previewImage').attr('src', e.target.result).show();
    }
    reader.readAsDataURL(event.target.files[0]);
});

$(document).on('submit','.FormAddClassSchedule', function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    var action = $(this).attr('action');

    $.ajax({
        url: action,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            if(response == 1){
                Swal.fire({
                    title: "แจ้งเตือน?",
                    text: "คุณเพิ่มตารางเรียนเรียบร้อยแล้ว!",
                    icon: "success",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "ตกลง!"
                  }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../ClassSchedule';
                    }
                  });
            }

        },
        error: function (xhr, status, error) {
            console.log(("Error: " + xhr.responseText));
        }
    });
});