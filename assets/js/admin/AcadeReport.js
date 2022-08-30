$('.ShowStudent').DataTable({
    "order": [
        [4, "asc"],
        [1, "asc"]
    ]
});

$('.tblGrand').DataTable({
    "order": [
        [0, "asc"]
    ]
});



// $('#tblGrand tbody tr').each(function() {
//     var totmarks = 0;
//     $(this).find('.check_score').each(function() {
//         var marks = $(this).text();


//         if (marks >= 0) {
//             totmarks += parseFloat(marks) || 0;

//         }


//     });

//     $(this).find('.totalCol').html(totmarks);
// });