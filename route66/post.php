<?php
include("header.php");
include("navigation.php");
include("db_connect.php");

$post_id = $_GET['id'];
$post = $conn->query("SELECT * FROM meetup_posts WHERE id = $post_id")->fetch_assoc();
$comments = $conn->query("SELECT * FROM comments WHERE post_id = $post_id ORDER BY created_at DESC");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST['user_name'];
    $comment = $_POST['comment'];

    $stmt = $conn->prepare("INSERT INTO comments (post_id, user_name, comment) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $post_id, $user_name, $comment);
    $stmt->execute();
}
?>

<main>
    <h2><?= htmlspecialchars($post['event_type']) ?> Meetup in <?= htmlspecialchars($post['city']) ?></h2>
    <p><?= htmlspecialchars($post['description']) ?></p>

    <h3>Comments</h3>
    <?php while ($comment = $comments->fetch_assoc()): ?>
        <p><strong><?= htmlspecialchars($comment['user_name']) ?>:</strong> <?= htmlspecialchars($comment['comment']) ?></p>
    <?php endwhile; ?>

    <form method="POST">
        <input type="text" name="user_name" placeholder="Your Name" required>
        <textarea name="comment" placeholder="Leave a comment..." required></textarea>
        <button type="submit">Comment</button>
    </form>
</main>

<?php include("footer.php"); ?>