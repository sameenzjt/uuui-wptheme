window.onload=
        function(){
            var oDiv = document.getElementById("fixed-tool"),
            H = 0,
            Y = oDiv
            while (Y) {H += Y.offsetTop; Y = Y.offsetParent}
            window.onscroll = function()
            {
                var s = document.body.scrollTop || document.documentElement.scrollTop
                if(s>H) {
                    oDiv.style = "position:fixed;top:60px;"
                } else {
                    oDiv.style = ""
                }
            }
        }