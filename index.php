<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRICER</title>
    <link rel="stylesheet" href="pricer.css">
    <script type="text/javascript" src = "jquery.js"></script>
    <script src="pricer.js"></script>
    <script>
        var viewport = document.querySelector("meta[name=viewport]");
        viewport.setAttribute("content", viewport.content + ", height=" + window.innerHeight);
    </script>
</head>
<body>
    <div class="root" id = "top">
        <div class="topbar-shown">
            <h1 class="othersBtn" id = "othersHide">egyebek</h1>
            <div class="vp">
                <div class = "others">emberek menedzselése</div>
                <div class = "others" onclick = "deleteExpenses()">adatbázis törlése</div>
                <div class = "others" onclick = "">fizetések letudása</div>

                <div class = "o-others" id="o-o-colors" style="display: none;">
                    <div class="colorPalette" id="red"></div>
                    <div class="colorPalette" id="blue"></div>
                    <div class="colorPalette" id="green"></div>
                    <div class="colorPalette" id="purple"></div>
                    <div class="colorPalette" id="yellow"></div>
                    <div class="colorPalette" id="brown"></div>
                    <div class="colorPalette" id="coral"></div>
                    <div class="colorPalette" id="celeste"></div>
                    <div class="colorPalette" id="black"></div>

                    <div class="colorPalette" id="yellow"></div>
                    <div class="colorPalette" id="brown"></div>
                    <div class="colorPalette" id="coral"></div>
                    <div class="colorPalette" id="celeste"></div>
                    <div class="colorPalette" id="black"></div>
                </div>
                <div class = "o-others" id="o-o-members" style="display: none;">
                    <div class = "memberChoice">színek választása</div>
                    <div class = "memberChoice">színek választása</div>
                </div>
            </div>
        </div>
    </div>

    <div class="root" id = "main">

        <div class="input">
            <h1>bemenetek</h1>
            <div class="vp">
                <div class="wrapper-input">
                    <div class="inputs">
                        <input type="text" id = "price-input" placeholder = "mennyit költöttél?" style = "display: none;">
                        <input type="text" id = "desc-input" placeholder = "mit vettél?" style = "display: none;">
                        <input type="text" id = "note-input" placeholder = "megjegyzés?" style = "display: none;">
                        <input type="text" id = "whoname-input" placeholder = "ki vagyok?">
                        <div id="submitted" style = "display: none;">bejegyezve</div>
                    </div>          
                </div>
            </div>
        </div>
        
        <div class="expenses">
            <h1>költekezések</h1>
            <div class="vp">
                <div class="wrapper-exp">
                    <table id = "exp-table">
                        <tr>
                            <th>Ki vagyok?</th>
                            <th>Mennyit fizettem?</th>
                            <th>Mit vettem?</th>
                            <th>Megjegyzéseim</th>
                        </tr>                 
                    </table>
                </div>
            </div>
        </div>

        <div class ="disp">
            <h1>közös hőmérséklet</h1>
            <div class="vp">

            </div>
        </div>

        <div class="bars">
            <h1>grafikon</h1>
            <div class="vp" id="bars-vp"></div>
        </div> 
        
        <div class="details">
            <h1>ki kinek mennyivel?</h1>
            <div class="vp">
                <table id = "details-table">          
                </table>
            </div>
        </div>   

        <div class="pipes">
            <h1>csatornák?</h1>
            <div class="vp">
            <table id = "pipes-table">          
                </table>
            </div>
        </div>   

    </div>

    </div>

</body>
</html>