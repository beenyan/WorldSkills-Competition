class Map {
  init(data) {
    /* ----
      0：牆壁
      1：道路(食物)
      2：怪物重生地
      3：道路(空)
      4：道路(大力丸)
      5：道路()
      6：道路()
    ---- */
    this.mapData = data.split('\n').map(row => row.split(',').map(col => parseInt(col)));
    this.wallDate = this.mapData.map((row, y) => row.map((col, x) => this.getWalls(x, y)));
    Object.assign(this, {
      h: this.mapData.length,
      w: this.mapData[0].length,
      score: 0
    });
  }
  addScore(number) {
    this.score += number;
    AllText['score'].update();
  }
  getContent(x, y) {
    return this.mapData[y] && this.mapData[y][x];
  }
  eat(x, y) {
    if (this.mapData[y] === undefined || this.mapData[y][x] === undefined || this.mapData[y][x] === 0 || this.mapData[y][x] === 3) return;
    switch (this.mapData[y][x]) {
      case 1: // 食物
        this.addScore(10);
        break;
      case 4: // 大力丸
        this.addScore(30);
        break;
    }
    this.mapData[y][x] = 3;
  }
  summon(num, val, limit) {
    let key = [];
    this.mapData.forEach((row, y) => {
      key = key.concat(row.map((col, x) => {
        if (!limit.some(e => e === col)) return;
        return { x: x, y: y };
      }).filter(e => e !== undefined))
    });
    num = Math.min(num, key.length);
    while (num--) {
      let index = Math.floor(Math.random() * key.length);
      this.mapData[key[index].y][key[index].x] = val;
      this.draw(key[index].x, key[index].y, true);
      key.splice(index, 1);
    }
  }
  isWallDraw(x, y) { // 是否是需要被畫的牆壁
    return this.isWall(x, y) !== '0' ? false : true;
  }
  isWall(x, y) { // 是否是牆壁
    return this.getContent(x, y) === 0 ? '0' : '1';
  }
  getWalls(x, y) {
    // Up、Down、Left、Right
    return this.isWall(x, y - 1) + this.isWall(x, y + 1) + this.isWall(x - 1, y) + this.isWall(x + 1, y);
  }
  draw(x, y, limit) {
    const wallSpan = scale / 4.5;
    const wallLen = scale / 2;
    const food = scale / 8;
    const power = scale / 3;
    const bh = limit === true ? y : (limit === false ? Math.max(y - 1, 0) : 0);
    const eh = limit === true ? y : (limit === false ? Math.min(y + 1, this.h - 1) : this.h - 1);
    const bw = limit === true ? x : (limit === false ? Math.max(x - 1, 0) : 0);
    const ew = limit === true ? x : (limit === false ? Math.min(x + 1, this.w - 1) : this.w - 1);
    ctx.fillStyle = '#242526';
    ctx.save();
    ctx.translate(bw * scale, bh * scale);
    ctx.fillRect(0, 0, (ew - bw + 1) * scale, (eh - bh + 1) * scale);
    ctx.restore();
    ctx.lineWidth = scale / 7;
    ctx.strokeStyle = '#0000FF';
    for (let h = bh; h <= eh; ++h) {
      for (let w = bw; w <= ew; ++w) {
        ctx.save();
        ctx.translate(w * scale + wallLen, h * scale + wallLen);
        switch (this.getContent(w, h)) {
          case 0:
            let wall = this.wallDate[h][w];
            let wallCount = (wall.match(/0/g) || []).length;
            if (wallCount === 0) {
              ctx.beginPath();
              ctx.arc(0, 0, wallSpan, 0, Math.PI * 2);
              ctx.stroke();
            } else if (wallCount === 1) {
              ctx.save();
              let rotate = {
                '1101': 1, '1110': 0,
                '0111': 1.5, '1011': 0.5,
              };
              ctx.rotate(Math.PI * rotate[wall]);
              ctx.beginPath();
              ctx.moveTo(0, -wallSpan);
              ctx.lineTo(wallLen, -wallSpan);
              ctx.stroke();
              ctx.beginPath();
              ctx.moveTo(0, wallSpan);
              ctx.lineTo(wallLen, wallSpan);
              ctx.stroke();
              ctx.beginPath();
              ctx.arc(0, 0, wallSpan, Math.PI * 0.5, Math.PI * -0.5);
              ctx.stroke();

              ctx.restore();
            } else if (wall === '1100' || wall === '0011') { // 畫直線
              ctx.save();
              let rotate = {
                '0011': 0.5, '1100': 0,
                '0010': 0.5, '0001': 0.5
              };
              ctx.rotate(Math.PI * rotate[wall]);

              ctx.beginPath();
              ctx.moveTo(-wallLen, -wallSpan);
              ctx.lineTo(wallLen, -wallSpan);
              ctx.moveTo(-wallLen, wallSpan);
              ctx.lineTo(wallLen, wallSpan);
              ctx.stroke();

              ctx.restore();
            } else if (wallCount === 2) {
              ctx.save();
              let rotate = {
                '1010': 1, '0101': 0,
                '0110': 0.5, '1001': 1.5
              };
              ctx.rotate(Math.PI * rotate[wall]);

              ctx.beginPath();
              ctx.arc(-wallLen, -wallLen, wallLen + wallSpan, 0, Math.PI * 0.5);
              ctx.stroke();
              ctx.beginPath();
              ctx.arc(-wallLen, -wallLen, wallLen - wallSpan, 0, Math.PI * 0.5);
              ctx.stroke();

              ctx.restore();
            } else if (wallCount === 3) {
              ctx.save();
              let rotate = {
                '1000': 1.5, '0010': 1,
                '0100': 0.5, '0001': 0
              };
              ctx.rotate(Math.PI * rotate[wall]);
              ctx.beginPath();
              ctx.moveTo(wallSpan, -wallLen);
              ctx.lineTo(wallSpan, wallLen);
              ctx.stroke();
              ctx.beginPath();
              ctx.arc(-wallLen, -wallLen, wallLen - wallSpan, 0, Math.PI * 0.5);
              ctx.stroke();
              ctx.beginPath();
              ctx.arc(-wallLen, +wallLen, wallLen - wallSpan, Math.PI * -0.5, 0);
              ctx.stroke();

              ctx.restore();
            } else if (wallCount === 4) {
              ctx.save();
              let rotate = {
                '1000': 1.5, '0010': 1,
                '0100': 0.5, '0001': 0
              };
              ctx.rotate(Math.PI * rotate[wall]);
              ctx.beginPath(); // 右上
              ctx.arc(wallLen, -wallLen, wallLen - wallSpan, Math.PI * 0.5, Math.PI * 1);
              ctx.stroke();
              ctx.beginPath(); // 右下
              ctx.arc(wallLen, wallLen, wallLen - wallSpan, Math.PI * 1, Math.PI * -0.5);
              ctx.stroke();
              ctx.beginPath(); // 左上
              ctx.arc(-wallLen, -wallLen, wallLen - wallSpan, 0, Math.PI * 0.5);
              ctx.stroke();
              ctx.beginPath(); // 左下
              ctx.arc(-wallLen, wallLen, wallLen - wallSpan, Math.PI * -0.5, 0);
              ctx.stroke();
              ctx.restore();
            }
            break;
          case 1:
            ctx.fillStyle = '#D0A0A0';
            ctx.fillRect(-food, -food, food * 2, food * 2);
            break;
          case 4:
            ctx.beginPath();
            ctx.fillStyle = '#FFFFFF';
            ctx.arc(0, 0, power, 0, Math.PI * 2);
            ctx.fill();
            break;
        }
        ctx.restore();
      }
    }
    // this.gridLine();
  }
  gridLine() {
    ctx.strokeStyle = '#FFFFFF03';
    ctx.lineWidth = scale / 50;
    for (let h = 0; h < this.h; ++h) {
      for (let w = 0; w < this.w; ++w) {
        ctx.beginPath();
        ctx.moveTo(w * scale, 0);
        ctx.lineTo(scale * w, this.h * scale);
        ctx.stroke();
        ctx.beginPath();
        ctx.moveTo(0, h * scale);
        ctx.lineTo(this.w * scale, h * scale);
        ctx.stroke();
      }
    }
  }
}