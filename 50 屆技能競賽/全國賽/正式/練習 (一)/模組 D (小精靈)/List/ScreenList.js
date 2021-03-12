let ScreenList = {
    lobby() {
        ctx.fillStyle = '#242526';
        ctx.fillRect(0, -deviation, ww, wh);
        buttonList = ['author', 'easy', 'normal', 'hard', 'touorial', 'start'];
        textList = ['title'];
    },
    play() {
        ctx.clearRect(0, -deviation, ww, deviation);
        map.detect();
        ghostList.forEach(ghost => ghost.draw());
        player.draw();
        buttonList = ['lobby'];
        textList = ['user', 'score', 'lives', 'time', 'difficult'];
    }
}