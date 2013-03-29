var xmlHttp = createXmlRequestObject();

function createXmlRequestObject(){
    var xmlHttp;
    if(window.XMLHttpRequest){
        xmlHttp = new XMLHttpRequest();
    }
    else{
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    return xmlHttp;
}

function process(){
    // configure -> handleresponse -> communicate
    if(xmlHttp.readyState == 0 || xmlHttp.readyState == 4){
        var username = encodeURIComponent(document.getElementById("username").value);

        xmlHttp.open("GET","check.php?username="+username,true);
        xmlHttp.onreadystatechange = handleServerResponse;
        xmlHttp.send(null);
    }
    else{
        setTimeout('process()',1000);
    }
}

function handleServerResponse(){
    if(xmlHttp.readyState == 4){
        check = document.getElementById('check');

        if(xmlHttp.status == 200){
            try{
                msg = xmlHttp.responseText;
                check.innerHTML = msg;
                setTimeout('process()',1000);
            }
            catch(e){
                alert(e.toString());
            }
        }
        else{
            check.innerHTML += 'SOMETHING IS WRONG';
        }
    }
}
