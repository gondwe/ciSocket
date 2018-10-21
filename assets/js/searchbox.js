let pos = -1;
let link = 'items/search';
// let donefunct = null;
const datalink = "http://localhost/ci3/crud/search/";
    $(".ssx").keyup(function(e){

        field = e.currentTarget.dataset.link;
        // donefunct = e.currentTarget.dataset.funct;
        // pf(donefunct);
        // newlink = field.data("link");
        // if(field.length > 0){
        link = (field.length > 0) ? field.replace('-','/') : link;
        // donefunct = 
        // }
        // pf(link);

        b = $(this).next().next();
        n = b[0].childElementCount;
        nodes = b[0].childNodes;
        // pf(nodes);
        key = e.keyCode;
            if(key == 40 ){
                pos++
                $.each(nodes,function(k,v){
                    $(v).css("background","white");
                })
                if(pos == n) pos = 0
                $(nodes[pos]).css("background","yellow");
                
            }else if(key == 13){
                sl = $(nodes[pos]);
                lod(sl[0]);
                
                
            }else if(key == 38){
                $.each(nodes,function(k,v){
                    $(v).css("background","white");
                })
                if(pos <= 0){ pos = n-1 } else { pos--; }
                $(nodes[pos]).css("background","yellow");

            }else{
            val = $(this).val().trim();
            // if(val !== ""){
                w = $(this).css("width");
                // // el = '<li style="" class="form-control" onclick=lod(this)>'+val+'something</div>';


                getdata(val,b)
                
                $(b).css("width",w);
            // }
        }
    })

    const getdata = (v,div)=>{
        $.post(datalink+link,{"s":v},(res)=>{
            div.html(res)
        })
    }

    lod = (e)=>{
        item = e.innerHTML;
        data_params = e.dataset;
        $(e).parent().prev().prev().val(item);
        $(e).parent().html("");
        pos = 0;
        donefunct(e.innerHTML);
    }