<?php
error_reporting(0);
include_once "layouts/header.php"
    ?>

<style>
    body {
        font-family: Arial, sans-serif;
    }

    .tab-container {
        display: flex;
    }

    .tab-button {
        background-color: #f1f1f1;
        border: 1px solid #ccc;
        padding: 10px 20px;
        cursor: pointer;
        outline: none;
    }

    .tab-button.active1{
        background-color: #757575;
    }

    .tab-content {
        display: none;
        padding: 20px;
        border: 1px solid #ccc;
    }

    .tab-content.active {
        display: block;
    }
</style>
<div>
    <div class="container mt-4">
        <div class="tab-container">
            <button class="tab-button active" onclick="openTab('tab1')">By Category</button>
            <button class="tab-button" onclick="openTab('tab2')">By Sub Category</button>
        </div>
        <div id="tab1" class="tab-content active">
            <h2>Product Total and Sale ratio in Category</h2>
            <div class="row">

                <div class="col-md-8">
                    <div class="card flex-fill w-100">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Toal Posts in Each Category</h5>
                        </div>
                        <div class="card-body px-4">

                            <div class="chart">
                                <canvas style="" id="BarChart"></canvas>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card flex-fill w-100">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Pie chart of sold posts in each category</h5>
                        </div>
                        <div class="card-body px-4">

                            <div class="chart">
                                <canvas style="height:400px" id="PieChart"></canvas>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div id="tab2" class="tab-content">
            <h2>TProduct Total and Sale ratio in Sub Category</h2>
            <div class="row">

                <div class="col-md-8">

                    <div class="card flex-fill w-100">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Posts in Each Sub Category</h5>
                        </div>
                        <div class="card-body px-4">

                            <div class="chart">
                                <canvas style="" id="SubChart2"></canvas>

                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-md-4">
                    <div class="card flex-fill w-100">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Pie chart of sold posts in each Sub category</h5>
                        </div>
                        <div class="card-body px-4">

                            <div class="chart">
                                <canvas style="height:400px" id="PieChart2"></canvas>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="row mt-4">
        <h2 class="mt-4">Product Sale Rate in Previous Days</h2>

            <div class="col-md-12">
                <div class="card flex-fill w-100">
                    <div class="card-header">

                        <h5 class="card-title mb-0">Sell Post line chart in each day</h5>
                    </div>
                    <div class="card-body px-4">

                        <div class="chart">
                            <canvas style="height:400px" id="LineChart2"></canvas>

                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="js/jquery-3.7.0.min.js"></script>
<script src="js/Report.js"></script>
</body>

</html>