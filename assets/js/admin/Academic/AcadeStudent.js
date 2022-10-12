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
                url: '../../../admin/academic/ConAdminStudents/AdminStudentsDelete/' + id,
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

function calculateColumnUnit(index) {
    var total = 0;
    $('.ShowGrade tbody tr').each(function() {
        var value = parseFloat($('td', this).eq(2).text());
        if (!isNaN(value)) {
            total += value;
        }
    });
    $('.ShowGrade .tfoot th').eq(index).text(total);
}

function calculateColumnGrade(index) {
    var totalGrade = 0;
    var totalUnit = 0;
    var averageGrade = 0;

    $('.ShowGrade tbody tr').each(function() {
        var valueUnit = parseFloat($('td', this).eq(2).text());
        var valueGrade = parseFloat($('td', this).eq(3).text());

        if (!isNaN(valueGrade)) {
            if (!isNaN(valueUnit)) {
                totalUnit += valueUnit;
            }
            totalGrade += valueUnit * valueGrade;
        }

    });
    averageGrade = totalGrade / totalUnit;
    console.log(parseFloat(String(averageGrade).substring(0, 4)).toFixed(2));
    $('.ShowGrade .tfoot th').eq(index).text(parseFloat(String(averageGrade).substring(0, 4)).toFixed(2));
}

calculateColumnUnit(1); //ผลรวมตำแหน่งที่ 1 หน่วยกิต
calculateColumnGrade(2); //ผลรวมตำแหน่งที่ 2