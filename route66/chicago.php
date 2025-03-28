<?php
include("header.php");
include("navigation.php");
?>

<main>
    <section>
        <h2>Chicago, IL</h2>
        <img src="images/chicago.jpg" alt="The Bean Chicago">
        <p>Explore the great Windy City of Chicago!</p>
    </section>

    <section id="weather">
        <h3>Current Weather</h3>
        <p id="weather-info">Loading weather...</p>
    </section>

    <section id="events">
        <h3>Live Events</h3>
        <p id="events-info">Loading events...</p>
    </section>

    <section id="attractions">
        <h3>Attractions & Landmarks</h3>
        <p id="attractions-info">Loading attractions...</p>
    </section>
</main>

<script src="js/weather.js"></script>
<script src="js/events.js"></script>
<script src="js/attractions.js"></script>
<script>
    getWeather("Chicago");
    getEvents("Chicago");
    getAttractions("Chicago");
</script>

<?php
include("footer.php");
?>