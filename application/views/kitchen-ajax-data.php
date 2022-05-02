<?php if(count($kitchendata) > 0){ ?>
    <?php foreach($kitchendata as $row){?>
        <div class="<?php if(isset($grid)){ echo 'col-lx-4 col-lg-6 col-md-6'; }else{ echo 'col-lg-4 col-md-6'; } ?>">
            <div class="listOfFoodSection">
                <div class="foodSectionImg">
                    <?php 
                        if($row['profile_image']!='' && file_exists(USER_PROFILE_PATH.$row['profile_image'])){
                            $img_src = USER_PROFILE.$row['profile_image'];  
                        }else{
                            $img_src = NOIMAGE;
                        }
                    ?>
                    <a href="<?= FRONT_URL?>kitchen-detail/<?=$row['kitchenid']?>"><img src="<?=$img_src?>" alt="" class="foodseleteddish img-fluid"></a>
                    <div class="foodrating">
                        <p><span><?=round($row['averagerating'],1);?></span> <i class="fa fa-star"></i>(<?=$row['countreview'];?>)</p>
                    </div>
                    <?php if(!empty($this->session->userdata(base_url().'FOODIESUSERID'))) { ?>
                        <?php if($row['is_favourite']==1){ ?>
                            <a href="javascript:void(0)" id="favorite_kitchen_<?=$row['id']?>" onclick="remove_favorite_kitchen(<?=$row['id']?>)" class="bookmarks" title="remove to Favourite">
                                <img src="<?=FRONT_URL?>assets/images/bookmarks.svg" alt="" class="img-fluid">
                            </a>
                        <?php }else{ ?>
                            <a href="javascript:void(0)" id="favorite_kitchen_<?=$row['id']?>" onclick="add_favorite_kitchen(<?=$row['id']?>)" class="bookmarks" title="Add to Favourite">
                                <i class="fa fa-bookmark-o" style="padding-top: 5px;color: #FCC647;"></i>
                            </a>
                        <?php } ?>
                    <?php }else{ ?>
                        <a href="<?= FRONT_URL?>login" class="bookmarks">
                            <i class="fa fa-bookmark-o" style="padding-top: 5px;color: #FCC647;"></i>
                        </a>
                    <?php } ?>
                        <!-- <img src="<?=FRONT_URL?>'assets/images/bookmarks.svg" alt="" class="img-fluid"> -->
                    
                    <?php
                        if($row['discount'] > 0){
                            echo '<span class="discountSpan">'.$row['discount'].'% off</span>';
                        }                    
                    ?>
                </div>
                <h3><a href="<?= FRONT_URL?>kitchen-detail/<?=$row['kitchenid']?>" title="<?=$row['kitchenname']?>"><?=$row['kitchenname']?></a></h3>
                <div class="foodFooterSectio">
                    <p><?php $meals = explode(",",$row['foodtype']);
                        if(count($meals) >= 3){
                            echo "All Cuisine";
                        }else {
                            if(in_array("South Indian Meals", $meals)){
                                echo 'South Indian'.(in_array("North Indian Meals", $meals) || in_array("Diet Meals", $meals)?", ":"");
                            }
                            if(in_array("North Indian Meals", $meals)){
                                echo 'North Indian'.(in_array("Diet Meals", $meals)?", ":"");
                            }
                            if(in_array("Diet Meals", $meals)){
                                echo 'Diet Meals';
                            }
                        }
                    ?></p>
                    <span><svg id="Capa_1" enable-background="new 0 0 511.994 511.994" viewBox="0 0 511.994 511.994" xmlns="http://www.w3.org/2000/svg"><g><path d="m468.379 112.96c-3.092-4.579-9.307-5.784-13.884-2.693-4.577 3.09-5.782 9.306-2.692 13.883 63.008 93.331 50.848 218.961-28.913 298.722-44.573 44.574-103.838 69.121-166.877 69.121s-122.303-24.546-166.878-69.12c-44.574-44.574-69.121-103.838-69.121-166.877s24.548-122.304 69.121-166.877c81.202-81.202 208.265-92.375 302.127-26.567 4.521 3.171 10.758 2.075 13.929-2.447 3.17-4.522 2.074-10.758-2.448-13.929-48.674-34.126-108.292-50.22-167.867-45.31-60.276 4.965-117.057 31.284-159.883 74.11-48.351 48.352-74.979 112.639-74.979 181.02s26.628 132.668 74.979 181.02c48.352 48.351 112.639 74.979 181.019 74.979s132.668-26.628 181.019-74.979c86.519-86.52 99.703-222.805 31.348-324.056z"/><path d="m256.013 47.496c-114.967 0-208.5 93.533-208.5 208.5s93.533 208.5 208.5 208.5 208.5-93.533 208.5-208.5-93.533-208.5-208.5-208.5zm0 397c-103.939 0-188.5-84.56-188.5-188.5s84.561-188.5 188.5-188.5 188.5 84.56 188.5 188.5-84.561 188.5-188.5 188.5z"/><path d="m319.653 305.493-32.857-32.856c2.688-4.952 4.216-10.621 4.216-16.641 0-15.824-10.56-29.223-25-33.537v-72.463c0-5.523-4.477-10-10-10s-10 4.477-10 10v72.463c-14.44 4.314-25 17.712-25 33.537 0 19.299 15.701 35 35 35 6.02 0 11.689-1.528 16.641-4.216l32.857 32.856c1.953 1.953 4.512 2.929 7.071 2.929 2.56 0 5.118-.977 7.071-2.929 3.906-3.907 3.906-10.238.001-14.143zm-78.64-49.497c0-8.271 6.729-15 15-15s15 6.729 15 15-6.728 15-15 15c-8.271 0-15-6.729-15-15z"/><path d="m256.013 118.133c5.523 0 10-4.477 10-10v-10.127c0-5.523-4.477-10-10-10s-10 4.477-10 10v10.127c0 5.523 4.477 10 10 10z"/><path d="m185.678 114.172c-2.762-4.784-8.879-6.422-13.66-3.66-4.783 2.762-6.422 8.877-3.66 13.66l5.064 8.771c1.852 3.208 5.213 5.001 8.669 5.001 1.696 0 3.417-.432 4.991-1.341 4.783-2.762 6.422-8.877 3.66-13.66z"/><path d="m132.96 173.404-8.771-5.064c-4.782-2.761-10.899-1.123-13.66 3.66-2.762 4.783-1.123 10.898 3.66 13.66l8.771 5.064c1.575.909 3.294 1.341 4.991 1.341 3.455 0 6.817-1.793 8.669-5.002 2.762-4.781 1.123-10.897-3.66-13.659z"/><path d="m118.151 255.996c0-5.523-4.477-10-10-10h-10.128c-5.523 0-10 4.477-10 10s4.477 10 10 10h10.128c5.522 0 10-4.478 10-10z"/><path d="m122.96 321.267-8.771 5.064c-4.783 2.761-6.422 8.877-3.66 13.66 1.852 3.208 5.213 5.001 8.669 5.001 1.696 0 3.416-.432 4.991-1.341l8.771-5.064c4.783-2.761 6.422-8.877 3.66-13.66-2.761-4.784-8.878-6.423-13.66-3.66z"/><path d="m187.082 375.388c-4.781-2.761-10.898-1.123-13.66 3.66l-5.064 8.771c-2.762 4.783-1.122 10.899 3.66 13.66 1.575.909 3.294 1.341 4.991 1.341 3.456 0 6.817-1.793 8.669-5.001l5.064-8.771c2.762-4.783 1.122-10.899-3.66-13.66z"/><path d="m256.013 393.858c-5.523 0-10 4.477-10 10v10.127c0 5.523 4.477 10 10 10s10-4.477 10-10v-10.127c-.001-5.523-4.477-10-10-10z"/><path d="m338.604 379.048c-2.76-4.782-8.873-6.421-13.66-3.661-4.782 2.761-6.422 8.877-3.66 13.66l5.063 8.771c1.852 3.208 5.213 5.002 8.67 5.002 1.696 0 3.415-.432 4.99-1.341 4.782-2.761 6.422-8.878 3.66-13.66z"/><path d="m397.836 326.33-8.771-5.064c-4.785-2.763-10.899-1.123-13.66 3.66-2.762 4.783-1.123 10.899 3.66 13.66l8.771 5.064c1.575.91 3.294 1.341 4.99 1.341 3.456 0 6.818-1.793 8.67-5.001 2.761-4.783 1.123-10.899-3.66-13.66z"/><path d="m393.875 255.996c0 5.523 4.478 10 10 10h10.128c5.522 0 10-4.477 10-10s-4.478-10-10-10h-10.128c-5.523 0-10 4.477-10 10z"/><path d="m379.065 173.404c-4.783 2.762-6.422 8.877-3.66 13.66 1.853 3.209 5.213 5.002 8.67 5.002 1.696 0 3.416-.432 4.99-1.341l8.771-5.064c4.783-2.762 6.422-8.877 3.66-13.66s-8.876-6.421-13.66-3.66z"/><path d="m340.007 110.512c-4.784-2.763-10.899-1.123-13.66 3.66l-5.063 8.771c-2.762 4.783-1.123 10.899 3.66 13.66 1.575.91 3.294 1.341 4.99 1.341 3.456 0 6.818-1.793 8.67-5.001l5.064-8.771c2.761-4.783 1.123-10.899-3.661-13.66z"/><circle cx="431.067" cy="83.944" r="9.992"/></g></svg> 
                    <?php echo $row['duration']; /* if($cust_location!="" && $row['address']!=""){
                        $kitchen_address = $row['address'].", ".$row['cityname'].", ".$row['provincename'];
                        echo get_duration_between_two_places($cust_location, $kitchen_address);
                    }else{
                        echo 'Address not found';
                    } */?>
                    </span>
                </div>
            </div>
        </div>
    <?php } ?>
<?php }else{ ?>
    <div class="col-lg-12 col-md-12">
        <div class="listOfFoodSection" style="border-radius: 8px !important;font-size: 15px;padding: 20px;">
            <?php echo "No item available." ?>
        </div>
    </div>
<?php } ?>