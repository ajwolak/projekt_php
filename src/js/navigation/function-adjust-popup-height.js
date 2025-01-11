const originalHeights = new Map();

function handleClassAdded(mutationsList) {
  for (const mutation of mutationsList) {
    if (mutation.type === "attributes" && mutation.attributeName === "class") {
      const target = mutation.target;
      const headingBoxes = target.querySelectorAll(".heading-box");

      if (target.classList.contains("toggled")) {
        headingBoxes.forEach((headingBox) => {
          if (!originalHeights.has(headingBox)) {
            originalHeights.set(headingBox, headingBox.style.height || "30px");
          }
        });

        function adjustHeadingBoxHeightOnScroll() {
          const pixelsScrolled = target.scrollTop;
          console.log(pixelsScrolled);

          headingBoxes.forEach((headingBox) => {
            headingBox.style.height = 30 + pixelsScrolled + "px";
          });
        }

        target.addEventListener("scroll", adjustHeadingBoxHeightOnScroll);

        target._adjustHeadingBoxHeightOnScroll = adjustHeadingBoxHeightOnScroll;
      } else {
        if (target._adjustHeadingBoxHeightOnScroll) {
          target.removeEventListener(
            "scroll",
            target._adjustHeadingBoxHeightOnScroll
          );
          delete target._adjustHeadingBoxHeightOnScroll;
        }

        headingBoxes.forEach((headingBox) => {
          if (originalHeights.has(headingBox)) {
            headingBox.style.height = originalHeights.get(headingBox);
            originalHeights.delete(headingBox);
          }
        });
      }
    }
  }
}

const observer = new MutationObserver(handleClassAdded);

const targetNode = document.querySelector(".group");

const config = {
  attributes: true,
};

observer.observe(targetNode, config);

document.getElementById("toggleClass").addEventListener("click", () => {
  targetNode.classList.toggle("toggled");
});
