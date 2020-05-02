function deleteNews(id) {
    var requestURL = 'DeleteNews='+id;
    var request = new XMLHttpRequest();
    request.open('POST', requestURL);
    request.responseType = 'json';
    request.send();
    request.onload = function() {
        var response = request.response;
        elementId="news"+id;
        elementId= elementId.toString();
        newsTR = document.getElementById(elementId);
        alert(newsTR.id);
        newsTR.parentElement.removeChild(newsTR);
    }
}
function modifyNews(id) {
    var requestURL = 'ModifyNews='+id+'&action=modify';
    var request = new XMLHttpRequest();
    request.open('POST', requestURL);
    request.responseType = 'json';
    request.send();
    request.onload = function() {
        var response = request.response;
        alert(response.form);
        formHTML=response.form;
        elementId="news"+id;

        newsTR = document.getElementById(elementId).innerHTML='';
        newsTR = document.getElementById(elementId).innerHTML=formHTML;


    }
}
function saveModificationNews(id) {

    titre=document.getElementById('titre'+id).value;
    description=document.getElementById('description'+id).value;
    //form=document.querySelector('form');
    data='titre='+titre+'&description='+description;


    var requestURL = 'ModifyNews='+id+'&action=save';
    var request = new XMLHttpRequest();
    request.open('POST', requestURL, true);
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    request.responseType = 'json';


    request.send(data);
    request.onload = function() {
        var response = request.response;
        alert(response.form);

        elementId="news"+id;

        newsTR = document.getElementById(elementId).innerHTML=response.form;




    }
}