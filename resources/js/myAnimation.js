gsap.registerPlugin(ScrollTrigger);

gsap.utils.toArray(".sectionElem").forEach((panel, i) => {
  ScrollTrigger.create({
    trigger: panel,
    start: "top top",
    pin: true,
    pinSpacing: false,
  });
});

ScrollTrigger.create({
  snap: 4 / 4, // snap whole page to the closest section!
});
