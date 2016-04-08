/*
 * Javascript file:
 * Contains two function that helps trigger
 * AJAX and misspelled words correction
 */


// trigger the suggestion name
// works only with one passed parameter
var foo = getParameterByName('name');

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)", "i"),
        results = regex.exec(url);

    if (!results) return null;
    if (!results[2]) return '';
    // run AJAX  based on auto-correction
    return ShowPlayer(decodeURIComponent(results[2].replace(/\+/g, " ")));
}

// return search query for user input
function ShowPlayer(str) {
    if (str == "" || str == null) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        //document.write(str);
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "../php/showtable.php?q=" + str, true);
        xmlhttp.send();
    }
}