<?php
$data = file_get_contents('https://jeromepaulos.com/bhsjacket/coronavirus/data.php?data=berkeley');
$data = json_decode($data, true);

foreach($data as $stat) {
    $labels[] = 'label';
    $cases[] = $stat['bklhj_cumulcases'];
    $new_cases[] = $stat['bklhj_newcases'];
}
$new_cases = array_reverse($new_cases);
$new_cases = $new_cases[0];
$total_cases = array_reverse($cases);
$total_cases = $total_cases[0];
$cases = implode(',', $cases);
$labels = implode("','", $labels);

$ac_data = file_get_contents('https://jeromepaulos.com/bhsjacket/coronavirus/data.php?data=alameda');
$ac_data = json_decode($ac_data, true);
$ac_data = array_reverse($ac_data);
$ac_data = $ac_data[0]['attributes'];
?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/parts/front-page/dynamic-content/coronavirus.css">

<a href="https://berkeleyhighjacket.com/2020/multimedia/live-coronavirus-data/" class="coronavirus-stat-dc">

    <h2 class="section-header">Covid-19</h2>
    <div class="chart">
        <canvas height="115px" id="chart"></canvas>
        <span class="chart-stat"><?php echo $total_cases; ?></span>
        <div class="chart-dot"></div>
    </div>

    <div class="berkeley-box">
        <h3 class="coronavirus-title">Berkeley</h3>
        <div class="coronavirus-stats">
            <div class="coronavirus-stat">
                <span class="stat-number"><?php echo $total_cases; ?></span>
                <span class="stat-label">total cases</span>
            </div>
            <div class="coronavirus-stat">
                <span class="stat-number"><?php echo $new_cases; ?> new</span>
                <span class="stat-label">since yesterday</span>
            </div>
        </div>
    </div>

    <div class="coronavirus-divider"></div>

    <div class="alameda-box">
        <h3 class="coronavirus-title">Alameda County</h3>
        <div class="coronavirus-stats">
            <div class="coronavirus-stat">
                <span class="stat-number"><?php echo number_format($ac_data['AC_CumulCases']); ?></span>
                <span class="stat-label">total cases</span>
            </div>
            <div class="coronavirus-stat">
                <span class="stat-number"><?php echo number_format($ac_data['AC_Cases']); ?> new</span>
                <span class="stat-label">since yesterday</span>
            </div>
        </div>
    </div>

</a>

<script src="<?php echo get_template_directory_uri(); ?>/js/Chart.min.js"></script>

<script>
$(document).ready(function(){
    Chart.defaults.global.animation.duration = 0;
    var chartId = $('#chart');
    var chart = new Chart(chartId, {
        type: 'line',
        data: {
            labels: ['<?php echo $labels; ?>'],
            datasets: [{
                lineTension: 0,
                data: [<?php echo $cases; ?>],
                label: 'Total Cases in Berkeley',
                borderColor: '#d48585',
                fill: 'none',
            }]
        },
        options: {
            layout: {
                padding: {
                    bottom: 2
                }
            },
            legend: {
                display: false
            },
            elements: {
                point:{
                    radius: 0,
                }
            },
            scales: {
                yAxes: [{
                    display: false,
                    ticks: {
                        stepSize: 1
                    }
                }],
                xAxes: [{
                    display: false
                }]
            },
            responsive: true,
            maintainAspectRatio: true,
        }
    });
});
</script>