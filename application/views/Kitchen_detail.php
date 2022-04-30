<script>
    var PER_PAGE_MENU_ITEM = '10';
    var PER_PAGE_REVIEWS = '10';
    var is_loggedIn = '<?php if (empty($this->session->userdata(base_url() . 'FOODIESUSERID'))) {
                            echo 0;
                        } else {
                            echo 1;
                        } ?>';
</script>


            <script>
function myFunction() {
  alert("adding item in cart");
}
</script>



<style>
    .foodsectionsloadmorebtn {
        border-radius: 8px !important;
        font-size: 15px;
        padding: 20px;
    }

    .listOfFoodSection {
        width: 100%;
        position: relative;
        background-color: #FFFFFF;
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 15%);
        margin-bottom: 30px;
    }

    .customizablemodal .customizable-content .btn-container {
        width: 80px;
    }

    .customizablemodal .customizable-content .mealcount {
        width: 30px;
    }

    /* .customizablemodal .customizable-content .right-part{
        flex-basis: unset;
    } */
</style>

<div class="kitchen-information">
    <div class="hero-area">
        <div class="main-img">
            <img src="<?= FRONT_IMAGES_URL ?>pagen015hero.png" alt="" class="img-fluid full-width">
        </div>
        <div class="hero-logo">
            <?php if ($kitchendata['profile_image'] != "" && file_exists(USER_PROFILE_PATH . $kitchendata['profile_image'])) { ?>
                <img src="<?= USER_PROFILE . $kitchendata['profile_image'] ?>" class="thumbwidth" style="width: 130px;height: 130px;border-radius: 50%;border: 3px solid #FFF;outline: 2px solid #000;">
            <?php } else { ?>
                <img src="<?= FRONT_IMAGES_URL ?>Layer2.png" alt="">
            <?php } ?>
        </div>

        <div class="photo-like">
            <span><img src="<?= FRONT_IMAGES_URL ?>copy.png" alt=""></span>
            <span class="white bold photo-num">6 photos</span>
            <?php if (!empty($this->session->userdata(base_url() . 'FOODIESUSERID'))) {
                if ($kitchendata['isfavoritekitchen'] == 1) { ?>
                    <a href="javascript:void(0)" id="favorite_kitchen" onclick="remove_favorute_kitchen()" title="Remove to Favourite">
                        <img src="<?= FRONT_IMAGES_URL ?>Grou9902.png" alt="">
                    </a>
                <?php } else { ?>
                    <a href="javascript:void(0)" id="favorite_kitchen" onclick="add_favorute_kitchen()" title="Add to Favourite">
                        <img src="<?= FRONT_IMAGES_URL ?>Grou45649902.png">
                    </a>
                <?php } ?>
            <?php } else { ?>
                <a href="<?= FRONT_URL ?>login" title="Add to Favourite" title="Add to Favourite">
                    <img src="<?= FRONT_IMAGES_URL ?>Grou45649902.png">
                </a>
            <?php } ?>
        </div>
    </div>

    <div class="container-fluid">
        <div class="kitchenNameRating">
            <div class="left-part col-md-6">
                <p class="heading"><?= $kitchendata['kitchenname'] ?></p>
                <input type="hidden" id="userid" value="<?= $kitchendata['id'] ?>">
                <p class="sub-heading"><?php
                                        $meal = "";
                                        if ($kitchendata['issouthindian'] > 0) {
                                            $meal .= "South Indian, ";
                                        }
                                        if ($kitchendata['isnorthindian'] > 0) {
                                            $meal .= "North Indian, ";
                                        }
                                        if ($kitchendata['isotherindian'] > 0) {
                                            $meal .= "Other Indian, ";
                                        }
                                        echo rtrim($meal, ', ');
                                        ?></p>
                <p class="location"><img src="<?= FRONT_IMAGES_URL ?>Component1311.png" alt=""><span class="loc-address"><?= $kitchendata['address'] . ", " . $kitchendata['city'] . " - " . $kitchendata['pincode'] ?></span></p>
                <p><span class="open-time"><img src="<?= FRONT_IMAGES_URL ?>clock(2).png" alt="" class=""><span class="time"><?= date("h:i A", strtotime($kitchendata['fromtime'])) ?> to <?= date("h:i A", strtotime($kitchendata['totime'])) ?> <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<?= $kitchendata['opendays'] ?>)--> -</span>
                        <?php if (date("H:i:s") > $kitchendata['fromtime'] && date("H:i:s") < $kitchendata['totime']) {
                            echo '<span class="lightgreen opennow">Open Now</span>';
                        } else {
                            echo '<span class="lightgreen opennow">Closed</span>';
                        } ?></p>
            </div>
            <div class="right-part col-md-6">
                <p class="delivery-rating"><span class="rating bold"><?= $kitchendata['averagerating'] ?></span><span class="rate-img"><img src="<?= FRONT_IMAGES_URL ?>Favorite.png" alt="" class=""></span><span class="cementgray review">(<?= $kitchendata['totalreview'] ?>+)</span></p>
                <div class="clearfix"></div>
                <p class="text-right">
                    <a href="javascript:void(0)" class="allreview" data-toggle="modal" data-target="#exampleModal1" onclick="rat_offset = 0;get_reviews(<?= $kitchendata['id'] ?>)">All Ratings & Reviews</a>
                </p>
            </div>
        </div>

        <div class="select-meal-plan">
            <p class="main-heading">Select Meal Plan</p>
            <div class="select-plan-container">
                <div class="select-plan">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pills-weekly-tab" data-toggle="pill" href="#pills-weekly" role="tab" aria-controls="pills-weekly" aria-selected="true">Weekly</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-monthly-tab" data-toggle="pill" href="#pills-monthly" role="tab" aria-controls="pills-monthly" aria-selected="false">Monthly</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-trialmeal-tab" data-toggle="pill" href="#pills-trialmeal" role="tab" aria-controls="pills-trialmeal" aria-selected="false">Trial Meal</a>
                        </li>
                    </ul>
                </div>
                <div class="mealperweek">
                    <p class="text-right"><img src="<?= FRONT_IMAGES_URL ?>indian_food_Lunch.png" alt=""><span class="meal-week">6 meals/week</span></p>
                </div>
            </div>

            <?php if (!empty($offerdata)) { ?>
                <div class="discount-code-content d-inline-flex">
                    <?php foreach ($offerdata as $i => $offer) { ?>
                        <div class="discount-code mr-2">
                            <input type="hidden" name="couponcode" id="discount<?= ($i + 1) ?>" class="input-hidden" <?= ($i == 0 ? "checked" : "") ?> />
                            <label for="discount<?= ($i + 1) ?>">
                                <div class="img-container">
                                    <img src="<?= FRONT_IMAGES_URL ?>Component53.png" alt="">
                                </div>
                                <div class="headings">
                                    <p class="sub-heading bold">Use Code <?= $offer['offercode'] ?></p>
                                    <p class="heading bold"><?= $offer['discount'] . ($offer['discounttype'] == 0 ? "%" : "Rs"); ?> OFF</p>
                                    
                                </div>
                            </label>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>

            <div class="heading-container">
                <p class="bold">MENU</p>
            </div>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-weekly" role="tabpanel" aria-labelledby="pills-weekly-tab">
                    <div class="menu-container">
                        <div class="menu-meal">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="pills-weekly-breakfast-tab" data-toggle="pill" href="#pills-weekly-breakfast" role="tab" aria-controls="pills-weekly-breakfast" aria-selected="true">Breakfast</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-weekly-lunch-tab" data-toggle="pill" href="#pills-weekly-lunch" role="tab" aria-controls="pills-weekly-lunch" aria-selected="false">Lunch</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-weekly-dinner-tab" data-toggle="pill" href="#pills-weekly-dinner" role="tab" aria-controls="pills-weekly-dinner" aria-selected="false">Dinner</a>
                                </li>
                            </ul>
                        </div>
                        
                        
                        <div class="select-meal-type">
                            <ul>
                                <li>
                                    <input type="radio" name="weeklyitemtype" id="weeklyVegFooods" value="0" checked class="inputHidden" />
                                    <label for="weeklyVegFooods">
                                        <span><img src="<?= FRONT_IMAGES_URL ?>vegFood_icon.png" alt=""></span>Veg
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" name="weeklyitemtype" id="weeklyNonVegFoods" value="1" class="inputHidden" />
                                    <label for="weeklyNonVegFoods">
                                        <span><img src="<?= FRONT_IMAGES_URL ?>NonVegFood_icon.png" alt=""></span>Non-Veg
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" name="weeklyitemtype" id="weeklyVegNonVegFoods" value="2" class="inputHidden" />
                                    <label for="weeklyVegNonVegFoods">
                                        <span><img src="<?= FRONT_IMAGES_URL ?>VegNonVegFood-icon.png" alt=""></span>Both
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-weekly-breakfast" role="tabpanel" aria-labelledby="pills-weekly-breakfast-tab">
                            <div class="breakfast-monthly-container" id="breakfast-weekly-meal">
                            </div>
                            <div class="foodsectionsloadmorebtn" id="breakfast-weekly-meal-lmbtn" style="display: none;">
                                <a href="javascript:void(0)" onclick="load_weekly_package('breakfast')">Load More</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="tab-pane fade" id="pills-weekly-lunch" role="tabpanel" aria-labelledby="pills-weekly-lunch-tab">
                            <div class="breakfast-monthly-container" id="lunch-weekly-meal">
                            </div>
                            <div class="foodsectionsloadmorebtn" id="lunch-weekly-meal-lmbtn" style="display: none;">
                                <a href="javascript:void(0)" onclick="load_weekly_package('lunch')">Load More</a>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-weekly-dinner" role="tabpanel" aria-labelledby="pills-weekly-dinner-tab">
                            <div class="breakfast-monthly-container" id="dinner-weekly-meal">
                            </div>
                            <div class="foodsectionsloadmorebtn" id="dinner-weekly-meal-lmbtn" style="display: none;">
                                <a href="javascript:void(0)" onclick="load_weekly_package('dinner')">Load More</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="tab-pane fade" id="pills-monthly" role="tabpanel" aria-labelledby="pills-monthly-tab">
                    <div class="menu-container">
                        <div class="menu-meal">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="pills-monthly-breakfast-tab" data-toggle="pill" href="#pills-monthly-breakfast" role="tab" aria-controls="pills-monthly-breakfast" aria-selected="true">Breakfast</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-monthly-lunch-tab" data-toggle="pill" href="#pills-monthly-lunch" role="tab" aria-controls="pills-monthly-lunch" aria-selected="false">Lunch</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-monthly-dinner-tab" data-toggle="pill" href="#pills-monthly-dinner" role="tab" aria-controls="pills-monthly-dinner" aria-selected="false">Dinner</a>
                                </li>
                            </ul>
                        </div>
                        <div class="select-meal-type">
                            <ul>
                                <li>
                                    <input type="radio" name="monthlyitemtype" id="monthlyVegFooods" value="0" checked class="inputHidden" />
                                    <label for="monthlyVegFooods">
                                        <span><img src="<?= FRONT_IMAGES_URL ?>vegFood_icon.png" alt=""></span>Veg
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" name="monthlyitemtype" id="monthlyNonVegFoods" value="1" class="inputHidden" />
                                    <label for="monthlyNonVegFoods">
                                        <span><img src="<?= FRONT_IMAGES_URL ?>NonVegFood_icon.png" alt=""></span>Non-Veg
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" name="monthlyitemtype" id="monthlyVegNonVegFoods" value="2" class="inputHidden" />
                                    <label for="monthlyVegNonVegFoods">
                                        <span><img src="<?= FRONT_IMAGES_URL ?>VegNonVegFood-icon.png" alt=""></span>Both
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-monthly-breakfast" role="tabpanel" aria-labelledby="pills-monthly-breakfast-tab">
                            <div class="breakfast-monthly-container" id="breakfast-monthly-meal">
                            </div>
                            <div class="foodsectionsloadmorebtn" id="breakfast-monthly-meal-lmbtn" style="display: none;">
                                <a href="javascript:void(0)" onclick="load_monthly_package('breakfast')">Load More</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="tab-pane fade" id="pills-monthly-lunch" role="tabpanel" aria-labelledby="pills-monthly-lunch-tab">
                            <div class="breakfast-monthly-container" id="lunch-monthly-meal">
                            </div>
                            <div class="foodsectionsloadmorebtn" id="lunch-monthly-meal-lmbtn" style="display: none;">
                                <a href="javascript:void(0)" onclick="load_monthly_package('lunch')">Load More</a>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-monthly-dinner" role="tabpanel" aria-labelledby="pills-monthly-dinner-tab">
                            <div class="breakfast-monthly-container" id="dinner-monthly-meal">
                            </div>
                            <div class="foodsectionsloadmorebtn" id="dinner-monthly-meal-lmbtn" style="display: none;">
                                <a href="javascript:void(0)" onclick="load_monthly_package('monthly')">Load More</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="tab-pane fade" id="pills-trialmeal" role="tabpanel" aria-labelledby="pills-trialmeal-tab">
                    <div class="menu-container">
                        <div class="menu-meal">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="pills-trial-breakfast-tab" data-toggle="pill" href="#pills-trial-breakfast" role="tab" aria-controls="pills-trial-breakfast" aria-selected="true">Breakfast</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-trial-lunch-tab" data-toggle="pill" href="#pills-trial-lunch" role="tab" aria-controls="pills-trial-lunch" aria-selected="false">Lunch</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-trial-dinner-tab" data-toggle="pill" href="#pills-trial-dinner" role="tab" aria-controls="pills-trial-dinner" aria-selected="false">Dinner</a>
                                </li>
                            </ul>
                        </div>
                        <div class="select-meal-type">
                            <ul>
                                <li>
                                    <input type="radio" name="trialitemtype" id="trialVegFooods" value="0" checked class="inputHidden" />
                                    <label for="trialVegFooods">
                                        <span><img src="<?= FRONT_IMAGES_URL ?>vegFood_icon.png" alt=""></span>Veg
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" name="trialitemtype" id="trialNonVegFoods" value="1" class="inputHidden" />
                                    <label for="trialNonVegFoods">
                                        <span><img src="<?= FRONT_IMAGES_URL ?>NonVegFood_icon.png" alt=""></span>Non-Veg
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" name="trialitemtype" id="trialVegNonVegFoods" value="2" class="inputHidden" />
                                    <label for="trialVegNonVegFoods">
                                        <span><img src="<?= FRONT_IMAGES_URL ?>VegNonVegFood-icon.png" alt=""></span>Both
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-trial-breakfast" role="tabpanel" aria-labelledby="pills-trial-breakfast-tab">
                            <div class="breakfast-menu-container" id="breakfast-trial-meal">
                            </div>
                            <div class="foodsectionsloadmorebtn" id="breakfast-trial-meal-lmbtn" style="display: none;">
                                <a href="javascript:void(0)" onclick="load_trialmenu('breakfast')">Load More</a>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-trial-lunch" role="tabpanel" aria-labelledby="pills-trial-lunch-tab">
                            <div class="breakfast-menu-container" id="lunch-trial-meal">
                            </div>
                            <div class="foodsectionsloadmorebtn" id="lunch-trial-meal-lmbtn" style="display: none;">
                                <a href="javascript:void(0)" onclick="load_trialmenu('lunch')">Load More</a>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-trial-dinner" role="tabpanel" aria-labelledby="pills-trial-dinner-tab">
                            <div class="breakfast-menu-container" id="dinner-trial-meal">
                            </div>
                            <div class="foodsectionsloadmorebtn" id="dinner-trial-meal-lmbtn" style="display: none;">
                                <a href="javascript:void(0)" onclick="load_trialmenu('dinner')">Load More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

    </div>
    
</div>

<!-- Rating And Review Modal --->
<div class="reviews-rating-modal modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="headings">
                    <h5 class="modal-title" id="exampleModalLabel">Customer Reviews</h5>
                    <p class="sub-heading">All Reviews (<span id="mdl_reviews_count">0</span>)</p>
                </div>
                <div class="exapand-food-review-btn-container text-right">
                    <img src="<?= FRONT_IMAGES_URL ?>Group10153.png" alt="">
                </div>
                <div class="btn-close-container">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="<?= FRONT_IMAGES_URL ?>Group3314.png" alt=""></span>
                    </button>
                </div>
            </div>

            <div class="modal-body">
                <div class="customer-review-container">
                    <div class="customer-review-contents">
                        <div id="reviewlist"></div>
                        <div class="foodsectionsloadmorebtn" id="review-lmbtn" style="display: none;">
                            <a href="javascript:void(0)" onclick="get_reviews(<?= $kitchendata['id'] ?>)">Load More</a>
                        </div>
                    </div>
                    <div class="food-experience">
                        <div class="food-experience-container">
                            <form id="rating-form">
                                <p class="heading">Rate your food experience</p>
                                <input type="hidden" name="review_rating" id="review_rating">
                                <div class="rating">
                                    <ul id='stars'>
                                        <li class='star' title='Poor' data-value='1'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' title='Fair' data-value='2'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' title='Good' data-value='3'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' title='Excellent' data-value='4'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                        <li class='star' title='WOW!!!' data-value='5'>
                                            <i class='fa fa-star fa-fw'></i>
                                        </li>
                                    </ul>
                                </div>
                                <div class="review-desc-container">
                                    <p class="review-heading">With a Review</p>
                                    <textarea rows="5" id="review_message" name="review_message"></textarea>
                                </div>
                                <div class="food-status2">
                                    <div class="left-part">
                                        <p>Food Quality</p>
                                    </div>
                                    <div class="right-part">
                                        <input type="radio" id="foodqualitygood" name="radioQuality" value="1" checked>
                                        <label for="foodqualitygood"><img src="<?= FRONT_IMAGES_URL ?>like.png"></label>
                                        <input type="radio" id="foodqualitybad" name="radioQuality" value="0">
                                        <label for="foodqualitybad"><img src="<?= FRONT_IMAGES_URL ?>like1.png"></label>
                                    </div>
                                </div>
                                <div class="food-status2">
                                    <div class="left-part">
                                        <p>Taste</p>
                                    </div>
                                    <div class="right-part">
                                        <input type="radio" id="tastegood" name="radioTaste" value="1" checked>
                                        <label for="tastegood"><img src="<?= FRONT_IMAGES_URL ?>like.png"></label>
                                        <input type="radio" id="tastebad" name="radioTaste" value="0">
                                        <label for="tastebad"><img src="<?= FRONT_IMAGES_URL ?>like1.png"></label>
                                    </div>
                                </div>
                                <div class="food-status2">
                                    <div class="left-part">
                                        <p>Quantity</p>
                                    </div>
                                    <div class="right-part">
                                        <input type="radio" id="quantitygood" name="radioQuantity" value="1" checked>
                                        <label for="quantitygood"><img src="<?= FRONT_IMAGES_URL ?>like.png"></label>
                                        <input type="radio" id="quantitybad" name="radioQuantity" value="0">
                                        <label for="quantitybad"><img src="<?= FRONT_IMAGES_URL ?>like1.png"></label>
                                    </div>
                                </div>
                                <div class="foodexp-btn-container">
                                    <?php if (empty($this->session->userdata(base_url() . 'FOODIESUSERID'))) { ?>
                                        <a href="<?= FRONT_URL ?>login" class="foodexp-submit" name="foodexp-submit">Submit</a>
                                    <?php } else { ?>
                                        <a href="javascript:void(0)" onclick="submit_review()" class="foodexp-submit" name="foodexp-submit">Submit</a>
                                    <?php } ?>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="food-review-img-container">
                        <img src="<?= FRONT_IMAGES_URL ?>Asset1.png" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="packageModal" class="packagemodal modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title" id="packagetitle"></p>
                <button type="button" class="close" data-dismiss="modal"><img src="<?= FRONT_IMAGES_URL ?>Group3314.png" alt="" class="img-fluid"></button>
            </div>
            <div class="modal-body" id="package_detail">
            </div>
        </div>
    </div>
</div>

<!-- Select This Package --->
<div id="select-package-modal" class="selectpackagemodal modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title">Package 1 - Select Date & Time</p>
                <button type="button" class="close" data-dismiss="modal"><img src="<?= FRONT_IMAGES_URL ?>Group3314.png" alt="" class="img-fluid"></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12" id="datetimeerror" style="color: red;"></div>
                <div class="datetimecontainer">
                    <div class="date-section">
                        <p class="heading">When would you like to start meal? Select a week</p>
                        <div id="weekpicker"></div>
                    </div>
                    <div class="time-section">
                        <p class="heading">At what time you want delivery?</p>
                        <div class="choose-time">
                            <input type="radio" name="delivery-time" id="fulleleven" value="11:00-11:30"><label for="fulleleven">11:00-11:30</label>
                            <input type="radio" name="delivery-time" id="halfeleven" value="11:30-12:00"><label for="halfeleven">11:30-12:00</label>
                            <input type="radio" name="delivery-time" id="halftwelve" value="12:30-13:00"><label for="halftwelve">12:30-1:00</label>
                            <input type="radio" name="delivery-time" id="halfone" value="13:30-14:00"><label for="halfone">1:30-2:00</label>
                            <input type="radio" name="delivery-time" id="fulltwo" value="14:00-14:30"><label for="fulltwo">2:00-2:30</label>
                            <input type="radio" name="delivery-time" id="halftwo" value="14:30-15:00"><label for="halftwo">2:30-3:00</label>
                        </div>
                    </div>
                </div>
                <div class="includesunsat">
                    <div class="left-part-section">
                        <!-- <div class="weekendwith">
                    <div class="radio radio-success">
                        <input type="radio" name="includeweekend" id="includeSat" checked><label for="includeSat">Include Saturday</label>
                    </div>  
                    <div class="radio radio-success">
                        <input type="radio" name="includeweekend" id="includeSun"><label for="includeSun">Include Sunday</label>
                    </div>  
               </div> -->
                        <!-- <div class="form-row toggles">
                    <div class="form-group" style="margin-left: 20px;">
                        <div class="toggle-title">Including Saturday</div>
                        <label class="switch">
                            <input type="checkbox" id="including_saturday" name="including_saturday" value="1" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>
                
                    <div class="form-group" style="margin-left: 20px;">
                        <div class="toggle-title">Including Sunday</div>
                        <label class="switch">
                            <input type="checkbox" id="including_sunday" name="including_sunday" value="1" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div> -->
                    </div>
                    <div class="right-part-section">
                        <div class="btn-container">
                            <a href="javascript:void(0)" class="btn-back" data-dismiss="modal"><img src="<?= FRONT_IMAGES_URL ?>right-arrow.png" alt="" class="img-fluid"><span>Back</span></a>
                            <a href="javascript:void(0)" onclick="check_date()" class="btn-next"><span>Next</span> <img src="<?= FRONT_IMAGES_URL ?>right-arrow.png" alt="" class="img-fluid"></a> <!-- data-toggle="modal" data-target="#packageconfirm" -->
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>


<!-- #customizable-modal  --->
<div id="customizable-modal" class="customizablemodal modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title">Select from below options</p>
                <button type="button" class="close" data-dismiss="modal"><img src="<?= FRONT_IMAGES_URL ?>Group3314.png" alt="" class="img-fluid"></button>
            </div>
            <div class="modal-body">
                <div class="customizable-modal-container">
                    <div id="customizable_modal_data">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- #packageconfirm  --->
<div id="packageconfirm" class="packageconfirmmodal modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title">Package 1</p>
                <button type="button" class="close" data-dismiss="modal"><img src="<?= FRONT_IMAGES_URL ?>Group3314.png" alt="" class="img-fluid"></button>
            </div>
            <div class="modal-body">
                <form id="package_form">
                    <input type="hidden" name="ord_kitchenid" id="ord_kitchenid" value="<?= $kitchendata['id'] ?>">
                    <input type="hidden" name="ord_mealplan" id="ord_mealplan">
                    <input type="hidden" name="ord_packageid" id="ord_packageid">

                    <input type="hidden" name="ord_delivery_startdate" id="ord_delivery_startdate">
                    <input type="hidden" name="ord_delivery_enddate" id="ord_delivery_enddate">
                    <input type="hidden" name="ord_delivery_fromtime" id="ord_delivery_fromtime">
                    <input type="hidden" name="ord_delivery_totime" id="ord_delivery_totime">

                    <div id="package_confirm_detail">

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-----------------------------------------------------------------------------------------------prathap cart right-------------------------------------------------------------------------------->



<div class="clearfix"></div>
<style>

.remove-meal1, 
.add-meal1,
.mealcount1 {
    border: none;
    background-color: transparent;
    color:#fff;
}

.checkout-cart-section .product-pay-information {
    background-color: #fff;
    padding: 25px 20px;
    margin-right: 0px;
    border-radius: 10px;
    float: right;
    top:-150px;
}
.checkout-cart-section .checkout-cart-section-container {
    display: flex;
    /* flex-wrap: wrap; */
    justify-content: right;
    margin-top: -375px;
    margin-bottom: 316px;
}

.mealcount1 {
    width:30px;
    text-align: center;
}

  .radio label {
      display: inline-block;
      vertical-align: middle;
      position: relative;
      padding-left: 10px;
      font-size: 19px;
      color: #2F3443;
  }
  .radio label::before {
      content: "";
      display: inline-block;
      position: absolute;
      width: 20px;
      height: 20px;
      left: 0;
      margin-left: -20px;
      border: 1px solid #cccccc;
      border-radius: 50%;
      background-color: #fff;
      -webkit-transition: border 0.15s ease-in-out;
      -o-transition: border 0.15s ease-in-out;
      transition: border 0.15s ease-in-out;
  }
  .radio label::after {
      display: inline-block;
      position: absolute;
      content: " ";
      width: 9px;
      height: 9px;
      left: 5px;
      top: 6px;
      margin-left: -20px;
      border-radius: 50%;
      background-color: #555555;
      -webkit-transform: scale(0, 0);
      -ms-transform: scale(0, 0);
      -o-transform: scale(0, 0);
      transform: scale(0, 0);
      -webkit-transition: -webkit-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
      -moz-transition: -moz-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
      -o-transition: -o-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
      transition: transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
  }
  .radio input[type="radio"] {
      opacity: 0;
      z-index: 1;
  }
  .radio input[type="radio"]:checked + label::before {
      border-color: #5cb85c;
  }
  .radio input[type="radio"]:checked + label::after {
      background-color: #5cb85c;
      -webkit-transform: scale(1, 1);
      -ms-transform: scale(1, 1);
      -o-transform: scale(1, 1);
      transform: scale(1, 1);
  }
</style>
<script>
var searchInput = 'delivery_address';
$(document).ready(function(){
    calculate_sub_total();

    var autocomplete;
    autocomplete = new google.maps.places.Autocomplete(document.getElementById(searchInput));
	
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var near_place = autocomplete.getPlace();
        document.getElementById('deliverylatitude').value = near_place.geometry.location.lat();
        document.getElementById('deliverylongitude').value = near_place.geometry.location.lng();
        // console.log(near_place.formatted_address);
        // var lat_1 = $("#kitchen_latitude").val();
        // var long_1 = $("#kitchen_longitude").val();
        // var lat_2 = $("#deliverylatitude").val();
        // var long_2 = $("#deliverylongitude").val();
    
        getDistance(near_place.formatted_address,kitchen_address,'distance',1);
    });
});
$(document).on('keyup', '.class_cart_items .mealcount', function(){
    var id = $(this).attr("id").match(/\d+/);
    // let mealcount = $('#mealcount1'+id).val();
    var cart_id = $("#cart_id"+id).val();
    editcart(cart_id,id,2);
    calculate_menu_price(id);
});
$(document).on('click', '.class_cart_items .add-meal', function(){
    var id = $(this).attr("id").match(/\d+/);
    let mealcount = $('#mealcount'+id).val();
    if(mealcount == "") {
        mealcount = 1;
        $('#mealcount'+id).val(parseInt(mealcount)) ;
        $('#btn-container'+id).css({'background-color':'#FCC647'});
        $('#mealcount'+id).css({'font-weight':'bold'});
        
    } else {
        mealcount = parseInt(mealcount)+1;
        $('#mealcount'+id).val(mealcount) ;
        $('#mealcount'+id).css({'font-weight':'bold'});
    }
    var cart_id = $("#cart_id"+id).val();
    editcart(cart_id,id,1);
    calculate_menu_price(id);
});

$(document).on('click', '.class_cart_items .remove-meal', function(){
    var id = $(this).attr("id").match(/\d+/);
    
    let mealcount = $('#mealcount'+id).val();
    
    var cart_id = $("#cart_id"+id).val();
    editcart(cart_id,id,0);
    
    if(mealcount <= 1) {
        mealcount = "0"; 
        $('#mealcount'+id).val(mealcount);
        $('#mealcount'+id).css({'font-weight':'Normal'});

        $("#id_cart_items"+id).remove();
    } else {
        mealcount = parseInt(mealcount)-1;
        $('#mealcount'+id).val(mealcount);
        $('#mealcount'+id).css({'font-weight':'bold'});
        if($('#mealcount'+id).val(mealcount)==0 )
        {
            mealcount = 'Add';
            $('#btn-container'+id).css({'background-color':'transparent'});
        }

    }
    
    calculate_menu_price(id);
});

function calculate_menu_price(menuid){
    
    var qty = $('#mealcount'+menuid).val();
    var itemprice = $('#tm_itemprice'+menuid).val();

    var total_menu_price = parseFloat(itemprice) * parseFloat(qty);
    $("#total_menu_price"+menuid).val(parseFloat(total_menu_price).toFixed(2));
    $("#txt_total_menu_price"+menuid).html("₹"+parseFloat(total_menu_price).toFixed(2));

    calculate_sub_total();   
}

function calculate_sub_total(){
    
    var total_price = 0;
    $(".total_menu_price").each(function(){
        total_price += parseFloat(this.value); 
    });
    
    var sub_total = parseFloat(total_price);
    $("#sub_total").val(parseFloat(sub_total).toFixed(2));
    $("#txt_sub_total").html("₹"+parseFloat(sub_total).toFixed(2));


}
$('#cart_details').load("<?php echo base_url(); ?>Kitchen_detail/load");



function check_offer_code(kitchen_id){
    var offercode = $("#offercode").val();   

    $("#offercode").css("border-bottom","1px solid #E8E9F2");
    
    if(offercode==""){
        toastr.error("Please enter offer code !");
        $("#offercode").css("border-bottom","1px solid #ff0000").focus();
    }else{
        var total_price = 0;
        $(".total_menu_price").each(function(){
            total_price += parseFloat(this.value); 
        });
        
        $.ajax({
            url: SITE_URL+'checkout/check-offer-code',
            type: 'POST',
            data: {kitchen_id:kitchen_id, offercode:offercode, orderamount:total_price},
            dataType: 'json',
            // async: false,
            success: function(response){
                // var obj = JSON.parse(response);
                
                if(response['type'] == 1){
                    toastr.success(response['msg']);

                    var discount = response['discount'];
                    $("#coupon_ammount").val(parseFloat(discount).toFixed(2));
                    $("#txt_coupon_ammount").html("-₹"+parseFloat(discount).toFixed(2));

                    calculate_sub_total();

                }else if(response['type'] == 0){
                    toastr.error(response['msg']);
                    $("#offercode").css("border-bottom","1px solid #ff0000").focus();
                }
            },
            error: function(xhr) {
            //alert(xhr.responseText);
            },
        });
    }
}
function show_ordering_for_popup(){

    $("#ordering-for-modal").modal("show");

    var name = $("#orderingforname").val();
    var mobileno = $("#orderingformobileno").val();
    
    $("#modal_ord_for_name").val(name);
    $("#modal_ord_for_mobile").val(mobileno);
    
}
function check_order_for_detail(){
    var name = $("#modal_ord_for_name").val();
    var mobileno = $("#modal_ord_for_mobile").val();
    var isvalid = 1;

    if(name==""){
        $("#modal_ord_for_name_error").html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please enter name !');
        isvalid = 0;
    }else if(name.length < 2){
        $("#modal_ord_for_name_error").html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Name require min. 2 characters !');
        isvalid = 0;
    }else{
        $("#modal_ord_for_name_error").html("");
    }
    if(mobileno==""){
        $("#modal_ord_for_mobile_error").html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please enter mobile no. !');
        isvalid = 0;
    }else if(mobileno.length != 10){
        $("#modal_ord_for_mobile_error").html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Mobile no. require 10 digits !');
        isvalid = 0;
    }else{
        $("#modal_ord_for_mobile_error").html("");
    }

    if(isvalid==1){
        $("#orderingforname").val(name);
        $("#orderingformobileno").val(mobileno);

        $("#txt_ord_for").html(name+", "+mobileno);

        $("#ordering-for-modal").modal("hide");
    }
}

function checkout(){
    var wallet = $("input[name=wallet_payment_method]").is(":checked"); 
    var payment_method = $("input[name=payment_method]").is(":checked"); 
    var delivery_address = $("#delivery_address").val(); 
    var orderingforname = $("#orderingforname").val(); 
    var orderingformobileno = $("#orderingformobileno").val(); 
    var noofcartitems = $(".noofcartitems").length; 
    var orderamount = $("#sub_total").val(); 
    var wallet_balance_amount = $("#wallet_balance_amount").val(); 

    var is_valid = 1;
    var payment_amount = 0;

    if(payment_method == false && wallet == false){
        toastr.error("Please select payment method !");
        is_valid = 0;
    }else{
        if(wallet == true && payment_method == false && parseFloat(wallet_balance_amount) < parseFloat(orderamount)){
            toastr.error("Insufficient balance in your wallet. Add money in your wallet or select payment method !");
            is_valid = 0;
        }
        payment_amount = parseFloat(orderamount);

        if(wallet == true && payment_method == true && parseFloat(wallet_balance_amount) < parseFloat(orderamount)){
            if(parseFloat(wallet_balance_amount) > 0){
                payment_amount = parseFloat(orderamount) - parseFloat(wallet_balance_amount);
            }
        }
        /* if($("input[name=payment_method]:checked").val() == "by_card"){

            if(cardFormValidate() == false){
                toastr.error("Please enter correct card details !");
                is_valid = 0;
            }

        } */
    }
    if(delivery_address == ""){
        toastr.error("Please enter location !");
        is_valid = 0;
    }
    if(orderingforname == "" || orderingformobileno == ""){
        toastr.error("Please enter ordering for name & mobile no. !");
        is_valid = 0;
    }
    if(noofcartitems <= 0){
        toastr.error("Add atleast one item in cart !");
        is_valid = 0;
    }


    if(is_valid){
        /* if(payment_method == true && parseFloat(payment_amount) > 0){
            $("#payment_form").append($("<input>").attr("type", "hidden").attr("name", "amount").val(parseFloat(payment_amount).toFixed(2)));
            $("#payment_form").append($("<input>").attr("type", "hidden").attr("name", "firstname").val($("#customer_name").val()));
            $("#payment_form").append($("<input>").attr("type", "hidden").attr("name", "lastname").val($("#customer_name").val()));
            $("#payment_form").append($("<input>").attr("type", "hidden").attr("name", "email").val($("#customer_email").val()));
            $("#payment_form").append($("<input>").attr("type", "hidden").attr("name", "phone").val($("#customer_mobileno").val()));
            $("#payment_form").append($("<input>").attr("type", "hidden").attr("name", "address1").val(delivery_address));
            
            $('#payment_form').submit();
        } */
        var formdata = new FormData($('#checkout_form')[0]);
        $.ajax({
            url: SITE_URL+'checkout/place-order',
            type: 'POST',
            data: formdata,
            dataType: 'json',
            // async: false,
            beforeSend: function(){
                $('#btn-checkout').css('opacity','0.3').prop("disabled",true);
            },
            success: function(response){
                // var obj = JSON.parse(response);
                
                if(response['type'] == 1){
                    // toastr.success(response['msg']);
                    
                    if(payment_method == true && parseFloat(payment_amount) > 0){

                        $("#payment_form").append($("<input>").attr("type", "hidden").attr("name", "amount").val(parseFloat(payment_amount).toFixed(2)));
                        $("#payment_form").append($("<input>").attr("type", "hidden").attr("name", "firstname").val($("#customer_name").val()));
                        $("#payment_form").append($("<input>").attr("type", "hidden").attr("name", "lastname").val($("#customer_name").val()));
                        $("#payment_form").append($("<input>").attr("type", "hidden").attr("name", "email").val($("#customer_email").val()));
                        $("#payment_form").append($("<input>").attr("type", "hidden").attr("name", "phone").val($("#customer_mobileno").val()));
                        $("#payment_form").append($("<input>").attr("type", "hidden").attr("name", "address1").val(delivery_address));
                        $("#payment_form").append($("<input>").attr("type", "hidden").attr("name", "order_id").val(response['order_id']));
                        
                        $('#payment_form').submit();
                    }else{
                        if(wallet == true && payment_method == false){
                            toastr.success(response['msg']);

                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        }
                    }
                    $('#btn-checkout').css('opacity','1').prop("disabled",false);
                    
                }else if(response['type'] == 0){
                    toastr.error(response['msg']);
                }
            },
            error: function(xhr) {
            //alert(xhr.responseText);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }

}
/* function cardFormValidate(){
    var cardValid = 0;

    //card number validation
    $('#card_number').validateCreditCard(function(result){
        if(result.valid){
            cardValid = 1;
        }else{
            cardValid = 0;
        }
    });
      
    //card details validation
    var cardName = $("#cardholder_name").val();
    var validthru = $("#validthru").val().toString().split("/");
    var expMonth = validthru[0];
    var expYear = $("#validthru").val() != "" ? (validthru[1].length==2)?"20"+validthru[1]:validthru[1] : "";
    var cvv = $("#cvv").val();
    var regName = /^[a-z ,.'-]+$/i;
    var regMonth = /^01|02|03|04|05|06|07|08|09|10|11|12$/;
    var regYear = /^2017|2018|2019|2020|2021|2022|2023|2024|2025|2026|2027|2028|2029|2030|2031$/;
    var regCVV = /^[0-9]{3,3}$/;
    if (cardValid == 0) {
        $("#card_number").addClass('required');
        $("#card_number").focus();
        return false;
    }else if (!regMonth.test(expMonth)) {
        $("#card_number").removeClass('required');
        $("#validthru").addClass('required');
        $("#validthru").focus();
        return false;
    }else if (!regYear.test(expYear)) {
        $("#card_number").removeClass('required');
        $("#validthru").removeClass('required');
        $("#validthru").addClass('required');
        $("#validthru").focus();
        return false;
    }else if (!regCVV.test(cvv)) {
        $("#card_number").removeClass('required');
        $("#validthru").removeClass('required');
        $("#validthru").removeClass('required');
        $("#cvv").addClass('required');
        $("#cvv").focus();
        return false;
    }else if (!regName.test(cardName)) {
        $("#card_number").removeClass('required');
        $("#validthru").removeClass('required');
        $("#validthru").removeClass('required');
        $("#cvv").removeClass('required');
        $("#cardholder_name").addClass('required');
        $("#cardholder_name").focus();
        return false;
    }else{
        $("#card_number").removeClass('required');
        $("#validthru").removeClass('required');
        $("#validthru").removeClass('required');
        $("#cvv").removeClass('required');
        $("#cardholder_name").removeClass('required');
        return true;
    }
} */

function checkout2(){
    var wallet = $("input[name=wallet_payment_method]").is(":checked"); 
    var payment_method = $("input[name=payment_method]").is(":checked"); 
    var delivery_address = $("#delivery_address").val(); 
    var orderingforname = $("#orderingforname").val(); 
    var orderingformobileno = $("#orderingformobileno").val(); 
    var noofcartitems = $(".noofcartitems").length; 
    var orderamount = $("#sub_total").val(); 
    var wallet_balance_amount = $("#wallet_balance_amount").val(); 

    var is_valid = 1;
    var payment_amount = 0;

    if(payment_method == false && wallet == false){
        toastr.error("Please select payment method !");
        is_valid = 0;
    }else{
        if(wallet == true && payment_method == false && parseFloat(wallet_balance_amount) < parseFloat(orderamount)){
            toastr.error("Insufficient balance in your wallet. Add money in your wallet or select payment method !");
            is_valid = 0;
        }

        payment_amount = parseFloat(orderamount);
        if(wallet == true && payment_method == true && parseFloat(wallet_balance_amount) < parseFloat(orderamount)){
            if(parseFloat(wallet_balance_amount) > 0){
                payment_amount = parseFloat(orderamount) - parseFloat(wallet_balance_amount);
            }
        }
        if($("input[name=payment_method]:checked").val() == "by_card"){

            if(cardFormValidate() == false){
                // toastr.error("Please enter correct card details !");
                // is_valid = 0;
            }

        }
    }
    if(delivery_address == ""){
        toastr.error("Please enter location !");
        is_valid = 0;
    }
    if(orderingforname == "" || orderingformobileno == ""){
        toastr.error("Please enter ordering for name & mobile no. !");
        is_valid = 0;
    }
    if(noofcartitems <= 0){
        toastr.error("Add atleast one item in cart !");
        is_valid = 0;
    }


    if(is_valid){
        
        if(payment_method == true && parseFloat(payment_amount) > 0){

            var method = "CC";
            if($("input[name=payment_method]:checked").val() == "by_netbanking"){
                method = "NB";
            }else if($("input[name=payment_method]:checked").val() == "by_upi"){
                method = "UPI";
            }
            
            $("#payment_form").append($("<input>").attr("type", "hidden").attr("name", "bankcode").val(method));
            $("#payment_form").append($("<input>").attr("type", "hidden").attr("name", "amount").val(parseFloat(10).toFixed(2)));
            $("#payment_form").append($("<input>").attr("type", "hidden").attr("name", "firstname").val($("#customer_name").val()));
            $("#payment_form").append($("<input>").attr("type", "hidden").attr("name", "lastname").val($("#customer_name").val()));
            $("#payment_form").append($("<input>").attr("type", "hidden").attr("name", "email").val($("#customer_email").val()));
            $("#payment_form").append($("<input>").attr("type", "hidden").attr("name", "phone").val($("#customer_mobileno").val()));
            $("#payment_form").append($("<input>").attr("type", "hidden").attr("name", "address1").val(delivery_address));
            $("#payment_form").append($("<input>").attr("type", "hidden").attr("name", "order_id").val(13));
            
            $('#payment_form').submit();

        }
        $('#btn-checkout').css('opacity','1').prop("disabled",false);
    }

}

</script>
<div class="kitchen-information">
    <div class="container-fluid">
        <div class="checkout-cart-section">
            <?php if(!empty($cart_items_array)){ ?>
            <form id="checkout_form">
              <div class="checkout-cart-section-container">
                  <div class="product-pay-information">
                      <p class="service-heading">Your oder</p>
                      <?php if(!empty($cart_items_array)){ 
                        foreach($cart_items_array as $_cart){
                          if($_cart['type']==2){ ?>
                            <div class="product-information class_cart_items noofcartitems" id="id_cart_items<?=$_cart['typeid']?>">
                              <div class="left-part-side">
                                <div class="img-container">
                                    <img src="<?=MENU.$_cart['menuimage']?>" alt="<?=$_cart['menuimage']?>" class="img-fluid">
                                </div>
                                <div class="name-price">
                                    <!--<p class="product-name"><?=$_cart['name']?></p>-->
                                    <p class="meal-type"><?php 
                                          if($_cart['cuisinetype']==0){
                                              echo "South Indian";
                                          }else if($_cart['cuisinetype']==1){
                                              echo "North Indian";
                                          }else if($_cart['cuisinetype']==2){
                                              echo "Other Indian";
                                          } 
                                          ?>
                                    </p>
                                    <p class="product-cost">₹<?=$_cart['price']?></p>
                                    <p class="date-time"><?=$this->general_model->convertdate($_cart['createddate'], 'd M Y h:i A')?></p>
                                </div>
                                 
                              </div>
                              
                              <div class="right-part-side">
                                  <div class="btn-container">
                                      <button type="button" class="remove-meal" id="removemeal<?=$_cart['typeid']?>" style="<?=($_cart['quantity']<=0)?"display:none;":""?>">-</button>
                                      <input type="button" name="quantity[]" value="<?=$_cart['quantity']?>" class="mealcount" id="mealcount<?=$_cart['typeid']?>" onkeypress="return isNumeric(event)">
                                      <button type="button" class="add-meal" id="addmeal<?=$_cart['typeid']?>">+</button>
                                  </div>
                                  <p class="total-cost" id="txt_total_menu_price<?=$_cart['typeid']?>">₹<?=number_format(($_cart['quantity']*$_cart['price']),2,'.',',')?></p>
                                  
                                  <input type="hidden" id="cart_id<?=$_cart['typeid']?>" value="<?=$_cart['id']?>">
                                  <input type="hidden" name="kitchen_id[]" id="kitchen_id<?=$_cart['typeid']?>" value="<?=$_cart['kitchen_id']?>">
                                  <input type="hidden" name="mealplan[]" value="<?=$_cart['type']?>">
                                  <input type="hidden" name="reference_id[]" value="<?=$_cart['typeid']?>">
                                  <input type="hidden" name="cuisinetype[]" value="<?=$_cart['cuisinetype']?>">
                                  
                                  <input type="hidden" name="item_name[]" id="tm_itemname<?=$_cart['typeid']?>" value="<?=$_cart['name']?>">
                                  <input type="hidden" name="item_price[]" id="tm_itemprice<?=$_cart['typeid']?>" value="<?=$_cart['price']?>">
                                  
                                  <input type="hidden" name="delivery_startdate[]" value="">
                                  <input type="hidden" name="delivery_enddate[]" value="">
                                  <input type="hidden" name="delivery_fromtime[]" value="">
                                  <input type="hidden" name="delivery_totime[]" value="">
                                  
                                  <input type="hidden" name="total_amount[]" class="total_menu_price" id="total_menu_price<?=$_cart['typeid']?>" value="<?=($_cart['quantity']*$_cart['price'])?>">
                              </div>
                            </div>
                          <?php }else{ ?>
                            <div class="noofcartitems">
                              <input type="hidden" name="mealplan[]" value="<?=$_cart['type']?>">
                              <input type="hidden" name="reference_id[]" value="<?=$_cart['typeid']?>">
                              <input type="hidden" name="cuisinetype[]" value="<?=$_cart['cuisinetype']?>">
                              <input type="hidden" name="item_name[]" id="pkg_name<?=$_cart['typeid']?>" value="<?=$_cart['name']?>">
                              <input type="hidden" name="item_price[]" id="pkg_price<?=$_cart['typeid']?>" value="<?=$_cart['price']?>">
                              <input type="hidden" class="total_menu_price" name="total_amount[]" id="pkg_amount<?=$_cart['typeid']?>" value="<?=$_cart['price']?>">

                              <input type="hidden" name="delivery_startdate[]" value="<?=$_cart['fromdate']?>">
                              <input type="hidden" name="delivery_enddate[]" value="<?=$_cart['todate']?>">
                              <input type="hidden" name="delivery_fromtime[]" value="<?=$_cart['delivery_fromtime']?>">
                              <input type="hidden" name="delivery_totime[]" value="<?=$_cart['delivery_totime']?>">

                              <div class="package-name-cost">
                                  <div class="package-name-section">
                                      <div class="img-container">
                                          <img src="" alt="" class="img-fluid">
                                      </div>
                                      <p class="package-heading"><?=$_cart['name']?></p>
                                  </div>
                                  <p class="package-cost">₹<?=number_format($_cart['price'],2,'.',',')?></p>
                                  
                              </div>
                              <p class="meal-type2"><?php 
                                if($_cart['cuisinetype']==0){
                                    echo "South Indian";
                                }else if($_cart['cuisinetype']==1){
                                    echo "North Indian";
                                }else if($_cart['cuisinetype']==2){
                                    echo "Other Indian";
                                } ?>
                              </p>

                              <?php if($_cart['including_saturday']==1 || $_cart['including_sunday']==1){ ?>
                                <p class="weekend"><span class="cementgray">Including</span> 
                                  <?php if($_cart['including_saturday']==1){
                                      echo ($_cart['including_sunday']==1)?"Saturday, ":"Saturday";
                                  }
                                  if($_cart['including_sunday']==1){
                                      echo "Sunday";
                                  } ?>
                                </p>
                              <?php } ?>
                              <p class="package-days">
                                  <?php if($_cart['fromdate'] == $_cart['todate']){
                                    echo date("d M", strtotime($_cart['fromdate']));
                                  }else{
                                    echo date("d M", strtotime($_cart['fromdate'])).' to '.date("d M Y", strtotime($_cart['todate']));   
                                  } ?> at <?=date("h:i A", strtotime($_cart['delivery_fromtime']))?></p>
                            </div>
                          <?php }
                        }
                      } ?>
                        
                      <br><br>
                          <div class="total-amount-section">
                          <p class="amount-heading">Subtotal</p>
                          <p class="total-amount" id="txt_sub_total">₹40</p>

                          <input type="hidden" name="sub_total" id="sub_total" value="">
                      </div>
                      <div class="border-dashed-bottom border-color-yellow margin-top35"></div>
                      
                      <!-- Prathap Edit button-->
                      <div class="right-part">
                         
                          <div class="btn-container">
                            <a href="../checkout" class="btn-checkout" id="btn-checkout">checkout here</a> 
                          </div>
                      </div>
                      
                      <!-- Prathap Edited button-->
                      
                  </div>
              </div>
            </form>
           
            <?php }else{ ?>
              <div class="checkout-cart-section-container">
                <div style="background-color: white;padding: 20px;width: 100%;margin-left:680px;">
                  No any items available in cart. 
                </div>
              </div>
            <?php } ?>
        </div>
    </div>  
</div>


<!-- Booking Confirm Dialog Box --->
<div class="booking-confirm-modal modal fade" id="booking-confirm-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-container">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true"><img src="<?=FRONT_IMAGES_URL?>Group3314.png" alt="" class="img-fluid"></span>
                    </button>
                </div>    
            </div>
            <div class="modal-body">
                <div class="rate-experience-container">
                    <div class="rate-experience-content">
                        <p class="heading">Please rate your experience with NOHUNG</p>
                        <p class="sub-heading">Order ID 123456 | Ameya Reddy</p>
                        <div class="rating">
                            <input type="radio" name="star" id="star1"><label for="star1"><img src="<?=FRONT_IMAGES_URL?>sad1.png" alt="" class="img-fluid"></label>
                            <input type="radio" name="star" id="star2"><label for="star2"><img src="<?=FRONT_IMAGES_URL?>sad2.png" alt="" class="img-fluid"></label>
                            <input type="radio" name="star" id="star3"><label for="star3"><img src="<?=FRONT_IMAGES_URL?>smile.png" alt="" class="img-fluid"></label>
                            <input type="radio" name="star" id="star4"><label for="star4"><img src="<?=FRONT_IMAGES_URL?>happy.png" alt="" class="img-fluid"></label>
                            <input type="radio" name="star" id="star5" checked><label for="star5"><img src="<?=FRONT_IMAGES_URL?>Group10548.png" alt="" class="img-fluid"></label>
                         </div>
                        <p class="tellus">Tell us more so we can improve</p>
                        <textarea class="tellus-text"></textarea>
                        <div class="recommend-other">
                            <div class="left-part-side">
                                <p class="heading">Recommend to others</p>
                                <div class="yesno-btn">
                                    <div class="btn-container">
                                        <input type="radio" name="yesno" id="yes" checked><label for="yes"><img src="<?=FRONT_IMAGES_URL?>positivevote.png" alt="" class="img-fluid"><span>Yes</span></label>
                                    </div>
                                    <div class="btn-container">
                                        <input type="radio" name="yesno" id="no"><label for="no"><img src="<?=FRONT_IMAGES_URL?>negativevote.png" alt="" class="img-fluid" alt=""><span>No</span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="right-part-side">
                               <div class="btn-container">
                                   <a href="#" class="btn-submit">Submit</a>
                               </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</div> 
<!-- Add Payment Dialog Box --->
<div id="ordering-for-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5>Ordering For Detail</h5>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6" style="padding-right: 5px;">
            <div class="form-group row">
              <div class="col-md-12">
                <label for="modal_ord_for_name">Name</label>
                <input type="text" id="modal_ord_for_name" class="form-control">
                <span id="modal_ord_for_name_error" style="color: red;font-size: 12px;"></span>
              </div>
            </div>
          </div>
          <div class="col-md-6" style="padding-left: 5px;">
            <div class="form-group row">
              <div class="col-md-12">
                <label for="modal_ord_for_mobile">Mobile No.</label>
                <input type="text" id="modal_ord_for_mobile" class="form-control" onkeypress="return isNumeric(event)">
                <span id="modal_ord_for_mobile_error" style="color: red;font-size: 12px;"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" onclick="check_order_for_detail()">Save Changes</button>
      </div>
    </div>

  </div>
</div>



