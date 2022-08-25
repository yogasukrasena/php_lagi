// JavaScript Document
//ini diambil dari scripnya linkshare.mungkin bisa berguna untuk yg add diklik, buka hal baru popup ^^
<script language="JavaScript">

function MM_goToURL() { //v2.0
 for (var i=0; i< (MM_goToURL.arguments.length - 1); i+=2) //with arg pairs
 eval(MM_goToURL.arguments[i]+".location='"+MM_goToURL.arguments[i+1]+"'");
document.MM_returnValue = false;}
function MM_openBrWindow(theURL,winName,features){
	window.open(theURL,winName,features);}
 
function leapto() {
   var myindex=document.myform.dest.options[document.myform.dest.selectedIndex].value ;
   if (myindex >=0  ) {
      window.location="http://alogin.linksynergy.com/php-bin/affiliate/join/scate.shtml?cate_id="+myindex + "&nid=1";
   } else { 
      window.location="http://alogin.linksynergy.com/php-bin/affiliate/join/scate.shtml?cate_id=-1$cpistr" ; 
   }
}
//javascript:MM_openBrWindow('http://alogin.linksynergy.com/php-bin/affiliate/join/sterm_nwin.shtml?act=apply&o_id=129986&nid=1','affiliate_nwin','scrollbars=yes,toolbar=yes,location=no,resize=yes,width=800,height=600') =>ini conto penggunaannya :D
</script>