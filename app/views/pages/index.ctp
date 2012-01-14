<script type="text/javascript" src="js/protovis.min.js"></script>
<div id="grafico-inicio">
<script type="text/javascript+protovis">
function fields(){
  return [
	  {value: <?php echo $areasInvestigadores[0]["val"]; ?>/<?php echo $areasInvestigadores[0]["max"]; ?>, area: "Ciencias Sociales y Econ&oacute;micas", index: .7, color:"#b11522"},
      {value: <?php echo $areasInvestigadores[1]["val"]; ?>/<?php echo $areasInvestigadores[1]["max"]; ?>, area: "Medicina y Ciencias de la Salud", index: .6, color:"#e55030"},
      {value: <?php echo $areasInvestigadores[2]["val"]; ?>/<?php echo $areasInvestigadores[2]["max"]; ?>, area: "Biotecnología y Ciencias Agropecuarias", index: .5, color:"#e56b15"},
      {value: <?php echo $areasInvestigadores[3]["val"]; ?>/<?php echo $areasInvestigadores[3]["max"]; ?>, area: "Humanidades y Ciencias de la Conducta", index: .4, color:"#e9910b"},
      {value: <?php echo $areasInvestigadores[4]["val"]; ?>/<?php echo $areasInvestigadores[4]["max"]; ?>, area: "Ingeniería e Industria", index: .3, color:"#f6bb47"},
      {value: <?php echo $areasInvestigadores[5]["val"]; ?>/<?php echo $areasInvestigadores[5]["max"]; ?>, area: "Física, Matemáticas y Ciencias de la Tierra", index: .2, color:"#f8d9ab"},
      {value: <?php echo $areasInvestigadores[6]["val"]; ?>/<?php echo $areasInvestigadores[6]["max"]; ?>, area: "Biología y Química", index: .1, color:"#ffffff"}
    ];
}
var radius=600/2;var vis=new pv.Panel().width(radius*2).height(radius*2);vis.add(pv.Dot).left(radius).top(radius).fillStyle("#000").strokeStyle("#bbb").lineWidth(2).radius(radius-43);vis.add(pv.Wedge).data(fields).left(radius).bottom(radius).innerRadius(function(a){return radius*a.index}).outerRadius(function(a){return radius*(a.index+0.05)}).startAngle(-Math.PI/2).angle(function(a){return 2*Math.PI*a.value}).fillStyle(function(a){return a.color}).event("mouseover",function(a){if($("#valorCantidadGrafica").is(":hidden")){if($(window).width()<1600){$("#valorCantidadGrafica").css({right:"0px"});$("#valorCantidadGrafica").fadeIn().animate({top:"-30px",right:"-40px"},800,"easeOutExpo")}else{$("#valorCantidadGrafica").fadeIn().animate({top:"-=300"},800,"easeOutExpo")}}$("#valorCantidadGrafica").fadeIn("slow").css("border","solid 2px "+a.color);$("#valorCantidadGrafica .area-investigadores").html(a.area);$("#valorCantidadGrafica .acotacion").css("background",a.color);$("#valorCantidadGrafica .cantidad-investigadores").html(Math.round(a.value*100)+" % de Investigadores.")}).strokeStyle(null).anchor("end").add(pv.Label).font("bold 12px sans-serif").textStyle("#000").textMargin(7).text(function(a){return a.text});vis.add(pv.Image).width(18).height(45).url("img/icono_grafica.png");vis.add(pv.Wedge).data(["90 %","100%","10 %","20 %","30 %","40 %","50%","60%","70 %","80 %"]).innerRadius(30).outerRadius(255).lineWidth(3).fillStyle(null).strokeStyle("#232323").angle(0.628).anchor("end").add(pv.Label).font("14px sans-serif").textStyle("#fff").top(radius).left(radius).textMargin(radius-67).text(function(a){return a});vis.render();
</script>
   <div id="valorCantidadGrafica">
    	<ul>
    		<li class="fl acotacion"></li><li class="fl area-investigadores"></li>
    		<li class="cl"></li>
    		<li class="cantidad-investigadores"></li>
    	</ul>
    </div>
</div>
<script type='text/javascript' src='js/jquery-1.4.2.js'></script>
<script type="text/javascript" src="js/app.js"></script>