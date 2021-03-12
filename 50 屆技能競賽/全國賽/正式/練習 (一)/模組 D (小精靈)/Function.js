function init() {
    $.ajax('map.txt', { async: false }).done(data => map.init(data)); // create new map
    player.init();
    AllText['time'].clear();
    map.draw();
    map.summon(5, 4, [1]);
}
function draw() {
    ScreenList[screen.val]();
    textList.forEach(name => AllText[name].draw());
    buttonList.forEach(name => Allbutton[name].draw());
    // map.gridLine();
    requestAnimationFrame(draw);
}

function update() {
    AllText['time'].update();
    ghostList.forEach(ghost => ghost.move());
    player.move();
}

function print(text = '') {
    let div = $(`<div class='print'>${text}</div>`);
    $('#box').append(div);
    div.delay(1200).fadeOut(1000);
    setTimeout(() => { div.remove() }, 2200);
}

function rand(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
}
