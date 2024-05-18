<?php
    function initRatingStars($rating_score){
        $result = '';
        $i = 1;
        for(; $i <= floor($rating_score); $i++){
            $result .= '<div class="rating-score__star is-active"></div>';
        }

        if($rating_score > floor($rating_score)){
            $result .= '<div class="rating-score__star is-half"></div>';
            $i++;
        }

        for(; $i <= 5; $i++){
            $result .= '<div class="rating-score__star is-neutral"></div>';
        }

        return $result;
    }
?>