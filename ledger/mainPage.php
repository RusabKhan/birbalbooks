<?php session_start();?>
<?php
    if(!$_SESSION['loggedon']){
            echo 'Not logged on';
        die();
    }
?>
<!DOCTYPE html>
<html>
<link rel="shortcut icon" href="../images/favicon.ico" type="image/png">
</head>
<head>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Lato&display=swap');

        body {
            font-family: 'Lato', sans-serif;
            height: 100%;
            overflow: hidden;

            -webkit-font-smoothing: subpixel-antialiased;
        }
    </style>
</head>
	<title>Ledger</title>
<body onload(setData)>
    
    <bbl-mainpage id="MainPage" opts="Inventory,Ledger,Graph,Settings" col="navbar,content">
    </bbl-mainpage>

    <template id="tmpMainPage">
        <style>
        
            * {
                height: 100%;
                width: 100%;

            }
            
            :host .logo {
                /* top: 10px; */
                width: 95%;
                height: 15%;
                align-items: center;
                justify-content: center;
                display: flex;
                position: absolute;
            }

            :host .navbar .toggle {
                display:none;
            }

            :host .navbar {
                height: 100%;
                width: 10vw;
                position: fixed;
                z-index: 1;
                top: 0;
                left: 0;
                background: #2f4f4f;
                overflow: none;
                padding-top: 20px;
                display: block;
                align-items: center;
                justify-content: center;
                text-align: center;
                flex-flow: column;

            }

            :host .navbar .options {
                display: grid;
                grid-template-rows: repeat(5, .5fr);
                height: 200px;
                width: 100%;
                position: absolute;
                z-index: 1;
                left: 0;
                bottom: 30%;
                color: white;
                margin: 0 auto;
                padding: 15px 0 5px 0;
                float: left;

            }

            :host .navbar .logout {
                display: grid;
                grid-template-rows: repeat(5, .5fr);
                height: 100px;
                width: 100%;
                position: absolute;
                z-index: 1;
                left: 0;
                top: 70%;
                color: white;
                margin: 0 auto;
                padding: 15px 0 5px 0;
                float: left;
            }

            :host a {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            :host .navbar a:hover {
                background-color: rgba(0, 0, 0, 0.2);
            }

            .activated,
            :host .navbar a:active {
                background-color: #2f6f6f;
            }

            .deactived {
                background-color: rgba(0, 97, 50, 1);
            }

            :host .mainDiv .content {
                position: fixed;
                width: 90vw;
                float: right;
                top: 0;
                bottom: 0;
                right: 0;
            }

            .Cells,
            .Graph,
            .Inventory {
                display: none;
                height: 100%;
                width: 100%;
            }

            .settings :host .mainDiv {
                width: 100vw;
                height: 100vh;
            }
            @media only screen and (max-device-width: 480px)  {
              
               
               :host .mainDiv .content{
                   width:100%;
               }
               
               :host .navbar{
                   width:70px;
                   transition: height 0.35s ease-in-out;;
                   background: transparent;
               }
               
               :host .navbar .toggle{
                top: 0px;
                height: 32px;
                align-items: center;
                justify-content: center;
                display: flex;
                position: absolute;
                top: 0px;
                height: 40px;
                align-items: center;
                justify-content: center;
                display: flex;
                position: absolute;
                width: 100%;
                background: transparent;
               }
               
               :host .toggle{
                   top:5px;
   
               }
               
               
               
            :host .logo {
                display:none;
            }

            :host .navbar .options {
                display: none;
                
            }

            :host .navbar .logout {
                display: none;
            }
            
            :host a {
                display: flex;
                align-items: center;
                justify-content: center;
                font-size:10px;
            }
            
             
                
            }
        </style>
        <div class="mainDiv">
            <div class="navbar">
                <input type=image class="toggle" onclick="toggleFunction()" src="../images/favicon.ico" ></input>
                <div class="logo">
                    <img src = "../images/logo-birbal.png" ></img>
                </div>
                <div class="options"></div>
                <div class="logout">
                    <a href="logout.php" style="color: white;">Log Out</a>
                </div>
            </div>
            <div class="content">
                <div class="cells"></div>
                <div class="graph"></div>
                <div class="inventory"></div>
                <div class="settings"></div>
            </div>
        </div>
    </template>

        <script>var db="<?= $_SESSION['database'] ?>";
        function toggleFunction(){
            let navbar = document.querySelector("#MainPage").shadowRoot.querySelector("div > div.navbar");
            let content = document.querySelector("#MainPage").shadowRoot.querySelector("div > div.navbar");
            navbar.style.height=navbar.style.height == '100%' ? '32px' : '100%';
            navbar.style.background=navbar.style.background == 'transparent' || navbar.style.background == '' ? '#2f4f4f' : 'transparent';
              
            let children = navbar.children;
            for(let c of children){
                if(c.className == "logo"){}
                else{
                 if(c.style.display=="" ){
                    c.style.display="grid";
                }
                else if(c.style.display=="grid"){
                    c.style.display="";
                   }
                }
                
            }
            
            
            
        }
        
</script>
    <script src="Js Files/LedgerMainPage.js"></script>
</body>

</html>