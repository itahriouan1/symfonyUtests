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
        newsDiv = document.getElementById(elementId);
        alert(newsDiv.id);
        newsDiv.parentElement.removeChild(newsDiv);
    }
}