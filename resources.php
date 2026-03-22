<?php

// Educational Resources
$resources = [
    ['title' => 'Introduction to PHP', 'type' => 'Online Course', 'link' => 'https://www.example.com/course1'],
    ['title' => 'JavaScript Basics', 'type' => 'Book', 'link' => 'https://www.example.com/book1'],
    ['title' => 'HTML & CSS Fundamentals', 'type' => 'Video Tutorial', 'link' => 'https://www.example.com/video1'],
];

// Display resources in a table
echo '<table border="1">';
echo '<tr><th>Title</th><th>Type</th><th>Link</th></tr>';
foreach ($resources as $resource) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($resource['title']) . '</td>';
    echo '<td>' . htmlspecialchars($resource['type']) . '</td>';
    echo '<td><a href="' . htmlspecialchars($resource['link']) . '">Link</a></td>';
    echo '</tr>';
}
echo '</table>';
?>
