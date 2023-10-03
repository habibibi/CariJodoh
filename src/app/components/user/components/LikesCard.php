<?php

function likes_card($image, $dateId, $user_id_1, $user_id_2){
    $html = <<<"EOT"
        <div class="likes-card">
            <div>
                <img src="<?= BASE_URL ?>/images/profile/$image" alt="profile"/>
            </div>
            <div>
                <span>$user_id_1</span>
                <span>Menyukai $user_id_2</span>
            </div>
            <div class="button-container">
                <button class="like-button" data-date-id="$dateId"><strong>Edit</strong></button>
                <button class="ignore-button" data-date-id="$dateId"><strong>Delete</strong></button>
            </div>
        </div>
    EOT;

    echo $html;
}