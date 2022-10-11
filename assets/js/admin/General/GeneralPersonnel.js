// Example starter JavaScript for disabling form submissions if there are invalid fields

var pers_academic = new SlimSelect({
    select: '#pers_academic'
})
var pers_learning = new SlimSelect({
    select: '#pers_learning'
})
var pers_position = new SlimSelect({
    select: '#pers_position'
})
var pers_prefix = new SlimSelect({
    select: '#pers_prefix'
})
var pers_status = new SlimSelect({
    select: '#pers_status'
})
var pers_groupleade = new SlimSelect({
    select: '#pers_groupleade'
})

var tbErollSubject;
tbErollSubject = $('#TbPersonnelMain').DataTable({
    "order": [
        [1, "desc"]
    ],
    'processing': true,
    "ajax": {
        url: "../../../admin/General/ConAdminGeneralPersonnel/ShowDataPersonnel",
        "type": "POST"
    },
    'columns': [
        { data: 'TeacherName' },
        { data: 'pers_learning' },
        { data: 'pers_position' },
        { data: 'pers_status' },
        {
            data: 'TeacherID',
            render: function(data, type, row) {
                return '<a href="#" class="badge bg-warning BtnEditPersonnel"  pres-id="' + data + '">แก้ไข</a>|<a href="#" class="badge bg-danger DeletePersonnal" key-teacher="' + data + '" key-img="' + row.pers_img + '">ลบ</a>';
            }
        }

    ]
});


$(document).on("click", "#BtnAddPersonnel", function() {
    $('#ModalEditTech').modal('show');
    $('#form-personnal').attr('action', '../../../admin/General/ConAdminGeneralPersonnel/InsertDataPersonnel');
    $('#form-personnal')[0].reset();
    $('#ShowImgPresol').attr('src', '../../../uploads/usericon.png');
    pers_status.set('กำลังใช้งาน');
    pers_prefix.set('');
    pers_academic.set('');
    pers_learning.set('');
    pers_position.set('');
});
$(document).on("click", ".BtnEditPersonnel", function() {
    $('#ModalEditTech').modal('show');
    $('#pers_img').val('');

    $.post("../../../admin/General/ConAdminGeneralPersonnel/EditDataPersonnel", { KeyPresID: $(this).attr('pres-id') }, function(data, status) {
        //console.log(data);
        pers_status.set(data[0].pers_status);
        pers_prefix.set(data[0].pers_prefix);
        pers_academic.set(data[0].pers_academic);
        pers_learning.set(data[0].pers_learning);
        pers_position.set(data[0].pers_position);
        pers_groupleade.set(data[0].pers_groupleade);
        $('#pers_firstname').val(data[0].pers_firstname);
        $('#pers_lastname').val(data[0].pers_lastname);
        $('#pers_britday').val(data[0].pers_britday);
        $('#pers_phone').val(data[0].pers_phone);
        $('#pers_address').val(data[0].pers_address);
        $('#pers_username').val(data[0].pers_username);
        $('#pers_id').val(data[0].pers_id);
        if (data[0].pers_img != "") {
            $('#ShowImgPresol').attr("src", "../../../uploads/General/Personnel/" + data[0].pers_img);
        }

        $('#form-personnal').attr('action', '../../../admin/General/ConAdminGeneralPersonnel/UpdateDataPersonnel/' + data[0].pers_id);

    }, 'json');
});

$(document).on("submit", "#form-personnal", function(e) {
    e.preventDefault();

    $.ajax({
        url: $('#form-personnal').attr('action'),
        type: "post",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function(data) {
            console.log(data);
            if (data == 1) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'บันทึกข้อมูลสำเร็จ',
                    showConfirmButton: false,
                    timer: 3000
                })
                $('#ModalEditTech').modal('hide');
            }
        }
    });
});

$(document).on("click", ".DeletePersonnal", function() {
    //console.log($(this).attr('key-teacher'));
    Swal.fire({
        title: 'ต้องการลบบุคลากรออกจากฐานข้อมูลหรือไม่?',
        text: 'ข้อมูลจะถูกลบออกจากฐานข้อมูล',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
    }).then((result) => {
        if (result.isConfirmed) {
            $(this).parents('tr').remove();

            $.post("../../../admin/General/ConAdminGeneralPersonnel/DeletePersonnel", {
                KeyTeacher: $(this).attr('key-teacher'),
                KeyImg: $(this).attr('key-img')
            }, function(data, status) {
                console.log(data);

            });

            Swal.fire(
                'ลบข้อมูลเรียบร้อย!',
                'Your data has been deleted.',
                'success'
            )
        }
    })
});