class Player {
    constructor(args) {
        let def = {
            gridPos: { x: 14, y: 22 },
            pos: { x: 0, y: 0 },
            isMoving: false,
            currentDirection: 'right',
            nextDirection: null,
            speed: scale / FPS * 4,
            mouthDeg: 0,
            mouthDegsign: 1,
            mouthSpeed: 90 / FPS * 4,
            lives: 3
        }
        Object.assign(def, args);
        Object.assign(this, def);
    }
    init() {
        Object.assign(this, {
            gridPos: { x: 14, y: 22 },
            pos: { x: 0, y: 0 },
            isMoving: false,
            currentDirection: 'right',
            nextDirection: null,
            mouthDeg: 0,
            mouthDegsign: 1,
            lives: 3
        });
    }
    heart(number) {
        this.lives += number;
        if (this.lives <= 0) { // 遊戲結束
            init();
        } else if (number < 0) {
            let gridPos = this.gridPos;
            Object.assign(this, {
                gridPos: { x: 14, y: 22 },
                pos: { x: 0, y: 0 },
                isMoving: false,
                currentDirection: 'right',
                nextDirection: null,
                mouthDeg: 0,
                mouthDegsign: 1,
            });
            map.draw(gridPos.x, gridPos.y, false);
        }
        AllText['lives'].update();
    }
    draw() {
        map.eat(this.gridPos.x, this.gridPos.y);
        map.draw(this.gridPos.x, this.gridPos.y, false);

        ctx.fillStyle = 'yellow';
        ctx.save()
        ctx.translate(this.gridPos.x * scale + this.pos.x + scale / 2, this.gridPos.y * scale + this.pos.y + scale / 2);
        let rotate = {
            'right': 0.25, 'left': 1.25,
            'up': 1.75, 'down': 0.75
        };
        ctx.rotate(Math.PI * rotate[this.currentDirection]);
        ctx.beginPath();
        ctx.moveTo(0, 0);
        ctx.arc(0, 0, scale / 2, Math.PI * 0 - this.mouthDeg / 100, Math.PI * 1.5 + this.mouthDeg / 100);
        ctx.fill();
        ctx.restore();
    }
    move() {
        this.mouthDeg += this.mouthSpeed * this.mouthDegsign;
        const currentMoveGrid = {
            x: this.gridPos.x + Pos[this.currentDirection].x,
            y: this.gridPos.y + Pos[this.currentDirection].y
        };
        if (this.mouthDeg >= 90 || this.mouthDeg <= 0) this.mouthDegsign *= -1; // 嘴巴開合
        if (this.nextDirection && this.currentDirection !== this.nextDirection) {
            const nextGrid = {
                x: this.gridPos.x + Pos[this.nextDirection].x,
                y: this.gridPos.y + Pos[this.nextDirection].y
            };
            if (['up', 'down'].includes(this.nextDirection) && Math.abs(this.pos.x) < this.speed && map.isWall(nextGrid.x, nextGrid.y) !== '0') {
                this.currentDirection = this.nextDirection;
                this.nextDirection = null;
                this.pos.x = 0;
            } else if (['left', 'right'].includes(this.nextDirection) && Math.abs(this.pos.y) < this.speed && map.isWall(nextGrid.x, nextGrid.y) !== '0') {
                this.currentDirection = this.nextDirection;
                this.nextDirection = null;
                this.pos.y = 0;
            }
        }
        if (this.isMoving === false) return;

        this.pos.x += this.speed * Pos[this.currentDirection].x;
        this.pos.y += this.speed * Pos[this.currentDirection].y;
        this.gridPos.x += Math.floor(Math.abs(this.pos.x) / scale) * Math.sign(this.pos.x);
        this.gridPos.y += Math.floor(Math.abs(this.pos.y) / scale) * Math.sign(this.pos.y);
        this.pos.x %= scale;
        this.pos.y %= scale;
        if (this.gridPos.x === 27 && this.gridPos.y === 13 && this.currentDirection === 'right') { // 瞬間移動
            map.eat(27, 13);
            this.gridPos = { x: 0, y: 13 };
            map.draw(27, 13, false);
        } else if (this.gridPos.x === 0 && this.gridPos.y === 13 && this.currentDirection === 'left') { // 瞬間移動
            map.eat(0, 13);
            this.gridPos = { x: 27, y: 13 };
            map.draw(0, 13, false);
        } else if (map.isWall(currentMoveGrid.x, currentMoveGrid.y) === '0') { // 碰到牆
            this.pos = { x: 0, y: 0 };
        }
    }

}