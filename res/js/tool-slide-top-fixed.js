window.onload=
    function(){
        var oDiv = document.getElementById("fixed-tool"),
        H = -80,
        Y = oDiv
        while (Y) {H += Y.offsetTop; Y = Y.offsetParent}
        window.onscroll = function()
        {
            var s = document.body.scrollTop || document.documentElement.scrollTop
            if(s>H) {
                oDiv.style = "position:fixed;top:80px;"
            } else {
                oDiv.style = ""
            }
        }
    }