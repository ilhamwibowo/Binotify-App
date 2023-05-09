<?php
function list_song($src_song, $img_path, $title, $singer, $genre, $year) {
    $html =  <<< EOT
    <a href="{$src_song}">
        <div class = "container-flex-list">
            <div class="flex-list-item-1">
                <div class="grid-list-item-1">
                    <img src="{$img_path}">
                </div>
                <div class="grid-list-item-2">
                    <p>{$title}</p>
                </div>
                <div class="grid-list-item-3">
                    <p>{$singer}</p>
                </div>
            </div>
            <div class="flex-list-item-2">{$genre}</div>
            <div class="flex-list-item-3">{$year}</div>
        </div>
    </a>
    EOT;
    return $html;
}

function list_user($user_id, $username, $email) {
    $html =  <<< EOT
    <div class = "container-flex-list">
        <div class="flex-list-item-1">
            {$user_id}
        </div>
        <div class="flex-list-item-2">{$username}</div>
        <div class="flex-list-item-3">{$email}</div>
    </div>
    EOT;
    return $html;
}

function list_premium_song($id, $src_song, $title, $singer) {
    $html =  <<< EOT
    <div class = "container-flex-list">
        <audio id="audio{$id}">
            <source src="{$src_song}" type="audio/mpeg">
        </audio>
        <div class="flex-list-item-1">
            <div class="grid-list-item-1">
                <button onclick="play_audio('audio{$id}')" class="play" type="button">Play</button>
                <button onclick="pause_audio('audio{$id}')" class="pause" type="button"">Pause</button>
            </div>
            <div class="grid-list-item-2">
                <p>{$title}</p>
            </div>
            <div class="grid-list-item-3">
                <p>{$singer}</p>
            </div>
        </div>
    </div>
    EOT;
    return $html;
}

function list_artist($penyanyi, $id) {
    $html =  <<< EOT
    <div class='artist-box'>
      <form class='grid' method="POST">
        <p class='singer'>{$penyanyi}</p>
        <button class='btn subs' name='subscribe' value="{$id}" >Subscribe</button>
      </form>
    </div>
    EOT;
    return $html;
}

function list_artist_subscribed($penyanyi, $id) {
    $html =  <<< EOT
    <div class='artist-box'>
      <form class='grid' action="/premium_song.php?id={$id}">
        <p class='singer'>{$penyanyi}</p>
        <input name="id" value="{$id}" style="display: none">
        <button type="submit" class='btn open'>Open</button>
      </form>
    </div>
    EOT;
    return $html;
}


?>