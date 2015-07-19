$(function() {
	
	// 提取锚点链接（如：#parseHref => parseHref)
	function parseHref($anchor) {
		var $url = $anchor.attr('href')
		$url = $url.split("#");
		$url = $url[1];
		return $url;
	}
	var $ul_link = $('.sidebar li a:not(:last)');
	$ul_link.click(function(){
		var $this = $(this);
		var thisUrl =$this.attr('href');
		if(thisUrl=='#') return false; // 退出
		
		$.post(thisUrl, function(data) {
			$('#content').html(data);	
		});	
		
		$ul_link.removeClass('current');
		$this.addClass('current');
		$this.blur();
		return false;
	}); // end click
	
}); // end ready


//计算天数差的函数，通用  
   function  DateDiff(sDate1,  sDate2){    //sDate1和sDate2是2006-12-18格式  
       var  aDate,  oDate1,  oDate2,  iDays  
       aDate  =  sDate1.split("-")  
       oDate1  =  new  Date(aDate[1]  +  '-'  +  aDate[2]  +  '-'  +  aDate[0])    //转换为12-18-2006格式  
       aDate  =  sDate2.split("-")  
       oDate2  =  new  Date(aDate[1]  +  '-'  +  aDate[2]  +  '-'  +  aDate[0])  
       iDays  =  parseInt(Math.abs(oDate1  -  oDate2)  /  1000  /  60  /  60  /24)    //把相差的毫秒数转换为天数  
       return  iDays  
   }    