'use strict';

/** @type {HTMLCanvasElement} */
const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');

let map = new Map();
$.ajax('map.txt', { async: false }).done(data => map.init(data));

const scale = Math.round(Math.min(window.innerHeight, window.innerWidth) * 0.8 / Math.max(map.h, map.w));
const deviation = map.h * scale * 0.15;
const wh = canvas.height = map.h * scale + deviation;
const ww = canvas.width = map.w * scale;
const FPS = 60;
const Pos = {
    'right': { x: 1, y: 0 },
    'left': { x: -1, y: 0 },
    'up': { x: 0, y: -1 },
    'down': { x: 0, y: 1 },
    null: { x: 0, y: 0 }
}
ctx.translate(0, map.h * scale * 0.15);
let player = new Player();
window.onload = () => {
    init();
    setInterval(update, 1000 / FPS);
    requestAnimationFrame(draw);
}