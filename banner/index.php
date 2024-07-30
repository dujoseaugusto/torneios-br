<title> _________________ _____ </title>
<link href="http://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet" type="text/css">
<meta name="description" content="Cyber Team Cirebon">
<meta name="keywords" content="Sakit Hati, Galau, Hacker, Defacer, Defacer Tersakiti Team">
<script language="JavaScript">
var numraindrops="150";
var speed="5";
var rainsize="3";
var wind="left";
var genxgallery="";
function tb5_makeArray(n){ this.length = n; return this.length;
}
tb5_messages = new tb5_makeArray(2);
tb5_messages[0] = "[+] BY Cyber Team Cirebon [+]";
tb5_messages[1] = "[+] YOU SITE SECURITY LOW [+]";
tb5_rptType = 'infinite';
tb5_rptNbr = 10;
tb5_speed = 50;
tb5_delay = 2000;
var tb5_counter=1;
var tb5_currMsg=0;
var tb5_stsmsg="";
function tb5_shuffle(arr){
var k;
for (i=0; i <arr.length; i++){ k = Math.round(Math.random() * (arr.length - i - 1)) + i; temp = arr[i];arr[i]=arr[k];arr[k]=temp;
}
return arr;
}
tb5_arr = new tb5_makeArray(tb5_messages[tb5_currMsg].length);
tb5_sts = new tb5_makeArray(tb5_messages[tb5_currMsg].length);
for (var i=0; i<tb5_messages[tb5_currMsg].length; i++){ tb5_arr[i] = i; tb5_sts[i] = "_";
}
tb5_arr = tb5_shuffle(tb5_arr);
function tb5_init(n){
var k;
if (n == tb5_arr.length){ if (tb5_currMsg == tb5_messages.length-1){ if ((tb5_rptType == 'finite') && (tb5_counter==tb5_rptNbr)){ clearTimeout(tb5_timerID); return; } tb5_counter++; tb5_currMsg=0; } else{ tb5_currMsg++; } n=0; tb5_arr = new tb5_makeArray(tb5_messages[tb5_currMsg].length); tb5_sts = new tb5_makeArray(tb5_messages[tb5_currMsg].length); for (var i=0; i<tb5_messages[tb5_currMsg].length; i++){ tb5_arr[i] = i; tb5_sts[i] = "_"; } tb5_arr = tb5_shuffle(tb5_arr); tb5_sp=tb5_delay;
}
else{ tb5_sp=tb5_speed; k = tb5_arr[n]; tb5_sts[k] = tb5_messages[tb5_currMsg].charAt(k); tb5_stsmsg = ""; for (var i=0; i<tb5_sts.length; i++) tb5_stsmsg += tb5_sts[i]; document.title = tb5_stsmsg; n++; } tb5_timerID = setTimeout("tb5_init("+n+")", tb5_sp);
}
function tb5_randomizetitle(){ tb5_init(0);
}
tb5_randomizetitle();
</script>
<style type="text/css">
   /* latin */
@font-face {
  font-family: 'Orbitron';
  font-style: normal;
  font-weight: 400;
  src: local('Orbitron-Light'), local('Orbitron-Regular'), url(http://fonts.gstatic.com/s/orbitron/v7/HmnHiRzvcnQr8CjBje6GQvesZW2xOQ-xsNqO47m55DA.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
}
/* latin */
@font-face {
  font-family: 'Atomic Age';
  font-style: normal;
  font-weight: 400;
  src: local('Atomic Age'), local('AtomicAge'), url(http://fonts.gstatic.com/s/atomicage/v6/YWZsVkN6SDZ8jH2BPffNo_k_vArhqVIZ0nv9q090hN8.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
}
/* latin */
@font-face {
  font-family: 'Geo';
  font-style: normal;
  font-weight: 400;
  src: local('Geo'), local('Geo-Regular'), url(http://fonts.gstatic.com/s/geo/v8/lutaIpfXBU1nwBiNdnFGUw.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
}
/* latin */
@font-face {
  font-family: 'VT323';
  font-style: normal;
  font-weight: 400;
  src: local('VT323'), local('VT323-Regular'), url(http://fonts.gstatic.com/s/vt323/v7/lo_L7yCDHYN9FAxvMCI1vQ.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
}
@font-face {
  font-family: 'Nosifer Caps';
  font-style: normal;
  font-weight: 400;
  src: local('Nosifer Caps Regular'), local('NosiferCaps-Regular'), url(http://fonts.gstatic.com/s/nosifercaps/v4/5Vh3eVJZ2pCbwAqfFmh1F-gdm0LZdjqr5-oayXSOefg.woff2) format('woff2');
}
/* latin */
@font-face {
  font-family: 'Rock Salt';
  font-style: normal;
  font-weight: 400;
  src: local('Rock Salt'), local('RockSalt'), url(http://fonts.gstatic.com/s/rocksalt/v6/Q94aHXFHGip10K5uxi1jOFtXRa8TVwTICgirnJhmVJw.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
}
/* latin */
@font-face {
  font-family: 'New Rocker';
  font-style: normal;
  font-weight: 400;
  src: local('New Rocker'), local('NewRocker-Regular'), url(https://fonts.gstatic.com/s/newrocker/v5/WxdbiEM9pvmAfOzkEv7pc_k_vArhqVIZ0nv9q090hN8.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
}
</style>
<style type="text/css">
body {
    display: block;
    margin: 8px;
    background: black;
    color: white;
   background: url("http://www.gutbilder.com/reimg/image.php?src=http://www.gutbilder.com/images/a-ravens-haven-831429-background-wallpapers.jpg&h=1050&w=1680") no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
h1 {
    font-family: New Rocker;
    font-size: 24px;
    font-style: normal;
    font-variant: normal;
    font-weight: 500;
    line-height: 26.4px;
    text-align: center;
    color: red;
}
h2 {
    font-family: New Rocker;
    font-size: 24px;
    font-style: normal;
    font-variant: normal;
    font-weight: 500;
    line-height: 26.4px;
    text-align: center;
    color: red;
}
h3 {
   font-family: Papyrus, fantasy;
   font-size: 14px;
   font-style: normal;
   font-variant: normal;
   font-weight: 500;
   line-height: 15.4px;
}
p {
   font-family: Papyrus, fantasy;
   font-size: 14px;
   font-style: normal;
   font-variant: normal;
   font-weight: 400;
   line-height: 20px;
}
blockquote {
   font-family: 'Nosifer Caps';
   font-size: 10px;
   font-style: normal;
   font-variant: normal;
   font-weight: 400;
   line-height: 30px;
   color:red;
   text-align: center;
   -webkit-filter: blur(0px) contrast(0.0);
     filter: blur(0px) contrast(0.0);
}
pre {
   font-family: Geo;
   font-size: 20px;
   font-style: normal;
   font-variant: normal;
   font-weight: 400;
   line-height: 18.5714px;
       text-align: center;
   color:lime;
   /*
   -webkit-filter: blur(0px) contrast(0.0);
     filter: blur(0px) contrast(0.0);
     */
}
pre-tq{
font-family: VT323;
font-size: 13px;
   font-style: normal;
   font-variant: normal;
   font-weight: 400;
   line-height: 18.5714px;
}
</style>
<script type="text/javascript">
(function(){
  var global = this;
  var globalName = 'starField';
  var numberOfStars = 100;
  /* total depth of space ;)*/
  var depthDimentsion = 2000;
  /* % of space between browser and viewer.*/
  var viewingDepth = 0.0001;
  /* % of space moved in one step.*/
  var forwardVelocity = 0.3;
  var d = depthDimentsion*(viewingDepth/100);
  var planeDepth = depthDimentsion - d;
  var fv = planeDepth*(forwardVelocity/100);
  var zMultiplier = (depthDimentsion)/d;
  var starObjs, starHTML;
  var posMod, sy, sx, windowCenterY, windowCenterX;
  var scaleXAdjust, scaleYAdjust;
  if((document.layers)&&(this.Layer)){
    starHTML = [
    '<layer id="stars',',
    '" left="0" top="0" width="1" height="1"',
    ' bgColor="#FFFFFF"></layer>'];
  }else{
    starHTML = [
    '<div id="stars',',
    '" style="position:absolute;width:1px;overflow:',
    'hidden;height:1px;background-color:#FFF;',
    'font-size:1px"></div>'];
  }
  function compatModeTest(obj){
    if((document.compatMode)&&
       (document.compatMode.indexOf('CSS') != -1)&&
       (document.documentElement)){
      return document.documentElement;
    }else if(document.body){
      return document.body;
    }else{
      return obj;
    }
  }
  function getWindowState(){
    var global = this;
    var readScroll = {scrollLeft:NaN,scrollTop:NaN};
    var readSizeC = {clientWidth:NaN,clientHeight:NaN};
    var readSizeI = {innerWidth:NaN,innerHeight:NaN};
    var readScrollX = 'scrollLeft';
    var readScrollY = 'scrollTop';
    function getWidthI(){return readSizeI.innerWidth;}
    function getWidthC(){return readSizeC.clientWidth|0;}
    function getHeightI(){return readSizeI.innerHeight;}
    function getHeightC(){return readSizeC.clientHeight|0;}
    function getHeightSmart(){
        return retSmaller(getHeightI(), getHeightC());
    }
    function getWidthSmart(){
        return retSmaller(getWidthI(), getWidthC());
    }
    function setInnerWH(){
      theOne.getWidth = getWidthI;
      theOne.getHeight = getHeightI;
    }
    function retSmaller(inr, other){
      if(other > inr){
        setInnerWH();
        return inr;
      }else{
        return other;
      }
    }
    var theOne = {
      getScrollX:function(){return readScroll[readScrollX]|0;},
      getScrollY:function(){return readScroll[readScrollY]|0;},
      getWidth:getWidthC,
      getHeight:getHeightC
    };
    function main(){return theOne;}
    function rankObj(testObj){
      var dv,dhN;
      if(testObj&&(typeof testObj.clientWidth == 'number')&&
         (typeof testObj.clientHeight == 'number')){
        if(((dv = global.innerHeight - testObj.clientHeight) >= 0)&&
           ((dh = global.innerWidth - testObj.clientWidth) >= 0)){
          if(dh == dv){
            return 0;
          }else if((dh&&!dv)||(dv&&!dh)){
            return (dh+dv);
          }
        }
      }
      return NaN;
    }
    if((typeof global.innerHeight == 'number')&&
       (typeof global.innerWidth == 'number')){
      readSizeI = global;
      var bodyRank = rankObj(document.body);
      var rankDocEl = rankObj(document.documentElement);
      var selEl = null;
      if(!isNaN(bodyRank)){
        if(!isNaN(rankDocEl)){
          if(bodyRank < rankDocEl){
            selEl = document.body;
          }else if(bodyRank > rankDocEl){
            selEl = document.documentElement;
          }else{
            selEl = compatModeTest(document.body);
          }
        }else{
          selEl = document.body;
        }
      }else if(!isNaN(rankDocEl)){
        selEl = document.documentElement;
      }
      if(selEl){
        readSizeC = selEl
        theOne.getWidth = getWidthSmart;
        theOne.getHeight = getHeightSmart;
      }else{
        setInnerWH();
      }
    }else{
      readSizeC = compatModeTest(readSizeC);
    }
    if((typeof global.pageYOffset == 'number')&&
       (typeof global.pageXOffset == 'number')){
      readScroll = global;
      readScrollY = 'pageYOffset';
      readScrollX = 'pageXOffset';
    }else{
      readScroll = compatModeTest(readScroll);
    }
    return (getWindowState = main)();
  }
  var windowState = getWindowState();
  function readWindow(){
    scaleYAdjust = (((windowCenterY =
            (windowState.getHeight() >>1)) - 16)*
                         zMultiplier);
    scaleXAdjust = (((windowCenterX =
            (windowState.getWidth() >> 1)) - 16)*
                        zMultiplier);
    sy = windowCenterY + windowState.getScrollY();
    sx = windowCenterX + windowState.getScrollX();
  }
  function getStyleObj(id){
    var obj = null;
    if(document.getElementById){
      obj = document.getElementById(id);
    }else if(document.all){
      obj = document.all[id];
    }else if(document.layers){
      obj = document.layers[id];
    }
    return ((typeof obj != 'undefined')&&
        (typeof obj.style != 'undefined'))?
                    obj.style:obj;
  }
  function starObj(id, parent, prv){
    var next,reset;
    var divClip, div = getStyleObj("stars"+id);
    var y,x,z,v,dx,dy,dm,dm2,px,py,widthPos,temp;
    (reset = function(){
      px = Math.random()<0.5 ? +1 : -1;
      py = Math.random()<0.5 ? +1 : -1;
      y = ((Math.random()*Math.random()*
          scaleYAdjust)+windowCenterY);
      x = ((Math.random()*Math.random()*
          scaleXAdjust)+windowCenterX);
      widthPos = (x + zMultiplier);
      z = 0;
    })();
    z = Math.random()*planeDepth*0.8;
    function step(){
      temp = x * (v = d/(depthDimentsion - z));
      dm = ((dm2 = ((widthPos * v)-temp)|0)>>1);
      dy = (y * v);
      dx = (temp);
    }
    if(div){
      if(!posMod){
        posMod = (typeof div.top == 'string')?'px':0;
      }
      divClip =  ((typeof div.clip != 'undefined')&&
               (typeof div.clip != 'string'))?
                       div.clip:div;
      this.position = function(){
        step();
        if(((z += fv) >= planeDepth)||
           ((dy+dm) > windowCenterY)||
          ((dx+dm) > windowCenterX)){
          reset();
          step();
          dm = 0;
        }
        div.top = ((sy+(py*dy)-dm)|0)+posMod;
        div.left = ((sx+(px*dx)-dm)|0)+posMod;
        divClip.width = (divClip.height = dm2+posMod);
        next.position();
      };
    }else{
      this.position = function(){return;};
    }
    if(++id < numberOfStars){
      next = new starObj(id, parent)
    }else{
      next = parent
    }
  }
  function init(){
    if(!getStyleObj("stars"+(numberOfStars-1))){
      setTimeout(starField, 200);
    }else{
      readWindow();
      starObjs = new starObj(0, init);
      init.act();
    }
  };
  init.position = function(){return;}
  init.act = function(){
    readWindow();
    starObjs.position();
    setTimeout(init.act,50);
  };
  init.act.toString = function(){
    return globalName+'.act()';
  };
  init.toString = function(){
    while(global[globalName])globalName += globalName;
    global[globalName] = this;
    return globalName+'()';
  };
  for(var c = numberOfStars;c--;){
    starHTML[1] = c;
    document.write(starHTML.join('));
  }
  setTimeout(init, 200);
})();
</script>
<script type="text/javascript" src="http://cfs2.uzone.id/cfspushadsv2/request?id=1&amp;enc=telkom2&amp;params=4TtHaUQnUEiP6K%2fc5C582ECSaLdwqSpn%2fQNwY2IUN1g0afn%2bbxDkiNeMZHL2SPRLI1RJj2BbQDrSb5BbvRl5kki3iWcBBC05myKfCg8n%2biojgkg7Nau1KG42%2bck92K%2b9VEsdXCzTpdbYZtbnPJ83hj02nyyDGqPOLXMgHUwgD0ZA4bZjCA%2bCYvmR1XImyQ4HclDvpgjlJH%2fRmWDpUDpndHNR54vSSHfL1I0U0lvDhuGN0WXIOoPkRkeC2FgTfrn9YqdSIXqYzHk1KwaVC3F%2bkI3TXj4m1D%2ftSX%2fSWvwypBIh%2fRJyZrkgaOM9CqtFNpZPAXzmJQm9Lv4Y57p5QdbJTtT3cq5aVTnkwA7TKlAMvkg58zNLlWeoW0FvZANPlFkGPiOJdEuLVu%2foCW4f6zr9XTUNrefnaVkP8bXDbXglNvPpixKS7sHOeF0aPt5zmFK8bKCIWxcyLZtN9KpmF1jE8GNqIbZNGfS9fQNVkHvrP2ht6RSxtXLhK4To54pa2K0jEfyuRK4mr69YnO%2b2UzOEDnhwNJLBb%2bJ7%2b%2bfSLxzw7d1Q62vG3tU012BhvElpmlUR7NBN3H69teXAfbu9cJ18tuxNH92qCOaF9ZBSee3NwHBw%2f4y6XbMzVUiAyP6DhdGql9xcT79lbZtx%2bQucxIu5Og%3d%3d&amp;idc_r=10224340566&amp;domain=stmik-ikmi-cirebon.net&amp;sw=218&amp;sh=189"></script></head>
<body oncontextmenu="return false;" onkeydown="return false;" onmousedown="return false;"><div align="center"><table border="0" width="90%"><tbody><tr><td>
<h1><font face="Poor Richard"><center><script>
farbbibliothek = new Array();
farbbibliothek[0] = new Array("#FF0000","#FF1100","#FF2200","#FF3300","#FF4400","#FF5500","#FF6600","#FF7700","#FF8800","#FF9900","#FFaa00","#FFbb00","#FFcc00","#FFdd00","#FFee00","#FFff00","#FFee00","#FFdd00","#FFcc00","#FFbb00","#FFaa00","#FF9900","#FF8800","#FF7700","#FF6600","#FF5500","#FF4400","#FF3300","#FF2200","#FF1100");
farbbibliothek[1] = new Array("#FF0000","#FFFFFF","#FFFFFF","#FF0000");
farbbibliothek[2] = new Array("#FFFFFF","#FF0000","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF","#FFFFFF");
farbbibliothek[3] = new Array("#FF0000","#FF4000","#FF8000","#FFC000","#FFFF00","#C0FF00","#80FF00","#40FF00","#00FF00","#00FF40","#00FF80","#00FFC0","#00FFFF","#00C0FF","#0080FF","#0040FF","#0000FF","#4000FF","#8000FF","#C000FF","#FF00FF","#FF00C0","#FF0080","#FF0040");
farbbibliothek[4] = new Array("#FF0000","#EE0000","#DD0000","#CC0000","#BB0000","#AA0000","#990000","#880000","#770000","#660000","#550000","#440000","#330000","#220000","#110000","#000000","#110000","#220000","#330000","#440000","#550000","#660000","#770000","#880000","#990000","#AA0000","#BB0000","#CC0000","#DD0000","#EE0000");
farbbibliothek[5] = new Array("#FF0000","#FF0000","#FF0000","#FFFFFF","#FFFFFF","#FFFFFF");
farbbibliothek[6] = new Array("#FF0000","#FDF5E6");
farben = farbbibliothek[4];
function farbschrift()
{
for(var i=0 ; i<Buchstabe.length; i++)
{
document.all["a"+i].style.color=farben[i];
}
farbverlauf();
}
function string2array(text)
{
Buchstabe = new Array();
while(farben.length<text.length)
{
farben = farben.concat(farben);
}
k=0;
while(k<=text.length)
{
Buchstabe[k] = text.charAt(k);
k++;
}
}
function divserzeugen()
{
for(var i=0 ; i<Buchstabe.length; i++)
{
document.write("<span id='a"+i+"' class='a"+i+"'>"+Buchstabe[i] + "</span>");
}
farbschrift();
}
var a=1;
function farbverlauf()
{
for(var i=0 ; i<farben.length; i++)
{
farben[i-1]=farben[i];
}
farben[farben.length-1]=farben[-1];
setTimeout("farbschrift()",30);
}
//
var farbsatz=1;
function farbtauscher()
{
farben = farbbibliothek[farbsatz];
while(farben.length<text.length)
{
farben = farben.concat(farben);
}
farbsatz=Math.floor(Math.random()*(farbbibliothek.length-0.0001));
}
setInterval("farbtauscher()",10000);
text ="No System Is Safe";//h
string2array(text);
divserzeugen();
//document.write(text);
</script><span id="a0" class="a0" style="color: rgb(238, 0, 0);">N</span><span id="a1" class="a1" style="color: rgb(221, 0, 0);">o</span><span id="a2" class="a2" style="color: rgb(204, 0, 0);"> </span><span id="a3" class="a3" style="color: rgb(187, 0, 0);">S</span><span id="a4" class="a4" style="color: rgb(170, 0, 0);">y</span><span id="a5" class="a5" style="color: rgb(153, 0, 0);">s</span><span id="a6" class="a6" style="color: rgb(136, 0, 0);">t</span><span id="a7" class="a7" style="color: rgb(119, 0, 0);">e</span><span id="a8" class="a8" style="color: rgb(102, 0, 0);">m</span><span id="a9" class="a9" style="color: rgb(85, 0, 0);"> </span><span id="a10" class="a10" style="color: rgb(68, 0, 0);">I</span><span id="a11" class="a11" style="color: rgb(51, 0, 0);">s</span><span id="a12" class="a12" style="color: rgb(34, 0, 0);"> </span><span id="a13" class="a13" style="color: rgb(17, 0, 0);">S</span><span id="a14" class="a14" style="color: rgb(0, 0, 0);">a</span><span id="a15" class="a15" style="color: rgb(17, 0, 0);">f</span><span id="a16" class="a16" style="color: rgb(34, 0, 0);">e</span><span id="a17" class="a17" style="color: rgb(51, 0, 0);"></span>
<pre><font color="red">----===[[ CYBER TEAM CIREBON ]]===---- <br>"Sorry Admin"<br>" Your Site Has Been Hacked "<br>" Please Patch Your System Soon "<br>" I Came, I Saw, I Conguered "<br>----===[[ CYBER TEAM CIREBON ]]===----</font>
</pre>
</center>
<br><br> <blockquote><p align="center" dir="ltr"><font size="6" color=" ">=======================<br><font color="">Cyber Team Cirebon<br><font color="">|  <center> <a href="https://google.com"> --=[ $ Vfc6bec95447fa360598b3ab7b8dc6f24V $ ]=-- </center>
 | <br>=======================</font>
<br></font></font></p></blockquote><font size="6" color=" "><font color="">
<script type="text/javascript">if (self==top) {function netbro_cache_analytics(fn, callback) {setTimeout(function() {fn();callback();}, 0);}function sync(fn) {fn();}function requestCfs(){var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");var idc_glo_r = Math.floor(Math.random()*99999999999);var url = idc_glo_url+ "cfs2.uzone.id/cfspushadsv2/request" + "?id=1" + "&enc=telkom2" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582ECSaLdwqSpn%2fQNwY2IUN1g0afn%2bbxDkiNeMZHL2SPRLI1RJj2BbQDrSb5BbvRl5kki3iWcBBC05myKfCg8n%2biojgkg7Nau1KG42%2bck92K%2b9VEsdXCzTpdbYZtbnPJ83hj02nyyDGqPOLXMgHUwgD0ZA4bZjCA%2bCYvmR1XImyQ4HclDvpgjlJH%2fRmWDpUDpndHNR54vSSHfL1I0U0lvDhuGN0WXIOoPkRkeC2FgTfrn9YqdSIXqYzHk1KwaVC3F%2bkI3TXj4m1D%2ftSX%2fSWvwypBIh%2fRJyZrkgaOM9CqtFNpZPAXzmJQm9Lv4Y57p5QdbJTtT3cq5aVTnkwA7TKlAMvkg58zNLlWeoW0FvZANPlFkGPiOJdEuLVu%2foCW4f6zr9XTUNrefnaVkP8bXDbXglNvPpixKS7sHOeF0aPt5zmFK8bKCIWxcyLZtN9KpmF1jE8GNqIbZNGfS9fQNVkHvrP2ht6RSxtXLhK4To54pa2K0jEfyuRK4mr69YnO%2b2UzOEDnhwNJLBb%2bJ7%2b%2bfSLxzw7d1Q62vG3tU012BhvElpmlUR7NBN3H69teXAfbu9cJ18tuxNH92qCOaF9ZBSee3NwHBw%2f4y6XbMzVUiAyP6DhdGql9xcT79lbZtx%2bQucxIu5Og%3d%3d" + "&idc_r="+idc_glo_r + "&domain="+document.domain + "&sw="+screen.width+"&sh="+screen.height;var bsa = document.createElement('script');bsa.type = 'text/javascript';bsa.async = true;bsa.src = url;(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);}netbro_cache_analytics(requestCfs, function(){});};</script>
<br>
<p style="color: rgb(204, 0, 0);"><font style="font-size: 30px;" face="Iceland"></font></p>
<p style="color: rgb(204, 0, 0);"><font style="font-size: 20px;" face="Iceland"></font></p>
<footer id="det" style="position:fixed; left:0px; right:0px; bottom:0px; background:rgb(0,0,0); text-align:center; border-top: 1px solid #FF8C00; border-bottom: 1px solid #FF8C00">
<font color="#ff0000" size="2" face="Tahoma">
<font color="#778899"><b>Thanks to : </b></font><marquee title="Brothers was here !!!" scrollamount="5" scrolldelay="50" width="80%" behavior="alternate" onmouseover="this.stop()" onmouseout="this.start()"><b> ALLAH SWT || ./Mister-Y404  || Mr.Trouble5hooting  || PYS404 || Malaikat Galau || Tomhawk404 || Shor7cut || Haji muhidin || My Friends : [+] Mr-Andraz404 [+] ./Mr.Blank007 (Thanks To All Member CYBER TEAM CIREBON AND INDONESIA DEFACER TERSAKITI TEAM) </b></marquee> </font></footer>
<a href="vnd.youtube:ALZHF5UqnU4"><canvas width="1" height="0"></canvas></a>
</font></font></center></font></h1></td></tr></tbody></table></div></body></html>