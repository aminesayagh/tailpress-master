gsap.registerPlugin(ScrollTrigger);

gsap.utils.toArray(".sectionElem").forEach((panel, i) => {
  ScrollTrigger.create({
    trigger: panel,
    start: "top top",
    pin: true,
    pinSpacing: false,
    end= '+=600'
  });
});

ScrollTrigger.create({
  snap: 1 / 2, // snap whole page to the closest section!
});
