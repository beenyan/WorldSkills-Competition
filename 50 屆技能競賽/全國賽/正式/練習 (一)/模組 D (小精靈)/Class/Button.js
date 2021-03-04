class Button {
    constructor(args) {
        let def = {
            text: '',
            pos: { x: 0, y: 0 },
            color: '#E4E6EB',
            font: `${scale * 1.2}px Arial 新細明體`,
            align: 'left',
            baseLine: 'top',
            touchBox: { x: 0, y: 0, w: 0, h: 100 },
            isHolding: false,
            holded: {
                color: 'aqua'
            }
        }
        Object.assign(def, args);
        Object.assign(this, def);
    }
    draw() {
        ctx.save();
        ctx.translate(0, -deviation);
        ctx.textBaseline = this.baseLine;
        ctx.textAlign = this.align;
        ctx.fillStyle = this.isHolding && this.holded.color ? this.holded.color : this.color;
        ctx.font = this.font;
        ctx.fillText(this.text, this.pos.x * scale, this.pos.y * scale);
        // 設定碰撞箱
        this.touchBox.y = this.pos.y * scale;
        this.touchBox.h = parseFloat(this.font);
        this.touchBox.w = ctx.measureText(this.text).width;
        this.touchBox.x = this.pos.x * scale;
        if (this.align === 'center') {
            this.touchBox.x -= this.touchBox.w / 2;
        } else if (this.align === 'right') {
            this.touchBox.x -= this.touchBox.w;
        }
        this.view();

        ctx.restore();
    }
    view() {
        ctx.strokeStyle = 'red';
        ctx.strokeRect(this.touchBox.x, this.touchBox.y, this.touchBox.w, this.touchBox.h);
        // console.log(this.touchBox);
    }
    mousemove(x, y) {
        if (x >= this.touchBox.x && x <= this.touchBox.x + this.touchBox.w && y >= this.touchBox.y && y <= this.touchBox.y + this.touchBox.h) {
            if (this.isHolding) return;
            this.isHolding = true;
            canvas.style.cursor = 'pointer';
        } else if (this.isHolding) { // 失焦
            this.isHolding = false;
            canvas.style.cursor = 'unset';
        }
    }
    multiText() {
        ctx.save();
        ctx.translate(0, -deviation);
        ctx.textBaseline = this.baseLine;
        ctx.textAlign = this.align;
        ctx.fillStyle = this.color;
        ctx.font = this.font;
        let Hdeviation = 0;
        this.text.split('\n').forEach(text => {
            ctx.fillText(text, this.pos.x * scale, this.pos.y * scale + Hdeviation);
            console.log(this.font);
            Hdeviation += scale * 1.2;
        })
        ctx.restore();
    }
}