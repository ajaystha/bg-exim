<script language="javascript">
	var _datestr,i,_hrs,_min,_date;	

function fnShowClock()
	{
		_sec+=1;
		if(_sec>59){_min+=1;_sec=0;}
		if(_min>59){_hrs+=1;_min=0;}

		var Time = ((_hrs> 12) ? _hrs - 12 :(_hrs == 0) ? 12 :_hrs);
		Time += ((_min < 10) ? ":0" : ":") + _min;
		Time += ((_sec < 10) ? ":0" : ":") + _sec;
		Time += (_hrs >= 12) ? " PM" : " AM";
		
		document.getElementById("MyDateTime").innerHTML=Time +" " + _date;
		window.setTimeout("fnShowClock()",1000);		
	}

function fnShowDateTime(){
		_datestr=document.getElementById("txtHrs").value;
		_date=document.getElementById("txtDate").value;
		_hrs=parseInt(_datestr.substr(0,2),10);		
		_min=parseInt(_datestr.substr(3,5));
		_sec=parseInt(_datestr.substr(6,8));
		_ampm=_datestr.substr(9,11);
		fnShowClock();
	}
</script>