<?php
    function initRatingStars($rating_score){
        $i = 1;
        for(; $i <= floor($rating_score); $i++){
            echo '<div class="rating-score__star is-active"></div>';
        }

        if($rating_score > floor($rating_score)){
            echo '<div class="rating-score__star is-half"></div>';
            $i++;
        }

        for(; $i <= 5; $i++){
            echo '<div class="rating-score__star is-neutral"></div>';
        }
    }
?>