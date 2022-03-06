"use strict";

// Shared Colors Definition
const primary = '#6993FF';
const success = '#1BC5BD';
const info = '#8950FC';
const warning = '#FFA800';
const danger = '#F64E60';
const green = '#85e085';

// Class definition
function generateBubbleData(baseval, count, yrange) {
    var i = 0;
    var series = [];
    while (i < count) {
      var x = Math.floor(Math.random() * (750 - 1 + 1)) + 1;;
      var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;
      var z = Math.floor(Math.random() * (75 - 15 + 1)) + 15;
  
      series.push([x, y, z]);
      baseval += 86400000;
      i++;
    }
    return series;
  }

function generateData(count, yrange) {
    var i = 0;
    var series = [];
    while (i < count) {
        var x = 'w' + (i + 1).toString();
        var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

        series.push({
            x: x,
            y: y
        });
        i++;
    }
    return series;
}

var KTApexChartsDemo = function () {

	 var _gensale = function (graph, option, year, month) {
        let element = document.getElementById(graph);
        let gensales = [];
        let beginning = [];
        let expenses =[];
        let months = [];
        if (!element) {
            return;
        }
        $.ajax({
            url: baseURL+"chart_controller/Fetch_Chart",
            type: "POST",
            data:{type : graph,option : option,year : year,month : month},
            dataType: "json",
            beforeSend: function(){
            // KTApp.blockPage();
            },
            complete: function(){
    		$('#chart1').empty();
    		var options = {
					series: [{
						name: 'Sales',
						data: gensales
					},{
                        name: 'Expenses',
                        data: expenses
                    },{
                        name: 'Beginning',
                        data: beginning
                    }
                    ],
					chart: {
						type: 'bar',
		                height: 350,
		                toolbar: {
		                    show: true
		                }
					},
					plotOptions: {
						bar: {
							horizontal: false,
							columnWidth: '25%',
							//endingShape: 'rounded'
						},
					},
                    legend: {
                        show: false
                    },
					dataLabels: {
						enabled: false
					},
                    fill: {
                        type: 'solid',
                        opacity: 1
                    },
					xaxis: {
                        categories: months,
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            style: {
                                colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                                fontSize: '12px',
                                fontFamily: KTApp.getSettings()['font-family']
                            }
                        },
                        crosshairs: {
                            position: 'front',
                            stroke: {
                                color: KTApp.getSettings()['colors']['theme']['base']['info'],
                                width: 1,
                                dashArray: 3
                            }
                        },
                        tooltip: {
                            enabled: true,
                            formatter: undefined,
                            offsetY: 0,
                            style: {
                                fontSize: '12px',
                                fontFamily: KTApp.getSettings()['font-family']
                            }
                        }
                    },
					yaxis: {
                        labels: {
                            style: {
                                colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                                fontSize: '12px',
                                fontFamily: KTApp.getSettings()['font-family']
                            },
                            formatter: function (val) {
                                return "₱ " + parseFloat(val).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')
                            }
                              
                        }
                    },
                    states: {
                        normal: {
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        },
                        hover: {
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        },
                        active: {
                            allowMultipleDataPointsSelection: false,
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        }
                    },
                    tooltip: {
                        style: {
                            fontSize: '12px',
                            fontFamily: KTApp.getSettings()['font-family']
                        },
                        y: {
                            formatter: function (val) {
                                return "₱ " + parseFloat(val).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')
                            }
                        }

                    },
                    colors: [success, danger, primary],
                    grid: {
                        borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
                        strokeDashArray: 4,
                        yaxis: {
                            lines: {
                                show: true
                            }
                        }
                    },
                    markers: {
                        //size: 5,
                        //colors: [KTApp.getSettings()['colors']['theme']['light']['danger']],
                        strokeColor: KTApp.getSettings()['colors']['theme']['base']['info'],
                        strokeWidth: 3
                    }
				};

				let chart = new ApexCharts(element, options);
		        chart.render();
            },
             success:function(response){
                if(response.label != false){
                  if(response.label.length >= 1){
                     for(var i = 0; response.label.length > i; i++){
                         gensales.push(Number(response.label[i].gensales));
                         expenses.push(Number(response.label[i].expenses));
                         beginning.push(Number(response.label[i].beginning));
                         months.push(response.label[i].label_month.substring(0, 3));
                     }
                    let credit=response.year.total_credit;
                    let debit=response.year.total_debit;
                    if(!response.year.total_credit){credit=0;}
                    if(!response.year.total_debit){debit=0;}
                    let total_beg = parseFloat(debit)-parseFloat(credit);
                    let total = parseFloat(total_beg)+parseFloat(response.year.total_gensales)-parseFloat(response.year.total_expenses);
                    $('.total-beginning').text("₱ "+parseFloat(total_beg).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                    $('.total-gensales').text("₱ " +parseFloat(response.year.total_gensales).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                    $('.total-expenses').text("₱ " +parseFloat(response.year.total_expenses).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                    $('.total-net').text("₱ "+ parseFloat(total).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                  }else{
                    const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            onOpen: (toast) => {
                              toast.addEventListener('mouseenter', Swal.stopTimer)
                              toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                          })
                          Toast.fire({
                            icon: 'info',
                            title: 'Cant load sales chart!'
                          })
                  }
                }else{

                } 
              }         
          });
	}


var _gensale2 = function (graph, option, year, month) {
        let element = document.getElementById(graph);
        let gensales = [];
        let months = [];
        let sales=[];
        let expenses=[];
        if (!element) {
            return;
        }
        $.ajax({
            url: baseURL+"Chart_controller/Fetch_Chart",
            type: "POST",
            data:{type : graph,option : option,year : year,month : month},
            dataType: "json",
            beforeSend: function(){
            // KTApp.blockPage();
            },
            complete: function(){
              $('#'+graph).empty();
             var options = {
                series: [{
                    name: "Sales",
                    data: sales
                },{
                    name: "expenses",
                    data: expenses
                }],
                chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                    enabled: false
                    }
                },
            dataLabels: {   
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },

            xaxis: {
                categories: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            },
            tooltip: {
                style: {
                    fontSize: '12px',
                    fontFamily: KTApp.getSettings()['font-family']
                },
                y: {
                    formatter: function (val) {
                        return "₱ " + parseFloat(val).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')
                    }
                }

            },
            yaxis: {
                labels: {
                    style: {
                        colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    },
                    formatter: function (val) {
                        return "₱ " + parseFloat(val).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')
                    }
                      
                }
            },
            colors: [primary,danger]
            };
                var chart = new ApexCharts(element, options);
                chart.render();
            },
             success:function(response){
                if(response != false){
                   sales.push(Number(response.sales.week1_add));
                   sales.push(Number(response.sales.week2_add));
                   sales.push(Number(response.sales.week3_add));
                   sales.push(Number(response.sales.week4_add));
                   expenses.push(Number(response.expenses.week1_less));
                   expenses.push(Number(response.expenses.week2_less));
                   expenses.push(Number(response.expenses.week3_less));
                   expenses.push(Number(response.expenses.week4_less));
                }
              }         
          });
    }
	var _gensale3 = function (graph, option, year, month) {
        let element = document.getElementById(graph);
        let amount = [];
        let categories=[];
        if (!element) {
            return;
        }
        $.ajax({
            url: baseURL+"Chart_controller/Fetch_Chart",
            type: "POST",
            data:{type : graph,option : option,year : year,month : month},
            dataType: "json",
            beforeSend: function(){
            // KTApp.blockPage();
            },
            complete: function(){
                 $('#'+graph).empty();
                    var options = {
                    series: amount,
                    chart: {
                        height: 350,
                        type: 'donut',
                    },
                    labels: categories,
                    tooltip: {
                        style: {
                            fontSize: '12px',
                            fontFamily: KTApp.getSettings()['font-family']
                        },
                        y: {
                            formatter: function (val) {
                                return "₱ " + parseFloat(val).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')
                            }
                        }

                    },
                    noData: {
                        text: "There's no data",
                        align: 'center',
                        verticalAlign: 'middle',
                        offsetX: 0,
                        offsetY: 0
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            },
                        }
                    }],
                    colors: [primary,success,warning,danger,info,green,'#dbb753','#5fd4b7','#c27455','#4d8dab','#73ab4d','#c2a9a9']
                };
                var chart = new ApexCharts(element, options);
                chart.render();
            },
             success:function(response){
                if(response != false){
                  if(response.length >= 1){
                     for(let i=0;response.length>i;i++){
                         categories.push(response[i].name);
                         amount.push(Number(response[i].amount));
                     }
                  }
                }
              }         
          });
	}

	return {
		// public functions
		init: function (chart, option, year, month) {
            if(chart=="chart1"){
                _gensale(chart, option, year, month);
            }else if(chart=="chart2"){
                _gensale2(chart, option, year, month);
            }else if(chart=="chart3"){
                _gensale3(chart, option, year, month);
            }
			
		}
	};
}();

// jQuery(document).ready(function () {
// 	KTApexChartsDemo.init();
// });
