;( function() {

  // wait until gsap & ScrollTrigger available
  let chck_if_gsap_loaded = setInterval( function() {
    
    if( window.gsap && window.ScrollTrigger ) {
      
      // register scrolTrigger
      gsap.registerPlugin( ScrollTrigger );

      // ... do your thing
      show_hide_header();

      // clear interval
      clearInterval( chck_if_gsap_loaded ); 
      
    }
    
  }, 500 );
  
  function show_hide_header() {
		const site_header = document.querySelector( "#custom-header" );
		
		const show_hide_header = grap.from( site_header, {
			yPercent: -100,
			duration: 0.25,
			ease: "sine.out",
		});
		
		ScrollTrigger.create( {
			start: "top top",
			onUpdate: ( self ) => {
				if(self.direction === -1) show_hide_header.play();
				else show_hide_header.reverse();
			}
		} )
  }
  
} )();