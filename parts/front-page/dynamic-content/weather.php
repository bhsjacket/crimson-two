<?php

$apiKey = '47697438d4ba438b6cd5f5786542d2ef';
$endpoint = 'https://api.openweathermap.org/data/2.5/onecall?lat=37.8677468&lon=-122.2714278&exclude=minutely,hourly&appid=' . $apiKey;

$data = file_get_contents($endpoint);
$data = json_decode($data, true);

function k2f($temp) {
    return round( ($temp - 273.15) * 9/5 + 32 );
}

$temp = k2f($data['current']['temp']);
$feelsLike = k2f($data['current']['feels_like']);

$windSpeed = round( $data['current']['wind_speed'] );
$windDirection = $data['current']['wind_deg'];

$date = new DateTime();
$date->setTimestamp($data['current']['dt']);
$date->setTimezone( new DateTimeZone('America/Los_Angeles') );
$date = [
    'date' => $date->format('F j, Y'),
    'time' => $date->format('g:00 a'),
];

function getWeatherIcon($id, $returnName = false) {
    $iconIndex = [
        '01d' => 'sun',
        '01n' => 'moon',
        '02d' => 'cloudy-sun',
        '02n' => 'cloudy-moon',
        '03d' => 'cloud',
        '03n' => 'cloud',
        '04d' => 'cloudy',
        '04n' => 'cloudy',
        '09d' => 'rain',
        '09n' => 'night-rain',
        '10d' => 'drizzle',
        '10n' => 'night-drizzle',
        '11d' => 'storm',
        '11n' => 'storm',
        '50d' => 'fog',
        '50n' => 'fog',
        'smoke' => 'fire'
    ];
    if($returnName) {
        return $iconIndex[$id];
    }
    return get_template_directory_uri() . '/assets/weather/' . $iconIndex[$id] . '.svg';
}

$icon = getWeatherIcon($data['current']['weather'][0]['icon']);

$description = ucwords( $data['current']['weather'][0]['description'] );

$timeZone = new DateTimeZone('America/Los_Angeles');
$currentTime = new DateTime('now', $timeZone);
$morningStart = DateTime::createFromFormat('H:i a', '6:30 am', $timeZone);
$morningEnd = DateTime::createFromFormat('H:i a', '10:30 am', $timeZone);
$nightStart = DateTime::createFromFormat('H:i a', '8:00 pm', $timeZone);
$nightEnd = DateTime::createFromFormat('H:i a', '10:00 pm', $timeZone);
if ($currentTime > $morningStart && $currentTime < $morningEnd) {
    $isMorning = true;
    $isNight = false;
} else if($currentTime > $nightStart && $currentTime < $nightEnd) {
    $isMorning = false;
    $isNight = true;
}

$weatherDescription = str_replace( ['few clouds: 11-25%', 'scattered clouds: 25-50%', 'broken clouds: 51-84%', 'overcast clouds: 85-100%', 'broken clouds'], ['few clouds', 'scattered clouds', 'partly cloudy', 'overcast', 'overcast'], $data['current']['weather'][0]['description'] );
$weatherDescription = ucfirst($weatherDescription);

if( $weatherDescription == 'Smoke' ) {
    $aqi = file_get_contents('https://airnowgovapi.com/reportingarea/get?latitude=37.8677468&longitude=-122.2714278&stateCode=CA&maxDistance=20');
    $aqi = json_decode($aqi, true);
    foreach($aqi as $day) {
        if( new DateTime($day['issueDate']) == new DateTime('today') || new DateTime($day['validDate']) == new DateTime('today') ) {
            $aqi = null;
            $aqi = $day['aqi'];
            break;
        }
    }

    $icon = getWeatherIcon('smoke');
    $weatherDescription = $aqi . ' AQI' ?? 'Wildfire smoke';
}

foreach( $data['daily'] as $day ) {
    $forecast[] = [
        'date' => (new DateTime)->setTimestamp($day['dt']),
        'temp' => k2f($day['temp']['day']),
        'high' => k2f($day['temp']['max']),
        'low' => k2f($day['temp']['min']),
        'icon' => getWeatherIcon($day['weather'][0]['icon']),
        'iconName' => getWeatherIcon($day['weather'][0]['icon'], true)
    ];
}
unset($forecast[0]);

$weatherQuery = new WP_Query([
    'post_type' => ['post'],
	'post_status' => ['publish'],
	'posts_per_page' => 5,
	'order' => 'DESC',
    'tax_query' => [
        [
            'taxonomy' => 'syndication',
            'field' => 'slug',
            'terms' => ['front-feature'],
            'operator' => 'NOT IN'
        ]
    ]
])

?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/parts/front-page/dynamic-content/weather.css">

<div class="weather <?php if($isMorning){ echo 'morning'; } elseif($isNight){ echo 'night'; } elseif(!$isNight && !$isMorning) { echo 'evening'; } else { echo 'Daily briefing'; } ?>">

    <h2 class="section-header"><?php if($isMorning){ echo 'Good morning'; } elseif($isNight){ echo 'Good night'; } else { echo 'Good evening'; } ?></h2>

    <div class="grid one-one temp-grid">
        <div class="grid one-one align-middle">
            <img class="weather-icon" src="<?php echo $icon; ?>">
            <h2 class="temp"><?php echo $temp; ?>°</h2>
        </div>
        <div class="weather-stats">
            <span class="weather-stat">Feels like <?php echo $feelsLike; ?>°</span>
            <span class="weather-stat"><span class="wind-vane" style="transform: rotate(<?php echo $windDirection; ?>deg);"><img src="<?php echo get_template_directory_uri(); ?>/assets/weather/nav-arrow.svg"></span><?php echo $windSpeed; ?> mph wind</span>
            <span class="weather-stat"><?php echo $weatherDescription; ?></span>
        </div>
    </div>

    <div class="forecast-wrapper">
        <div class="weather-forecast">
            <?php foreach($forecast as $day) { ?>
            <div class="forecast-day">
                <span class="forecast-date"><?php echo $day['date']->format('D'); ?></span>
                <img data-weather_icon="<?php echo $day['iconName']; ?>" src="<?php echo $day['icon']; ?>">
                <div>
                    <span class="temp-high"><?php echo $day['high']; ?>°</span>
                    <span class="temp-low"><?php echo $day['low']; ?>°</span>
                </div>
            </div>
            <?php } ?>
            <div class="forecast-day scroll-fix-hidden"></div>
        </div>
    </div>

    <div class="weather-articles-wrapper">
        <div class="weather-articles grid">
            <?php while($weatherQuery->have_posts()) { $weatherQuery->the_post() ?>
            <a class="weather-article-item" href="<?php echo get_permalink(); ?>">
                <?php the_post_thumbnail('thumbnail'); ?>
                <h2 class="article-title"><?php echo get_the_title(); ?></h2>
            </a>
            <?php } wp_reset_postdata(); ?>
            <a class="weather-article-item scroll-fix-hidden"></a>
        </div>
    </div>

</div>