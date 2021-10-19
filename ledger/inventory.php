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
    <style>
        @import url('https://fonts.googleapis.com/css?family=Lato&display=swap');

        body {
            font-family: 'Lato', sans-serif;
            height: 100%;
            overflow: hidden;
            margin: 0;
            -webkit-font-smoothing: subpixel-antialiased;
        }
    </style>
</head>

<body onload(setData)>


    <inven-searchBar id="sBar" style="display: block;padding: 5px 10px;background: #2f4f4f;height: 30px;  ">

    </inven-searchBar>

    <template id="searchBar">
        <style>
            * {
                box-sizing: border-box;
                padding-bottom: 5px;
                margin-bottom: 10px;

            }

            :host div {
                background: #fff;
                border-radius: 25px;
                position: relative;
                overflow: hidden;
                width: 100%;
                /*border-bottom: solid 2px #1f1f1f;*/
                border-left: 1px solid #ddd;
                border-right: 1px solid #ddd;
                border-top: 1px solid #ddd;
                font-size: 15px;
                justify-content: center;
                font-weight: 200;
                align-items: center;
                line-height: 25px;
                padding: 0px 30px 0px 10px;
                text-align: left;
                margin: 0;
                -webkit-box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.75);
                -moz-box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.75);
                box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.75);

            }
            
            @media only screen and (max-device-width: 480px)  {
                  :host div {
                    display: block;
                    padding: 5px 10px;
                    background: #2f4f4f;
                    height: 40px;
                    width: calc(100% - 90px);
                 background: #fff;
                border-radius: 25px;
                position: relative;
                overflow: hidden;
                /*border-bottom: solid 2px #1f1f1f;*/
                border-left: 1px solid #ddd;
                border-right: 1px solid #ddd;
                border-top: 1px solid #ddd;
                font-size: 15px;
                justify-content: center;
                font-weight: 200;
                align-items: center;
                line-height: 25px;
                padding: 0px 30px 0px 10px;
                text-align: left;
                margin: 0;
                -webkit-box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.75);
                -moz-box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.75);
                box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.75);
                float:right;
                  }   

            :host div:focus {
                box-shadow: 0 0 1px 0.5px rgb(5, 138, 74) inset;
                outline: none;
            }


            :host div[contenteditable=true]::after {
                position: absolute;
                line-height: 25px;
                right: 5px;
                content: attr(placeholder);
                pointer-events: none;
                opacity: 0.6;
            }
        </style>
        <div contenteditable="true" placeholder=''></div>
    </template>


    <inven-table id="Table" cols="Cbox,ID,Item name,Rate" stats="Status:">
        <style>
            * {
                height: 100%;
            }
        </style>
        </inven-ledger>

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
                    display: block;
                    align-items: center;
                    justify-content: center;
                    margin-top: 0;
                    overflow-x: scroll;
                    font-size: 15px;
                    -ms-overflow-style: none;
                    -webkit-font-smoothing: subpixel-antialiased;
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
                    vertical-align: middle;
                    background-color: grey;
                }
            </style>
            <div contenteditable="true">
            </div>
        </template>

        <template id="tmpTable">
            <style>
                * {
                    box-sizing: border-box;
                }

                :host .column-headers,
                :host .cells {
                    display: grid;
                    grid-template-columns: 0.5fr 1fr 1fr 1fr;
                }

                :host .searchBar {
                    border: solid 1px #ddd;
                    justify-content: center;
                    display: inline-block;
                    text-align: right;
                    overflow: hidden;
                    height: 30px;
                    width: 100%;
                    padding: 3px 0px 3px 0px;

                }

                :host .column-headers>* {
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

                :host .column-headers span input {
                    width: 25px;
                    height: 25px;
                }

                ::-webkit-scrollbar {
                    width: 5px;
                }

                ::-webkit-scrollbar-thumb {
                    background: grey;
                    border-radius: 6px;
                }

                :host input {
                    position: relative;
                    align-items: center;
                    justify-content: center;
                    vertical-align: middle;
                }

                :host .column-headers>*:nth-of-type(1) {
                    border-left: solid 1px rgba(12, 108, 185, 0.26);
                }

                :host .cells {
                    margin-left: -1px;
                    justify-content: center;
                    text-align: center;
                    font-size: 12px;
                    -webkit-font-smoothing: subpixel-antialiased;
                    align-items: center;
                }

                :host .midContent {
                    top: 80px;
                    position: fixed;
                    height: 510px;
                    width: 100%;
                    overflow-y: overlay;
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

                @keyframes breathe {
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

                :host .buttonLayer {
                    border: solid 1px #1f1f1f;
                    border-left: 0;
                    background: #2f4f4f;
                    padding: 4px 10px;
                }

                :host .column-status {
                    border: solid 1px #1f1f1f;
                    border-left: 0;
                    background: #2f4f4f;
                    padding: 4px 10px;
                    color: white;
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
                    height: max-content;
                    bottom: 0;
                    left: 0;
                    right: 0;
                    -webkit-box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.75);
                    -moz-box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.75);
                    box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.75);

                }

                :host .botContent {
                    position: fixed;
                    height: max-content;
                    width: 100%;
                    bottom: 0;
                    left: 0;
                    right: 0;
                    -webkit-box-shadow: 0px 2px 5px 2px rgba(0, 0, 0, 0.75);
                    -moz-box-shadow: 0px 2px 5px 2px rgba(0, 0, 0, 0.75);
                    box-shadow: 0px 2px 5px 2px rgba(0, 0, 0, 0.75);
                }
                
                 
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
                <div class="column-status"></div>
                <div class="buttonLayer">
                    <button id="update">Update</button>
                    <div class="divider"></div>
                    <button id="delete">Delete</button>
                    <div class="divider"></div>
                    <button id="Add">Add</button>
                </div>
            </div>
        </template>

        <script>var db="<?= $_SESSION['database'] ?>";</script>
        <script type="" src="Js Files/inventory.js"></script>
</body>

</html>