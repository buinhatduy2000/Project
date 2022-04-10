@extends('master')
@section('content')
    <div class="tbody-home col col-sm-9 col-lg-10">
        <div class="main-content">
            <main>
                <h2 class="dash-title">Dashboard</h2>
                <div class="dash-cards">
                    <div class="card-single">
                        <div class="card-body">
                            <span class="ti-briefcase"></span>
                            <div>
                                <h5>All Ideas</h5>
                                <h4>{{ count($ideas) }}</h4>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="view-likes-btn">View</button>
                        </div>
                    </div>

                    <div class="card-single">
                        <div class="card-body">
                            <span class="ti-reload"></span>
                            <div>
                                <h5>Number of ideas for the category/year</h5>
                                <h4>2022</h4>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="view-dislikes-btn">View</button>
                        </div>
                    </div>

                    <div class="card-single">
                        <div class="card-body">
                            <span class="ti-check-box"></span>
                            <div>
                                <h5>Number of contributors of each item</h5>
                                <h4>940</h4>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="view-downloads-btn">View</button>
                        </div>
                    </div>
                </div>

                <section class="recent">
                    <div class="activity-grid">
                        <div class="activity-card">
                            <div id="chart-all">
                                <!-- show dashboard for number of staff, downloads, category -->
                                <h3>Overview</h3>
                                <canvas id="myChart" style="width: 100%"></canvas>
                            </div>
                            <div id="chart-likes">
                                <h3>All Ideas</h3>
                                <canvas id="myChartLikes" style="width: 100%"></canvas>
                            </div>
                            <div id="chart-dislikes">
                                <h3>Number of ideas for the category/year</h3>
                                <canvas id="myChartDisLikes" style="width: 100%"></canvas>
                            </div>
                            <div id="chart-downloads">
                                <h3>Number of contributors of each item</h3>
                                <canvas id="myChartDownloads" style="width: 100%"></canvas>
                            </div>
                            <script>
                                var xValues = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                                var yValues = [
                                    @foreach ($categories as $category)
                                        '{{ $category->category_name }}',
                                    @endforeach
                                ]
                                var idea_month = [
                                    @foreach ($idea_monthly as $item)
                                        '{{ $item }}',
                                    @endforeach
                                ]
                                new Chart("myChart", {
                                    type: "line",
                                    data: {
                                        labels: xValues,
                                        datasets: [{
                                                data: idea_month,
                                                borderColor: "red",
                                                fill: false,
                                            },
                                            {
                                                data: [1600, 1700, 1700, 1900, 2000, 2700, 4000, 5000, 6000, 7000, 5800, 4800],
                                                borderColor: "green",
                                                fill: false,
                                            },
                                            {
                                                data: [300, 700, 2000, 5000, 6000, 4000, 2000, 1000, 200, 100, 120, 200],
                                                borderColor: "blue",
                                                fill: false,
                                            },
                                        ],
                                    },
                                    options: {
                                        legend: {
                                            display: false
                                        },
                                    },
                                });
                                new Chart("myChartLikes", {
                                    type: "line",
                                    data: {
                                        labels: xValues,
                                        datasets: [{
                                            data: idea_month,
                                            borderColor: "red",
                                            fill: false,
                                        }, ],
                                    },
                                    options: {
                                        legend: {
                                            display: false
                                        },
                                    },
                                });
                                // 2
                                new Chart("myChartDisLikes", {
                                    type: "horizontalBar",
                                    data: {
                                        labels: yValues,
                                        datasets: [{
                                            axis: 'y',
                                            data: [
                                                @foreach ($categories as $category)
                                                    {{ $category->ideas->count() }},
                                                @endforeach
                                            ],
                                            backgroundColor: '#00FF7B',
                                            hoverBackgroundColor: '#4CFF00',
                                            fill: false,
                                        }, ],
                                    },
                                    options: {
                                        legend: {
                                            display: false
                                        },
                                        scales: {
                                            xAxes: [{
                                                ticks: {
                                                    min: 0
                                                }
                                            }],
                                            yAxes: [{
                                                stacked: true
                                            }]
                                        }
                                    },
                                });
                                // 3
                                new Chart("myChartDownloads", {
                                    type: "horizontalBar",
                                    data: {
                                        labels: yValues,
                                        datasets: [{
                                            // data: [
                                            //     @foreach ($categories as $category)
                                            //         {{ $category->ideas->count() }},
                                            //     @endforeach
                                            // ],
                                            data: [2, 3, 2, 4, 5, 7, 8, 9, 10, 8, 7],
                                            backgroundColor: '#00F7FF',
                                            hoverBackgroundColor: '#0090FF',
                                            fill: false,
                                        }, ],
                                    },
                                    options: {
                                        legend: {
                                            display: false
                                        },
                                        scales: {
                                            xAxes: [{
                                                ticks: {
                                                    min: 0
                                                }
                                            }],
                                            yAxes: [{
                                                stacked: true
                                            }]
                                        }
                                    },
                                });
                            </script>
                        </div>
                        <div class="summary">
                            <div class="summary-card">
                                <div class="summary-single">
                                    <span class="ti-id-badge"></span>
                                    <div>
                                        <h5>1960</h5>
                                        <small>Number of staff</small>
                                    </div>
                                </div>
                                <div class="summary-single">
                                    <span class="ti-calendar"></span>
                                    <div>
                                        <h5>1608</h5>
                                        <small>downloads</small>
                                    </div>
                                </div>
                                <div class="summary-single">
                                    <span class="ti-face-smile"></span>
                                    <div>
                                        <h5>{{count($categories)}}</h5>
                                        <small>Category</small>
                                    </div>
                                </div>
                                <button id="view-all-btn" class="btn btn-outline-primary">View</button>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>

    <script language="javascript">
        document.getElementById("view-likes-btn").onclick = function() {
            document.getElementById("chart-downloads").style.display = 'none';
            document.getElementById("chart-likes").style.display = 'block';
            document.getElementById("chart-dislikes").style.display = 'none';
            document.getElementById("chart-all").style.display = 'none';
        };
        document.getElementById("view-dislikes-btn").onclick = function() {
            document.getElementById("chart-downloads").style.display = 'none';
            document.getElementById("chart-likes").style.display = 'none';
            document.getElementById("chart-dislikes").style.display = 'block';
            document.getElementById("chart-all").style.display = 'none';
        };
        document.getElementById("view-downloads-btn").onclick = function() {
            document.getElementById("chart-downloads").style.display = 'block';
            document.getElementById("chart-likes").style.display = 'none';
            document.getElementById("chart-dislikes").style.display = 'none';
            document.getElementById("chart-all").style.display = 'none';
        };
        document.getElementById("view-all-btn").onclick = function() {
            document.getElementById("chart-downloads").style.display = 'none';
            document.getElementById("chart-likes").style.display = 'none';
            document.getElementById("chart-dislikes").style.display = 'none';
            document.getElementById("chart-all").style.display = 'block';
        };

        document.getElementById("navbar-item").onclick = function() {
            document.getElementById("navbar-item-detail").style.display = "block";
            document.getElementById("navbar-item-cancel").style.display = "block";
            document.getElementById("navbar-item").style.display = "none";
        };
        document.getElementById("navbar-item-cancel").onclick = function() {
            document.getElementById("navbar-item-detail").style.display = "none";
            document.getElementById("navbar-item-cancel").style.display = "none";
            document.getElementById("navbar-item").style.display = "block";
        };

        document.getElementById("category").onclick = function() {
            document.getElementById("cate-ct").style.display = "block";
            document.getElementById("cate-cancel").style.display = "block";
            document.getElementById("category").style.display = "none";
        };
        document.getElementById("cate-cancel").onclick = function() {
            document.getElementById("cate-ct").style.display = "none";
            document.getElementById("cate-cancel").style.display = "none";
            document.getElementById("category").style.display = "block";
        };
    </script>
@endsection
