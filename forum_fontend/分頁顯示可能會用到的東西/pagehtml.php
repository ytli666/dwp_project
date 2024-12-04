<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
    <style>
        /* Pagination Styling */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            color: #4CAF50;
            text-decoration: none;
            padding: 8px 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 0 5px;
        }

        .pagination a:hover {
            background-color: #f4f4f9;
        }

        .pagination a.active {
            background-color: #4CAF50;
            color: white;
            border: 1px solid #4CAF50;
        }
    </style>
</head>
<body>
    <h1>Articles</h1>

    <ul>
        <?php foreach ($articles as $article): ?>
            <li>
                <h3><a href="article.php?id=<?= $article['id'] ?>"><?= htmlspecialchars($article['title']) ?></a></h3>
                <p><?= htmlspecialchars(substr($article['content'], 0, 100)) ?>...</p>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Pagination -->
    <div class="pagination">
        <?php if ($currentPage > 1): ?>
            <a href="?page=<?= $currentPage - 1 ?>">&laquo; Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>" class="<?= $i === $currentPage ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>

        <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?= $currentPage + 1 ?>">Next &raquo;</a>
        <?php endif; ?>
    </div>
</body>
</html>
