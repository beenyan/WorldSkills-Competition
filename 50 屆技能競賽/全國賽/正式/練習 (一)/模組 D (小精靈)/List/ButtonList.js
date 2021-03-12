let buttonList = [];
let Allbutton = {
    lobby: new Button({
        align: 'right',
        text: 'Lobby',
        pos: { x: map.w - 1, y: 1 },
        click() {
            screen.change('lobby');
            Name.hidden = false;
            this.onblue();
        }
    }),
    author: new Button({
        align: 'left',
        text: 'Author:Been_Yan',
        font: `${scale * 1}px Arial 新細明體`,
        color: 'gray',
        holded: {
            color: 'aqua'
        },
        pos: { x: 1, y: map.h - 1 + Math.floor(deviation / scale) },
        click() {
            window.open('https://github.com/beenyan?tab=repositories');
        },
    }),
    easy: new Button({
        align: 'center',
        text: 'EASY',
        font: `${scale * 1.5}px Arial 新細明體`,
        pos: { x: map.w / 4, y: 20 },
        click() {
            AllText.difficult.text = this.text;
            ['normal', 'hard'].forEach(difficult => Allbutton[difficult].color = '#E4E6EB');
            this.color = '#B23A12';
            ghostCount = 2;
        },
    }),
    normal: new Button({
        align: 'center',
        text: 'NORMAL',
        color: '#B23A12',
        font: `${scale * 1.5}px Arial 新細明體`,
        pos: { x: map.w / 2, y: 20 },
        click() {
            AllText.difficult.text = this.text;
            ['easy', 'hard'].forEach(difficult => Allbutton[difficult].color = '#E4E6EB');
            this.color = '#B23A12';
            ghostCount = 5;
        },
    }),
    hard: new Button({
        align: 'center',
        text: 'HARD',
        font: `${scale * 1.5}px Arial 新細明體`,
        pos: { x: map.w / 4 * 3, y: 20 },
        click() {
            AllText.difficult.text = this.text;
            ['easy', 'normal'].forEach(difficult => Allbutton[difficult].color = '#E4E6EB');
            this.color = '#B23A12';
            ghostCount = 8;
        },
    }),
    touorial: new Button({
        align: 'left',
        text: 'TUTORIAL',
        font: `${scale * 1.5}px Arial 新細明體`,
        pos: { x: map.w / 5.5, y: 23 },
        click() {

        },
    }),
    start: new Button({
        align: 'right',
        text: 'START GAME',
        font: `${scale * 1.5}px Arial 新細明體`,
        pos: { x: map.w / 1.21, y: 23 },
        click() {
            Name.value = Name.value.trim();
            if (Name.value === '') {
                print('Please Input Your Name');
                return;
            } else {
                AllText.user.text = Name.value;
                Name.hidden = true;
                init();
                let key = [];
                map.mapData.forEach((row, y) => {
                    key = key.concat(row.map((col, x) => {
                        if (col !== 2) return;
                        return { x: x, y: y };
                    }).filter(e => e !== undefined))
                });
                ghostList = [];
                // ghostCount = 5;
                for (let count = 1; count <= ghostCount; ++count) {
                    ghostList.push(new Ghost({
                        gridPos: JSON.parse(JSON.stringify(key))[Math.floor(key.length * Math.random())],
                        currentDirection: ['right', 'down', 'left', 'up'][Math.floor(4 * Math.random())]
                    }))
                }
                screen.change('play');
                this.onblue();
            }
        }
    }),
}