<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://bhsjacket.local/wp-content/themes/crimson/js/js.cookie.min.js"></script>
<link rel="stylesheet" href="https://bhsjacket.local/wp-content/themes/crimson/style.css">
<link rel="stylesheet" href="https://bhsjacket.local/wp-content/themes/crimson/css/variables.css">
<link rel="stylesheet" href="https://use.typekit.net/erm4tbu.css">
<style>
    .coronavirus-stat-dc {
        width: 275px;
        height: 409.09px!important;
        box-sizing: border-box;
    }
</style> -->
<?php // require_once( '/Users/jerome/Local Sites/berkeley-high-jacket/app/public/wp-load.php' ); ?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/parts/front-page/dynamic-content/coronavirus.css">
<script src="<?php echo get_template_directory_uri(); ?>/js/sparkline.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/parts/front-page/dynamic-content/coronavirus.js"></script>

<a class="coronavirus-stat-dc loading" href="https://berkeleyhighjacket.com/2020/multimedia/live-coronavirus-data/">

    <h2 class="section-header">Covid-19</h2>
    <div class="chart">
        <svg class="berkeley-sparkline" width="245" height="93" stroke-width="3"></svg>
        <span class="chart-stat" data-stat="date">???</span>
        <div class="chart-dot"></div>
    </div>

    <div class="berkeley-box">
        <h3 class="coronavirus-title">Berkeley</h3>
        <div class="coronavirus-stats">
            <div class="coronavirus-stat">
                <span class="stat-number" data-stat="berkeley-total">???</span>
                <span class="stat-label">total cases</span>
            </div>
            <div class="coronavirus-stat">
                <span class="stat-number" data-stat="berkeley-new">??? new</span>
                <span class="stat-label">since yesterday</span>
            </div>
        </div>
    </div>

    <div class="coronavirus-divider"></div>

    <div class="alameda-box">
        <h3 class="coronavirus-title">Alameda County</h3>
        <div class="coronavirus-stats">
            <div class="coronavirus-stat">
                <span class="stat-number" data-stat="alameda-total">???</span>
                <span class="stat-label">total cases</span>
            </div>
            <div class="coronavirus-stat">
                <span class="stat-number" data-stat="alameda-new">??? new</span>
                <span class="stat-label">since yesterday</span>
            </div>
        </div>
    </div>

</a>