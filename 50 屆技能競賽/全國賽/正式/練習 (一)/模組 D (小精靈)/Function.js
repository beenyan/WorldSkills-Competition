function init() {
    textList = [AllText['score'], AllText['lives'], AllText['user'], AllText['difficult'], AllText['time']];
    buttonList = [Allbutton['lobby']];
    $.ajax('map.txt', { async: false }).done(data => map.init(data)); // create new map
    player.init();
    AllText['time'].clear();
    map.draw();
    map.summon(5, 4, [1]);
}

function draw() {
    ctx.clearRect(0, -deviation, ww, deviation);
    player.draw();
    textList.forEach(e => e.draw());
    buttonList.forEach(e => e.draw());
    requestAnimationFrame(draw);
}

function update() {
    AllText['time'].update();
    player.move();
}

function rand(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
}

canvas.addEventListener('mousemove', mouse => {
    buttonList.forEach(e => e.mousemove(mouse.offsetX, mouse.offsetY));
});

window.addEventListener('keydown', key => {
    if (key.repeat) return;
    switch (key.code) {
        case 'ArrowLeft':
        case 'KeyA':
            player.nextDirection = 'left';
            player.isMoving = true;
            break;
        case 'ArrowRight':
        case 'KeyD':
            player.nextDirection = 'right';
            player.isMoving = true;
            break;
        case 'ArrowUp':
        case 'KeyW':
            player.nextDirection = 'up';
            player.isMoving = true;
            break;
        case 'ArrowDown':
        case 'KeyS':
            player.nextDirection = 'down';
            player.isMoving = true;
            break;
    }
})