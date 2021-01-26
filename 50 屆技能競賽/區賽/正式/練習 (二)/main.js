'use strict';
/** @type {HTMLCanvasElement} */
let frist_data;
$.ajax({
    url: "getdata.php?call=comment_much",
    async: false,
    success: data => frist_data = JSON.parse(data)
})
new Chart(document.getElementById('comment_much').getContext('2d'), {
    type: 'bar',
    options: { // 從 0 開始
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    },
    data: {
        labels: frist_data["name"],
        datasets: [{
            label: '意見數量最高的前 3 位使用者',
            data: frist_data["value"],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
        }]
    }
});
let doughnut_datas;
$.ajax({
    url: "getdata.php?call=comment_much_count",
    async: false,
    success: data => doughnut_datas = JSON.parse(data)
})
for (let number = 1; number <= 3; ++number) {
    new Chart(document.getElementById(`comment_much_count${number}`).getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['1分', '2分', '3分', '4分', '5分'],
            datasets: [{
                label: `第${number}名`,
                data: doughnut_datas[number - 1],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        }
    });
}
