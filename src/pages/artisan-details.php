<?php
$artisan = null;
if(isset($_GET['id']) && $_GET['id'] != ''){
    $id = $_GET['id'];
    $db->query("SELECT * FROM artisans WHERE id = $id");
    $artisan =  $db->single();
}
?>

        <!-- Artisan Details Hero Section -->
        <section class="artisan-details-hero">
            <div class="container">
                <h1><?php echo $artisan['name']; ?></h1>
                <p>Specialty: <strong><?php echo $artisan['craft_type'] ?></strong></p>
            </div>
        </section>
        <!-- Artisan Details Section -->
        <section class="artisan-details">
            <div class="container">
                <div class="artisan-details-content">
                    <div class="artisan-details-text">
                        <h2>About the Artisan</h2>
                        <p>
                           <?php echo $artisan['bio'] ?>
                        </p>
                    </div>
                    <?php
                        $defaultImage = 'src="assets/default_image.png"';
                        if($artisan["featured_image"] != null || $artisan["featured_image"] != ''){
                            $defaultImage = 'src=data:image;base64,' . $artisan["featured_image"];
                        }
                        echo '<div class="artisan-details-image"><img '.$defaultImage.' atl="'.$artisan['name'].'"/></div>';
                    ?>
                </div>
            </div>
        </section>

        <!-- Gallery Section -->
        <!-- <section class="gallery-section">
            <div class="container">
                <h2>Gallery</h2>
                <div class="gallery-grid">
                    <div class="gallery-item">
                        <img src="../../assets/images/gallery-image-4.jpg" alt="Gallery Image 1" />
                    </div>
                    <div class="gallery-item">
                        <img src="../../assets/images/gallery-image-5.jpg" alt="Gallery Image 2" />
                    </div>
                    <div class="gallery-item">
                        <img src="../../assets/images/gallery-image-6.jpg" alt="Gallery Image 3" />
                    </div>
                </div>
            </div>
        </section> -->
 