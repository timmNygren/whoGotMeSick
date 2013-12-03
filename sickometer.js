//jQuery would be nice.
var canvas = document.getElementById('canvas');
var ctx=canvas.getContext("2d");
ctx.fillStyle="white";
//ctx.fillRect(0,0,canvas.width,canvas.height);

function getGradient(ctx, width) { 
	var grad = ctx.createLinearGradient(0,0,width,0);
	grad.addColorStop(0, 'green');
	grad.addColorStop(0.5, 'yellow');
	grad.addColorStop(1, 'red');
	return grad;
}

function fillArc(ctx, width) {
	var grad = getGradient(ctx, width); 
	ctx.beginPath();
	ctx.arc(width/2,2*width/3,width/2,Math.PI,0);
	ctx.fillStyle = grad;
	ctx.fill();
}

function drawArrow(ctx,percent,radius,x,y) {
	ctx.save();
	ctx.fillStyle = "black";
	ctx.strokeStyle = "black";
	ctx.translate(x,y);
	ctx.rotate(Math.PI*percent/100.0);
	ctx.lineWidth = 4;
	
	ctx.beginPath();
	ctx.moveTo(0,0);
	ctx.lineTo(-radius+5,0);
	ctx.stroke();
	ctx.closePath();
	ctx.beginPath();
	ctx.moveTo(-radius,0);
	ctx.lineTo(-radius+5,-5);
	ctx.lineTo(-radius+5,5);
	ctx.closePath();
	
	ctx.stroke();
	ctx.restore();
}

function updateArrow(percent) {
	fillArc(ctx, canvas.width);
	drawArrow(ctx,percent,canvas.width/2,canvas.width/2,2*canvas.width/3);
}

function drawSlider(ctx, percent, width, height){
	ctx.fillStyle = "white";
	ctx.fillRect(0,0,width, height);
	
	var pos = percent*width/100;
	var thick = 10;
	ctx.fillStyle = "black";
	ctx.fillRect(pos - thick/2,0,thick, height);
}


$( document ).ready(function() {
	var fcanvas = document.getElementById('freq_canvas');
	var scanvas = document.getElementById('sev_canvas');

	var fctx=fcanvas.getContext("2d");
	var sctx=scanvas.getContext("2d");

	var h = fcanvas.height;
	var w = fcanvas.width;
	drawSlider(fctx, 20, w, h)
	drawSlider(sctx, 20, w, h)
});
