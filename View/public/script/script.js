window.addEventListener("scroll", function (e) {
  let position =
    window.pageYOffset ||
    (document.documentElement || document.body.parentNode || document.body)
      .scrollTop;
  let nav = document.querySelector(".main-nav");
  if (position > 100) {
    nav.classList.add("blur");
    nav.classList.add("shadow");
  } else {
    nav.classList.remove("blur");
    nav.classList.remove("shadow");
  }
});

// MAIN ARTICLE OBSERVER
let options = {
  root: null,
  rootMargin: "0px 0px -150px 0px",
  threshold: 0.3,
};

let callback = (entries, observer) => {
  entries.forEach((entry) => {
    if (!entry.isIntersecting) {
      return;
    }
    let slidingHeader = document.querySelector("#sliding-header");
    let aside = document.querySelector(".aside");
    let asideImage = document.querySelector(".aside-img");

    slidingHeader.classList.add("slide");
    aside.classList.add("aside-borders");
    asideImage.classList.add("moving-img");
    observer.unobserve(entry.target);
  });
};

let observer = new IntersectionObserver(callback, options);
const mainArticle = document.querySelector("#main-article");
observer.observe(mainArticle);
