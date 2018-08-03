!function(e,t){"function"==typeof define&&define.amd?define([],t):"object"==typeof exports?module.exports=t():e.sortable=t()}(this,function(){"use strict";var e,t,n,r=[],a=[],o=function(e,t,n){return void 0===n?e&&e.h5s&&e.h5s.data&&e.h5s.data[t]:(e.h5s=e.h5s||{},e.h5s.data=e.h5s.data||{},e.h5s.data[t]=n,void 0)},i=function(e){e.h5s&&delete e.h5s.data};switch(!0){case"matches"in window.Element.prototype:n="matches";break;case"mozMatchesSelector"in window.Element.prototype:n="mozMatchesSelector";break;case"msMatchesSelector"in window.Element.prototype:n="msMatchesSelector";break;case"webkitMatchesSelector"in window.Element.prototype:n="webkitMatchesSelector"}var s=function(e,t){if(!t)return Array.prototype.slice.call(e);for(var r=[],a=0;a<e.length;++a)"string"==typeof t&&e[a][n](t)&&r.push(e[a]),t.indexOf(e[a])!==-1&&r.push(e[a]);return r},l=function(e,t,n){if(e instanceof Array)for(var r=0;r<e.length;++r)l(e[r],t,n);else e.addEventListener(t,n),e.h5s=e.h5s||{},e.h5s.events=e.h5s.events||{},e.h5s.events[t]=n},d=function(e,t){if(e instanceof Array)for(var n=0;n<e.length;++n)d(e[n],t);else e.h5s&&e.h5s.events&&e.h5s.events[t]&&(e.removeEventListener(t,e.h5s.events[t]),delete e.h5s.events[t])},c=function(e,t,n){if(e instanceof Array)for(var r=0;r<e.length;++r)c(e[r],t,n);else e.setAttribute(t,n)},f=function(e,t){if(e instanceof Array)for(var n=0;n<e.length;++n)f(e[n],t);else e.removeAttribute(t)},p=function(e){var t=e.getClientRects()[0];return{left:t.left+window.scrollX,top:t.top+window.scrollY}},h=function(e){d(e,"dragstart"),d(e,"dragend"),d(e,"selectstart"),d(e,"dragover"),d(e,"dragenter"),d(e,"drop")},u=function(e){d(e,"dragover"),d(e,"dragenter"),d(e,"drop")},g=function(e,t){e.dataTransfer.effectAllowed="move",e.dataTransfer.setData("text",""),e.dataTransfer.setDragImage&&e.dataTransfer.setDragImage(t.draggedItem,t.x,t.y)},m=function(e,t){return t.x||(t.x=parseInt(e.pageX-p(t.draggedItem).left)),t.y||(t.y=parseInt(e.pageY-p(t.draggedItem).top)),t},v=function(e){return{draggedItem:e}},y=function(e,t){var n=v(t);n=m(e,n),g(e,n)},b=function(e){i(e),f(e,"aria-dropeffect")},E=function(e){f(e,"aria-grabbed"),f(e,"draggable"),f(e,"role")},w=function(e,t){return e===t||void 0!==o(e,"connectWith")&&o(e,"connectWith")===o(t,"connectWith")},x=function(e,t){var n,r=[];if(!t)return e;for(var a=0;a<e.length;++a)n=e[a].querySelectorAll(t),r=r.concat(Array.prototype.slice.call(n));return r},I=function(e){var t=o(e,"opts")||{},n=s(e.children,t.items),r=x(n,t.handle);u(e),b(e),d(r,"mousedown"),h(n),E(n)},A=function(e){var t=o(e,"opts"),n=s(e.children,t.items),r=x(n,t.handle);c(e,"aria-dropeffect","move"),c(r,"draggable","true");var a=(document||window.document).createElement("span");"function"!=typeof a.dragDrop||t.disableIEFix||l(r,"mousedown",function(){if(n.indexOf(this)!==-1)this.dragDrop();else{for(var e=this.parentElement;n.indexOf(e)===-1;)e=e.parentElement;e.dragDrop()}})},C=function(e){var t=o(e,"opts"),n=s(e.children,t.items),r=x(n,t.handle);c(e,"aria-dropeffect","none"),c(r,"draggable","false"),d(r,"mousedown")},S=function(e){var t=o(e,"opts"),n=s(e.children,t.items),r=x(n,t.handle);h(n),d(r,"mousedown"),u(e)},D=function(e){return e.parentElement?Array.prototype.indexOf.call(e.parentElement.children,e):0},L=function(e){return!!e.parentNode},O=function(e){if("string"!=typeof e)return e;var t=document.createElement("div");return t.innerHTML=e,t.firstChild},W=function(e,t){e.parentElement.insertBefore(t,e)},M=function(e,t){e.parentElement.insertBefore(t,e.nextElementSibling)},N=function(e){e.parentNode&&e.parentNode.removeChild(e)},T=function(e,t){var n=document.createEvent("Event");return t&&(n.detail=t),n.initEvent(e,!1,!0),n},k=function(e,t){a.forEach(function(n){w(e,n)&&n.dispatchEvent(t)})},P=function(n,i){var d=String(i);return i=function(e){var t={connectWith:!1,placeholder:null,dragImage:null,disableIEFix:!1,placeholderClass:"sortable-placeholder",draggingClass:"sortable-dragging",hoverClass:!1};for(var n in e)t[n]=e[n];return t}(i),"string"==typeof n&&(n=document.querySelectorAll(n)),n instanceof window.Element&&(n=[n]),n=Array.prototype.slice.call(n),n.forEach(function(n){if(/enable|disable|destroy/.test(d))return void P[d](n);i=o(n,"opts")||i,o(n,"opts",i),S(n);var f,h,u=s(n.children,i.items),m=i.placeholder;if(m||(m=document.createElement(/^ul|ol$/i.test(n.tagName)?"li":"div")),m=O(m),m.classList.add.apply(m.classList,i.placeholderClass.split(" ")),!n.getAttribute("data-sortable-id")){var v=a.length;a[v]=n,c(n,"data-sortable-id",v),c(u,"data-item-sortable-id",v)}if(o(n,"items",i.items),r.push(m),i.connectWith&&o(n,"connectWith",i.connectWith),A(n),c(u,"role","option"),c(u,"aria-grabbed","false"),i.hoverClass){var b="sortable-over";"string"==typeof i.hoverClass&&(b=i.hoverClass),l(u,"mouseenter",function(){this.classList.add(b)}),l(u,"mouseleave",function(){this.classList.remove(b)})}l(u,"dragstart",function(r){r.stopImmediatePropagation(),i.dragImage?(g(r,{draggedItem:i.dragImage,x:0,y:0}),console.log("WARNING: dragImage option is deprecated and will be removed in the future!")):y(r,this),this.classList.add(i.draggingClass),e=this,c(e,"aria-grabbed","true"),f=D(e),t=parseInt(window.getComputedStyle(e).height),h=this.parentElement,k(n,T("sortstart",{item:e,placeholder:m,startparent:h}))}),l(u,"dragend",function(){var a;e&&(e.classList.remove(i.draggingClass),c(e,"aria-grabbed","false"),e.style.display=e.oldDisplay,delete e.oldDisplay,r.forEach(N),a=this.parentElement,k(n,T("sortstop",{item:e,startparent:h})),f===D(e)&&h===a||k(n,T("sortupdate",{item:e,index:s(a.children,o(a,"items")).indexOf(e),oldindex:u.indexOf(e),elementIndex:D(e),oldElementIndex:f,startparent:h,endparent:a})),e=null,t=null)}),l([n,m],"drop",function(t){var a;w(n,e.parentElement)&&(t.preventDefault(),t.stopPropagation(),a=r.filter(L)[0],M(a,e),e.dispatchEvent(T("dragend")))});var E=function(a){if(w(n,e.parentElement))if(a.preventDefault(),a.stopPropagation(),a.dataTransfer.dropEffect="move",u.indexOf(this)!==-1){var o=parseInt(window.getComputedStyle(this).height),l=D(m),d=D(this);if(i.forcePlaceholderSize&&(m.style.height=t+"px"),o>t){var c=o-t,f=p(this).top;if(l<d&&a.pageY<f+c)return;if(l>d&&a.pageY>f+o-c)return}void 0===e.oldDisplay&&(e.oldDisplay=e.style.display),e.style.display="none",l<d?M(this,m):W(this,m),r.filter(function(e){return e!==m}).forEach(N)}else r.indexOf(this)!==-1||s(this.children,i.items).length||(r.forEach(N),this.appendChild(m))};l(u.concat(n),"dragover",E),l(u.concat(n),"dragenter",E)}),n};return P.destroy=function(e){I(e)},P.enable=function(e){A(e)},P.disable=function(e){C(e)},P});