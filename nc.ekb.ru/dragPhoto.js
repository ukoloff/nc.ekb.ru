function defPosition(event) {
 if(document.attachEvent)	// Internet Explorer & Opera
  return {    
   x: window.event.clientX + document.documentElement.scrollLeft + document.body.scrollLeft,
   y: window.event.clientY + document.documentElement.scrollTop + document.body.scrollTop
  };
 if(!document.attachEvent && document.addEventListener)	// Gecko
  return {x: event.clientX + window.scrollX, y: event.clientY + window.scrollY};
}

function onDown(obj, event)
{
 event = event || window.event;
 obj.Delta=defPosition(event);
 obj.Delta.x-=obj.offsetLeft;//parseInt(obj.style.left);
 obj.Delta.y-=obj.offsetTop; //parseInt(obj.style.top);
 obj.isMoving=!obj.isMoving;
 obj.style.borderStyle=obj.isMoving?'groove':'ridge';
// obj.style.backgroundColor=obj.isMoving?'green':'red';
}

function onMove(obj, event) {
 if(!obj.isMoving) return;
 event = event || window.event;
 var Pos=defPosition(event);
 obj.style.left = Pos.x-obj.Delta.x;
 obj.style.top  = Pos.y-obj.Delta.y;
}

//--[EOF]---------------------------------------------------------------
