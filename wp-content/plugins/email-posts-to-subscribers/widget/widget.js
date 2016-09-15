function elp_submit_page(url)
{
	elp_email = document.getElementById("elp_txt_email");
	elp_name = document.getElementById("elp_txt_name");
	elp_group = document.getElementById("elp_txt_group");
    if( elp_email.value == "" )
    {
        alert("Please enter email address.");
        elp_email.focus();
        return false;    
    }
	if( elp_email.value!="" && ( elp_email.value.indexOf("@",0) == -1 || elp_email.value.indexOf(".",0) == -1 ))
    {
        alert("Please provide a valid email address.")
        elp_email.focus();
        elp_email.select();
        return false;
    }
	document.getElementById("elp_msg").innerHTML = "loading...";
	//alert(elp_group.value);
	var date_now = "";
    var mynumber = Math.random();
	var str= "elp_email="+ encodeURI(elp_email.value) + "&elp_name=" + encodeURI(elp_name.value) + "&elp_group=" + encodeURI(elp_group.value) + "&timestamp=" + encodeURI(date_now) + "&action=" + encodeURI(mynumber);
	elp_submit_request(url+'/?elp=subscribe', str);
}

var http_req = false;
function elp_submit_request(url, parameters) 
{
	http_req = false;
	if (window.XMLHttpRequest) 
	{
		http_req = new XMLHttpRequest();
		if (http_req.overrideMimeType) 
		{
			http_req.overrideMimeType('text/html');
		}
	} 
	else if (window.ActiveXObject) 
	{
		try 
		{
			http_req = new ActiveXObject("Msxml2.XMLHTTP");
		} 
		catch (e) 
		{
			try 
			{
				http_req = new ActiveXObject("Microsoft.XMLHTTP");
			} 
			catch (e) 
			{
				
			}
		}
	}
	if (!http_req) 
	{
		alert('Cannot create XMLHTTP instance');
		return false;
	}
	http_req.onreadystatechange = elp_submitresult;
	http_req.open('POST', url, true);
	http_req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http_req.setRequestHeader("Content-length", parameters.length);
	http_req.setRequestHeader("Connection", "close");
	http_req.send(parameters);
}

function elp_submitresult() 
{
	//alert(http_req.readyState);
	//alert(http_req.responseText); 
	if (http_req.readyState == 4) 
	{
		if (http_req.status == 200) 
		{
		 	if (http_req.readyState==4 || http_req.readyState=="complete")
			{ 
				if((http_req.responseText).trim() == "subscribed-successfully")
				{
					document.getElementById("elp_msg").innerHTML = "Subscribed successfully.";
					document.getElementById("elp_txt_email").value="";
				}
				else if((http_req.responseText).trim() == "subscribed-pending-doubleoptin")
				{
					alert('Bạn đã đăng ký thành công bản tin. Bạn sẽ nhận được một email xác nhận trong vài phút. Hãy làm theo các liên kết trong đó để xác nhận đăng ký của bạn. Nếu email phải mất hơn 15 phút để xuất hiện trong hộp thư của bạn, xin vui lòng kiểm tra thư mục thư rác của bạn.');
					document.getElementById("elp_msg").innerHTML = "Subscribed successfully.";
					document.getElementById("elp_txt_email").value = "";
					document.getElementById("elp_txt_name").value = "";
				}
				else if((http_req.responseText).trim() == "already-exist")
				{
					document.getElementById("elp_msg").innerHTML = "Email already exist.";
				}
				else if((http_req.responseText).trim() == "unexpected-error")
				{
					document.getElementById("elp_msg").innerHTML = "Oops.. Unexpected error occurred.";
				}
				else if((http_req.responseText).trim() == "invalid-email")
				{
					document.getElementById("elp_msg").innerHTML = "Invalid email address.";
				}
				else
				{
					document.getElementById("elp_msg").innerHTML = "Please try after some time.";
					document.getElementById("elp_txt_email").value="";
					document.getElementById("elp_txt_name").value="";
				}
			} 
		}
		else 
		{
			alert('There was a problem with the request.');
		}
	}
}