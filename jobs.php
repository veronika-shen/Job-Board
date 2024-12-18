<?php
session_start();

/** @var PDO $pdo */
$pdo = require $_SERVER['DOCUMENT_ROOT'] . '/jobboard2/Job-Board/database.php';

$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
$employments = $pdo->query("SELECT * FROM employment")->fetchAll();
$companies = $pdo->query("SELECT * FROM companies")->fetchAll();
$experiences = $pdo->query("SELECT * FROM experience")->fetchAll();


$category = $_GET['category'] ?? 'all';
$employment = $_GET['employment'] ?? 'all';
$experience = $_GET['experience'] ?? 'all';
$keywords = $_GET['keywords'] ?? '';

$sql = "SELECT jobs.*, employment.name AS employment,experience.name AS experience
        FROM jobs
        LEFT JOIN employment ON jobs.employment_id = employment.id
        JOIN experience ON jobs.experience_id = experience.id";
$categorySql = [];
if($category !== 'all'){
    $categorySql[] = 'category_id = ' . $category;
}
if($employment !== 'all'){
    $categorySql[] = 'employment_id = ' . $employment;
}
if($experience !== 'all'){
    $categorySql[] = 'experience_id = ' . $experience;
}
$word = $_GET['keywords'] ?? "";
if (!empty($word)) {
    $categorySql[] = "jobs.name LIKE '%" . $word . "%'";
}
if ($categorySql){
    $sql .= " WHERE " . implode(" AND ", $categorySql);
}
$jobs = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
$sorting = $_GET['sorting'] ?? 'most_recent';

if ($sorting === 'most_recent') {
    $sql .= " ORDER BY jobs.published_on DESC";
} elseif ($sorting === 'oldest') {
    $sql .= " ORDER BY jobs.published_on ASC";
} elseif ($sorting === 'highest_salary') {
    $sql .= " ORDER BY jobs.salary DESC";
} elseif ($sorting === 'lowest_salary') {
    $sql .= " ORDER BY jobs.salary ASC";
}

$stmt = $pdo->query($sql);
$jobs = $stmt->fetchAll();
?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Job Board</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/gijgo.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/slicknav.css">

    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<body>
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
    your browser</a> to improve your experience and security.</p>
<![endif]-->

<!-- bradcam_area  -->
<div class="bradcam_area bradcam_bg_1">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text">
                    <h3>4536+ Jobs Available</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ bradcam_area  -->

<!-- job_listing_area_start  -->
<div class="job_listing_area plus_padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="job_filter white-bg">
                    <div class="form_inner white-bg">
                        <h3>Filter</h3>
                        <form id="my-form">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="single_field">
                                        <input type="text" name="keywords" placeholder="Search keyword"
                                               value="<?= $filters['keywords'] ?? '' ?>">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="single_field">
                                        <select class="wide" name="category">
                                            <option data-display="Category" value="all" selected>Category
                                            </option>
                                            <?php foreach ($categories as $category): ?>
                                            <?php if ($filters['category'] == $category['id']): ?>
                                            <option value="<?= $category['id'] ?>"
                                                    selected><?= $category['name'] ?></option>
                                            <?php else: ?>
                                            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="single_field">
                                        <select class="wide" name="employment">
                                            <option data-display="Employment" value="all" selected>Employment
                                            </option>
                                            <?php foreach ($employments as $employment): ?>
                                                <?php if ($filters['employment'] == $employment['id']): ?>
                                                    <option value="<?= $employment['id'] ?>"
                                                            selected><?= $employment['name'] ?></option>
                                                <?php else: ?>
                                                    <option value="<?= $employment['id'] ?>"><?= $employment['name'] ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="single_field">
                                        <select class="wide" name="experience">
                                            <option data-display="Experience" value="all" selected>Experience
                                            </option>
                                            <?php foreach ($experiences as $experience): ?>
                                                <?php if ($filters['experience'] == $experience['id']): ?>
                                                    <option value="<?= $experience['id'] ?>"
                                                            selected><?= $experience['name'] ?></option>
                                                <?php else: ?>
                                                    <option value="<?= $experience['id'] ?>"><?= $experience['name'] ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="range_wrap">
                                <label for="amount">Price range:</label>
                                <div id="slider-range">
                                    <input type="hidden" name="min_salary" id="min_salary">
                                    <input type="hidden" name="max_salary" id="max_salary">
                                </div>
                                <p>
                                    <input type="text" id="amount" readonly
                                           style="border:0; color:#7A838B; font-size: 14px; font-weight:400;">
                                </p>
                            </div>
                            <div class="reset_btn" style="margin-bottom: 10px;">
                                <button class="boxed-btn3 w-100" type="submit">Search</button>
                            </div>

                            <div class="reset_btn">
                                <a href="/jobboard2/Job-Board/jobs.php" class="boxed-btn3 w-100"">Reset</a>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="recent_joblist_wrap">
                    <div class="recent_joblist white-bg ">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h4>Job Listing</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="serch_cat d-flex justify-content-end">
                                    <select name="sorting">
                                        <option data-display="Most Recent" value="most_recent" selected>Most
                                            Recent
                                        </option>
                                        <?php if ($sorting === 'oldest'): ?>
                                        <option value="oldest" selected>Oldest</option>
                                        <?php else: ?>
                                        <option value="oldest">Oldest</option>
                                        <?php endif; ?>

                                        <?php if ($sorting === 'highest_salary'): ?>
                                        <option value="highest_salary" selected>Highest Salary</option>
                                        <?php else: ?>
                                        <option value="highest_salary">Highest Salary</option>
                                        <?php endif; ?>

                                        <?php if ($sorting === 'lowest_salary'): ?>
                                        <option value="lowest_salary" selected>Lowest Salary</option>
                                        <?php else: ?>
                                        <option value="lowest_salary">Lowest Salary</option>
                                        <?php endif; ?>
                                    </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="job_lists m-0">
                    <div class="row">
                        <?php foreach ($jobs as $job): ?>
                        <div class="col-lg-12 col-md-12">
                            <div class="single_jobs white-bg d-flex justify-content-between">
                                <div class="jobs_left d-flex align-items-center">
                                    <div class="thumb">
                                        <img src="/image/" alt="logo">
                                    </div>
                                    <div class="jobs_conetent">
                                        <a href="/jobboard2/Job-Board/job_details.php?id=<?= $job['id'] ?>">
                                            <h4><?= $job['name'] ?></h4>
                                        </a>
                                        <div class="links_locat d-flex align-items-center">
                                            <div class="location">
                                                <p><i class="fa fa-clock-o"></i><?= $job['employment'] ?></p>
                                            </div>
                                            <div class="location">
                                                <p><?= $job['salary'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="jobs_right">
                                    <div class="apply_now">
                                        <a href="/jobboard2/Job-Board/job_details.php?id=<?= $job['id'] ?>" class="boxed-btn3">Apply
                                            Now</a>
                                    </div>
                                    <div class="date">
                                        <p>Date: <?= date('d.m.Y', strtotime($job['published_on'])) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="pagination_wrap">
                                <ul>
                                    <li><a href="#"> <i class="ti-angle-left"></i> </a></li>
                                    <li><a href="#"><span>01</span></a></li>
                                    <li><a href="#"><span>02</span></a></li>
                                    <li><a href="#"> <i class="ti-angle-right"></i> </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- job_listing_area_end  -->

<!-- footer start -->
<footer class="footer">
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-md-6 col-lg-3">
                    <div class="footer_widget wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                        <div class="footer_logo">
                            <a href="#">
                                <img src="img/logo.png" alt="">
                            </a>
                        </div>
                        <p>
                            finloan@support.com <br>
                            +10 873 672 6782 <br>
                            600/D, Green road, NewYork
                        </p>
                        <div class="socail_links">
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="ti-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-xl-2 col-md-6 col-lg-2">
                    <div class="footer_widget wow fadeInUp" data-wow-duration="1.1s" data-wow-delay=".4s">
                        <h3 class="footer_title">
                            Company
                        </h3>
                        <ul>
                            <li><a href="#">About </a></li>
                            <li><a href="#"> Pricing</a></li>
                            <li><a href="#">Carrier Tips</a></li>
                            <li><a href="#">FAQ</a></li>
                        </ul>

                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-lg-3">
                    <div class="footer_widget wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".5s">
                        <h3 class="footer_title">
                            Category
                        </h3>
                        <ul>
                            <li><a href="#">Design & Art</a></li>
                            <li><a href="#">Engineering</a></li>
                            <li><a href="#">Sales & Marketing</a></li>
                            <li><a href="#">Finance</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-lg-4">
                    <div class="footer_widget wow fadeInUp" data-wow-duration="1.3s" data-wow-delay=".6s">
                        <h3 class="footer_title">
                            Subscribe
                        </h3>
                        <form action="#" class="newsletter_form">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit">Subscribe</button>
                        </form>
                        <p class="newsletter_text">Esteem spirit temper too say adieus who direct esteem esteems
                            luckily.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copy-right_text wow fadeInUp" data-wow-duration="1.4s" data-wow-delay=".3s">
        <div class="container">
            <div class="footer_border"></div>
            <div class="row">
                <div class="col-xl-12">
                    <p class="copy_right text-center">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                        All rights reserved | This template is made with <i class="fa fa-heart-o"
                                                                            aria-hidden="true"></i> by <a
                            href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--/ footer end  -->

<!-- link that opens popup -->
<!-- JS here -->
<script src="js/vendor/modernizr-3.5.0.min.js"></script>
<script src="js/vendor/jquery-1.12.4.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/isotope.pkgd.min.js"></script>
<script src="js/ajax-form.js"></script>
<script src="js/waypoints.min.js"></script>
<script src="js/jquery.counterup.min.js"></script>
<script src="js/imagesloaded.pkgd.min.js"></script>
<script src="js/scrollIt.js"></script>
<script src="js/jquery.scrollUp.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/nice-select.min.js"></script>
<script src="js/jquery.slicknav.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/plugins.js"></script>
<!-- <script src="js/gijgo.min.js"></script> -->
<script src="js/range.js"></script>


<!--contact js-->
<script src="js/contact.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="js/jquery.form.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/mail-script.js"></script>


<script src="js/main.js"></script>


<script>
    $(function () {
        $("#slider-range").slider({
            range: true,
            min: 0,
            max: 24600,
            values: [0, 24600],
            slide: function (event, ui) {
                $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1] + "/ Year");
            }
        });
        $("#amount").val("$" + $("#slider-range").slider("values", 0) +
            " - $" + $("#slider-range").slider("values", 1) + "/ Year");
    });
</script>

<script src="js/my.js"></script>
</body>

</html>