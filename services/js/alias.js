/**
 * for google translations settings: example
 * <div id="google_translate_element" style='display:none'></div>
 * include translate.js
 */
function googleTranslateElementInit() {
      new google.translate.TranslateElement({
       pageLanguage: 'en',
       includedLanguages:('fr,nl,de,en'),
       //excludedLanguages:'nl',
       //getPageLanguage:'nl',
       //multilanguagePage:'nl',
       targetLanguage:'en',
       promptTargetLang:'en',
       layout: google.translate.TranslateElement.InlineLayout.SIMPLE
      }, 'google_translate_element');
    }
function loading()
{
    var totalSec = (window.performance.timing.domContentLoadedEventEnd - window.performance.timing.navigationStart) / 600;
    var hours = parseInt(totalSec / 3600) % 24;
    var minutes = parseInt(totalSec / 60) % 60;
    var seconds = totalSec % 60;
    var result = (hours < 10 ? "0" + hours : hours) + " Hours " + (minutes < 10 ? " " + minutes : minutes) + " Minutes " + (seconds < 10 ? "0" + seconds : seconds)+ " Seconds.";
    document.getElementById('loading').innerHTML += "<span style='float:bottom;margin-top:40%;'><b>TOTAL EXECUTION TIME: "+ result+" </b> </span>";
    document.getElementById('google_translate_element').style.display = 'none';
    //document.getElementById("status").style.display= '';
    document.getElementById('blah').style.display = '';
    document.getElementById("upload").style.display= 'none';
}
/**
 * Can add here anything that have to be done onload.
 * @returns {undefined}
 */
document.onload = function () {
     loading();
     //document.getElementById("status").style.display= '';
     document.getElementById('google_translate_element').style.display = 'NONE';
     document.getElementById("status").innerHTML =+ "<span style='float:bottom;margin-top:40%;'><b>TOTAL EXECUTION TIME: "+ result+" </b> </span>";//.style.display= 'none';
     document.getElementById("upload").style.display= 'none'
     document.getElementById('blah').style.display = '';

}
 /****************************
*THIS MUST NOT BE DELETED
 *(c) .Alias.
 *Contact c.alias.s@hotmail.co.uk
****************************/
function addC()
{
    string = string.replace(/<([<])>/, ""); // Prevents HTML tags from effecting the page
    if (x < string.length)
    {
        textBuffer += string.charAt(x);
        txt.innerHTML = textBuffer;
        x++;
        setTimeout('addC()', 0);
    }
    if (x == string.length)
    {
        if (home == "")
        {
            textBuffer = "";
            txt.innerHTML = '';
        }
        else
            setTimeout('reLoc()', (pause * 4));
    }
}
function reLoc() {
    window.location = home;
}
/**
 *
 * @param {type} wanted
 * @param {type} site
 * @param {type} delay
 * @returns {undefined}
 */
function beginTxt(wanted, site, delay)
{
    if (document.getElementById)
    {
        home = site;
        pause = delay;
        txt = document.getElementById(wanted);
        if (txt.innerHTML)
        {
            textBuffer = ""; // Stops the loss of Spaces
            x = 0;
            string = txt.innerHTML;
            txt.innerHTML = "";
            addC();
        }
    }
}