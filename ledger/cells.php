<?php 
    error_reporting(1);
    session_start();
    if(!$_SESSION['loggedon']){
            echo "NOT LOG IN";
        die();
    }
?>
<!DOCTYPE html>
<html>

<head>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Lato&display=swap');

        body {
            font-family: 'Lato', sans-serif;
            height: 100%;
            overflow: hidden;
            -webkit-font-smoothing: subpixel-antialiased;
            margin: 0;
        }
    </style>
</head>

<body onload(setData)>


    <bbl-formulla id="fBar" style="display: block;padding: 5px 10px;background: #2f4f4f;height: 30px;  ">
    </bbl-formulla>

    <template id="formulla">
        <style>
            * {
                box-sizing: border-box;
                padding-bottom: 5px;
                margin-bottom: 10px;
            }
            body{
                
                background: #2f4f4f;
            }

            :host #fBar {
                position: absolute;
                display: block;
            }

            :host div {
                position: relative;
                overflow: hidden;
                width: calc(100% - 10px);
                margin: 0 5px;
                height: 30px;
                background-color: white;
                /*border-bottom: solid 2px #1f1f1f;*/
                border-left: 1px solid #ddd;
                border-right: 1px solid #ddd;
                border-top: 1px solid #ddd;
                font-size: 15px;
                justify-content: center;
                font-weight: 200px;
                align-items: center;
                line-height: 25px;
                -webkit-box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.75);
                -moz-box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.75);
                box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.75);
            }

 @media only screen and (max-device-width: 480px)  {
                  :host div{
                    position: relative;
                overflow: hidden;
                width: calc(100% - 90px);
                margin: 0 5px;
                height: 30px;
                background-color: white;
                /*border-bottom: solid 2px #1f1f1f;*/
                border-left: 1px solid #ddd;
                border-right: 1px solid #ddd;
                border-top: 1px solid #ddd;
                font-size: 15px;
                justify-content: center;
                font-weight: 200px;
                align-items: center;
                line-height: 25px;
                -webkit-box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.75);
                -moz-box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.75);
                box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.75);
                float:right;
                  } 
 }
                  
            :host div text {
                color: blue;
            }

            :host div:focus {
                outline: 1px solid rgb(6, 124, 45);
            }


            
           :host div[contenteditable=true]::before {
                position: absolute;
                line-height: 25px;
                right: 5px;
                content: attr(placeholder);
                pointer-events: none;
                opacity: 0.6;
                color:blue;
            }
        </style>
        <div contenteditable="true" placeholder="FORMULA HERE"></div>
    </template>


    <bbl-ledger id="ledger" cols="Cbox,ID,Date,Item name,Item detail,Count,Rate,Expense,Income,Balance"
        fot="Total Selected:,Date Range:, Item Count:, Total Count:, Total Expense:, Total Income:, Total Balance:"
        stats="Status:">
        <style>
            * {
                height: 100%;
            }
        </style>
    </bbl-ledger>

    <template id="tmpCell">
        <style>
            * {
                box-sizing: border-box;
                scrollbar-width: none;
            }

            :host {
                box-sizing: border-box;
                width: 100%;
                height: 100%;
                text-overflow: hidden;
                white-space: nowrap;
                overflow: hidden;
                padding: 4px 10px;
                border: solid 1px #ddd;
                border-top: 0;
                border-left: 0;
                min-height: 2em;
                line-height: 2em;
                position: relative;
            }

            :host div {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                display: inline-block;
                align-items: center;
                justify-content: center;
                margin-top: 0;
                overflow-x: scroll;
                text-overflow: clip;
                overflow-y: hidden;
                 transition: border .01s ;
                -moz-transition: border .01s ;
                -webkit-transition: border .01s ;
                -o-transition: border .01s ;
                white-space: nowrap;
                font-size: 15px;
                -ms-overflow-style: none;
                -webkit-font-smoothing: subpixel-antialiased;
            }

            :host div[contenteditable=true]::after {
                position: absolute;
                align-items: center;
                justify-content: center;
                margin-top: 0;
                overflow-x: scroll;
                text-overflow: ellipsis;
                white-space: nowrap;
                font-size: 15px;
                -ms-overflow-style: none;
                -webkit-font-smoothing: subpixel-antialiased;
                content: attr(placeholder);
                pointer-events: none;
                opacity: 0.6;
            }

            :host div:focus {
                border: 1px rgb(6, 124, 45);
            }

            :host div::-webkit-scrollbar {
                display: none;
            }

            :host input {
                position: relative;
                align-items: center;
                justify-content: center;
                height: 70%;
                width: 90%;
                float: left;
                vertical-align: middle;
                background-color: grey;
            }
             :host input[type=number],
             :host input[type=date] {
                position: relative;
                display: block;
                align-items: right;
                justify-content: right;
                height: 100%;
                width: 100%;
                background: white;
                border: 0px;
                text-align: center;
                /*font-size: 15px;*/
            }
            
            :host input[type=date]::-webkit-calendar-picker-indicator {
                background: transparent;
                bottom: 0;
                color: transparent;
                cursor: pointer;
                height: auto;
                float: right;
                position: absolute;
                right: 0;
                top: 0;
                width: 40px;
            }

            :host input[type=date]::-webkit-datetime-edit {
                text-align: center;
            }
        </style>
        <div contenteditable="true">
        </div>
    </template>

    <template id="tmpLedger">
        <style>
            * {
                box-sizing: border-box;
            }

            :host .column-headers,
            :host .cells {
                display: grid;
                grid-template-columns: 0.5fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr;
            }

            :host .formullaBar {
                border: solid 1px #ddd;
                justify-content: center;
                text-align: right;
                overflow: hidden;
                height: 30px;
                width: 100%;
                padding: 3px 0px 3px 0px;

            }

            :host .column-footer {
                display: grid;
                grid-template-columns: repeat(7, 1fr);
            }

            :host .column-status {
                display: grid;
                grid-template-columns: repeat(1, 1fr);
            }

            :host .column-headers {
                background: #2f4f4f;
                padding: 4px;
                color: #fff;
                font-size: 15px;
            }


            ::-webkit-scrollbar {
                width: 5px;
            }

            ::-webkit-scrollbar-thumb {
                background: grey;
                border-radius: 6px;
            }

            ::-moz-scrollbar {
                width: 5px;
            }

            ::-moz-scrollbar-thumb {
                background: grey;
                border-radius: 6px;
            }

            :host .column-headers span input {
                width: 20px;
                height: 20px;
            }

            :host input {
                position: relative;
                align-items: center;
                justify-content: center;
                vertical-align: middle;
            }

            :host .column-footer>* {
                border-right: solid 2px #1f1f1f;
                background: #2f4f4f;
                padding-top: 10px;
                left: 0;
                color: #fff;
                font-size: 15px;
            }

            :host .column-status {
                border: solid 1px #1f1f1f;
                border-left: 0;
                background: #2f4f4f;
                padding: 4px 10px;
                color: #fff;
                font-size: 15px;
            }

            :host .column-headers {
                text-align: center;
            }


            /*:host .column-footer:nth-of-type(1) {
                border-left: solid 1px rgba(12, 108, 185, 0.26);
            }

            :host .column-status:nth-of-type(1) {
                border-left: solid 1px rgba(12, 108, 185, 0.26);
            }*/

            :host .cells {
                margin-left: -1px;
                border-left: solid 1px #ddd;
                justify-content: center;
                text-align: center;
                font-size: 12px;
                -webkit-font-smoothing: subpixel-antialiased;
                align-items: center;
            }

            :host .midContent {
                top: 74px;
                position: fixed;
                bottom: 20vh;
                height: 72vh;
                width: 100%;
                overflow-y: overlay;
                z-index:-90;
            }


            @media only screen and (max-device-width: 480px){
            :host .midContent{
              height:100%;
            }
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
            }

            :host button:active {
                top:2px;
               
            }

           /* @keyframes breathe {
                from {
                    transform: scale(1);
                }

                to {
                    transform: scale(0.9);
                }
            }

            :host button:active:after {
                padding: 0;
                margin: 0;
                opacity: 1;
                height: 25px;
                width: 60px;
                transition: 0s;
                outline: none;
            }

            :host button:hover {
                background-color: rgb(139, 136, 136);
                outline: none;
            }
             :host .buttonLayer .currentMonth:hover {
                background-color: rgb(139, 136, 136);
                outline: none;
            }
            */

            :host .buttonLayer {
                border: solid 1px #1f1f1f;
                border-left: 0;
                background: #2f4f4f;
                padding: 4px 10px;
            }

            :host .buttonLayer .currentMonth {
                width: 150px;
                height: 25px;
                display: inline-block;
                justify-content: center;
                text-align: center;
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
            }

            :host .buttonLayer .currentMonth:active {
                top:2px;
               
            }
           

            :host .divider {
                width: 30px;
                height: auto;
                display: inline-block;
            }

            :host .topContent {
                top: 40px;
                position: fixed;
                width: 100%;
                bottom: 0;
                left: 0;
                right: 0;
                height: max-content;
                -webkit-box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.75);
                -moz-box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.75);
                box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.75);
                z-index:90;
            }

            :host .botContent {
                position: fixed;
                height: max-content;
                width: 100%;
                left: 0;
                right: 0;
                bottom: 0;
                -webkit-box-shadow: 0px 2px 5px 2px rgba(0, 0, 0, 0.75);
                -moz-box-shadow: 0px 2px 5px 2px rgba(0, 0, 0, 0.75);
                box-shadow: 0px 2px 5px 2px rgba(0, 0, 0, 0.75);
                z-index:90;
            }

            :host .circle {
                position: absolute;
                -moz-border-radius: 50px/50px;
                -webkit-border-radius: 50px 50px;
                border-radius: 50px/50px;
                border: solid 5px rgb(5, 65, 5);
                width: 50px;
                height: 50px;
            }

            .line {
                position: absolute;
                border-left: 5px solid rgb(5, 65, 5);
            }

            .half-circle {
                width: 70px;
                height: 35px;
                border-top-left-radius: 100px;
                border-top-right-radius: 100px;
                border: 10px solid rgb(5, 65, 5);
                border-bottom: 0;
                position: absolute;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                -ms-transform: rotate(160deg);
                transform: rotate(160deg);
            }
            
        </style>
        <div class="topContent">
            <div class="column-headers"></div>

        </div>
        <div class="midContent">
            <div class="cells">
                <slot name="cells"></slot>
                <slot name="checkbox"></slot>
            </div>
        </div>
        <div class="botContent">
            <div class="column-footer"></div>
            <div class="column-status">
            </div>
            <div class="buttonLayer">
                <button id="update">Update</button>
                <div class="divider"></div>
                <button id="delete">Delete</button>
                <div class="divider"></div>
                <button id="current">New</button>
                <div class="divider"></div>
                 <button id="inventory">Inventory</button>
                <div class="divider"></div>
                <button id="prevMonth">
                    < </button>
                        <div class="currentMonth"></div>
                        <button id="nxtMonth">></button>
            </div>
        </div>
    </template>

</body>

    <script>var db="<?= $_SESSION['database'] ?>";</script>
    <script src="Js Files/birbalCells.js?newversion"></script>
</html>