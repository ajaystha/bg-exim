/*
   Deluxe Menu Data File
   Created by Deluxe Tuner v2.4
   http://deluxe-menu.com
*/


// -- Deluxe Tuner Style Names
var itemStylesNames=[];
var menuStylesNames=[];
// -- End of Deluxe Tuner Style Names

//--- Common
var isHorizontal=1;
var smColumns=1;
var smOrientation=0;
var smViewType=0;
var dmRTL=0;
var pressedItem=-2;
var itemCursor="pointer";
var itemTarget="";
var statusString="Apycom DHTML Menu";
var blankImage="menu.files/blank.gif";
var pathPrefix_img="";
var pathPrefix_link="";

//--- Dimensions
var menuWidth="500px";
var menuHeight="";
var smWidth="120px";
var smHeight="";

//--- Positioning
var absolutePos=0;
var posX="20px";
var posY="120px";
var topDX=0;
var topDY=0;
var DX=-5;
var DY=0;

//--- Font
var fontStyle="bolder 11px Verdana";
var fontColor=["#FFFFFF","#ffffff"];
var fontDecoration=["none","none"];
var fontColorDisabled="#AAAAAA";

//--- Appearance
var menuBackColor="";
var menuBackImage="";
var menuBackRepeat="repeat";
var menuBorderColor="";
var menuBorderWidth=0;
var menuBorderStyle="none";

//--- Item Appearance
var itemBackColor=["#E3740F","#0530FA"];
var itemBackImage=["",""];
var itemBorderWidth=0;
var itemBorderColor=["",""];
var itemBorderStyle=["none","none"];
var itemSpacing=1;
var itemPadding="5px";
var itemAlignTop="left";
var itemAlign="left";
var subMenuAlign="left";

//--- Icons
var iconTopWidth="";
var iconTopHeight="";
var iconWidth="";
var iconHeight="";
var arrowWidth="";
var arrowHeight="";
var arrowImageMain=["menu.files/arrow.GIF",""];
var arrowImageSub=["menu.files/arrow_r.gif",""];

//--- Separators
var separatorImage="menu.files/sep_grey.gif";
var separatorWidth="80%";
var separatorHeight="3px";
var separatorAlignment="center";
var separatorVImage="";
var separatorVWidth="5px";
var separatorVHeight="16px";
var separatorPadding="0px";

//--- Floatable Menu
var floatable=0;
var floatIterations=5;
var floatableX=1;
var floatableY=1;

//--- Movable Menu
var movable=0;
var moveWidth=12;
var moveHeight=24;
var moveColor="#AAAAAA";
var moveImage="menu.files/movepic2.gif";
var moveCursor="move";
var smMovable=0;
var closeBtnW=15;
var closeBtnH=15;
var closeBtn="";

//--- Transitional Effects & Filters
var transparency="90";
var transition=39;
var transOptions="bands=40, direction=down";
var transDuration=300;
var transDuration2=200;
var shadowLen=2;
var shadowColor="#C4C4C4";
var shadowTop=1;

//--- CSS Support (CSS-based Menu)
var cssStyle=0;
var cssSubmenu="";
var cssItem=["",""];
var cssItemText=["",""];

//--- Advanced
var dmObjectsCheck=0;
var saveNavigationPath=1;
var showByClick=0;
var noWrap=1;
var smShowPause=100;
var smHidePause=1000;
var smSmartScroll=1;
var topSmartScroll=0;
var smHideOnClick=1;
var dm_writeAll=0;

//--- AJAX-like Technology
var dmAJAX=0;
var dmAJAXCount=0;

//--- Dynamic Menu
var dynamic=1;

//--- Keystrokes Support
var keystrokes=0;
var dm_focus=1;
var dm_actKey=113;


var menuItems = [

    ["Home","index.php", "", "", "", "", "", "", "", ],
    ["Company","", "", "", "", "", "", "", "", ],
        ["|Company Profile","Company.php?id=1", "", "", "", "", "", "", "", ],
        ["|Show Room","Company.php?id=2", "", "", "", "", "", "", "", ],
        ["|Work Shop","Company.php?id=3", "", "", "", "", "", "", "", ],
        ["|Location Map","Company.php?id=4", "", "", "", "", "", "", "", ],
    ["Products","", "", "", "", "", "", "", "", ],
        ["|Handicrafts","", "", "", "", "", "", "", "", ],
            ["||Carpets","products.php?cid=50", "", "", "", "", "", "", "", ],
            ["||Pashminas","products.php?cid=51", "", "", "", "", "", "", "", ],
            ["||Jewelleries","", "", "", "", "", "", "", "", ],
                ["|||Brasslet","products.php?cid=52", "", "", "", "", "", "", "", ],
                ["|||Pendent","products.php?cid=53", "", "", "", "", "", "", "", ],
                ["|||Ear Rings","products.php?cid=54", "", "", "", "", "", "", "", ],
    ["Feedback","feedback.php", "", "", "", "", "", "", "", ],
    ["Contact Us","contact.php", "", "", "", "", "", "", "", ],
];

dm_init();