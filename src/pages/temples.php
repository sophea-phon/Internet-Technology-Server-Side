<?php

// Fetch all temples
$db->query("SELECT * FROM temples ORDER BY name ASC");
$temples = $db->resultSet();
?>
        <!-- Temples Hero Section -->
        <section class="temples-hero">
            <div class="container">
                <h1>Explore Cambodia's Ancient Temples</h1>
                <p>Discover the rich history and cultural significance of Cambodia's most iconic temples</p>
            </div>
        </section>

        <!-- Temples List Section -->
        <section class="temples-list">
            <div class="container">
                <div class="temple-cards">
                    <?php
                    if (!empty($temples)) {
                        foreach ($temples as $temple) {
                            $defaultImage = 'src="assets/default_image.png"';
                            if($temple["featured_image"] != null || $temple["featured_image"] != ''){
                                $defaultImage = 'src=data:image;base64,' . $temple["featured_image"];
                            }
                            echo '<div class="temple-card">
                                    <div class="temple-img">
                                        <img ' .$defaultImage . ' alt="' . $temple["name"] . '" />
                                    </div>
                                    <div class="temple-info">
                                        <h3>' . $temple["name"] . '</h3>
                                        <p class="three-lines-text">' . $temple["description"] . '</p>
                                        <a href="?page=templedetail&id=' . $temple["id"] . '" class="btn btn-outline">Learn More</a>
                                    </div>
                                  </div>';
                        }
                    } else {
                        echo "<p>No temples available.</p>";
                    }
                    ?>
                </div>
            </div>
        </section>