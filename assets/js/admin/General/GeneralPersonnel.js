// Example starter JavaScript for disabling form submissions if there are invalid fields


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
                return '<a href="" class="badge bg-warning">แก้ไข</a>|<a href="" class="badge bg-danger">ลบ</a>';
            }
        }

    ]
});