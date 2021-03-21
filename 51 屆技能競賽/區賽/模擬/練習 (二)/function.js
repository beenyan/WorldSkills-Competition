function join(obj, filter = [], a = ',', b = '=\'') {
    return Object.entries(obj).filter(e => !filter.includes(e[0])).map(e => `${e.join(b)}'`).join(a);
}
function exit(string) {
    alert(string);
    throw string;
}
function href(url) {
    location.href = url;
}
function HTO(sql) {
    let ret = {};
    $(sql).each(function () {
        const val = $(this).val().trim();
        const to = $(this).attr('to');
        const type = $(this).attr('type');
        const name = $(this).attr('name');
        const required = $(this).attr('required') ? 1 : 0;
        const checked = $(this).prop('checked') ? 1 : 0;
        const set = $(this).attr('set');
        if (required && val === '') exit('資料輸入不完整。');
        else if (val === '' || type === 'radio' && !checked) return;
        else if (type === 'checkbox') ret[name] = checked;
        else if (type === 'radio') {
            ret[set] = val;
        }
        else ret[name] = val;
    })
    return ret;
}
function HTA(sql) {
    let ret = [];
    $(sql).each(function () {
        const val = $(this).val().trim();
        if (val === '') return;
        ret.push(val);
    })
    return ret;
}
function DB(url, data, async = false) {
    let ret;
    if (typeof (data) === 'string')
        data = { sql: data };
    $.post({
        url: `control.php?c=${url}`,
        async: async,
        data: data,
        success: e => ret = e,
        error: e => exit(e)
    });
    return ret;
}
function insert(form, obj, async = true, show = false) {
    const data = { sql: `INSERT INTO ${form}(${Object.keys(obj)}) VALUES ('${Object.values(obj).join("','")}')` };
    if (show) console.log(data);
    else DB('work', data, async);
}
function par(json) {
    return JSON.parse(json);
}
function str(json) {
    return JSON.stringify(json);
}