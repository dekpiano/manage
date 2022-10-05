$('#tbStudent').DataTable({
    "order": [
        [2, "asc"],
        [3, "asc"]
    ],
    lengthMenu: [45, 100],
    processing: true,
});
// จัดการนักเรียน
$(document).on('click', '.delete_student', function() {
    var id = $(this).attr("idStu");

    Swal.fire({
        title: 'Are you sure?',
        text: "คุณต้องการลลข้อมูลหรือไม่!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../../admin/academic/ConAdminStudents/AdminStudentsDelete/' + id,
                type: 'DELETE',
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                    $("." + id).remove();
                    Swal.fire(
                        'Deleted!',
                        'คุณลบไฟล์สำเร็จ',
                        'success'
                    )
                }
            });
        }
    })
});