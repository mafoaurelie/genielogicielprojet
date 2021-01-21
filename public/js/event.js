var tags = document.querySelectorAll(".post-tag");
var l = tags.length;


var selectedElem = new Array(10);

for(var i = 0; i< l; ++i){
    
    tags[i].addEventListener('click',function(e){
        
        e.preventDefault();

        var elem = e.target;
        if( elem.getAttribute('data-selected') == 1){
            selectedElem[elem.getAttribute('data-id')] = -1;
            elem.setAttribute('data-selected',0);
             elem.style.color = 'blue';

             updateView( selectedElem );

        }else{
            selectedElem[elem.getAttribute('data-id')] = elem.getAttribute('data-id');
        
            elem.setAttribute('data-selected',1);
            elem.style.color = "red";
       
            updateView( selectedElem );
        }

    },false);
}

function updateView( elem ){

    var xhr = new XMLHttpRequest();

    xhr.open('POST','/cities/filter');

    var data = {
        elem: elem
    };

    xhr.setRequestHeader("Content-Type","application/json");
    xhr.addEventListener('readystatechange',function(e){
        
        if( xhr.status == 200 && xhr.readyState == XMLHttpRequest.DONE ) {
            var response = JSON.parse(xhr.responseText);
            var status = response.status ;
                response = response.data;

            var div = document.querySelector("#updatableDiv");
            var resultStr = "";
            if( status === "failed") {
                div.innerHTML = "<h1>Aucun résultat trouvé </h1>";
                return;
            }
            
            response.forEach(res => {
                 
                tagsStr = "";
                imgStr = "";

                res.tags.forEach( aTag => {
                    tagsStr += '<a data-id='+ aTag.id +' class="post-tag" title="'+ aTag.description+'" style="margin:5px"> \
                                        <i class="fa fa-tag"></i>'+ aTag.name + '</a>';
                })

                resultStr += '<div class="col-sm-4"> <div class="card">';
                resultStr += '<img class="card-img-top" style="height:200px" src="'+ res.images[0].path + '">';

                resultStr += '<div class="card-body text-center"> \
                                <h5 class="card-title">'+ res.name + '</h5> \
                                <p class="card-text text-left">'+ res.description +'</p>\
                                <a href="/details/'+ res.id + '" class="btn btn-warning">More info</a> \
                             </div>';

                resultStr += '<div class="card-footer">' + tagsStr + '</div>';
                resultStr += '</div></div>'
        });

            div.innerHTML = "";
            div.innerHTML = resultStr;
        }
    },false);

    xhr.send( JSON.stringify( data ));

}