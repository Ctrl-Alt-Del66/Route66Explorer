<?php
include("header.php");
include("navigation.php");
include("db_connect.php");

$city = $_GET['city'] ?? '';
$event_type = $_GET['event_type'] ?? '';
$time_filter = $_GET['time_filter'] ?? '';

$sql = "SELECT * FROM meetup_posts WHERE 1=1";

if ($city) $sql .= " AND city = '$city'";
if ($event_type) $sql .= " AND event_type = '$event_type'";
if ($time_filter === 'upcoming') $sql .= " AND start_time >= NOW()";
if ($time_filter === 'past') $sql .= " AND end_time < NOW()";

$result = $conn->query($sql);
?>

<main>
    <section>
        <h2>Find a Meetup!</h2>
        <form method="GET">
            <label for="city">City:</label>
            <select name="city">
                <option value="">All</option>
                <option value="Chicago">Chicago</option>
                <option value="St. Louis">St. Louis</option>
                <option value="Oklahoma City">Oklahoma City</option>
                <option value="Santa Monica">Santa Monica</option>
            </select>

            <label for="event_type">Event Type:</label>
            <select name="event_type">
                <option value="">All</option>
                <option value="Eating">Eating</option>
                <option value="Drinking">Drinking</option>
                <option value="Concert">Concert</option>
                <option value="Game">Game</option>
                <option value="Attraction">Attraction</option>
            </select>

            <label for="time_filter">Time:</label>
            <select name="time_filter">
                <option value="">All</option>
                <option value="upcoming">Upcoming</option>
                <option value="past">Past</option>
            </select>

            <button type="submit">Filter</button>
        </form>
    </section>

    <section id="meetups">
        <h3>Meetup Listings</h3>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="meetup-post">
                <h4><?= htmlspecialchars($row['event_type']) ?> in <?= htmlspecialchars($row['city']) ?></h4>
                <p><strong>Time:</strong> <?= $row['start_time'] ?> - <?= $row['end_time'] ?></p>
                <p><?= htmlspecialchars($row['description']) ?></p>
                <p><strong>21+ Event:</strong> <?= $row['is_21plus'] ? 'Yes' : 'No' ?></p>
                
                <a href="post.php?id=<?= $row['id'] ?>">View & Comment</a>
            </div>
        <?php endwhile; ?>
    </section>

    <a href="create_post.php" class="post-btn">Create a Meetup</a>
</main>

<?php include("footer.php"); ?>