let textList = [];
let AllText = {
    score: new Text({
        text: 'score:0',
        score: 0,
        pos: { x: 1, y: 3 },
        update() {
            this.text = 'score:' + map.score;
        }
    }),
    lives: new Text({
        text: 'lives:3',
        live: 3,
        pos: { x: map.w - 1, y: 3 },
        align: 'right',
        update() {
            this.text = 'lives:' + player.lives;
        }
    }),
    time: new Text({
        text: '00:00:00',
        timeStart: +new Date(),
        timePass: 0,
        pos: { x: map.w / 2, y: 3 },
        align: 'center',
        update() {
            let time = Math.floor((+new Date() - this.timeStart) / 1000);
            if (time == this.timePass) return;
            this.text = `${String(Math.floor(time / 3600)).padStart(2, '0')}:${String(Math.floor(time / 60) % 60).padStart(2, '0')}:${String(time % 60).padStart(2, '0')}`;
        },
        clear() {
            this.text = '00:00:00'
            this.timeStart = +new Date();
        }
    }),
    user: new Text({
        text: 'Bob',
        pos: { x: 1, y: 1 },
    }),
    difficult: new Text({
        align: 'center',
        text: 'Normal',
        pos: { x: map.w / 2, y: 1 },
    }),
    title: new Text({
        align: 'center',
        text: 'PACMAN',
        font: `${5 * scale}px Arial`,
        color: '#c4c449',
        pos: { x: map.w / 2, y: 3 },
    }),
}