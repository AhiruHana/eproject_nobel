<?php
include_once 'controller/headerController.php';
?>
<header>
    <div class="logo text-center">
        <img src="<?php echo $logo["img"] ?>">
    </div>
    <div id="menu">
        <nav class="navbar navbar-expand-lg d-flex">
            <div class="container">
                <div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"><i class="fa-solid fa-bars"></i></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <?php
                            renderMenu();
                            ?>
                        </ul>
                    </div>
                </div>
                <form method="GET" action="laureatesCategory.php" class="d-flex search-box">
                    <input id="input-search" value="<?php echo (isset($keyword)) ? $keyword : "" ?>" class="form-control" type="text" name="keyword" placeholder="Search" aria-label="Search product">
                    <button id="search" class="btn btn-outline-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>

        </nav>
    </div>

    <div class="bg-image" style="background-image: url('<?php echo $banner["img"] ?>');">
        <div class="wrap">
            <div class="main">
                <h1><?php echo $title1_banner["value"] ?></h1>
                <h5><?php echo $title2_banner["value"] ?></h5>
            </div>
        </div>
    </div>
</header>