var array = [];
var links = document.getElementsByTagName("cite");
for(var i=0; i<links.length; i++) {
    array.push(links[i].innerHTML);
};
console.log(array);