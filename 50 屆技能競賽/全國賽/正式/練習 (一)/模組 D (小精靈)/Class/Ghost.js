class Ghost {
    constructor(args) {
        let def = {
            gridPos: { x: 11, y: 13 },
            moveGrid: { x: 0, y: 0 },
            pos: { x: 0, y: 0 },
            tran: {
                'right': { x: span / 8, y: 0 }, 'left': { x: -span / 8, y: 0 },
                'up': { x: 0, y: -span / 8 }, 'down': { x: 0, y: span / 8 }
            },
            tail: rand(0, 1),
            currentDirection: 'right',
            color: 'red',
            isMoveing: true,
            speed: 1
        }
        Object.assign(def, args);
        Object.assign(this, def);
        setInterval(() => { this.tail ^= 1 }, 100);
    }
    draw() {
        ctx.save();
        ctx.translate(this.gridPos.x * scale + this.pos.x + span, this.gridPos.y * scale + this.pos.y + span);
        // 身體
        ctx.fillStyle = this.color;
        ctx.beginPath();
        ctx.arc(0, 0, scale / 2, Math.PI, 0);
        ctx.fill();
        ctx.beginPath();
        ctx.moveTo(-span, 0);
        ctx.lineTo(-span, span);
        for (let i = 0; i <= 7; ++i) {
            ctx.lineTo(-span + scale / 7 * i, span + scale / 8 - ((i + this.tail) % 2 ? span / 2 : 0));
        }
        ctx.lineTo(span, 0);
        ctx.fill();
        // 眼睛
        ctx.fillStyle = 'white';
        ctx.beginPath();
        ctx.arc(-span / 2, -span / 4, scale / 5, 0, Math.PI * 2);
        ctx.arc(span / 2, -span / 4, scale / 5, 0, Math.PI * 2);
        ctx.fill();
        // 眼球
        ctx.fillStyle = 'black';
        ctx.beginPath();
        ctx.translate(this.tran[this.currentDirection].x, this.tran[this.currentDirection].y);
        ctx.arc(-span / 2, -span / 4, scale / 9, 0, Math.PI * 2);
        ctx.arc(span / 2, -span / 4, scale / 9, 0, Math.PI * 2);
        ctx.fill();
        ctx.restore();
    }
    move() {
        if (!this.isMoveing) return;
        this.pos.x += this.speed * scale / FPS * 4 * Pos[this.currentDirection].x;
        this.pos.y += this.speed * scale / FPS * 4 * Pos[this.currentDirection].y;
        this.gridPos.x += Math.floor(Math.abs(this.pos.x) / scale) * Math.sign(this.pos.x);
        this.gridPos.y += Math.floor(Math.abs(this.pos.y) / scale) * Math.sign(this.pos.y);
        this.pos.x %= scale;
        this.pos.y %= scale;
        if (this.gridPos.x === 26 && this.gridPos.y === 13 && this.currentDirection === 'right') { // 瞬間移動
            this.gridPos = { x: 0, y: 13 };
            map.draw(26, 13, false);
        } else if (this.gridPos.x === 0 && this.gridPos.y === 13 && this.currentDirection === 'left') { // 瞬間移動
            this.gridPos = { x: 26, y: 13 };
            map.draw(0, 13, false);
        }
        this.getDirection();
    }
    fixed() {
        switch (this.currentDirection) {
            case 'right':
            case 'left':
                this.pos.y = 0;
                break;
            case 'up':
            case 'down':
                this.pos.x = 0;
                break;
        }
    }
    alivePath(x, y, dir) {
        if (this.moveGrid.x === this.gridPos.x && this.moveGrid.y === this.gridPos.y) return false;
        return map.isWall(x, y) !== '0';
    }
    getDirection() {
        const move = {
            x: this.speed * scale / FPS * 4 * Pos[this.currentDirection].x,
            y: this.speed * scale / FPS * 4 * Pos[this.currentDirection].y,
        }
        if (this.pos.x > move.x || this.pos.y > move.y) return;
        const currentMoveGrid = {
            x: this.gridPos.x + Pos[this.currentDirection].x,
            y: this.gridPos.y + Pos[this.currentDirection].y
        };
        const path = ['right', 'down', 'left', 'up'].filter(e => this.alivePath(Pos[e].x + this.gridPos.x, Pos[e].y + this.gridPos.y, e));
        // console.log(path);
        if (path.length === 0) return;
        if (map.isWall(currentMoveGrid.x, currentMoveGrid.y) === '0') { // 碰到牆
            this.moveGrid = { x: this.gridPos.x, y: this.gridPos.y };
            this.pos = { x: 0, y: 0 };
            this.currentDirection = path[Math.floor(path.length * Math.random())];
        } else if (path.length >= 3 && !rand(0, map.getContent(this.gridPos.x, this.gridPos.y) === 2 ? 3 : (path.length.length === 3 ? 6 : 3))) {
            this.moveGrid = { x: this.gridPos.x, y: this.gridPos.y };
            this.currentDirection = path[Math.floor(path.length * Math.random())];
            this.fixed();
        }
    }
}