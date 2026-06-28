<?php
// Test Melbourne timezone
date_default_timezone_set('Australia/Melbourne');

echo "<!DOCTYPE html>
<html>
<head>
    <title>Melbourne Time Test</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
</head>
<body>
    <div class='container mt-5'>
        <div class='card'>
            <div class='card-header bg-primary text-white'>
                <h3>🇦🇺 Melbourne Time Test</h3>
            </div>
            <div class='card-body'>
                <p><strong>Current Time:</strong> " . date('l, jS F Y - g:i:s A') . "</p>
                <p><strong>Date (Australian):</strong> " . date('d/m/Y') . "</p>
                <p><strong>Time:</strong> " . date('h:i:s A') . "</p>
                <p><strong>Timezone:</strong> " . date_default_timezone_get() . "</p>
                <p><strong>DST Active:</strong> " . (date('I') ? 'Yes' : 'No') . "</p>
                <hr>
                <p class='text-muted'>Melbourne Timezone: Australia/Melbourne (UTC+10/+11 DST)</p>
            </div>
        </div>
    </div>
</body>
</html>";
?>