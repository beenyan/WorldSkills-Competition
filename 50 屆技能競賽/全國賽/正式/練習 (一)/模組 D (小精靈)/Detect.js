canvas.addEventListener('mousemove', mouse => {
    buttonList.forEach(name => Allbutton[name].mousemove(mouse.offsetX, mouse.offsetY));
});

canvas.addEventListener('click', mouse => {
    buttonList.filter(name => Allbutton[name].touch(mouse.offsetX, mouse.offsetY)).forEach(name => Allbutton[name].click());
});

window.addEventListener('keydown', key => {
    if (key.repeat) return;
    player.changeDirection(key.code);
})

window.onload = () => {
    setInterval(update, 1000 / FPS);
    requestAnimationFrame(draw);
}
