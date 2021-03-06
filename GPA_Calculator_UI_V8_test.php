<!doctype html>
<html>
<head>

<?php 
	include ('../includes/GoogleTagManager_Head.php');
?>
	
<meta charset="utf-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">	

<link rel="stylesheet" href="css/styles_2.css" type="text/css">
<style>
	button {
		  width:170px;
		  height:40px;
		  background-color: #ffffff;
		  color: black;
		  border-radius: 10px;
	}
	
	.header {
		margin-top: 20px;
		margin-bottom: 20px
	}
	
	#genericError {
		height: 2rem;
	}
	#result {
		height: 5rem;
	}
	#validationError {
		height: 3rem;
	}
	
	#demo {
		height:40px;
		text-align: center;
	}
	
	#mainBody {
		background-color: #002157;
		height:670px;
	}
	
	.inputRow {
		margin-bottom: 30px;
	}
</style>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<body style="background-color:#e4dee0;" >
	<?php 
		include ('../includes/GoogleTagManager_Body.php');
	?>
<div class="container" id="resize">
	<div class="row">
		<div class="col-12" id="mainBody">
			<!--<form onsubmit="return false">-->
				<div class="col-12">
					<h3 class="text-white header" style="padding:3px">GPA Calculator</h3>
				</div>

				<div class="col-12" id="genericError">
					
				</div>

				<div class="row inputRow justify-content-center">
					<div class="col-md-6">
						<p class="text-white" title="Enter your Current Cummulative GPA" data-toggle="tooltip">Current GPA:</p>
					</div>
					
					<div class="col-md-6" id="validationError">
						<input type="text" title="Enter your Current Cummulative GPA" data-toggle="tooltip" placeholder="e.g., 3.27" id="cgpa" value="" oninput="validfn(this);">
						<p id="cgpa_error"></p>
					</div>
				</div>

				<div class="row inputRow justify-content-center">
					<div class="col-md-6">
						<p class="text-white" title="Enter number of Credit Hours you have attempted to score your Current Cummulative GPA" data-toggle="tooltip">Current Credits Attempted:</p>
					</div>
					
					<div class="col-md-6" id="validationError">
						<input type="number" title="Enter number of Credit Hours you have attempted to score your Current Cummulative GPA" data-toggle="tooltip" placeholder="e.g., 90" id="cearned" value="" oninput="valid(this);">
						<p id="cearned_error"></p>
					</div>
				</div>

				<div class="row inputRow">
					<div class="col-md-6">
						<p class="text-white" title="What is your future Desired GPA?" data-toggle="tooltip">Desired GPA:</p>
					</div>
					<div class="col-md-6" id="validationError">
						<input type="text" title="What is your future Desired GPA?" data-toggle="tooltip" placeholder=" e.g., 3.5" id="dgpa" value="" oninput="validfn(this);">
						<p id="dgpa_error"></p>
					</div>
				</div>

				<div class="col-12" id="validationError">
					<button id="myBtn" title="" data-toggle="tooltip" class="btn btn-primary" type="submit" onclick="myFunction()">Calculate</button>
				</div>

				<div class="col-12" >
					<div id="demo"></div>
				</div>

				<div class="col-12 text-white " id="indication">
					*This calculator assumes every course to be 3 credit hours.
				</div>
			<!--</form>-->
		</div>
	</div>
</div>

<script>
	//var numbers = /^[0-9.]+$/;
	  var numbers = /^[0-9]+\.?[0-9]*$/;
	
	var valid = function(e) {
    var t = e.value;
		if(t.match(numbers)){	
               if(t.indexOf(".") >= 0)
		        {
                  e.value = (t.indexOf(".") >= 0) ? (t.substr(0, t.indexOf("."))) : t;
		        }
		       else
			     e.value = t.substring(0, 3);
			}
		else
		{
		  e.value = t.replace(/[^\w\s]/gi, '');	
			
		}
	}
	
	prevVals = {"cgpa" : "", "dgpa": ""}

	var validfn = function(e) {
		var t = e.value;
		
		if (t == "") {
			prevVals[e.id] = "";
		} else if (t.match(numbers)) {
			if(t.indexOf(".") >= 0) {
				//if(t.indexOf(".")==0)
				  //e.value = (t.indexOf(".") == 0) ?  ("0"+ t.substr(t.indexOf("."), 3)) : t;
				if (t.indexOf(".") == 1)
				    e.value = (t.indexOf(".") >= 0) ? (t.substr(0, t.indexOf(".")) + t.substr(t.indexOf("."), 3)) : t;
			    else
					e.value = (t.indexOf(".") >= 0) ? (t.substring(0, 1) + t.substr(t.indexOf("."), 3)) : t;
		    } else {
				e.value = t.substring(0, 1);
		    }
			
			prevVals[e.id] = e.value
		} else {
			e.value = prevVals[e.id]
		    //e.value = t.substring(0, t.length - 1);
		}
}

function myFunction() {
    var result=0;
	var secondresult=0;
	var text="";
    var i=0;
	var flag = true;
    var count = 0;
	var colorarray=["cgpa","cearned","dgpa"];
    
	//RESET TEXTBOXES BORDER COLOR TO BLACK AND ERROR MESSAGE TEXT TO EMPTY
  	for (i = 0; i < colorarray.length; i++) {
		 document.getElementById(colorarray[i]).style.borderColor=' #d2caca';
		 document.getElementById(colorarray[i] + "_error").innerHTML = "";
		 document.getElementById("genericError").innerHTML = "";
		 text="";
		 /*document.getElementById("fillinput").innerHTML="";*/
		 document.getElementById("demo").innerHTML = text;
	}
	
   //RETRIEVE ALL VALUES FROM TEXTBOXES TO INPUTARRAY 
   var inputarray=[parseFloat(document.getElementById("cgpa").value), parseInt(document.getElementById("cearned").value), parseFloat(document.getElementById("dgpa").value)];
   var boundsArr = [{'min': 0, 'max': 4}, {'min': 1},{'min': 0, 'max': 4}]
  
	for(i=0;i<inputarray.length;i++) {
		if(!isNaN(inputarray[i])) {
		    count++;
			if (boundsArr[i].hasOwnProperty("max")) {
				if (inputarray[i] < boundsArr[i].min || inputarray[i] > boundsArr[i].max) {
					flag = false;
					document.getElementById(colorarray[i]).style.border = " solid #f76262";
					//document.getElementById(colorarray[i]).style.borderColor=' #ff1133';
					document.getElementById(colorarray[i] + "_error").innerHTML = "<span class='color-red'>Input should be between " + boundsArr[i].min + " and " + boundsArr[i].max + "</span>";
				}
			} else {
				if (inputarray[i] < boundsArr[i].min) {
					flag = false;
					
					document.getElementById(colorarray[i]).style.border='solid #f76262';
					document.getElementById(colorarray[i] + "_error").innerHTML = "<span class='color-red'>Input should be greater than " + (boundsArr[i].min -1)+ "</span>";
				}
			}
		} else {
			
			document.getElementById(colorarray[i]).style.border='solid #f76262';
			document.getElementById("genericError").innerHTML="<span class='color-red'>Please fill all input fields</span>";
		}
	}
  
  
	if (flag == true&&inputarray.length==count) {
		 if(inputarray[0]<4 && inputarray[2]==4) {
				document.getElementById("demo").innerHTML="<span class='color-red'>Desired GPA can't be achieved</span>";   
		} else if(inputarray[2]<=inputarray[0]) {
				document.getElementById("demo").innerHTML="<span class='color-white'>Maintain your current GPA in future courses</span>"
		} else {
			result = ((inputarray[1]*(inputarray[2]-inputarray[0])) / (4 - inputarray[2])) / 3;
			secondresult = ((inputarray[1]*(inputarray[2]-inputarray[0])) / (3.75 - inputarray[2])) ;
			console.log(Math.round(result));
			console.log(Math.round(secondresult));
				document.getElementById("demo").innerHTML="<span class='color-white'> Get A's in next "+(Math.round(result)).toFixed(0)+"  courses"  + "<br/> OR <br/>   " + "Get A's in next "+(Math.round(0.25*secondresult)).toFixed(0)+"  courses & B's in next "+(Math.round(0.08333333*secondresult)).toFixed(0)+"  courses  </span>";
		}
	} 
	
}//********************************************end of validation function*********************************
 
</script>
</body>
</html>