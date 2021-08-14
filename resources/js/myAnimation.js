gsap.registerPlugin(ScrollTrigger);

gsap.utils.toArray(".sectionElem").forEach((panel, i) => {
  ScrollTrigger.create({
    trigger: panel,
    start: "top top",
    pin: true,
    pinSpacing: false,
    scrub: true
  });
});

ScrollTrigger.create({
  // snap: 1 / 26, // snap whole page to the closest section!
});

let header = gsap.timeline({
  scrollTrigger: {
    trigger: ".elementor-location-header",
    pin: true,
    start: 'top top',
    onUpdate: (self) => {
      if (self.direction === -1 ) {
        console.log('haut')
        show_hide_header.play()
      } else {
        console.log('bas')
        show_hide_header.reverse();
      }
    }
  },
});

const show_hide_header = () => {
  gsap.to(".elementor-location-header", {
    yPercent: -100,
    duration: 0.25,
    ease: "sine.out"
  });
}