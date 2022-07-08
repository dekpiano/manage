// Example starter JavaScript for disabling form submissions if there are invalid fields
var form = document.getElementById('FormEnroll')
form.addEventListener('submit', function(event) {

    // add was-validated to display custom colors
    form.classList.add('was-validated')

    if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
    }

}, false)

new TomSelect("#teacherregis", {
    create: true,
    sortField: {
        field: "text"
    }
});

new TomSelect("#Room", {
    create: true,
    sortField: {
        field: "text"
    }
});

new TomSelect("#subjectregis");

$(document).on("change", "#Room", function() {

    $('#multiselect option').remove();

    $.post("../../../admin/academic/ConAdminEnroll/AdminEnrollSelect", { KeyRoom: $(this).val() }, function(data, status) {

        $.each(data, function(index, value) {
            //console.log(value);
            // trHTML = '<tr><td></td><td>' + value.StudentCode + '</td><td>' + value.StudentPrefix+value.StudentFirstName+' '+value.StudentLastName + '</td></tr>';
            trHTML = '<option value="' + value.StudentID + '">' + value.StudentCode + ' ' + value.StudentNumber + ' ' + value.StudentPrefix + value.StudentFirstName + ' ' + value.StudentLastName + '</option>';
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