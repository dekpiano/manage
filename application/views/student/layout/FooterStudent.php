</div>
<!--//app-wrapper-->

<script src="<?=base_url();?>assets/plugins/jquery-3.4.1.min.js"></script>
<!-- Javascript -->
<script src="<?=base_url();?>assets/plugins/popper.min.js"></script>
<script src="<?=base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js">
          </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://unpkg.com/jquery-tabletotal@1.0.0"></script>
<!-- Page Specific JS -->
<script src="<?=base_url();?>assets/js/app.js"></script>
<script src="<?=base_url();?>assets/js/student/ExtraSubject_js.js?v=3"></script>

<script>

$('.Loader').on('click', function() {
    $.LoadingOverlay("show");    
});
$.LoadingOverlay("hide");


$(document).ready(function() {
    calculateColumnUnit(1); //ผลรวมตำแหน่งที่ 1 หน่วยกิต
    calculateColumnGrade(2); //ผลรวมตำแหน่งที่ 2               
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
    averageGrade = totalGrade / (totalUnit);
    //console.log(parseFloat(totalUnit));
    $('.ShowGrade .tfoot th').eq(index).text(parseFloat(String(averageGrade).substring(0, 4)).toFixed(2));
}
</script>
</body>

</html>