class Text {
    constructor(args) {
        let def = {
            text: '',
            pos: { x: 0, y: 0 },
            color: '#E4E6EB',
            font: `${scale * 1.2}px Arial 新細明體`,
            align: 'left',
            baseLine: 'top',
        }
        Object.assign(def, args);
        Object.assign(this, def);
    }
    draw() {
        ctx.save();
        ctx.translate(0, -deviation);
        ctx.textBaseline = this.baseLine;
        ctx.textAlign = this.align;
        ctx.fillStyle = this.color;
        ctx.font = this.font;
        ctx.fillText(this.text, this.pos.x * scale, this.pos.y * scale);
        ctx.restore();
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
    update() { }
}