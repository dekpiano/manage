var tablel_Subject;
tablel_Subject = $('#tbSubject').DataTable({
    "order": [
        [1, "asc"]
    ],
    'processing': true,
    "ajax": {
        url: "../../admin/academic/ConAdminRegisterSubject/AdminRegisterSubjectSelect",
        "type": "POST"
    },
    'columns': [
        { data: 'SubjectYear' },
        { data: 'SubjectCode' },
        { data: 'SubjectName' },
        { data: 'FirstGroup' },
        { data: 'SubjectClass' },
        { data: 'SubjectYear' },
        {
            data: 'SubjectID',
            render: function(data, type, row) {
                return '<a href="#" idSbuj="' + data + '" class="btn btn-danger btn-sm delete_subject">ลบ</a> ';
            }
        }
    ]
});
// จัดการนักเรียน  

$(document).on('submit', '#form-subject', function(e) {
    e.preventDefault();
    //console.log($(this).serialize());

    $.ajax({
        url: '../../admin/academic/ConAdminRegisterSubject/AdminRegisterSubjectInsert',
        type: 'post',
        data: $(this).serialize(),
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {
            console.log(data);
            if (data > 0) {
                $('#form-subject')[0].reset();
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'บันทึกข้อมูลสำเร็จ',
                    showConfirmButton: false,
                    timer: 3000
                })
                tablel_Subject.ajax.reload();
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'ข้อมูลรายวิชานี้ ได้ลงทะเบียนในภาคเรียนนี้แล้ว',
                    showConfirmButton: false,
                    timer: 5000
                })
            }

        }
    });
});


$(document).on('click', '.delete_subject', function() {
    var id = $(this).attr("idSbuj");

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
                url: '../../admin/academic/ConAdminRegisterSubject/AdminRegisterSubjectDelete/' + id,
                type: 'DELETE',
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'ลบข้อมูลสำเร็จ',
                        showConfirmButton: false,
                        timer: 1000
                    })
                    tablel_Subject.ajax.reload();
                }
            });
        }
    })
});