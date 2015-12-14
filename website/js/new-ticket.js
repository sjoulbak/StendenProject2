function toggle(tag) {
    var x=document.getElementsByName(tag)[0];
    var a = x.parentNode;
    if (a.style.display=='block'){
        a.style.display='none';
    }else{
        a.style.display='block';
    }
}


function init() {

    var obj = document.getElementById('QA');
    console.log(obj);
    if(obj != null){

        var elements = obj.getElementsByTagName('li');
        var index = 1;

        for (var i=0; i < elements.length; i+=2){
            var element = elements[i];
            element.innerHTML = "<a href='javascript:toggle(" + index + ")'>" + element.innerHTML + "</a>";
            index = index + 1;
        }

        var index = 1
        for (var i=1; i < elements.length; i+=2){
            var element = elements[i];
            element.innerHTML = "<a name='" + index + "' id='" + index + "'></a>" + element.innerHTML;
            index = index + 1;
            element.style.padding = '0px 0px 10px 20px';
            element.style.listStyleType = 'none';
            element.style.display = 'none';
        }
    }
}
init();