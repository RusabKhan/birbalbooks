<?php 
     session_start();
    if(!$_SESSION['loggedon']){
            echo "NOT LOG IN";
        die();
    }
?>
<!DOCTYPE html>
<html>


<head>
    <script src="chartsLibrary/Chart.bundle.js?newversion"></script>
    <link rel="stylesheet" src="chartsLibrary/bootstrap.min.css?newversion">
    </link>

</head>

<body onload(setData)>
    <bbl-graphs id="graph">
        <style>
            * {
                overflow-y:hidden;
                overflow-x:visible;
            }
        </style>
    </bbl-graphs>

    <template id="tmpGraph">
        <style>
            :host .container {
                width: 99%;
                height: 80%;
                min-height: 80%; 
            }
            :host .container #myChart {
                min-width: 80%;
                min-height: 80%;
            }
             :host .buttonLayer {
                border-left: 0;
                padding: 4px 10px;
            }
             :host button {
                justify-content: center;
                height: 25px;
                width: 65px;
                text-align: center;
                overflow: hidden;
                vertical-align: middle;
                background-color: rgb(185, 194, 181);
                border: rgb(185, 194, 181);
                -webkit-transition-duration: 0.4s;
                transition-duration: 0.4s;
                text-decoration: none;
                overflow: hidden;
                cursor: pointer;
                outline: none;
                box-shadow:0 2px rgb(161,165,159);
                position:relative;
                padding-right:5px;
            }

            :host button:active {
                top:2px;
               
            }
        </style>
        <div class="container">
            <canvas id="myChart"></canvas>
             <div class="buttonLayer">
                <button id="refresh">Balance</button>
                <button id="item">Item</button>
                </div>
        </div>
    </template>
    <script>var db="<?= $_SESSION['database'] ?>";</script>
    <script src="Js Files/graph.js?2"></script>
</body>

</html>