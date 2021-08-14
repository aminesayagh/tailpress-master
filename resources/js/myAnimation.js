// wait until DOM is ready
document.addEventListener("DOMContentLoaded", function (event) {
  console.log("DOM loaded");

  // wait until images, links, fonts, stylesheets, and js is loaded
  window.addEventListener(
    "load",
    function (e) {
      // custom GSAP code goes here
      console.log("window loaded");
      gsap.registerPlugin(ScrollTrigger);

      gsap.utils.toArray(".sectionElem").array.forEach((section) => {
        ScrollTrigger.create({
          trigger: section,
          start: "top top",
          pin: true,
          pinSpacing: false,
        });
      });
    },
    false
  );
});
