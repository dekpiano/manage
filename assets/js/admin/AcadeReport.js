$('.ShowStudent').DataTable({
    "order": [
        [4, "asc"],
        [1, "asc"]
    ]
});

$('.tblGrade').DataTable({
    "order": [
        [0, "asc"]
    ],
    dom: 'Bfrtip',
    buttons: [
        'copy', 'excel', 'pdf', 'print'
    ]
});



$('#tblGrade tbody tr').each(function() {

    var totalGrade = 0;
    var totalUnit = 0;
    var averageGrade = 0;

    $(this).find('.showGrade').each(function() {
        var valueUnit = parseFloat($(this).attr('data_unit'));
        var valueGrade = parseFloat($(this).text());
        value = valueUnit * valueGrade;

        if (!isNaN(valueUnit)) {
            totalUnit += valueUnit;
        }

        if (!isNaN(valueGrade)) {
            totalGrade += valueGrade;
        }
        averageGrade = totalGrade / totalUnit;
        console.log(String(averageGrade).substring(0, 4));
    });

    $(this).find('.totalGrade').html(String(averageGrade).substring(0, 4));
});