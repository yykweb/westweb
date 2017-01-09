<!--
// *******************************************
// * N点虚拟主机管理系统 - Powered By Yoounion *
// * 官方站点: http://www.npointhost.com     *
// * 作者QQ: 9558659                         *
// * 弹出层：用法 openLayer(对象ID,内容ID)   *
// *******************************************
function openLayer(objId,conId){
    var arrayPageSize   = getPageSize();
    var arrayPageScroll = getPageScroll();
    if (!document.getElementById("popupAddr")){
    var popupDiv = document.createElement("div");
    popupDiv.setAttribute("id","popupAddr")
    popupDiv.style.position = "absolute";
    popupDiv.style.border = "1px solid #ccc";
    popupDiv.style.background = "#fff";
    popupDiv.style.zIndex = 99;
    var bodyBack = document.createElement("div");
    bodyBack.setAttribute("id","bodybg")
    bodyBack.style.position = "absolute";
    bodyBack.style.width = (arrayPageSize[2] + 'px');
    bodyBack.style.height = (arrayPageSize[1] + 'px');
    bodyBack.style.zIndex = 98;
    bodyBack.style.top = 0;
    bodyBack.style.left = 0;
    bodyBack.style.filter = "alpha(opacity=50)";
    bodyBack.style.opacity = 0.5;
    bodyBack.style.background = "#fff";
    var mybody = document.getElementById(objId);
    insertAfter(popupDiv,mybody);
    insertAfter(bodyBack,mybody);
}
document.getElementById("bodybg").style.display = "";
document.getElementById(objId).disabled=true;
var popObj=document.getElementById("popupAddr")
popObj.innerHTML = document.getElementById(conId).innerHTML;
popObj.style.display = "";
popObj.style.width = "300px";
popObj.style.height = "60px";
popObj.style.top = arrayPageScroll[1] + (arrayPageSize[3] - 60) / 2 + 'px';
//popObj.style.left = (arrayPageSize[1] - 300) / 2 + 'px';
popObj.style.left = (arrayPageSize[2] - 300) / 2 + 'px';
}
function getConSize(conId){
    var conObj=document.getElementById(conId)
    conObj.style.position = "absolute";
    conObj.style.left=-1000+"px";
    conObj.style.display="";
    var arrayConSize=[conObj.offsetWidth,conObj.offsetHeight]
    conObj.style.display="none";
    return arrayConSize;
}
function insertAfter(newElement,targetElement){
    var parent = targetElement.parentNode;
    if(parent.lastChild == targetElement){
        parent.appendChild(newElement);
    }
    else{
        parent.insertBefore(newElement,targetElement.nextSibling);
    }
}
function getPageScroll(){
    var yScroll;
    if (self.pageYOffset) {
        yScroll = self.pageYOffset;
    } else if (document.documentElement && document.documentElement.scrollTop){
        yScroll = document.documentElement.scrollTop;
    } else if (document.body) {
        yScroll = document.body.scrollTop;
    }
    arrayPageScroll = new Array('',yScroll)
    return arrayPageScroll;
}
function getPageSize(){
    var xScroll,yScroll;
    if (window.innerHeight && window.scrollMaxY){
        xScroll = document.body.scrollWidth;
        yScroll = window.innerHeight + window.scrollMaxY;
    } else if (document.body.scrollHeight > document.body.offsetHeight){
        sScroll = document.body.scrollWidth;
        yScroll = document.body.scrollHeight;
    } else {
        xScroll = document.body.offsetWidth;
        yScroll = document.body.offsetHeight;
    }
    var windowWidth,windowHeight;
    if (self.innerHeight) {
        windowWidth = self.innerWidth;
        windowHeight = self.innerHeight;
    } else if (document.documentElement && document.documentElement.clientHeight) {
        windowWidth = document.documentElement.clientWidth;
        windowHeight = document.documentElement.clientHeight;
    } else if (document.body) {
        windowWidth = document.body.clientWidth;
        windowHeight = document.body.clientHeight;
    }
    var pageWidth,pageHeight
    if(yScroll < windowHeight){
        pageHeight = windowHeight;
    } else {
        pageHeight = yScroll;
    }
    if(xScroll < windowWidth) {
        pageWidth = windowWidth;
    } else {
        pageWidth = xScroll;
    }
    arrayPageSize = new Array(pageWidth,pageHeight,windowWidth,windowHeight)
    return arrayPageSize;
}
//-->