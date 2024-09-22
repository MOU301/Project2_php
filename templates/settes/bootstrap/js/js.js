
// start open the menue 
var friends=document.getElementById('friends');
var requests=document.getElementById('requests');
var respones=document.getElementById('responses');
var settes=document.getElementById('settes');
var friend=document.getElementsByClassName('friends')[0].classList;
var request=document.getElementsByClassName("requests")[0].classList;
var respons=document.getElementsByClassName("respons")[0].classList;
var closs=document.getElementsByClassName('close');
friends.addEventListener('click',function (){
    "use strict";
friend.toggle('show');
});
requests.addEventListener('click',function (){
   "use strict";
request.toggle('show');
});
respones.addEventListener('click',function (){
  "use strict";
respons.toggle('show'); 
});
settes.addEventListener('click',function (){  
});
for(var i=0; i<closs.length ; i++){
closs[i].addEventListener('click',function(){
    this.parentElement.classList.toggle('show');
})

}
// end open menue
// start send the message
var send=document.getElementsByName('send')[0];
var idi=document.getElementById('id').value;
var messages=document.getElementsByName('message')[0];
var friends_id=document.getElementById('friends_id').value;
send.addEventListener('click',function(){
    var message=messages.value;
   let xml=new XMLHttpRequest();
    xml.open("GET","send.php?id="+idi+"&friends="+friends_id+"&message="+message);
    xml.onreadystatechange=function (){  
        if(this.readyState===4 && this.status===200){
        messages.value="";
       }
    }
    xml.send();
});
// end send message
// start read the messages
setInterval(function(){
    var friends_id=document.getElementById('friends_id').value;
    var messages=document.getElementById('messages');
       let xml=new XMLHttpRequest();
        xml.open("GET","read.php?id="+idi+"&friends="+friends_id);
        xml.onreadystatechange=function (){  
            if(this.readyState===4 && this.status===200){
                var data=JSON.parse(this.responseText);
                if(messages.children.length!=data.length){
                    for(var i=messages.children.length; i<data.length ; i++){
                    var div=document.createElement('div');
                        div.setAttribute('class','mt-3 d-flex justify-content-between');
                    var div1=document.createElement('div');
                        div1.setAttribute('class','d-flex');
                    var span=document.createElement('span');
                    var div2=document.createElement('div');
                        div2.setAttribute('class','image');
                    var p=document.createElement('p');
                        p.setAttribute('class','message-item ');
                    var m=document.createTextNode(data[i].message);
                        p.appendChild(m);
                    var t=document.createTextNode(data[i].created_at);
                        span.appendChild(t);
                    if(data[i].user_id==idi){
                        p.setAttribute("class","text-red mx-3");
                        div1.appendChild(p);
                        div1.appendChild(div2);
                        div.appendChild(span);
                        div.append(div1);
                        messages.appendChild(div);
                    }
                    else{
                        div1.appendChild(div2);
                        p.setAttribute("class","text-success mx-3");
                        div1.appendChild(p);
                        div.appendChild(div1);
                        div.append(span);
                        messages.appendChild(div);
                    
                    }
                    
                    

                    }
                }
                }
           }
         
        
        xml.send();
},1000)
// end read the messages
// start search

function search(str){
    var ul=document.getElementById('findUser');
    var id=document.getElementById('id_user').value;
    console.log(id);
    var arr=[];
    var find=[];
    
    
    if(str.length==0){
        while(ul.children.length>0){
            for(var i=0; i<ul.children.length;i++){
                ul.children[i].remove();
            }
          }
    }
    else{
        var xml=new XMLHttpRequest();
            xml.onreadystatechange=function(){
                if(this.readyState==4 && this.status==200){
                    var data=JSON.parse(this.responseText);
                    if(data.length>0){ 
                        for(var i=0; i<data.length; i++){
                            if(arr.indexOf(data[i].name)<0){
                                arr.push(data[i].name);
                                find.push(data[i]);   
                            }
                          }
                        if(arr.length!=ul.children.length){
                                for(var i=0; i<arr.length; i++){
                                        var item=document.createElement('li');
                                        var a=document.createElement('a');
                                            a.appendChild(document.createTextNode(find[i].name));
                                            a.setAttribute('href','home.php?user='+find[i].id); 
                                        // var button=document.createElement('button');
                                        //     button.setAttribute('class','btn btn-success');
                                        //     button.appendChild(document.createTextNode('add'));  
                                        item.appendChild(a);
                                        // item.appendChild(button);
                                        ul.appendChild(item);
                                        console.log(find[i].name);
                                    }
                                }  
                            
                            
                    } 
                    }
                    else{
                        for(var i=0; i<ul.children.length;i++){
                            ul.children[i].remove();
                        }
                        console.log("there is not data in same name");
                    }
                
            }
            xml.open('GET','search.php?name='+str+'&id='+id);
            xml.send();
    }   
} 
// end search 
// if(arr.length>ul.children.length){
//     for(var i=0; i<arr.length; i++){
//         var item=document.createElement('li');
//         var a=document.createElement('a');
//             a.appendChild(document.createTextNode(data[i].name));
//             a.setAttribute('href','home.php?user='+data[i].id); 
//         var button=document.createElement('button');
//             button.setAttribute('class','btn btn-success');
//             button.appendChild(document.createTextNode('add'));  
//         item.appendChild(a);
//         item.appendChild(button);
//         ul.appendChild(item);
//     }
// }