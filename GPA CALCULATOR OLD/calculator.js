<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Document</title>
      <style>
            div {
            
                  height:100vh ;
            }
            button{
                  position:sticky;
            }
            input{
                  name : "quantity";
                  min : '0';
                  max : '100';
            }
      </style>
</head>
<body>
     <button onclick="fun()">Add Subject</button>
     <div id="sub" >

     </div>
     <script>
         function  fun(){
            var  a = document.getElementById("sub");
           var   b = document.createElement("input");
           
           b.style.type="number";
           b.style.margin="20px";
           b.style.display="block" ;
           b.style.name="quantity" ;
           b.style.min="0";
           b.style.max="100";
           
           a.appendChild(b);
           
           
          }
     </script>
</body>
</html>