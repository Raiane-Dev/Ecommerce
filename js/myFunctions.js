window.requestAnimFrame = (function(){
    'use strict';

    return  window.requestAnimationFrame       ||
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame    ||
            function( callback ){
              window.setTimeout(callback, 1000 / 60);
            };
  })();

  
var pointerDownName = 'MSPointerDown';
  var pointerUpName = 'MSPointerUp';
  var pointerMoveName = 'MSPointerMove';

  if(window.PointerEvent) {
    pointerDownName = 'pointerdown';
    pointerUpName = 'pointerup';
    pointerMoveName = 'pointermove';
  }

  // Simple way to check if some form of pointerevents is enabled or not
  window.PointerEventsSupport = false;
  if(window.PointerEvent || window.navigator.msPointerEnabled) {
    window.PointerEventsSupport = true;
  }
  
function SwipeRevealItem(element) {
    'use strict';

    // Gloabl state variables
    var STATE_DEFAULT = 1;
    var STATE_LEFT_SIDE = 2;
    var STATE_RIGHT_SIDE = 3;

    var swipeFrontElement = element.querySelector('.swipe-front');
    var isAnimating = false;
    var initialTouchPos = null;
    var lastTouchPos = null;
    var currentXPosition = 0;
    var currentState = STATE_DEFAULT;
    var handleSize = 10;

    // Perform client width here as this can be expensive and doens't
    // change until window.onresize
    var itemWidth = swipeFrontElement.clientWidth;
    var slopValue = itemWidth * (1/4);

    // On resize, change the slop value
    this.resize = function() {
      itemWidth = swipeFrontElement.clientWidth;
      slopValue = itemWidth * (1/4);
    };

    
// Handle the start of gestures
    this.handleGestureStart = function(evt) {
      evt.preventDefault();

      if(evt.touches && evt.touches.length > 1) {
        return;
      }

      // Add the move and end listeners
      if (window.PointerEventsSupport) {
        // Pointer events are supported.
        document.addEventListener(pointerMoveName, this.handleGestureMove, true);
        document.addEventListener(pointerUpName, this.handleGestureEnd, true);
      } else {
        // Add Touch Listeners
        document.addEventListener('touchmove', this.handleGestureMove, true);
        document.addEventListener('touchend', this.handleGestureEnd, true);
        document.addEventListener('touchcancel', this.handleGestureEnd, true);

        // Add Mouse Listeners
        document.addEventListener('mousemove', this.handleGestureMove, true);
        document.addEventListener('mouseup', this.handleGestureEnd, true);
      }

      initialTouchPos = getGesturePointFromEvent(evt);

      swipeFrontElement.style.transition = 'initial';
    }.bind(this);
    
// Handle move gestures
    this.handleGestureMove = function (evt) {
      evt.preventDefault();

      lastTouchPos = getGesturePointFromEvent(evt);

      if(isAnimating) {
        return;
      }

      isAnimating = true;

      window.requestAnimFrame(onAnimFrame);
    }.bind(this);

    
// Handle end gestures
    this.handleGestureEnd = function(evt) {
      evt.preventDefault();

      if(evt.touches && evt.touches.length > 0) {
        return;
      }

      isAnimating = false;

      // Remove Event Listeners
      if (window.PointerEventsSupport) {
        // Remove Pointer Event Listeners
        document.removeEventListener(pointerMoveName, this.handleGestureMove, true);
        document.removeEventListener(pointerUpName, this.handleGestureEnd, true);
      } else {
        // Remove Touch Listeners
        document.removeEventListener('touchmove', this.handleGestureMove, true);
        document.removeEventListener('touchend', this.handleGestureEnd, true);
        document.removeEventListener('touchcancel', this.handleGestureEnd, true);

        // Remove Mouse Listeners
        document.removeEventListener('mousemove', this.handleGestureMove, true);
        document.removeEventListener('mouseup', this.handleGestureEnd, true);
      }

      updateSwipeRestPosition();
    }.bind(this);
    
function updateSwipeRestPosition() {
      var differenceInX = initialTouchPos.x - lastTouchPos.x;
      currentXPosition = currentXPosition - differenceInX;

      // Go to the default state and change
      var newState = STATE_DEFAULT;

      // Check if we need to change state to left or right based on slop value
      if(Math.abs(differenceInX) > slopValue) {
        if(currentState === STATE_DEFAULT) {
          if(differenceInX > 0) {
            newState = STATE_LEFT_SIDE;
          } else {
            newState = STATE_RIGHT_SIDE;
          }
        } else {
          if(currentState === STATE_LEFT_SIDE && differenceInX > 0) {
            newState = STATE_DEFAULT;
          } else if(currentState === STATE_RIGHT_SIDE && differenceInX < 0) {
            newState = STATE_DEFAULT;
          }
        }
      } else {
        newState = currentState;
      }

      changeState(newState);

      swipeFrontElement.style.transition = 'all 300ms ease-out';
    }

    function changeState(newState) {
      var transformStyle;
      switch(newState) {
        case STATE_DEFAULT:
          currentXPosition = 0;
          break;
        case STATE_LEFT_SIDE:
          currentXPosition = -(itemWidth - handleSize);
          break;
        case STATE_RIGHT_SIDE:
          currentXPosition = itemWidth - handleSize;
          break;
      }

      transformStyle = 'translateX('+currentXPosition+'px)';

      swipeFrontElement.style.msTransform = transformStyle;
      swipeFrontElement.style.MozTransform = transformStyle;
      swipeFrontElement.style.webkitTransform = transformStyle;
      swipeFrontElement.style.transform = transformStyle;

      currentState = newState;
    }

    function getGesturePointFromEvent(evt) {
      var point = {};

      if(evt.targetTouches) {
        console.log(evt.targetTouches[0]);
        point.x = evt.targetTouches[0].clientX;
        point.y = evt.targetTouches[0].clientY;
      } else {
        // Either Mouse event or Pointer Event
        point.x = evt.clientX;
        point.y = evt.clientY;
      }

      return point;
    }

    function onAnimFrame() {
      if(!isAnimating) {
        return;
      }

      var differenceInX = initialTouchPos.x - lastTouchPos.x;

      var newXTransform = (currentXPosition - differenceInX)+'px';
      var transformStyle = 'translateX('+newXTransform+')';
      swipeFrontElement.style['-webkit-transform'] = transformStyle;
      swipeFrontElement.style['-moz-transform'] = transformStyle;
      swipeFrontElement.style.transform = transformStyle;

      isAnimating = false;
    }

    
// Check if pointer events are supported.
    if (window.PointerEventsSupport) {
      // Add Pointer Event Listener
      swipeFrontElement.addEventListener(pointerDownName, this.handleGestureStart, true);
    } else {
      // Add Touch Listener
      swipeFrontElement.addEventListener('touchstart', this.handleGestureStart, true);

      // Add Mouse Listener
      swipeFrontElement.addEventListener('mousedown', this.handleGestureStart, true);
    }
    
}

  var swipeRevealItems = [];

  window.onload = function () {
    'use strict';
    var swipeRevealItemElements = document.querySelectorAll('.swipe-element');
    for(var i = 0; i < swipeRevealItemElements.length; i++) {
      swipeRevealItems.push(new SwipeRevealItem(swipeRevealItemElements[i]));
    }

    // We do this so :active pseudo classes are applied.
    window.onload = function() {
      if(/iP(hone|ad)/.test(window.navigator.userAgent)) {
        document.body.addEventListener('touchstart', function() {}, false);
      }
    };
  };

  window.onresize = function () {
    'use strict';
    for(var i = 0; i < swipeRevealItems.length; i++) {
      swipeRevealItems[i].resize();
    }
  };

  var swipeFronts = document.querySelectorAll('.swipe-front');
  for(var i = 0; i < swipeFronts.length; i++) {
    swipeFronts[i].addEventListener('touchstart', registerInteraction);
  }

    
    
    const tabDescricao = document.getElementById('tab-descricao');
    const tabAvaliacao = document.getElementById('tab-avaliacao');
    const conteudoDescricao = document.getElementById('conteudo-descricao');
    const conteudoAvaliacao = document.getElementById('conteudo-avaliacao');

    document.addEventListener("DOMContentLoaded", function(event) {
        conteudoDescricao.style.display = "block";
        tabDescricao.classList.add("active");
        conteudoAvaliacao.style.display = "none";
    });
    tabAvaliacao.addEventListener('click', (e)=>{
        conteudoDescricao.style.display = "none";
        conteudoAvaliacao.style.display = "block";
        tabAvaliacao.classList.add("active");
        tabDescricao.classList.remove("active");
    })
    tabDescricao.addEventListener('click', (e)=>{
        conteudoDescricao.style.display = "block";
        conteudoAvaliacao.style.display = "none";
        tabAvaliacao.classList.remove("active");
        tabDescricao.classList.add("active");
    });