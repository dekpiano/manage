$('#tbStudent').DataTable({
    "order": [
        [2, "asc"],
        [3, "asc"]
    ],
    lengthMenu: [45, 100],
    processing: true,
    "ajax": {
        url: "../../../../admin/academic/ConAdminStudents/AdminStudentsNormalShow/" + $('#KeyStatus').val(),
        "type": "POST",
        "data": function ( d ) {
            d.classFilter = $('#classFilter').val();
        }
    },
    'columns': [
        { data: 'StudentCode' },
        { data: 'Fullname' },
        { data: 'StudentClass' },
        { data: 'StudentNumber' },
        { data: 'StudentStudyLine' },
        {
            data: 'StudentStatus',
            render: function(data, type, row) {
                if (data != "1/ปกติ") {
                    return '<a class="btn-sm btn-danger EditStudentStatus" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" key-stu="' + row.StudentID + '">' + data + '</a>';
                } else {
                    return '<a class="btn-sm app-btn-primary EditStudentStatus" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" key-stu="' + row.StudentID + '">' + data + '</a>';
                }
            }
        },
        {
            data: 'StudentBehavior',
            render: function(data, type, row) {
                if (data != "ปกติ") {
                    return '<a class="btn-sm btn-danger" href="#">' + data + '</a>';
                } else {
                    return '<a class="btn-sm app-btn-primary" href="#">' + data + '</a>';
                }

            }
        },
        {
            data: null, // No data source for this column
            orderable: false,
            render: function(data, type, row) {
                return '<button class="btn btn-sm btn-primary view-details" data-student-id="' + row.StudentID + '">ดู/แก้ไข</button>';
            }
        }
    ],
    "dom":  '<"row"<"col-sm-12 col-md-4"l><"col-sm-12 col-md-4 text-center"<"toolbar">><"col-sm-12 col-md-4"f>>' +
            '<"row"<"col-sm-12"tr>>' +
            '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
    initComplete: function(){
        $("div.toolbar").html($('#classFilterWrapper').html());
        $('#classFilterWrapper').remove();
        $('.toolbar').show();
    }
});

// Reload DataTable when class filter changes
$(document).on('change', '#classFilter', function() {
    $('#tbStudent').DataTable().ajax.reload();
});

$(document).on('click', '.view-details', function(event) {
    var studentId = $(this).data('student-id');
    if (studentId) {
        $.ajax({
            url: '../../../../admin/academic/ConAdminStudents/get_student_details/' + studentId,
            type: 'GET',
            dataType: 'json',
            beforeSend: function() {
                $('#studentDetailContent').html('<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>');
            },
            success: function(response) {
                if (response) {
                    var formHtml = buildStudentEditForm(response);
                    $('#studentDetailContent').html(formHtml);
                    var studentDetailModal = new bootstrap.Modal(document.getElementById('studentDetailModal'));
                    studentDetailModal.show();
                } else {
                    $('#studentDetailContent').html('<p class="text-danger">Could not find student details.</p>');
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: ", status, error);
                $('#studentDetailContent').html('<p class="text-danger">An error occurred while fetching the data.</p>');
            }
        });
    }
});

function buildStudentEditForm(data) {
    const val = (d) => d || '';

    const prefixOptions = ['เด็กชาย', 'เด็กหญิง', 'นาย', 'นางสาว'];
    const studentStatusOptions = [
        'เลือกสถานะ', '1/ปกติ', '2/ย้ายสถานศึกษา', '3/ขาดประจำ', '4/พักการเรียน', '5/จบการศึกษา'
    ];
    const studentBehaviorOptions = [
        'ปกติ', 'ขาดเรียนนาน', 'ย้ายสถานศึกษา', 'พักการเรียน', 'จบการศึกษา'
    ];
    const studentStudyLineOptions = [
        'เลือกสายการเรียน', 'CEP', 'CP', 'PAP1', 'PAP2', 'PAP3', 'PAP4', 'SMT(S)', 'SMT(T)', 'SP1', 'SP2', 'SP3', 'SP4'
    ];
    const bloodTypeOptions = [
        'เลือกกรุ๊ปเลือด', 'A', 'B', 'AB', 'O'
    ];
    const nationalityOptions = [
        'เลือกเชื้อชาติ', 'ไทย', 'จีน', 'มาเลเซีย', 'พม่า', 'ลาว', 'กัมพูชา', 'อื่นๆ'
    ];
    const raceOptions = [
        'เลือกสัญชาติ', 'ไทย', 'จีน', 'มาเลเซีย', 'พม่า', 'ลาว', 'กัมพูชา', 'อื่นๆ'
    ];
    const religionOptions = [
        'เลือกศาสนา', 'พุทธ', 'คริสต์', 'อิสลาม', 'ฮินดู', 'ซิกข์', 'อื่นๆ'
    ];

    const generateSelectOptions = (optionsArray, selectedValue) => {
        return optionsArray.map(option => 
            `<option value="${option}" ${option === selectedValue ? 'selected' : ''}>${option}</option>`
        ).join('');
    };

    return `
        <input type="hidden" name="StudentID" value="${val(data.StudentID)}">
        <input type="hidden" name="stu_idStu" value="${val(data.stu_idStu)}"> 
        
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="studentTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="personal-info-tab" data-bs-toggle="tab" data-bs-target="#personal-info" type="button" role="tab" aria-controls="personal-info" aria-selected="true">ข้อมูลนักเรียน</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="address-info-tab" data-bs-toggle="tab" data-bs-target="#address-info" type="button" role="tab" aria-controls="address-info" aria-selected="false">ที่อยู่</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="other-info-tab" data-bs-toggle="tab" data-bs-target="#other-info" type="button" role="tab" aria-controls="other-info" aria-selected="false">ข้อมูลอื่นๆ</button>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content" id="studentTabContent">
            <!-- Personal Info Tab -->
            <div class="tab-pane fade show active" id="personal-info" role="tabpanel" aria-labelledby="personal-info-tab">
                <div class="row mt-3">
                    <div class="col-md-2">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="StudentCode" name="StudentCode" value="${val(data.StudentCode)}" readonly>
                            <label for="StudentCode">รหัสนักเรียน</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="StudentPrefix" name="StudentPrefix">
                                ${generateSelectOptions(prefixOptions, val(data.StudentPrefix))}
                            </select>
                            <label for="StudentPrefix">คำนำหน้า</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="StudentFirstName" name="StudentFirstName" value="${val(data.StudentFirstName)}">
                            <label for="StudentFirstName">ชื่อ</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="StudentLastName" name="StudentLastName" value="${val(data.StudentLastName)}">
                            <label for="StudentLastName">นามสกุล</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="stu_nickName" name="stu_nickName" value="${val(data.stu_nickName)}">
                            <label for="stu_nickName">ชื่อเล่น</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="StudentIDNumber" name="StudentIDNumber" value="${val(data.StudentIDNumber)}">
                            <label for="StudentIDNumber">เลขประจำตัวประชาชน</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="StudentDateBirth" name="StudentDateBirth" value="${val(data.StudentDateBirth)}">
                            <label for="StudentDateBirth">วันเกิด</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="StudentClass" name="StudentClass" value="${val(data.StudentClass)}">
                            <label for="StudentClass">ชั้นปี</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="StudentNumber" name="StudentNumber" value="${val(data.StudentNumber)}">
                            <label for="StudentNumber">เลขที่</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="StudentStudyLine" name="StudentStudyLine">
                                ${generateSelectOptions(studentStudyLineOptions, val(data.StudentStudyLine))}
                            </select>
                            <label for="StudentStudyLine">สายการเรียน</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="StudentStatus" name="StudentStatus">
                                ${generateSelectOptions(studentStatusOptions, val(data.StudentStatus))}
                            </select>
                            <label for="StudentStatus">สถานะนักเรียน</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="StudentBehavior" name="StudentBehavior">
                                ${generateSelectOptions(studentBehaviorOptions, val(data.StudentBehavior))}
                            </select>
                            <label for="StudentBehavior">สถานะพฤติกรรม</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Address Info Tab -->
            <div class="tab-pane fade" id="address-info" role="tabpanel" aria-labelledby="address-info-tab">
                 <h5 class="mt-3">ที่อยู่ตามทะเบียนบ้าน</h5>
                 <div class="row">
                    <div class="col-md-2">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="stu_hCode" name="stu_hCode" value="${val(data.stu_hCode)}">
                            <label for="stu_hCode">รหัสประจำบ้าน</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="stu_hNumber" name="stu_hNumber" value="${val(data.stu_hNumber)}">
                            <label for="stu_hNumber">บ้านเลขที่</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="stu_hMoo" name="stu_hMoo" value="${val(data.stu_hMoo)}">
                            <label for="stu_hMoo">หมู่</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="stu_hRoad" name="stu_hRoad" value="${val(data.stu_hRoad)}">
                            <label for="stu_hRoad">ถนน</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="stu_hTambon" name="stu_hTambon" value="${val(data.stu_hTambon)}">
                            <label for="stu_hTambon">ตำบล</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="stu_hDistrict" name="stu_hDistrict" value="${val(data.stu_hDistrict)}">
                            <label for="stu_hDistrict">อำเภอ</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="stu_hProvince" name="stu_hProvince" value="${val(data.stu_hProvince)}">
                            <label for="stu_hProvince">จังหวัด</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="stu_hPostCode" name="stu_hPostCode" value="${val(data.stu_hPostCode)}">
                            <label for="stu_hPostCode">รหัสไปรษณีย์</label>
                        </div>
                    </div>
                 </div>
                 <h5 class="mt-3">ที่อยู่ปัจจุบัน</h5>
                 <div class="row">
                    <div class="col-md-2">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="stu_cNumber" name="stu_cNumber" value="${val(data.stu_cNumber)}">
                            <label for="stu_cNumber">บ้านเลขที่</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="stu_cMoo" name="stu_cMoo" value="${val(data.stu_cMoo)}">
                            <label for="stu_cMoo">หมู่</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="stu_cRoad" name="stu_cRoad" value="${val(data.stu_cRoad)}">
                            <label for="stu_cRoad">ถนน</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="stu_cTumbao" name="stu_cTumbao" value="${val(data.stu_cTumbao)}">
                            <label for="stu_cTumbao">ตำบล</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="stu_cDistrict" name="stu_cDistrict" value="${val(data.stu_cDistrict)}">
                            <label for="stu_cDistrict">อำเภอ</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="stu_cProvince" name="stu_cProvince" value="${val(data.stu_cProvince)}">
                            <label for="stu_cProvince">จังหวัด</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="stu_cPostcode" name="stu_cPostcode" value="${val(data.stu_cPostcode)}">
                            <label for="stu_cPostcode">รหัสไปรษณีย์</label>
                        </div>
                    </div>
                 </div>
            </div>

            <!-- Other Info Tab -->
            <div class="tab-pane fade" id="other-info" role="tabpanel" aria-labelledby="other-info-tab">
                <div class="row mt-3">
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="stu_phone" name="stu_phone" value="${val(data.stu_phone)}">
                            <label for="stu_phone">เบอร์โทรศัพท์</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="stu_email" name="stu_email" value="${val(data.stu_email)}">
                            <label for="stu_email">อีเมล</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="stu_bloodType" name="stu_bloodType">
                                ${generateSelectOptions(bloodTypeOptions, val(data.stu_bloodType))}
                            </select>
                            <label for="stu_bloodType">กรุ๊ปเลือด</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="stu_diseaes" name="stu_diseaes" value="${val(data.stu_diseaes)}">
                            <label for="stu_diseaes">โรคประจำตัว</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="stu_nationality" name="stu_nationality">
                                ${generateSelectOptions(nationalityOptions, val(data.stu_nationality))}
                            </select>
                            <label for="stu_nationality">เชื้อชาติ</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="stu_race" name="stu_race">
                                ${generateSelectOptions(raceOptions, val(data.stu_race))}
                            </select>
                            <label for="stu_race">สัญชาติ</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="stu_religion" name="stu_religion">
                                ${generateSelectOptions(religionOptions, val(data.stu_religion))}
                            </select>
                            <label for="stu_religion">ศาสนา</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="stu_wieght" name="stu_wieght" value="${val(data.stu_wieght)}">
                            <label for="stu_wieght">น้ำหนัก</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="stu_hieght" name="stu_hieght" value="${val(data.stu_hieght)}">
                            <label for="stu_hieght">ส่วนสูง</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
}

$(document).on('submit', '#editStudentForm', function(e) {
    e.preventDefault();
    var formData = $(this).serialize();

    $.ajax({
        url: '../../../../admin/academic/ConAdminStudents/update_student_details',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.status == 'success') {
                var studentDetailModal = bootstrap.Modal.getInstance(document.getElementById('studentDetailModal'));
                studentDetailModal.hide();
                
                Swal.fire({
                    icon: 'success',
                    title: 'สำเร็จ',
                    text: response.message,
                    timer: 2000,
                    showConfirmButton: false
                });

                $('#tbStudent').DataTable().ajax.reload(null, false);
            } else {
                 Swal.fire({
                    icon: 'error',
                    title: 'ผิดพลาด',
                    text: response.message
                });
            }
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'ผิดพลาด',
                text: 'ไม่สามารถบันทึกข้อมูลได้ โปรดลองอีกครั้ง'
            });
        }
    });
});


$(document).on('click', '.EditStudentStatus', function() {
    $('#keystu').val($(this).attr('key-stu'));
});

$(document).on('change', '.StudentStatus', function() {
    let StudentStatus = $(this).val();
    let KeyStuId = $('#keystu').val();
    $.post("../../../../admin/academic/ConAdminStudents/AdminUpdateStudentStatus", {
            KeyStuId: KeyStuId,
            ValueStudentStatus: StudentStatus
        },
        function(data, status) {
            if (data == 1) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'เปลี่ยนแปลงสถานะเป็น' + StudentStatus,
                    showConfirmButton: false,
                    timer: 3000
                })
                document.getElementById("StudentStatus").selectedIndex = 0;
                 $('#tbStudent').DataTable().ajax.reload(null, false);
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'ผิดพลาด',
                    showConfirmButton: false,
                    timer: 3000
                })
                document.getElementById("StudentStatus").selectedIndex = 0;
            }
        });
});