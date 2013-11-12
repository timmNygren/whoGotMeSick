//jQuery would be nice.
var cs=document.getElementsByTagName("canvas");
console.log(cs)
var c = cs[0];
console.log(c)
var ctx=c.getContext("2d");
ctx.fillStyle="#FF0000";
ctx.fillRect(0,0,150,75);
console.log("tacos")