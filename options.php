<?php
/*
   Plugin Name: Side Sticky ADs for WordPress
   Plugin URI: https://github.com/samirdev3/side-sticky-ads-wp
   description: With the help of this plugin you can place sticky Ads on both side of the website (box layout). You can change the conatiner size under options.php (the default container size is set to 1200px)
   Version: 1.0.2
   Author: Samir
   Author URI: https://github.com/samirdev3
   License: GPL2+
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

if(!function_exists('awt_sticky_ad_code')){
    add_action('wp_footer', 'awt_sticky_ad_code', 1000);
    function awt_sticky_ad_code(){
        if(!wp_is_mobile()){
        ?>
            <style>.awt_side_sticky{position:fixed;top:5px;width:160px;height:600px;opacity:0;visibility:hidden;z-index:99998}.awt_side_sticky .revenue{display:block;width:160px;height:600px;background:#eee}</style>
            <div id="awt-left" class="awt_side_sticky">
                <div class="revenue">
                    <!-- LHS ad code here -->
                </div>
            </div>
            <div id="awt-right" class="awt_side_sticky">
                <div class="revenue">
                    <!-- RHS ad code here -->
                </div>
            </div>
            <script>
                const containerClass = '.tdc-content-wrap', //YOUR-CLASS-NAME
                    containerDiv = document.querySelector(containerClass);
                let containerW;
                if(containerDiv){
                    containerW = containerDiv.clientWidth;
                }else{
                    containerW = 1200;
                }
                window.onresize = awtAdCodeFunction;
                window.onload = awtAdCodeFunction;
                function awtAdCodeFunction(){
                    let     offSet = (document.body.offsetWidth/2) - ((containerW/2) + 165),
                            mSign = Math.sign(offSet);
                    document.getElementById('awt-left').style.left = `${offSet}px`;
                    document.getElementById('awt-right').style.right = `${offSet}px`;
                    awtDisplayAd(mSign);
                }

                function awtDisplayAd(mSign){
                    const adClass = document.querySelectorAll('.awt_side_sticky');
                    if(mSign === 1 && (window.innerHeight) >= 610){
                        for(let $i=0;$i<adClass.length;$i++){
                            adClass[$i].style.opacity = 1;
                            adClass[$i].style.visibility = 'visible';
                        }
                    }else{
                        for(let $i=0;$i<adClass.length;$i++){
                            adClass[$i].style.opacity = 0;
                            adClass[$i].style.visibility = 'hidden';
                        }
                    }
                }
            </script>
        <?php
        }
    }
}

?>