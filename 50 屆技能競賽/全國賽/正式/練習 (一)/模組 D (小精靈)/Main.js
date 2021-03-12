'use strict';

/** @type {HTMLCanvasElement} */
const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');
const Name = document.getElementById('Name');

let map = new Map();
$.ajax('map.txt', { async: false }).done(data => map.init(data));

const scale = Math.round(Math.min(window.innerHeight, window.innerWidth) * 0.8 / Math.max(map.h, map.w));
const span = scale / 2;
const deviation = map.h * scale * 0.15;
const wh = canvas.height = map.h * scale + deviation;
const ww = canvas.width = map.w * scale;
const FPS = 60;
const Pos = {
    right: { x: 1, y: 0 },
    left: { x: -1, y: 0 },
    up: { x: 0, y: -1 },
    down: { x: 0, y: 1 },
    null: { x: 0, y: 0 }
};
ctx.translate(0, map.h * scale * 0.15); // 偏移

let screen = {
    val: 'lobby',
    change(str) {
        this.val = str;
        ScreenList[this.val]();
    }
}
let ghostCount = 5;
let ghostList = [];
let player = new Player();