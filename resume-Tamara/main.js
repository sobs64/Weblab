var yearSpan = document.getElementById("year");
if (yearSpan) {
  var today = new Date();
  yearSpan.innerText = today.getFullYear();
}

(function () {
  var resumeContainers = document.getElementsByClassName("resume-page");
  if (!resumeContainers || resumeContainers.length === 0) {
    return;
  }

  var sections = resumeContainers[0].getElementsByClassName("resume-section");
  var i;

  for (i = 0; i < sections.length; i++) {
    var section = sections[i];
    var headings = section.getElementsByTagName("h2");
    if (!headings || headings.length === 0) {
      continue;
    }

    var heading = headings[0];

    var contentWrapper = document.createElement("div");
    var node = heading.nextSibling;

    while (node) {
      var nextNode = node.nextSibling;
      contentWrapper.appendChild(node);
      node = nextNode;
    }

    contentWrapper.style.display = "none";
    section.appendChild(contentWrapper);

    heading.innerHTML = '<span class="toggle-indicator">▾ </span>' + heading.innerHTML;

    heading.onclick = (function (wrapper) {
      return function () {
        if (wrapper.style.display === "none") {
          wrapper.style.display = "block";
        } else {
          wrapper.style.display = "none";
        }
      };
    })(contentWrapper);
  }
})();
