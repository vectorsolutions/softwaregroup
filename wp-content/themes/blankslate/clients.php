<script>
function mover(){
    document.getElementById("client1").style.display="block"
	document.getElementById("client2").style.display="none"
	document.getElementById("client3").style.display="none"
}
function mout() {
//    document.getElementById("client1").style.display="none"
}

function mover1(){
    document.getElementById("client2").style.display="block"
    document.getElementById("client1").style.display="none"
	document.getElementById("client3").style.display="none"
	
}
function mout1() {
//    document.getElementById("client2").style.display="none"
}

function mover2(){
    document.getElementById("client3").style.display="block"
    document.getElementById("client2").style.display="none"
    document.getElementById("client1").style.display="none"
	
}
function mout2() {
//    document.getElementById("client3").style.display="none"
}




</script>
<div id="clients" class="full-width">

	<div class="container">
	
		<div class="clients">
		
		<h2>Our Clients</h2>
		
			<div class="client_images">
				<img src="<?php echo $wptuts_options['logo06']; ?>" onmouseover="mover()"  />
				<img src="<?php echo $wptuts_options['logo07']; ?>"  onmouseover="mover1()" />
				<img src="<?php echo $wptuts_options['logo08']; ?>"  onmouseover="mover2()" />
			</div>
			<div class="client_case">
			<div id="client1" style="display:block;"><p><?php echo $wptuts_options['client_text']; ?>
			</p></div>
			<div id="client2" style="display:none;"><p><?php echo $wptuts_options['client_text_2']; ?>
			</p></div>
			<div id="client3" style="display:none;"><p><?php echo $wptuts_options['client_text_3']; ?>
			</p></div>
            
            
			</div>
			
		</div>
	
	</div>

</div>
