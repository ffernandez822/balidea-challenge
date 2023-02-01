var button = document.createElement("button");
button.innerHTML = "button alert";

var body = document.getElementsByTagName("body")[0];
body.appendChild(button);

var title = document.title.split('|');



button.addEventListener ("click", function() {
    alert(title[1]);
  });