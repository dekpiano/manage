$('#tbStudent').DataTable({
    "order": [
        [2, "asc"],
        [3, "asc"]
    ],
    lengthMenu: [45, 100],
    processing: true,
    "ajax": {
        url: "../../../../admin/academic/ConAdminStudents/AdminStudentsNormalShow",
        "type": "POST"
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
        }
    ]
});

$(document).on('click', '.EditStudentStatus', function() {
    console.log($(this).attr('key-stu'));
    $('#keystu').val($(this).attr('key-stu'));
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


$(document).on('change', '.StudentBehavior', function() {
    let StatusBehavior = $(this).val();
    let KeyStuId = $(this).attr('data-stuid');
    $.post("../../../../admin/academic/ConAdminStudents/AdminUpdateStudentBehavior", {
            KeyStuId: KeyStuId,
            ValueBehavior: StatusBehavior
        },
        function(data, status) {
            console.log(data);
            if (data == 1) {
                // $('#tbStudent tr.' + KeyStuId).remove();
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'เปลี่ยนแปลงสถานะเป็น' + StatusBehavior,
                    showConfirmButton: false,
                    timer: 3000
                })

            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'เปลี่ยนแปลงสถานะเป็น' + StatusBehavior,
                    showConfirmButton: false,
                    timer: 3000
                })

            }
        });
});

$(document).on('change', '.StudentStatus', function() {
    let StudentStatus = $(this).val();
    let KeyStuId = $('#keystu').val();
    $.post("../../../../admin/academic/ConAdminStudents/AdminUpdateStudentStatus", {
            KeyStuId: KeyStuId,
            ValueStudentStatus: StudentStatus
        },
        function(data, status) {
            console.log(data);
            if (data == 1) {
                // $('#tbStudent tr.' + KeyStuId).remove();
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'เปลี่ยนแปลงสถานะเป็น' + StudentStatus,
                    showConfirmButton: false,
                    timer: 3000
                })

            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'เปลี่ยนแปลงสถานะเป็น' + StudentStatus,
                    showConfirmButton: false,
                    timer: 3000
                })

            }
        });
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
    // console.log(parseFloat(String(averageGrade).substring(0, 4)).toFixed(2));
    $('.ShowGrade .tfoot th').eq(index).text(parseFloat(String(averageGrade).substring(0, 4)).toFixed(2));
}

calculateColumnUnit(1); //ผลรวมตำแหน่งที่ 1 หน่วยกิต
calculateColumnGrade(2); //ผลรวมตำแหน่งที่ 2


// Chart นักเรียน

window.chartColors = {
    green: '#75c181', // rgba(117,193,129, 1)
    blue: '#5b99ea', // rgba(91,153,234, 1)
    gray: '#a9b5c9',
    text: '#252930',
    border: '#e7e9ed'
};
/* Random number generator for demo purpose */
var randomDataPoint = function() { return Math.round(Math.random() * 100) };

$.post("../../../admin/academic/ConAdminStudents/ChartStudentsAll", {

    },
    function(data, status) {
        //console.log(data);
        myDoughnut.data.datasets[0].data = data;
        myDoughnut.update();
    }, "json"
);

var doughnutChartConfig = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [],
            backgroundColor: [
                window.chartColors.green,
                window.chartColors.blue,

            ],
            label: 'Dataset 1'
        }],
        labels: [
            'ชาย',
            'หญิง',
        ]
    },
    options: {
        responsive: true,
        legend: {
            display: true,
            position: 'bottom',
            align: 'center',
        },

        tooltips: {
            enabled: false,
            titleMarginBottom: 10,
            bodySpacing: 10,
            xPadding: 16,
            yPadding: 16,
            borderColor: window.chartColors.border,
            borderWidth: 1,
            backgroundColor: '#fff',
            bodyFontColor: window.chartColors.text,
            titleFontColor: window.chartColors.text,

            animation: {
                animateScale: true,
                animateRotate: true
            },

            /* Display % in tooltip - https://stackoverflow.com/questions/37257034/chart-js-2-0-doughnut-tooltip-percentages */
            callbacks: {
                label: function(tooltipItem, data) {
                    //get the concerned dataset
                    var dataset = data.datasets[tooltipItem.datasetIndex];
                    //calculate the total of this data set
                    var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                        return previousValue + currentValue;
                    });
                    //get the current items value
                    var currentValue = dataset.data[tooltipItem.index];
                    //calculate the precentage based on the total and current item, also this does a rough rounding to give a whole number
                    var percentage = Math.floor(((currentValue / total) * 100) + 0.5);

                    return percentage + "%";
                },
            },


        },
    }
};

var doughnutChart = document.getElementById('chart-doughnut').getContext('2d');
window.myDoughnut = new Chart(doughnutChart, doughnutChartConfig);