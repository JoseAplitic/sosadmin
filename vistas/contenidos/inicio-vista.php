<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <!-- Widgets  -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-1">
                                <i class="pe-7s-cash"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text">$<span class="count">23569</span></div>
                                    <div class="stat-heading">Revenue</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-2">
                                <i class="pe-7s-cart"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count">3435</span></div>
                                    <div class="stat-heading">Sales</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-3">
                                <i class="pe-7s-browser"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count">349</span></div>
                                    <div class="stat-heading">Templates</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-4">
                                <i class="pe-7s-users"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count">2986</span></div>
                                    <div class="stat-heading">Clients</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Widgets -->
        <div class="clearfix"></div>
        <!-- Modal - Calendar - Add New Event -->
        <div class="modal fade none-border" id="event-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><strong>Add New Event</strong></h4>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success save-event waves-effect waves-light">Create event</button>
                        <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#event-modal -->
        <!-- Modal - Calendar - Add Category -->
        <div class="modal fade none-border" id="add-category">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><strong>Add a category </strong></h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="control-label">Category Name</label>
                                    <input class="form-control form-white" placeholder="Enter name" type="text" name="category-name"/>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">Choose Category Color</label>
                                    <select class="form-control form-white" data-placeholder="Choose a color..." name="category-color">
                                        <option value="success">Success</option>
                                        <option value="danger">Danger</option>
                                        <option value="info">Info</option>
                                        <option value="pink">Pink</option>
                                        <option value="primary">Primary</option>
                                        <option value="warning">Warning</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">Save</button>
                    </div>
                </div>
            </div>
        </div>
    <!-- /#add-category -->
    </div>
    <!-- .animated -->

    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3">Yearly Sales </h4>
                        <canvas id="sales-chart"></canvas>
                    </div>
                </div>
            </div><!-- /# column -->

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3">Team Commits </h4>
                        <canvas id="team-chart"></canvas>
                    </div>
                </div>
            </div><!-- /# column -->

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3">Bar chart </h4>
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div><!-- /# column -->

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3">Rader chart </h4>
                        <canvas id="radarChart"></canvas>
                    </div>
                </div>
            </div><!-- /# column -->

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3">Line Chart </h4>
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3">Doughut Chart </h4>
                            <canvas id="doughutChart"></canvas>
                        </div>
                    </div>
                </div><!-- /# column -->

            </div><!-- /# column -->

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3">Pie Chart </h4>
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div><!-- /# column -->


            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3">Polar Chart </h4>
                        <canvas id="polarChart"></canvas>
                    </div>
                </div>
            </div><!-- /# column -->

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3">Single Bar Chart </h4>
                        <canvas id="singelBarChart"></canvas>
                    </div>
                </div>
            </div><!-- /# column -->
        </div>

    </div><!-- .animated -->

    <!--  Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>
    <script type="text/javascript">
        ( function ( $ ) {
            "use strict";

            //Team chart
            var ctx = document.getElementById( "team-chart" );
            ctx.height = 150;
            var myChart = new Chart( ctx, {
                type: 'line',
                data: {
                    labels: [ "2012", "2013", "2014", "2015", "2016", "2017", "2018" ],
                    type: 'line',
                    defaultFontFamily: 'Montserrat',
                    datasets: [ {
                        data: [ 0, 7, 3, 5, 2, 8, 6 ],
                        label: "Expense",
                        backgroundColor: 'rgba(0,200,155,.35)',
                        borderColor: 'rgba(0,200,155,0.60)',
                        borderWidth: 3.5,
                        pointStyle: 'circle',
                        pointRadius: 5,
                        pointBorderColor: 'transparent',
                        pointBackgroundColor: 'rgba(0,200,155,0.60)',
                            },
                            {
                        data: [ 0, 6, 3, 4, 3, 7, 10 ],
                        label: "Profit",
                        backgroundColor: 'rgba(0,194,146,.25)',
                        borderColor: 'rgba(0,194,146,0.5)',
                        borderWidth: 3.5,
                        pointStyle: 'circle',
                        pointRadius: 5,
                        pointBorderColor: 'transparent',
                        pointBackgroundColor: 'rgba(0,194,146,0.5)',
                            }, ]
                },
                options: {
                    responsive: true,
                    tooltips: {
                        mode: 'index',
                        titleFontSize: 12,
                        titleFontColor: '#000',
                        bodyFontColor: '#000',
                        backgroundColor: '#fff',
                        titleFontFamily: 'Montserrat',
                        bodyFontFamily: 'Montserrat',
                        cornerRadius: 3,
                        intersect: false,
                    },
                    legend: {
                        display: false,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            fontFamily: 'Montserrat',
                        },


                    },
                    scales: {
                        xAxes: [ {
                            display: true,
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            scaleLabel: {
                                display: false,
                                labelString: 'Month'
                            }
                                } ],
                        yAxes: [ {
                            display: true,
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Value'
                            }
                                } ]
                    },
                    title: {
                        display: false,
                    }
                }
            } );


            //Sales chart
            var ctx = document.getElementById( "sales-chart" );
            ctx.height = 150;
            var myChart = new Chart( ctx, {
                type: 'line',
                data: {
                    labels: [ "2012", "2013", "2014", "2015", "2016", "2017", "2018" ],
                    type: 'line',
                    defaultFontFamily: 'Montserrat',
                    datasets: [ {
                        label: "Foods",
                        data: [ 0, 30, 15, 110, 50, 63, 120 ],
                        backgroundColor: 'transparent',
                        borderColor: 'rgba(220,53,69,0.75)',
                        borderWidth: 3,
                        pointStyle: 'circle',
                        pointRadius: 5,
                        pointBorderColor: 'transparent',
                        pointBackgroundColor: 'rgba(220,53,69,0.75)',
                            }, {
                        label: "Electronics",
                        data: [ 0, 50, 40, 80, 35, 99, 80 ],
                        backgroundColor: 'transparent',
                        borderColor: 'rgba(40,167,69,0.75)',
                        borderWidth: 3,
                        pointStyle: 'circle',
                        pointRadius: 5,
                        pointBorderColor: 'transparent',
                        pointBackgroundColor: 'rgba(40,167,69,0.75)',
                            } ]
                },
                options: {
                    responsive: true,

                    tooltips: {
                        mode: 'index',
                        titleFontSize: 12,
                        titleFontColor: '#000',
                        bodyFontColor: '#000',
                        backgroundColor: '#fff',
                        titleFontFamily: 'Montserrat',
                        bodyFontFamily: 'Montserrat',
                        cornerRadius: 3,
                        intersect: false,
                    },
                    legend: {
                        display: false,
                        labels: {
                            usePointStyle: true,
                            fontFamily: 'Montserrat',
                        },
                    },
                    scales: {
                        xAxes: [ {
                            display: true,
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            scaleLabel: {
                                display: false,
                                labelString: 'Month'
                            }
                                } ],
                        yAxes: [ {
                            display: true,
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Value'
                            }
                                } ]
                    },
                    title: {
                        display: false,
                        text: 'Normal Legend'
                    }
                }
            } );

            //line chart
            var ctx = document.getElementById( "lineChart" );
            ctx.height = 150;
            var myChart = new Chart( ctx, {
                type: 'line',
                data: {
                    labels: [ "January", "February", "March", "April", "May", "June", "July" ],
                    datasets: [
                        {
                            label: "My First dataset",
                            borderColor: "rgba(0,0,0,.09)",
                            borderWidth: "1",
                            backgroundColor: "rgba(0,0,0,.07)",
                            data: [ 20, 47, 35, 43, 65, 45, 35 ]
                                    },
                        {
                            label: "My Second dataset",
                            borderColor: "rgba(0, 194, 146, 0.9)",
                            borderWidth: "1",
                            backgroundColor: "rgba(0, 194, 146, 0.5)",
                            pointHighlightStroke: "rgba(26,179,148,1)",
                            data: [ 16, 32, 18, 27, 42, 33, 44 ]
                                    }
                                ]
                },
                options: {
                    responsive: true,
                    tooltips: {
                        mode: 'index',
                        intersect: false
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    }

                }
            } );


            //bar chart
            var ctx = document.getElementById( "barChart" );
            //    ctx.height = 200;
            var myChart = new Chart( ctx, {
                type: 'bar',
                data: {
                    labels: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul" ],
                    datasets: [
                        {
                            label: "My First dataset",
                            data: [ 65, 59, 80, 81, 56, 55, 45 ],
                            borderColor: "rgba(0, 194, 146, 0.9)",
                            borderWidth: "0",
                            backgroundColor: "rgba(0, 194, 146, 0.5)"
                                    },
                        {
                            label: "My Second dataset",
                            data: [ 28, 48, 40, 19, 86, 27, 76 ],
                            borderColor: "rgba(0,0,0,0.09)",
                            borderWidth: "0",
                            backgroundColor: "rgba(0,0,0,0.07)"
                                    }
                                ]
                },
                options: {
                    scales: {
                        yAxes: [ {
                            ticks: {
                                beginAtZero: true
                            }
                                        } ]
                    }
                }
            } );

            //radar chart
            var ctx = document.getElementById( "radarChart" );
            ctx.height = 160;
            var myChart = new Chart( ctx, {
                type: 'radar',
                data: {
                    labels: [ [ "Eating", "Dinner" ], [ "Drinking", "Water" ], "Sleeping", [ "Designing", "Graphics" ], "Coding", "Cycling", "Running" ],
                    datasets: [
                        {
                            label: "My First dataset",
                            data: [ 65, 70, 66, 45, 5, 55, 40 ],
                            borderColor: "rgba(0, 194, 146, 0.6)",
                            borderWidth: "1",
                            backgroundColor: "rgba(0, 194, 146, 0.4)"
                                    },
                        {
                            label: "My Second dataset",
                            data: [ 28, 5, 55, 19, 63, 27, 68 ],
                            borderColor: "rgba(0, 194, 146, 0.7",
                            borderWidth: "1",
                            backgroundColor: "rgba(0, 194, 146, 0.5)"
                                    }
                                ]
                },
                options: {
                    legend: {
                        position: 'top'
                    },
                    scale: {
                        ticks: {
                            beginAtZero: true
                        }
                    }
                }
            });


            //pie chart
            var ctx = document.getElementById( "pieChart" );
            ctx.height = 300;
            var myChart = new Chart( ctx, {
                type: 'pie',
                data: {
                    datasets: [ {
                        data: [ 45, 25, 20, 10 ],
                        backgroundColor: [
                                            "rgba(0, 194, 146,0.9)",
                                            "rgba(0, 194, 146,0.7)",
                                            "rgba(0, 194, 146,0.5)",
                                            "rgba(0,0,0,0.07)"
                                        ],
                        hoverBackgroundColor: [
                                            "rgba(0, 194, 146,0.9)",
                                            "rgba(0, 194, 146,0.7)",
                                            "rgba(0, 194, 146,0.5)",
                                            "rgba(0,0,0,0.07)"
                                        ]

                                    } ],
                    labels: [
                                    "green",
                                    "green",
                                    "green"
                                ]
                },
                options: {
                    responsive: true
                }
            } );

            //doughut chart
            var ctx = document.getElementById( "doughutChart" );
            ctx.height = 150;
            var myChart = new Chart( ctx, {
                type: 'doughnut',
                data: {
                    datasets: [ {
                        data: [ 35, 40, 20, 5 ],
                        backgroundColor: [
                                            "rgba(0, 194, 146,0.9)",
                                            "rgba(0, 194, 146,0.7)",
                                            "rgba(0, 194, 146,0.5)",
                                            "rgba(0,0,0,0.07)"
                                        ],
                        hoverBackgroundColor: [
                                            "rgba(0, 194, 146,0.9)",
                                            "rgba(0, 194, 146,0.7)",
                                            "rgba(0, 194, 146,0.5)",
                                            "rgba(0,0,0,0.07)"
                                        ]

                                    } ],
                    labels: [
                                    "green",
                                    "green",
                                    "green",
                                    "green"
                                ]
                },
                options: {
                    responsive: true
                }
            } );

            //polar chart
            var ctx = document.getElementById( "polarChart" );
            ctx.height = 150;
            var myChart = new Chart( ctx, {
                type: 'polarArea',
                data: {
                    datasets: [ {
                        data: [ 15, 18, 10, 7, 19],
                        backgroundColor: [
                                            "rgba(0, 194, 146,0.9)",
                                            "rgba(0, 194, 146,0.8)",
                                            "rgba(0, 194, 146,0.7)",
                                            "rgba(0,0,0,0.2)",
                                            "rgba(0, 194, 146,0.5)"
                                        ]

                                    } ],
                    labels: [
                                    "green",
                                    "green",
                                    "green",
                                    "green"
                                ]
                },
                options: {
                    responsive: true
                }
            } );

            // single bar chart
            var ctx = document.getElementById( "singelBarChart" );
            ctx.height = 150;
            var myChart = new Chart( ctx, {
                type: 'bar',
                data: {
                    labels: [ "Sun", "Mon", "Tu", "Wed", "Th", "Fri", "Sat" ],
                    datasets: [
                        {
                            label: "My First dataset",
                            data: [ 55, 50, 75, 80, 56, 55, 60 ],
                            borderColor: "rgba(0, 194, 146, 0.9)",
                            borderWidth: "0",
                            backgroundColor: "rgba(0, 194, 146, 0.5)"
                                    }
                                ]
                },
                options: {
                    scales: {
                        yAxes: [ {
                            ticks: {
                                beginAtZero: true
                            }
                                        } ]
                    }
                }
            } );
        } )( jQuery );
    </script>

</div>