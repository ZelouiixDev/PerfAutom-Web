$(document).ready(function() {
    $.get("controller.php?action=get_treatments", {
        "syringe_id": $("#syringe_id").val(),
        "patient_id": $("#patient_id").val()
    }).done(function (data) {
        evolution = [];
        dates = [];
        treatments = JSON.parse(data);
        treatments.forEach(function(treatment){
            dates.push(treatment.date_time);
            evolution.push(treatment.new_dose);
        });
        var ctx = document.getElementById('treatment_evolution_chart').getContext('2d');
        var evolution_chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: "Evolution ",
                    lineTension: 0.3,
                    backgroundColor: "rgba(2,117,216,0.2)",
                    borderColor: "rgba(2,117,216,1)",
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(2,117,216,1)",
                    pointBorderColor: "rgba(255,255,255,0.8)",
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(2,117,216,1)",
                    pointHitRadius: 50,
                    pointBorderWidth: 2,
                    data: evolution
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            maxTicksLimit: 5
                        },
                        gridLines: {
                            color: "rgba(0, 0, 0, .125)",
                        }
                    }],
                },
                legend: {
                    display: false
                }
            }
        });
    });
});