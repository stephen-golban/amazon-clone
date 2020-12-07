<?php include 'header.php';

$user = new User();
$categRes = array();
foreach (DB::getInstance()->getOnly('categories') as $c) {
    $categRes[] = $c;
}
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $url = "https://";
else
    $url = "http://";
// Append the host(domain name, ip) to the URL.   
$url .= $_SERVER['HTTP_HOST'];

// Append the requested resource location to the URL   
$url .= $_SERVER['REQUEST_URI'];
$_SESSION['redirectTo'] = $url;
?>
<?php
if (Session::exists('loggedIn')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><?php echo Session::flash('loggedIn'); ?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<?php
if (Session::exists('congrats')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><?php echo Session::flash('congrats'); ?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<?php
if (Session::exists('credits-added')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><?php echo Session::flash('credits-added'); ?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<?php
if (Session::exists('credits-failed')) : ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong><?php echo Session::flash('credits-failed'); ?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<div class="index__container">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="https://images-na.ssl-images-amazon.com/images/G/01/AmazonExports/Fuji/2020/May/Hero/Fuji_TallHero_Computers_1x._CB432469755_.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://images-na.ssl-images-amazon.com/images/G/01/AmazonExports/Events/2020/Holiday/GiftGuide/Fuji_TallHero_GG2_en_US_1x._CB418256337_.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://images-na.ssl-images-amazon.com/images/G/01/AmazonExports/Events/2020/HolidayDeals/Desktop/Fuji_TallHero_HolidayDeals_en_US_1x._CB414278668_.jpg" alt="Third slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://images-na.ssl-images-amazon.com/images/G/01/AmazonExports/Fuji/2020/May/Hero/Fuji_TallHero_Home_v2_en_US_1x._CB429090084_.jpg" alt="Fourth slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://images-na.ssl-images-amazon.com/images/G/01/AmazonExports/Fuji/2020/May/Hero/Fuji_TallHero_Toys_en_US_1x._CB431858161_.jpg" alt="Fifth slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="categories">

        <?php
        foreach ($categRes as $categ) { ?>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $categ['categoryName']; ?></h5>
                </div>
                <a href="Components/Products/index.php?category=<?php echo $categ['categoryName']; ?>">
                    <img src="<?php echo $categ['categoryImage'] ?>" class="card-img-top" alt="<?php echo $categ['categoryName'] ?>">
                </a>
                <div class="card-body">
                    <a href="Components/Products/index.php?category=<?php echo $categ['categoryName']; ?>">Search this category</a>
                </div>
            </div>
        <?php }
        ?>
    </div>

</div>
</body>

</html>