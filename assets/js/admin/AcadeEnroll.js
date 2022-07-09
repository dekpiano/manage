// Example starter JavaScript for disabling form submissions if there are invalid fields

var tbErollSubject;
tbErollSubject = $('#tbErollSubject').DataTable({
    "order": [
        [1, "asc"]
    ],
    'processing': true,
    "ajax": {
        url: "../../admin/academic/ConAdminEnroll/AdminEnrollSubject",
        "type": "POST"
    },
    'columns': [
        { data: 'SubjectYear' },
        { data: 'SubjectCode' },
        { data: 'SubjectName' },
        { data: 'FirstGroup' },
        { data: 'SubjectClass' },
        {
            data: 'TeacherName',
            render: function(data, type, row) {
                return data;
            }
        },
        {
            data: 'SubjectID',
            render: function(data, type, row) {
                return '<a href="../../Admin/Acade/Enroll/Edit/' + row.SubjectID + '/' + row.TeacherID + '"  class="btn btn-primary btn-sm text-white">ลงทะเบียนแล้ว</a> ';
            }
        }
    ]
});

var form = document.getElementById('FormEnroll')
form.addEventListener('submit', function(event) {

    // add was-validated to display custom colors
    form.classList.add('was-validated')

    if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
    }

}, false)

$('#teacherregis').select2();
$('#subjectregis').select2();
$('#Room').select2();
$('#RoomEdit').select2();


$(document).on("change", "#Room", function() {

    $('#multiselect option').remove();

    $.post("../../../admin/academic/ConAdminEnroll/AdminEnrollSelect", { KeyRoom: $(this).val() }, function(data, status) {

        $.each(data, function(index, value) {
            //console.log(value);
            // trHTML = '<tr><td></td><td>' + value.StudentCode + '</td><td>' + value.StudentPrefix+value.StudentFirstName+' '+value.StudentLastName + '</td></tr>';
            trHTML = '<option value="' + value.StudentID + '">' + value.StudentClass + ' ' + value.StudentNumber + ' ' + value.StudentPrefix + value.StudentFirstName + ' ' + value.StudentLastName + '</option>';
            $('#multiselect').append(trHTML);
        });
    }, 'json');

});

$(document).on("change", "#RoomEdit", function() {

    $('#multiselect option').remove();

    $.post("../../../../../admin/academic/ConAdminEnroll/AdminEnrollSelect", { KeyRoom: $(this).val() }, function(data, status) {

        $.each(data, function(index, value) {
            //console.log(value);
            // trHTML = '<tr><td></td><td>' + value.StudentCode + '</td><td>' + value.StudentPrefix+value.StudentFirstName+' '+value.StudentLastName + '</td></tr>';
            trHTML = '<option value="' + value.StudentID + '">' + value.StudentClass + ' ' + value.StudentNumber + ' ' + value.StudentPrefix + value.StudentFirstName + ' ' + value.StudentLastName + '</option>';
            $('#multiselect').append(trHTML);
        });


    }, 'json');

});


$(document).on("submit", "#FormEnroll", function(e) {
    e.preventDefault();
    $.ajax({
        url: '../../../admin/academic/ConAdminEnroll/AdminEnrollInsert',
        type: 'post',
        data: $(this).serialize(),
        error: function() {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'นักเรียนในรายชื่อนี้ได้ลงทะเบียนวิชานี้ และปีนี้ไปแล้ว กรุณาเลือกและตรวจสอบใหม่',
                showConfirmButton: false,
                timer: 5000
            })
        },
        success: function(data) {

            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'บันทึกข้อมูลสำเร็จ',
                showConfirmButton: false,
                timer: 5000
            })

        }
    });
});