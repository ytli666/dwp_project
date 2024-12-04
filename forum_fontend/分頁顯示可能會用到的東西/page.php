<?php
// Database connection (replace with your credentials)
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'discussion_forum';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pagination logic
$articlesPerPage = 10;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $articlesPerPage;

// Determine query type (Homepage, Search, or Profile)
if (isset($_GET['search'])) {
    $searchTerm = $conn->real_escape_string($_GET['search']);
    $query = "SELECT * FROM articles WHERE title LIKE '%$searchTerm%' LIMIT $offset, $articlesPerPage";
    $countQuery = "SELECT COUNT(*) as total FROM articles WHERE title LIKE '%$searchTerm%'";
} elseif (isset($_GET['profile_id'])) {
    $profileId = (int)$_GET['profile_id'];
    $query = "SELECT * FROM articles WHERE author_id = $profileId LIMIT $offset, $articlesPerPage";
    $countQuery = "SELECT COUNT(*) as total FROM articles WHERE author_id = $profileId";
} else {
    $query = "SELECT * FROM articles LIMIT $offset, $articlesPerPage";
    $countQuery = "SELECT COUNT(*) as total FROM articles";
}

// Fetch articles
$result = $conn->query($query);
$articles = $result->fetch_all(MYSQLI_ASSOC);

// Fetch total articles count
$totalResult = $conn->query($countQuery);
$totalArticles = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalArticles / $articlesPerPage);

$conn->close();
?>

