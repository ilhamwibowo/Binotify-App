function play_audio(id) {
    var audio = document.getElementById(id);
    var src = "audio1";
    var pause = document.getElementById(src);
    var i = 1;
    while(pause != null){
        pause.pause();
        console.log("pause " + src);
        i += 1;
        src = "audio" + i;
        pause = document.getElementById(src);
    }
    audio.play();
    console.log("play " + id)
}

function pause_audio(id) {
    var audio = document.getElementById(id);
    audio.pause();
    console.log("pause " + id)
}