<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Web Page Scraper</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body class="style1">

<?php

include "WebPageScraper.php";

// сілка
$url = 'https://college.ks.ua';
$scraper = new WebPageScraper($url);
$scraper->loadPage();

echo "<h2>Остання новина</h2>";
$latestNews = $scraper->getLatestNews();
if ($latestNews) {
    echo $scraper->getDOM()->saveHTML($latestNews) . "\n";
} else {
    echo "<p>Новини недоступні.</p>";
}

// сілка на розклад
$scheduleUrl = 'https://college.ks.ua/osvita/zaochne-navchannya/rozklad-zanyatt/';
$scheduleScraper = new WebPageScraper($scheduleUrl);
$scheduleScraper->loadPage();

echo "<h2>Розклад на поточний семестр</h2>";
$schedule = $scheduleScraper->findElementsByClass('news-list', 'div');
if ($schedule && $schedule->length > 0) {
    echo $scheduleScraper->getDOM()->saveHTML($schedule[0]) . "\n";
} else {
    echo "<p>Розклад недоступний.</p>";
}

// сілка на погоду
$weatherUrl = 'https://weather.com/weather/today/l/fa23035f4b496ea8ffd5196487d9493f05e151ae13bc6ccc1e86f23000dc513e';
$weatherScraper = new WebPageScraper($weatherUrl);
$weatherScraper->loadPage();

echo "<h2>Поточна погода в Херсоні</h2>";
$currentWeather = $weatherScraper->getWeather();
if ($currentWeather) {
    echo "<div class='weather'>" . $weatherScraper->getDOM()->saveHTML($currentWeather) . "</div>";
} else {
    echo "<p>Погода недоступна.</p>";
}

?>

</body>
</html>
