<script src="templates/settes/bootstrap/js/jquery.js"></script>
<script src="templates/settes/bootstrap/js/js.js"></script>
<script>
function func(func,id){ 
var xml=new XMLHttpRequest();
xml.onreadystatechange=function (){
    if(this.readyState==4 && this.status==200){
       if(this.responseText!=''){
       }
    }
}
xml.open("GET","home.php?id="+id+"&func="+func,true);
xml.send();

 var close=document.getElementById("close");
    close.addEventListener("click",function (){
        
    });
    
    
    
    }
</script>
</body>
</html>