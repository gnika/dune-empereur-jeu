/**
 * ProgBar plugin 1.0
 * december 2011
 * 
 * jQuery and regular javascript code and idea by Idleman (http://blog.idleman.fr)
 * jQuery plugin by AkaiKen (http://lamecarlate.net) , for Idleman :3
 * 
 * 
 * HOWTO :
 * 
 * 1 . create a html element on your page, give it a class, or an id, as you wish
 * 2 . add jQuery.progbar.js and jQuery.progbar.css on your page (you know how to do that, don't you ?)
 * 3 . call ProgBar on this element : jQuery('your-elt').progBar(); 
 * 4 . enjoy the bubbles and color sweetness
 * 
 * OPTIONS :
 * 
 * - bubbles : 
 *  - active : do you want bubbles ? 
 *  - speed : how fast do you want bubbles ? (note : defining bubbles speed automatically
 *  active bubbles) default = 40
 * - progressSpeed : how fast do you want you progressbar to fill itself ? default = 40 (from 1 to 100) 
 * - activateReflection : do you want a shiny reflection ?
 *  - bg : on the background
 *  - progress : on the progressbar itself
 * - colorChange : do you want the progressbar to change color while it's filling ? 
 * - texts : if you want some texts to be displayed, provide an array of texts; 
 *  if you don't, call this option with an empty array
 * - progress : if you want to display the amout of progression (on 100)
 *  - display 
 *  - percentDisplay : if you want to display the % sign
 * - finishedMessage : if texts are not displayed, this one isn't, too
 *  - display : display a "finished" message
 *  - text : you can customize this message
 * 
 * 
 */
(function($) {
    $.fn.progBar = function(params) {
        
        var defaultTexts = new Array(
            "0h00",
            "06h00",
            "10h00",
            "12h00",
            "12h00",
            "16h00",
            "18h00",
            "20h00",
            "0h00"
            );
           
        // parametres par defaut
        params = $.extend({
            bubbles : {
                active : true,
                speed : 40
            },
            progressSpeed : 40,
			initBarre : 0,
            activateReflection : {
                bg : true, 
                progress : true
            },
            colorChange : true,
            texts : defaultTexts,
            progress : {
                display :true,
                percentDisplay : true
            },
            finishedMessage : {
                display : true,
                text : 'Termin&eacute; !'
            }
        }, params);
        
        // init
        var bubblesPosition = 0;
           
        this.each(function(){
            
            var t = jQuery(this);
              
            // add main class
            t.addClass('progBar');
            
            // building secondary markup...
            
            // background
            var bg = jQuery('<div class="progBarBg" />');
            t.html(bg);
            
			var value = params.initBarre; //init
            var timer = setInterval(function(){
                value = updateProgressBar(value, t, params, timer);
			})// joachim
			
            // reflection in background
            if(params.activateReflection.bg !== false){
                bg.append('<div class="progBarReflet" />');
            }              
              
            // colored bar (progression)
            var colors = jQuery('<div class="progBarColors" />');
            bg.append(colors);
            
            // bubbles
            if(params.bubbles.speed == 0){
                params.bubbles.speed = 1;
            }
            if(params.bubbles.speed > 100){
                params.bubbles.speed = 100;
            }
            var bubblesRepetition = 2000/params.bubbles.speed;
            if(params.bubbles.active !== false) {
                colors.addClass('progBarBubbles');
                setInterval(function(){
                    bubblesPosition = bubbles(t,bubblesPosition);
                },bubblesRepetition);
            }
            
            // reflection in progressionbar
            if(params.activateReflection.progress !== false){
                colors.append('<div class="progBarReflet" />');
            }
            
            // "x %" display
            if(params.progress.display !== false){
                var percentText = (params.progress.percentDisplay !== false) ? '%' : '';
                var progressText = '<div class="progBarProgression"><span class="qty">0</span><span class="unit">'+percentText+'</span></div>';
                bg.append(progressText);
            }
            
            // first text display
            if(params.texts != null && params.texts != "" && params.texts != {}){
                var text = '<div class="progBarText">'+params.texts[0]+'</div>';
                t.append(text);
            }
            
            if(params.progressSpeed == 0){
                params.progressSpeed = 1;
            }
            if(params.progressSpeed > 100){
                params.progressSpeed = 100;
            }
            var repetition = 5500/params.progressSpeed;
            
            // value is the percentage of progression, it will evolve
            var value = params.initBarre; //init
            var timer = setInterval(function(){
                value = updateProgressBar(value, t, params, timer);
            },repetition);

               
        });
           
    };
})(jQuery);

/**
 * this is the actual function, the one which does something
 * @param value : integer, the current value of progression
 * @param t : jQuery object, our targer
 * @param params : javascript object, all the plugin options 
 * @param timer : integer, timer created for the setInterval function 
 *  it's an argument so it's not a global variable (global variables are bad)
 *  and then we can launch the plugin more than once
 * @return value : integer, the updated value of progression
 */
function updateProgressBar(value, t, params, timer){
    
    // increment value (and stop timer eventually)
    value++;
    if(value>=100){
        clearInterval(timer);
    }
    
    // displays progression
    if(params.progress.display !== false){
        t.find('.progBarProgression').find('.qty').html(value);
    }
    
    // change bar size and colors
    if(params.colorChange !== false){
        var color = newColor(value);
        t.find('.progBarColors').css('background-color', '#'+color);
    }
    var barWidth = t.css('width');
   
    var progressionSize = (value*parseInt(barWidth))/100;
    t.find('.progBarColors').css("width",progressionSize+"px");
    
    // texts
    if(params.texts != null && params.texts != "" && params.texts != {}){
        var indice = textIndice(value, params.texts.length);
        t.find(".progBarText").html(params.texts[indice]+"&hellip;");
        if(params.finishedMessage.display == true && params.finishedMessage.text != ''){
            if(value == 99){
                var value = 0; //init
				
            }
        }
    }
    
    return value;
}

/**
 * return the line of text which will be displayed
 * @param percent : integer, the current value of progression
 * @param length : integer, the length of the text array (ergo the total number of texts)
 */
function textIndice(percent, length){
    return (percent != 100) ? Math.floor(length/100*percent) : length - 1;
}

/**
 * calculate the new color of the bar from the current value of progression
 * @param value : integer, the current value of progression
 * @param red, green, blue : integer ; currently not used as params, but could be
 * (feel free to test) 
 * @return integer, hexadecimal value
 */
function newColor(value, red, green, blue){
    var r = (typeof(red) == 'undefined') ? 200 : red;
    var g = (typeof(green) == 'undefined') ? 0 : green;
    var b = (typeof(blue) == 'undefined') ? 0 : blue;

    return rgb2hex(r-value,g+value*2,b+value/100);
}

/**
 * create bubbles motion
 * @param obj : a jQuery object, our target
 * @param bubblesPosition : integer, the current position of bubbles
 * @return bubblesPosition : integer, the new position
 */
function bubbles(obj,bubblesPosition){
    // recalculate bubbles position
    bubblesPosition--;
    bubblesPosition = (bubblesPosition == -150) ? 0 : bubblesPosition;
    
    // move bubbles
    obj.find('.progBarBubbles').css("background-position","0px "+bubblesPosition+"px");
    
    // return new position
    return bubblesPosition;
}

/**
 * convert three decimal values (red, green, blue) to one hexadecimal
 * @param r, g, b : integer
 * @return integer, an hexadecimal value
 */
function rgb2hex(r,g,b) {
    var hexVal = function(n) {
        var data = "0123456789ABCDEF";
        if (n==null) return "00";
        n=parseInt(n); 
        if (n==0 || isNaN(n)) return "00";
        n=Math.round(Math.min(Math.max(0,n),255));
        return data.charAt((n-n%16)/16) + data.charAt(n%16);
    }
    return hexVal(r)+hexVal(g)+hexVal(b);
    
}