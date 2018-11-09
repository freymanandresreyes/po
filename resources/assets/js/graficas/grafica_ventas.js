// alert("hola bb");

// $('#informes_carga').click(function()
// {
// alert('hola');
// });

// ============================================================== 
// Bar chart option
// ============================================================== 
// var dias=['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sept','Oct','Nov','Dec'];
// var datos=[2.0, 4.9, 7.0, 23.2, 25.6, 76.7, 135.6, 182.3, 32.6, 20.0, 6.4, 3.3];

// var myChartm = echarts.init(document.getElementById('bar-chart'));

// // specify chart configuration item and data
// option = {
//     tooltip : {
//         trigger: 'axis'
//     },
//     legend: {
//         data:['Site A','Site B']
//     },
//     toolbox: {
//         show : true,
//         feature : {
            
//             magicType : {show: true, type: ['line', 'bar']},
//             restore : {show: true},
//             saveAsImage : {show: true}
//         }
//     },
//     color: ["#55ce63", "#009efb"],
//     calculable : true,
//     xAxis : [
//         {
//             type : 'category',
//             data : dias
//         }
//     ],
//     yAxis : [
//         {
//             type : 'value'
//         }
//     ],
//     series : [
//         {
//             name:'Site A',
//             type:'bar',
//             data:datos,
//             markPoint : {
//                 data : [
//                     {type : 'max', name: 'Max'},
//                     {type : 'min', name: 'Min'}
//                 ]
//             },
//             markLine : {
//                 data : [
//                     {type : 'average', name: 'Average'}
//                 ]
//             }
//         },
//         {
//             name:'Site B',
//             type:'bar',
//             data:[2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3],
//             markPoint : {
//                 data : [
//                     {name : 'The highest year', value : 182.2, xAxis: 7, yAxis: 183, symbolSize:18},
//                     {name : 'Year minimum', value : 2.3, xAxis: 11, yAxis: 3}
//                 ]
//             },
//             markLine : {
//                 data : [
//                     {type : 'average', name : 'Average'}
//                 ]
//             }
//         },
//     ]
// };
     


// use configuration item and data specified to show chart
// myChartm.setOption(option, true), $(function() {
//     function resize() {
//         setTimeout(function() {
//             myChartm.resize()
//         }, 100)
//     }
//     $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
// });