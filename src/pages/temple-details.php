<?php
$temple = null;
if(isset($_GET['id']) && $_GET['id'] != ''){
    $id = $_GET['id'];
    $db->query("SELECT * FROM temples WHERE id = $id");
    $temple =  $db->single();
}
?>
        <!-- Temple Details Hero Section -->
        <section class="temple-details-hero">
            <div class="container">
                <h1><?php echo $temple['name'];?></h1>
                <p>Location of the temple: <a style="font-style: italic;" href="<?php echo $temple['location']?>" target="_blank"><strong><?php echo $temple['location'] ?></strong></a></p> 
            </div>
        </section>

        <!-- Temple Details Section -->
        <section class="temple-details">
            <div class="container">
                <div class="temple-details-content">
                    <div class="temple-details-text">
                        <h2>About the Temple</h2>
                        <p>
                            <?php echo $temple['history'] ?>
                        </p>
                    </div>
                    <?php
                        $defaultImage = 'src="assets/default_image.png"';
                        if($temple["featured_image"] != null || $temple["featured_image"] != ''){
                            $defaultImage = 'src=data:image;base64,' . $temple["featured_image"];
                        }
                        echo '<div class="temple-details-image"><img '.$defaultImage.' atl="'.$temple['name'].'"/></div>';
                    ?>
                    <!-- <div class="temple-details-image">
                        <img src="../../assets/images/temple-detail.jpg" alt="Temple Image" />
                    </div> -->
                </div>
            </div>
        </section>

        <!-- Gallery Section -->
        <!-- <section class="gallery-section">
            <div class="container">
                <h2>Gallery</h2>
                <div class="gallery-grid">
                    <div class="gallery-item">
                        <img src="../../assets/images/gallery-image-1.jpg" alt="Gallery Image 1" />
                    </div>
                    <div class="gallery-item">
                        <img src="../../assets/images/gallery-image-2.jpg" alt="Gallery Image 2" />
                    </div>
                    <div class="gallery-item">
                        <img src="../../assets/images/gallery-image-3.jpg" alt="Gallery Image 3" />
                    </div>
                </div>
            </div>
        </section> -->
 