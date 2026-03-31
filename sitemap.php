<?php
header('Content-Type: application/xml; charset=utf-8');

$pages = [
    '/' => ['weekly', 1.0],
    '/about' => ['monthly', 0.9],
    '/cases' => ['monthly', 0.8],
    '/places' => ['monthly', 0.9],
    '/bloggers' => ['monthly', 0.8],
    '/blog' => ['weekly', 0.7],
    '/faq' => ['monthly', 0.6],
    '/team' => ['monthly', 0.7],
    '/mediakit' => ['monthly', 0.7],
    '/vacancies' => ['monthly', 0.6],
    '/privacy-policy' => ['yearly', 0.3],
    '/cookie-policy' => ['yearly', 0.3],
];

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

foreach ($pages as $url => $data) {
    echo '<url>' . "\n";
    echo '<loc>https://zaraz-media.by' . $url . '</loc>' . "\n";
    echo '<lastmod>' . date('Y-m-d') . '</lastmod>' . "\n";
    echo '<changefreq>' . $data[0] . '</changefreq>' . "\n";
    echo '<priority>' . $data[1] . '</priority>' . "\n";
    echo '</url>' . "\n";
}

echo '</urlset>';
?>
