	
	//表单提交
	function sub(){
		document.sub.submit();
	}
	
	//取消，返回
	var url='';
	function cancel(url){
	
		window.location.href=url;
	}
	
	
	var msg='';
	function yesno(msg) { 
		if(confirm(msg)){
			
			openLayer('sys','Layer');
			return true;
		}else
		 return false;


	} 
