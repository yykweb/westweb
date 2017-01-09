
//创建ajax引擎
	function getXmlHttpObject(){
		var xmlHttpRequest;
		if(window.ActiveXObject){
			xmlHttpRequest = new ActiveXObject('Microsoft.XMLHTTP');
		}else{
			xmlHttpRequest = new XMLHttpRequest();
		}

		return xmlHttpRequest;
	}

	//获取对象
	var id="";
	function $(id){
		return document.getElementById(id);
	}

	
	//时间下拉
	function getTime(shijian,count){
		$('count').length=0;
		var myOption = document.createElement('option');
		myOption.value=''; //元素的值
		myOption.innerHTML="请选择时间";
		$('count').appendChild(myOption);
		var nian=10;
		if($('shijian').value == 1){		 
			for(var i=1;i<=nian;i++){
				var myOption = document.createElement('option');
				myOption.value= i; //元素的值
				myOption.innerHTML= i + " 年 ";
				$('count').appendChild(myOption);
				}	
			}

		var season = 12;
			if($('shijian').value == 2){		 
				for(var i=1;i<=season;i++){
				var myOption = document.createElement('option');
				myOption.value= i; //元素的值
				myOption.innerHTML= i + " x 季度";
				$('count').appendChild(myOption);
				}	
			}

		var month = 11;
			if($('shijian').value == 3){		 
				for(var i=1;i<=month;i++){
					var myOption = document.createElement('option');
					myOption.value= i; //元素的值
					myOption.innerHTML= i + "  月";
					$('count').appendChild(myOption);
				}	
			}

	}
				
	//判断密码
	function check_pass(password,rpassword,url,callback,tableName){
		myxmlHttpRequest = getXmlHttpObject();
		if(myxmlHttpRequest){
			var url = url;
			
			if(rpassword==''){
				var data = "password="+$(password).value;
			}else{
				var data = "password="+$(password).value+"&rpassword="+$(rpassword).value+"&tableName="+tableName;
			}
			
			if(tableName!=''){
				var data = "password="+$(password).value+"&tableName="+tableName;
			}
			
			myxmlHttpRequest.open('post',url,true);
			//post必须的参数
			myxmlHttpRequest.setRequestHeader("content-type","application/x-www-form-urlencoded");
			//指定回调函数
			myxmlHttpRequest.onreadystatechange=function(){ chuli_pass(callback) };
			//如果post要填入data
			myxmlHttpRequest.send(data);
		}
	}

	//处理回调函数
	function chuli_pass(callback){
		if(myxmlHttpRequest.readyState==4){
			if(myxmlHttpRequest.status==200){
				//取出服务器返回的数据
				var data2= myxmlHttpRequest.responseText;
				
				var obj2 = eval("("+data2+")");
				
				
				$(callback).innerHTML= obj2;
			
			}	
		}
	}
	
	
	//获取select产品分类
	var obj='';
	var key='';
	var value='';
	var upup='';
	
	//nowobj 是处理函数里面放opiont对象   upobj是第一个的id的value  upup是第二个id value 参数  
	function getClass(url,nowobj,upobj,upup,key,value,table){
		myxmlHttpRequest = getXmlHttpObject();
		if(myxmlHttpRequest){
			var url =  url;
	
			
			if(upup == ''){
				var data = "id="+$(upobj).value;
			}else{
				var data = "id="+$(upobj).value+"&pid="+$(upup).value+"&table="+table;
			}

			myxmlHttpRequest.open('post',url,true);

			myxmlHttpRequest.setRequestHeader("content-type","application/x-www-form-urlencoded");

			//指定回调函数
			myxmlHttpRequest.onreadystatechange=function(){chuli(nowobj,key,value);};

			//如果post要填入data
			myxmlHttpRequest.send(data);
		}
	}
	
	
	function chuli(callback,key,value){
		if(myxmlHttpRequest.readyState==4){
			
			if(myxmlHttpRequest.status==200){
			
			//取出服务器返回的数据
				var data = myxmlHttpRequest.responseText;

				var obj = eval("("+data+")");	

				//防止option不断叠加
				$(callback).length=0;
				
				var myOption = document.createElement('option');
				
				myOption.value=''; //元素的值
				
				myOption.innerHTML="请选择";
				
				$(callback).appendChild(myOption);
				
				
				for(var i=0;i<obj.length;i++){
						var id = obj[i][key];
							var clientname = obj[i][value];

							//创建新的元素option
							 var myOption = document.createElement('option');

							 myOption.value= id; //元素的值

							 myOption.innerHTML= clientname;

							 $(callback).appendChild(myOption);
			
						}	
					}
				}
			}

			
			//获取该用户商品的折扣后价格
			var tableName='';
			function getPrice(url,tableName){

				myxmlHttpRequest = getXmlHttpObject();
				if(myxmlHttpRequest){

					var url = url+"?username="+$('username').value+"&count="+$('count').value+"&shijian="+$('shijian').value+"&product_id="+$('list').value+"&table="+tableName;
					
				
					myxmlHttpRequest.open('get',url,true);


					//指定回调函数
					myxmlHttpRequest.onreadystatechange=chuli_price;

					//如果post要填入data
					myxmlHttpRequest.send();
				}

			}



			function chuli_price(){
				if(myxmlHttpRequest.readyState==4){
					if(myxmlHttpRequest.status==200){
						//取出服务器返回的数据
						 var data2= myxmlHttpRequest.responseText;
						
						$('allprice').innerHTML= data2;
			
					}	
				}
			}
			
	
	
	//是否使用下拉选项
	var state = '';
	function read(id,state){ 
		$(id).disabled = state ;
	}
	
	//将不选项设为readonly
	function setReadOnly(id,state){
		
		$(id).readOnly = state ;
	}




	//季度，年，月下拉
	function price_type(id){
			
			if($('price').value == 1){
				$(id).innerHTML = '元/年';
			}

			if($('price').value == 2){
				$(id).innerHTML = '元/季';
			}

			if($('price').value == 3){
				$(id).innerHTML = '元/月';
			}
	
	}



	//nowobj 是处理函数里面放opiont对象   upobj是第一个的id的value  upup是第二个id value 参数  
	function getPath(url,nowobj,upobj,upup,key,value,table){
		myxmlHttpRequest = getXmlHttpObject();
		if(myxmlHttpRequest){
			var url =  url;
			
			if(upup == ''){
				var data = "id="+$(upobj).value;
			}else{
				var data = "id="+$(upobj).value+"&pid="+$(upup).value+"&table="+table;
			}
		

			myxmlHttpRequest.open('post',url,true);

			myxmlHttpRequest.setRequestHeader("content-type","application/x-www-form-urlencoded");

			//指定回调函数
			myxmlHttpRequest.onreadystatechange=function(){path(nowobj,key,value);};

			//如果post要填入data
			myxmlHttpRequest.send(data);
		}
	}
	
	
	function path(callback,key,value){
		if(myxmlHttpRequest.readyState==4){
			
			if(myxmlHttpRequest.status==200){
			
			//取出服务器返回的数据
				var data = myxmlHttpRequest.responseText;
				
				var obj = eval("("+data+")");

				//防止option不断叠加
				$(callback).length=0;
				
				var myOption = document.createElement('option');
				
				myOption.value=''; //元素的值
				
				myOption.innerHTML="请选择";
				
				$(callback).appendChild(myOption);
				
				for(var i=0;i<obj.length;i++){
						var id = obj[i];
	
							var clientname = obj[i];

							//创建新的元素option
							 var myOption = document.createElement('option');

							 myOption.value= id; //元素的值

							 myOption.innerHTML= id;

							 $(callback).appendChild(myOption);
			
						}	
					}
				}
			}




//nowobj 是处理函数里面放opiont对象   upobj是第一个的id的value  upup是第二个id value 参数  
	function get_price_select(url,nowobj,put,key,value,table,username){
		myxmlHttpRequest = getXmlHttpObject();
		if(myxmlHttpRequest){
			var url =  url;
			

			if(nowobj!='' && table=='' ){
				var data = "id="+$(nowobj).value;
			}

			if(nowobj !='' && table!='' && username!=''){
				var data = "id="+$(nowobj).value+"&table="+table+"&username="+$(username).value;
			}

			if(nowobj !='' && table!='' && username==''){
				var data =  "id="+$(nowobj).value+"&table="+table;
			}


			myxmlHttpRequest.open('post',url,true);

			myxmlHttpRequest.setRequestHeader("content-type","application/x-www-form-urlencoded");

			//指定回调函数
			myxmlHttpRequest.onreadystatechange=function(){price_select(put,key,value);};

			//如果post要填入data
			myxmlHttpRequest.send(data);
		}
	}
	
	
	function price_select(callback,key,value){
		if(myxmlHttpRequest.readyState==4){
			
			if(myxmlHttpRequest.status==200){
			
			//取出服务器返回的数据
				var data = myxmlHttpRequest.responseText;
				
				var obj = eval("("+data+")");

				//防止option不断叠加
				$(callback).length=0;
				
				var myOption = document.createElement('option');
				
				myOption.value=''; //元素的值
				
				
				$(callback).appendChild(myOption);
				
				

				if(obj['type'] == 1){
					var price_type = '年';	
				}else{
					if(obj['type'] == 2){
						var price_type = '季度';
					}else{

						if(obj['type'] == 3){
							var price_type = '月';
						}
					}
				}
				myOption.innerHTML="请选择";
				for(var i=1;i<=12;i++){
						var id = obj[i];
	
							var clientname = i*obj['price']+'元 / '+i+price_type;

							//创建新的元素option
							 var myOption = document.createElement('option');

							 myOption.value= obj['type']+'-'+ i +'-'+obj['price']; //元素的值

							 myOption.innerHTML= clientname;

							 $(callback).appendChild(myOption);
			
				}	

			}
		}
	}




//nowobj 是处理函数里面放opiont对象   upobj是第一个的id的value  upup是第二个id value 参数  
	function get_gift_select(url,nowobj,put,key,value,table){
		myxmlHttpRequest = getXmlHttpObject();
		if(myxmlHttpRequest){
			var url =  url;
			
			var data = "id="+$(nowobj).value;
			
			
			//alert(data);

			myxmlHttpRequest.open('post',url,true);

			myxmlHttpRequest.setRequestHeader("content-type","application/x-www-form-urlencoded");

			//指定回调函数
			myxmlHttpRequest.onreadystatechange=function(){gift_select(put,key,value);};

			//如果post要填入data
			myxmlHttpRequest.send(data);
		}
	}
	
	
	function gift_select(callback,key,value){
		if(myxmlHttpRequest.readyState==4){
			
			if(myxmlHttpRequest.status==200){
			
			//取出服务器返回的数据
				var data = myxmlHttpRequest.responseText;
				
				var obj = eval("("+data+")");

				//防止option不断叠加
				$(callback).length=0;
				
				var myOption = document.createElement('option');
				
				myOption.value= 0; //元素的值
				
				
				$(callback).appendChild(myOption);
		
				if(obj['no_gift'] != 1){
					if(obj['MSSQL_Or_MySQL'] == 1){
						var clientname = "开通赠送MSSQL "+obj['MSSQL_Space']+"M";
						myOption.innerHTML="赠送不开通MSSQL "+obj['MSSQL_Space']+"M";
					}else{
						var clientname = "开通赠送MYSQL "+obj['MYSQL_Space']+"M";
						myOption.innerHTML="赠送不开通MYSQL "+obj['MYSQL_Space']+"M";
					}
						

					//创建新的元素option
					var myOption = document.createElement('option');

					myOption.value= obj['MSSQL_Or_MySQL']; //元素的值

					myOption.innerHTML= clientname;

					$(callback).appendChild(myOption);
				
			}else{
				myOption.innerHTML="无赠送数据库";
			}
		

			}
		}
	}


	//上个名称对应默认名
	function get_name(put,obj){
	
		$(put).value= $(obj).value; 
	}