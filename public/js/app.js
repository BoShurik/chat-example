var centrifuge = new Centrifuge({
    url: CENTRIFUGE_URL,
    user: CENTRIFUGE_USER,
    timestamp: CENTRIFUGE_TIMESTAMP,
    token: CENTRIFUGE_TOKEN
});

var button = document.getElementById('send');
button.onclick = function(){
    var xhr = new XMLHttpRequest();
    var body = 'message=' + encodeURIComponent(document.getElementById('message').value);

    xhr.open("POST", '/message', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.send(body);
};

var chat = document.getElementById('chat');

centrifuge.subscribe("chat", function(data) {
    console.log(data);
    chat.insertAdjacentHTML('beforeend', '<div><span>'+ data.data.username +'</span><p>'+ data.data.message +'</p></div>');
});

centrifuge.connect();