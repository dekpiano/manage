/*global $, document*/
$(document).ready(function() {

    'use strict';


    // ------------------------------------------------------- //
    // Charts Gradients
    // ------------------------------------------------------ //
    var ctx1 = $("canvas").get(0).getContext("2d");
    var gradient1 = ctx1.createLinearGradient(150, 0, 150, 300);
    gradient1.addColorStop(0, 'rgba(133, 180, 242, 0.91)');
    gradient1.addColorStop(1, 'rgba(255, 119, 119, 0.94)');

    var gradient2 = ctx1.createLinearGradient(146.000, 0.000, 154.000, 300.000);
    gradient2.addColorStop(0, 'rgba(104, 179, 112, 0.85)');
    gradient2.addColorStop(1, 'rgba(76, 162, 205, 0.85)');


    // ------------------------------------------------------- //
    // Bar Chart
    // ------------------------------------------------------ //

    $.post('../../teacher/ConTeacherTeaching/ChartHomeRoom', function(show) {
        console.log(show);
        var BARCHARTEXMPLE = $('#barChartExample');
        var barChartExample = new Chart(BARCHARTEXMPLE, {
            type: 'bar',
            data: {
                labels: ["มา", "ขาด", "สาย", "ลา", "กิจกรรม", "ไม่เข้าแถว"],
                datasets: [{
                    label: 'จำนวน',
                    data: show,
                    backgroundColor: [
                        'rgba(121, 106, 238, 1)',
                        'rgba(255, 118, 118, 1)',
                        'rgba(84, 230, 157, 1)',
                        'rgba(255, 195, 109, 1)',
                        'rgba(109, 242, 255, 1)',
                        'rgba(255, 109, 244, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        });

    }, "json")




});