window.addEventListener("scroll", function () {
      var header = document.querySelector("nav");
      header.classList.toggle("scroll-nav", window.scrollY > 0);
});