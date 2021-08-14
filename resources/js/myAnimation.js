gsap.registerPlugin(ScrollTrigger);

gsap.utils.toArray(".sectionElem").forEach((panel, i) => {
  ScrollTrigger.create({
    xPercent: -100 * (sections.length - 1),
    trigger: panel,
    start: "top top",
    pin: true,
    pinSpacing: false,
  });
});

ScrollTrigger.create({
  snap: 1 / 2, // snap whole page to the closest section!
});
