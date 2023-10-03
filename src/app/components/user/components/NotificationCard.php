<?php

function notification_card($image, $isiNotifikasi, $userIdReceiver, $notificationId){
    $html = <<<"EOT"
        <div class="notification-card">
            <div>
                <img src="<?= BASE_URL ?>/images/profile/$image" alt="profile" class="profile-img"/>
            </div>
            <div class="flex-col">
                <span>$isiNotifikasi</span>
                <span>Owner: $userIdReceiver</span>
            </div>
            <div class="button-container">
                <button class="like-button" data-notification-id="$notificationId"><strong>Edit</strong></button>
                <button class="ignore-button" data-notification-id="$notificationId"><strong>Delete</strong></button>
            </div>
        </div>
    EOT;

    echo $html;
}